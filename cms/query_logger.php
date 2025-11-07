<?php

declare(strict_types=1);

/**
 * Database Query Logger and Analyzer (Optimization #29)
 *
 * Logs slow queries and provides analysis tools for optimization
 *
 * PERFORMANCE IMPACT: Helps identify bottlenecks for targeted optimization
 */

class QueryLogger
{
    private const LOG_FILE = __DIR__ . '/cache/query_log.json';
    private const SLOW_QUERY_THRESHOLD = 100; // ms

    private static $queries = [];
    private static $enabled = false;

    /**
     * Enable query logging
     */
    public static function enable(): void
    {
        self::$enabled = true;
    }

    /**
     * Disable query logging
     */
    public static function disable(): void
    {
        self::$enabled = false;
    }

    /**
     * Log a query
     */
    public static function log(string $sql, array $params = [], float $duration = 0, string $caller = ''): void
    {
        if (!self::$enabled) {
            return;
        }

        self::$queries[] = [
            'sql' => $sql,
            'params' => $params,
            'duration' => $duration,
            'caller' => $caller ?: self::getCaller(),
            'timestamp' => microtime(true),
            'memory' => memory_get_usage(true),
        ];

        // Log slow queries immediately
        if ($duration >= self::SLOW_QUERY_THRESHOLD) {
            self::logSlowQuery($sql, $params, $duration, $caller);
        }
    }

    /**
     * Get caller information
     */
    private static function getCaller(): string
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 4);
        foreach ($trace as $frame) {
            if (isset($frame['file']) && strpos($frame['file'], 'query_logger.php') === false) {
                return ($frame['file'] ?? 'unknown') . ':' . ($frame['line'] ?? '?');
            }
        }
        return 'unknown';
    }

    /**
     * Log slow query to file
     */
    private static function logSlowQuery(string $sql, array $params, float $duration, string $caller): void
    {
        $logDir = dirname(self::LOG_FILE);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        $slowLogFile = $logDir . '/slow_queries.log';

        $entry = sprintf(
            "[%s] SLOW QUERY (%dms) at %s\nSQL: %s\nParams: %s\n\n",
            date('Y-m-d H:i:s'),
            $duration,
            $caller,
            $sql,
            json_encode($params)
        );

        file_put_contents($slowLogFile, $entry, FILE_APPEND);
    }

    /**
     * Get all logged queries for current request
     */
    public static function getQueries(): array
    {
        return self::$queries;
    }

    /**
     * Get query statistics
     */
    public static function getStats(): array
    {
        $totalTime = array_sum(array_column(self::$queries, 'duration'));
        $slowQueries = array_filter(self::$queries, fn($q) => $q['duration'] >= self::SLOW_QUERY_THRESHOLD);

        return [
            'total_queries' => count(self::$queries),
            'total_time' => $totalTime,
            'avg_time' => count(self::$queries) > 0 ? $totalTime / count(self::$queries) : 0,
            'slow_queries' => count($slowQueries),
            'slowest_query' => !empty(self::$queries) ? max(array_column(self::$queries, 'duration')) : 0,
        ];
    }

    /**
     * Analyze queries for N+1 patterns
     */
    public static function analyzeNPlusOne(): array
    {
        $sqlPatterns = [];

        foreach (self::$queries as $query) {
            // Normalize SQL (remove values to find patterns)
            $normalized = preg_replace('/\b\d+\b/', '?', $query['sql']);
            $normalized = preg_replace('/\'[^\']*\'/', '?', $normalized);

            if (!isset($sqlPatterns[$normalized])) {
                $sqlPatterns[$normalized] = [
                    'count' => 0,
                    'total_time' => 0,
                    'example' => $query['sql'],
                    'callers' => [],
                ];
            }

            $sqlPatterns[$normalized]['count']++;
            $sqlPatterns[$normalized]['total_time'] += $query['duration'];
            $sqlPatterns[$normalized]['callers'][] = $query['caller'];
        }

        // Find potential N+1 queries (same query executed multiple times)
        $suspected = array_filter($sqlPatterns, fn($p) => $p['count'] > 5);

        // Sort by count descending
        uasort($suspected, fn($a, $b) => $b['count'] <=> $a['count']);

        return $suspected;
    }

    /**
     * Generate HTML report
     */
    public static function renderReport(): string
    {
        if (!self::$enabled) {
            return '<p>Query logging is disabled. Enable with QueryLogger::enable()</p>';
        }

        $stats = self::getStats();
        $nPlusOne = self::analyzeNPlusOne();

        $html = '<div style="background: #f5f5f5; padding: 20px; margin: 20px; border-radius: 5px; font-family: monospace;">';
        $html .= '<h2>Query Performance Report</h2>';

        // Statistics
        $html .= '<h3>Statistics</h3>';
        $html .= '<ul>';
        $html .= sprintf('<li>Total Queries: %d</li>', $stats['total_queries']);
        $html .= sprintf('<li>Total Time: %.2fms</li>', $stats['total_time']);
        $html .= sprintf('<li>Average Time: %.2fms</li>', $stats['avg_time']);
        $html .= sprintf('<li>Slow Queries: %d (>%dms)</li>', $stats['slow_queries'], self::SLOW_QUERY_THRESHOLD);
        $html .= sprintf('<li>Slowest Query: %.2fms</li>', $stats['slowest_query']);
        $html .= '</ul>';

        // N+1 Analysis
        if (!empty($nPlusOne)) {
            $html .= '<h3>Potential N+1 Queries</h3>';
            $html .= '<table style="width: 100%; border-collapse: collapse;">';
            $html .= '<tr style="background: #ddd;"><th>Count</th><th>Total Time</th><th>SQL</th></tr>';

            foreach (array_slice($nPlusOne, 0, 10) as $pattern) {
                $html .= '<tr style="border-bottom: 1px solid #ccc;">';
                $html .= sprintf('<td>%d</td>', $pattern['count']);
                $html .= sprintf('<td>%.2fms</td>', $pattern['total_time']);
                $html .= sprintf('<td style="font-size: 11px;">%s</td>', htmlspecialchars(substr($pattern['example'], 0, 100)));
                $html .= '</tr>';
            }

            $html .= '</table>';
        }

        // All queries
        $html .= '<h3>All Queries</h3>';
        $html .= '<table style="width: 100%; border-collapse: collapse; font-size: 11px;">';
        $html .= '<tr style="background: #ddd;"><th>#</th><th>Time</th><th>SQL</th><th>Caller</th></tr>';

        foreach (self::$queries as $i => $query) {
            $color = $query['duration'] >= self::SLOW_QUERY_THRESHOLD ? 'background: #ffcccc;' : '';
            $html .= sprintf('<tr style="border-bottom: 1px solid #ccc; %s">', $color);
            $html .= sprintf('<td>%d</td>', $i + 1);
            $html .= sprintf('<td>%.2fms</td>', $query['duration']);
            $html .= sprintf('<td>%s</td>', htmlspecialchars(substr($query['sql'], 0, 100)));
            $html .= sprintf('<td>%s</td>', htmlspecialchars($query['caller']));
            $html .= '</tr>';
        }

        $html .= '</table>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Wrap PDO statement to log execution time
     */
    public static function wrapStatement(PDOStatement $stmt, string $sql): PDOStatement
    {
        if (!self::$enabled) {
            return $stmt;
        }

        // Can't easily wrap PDOStatement, so just log after execute
        // Developers should manually call QueryLogger::log() after $stmt->execute()

        return $stmt;
    }
}

/**
 * Helper function to log query execution
 *
 * Usage:
 * ```php
 * $start = microtime(true);
 * $stmt->execute($params);
 * cms_log_query($sql, $params, microtime(true) - $start);
 * ```
 */
function cms_log_query(string $sql, array $params = [], float $duration = 0): void
{
    QueryLogger::log($sql, $params, $duration * 1000); // Convert to ms
}

/**
 * Enable query logging for debugging
 * Add this to index.php or specific pages:
 *
 * ```php
 * if (isset($_GET['debug_queries'])) {
 *     QueryLogger::enable();
 *     register_shutdown_function(function() {
 *         echo QueryLogger::renderReport();
 *     });
 * }
 * ```
 */
