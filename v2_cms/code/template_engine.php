<?php

/**
 * SteamCMS Template Engine
 * Supports multiple themes and dynamic content management
 * Author: MiniMax Agent
 */

class TemplateEngine {
    private $template_dir;
    private $cache_dir;
    private $variables = [];
    private $blocks = [];
    private $current_theme;
    
    public function __construct($template_dir = 'themes', $cache_dir = 'cache') {
        $this->template_dir = $template_dir;
        $this->cache_dir = $cache_dir;
        
        // Create directories if they don't exist
        if (!is_dir($this->template_dir)) {
            mkdir($this->template_dir, 0755, true);
        }
        if (!is_dir($this->cache_dir)) {
            mkdir($this->cache_dir, 0755, true);
        }
    }
    
    /**
     * Set the current theme (year-based: 2002, 2003, etc.)
     */
    public function setTheme($theme) {
        $this->current_theme = $theme;
        return $this;
    }
    
    /**
     * Assign variable to template
     */
    public function assign($name, $value) {
        $this->variables[$name] = $value;
        return $this;
    }
    
    /**
     * Assign multiple variables
     */
    public function assignMultiple($variables) {
        $this->variables = array_merge($this->variables, $variables);
        return $this;
    }
    
    /**
     * Render a template
     */
    public function render($template, $variables = []) {
        try {
            if (!empty($variables)) {
                $this->assignMultiple($variables);
            }
            
            $template_path = $this->getTemplatePath($template);
            
            if (!file_exists($template_path)) {
                throw new Exception("Template not found: $template_path (Current theme: {$this->current_theme})");
            }
            
            // Process template with custom syntax
            $content = file_get_contents($template_path);
            if ($content === false) {
                throw new Exception("Could not read template file: $template_path");
            }
            
            $processed = $this->processTemplate($content);
            
            return $processed;
        } catch (Exception $e) {
            // Enhanced error information
            $error_info = [
                'template' => $template,
                'theme' => $this->current_theme,
                'template_path' => isset($template_path) ? $template_path : 'unknown',
                'template_dir' => $this->template_dir,
                'error' => $e->getMessage()
            ];
            
            throw new Exception("Template rendering failed: " . json_encode($error_info));
        }
    }
    
    /**
     * Get full template path
     */
    private function getTemplatePath($template) {
        return $this->template_dir . '/' . $this->current_theme . '/' . $template . '.tpl';
    }
    
    /**
     * Process template with custom syntax
     */
    private function processTemplate($content) {
        // Check if this template extends another template
        if (preg_match('/\{extends\s+"([^"]+)"\}/', $content, $matches)) {
            return $this->processTemplateInheritance($content, $matches[1]);
        }
        
        // Process regular template (no inheritance)
        return $this->processTemplateDirectives($content);
    }
    
    /**
     * Process template inheritance
     */
    private function processTemplateInheritance($childContent, $parentTemplate) {
        // Extract blocks from child template
        $childBlocks = [];
        preg_match_all('/\{block\s+"([^"]+)"\}(.*?)\{\/block\}/s', $childContent, $blockMatches, PREG_SET_ORDER);
        
        foreach ($blockMatches as $match) {
            $blockName = $match[1];
            $blockContent = $match[2];
            $childBlocks[$blockName] = $blockContent;
        }
        
        // Load parent template
        $parentPath = $this->getTemplatePath($parentTemplate);
        if (!file_exists($parentPath)) {
            throw new Exception("Parent template not found: $parentPath");
        }
        
        $parentContent = file_get_contents($parentPath);
        
        // Replace block placeholders in parent with child blocks
        foreach ($childBlocks as $blockName => $blockContent) {
            $parentContent = str_replace(
                '{block_placeholder "' . $blockName . '"}',
                $blockContent,
                $parentContent
            );
        }
        
        // Process the final combined template
        return $this->processTemplateDirectives($parentContent);
    }
    
    /**
     * Process template directives (variables, loops, etc.)
     */
    private function processTemplateDirectives($content) {
        // Process includes: {include "filename"}
        $content = preg_replace_callback(
            '/\{include\s+"([^"]+)"\}/',
            [$this, 'processInclude'],
            $content
        );
        
        // Process variables: {$variable}, {$variable.property}, and {$variable@modifier}
        $content = preg_replace_callback(
            '/\{\$([a-zA-Z_][a-zA-Z0-9_]*(?:[@\.][a-zA-Z_][a-zA-Z0-9_]*)*)\}/',
            [$this, 'processVariable'],
            $content
        );
        
        // Process loops: {foreach $items as $item} ... {/foreach}
        $content = preg_replace_callback(
            '/\{foreach\s+\$([a-zA-Z_][a-zA-Z0-9_]*)\s+as\s+\$([a-zA-Z_][a-zA-Z0-9_]*)\}(.*?)\{\/foreach\}/s',
            [$this, 'processForeach'],
            $content
        );
        
        // Process conditionals: {if $condition} and {if !$condition} ... {/if}
        $content = preg_replace_callback(
            '/\{if\s+(!?)\$([a-zA-Z_][a-zA-Z0-9_]*(?:[@\.][a-zA-Z_][a-zA-Z0-9_]*)*)\}(.*?)\{\/if\}/s',
            [$this, 'processIf'],
            $content
        );
        
        return $content;
    }
    
    /**
     * Process include directive
     */
    private function processInclude($matches) {
        $include_file = $matches[1];
        $include_path = $this->getTemplatePath($include_file);
        
        if (file_exists($include_path)) {
            $include_content = file_get_contents($include_path);
            return $this->processTemplateDirectives($include_content);
        }
        
        return '';
    }
    
    /**
     * Process variable directive
     */
    private function processVariable($matches) {
        $var_path = $matches[1];
        
        // Handle loop variables with @ syntax (e.g., $item@last)
        if (strpos($var_path, '@') !== false) {
            $var_name = $var_path; // Use full path including @
            if (isset($this->variables[$var_name])) {
                $value = $this->variables[$var_name];
                return is_bool($value) ? ($value ? '1' : '0') : (string)$value;
            }
            return '';
        }
        
        // Handle object/array property access (e.g., $article.title)
        $parts = explode('.', $var_path);
        $var_name = array_shift($parts);
        
        if (!isset($this->variables[$var_name])) {
            return '';
        }
        
        $value = $this->variables[$var_name];
        
        // Navigate through properties if specified
        foreach ($parts as $property) {
            if (is_array($value) && isset($value[$property])) {
                $value = $value[$property];
            } elseif (is_object($value) && property_exists($value, $property)) {
                $value = $value->$property;
            } else {
                return '';
            }
        }
        
        // Handle different value types
        if (is_array($value) || is_object($value)) {
            return json_encode($value);
        }
        
        if (is_bool($value)) {
            return $value ? '1' : '0';
        }
        
        if (is_null($value)) {
            return '';
        }
        
        return htmlspecialchars((string)$value, ENT_QUOTES);
    }
    
    /**
     * Process foreach directive
     */
    private function processForeach($matches) {
        $array_name = $matches[1];
        $item_name = $matches[2];
        $loop_content = $matches[3];
        
        if (!isset($this->variables[$array_name]) || !is_array($this->variables[$array_name])) {
            return '';
        }
        
        $output = '';
        $items = $this->variables[$array_name];
        $total_items = count($items);
        $current_index = 0;
        
        foreach ($items as $item) {
            // Temporarily store the item variable and loop variables
            $old_item_value = isset($this->variables[$item_name]) ? $this->variables[$item_name] : null;
            $old_last_value = isset($this->variables[$item_name . '@last']) ? $this->variables[$item_name . '@last'] : null;
            $old_first_value = isset($this->variables[$item_name . '@first']) ? $this->variables[$item_name . '@first'] : null;
            $old_index_value = isset($this->variables[$item_name . '@index']) ? $this->variables[$item_name . '@index'] : null;
            
            // Set item and loop variables
            $this->variables[$item_name] = $item;
            $this->variables[$item_name . '@last'] = ($current_index === $total_items - 1);
            $this->variables[$item_name . '@first'] = ($current_index === 0);
            $this->variables[$item_name . '@index'] = $current_index;
            
            $output .= $this->processTemplateDirectives($loop_content);
            
            // Restore old values
            if ($old_item_value !== null) {
                $this->variables[$item_name] = $old_item_value;
            } else {
                unset($this->variables[$item_name]);
            }
            
            if ($old_last_value !== null) {
                $this->variables[$item_name . '@last'] = $old_last_value;
            } else {
                unset($this->variables[$item_name . '@last']);
            }
            
            if ($old_first_value !== null) {
                $this->variables[$item_name . '@first'] = $old_first_value;
            } else {
                unset($this->variables[$item_name . '@first']);
            }
            
            if ($old_index_value !== null) {
                $this->variables[$item_name . '@index'] = $old_index_value;
            } else {
                unset($this->variables[$item_name . '@index']);
            }
            
            $current_index++;
        }
        
        return $output;
    }
    
    /**
     * Process if directive
     */
    private function processIf($matches) {
        $negation = $matches[1] === '!';
        $condition_var = $matches[2];
        $content = $matches[3];
        
        // Get the condition value using the same logic as processVariable
        $condition_value = $this->getVariableValue($condition_var);
        
        // Apply negation if specified
        if ($negation) {
            $condition_value = !$condition_value;
        }
        
        if ($condition_value) {
            return $this->processTemplateDirectives($content);
        }
        
        return '';
    }
    
    /**
     * Get variable value (helper method for consistent variable access)
     */
    private function getVariableValue($var_path) {
        // Handle loop variables with @ syntax
        if (strpos($var_path, '@') !== false) {
            return isset($this->variables[$var_path]) ? $this->variables[$var_path] : false;
        }
        
        // Handle object/array property access
        $parts = explode('.', $var_path);
        $var_name = array_shift($parts);
        
        if (!isset($this->variables[$var_name])) {
            return false;
        }
        
        $value = $this->variables[$var_name];
        
        // Navigate through properties if specified
        foreach ($parts as $property) {
            if (is_array($value) && isset($value[$property])) {
                $value = $value[$property];
            } elseif (is_object($value) && property_exists($value, $property)) {
                $value = $value->$property;
            } else {
                return false;
            }
        }
        
        // Convert to boolean
        if (is_bool($value)) {
            return $value;
        }
        
        if (is_null($value) || $value === '' || $value === 0 || $value === '0') {
            return false;
        }
        
        if (is_array($value) && empty($value)) {
            return false;
        }
        
        return true;
    }
    

    
    /**
     * Get all available themes
     */
    public function getAvailableThemes() {
        $themes = [];
        if (is_dir($this->template_dir)) {
            $dirs = scandir($this->template_dir);
            foreach ($dirs as $dir) {
                if ($dir !== '.' && $dir !== '..' && is_dir($this->template_dir . '/' . $dir)) {
                    $themes[] = $dir;
                }
            }
        }
        return $themes;
    }
    
    /**
     * Create a new theme directory structure
     */
    public function createThemeStructure($theme_name) {
        $theme_path = $this->template_dir . '/' . $theme_name;
        
        if (!is_dir($theme_path)) {
            mkdir($theme_path, 0755, true);
            
            // Create subdirectories
            mkdir($theme_path . '/layouts', 0755, true);
            mkdir($theme_path . '/partials', 0755, true);
            mkdir($theme_path . '/css', 0755, true);
            mkdir($theme_path . '/js', 0755, true);
            mkdir($theme_path . '/images', 0755, true);
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Helper function to escape HTML
     */
    public function escape($value) {
        return htmlspecialchars($value, ENT_QUOTES);
    }
    
    /**
     * Helper function to format dates
     */
    public function formatDate($date, $format = 'F j, Y') {
        if (is_string($date)) {
            $date = strtotime($date);
        }
        return date($format, $date);
    }
    
    /**
     * Helper function to truncate text
     */
    public function truncate($text, $length = 100, $suffix = '...') {
        if (strlen($text) > $length) {
            return substr($text, 0, $length) . $suffix;
        }
        return $text;
    }
}

?>
