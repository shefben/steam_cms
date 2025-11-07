<?php

declare(strict_types=1);

/**
 * Cursor-Based Pagination (Optimization #13)
 *
 * More efficient than OFFSET-based pagination for large datasets
 * Uses indexed columns for fast seeking instead of counting rows
 *
 * PERFORMANCE IMPACT: 10-100x faster on large tables (10k+ rows)
 * OFFSET 10000: ~500ms, Cursor: ~5ms
 */

class CursorPagination
{
    /**
     * Fetch paginated results using cursor
     *
     * @param PDO $db Database connection
     * @param string $table Table name
     * @param string $cursorColumn Column to use for cursor (must be indexed, usually id or created_at)
     * @param mixed $cursor Cursor value (null for first page)
     * @param int $limit Number of results per page
     * @param string $direction 'next' or 'prev'
     * @param array $where WHERE conditions ['column' => 'value']
     * @param string $orderDirection 'ASC' or 'DESC'
     * @return array ['data' => rows, 'next_cursor' => value, 'prev_cursor' => value, 'has_more' => bool]
     */
    public static function paginate(
        PDO $db,
        string $table,
        string $cursorColumn = 'id',
        $cursor = null,
        int $limit = 20,
        string $direction = 'next',
        array $where = [],
        string $orderDirection = 'DESC'
    ): array {
        $params = [];
        $conditions = [];

        // Add WHERE conditions
        foreach ($where as $column => $value) {
            $conditions[] = "$column = ?";
            $params[] = $value;
        }

        // Add cursor condition
        if ($cursor !== null) {
            if ($direction === 'next') {
                $operator = $orderDirection === 'DESC' ? '<' : '>';
            } else {
                $operator = $orderDirection === 'DESC' ? '>' : '<';
            }
            $conditions[] = "$cursorColumn $operator ?";
            $params[] = $cursor;
        }

        $whereClause = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';

        // Fetch one extra to check if there are more results
        $fetchLimit = $limit + 1;

        $sql = "SELECT * FROM $table
                $whereClause
                ORDER BY $cursorColumn $orderDirection
                LIMIT $fetchLimit";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if there are more results
        $hasMore = count($results) > $limit;
        if ($hasMore) {
            array_pop($results); // Remove the extra row
        }

        // Get cursors
        $nextCursor = null;
        $prevCursor = null;

        if (!empty($results)) {
            $lastRow = end($results);
            $firstRow = reset($results);

            $nextCursor = $hasMore ? $lastRow[$cursorColumn] : null;
            $prevCursor = $firstRow[$cursorColumn];
        }

        return [
            'data' => $results,
            'next_cursor' => $nextCursor,
            'prev_cursor' => $prevCursor,
            'has_more' => $hasMore,
            'count' => count($results),
        ];
    }

    /**
     * Encode cursor for URL
     */
    public static function encodeCursor($cursor): string
    {
        if ($cursor === null) {
            return '';
        }
        return base64_encode(json_encode($cursor));
    }

    /**
     * Decode cursor from URL
     */
    public static function decodeCursor(string $encoded)
    {
        if ($encoded === '') {
            return null;
        }
        return json_decode(base64_decode($encoded), true);
    }

    /**
     * Generate pagination links
     */
    public static function generateLinks(
        string $baseUrl,
        $nextCursor,
        $prevCursor,
        array $extraParams = []
    ): array {
        $params = http_build_query($extraParams);
        $separator = $params ? '&' : '';

        return [
            'next' => $nextCursor ? $baseUrl . '?' . $params . $separator . 'cursor=' . self::encodeCursor($nextCursor) : null,
            'prev' => $prevCursor ? $baseUrl . '?' . $params . $separator . 'cursor=' . self::encodeCursor($prevCursor) . '&dir=prev' : null,
        ];
    }
}

/**
 * Example usage:
 *
 * ```php
 * $db = cms_get_db();
 * $cursor = $_GET['cursor'] ?? null;
 * $cursor = CursorPagination::decodeCursor($cursor);
 *
 * $result = CursorPagination::paginate(
 *     $db,
 *     'news',
 *     'publish_date', // Use indexed timestamp column
 *     $cursor,
 *     20, // items per page
 *     $_GET['dir'] ?? 'next',
 *     ['status' => 'published'], // WHERE conditions
 *     'DESC' // order direction
 * );
 *
 * $links = CursorPagination::generateLinks(
 *     '/news',
 *     $result['next_cursor'],
 *     $result['prev_cursor']
 * );
 *
 * // In template:
 * foreach ($result['data'] as $article) {
 *     // Display article
 * }
 *
 * if ($links['next']) {
 *     echo '<a href="' . $links['next'] . '">Next →</a>';
 * }
 * if ($links['prev']) {
 *     echo '<a href="' . $links['prev'] . '">← Previous</a>';
 * }
 * ```
 */
