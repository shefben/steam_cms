<?php
/**
 * Steam Archive Data Extractor
 * Processes each URL from wayback_game_appids_2007_2008.txt
 * Extracts comprehensive game data and generates SQL inserts
 */

set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);

class SteamDataExtractor {
    private $urls_file;
    private $sql_file;
    private $processed_count = 0;
    private $failed_count = 0;
    private $sql_inserts = [];
    
    public function __construct() {
        $this->urls_file = __DIR__ . '/wayback_game_appids_2007_2008.txt';
        $this->sql_file = __DIR__ . '/sql/steam_games_2007_data.sql';
        
        // Initialize SQL file with schema
        $schema = file_get_contents(__DIR__ . '/sql/steam_games_2007_schema.sql');
        file_put_contents($this->sql_file, $schema . "\n\n-- EXTRACTED DATA\n\n");
    }
    
    public function processAllUrls() {
        echo "Starting Steam data extraction...\n";

        while (true) {
            $url = $this->getNextUrl();
            if ($url === null) {
                break; // no file or no lines left
            }
            if ($url === '') {
                // bad/empty/comment line: drop it and continue
                $this->removeProcessedUrl();
                continue;
            }

            echo "Processing: $url\n";
            try {
                $data = $this->extractGameData($url);
                if ($data) {
                    $this->saveGameData($data);
                    $this->processed_count++;
                    echo "✓ Extracted: {$data['title']} (AppID: {$data['app_id']})\n";
                } else {
                    $this->failed_count++;
                    echo "✗ Failed to extract data from: $url\n";
                }
            } catch (Exception $e) {
                $this->failed_count++;
                echo "✗ Error processing $url: " . $e->getMessage() . "\n";
            }

            $this->removeProcessedUrl();
            sleep(1);
        }

        $this->finalizeSqlFile();
        echo "\n=== EXTRACTION COMPLETE ===\n";
        echo "Processed: {$this->processed_count} games\n";
        echo "Failed: {$this->failed_count} games\n";
        echo "SQL file: {$this->sql_file}\n";
    }

    
    private function getNextUrl() {
        if (!file_exists($this->urls_file)) {
            return null;
        }
        $lines = file($this->urls_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (empty($lines)) {
            return null;
        }

        // Find the first usable line
        $raw = trim($lines[0]);

        // If someone stored "label → URL", still support it
        if (strpos($raw, '→') !== false) {
            $parts = explode('→', $raw, 2);
            $raw = trim($parts[1]);
        }

        // Skip comments
        if ($raw === '' || $raw[0] === '#') {
            return '';
        }

        // Normalize partials like: php?area=game&AppId=240&...
        if (preg_match('~^https?://~i', $raw)) {
            return $raw;
        } elseif (stripos($raw, 'php?area=game&AppId=') === 0) {
            // We can't guess the exact capture timestamp; pick a sane default frame.
            // If you want to be precise per-app, keep the timestamp in the file.
            return 'https://web.archive.org/web/20080401id_/http://storefront.steampowered.com/v2/' . $raw;
        } else {
            // Not a URL we recognize
            return '';
        }
    }

    
    private function removeProcessedUrl() {
        $lines = file($this->urls_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        array_shift($lines); // Remove first line
        file_put_contents($this->urls_file, implode("\n", $lines) . "\n");
    }
    
    private function extractGameData($url) {
        $html = $this->fetchUrl($url);
        if (!$html) return null;
        
        $data = [];
        
        // Extract App ID from URL
        preg_match('/AppId=(\d+)/', $url, $matches);
        $data['app_id'] = $matches[1] ?? null;
        
        // Extract title from page title
        preg_match('/<title>Steam - (.+?)<\/title>/', $html, $matches);
        $data['title'] = html_entity_decode($matches[1] ?? '', ENT_QUOTES, 'UTF-8');
        
        // Extract metascore
        preg_match('/class="rightCol_2_top_mc"[^>]*>(\d+)</', $html, $matches);
        $data['metascore'] = $matches[1] ?? null;
        
        // Extract metascore URL
        preg_match('/window\.open\(\s*[\'"]([^"\']+metacritic[^"\']+)[\'"]/', $html, $matches);
        $data['metascore_url'] = $matches[1] ?? null;
        
        // Extract header image
        preg_match('/src="gfx\/apps\/\d+\/(header\.jpg)"/', $html, $matches);
        $data['header_image'] = $matches[1] ?? null;
        
        // Extract video trailer AppID (look for video/media related content)
        // This would need more specific patterns based on actual content
        
        // Extract About the Game description
        if (preg_match('/About the Game.*?<\/div>\s*<p>(.*?)<\/p>/s', $html, $matches)) {
            $data['about_game'] = strip_tags(html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8'));
        }
        
        // Extract Game Details section
        if (preg_match('/Game Details.*?<p>(.*?)<\/p>/s', $html, $matches)) {
            $details_html = $matches[1];
            $data['details'] = $this->parseGameDetails($details_html);
        }
        
        // Extract system requirements
        if (preg_match('/System Requirements.*?<div[^>]*>(.*?)<\/div>/s', $html, $matches)) {
            $data['system_requirements'] = $this->parseSystemRequirements($matches[1]);
        }
        
        // Extract media links
        if (preg_match('/Media \+ Links.*?<div[^>]*>(.*?)<\/div>/s', $html, $matches)) {
            $data['media_links'] = $this->parseMediaLinks($matches[1]);
        }
        
        // Extract screenshots
        $data['screenshots'] = $this->extractScreenshots($html);
        
        // Basic sanity
        if (empty($data['app_id']) || empty($data['title'])) {
            return null;
        }
        return $data;
    }
    
    private function parseGameDetails($html) {
        $details = [];
        
        // Extract individual fields
        if (preg_match('/Title\s*:\s*<\/strong>\s*([^<]+)/i', $html, $matches)) {
            $details['title'] = trim($matches[1]);
        }
        
        if (preg_match('/Developer\s*:\s*<\/strong>\s*<a[^>]*>([^<]+)<\/a>/i', $html, $matches)) {
            $details['developer'] = trim($matches[1]);
        }
        
        if (preg_match('/Publisher\s*:\s*<\/strong>\s*<a[^>]*>([^<]+)<\/a>/i', $html, $matches)) {
            $details['publisher'] = trim($matches[1]);
        }
        
        if (preg_match('/Release Date\s*:\s*<\/strong>\s*([^<]+)/i', $html, $matches)) {
            $details['release_date'] = trim($matches[1]);
        }
        
        if (preg_match('/Languages\s*:\s*<\/strong>\s*([^<]+)/i', $html, $matches)) {
            $details['languages'] = array_map('trim', explode(',', $matches[1]));
        }
        
        return $details;
    }
    
    private function parseSystemRequirements($html) {
        $requirements = [];
        
        if (preg_match('/Minimum:\s*<\/strong>\s*([^<]+)/i', $html, $matches)) {
            $requirements['minimum'] = trim($matches[1]);
        }
        
        if (preg_match('/Recommended:\s*<\/strong>\s*([^<]+)/i', $html, $matches)) {
            $requirements['recommended'] = trim($matches[1]);
        }
        
        return $requirements;
    }
    
    private function parseMediaLinks($html) {
        $links = [];
        
        // Extract website links
        if (preg_match_all('/<a href="([^"]+)"[^>]*>.*?visit the website/i', $html, $matches)) {
            foreach ($matches[1] as $url) {
                $links[] = ['type' => 'website', 'url' => $url];
            }
        }
        
        // Extract forum links
        if (preg_match_all('/<a href="([^"]+)"[^>]*>.*?visit the forums/i', $html, $matches)) {
            foreach ($matches[1] as $url) {
                $links[] = ['type' => 'forum', 'url' => $url];
            }
        }
        
        return $links;
    }
    
    private function extractScreenshots($html) {
        $screenshots = [];
        
        if (preg_match_all('/src="gfx\/apps\/\d+\/(\d+_thumb\.jpg)"/', $html, $matches)) {
            foreach ($matches[1] as $filename) {
                $screenshots[] = str_replace('_thumb', '', $filename);
            }
        }
        
        return $screenshots;
    }
    
    private function fetchUrl($url) {
        $context = stream_context_create([
            'http' => [
                'timeout' => 36,
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) PHP/stream',
                'follow_location' => 0,
                'ignore_errors' => true, // still capture body for diagnostics
                'header' => "Accept: text/html,*/*;q=0.8\r\n"
            ]
        ]);

        $html = @file_get_contents($url, false, $context);

        // Examine $http_response_header for HTTP status
        $status = 0;
        if (isset($http_response_header) && is_array($http_response_header)) {
            foreach ($http_response_header as $h) {
                if (preg_match('~^HTTP/\S+\s+(\d{3})~', $h, $m)) {
                    $status = (int)$m[1];
                    break;
                }
            }
        }
        if ($status !== 200 || $html === false || $html === '') {
            echo "Skipping (HTTP $status): $url\n";
            return null;
        }

        // Wayback sometimes returns interstitials that contain the word "redirect" in JS.
        // Don't reject on keywords alone; rely on HTTP 200 + real content checks instead.
        return $html;
    }

    
    private function saveGameData($data) {
        $app_id = (int)$data['app_id'];
        $title = $this->escapeSql($data['title']);
        $metascore = $data['metascore'] ? (int)$data['metascore'] : 'NULL';
        $metascore_url = $data['metascore_url'] ? "'" . $this->escapeSql($data['metascore_url']) . "'" : 'NULL';
        $about_game = $data['about_game'] ? "'" . $this->escapeSql($data['about_game']) . "'" : 'NULL';
        $header_image = $data['header_image'] ? "'" . $this->escapeSql($data['header_image']) . "'" : 'NULL';
        
        // Insert main game record
        $sql = "INSERT IGNORE INTO games (app_id, title, metascore, metascore_url, about_game_description, header_image_filename) VALUES ($app_id, '$title', $metascore, $metascore_url, $about_game, $header_image);\n";
        file_put_contents($this->sql_file, $sql, FILE_APPEND);
        
        // Insert game details if available
        if (!empty($data['details'])) {
            $this->saveGameDetails($data['app_id'], $data['details']);
        }
        
        // Insert system requirements
        if (!empty($data['system_requirements'])) {
            $this->saveSystemRequirements($data['app_id'], $data['system_requirements']);
        }
        
        // Insert media links
        if (!empty($data['media_links'])) {
            $this->saveMediaLinks($data['app_id'], $data['media_links']);
        }
        
        // Insert screenshots
        if (!empty($data['screenshots'])) {
            $this->saveScreenshots($data['app_id'], $data['screenshots']);
        }
    }
    
    private function saveGameDetails($app_id, $details) {
        // Insert developer if present
        if (!empty($details['developer'])) {
            $dev_name = $this->escapeSql($details['developer']);
            $sql = "INSERT IGNORE INTO developers (name) VALUES ('$dev_name');\n";
            file_put_contents($this->sql_file, $sql, FILE_APPEND);
        }
        
        // Insert publisher if present
        if (!empty($details['publisher'])) {
            $pub_name = $this->escapeSql($details['publisher']);
            $sql = "INSERT IGNORE INTO publishers (name) VALUES ('$pub_name');\n";
            file_put_contents($this->sql_file, $sql, FILE_APPEND);
        }
        
        // Convert release date
        $release_date = 'NULL';
        if (!empty($details['release_date'])) {
            $date = date('Y-m-d', strtotime($details['release_date']));
            if ($date && $date !== '1970-01-01') {
                $release_date = "'$date'";
            }
        }
        
        $sql = "INSERT IGNORE INTO game_details (app_id, developer_id, publisher_id, release_date) VALUES ($app_id, ";
        $sql .= !empty($details['developer']) ? "(SELECT id FROM developers WHERE name = '" . $this->escapeSql($details['developer']) . "')" : "NULL";
        $sql .= ", ";
        $sql .= !empty($details['publisher']) ? "(SELECT id FROM publishers WHERE name = '" . $this->escapeSql($details['publisher']) . "')" : "NULL";
        $sql .= ", $release_date);\n";
        
        file_put_contents($this->sql_file, $sql, FILE_APPEND);
        
        // Insert languages
        if (!empty($details['languages'])) {
            foreach ($details['languages'] as $lang) {
                $lang = trim($lang);
                $sql = "INSERT IGNORE INTO game_languages (app_id, language_id) VALUES ($app_id, (SELECT id FROM languages WHERE name = '" . $this->escapeSql($lang) . "'));\n";
                file_put_contents($this->sql_file, $sql, FILE_APPEND);
            }
        }
    }
    
    private function saveSystemRequirements($app_id, $requirements) {
        foreach ($requirements as $type => $req_text) {
            if (!empty($req_text)) {
                $text = $this->escapeSql($req_text);
                $sql = "INSERT IGNORE INTO system_requirements (app_id, requirement_type, other_notes) VALUES ($app_id, '$type', '$text');\n";
                file_put_contents($this->sql_file, $sql, FILE_APPEND);
            }
        }
    }
    
    private function saveMediaLinks($app_id, $links) {
        foreach ($links as $link) {
            $type = $this->escapeSql($link['type']);
            $url = $this->escapeSql($link['url']);
            $sql = "INSERT IGNORE INTO media_links (app_id, link_type, url) VALUES ($app_id, '$type', '$url');\n";
            file_put_contents($this->sql_file, $sql, FILE_APPEND);
        }
    }
    
    private function saveScreenshots($app_id, $screenshots) {
        foreach ($screenshots as $index => $filename) {
            $filename = $this->escapeSql($filename);
            $sql = "INSERT IGNORE INTO screenshots (app_id, filename, sort_order) VALUES ($app_id, '$filename', $index);\n";
            file_put_contents($this->sql_file, $sql, FILE_APPEND);
        }
    }
    
    private function finalizeSqlFile() {
        $sql = "\n-- Extraction completed at " . date('Y-m-d H:i:s') . "\n";
        $sql .= "-- Total games processed: {$this->processed_count}\n";
        $sql .= "-- Failed extractions: {$this->failed_count}\n";
        file_put_contents($this->sql_file, $sql, FILE_APPEND);
    }
    
    private function escapeSql($string) {
        return addslashes(html_entity_decode($string, ENT_QUOTES, 'UTF-8'));
    }
}

// Run the extractor
$extractor = new SteamDataExtractor();
$extractor->processAllUrls();
?>