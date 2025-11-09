<?php
declare(strict_types=1);

/**
 * Utility functions for managing Steam game statistics records.
 */

/**
 * Fetch all game stats ordered by display order then game name.
 *
 * @return array<int, array<string, mixed>>
 */
function cms_game_stats_fetch_all(PDO $db): array
{
    $sql = 'SELECT id, game_name, game_website, current_players, current_servers, player_minutes_per_month, display_order
            FROM game_stats
            ORDER BY display_order ASC, game_name ASC';

    try {
        $stmt = $db->query($sql);
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            return [];
        }
        throw $e;
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}

function cms_game_stats_get(PDO $db, int $id): ?array
{
    try {
        $stmt = $db->prepare('SELECT id, game_name, game_website, current_players, current_servers, player_minutes_per_month, display_order FROM game_stats WHERE id = ?');
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            return null;
        }
        throw $e;
    }

    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row ?: null;
}

function cms_game_stats_next_order(PDO $db): int
{
    try {
        $max = $db->query('SELECT MAX(display_order) FROM game_stats');
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            return 1;
        }
        throw $e;
    }
    $value = $max->fetchColumn();
    return $value ? ((int)$value + 1) : 1;
}

function cms_game_stats_insert(PDO $db, array $data): int
{
    $sql = 'INSERT INTO game_stats (game_name, game_website, current_players, current_servers, player_minutes_per_month, display_order)
            VALUES (:name, :website, :players, :servers, :minutes, :order)';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':name'    => $data['game_name'],
        ':website' => $data['game_website'],
        ':players' => $data['current_players'],
        ':servers' => $data['current_servers'],
        ':minutes' => $data['player_minutes_per_month'],
        ':order'   => $data['display_order'],
    ]);
    return (int)$db->lastInsertId();
}

function cms_game_stats_update(PDO $db, int $id, array $data): void
{
    $sql = 'UPDATE game_stats
            SET game_name = :name,
                game_website = :website,
                current_players = :players,
                current_servers = :servers,
                player_minutes_per_month = :minutes,
                display_order = :order,
                updated_at = CURRENT_TIMESTAMP
            WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':name'    => $data['game_name'],
        ':website' => $data['game_website'],
        ':players' => $data['current_players'],
        ':servers' => $data['current_servers'],
        ':minutes' => $data['player_minutes_per_month'],
        ':order'   => $data['display_order'],
        ':id'      => $id,
    ]);
}

function cms_game_stats_delete(PDO $db, int $id): void
{
    try {
        $stmt = $db->prepare('DELETE FROM game_stats WHERE id = ?');
    } catch (PDOException $e) {
        if ($e->getCode() === '42S02') {
            return;
        }
        throw $e;
    }
    $stmt->execute([$id]);
}

function cms_game_stats_format_minutes(int $minutes): array
{
    if ($minutes >= 1_000_000_000) {
        return [
            'value' => $minutes,
            'text'  => number_format($minutes / 1_000_000_000, 3) . ' billion',
            'unit'  => 'billion',
        ];
    }
    if ($minutes >= 1_000_000) {
        return [
            'value' => $minutes,
            'text'  => number_format($minutes / 1_000_000, 3) . ' million',
            'unit'  => 'million',
        ];
    }
    if ($minutes >= 1_000) {
        return [
            'value' => $minutes,
            'text'  => number_format($minutes / 1_000, 3) . ' thousand',
            'unit'  => 'thousand',
        ];
    }
    return [
        'value' => $minutes,
        'text'  => number_format($minutes),
        'unit'  => 'minutes',
    ];
}

function cms_game_stats_minutes_to_years(int $minutes): int
{
    if ($minutes <= 0) {
        return 0;
    }
    $minutesPerYear = 60 * 24 * 365;
    return (int)round($minutes / $minutesPerYear);
}

function cms_game_stats_parse_int(string $value): int
{
    $normalized = preg_replace('/[^0-9-]/', '', $value);
    if ($normalized === '' || $normalized === '-' || $normalized === null) {
        return 0;
    }
    return (int)$normalized;
}

function cms_game_stats_parse_minutes(string $value): int
{
    $trimmed = trim($value);
    if ($trimmed === '') {
        return 0;
    }
    $lower = strtolower(str_replace(',', '', $trimmed));
    if (preg_match('/^([0-9]*\.?[0-9]+)\s*(billion|million|thousand|hundred)?$/', $lower, $matches)) {
        $number = (float)$matches[1];
        $unit   = $matches[2] ?? '';
        $multipliers = [
            'billion'  => 1_000_000_000,
            'million'  => 1_000_000,
            'thousand' => 1_000,
            'hundred'  => 100,
        ];
        $multiplier = $multipliers[$unit] ?? 1;
        return (int)round($number * $multiplier);
    }
    return cms_game_stats_parse_int($lower);
}
