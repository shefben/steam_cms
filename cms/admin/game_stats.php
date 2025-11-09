<?php
require_once 'admin_header.php';
require_once dirname(__DIR__) . '/game_stats.php';

cms_require_permission('manage_game_stats');

$db         = cms_get_db();
$csrfToken  = cms_get_csrf_token();
$messages   = [];
$errors     = [];
$formData   = [
    'id'                       => 0,
    'game_name'                => '',
    'game_website'             => '',
    'current_players'          => '',
    'current_servers'          => '',
    'player_minutes_per_month' => '',
    'display_order'            => '',
];

if (!empty($_SESSION['game_stats_notice'])) {
    $messages[] = $_SESSION['game_stats_notice'];
    unset($_SESSION['game_stats_notice']);
}
if (!empty($_SESSION['game_stats_error'])) {
    $errors[] = $_SESSION['game_stats_error'];
    unset($_SESSION['game_stats_error']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!cms_verify_csrf($_POST['csrf_token'] ?? '')) {
        http_response_code(400);
        echo '<p>Invalid CSRF token.</p>';
        include 'admin_footer.php';
        exit;
    }

    if (isset($_POST['save_settings'])) {
        $avgUsers       = cms_game_stats_parse_int($_POST['avg_users'] ?? '0');
        $avgMinutes     = cms_game_stats_parse_minutes($_POST['avg_minutes'] ?? '0');
        $lastUpdated    = trim((string)($_POST['last_updated_text'] ?? ''));
        $currentPlayers = cms_game_stats_parse_int($_POST['current_players_total'] ?? '0');
        $peakPlayers    = cms_game_stats_parse_int($_POST['peak_players_total'] ?? '0');
        $currentServers = cms_game_stats_parse_int($_POST['current_servers_total'] ?? '0');
        $peakServers    = cms_game_stats_parse_int($_POST['peak_servers_total'] ?? '0');

        cms_set_setting('game_stats_avg_users', (string)$avgUsers);
        cms_set_setting('game_stats_avg_minutes', (string)$avgMinutes);
        cms_set_setting('game_stats_last_updated_text', $lastUpdated);
        cms_set_setting('game_stats_current_players_total', (string)$currentPlayers);
        cms_set_setting('game_stats_peak_players_total', (string)$peakPlayers);
        cms_set_setting('game_stats_current_servers_total', (string)$currentServers);
        cms_set_setting('game_stats_peak_servers_total', (string)$peakServers);

        cms_admin_log('Updated game stats overview settings');
        $_SESSION['game_stats_notice'] = 'Game stats settings saved.';
        header('Location: game_stats.php');
        exit;
    }

    if (isset($_POST['save_game'])) {
        $id       = cms_game_stats_parse_int($_POST['id'] ?? '0');
        $name     = trim((string)($_POST['game_name'] ?? ''));
        $website  = trim((string)($_POST['game_website'] ?? ''));
        $players  = cms_game_stats_parse_int($_POST['current_players'] ?? '0');
        $servers  = cms_game_stats_parse_int($_POST['current_servers'] ?? '0');
        $minutes  = cms_game_stats_parse_minutes($_POST['player_minutes_per_month'] ?? '0');
        $order    = cms_game_stats_parse_int($_POST['display_order'] ?? '0');

        if ($name === '') {
            $errors[] = 'Game name is required.';
        }

        if ($order <= 0) {
            $order = cms_game_stats_next_order($db);
        }

        $formData = [
            'id'                       => $id,
            'game_name'                => $name,
            'game_website'             => $website,
            'current_players'          => (string)$players,
            'current_servers'          => (string)$servers,
            'player_minutes_per_month' => $_POST['player_minutes_per_month'] ?? (string)$minutes,
            'display_order'            => (string)$order,
        ];

        if (empty($errors)) {
            $payload = [
                'game_name'               => $name,
                'game_website'            => $website !== '' ? $website : null,
                'current_players'         => $players,
                'current_servers'         => $servers,
                'player_minutes_per_month' => $minutes,
                'display_order'           => $order,
            ];

            if ($id > 0) {
                cms_game_stats_update($db, $id, $payload);
                cms_admin_log('Updated game stat #' . $id . ' (' . $name . ')');
                $_SESSION['game_stats_notice'] = 'Game stat updated.';
            } else {
                $newId = cms_game_stats_insert($db, $payload);
                cms_admin_log('Created game stat #' . $newId . ' (' . $name . ')');
                $_SESSION['game_stats_notice'] = 'Game stat added.';
            }

            header('Location: game_stats.php');
            exit;
        }
    }

    if (isset($_POST['delete_game'])) {
        $id = cms_game_stats_parse_int($_POST['delete_game']);
        if ($id > 0) {
            cms_game_stats_delete($db, $id);
            cms_admin_log('Deleted game stat #' . $id);
            $_SESSION['game_stats_notice'] = 'Game stat deleted.';
        }
        header('Location: game_stats.php');
        exit;
    }
}

$games = cms_game_stats_fetch_all($db);

$settings = [
    'avg_users'            => cms_get_setting('game_stats_avg_users', ''),
    'avg_minutes'          => cms_get_setting('game_stats_avg_minutes', ''),
    'last_updated_text'    => cms_get_setting('game_stats_last_updated_text', ''),
    'current_players'      => cms_get_setting('game_stats_current_players_total', ''),
    'peak_players'         => cms_get_setting('game_stats_peak_players_total', ''),
    'current_servers'      => cms_get_setting('game_stats_current_servers_total', ''),
    'peak_servers'         => cms_get_setting('game_stats_peak_servers_total', ''),
];
?>
<div class="admin-content game-stats-admin">
    <h2>Game Statistics</h2>
    <style>
        .game-stats-admin .card-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            align-items: start;
        }
        @media (max-width: 960px) {
            .game-stats-admin .card-grid {
                grid-template-columns: 1fr;
            }
        }
        .game-stats-admin .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 15px;
        }
        .game-stats-admin .inline-form {
            display: inline;
        }
    </style>
    <?php foreach ($messages as $message): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
    <?php endforeach; ?>
    <?php foreach ($errors as $error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endforeach; ?>

    <div class="card">
        <div class="card-header">
            <h3>Overview Settings</h3>
        </div>
        <div class="card-body">
            <form method="post" class="game-stats-settings">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                <input type="hidden" name="save_settings" value="1">
                <div class="form-row">
                    <div class="form-group">
                        <label for="avg_users">Average Unique Users / Month</label>
                        <input id="avg_users" name="avg_users" type="text" value="<?php echo htmlspecialchars((string)$settings['avg_users']); ?>" class="form-control" placeholder="2,357,340">
                    </div>
                    <div class="form-group">
                        <label for="avg_minutes">Player Minutes / Month</label>
                        <input id="avg_minutes" name="avg_minutes" type="text" value="<?php echo htmlspecialchars((string)$settings['avg_minutes']); ?>" class="form-control" placeholder="9.434 billion">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="current_players_total">Current Players (summary)</label>
                        <input id="current_players_total" name="current_players_total" type="text" value="<?php echo htmlspecialchars((string)$settings['current_players']); ?>" class="form-control" placeholder="90,468">
                    </div>
                    <div class="form-group">
                        <label for="peak_players_total">Peak Players</label>
                        <input id="peak_players_total" name="peak_players_total" type="text" value="<?php echo htmlspecialchars((string)$settings['peak_players']); ?>" class="form-control" placeholder="276,210">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="current_servers_total">Current Servers (summary)</label>
                        <input id="current_servers_total" name="current_servers_total" type="text" value="<?php echo htmlspecialchars((string)$settings['current_servers']); ?>" class="form-control" placeholder="72,473">
                    </div>
                    <div class="form-group">
                        <label for="peak_servers_total">Peak Servers</label>
                        <input id="peak_servers_total" name="peak_servers_total" type="text" value="<?php echo htmlspecialchars((string)$settings['peak_servers']); ?>" class="form-control" placeholder="214,041">
                    </div>
                </div>
                <div class="form-group" style="margin-top: 20px;">
                    <label for="last_updated_text">Last Updated Text</label>
                    <input id="last_updated_text" name="last_updated_text" type="text" value="<?php echo htmlspecialchars((string)$settings['last_updated_text']); ?>" class="form-control" placeholder="9:19pm PST (05:19 GMT), April 13 2005">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Overview</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card-grid">
        <div class="card">
            <div class="card-header">
                <h3>Games</h3>
            </div>
            <div class="card-body">
                <table class="data-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Game</th>
                        <th>Current Players</th>
                        <th>Current Servers</th>
                        <th>Player Minutes / Month</th>
                        <th class="actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($games as $game): ?>
                        <tr>
                            <td><?php echo (int)$game['display_order']; ?></td>
                            <td><?php echo htmlspecialchars($game['game_name']); ?></td>
                            <td><?php echo number_format((int)$game['current_players']); ?></td>
                            <td><?php echo number_format((int)$game['current_servers']); ?></td>
                            <td><?php echo htmlspecialchars(cms_game_stats_format_minutes((int)$game['player_minutes_per_month'])['text']); ?></td>
                            <td class="actions">
                                <button type="button"
                                        class="btn btn-small btn-primary edit-game"
                                        data-id="<?php echo (int)$game['id']; ?>"
                                        data-name="<?php echo htmlspecialchars($game['game_name']); ?>"
                                        data-website="<?php echo htmlspecialchars($game['game_website'] ?? ''); ?>"
                                        data-players="<?php echo (int)$game['current_players']; ?>"
                                        data-servers="<?php echo (int)$game['current_servers']; ?>"
                                        data-minutes="<?php echo (int)$game['player_minutes_per_month']; ?>"
                                        data-order="<?php echo (int)$game['display_order']; ?>">
                                    Edit
                                </button>
                                <form method="post" class="inline-form" onsubmit="return confirm('Delete this game stat?');">
                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                                    <input type="hidden" name="delete_game" value="<?php echo (int)$game['id']; ?>">
                                    <button type="submit" class="btn btn-small btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (!$games): ?>
                        <tr>
                            <td colspan="6">No game statistics found.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 id="game-form-title">Add Game</h3>
            </div>
            <div class="card-body">
                <form method="post" id="game-form">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                    <input type="hidden" name="save_game" value="1">
                    <input type="hidden" name="id" id="game-id" value="<?php echo (int)$formData['id']; ?>">
                    <div class="form-group">
                        <label for="game-name">Game Name</label>
                        <input id="game-name" name="game_name" type="text" class="form-control" value="<?php echo htmlspecialchars($formData['game_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="game-website">Game Website</label>
                        <input id="game-website" name="game_website" type="text" class="form-control" value="<?php echo htmlspecialchars($formData['game_website']); ?>" placeholder="http://example.com">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="game-players">Current Players</label>
                            <input id="game-players" name="current_players" type="text" class="form-control" value="<?php echo htmlspecialchars($formData['current_players']); ?>" placeholder="56,612">
                        </div>
                        <div class="form-group">
                            <label for="game-servers">Current Servers</label>
                            <input id="game-servers" name="current_servers" type="text" class="form-control" value="<?php echo htmlspecialchars($formData['current_servers']); ?>" placeholder="46,507">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="game-minutes">Player Minutes / Month</label>
                        <input id="game-minutes" name="player_minutes_per_month" type="text" class="form-control" value="<?php echo htmlspecialchars($formData['player_minutes_per_month']); ?>" placeholder="3.454 billion">
                    </div>
                    <div class="form-group">
                        <label for="game-order">Display Order</label>
                        <input id="game-order" name="display_order" type="text" class="form-control" value="<?php echo htmlspecialchars($formData['display_order']); ?>" placeholder="Auto">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-warning" id="game-form-reset">Clear</button>
                        <button type="submit" class="btn btn-success">Save Game</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
(function () {
    const form = document.getElementById('game-form');
    const title = document.getElementById('game-form-title');
    const resetBtn = document.getElementById('game-form-reset');
    const idField = document.getElementById('game-id');
    const nameField = document.getElementById('game-name');
    const websiteField = document.getElementById('game-website');
    const playersField = document.getElementById('game-players');
    const serversField = document.getElementById('game-servers');
    const minutesField = document.getElementById('game-minutes');
    const orderField = document.getElementById('game-order');

    document.querySelectorAll('.edit-game').forEach(function (button) {
        button.addEventListener('click', function () {
            idField.value = button.dataset.id || '0';
            nameField.value = button.dataset.name || '';
            websiteField.value = button.dataset.website || '';
            playersField.value = button.dataset.players || '';
            serversField.value = button.dataset.servers || '';
            minutesField.value = button.dataset.minutes || '';
            orderField.value = button.dataset.order || '';
            title.textContent = 'Edit Game';
            nameField.focus();
        });
    });

    function resetForm() {
        idField.value = '0';
        form.reset();
        title.textContent = 'Add Game';
    }

    resetBtn.addEventListener('click', function () {
        resetForm();
    });
})();
</script>
<?php
include 'admin_footer.php';
