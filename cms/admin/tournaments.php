<?php
declare(strict_types=1);

require_once 'admin_header.php';
require_once __DIR__ . '/../tournaments_service.php';

cms_require_permission('manage_pages');

$service = cms_tournaments_service();
$csrfToken = cms_get_csrf_token();

$filters = [
    'status' => $_GET['status'] ?? '',
    'query' => trim($_GET['query'] ?? ''),
    'calendar' => $_GET['calendar'] ?? '',
    'start_date' => $_GET['start_date'] ?? '',
    'end_date' => $_GET['end_date'] ?? '',
];

$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 20;
$adminId = cms_current_admin();

$redirectBase = array_filter([
    'status' => $filters['status'],
    'query' => $filters['query'],
    'calendar' => $filters['calendar'],
    'start_date' => $filters['start_date'],
    'end_date' => $filters['end_date'],
    'page' => $page > 1 ? $page : null,
]);

$redirect = static function (array $extra = []) use ($redirectBase): void {
    $query = array_filter(array_merge($redirectBase, $extra), static function ($value) {
        return $value !== null && $value !== '';
    });
    $url = 'tournaments.php';
    if ($query !== []) {
        $url .= '?' . http_build_query($query);
    }
    header('Location: ' . $url);
    exit;
};

$flash = $_SESSION['tournament_admin_flash'] ?? [];
$errors = $_SESSION['tournament_admin_errors'] ?? [];
unset($_SESSION['tournament_admin_flash'], $_SESSION['tournament_admin_errors']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!cms_verify_csrf($_POST['csrf_token'] ?? '')) {
        $_SESSION['tournament_admin_errors'][] = 'Invalid request token. Please try again.';
        $redirect();
    }

    $targetView = isset($_POST['view']) ? (int) $_POST['view'] : null;

    if (isset($_POST['bulk_action'])) {
        $action = $_POST['bulk_action'];
        $selected = array_map('intval', $_POST['selected'] ?? []);
        $notes = trim($_POST['bulk_notes'] ?? '');
        $flags = [
            'show_on_calendar' => isset($_POST['bulk_show_on_calendar']),
            'show_on_sidebar' => isset($_POST['bulk_show_on_sidebar']),
            'show_on_landing' => isset($_POST['bulk_show_on_landing']),
        ];

        if ($selected === []) {
            $_SESSION['tournament_admin_errors'][] = 'Select at least one submission before applying a bulk action.';
            $redirect();
        }

        $statusMap = [
            'approve' => 'approved',
            'reject' => 'rejected',
            'pending' => 'pending',
        ];
        if (!isset($statusMap[$action])) {
            $_SESSION['tournament_admin_errors'][] = 'Unsupported bulk action.';
            $redirect();
        }

        $status = $statusMap[$action];
        $count = $service->bulkSetStatus($selected, $status, $adminId, $notes !== '' ? $notes : null, $flags);
        $_SESSION['tournament_admin_flash'][] = [
            'type' => 'success',
            'message' => sprintf('Updated %d submission(s) to %s.', $count, ucfirst($status)),
        ];
        $redirect();
    }

    if (isset($_POST['set_status'])) {
        $status = $_POST['set_status'];
        $tournamentId = (int) ($_POST['tournament_id'] ?? 0);
        $notes = trim($_POST['status_notes'] ?? '');
        $flags = [
            'show_on_calendar' => isset($_POST['status_show_on_calendar']),
            'show_on_sidebar' => isset($_POST['status_show_on_sidebar']),
            'show_on_landing' => isset($_POST['status_show_on_landing']),
        ];

        if ($tournamentId <= 0) {
            $_SESSION['tournament_admin_errors'][] = 'Invalid tournament submission.';
            $redirect();
        }

        try {
            $service->setStatus($tournamentId, $status, $adminId, $notes !== '' ? $notes : null, $flags);
            $_SESSION['tournament_admin_flash'][] = [
                'type' => 'success',
                'message' => 'Status updated successfully.',
            ];
        } catch (Throwable $e) {
            $_SESSION['tournament_admin_errors'][] = $e->getMessage();
        }

        $redirect(['view' => $tournamentId]);
    }

    if (isset($_POST['update_tournament'])) {
        $tournamentId = (int) ($_POST['tournament_id'] ?? 0);
        if ($tournamentId <= 0) {
            $_SESSION['tournament_admin_errors'][] = 'Invalid tournament submission.';
            $redirect();
        }

        $updateErrors = [];
        $title = trim($_POST['title'] ?? '');
        if ($title === '') {
            $updateErrors[] = 'Tournament title cannot be empty.';
        }

        $startDate = trim($_POST['start_date'] ?? '');
        if ($startDate !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $startDate)) {
            $updateErrors[] = 'Start date must be in YYYY-MM-DD format.';
        }
        $endDate = trim($_POST['end_date'] ?? '');
        if ($endDate !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $endDate)) {
            $updateErrors[] = 'End date must be in YYYY-MM-DD format.';
        }

        $startTime = trim($_POST['start_time'] ?? '');
        if ($startTime !== '' && !preg_match('/^\d{2}:\d{2}$/', $startTime)) {
            $updateErrors[] = 'Start time must be in HH:MM format.';
        }
        $endTime = trim($_POST['end_time'] ?? '');
        if ($endTime !== '' && !preg_match('/^\d{2}:\d{2}$/', $endTime)) {
            $updateErrors[] = 'End time must be in HH:MM format.';
        }

        $expectedParticipants = trim($_POST['expected_participants'] ?? '');
        if ($expectedParticipants !== '' && !ctype_digit($expectedParticipants)) {
            $updateErrors[] = 'Expected participants must be numeric.';
        }

        $tempRequested = isset($_POST['temporary_accounts_requested']);
        $tempQuantityRaw = trim($_POST['temporary_accounts_quantity'] ?? '');
        if ($tempRequested && ($tempQuantityRaw === '' || !ctype_digit($tempQuantityRaw))) {
            $updateErrors[] = 'Temporary account quantity must be provided as a positive number when requesting accounts.';
        }

        if ($updateErrors) {
            $_SESSION['tournament_admin_errors'] = array_merge($_SESSION['tournament_admin_errors'] ?? [], $updateErrors);
            $redirect(['view' => $tournamentId]);
        }

        $payload = [
            'title' => $title,
            'start_date' => $startDate !== '' ? $startDate : null,
            'end_date' => $endDate !== '' ? $endDate : null,
            'start_time' => $startTime !== '' ? $startTime . ':00' : null,
            'end_time' => $endTime !== '' ? $endTime . ':00' : null,
            'timezone' => trim($_POST['timezone'] ?? '') ?: null,
            'event_email' => trim($_POST['event_email'] ?? '') ?: null,
            'event_website' => trim($_POST['event_website'] ?? '') ?: null,
            'lan_or_online' => $_POST['lan_or_online'] !== '' ? $_POST['lan_or_online'] : null,
            'expected_participants' => $expectedParticipants !== '' ? (int) $expectedParticipants : null,
            'show_on_calendar' => isset($_POST['show_on_calendar']),
            'show_on_sidebar' => isset($_POST['show_on_sidebar']),
            'show_on_landing' => isset($_POST['show_on_landing']),
            'temporary_accounts_requested' => $tempRequested,
            'temporary_accounts_quantity' => ($tempQuantityRaw !== '' ? (int) $tempQuantityRaw : null),
            'moderator_notes' => trim($_POST['moderator_notes'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'registration_notes' => trim($_POST['registration_notes'] ?? ''),
            'registration_types' => array_map('strval', $_POST['registration_types'] ?? []),
            'games' => array_map('strval', $_POST['games'] ?? []),
        ];

        try {
            $service->updateTournament($tournamentId, $payload, $adminId);
            $_SESSION['tournament_admin_flash'][] = [
                'type' => 'success',
                'message' => 'Tournament details saved.',
            ];
        } catch (Throwable $e) {
            $_SESSION['tournament_admin_errors'][] = $e->getMessage();
        }

        $redirect(['view' => $tournamentId]);
    }

    // Unknown action
    $redirect($targetView ? ['view' => $targetView] : []);
}

$summary = $service->getStatusSummary();
$list = $service->listTournaments($filters, $perPage, ($page - 1) * $perPage);
$rows = $list['rows'];
$total = $list['total'];
$pages = max(1, (int) ceil($total / $perPage));

if ($page > $pages) {
    $page = $pages;
}

$viewId = isset($_GET['view']) ? (int) $_GET['view'] : null;
$selectedTournament = null;
if ($viewId) {
    $selectedTournament = $service->getTournament($viewId);
    if (!$selectedTournament) {
        $errors[] = 'The requested submission could not be found. It may have been removed.';
    }
}

$gameOptions = $service->getGameOptions();
$registrationOptions = $service->getRegistrationOptions();
$statusLabels = [
    'pending' => 'Pending',
    'approved' => 'Approved',
    'rejected' => 'Rejected',
];
?>
<div class="admin-content tournament-admin">
    <div class="content-header">
        <h2>Tournament Management</h2>
        <div class="current-theme">Workflow Tools</div>
    </div>

    <?php foreach ($flash as $message): ?>
        <div class="alert alert-<?php echo htmlspecialchars($message['type']); ?>">
            <?php echo htmlspecialchars($message['message']); ?>
        </div>
    <?php endforeach; ?>

    <?php foreach ($errors as $error): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endforeach; ?>

    <div class="stats-grid">
        <div class="stat-card warning">
            <div class="stat-number"><?php echo (int) $summary['pending']; ?></div>
            <div class="stat-label">Pending Review</div>
        </div>
        <div class="stat-card success">
            <div class="stat-number"><?php echo (int) $summary['upcoming']; ?></div>
            <div class="stat-label">Approved & Upcoming</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo (int) $summary['calendar_requests']; ?></div>
            <div class="stat-label">Calendar Requests Pending</div>
        </div>
    </div>

    <div class="filter-panel">
        <form method="get">
            <div class="filter-group">
                <label for="query">Search</label>
                <input type="text" id="query" name="query" value="<?php echo htmlspecialchars($filters['query']); ?>" placeholder="Organizer or title">
            </div>
            <div class="filter-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="">All statuses</option>
                    <?php foreach ($statusLabels as $key => $label): ?>
                        <option value="<?php echo $key; ?>" <?php if ($filters['status'] === $key) echo 'selected'; ?>><?php echo $label; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="calendar">Calendar</label>
                <select id="calendar" name="calendar">
                    <option value="">Any</option>
                    <option value="yes" <?php if ($filters['calendar'] === 'yes') echo 'selected'; ?>>Visible on Calendar</option>
                    <option value="requested" <?php if ($filters['calendar'] === 'requested') echo 'selected'; ?>>Requested Listing</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="start_date">Start Date From</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($filters['start_date']); ?>">
            </div>
            <div class="filter-group">
                <label for="end_date">Start Date To</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($filters['end_date']); ?>">
            </div>
            <div class="filter-actions">
                <button class="btn btn-primary" type="submit">Filter</button>
                <a class="btn btn-small" href="tournaments.php">Reset</a>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Submissions</h3>
        </div>
        <div class="card-body">
            <form method="post" id="bulk-form">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                <div class="bulk-actions">
                    <select name="bulk_action">
                        <option value="">Bulk Action…</option>
                        <option value="approve">Approve</option>
                        <option value="reject">Reject</option>
                        <option value="pending">Mark Pending</option>
                    </select>
                    <label><input type="checkbox" name="bulk_show_on_calendar"> Calendar</label>
                    <label><input type="checkbox" name="bulk_show_on_sidebar"> Sidebar</label>
                    <label><input type="checkbox" name="bulk_show_on_landing"> Landing</label>
                    <input type="text" name="bulk_notes" placeholder="Optional moderator note" style="min-width:200px;">
                    <button class="btn btn-small" type="submit">Apply</button>
                </div>
                <?php if ($rows === []): ?>
                    <div class="empty-state">No tournament submissions matched your filters.</div>
                <?php else: ?>
                    <table class="data-table">
                        <thead>
                        <tr>
                            <th style="width:40px;"><input type="checkbox" id="select-all"></th>
                            <th>Status</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Title</th>
                            <th>Organizer</th>
                            <th>Flags</th>
                            <th>Updated</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rows as $row): ?>
                            <?php
                            $rowStatus = $row['status'];
                            $isActive = $viewId && $row['id'] === $viewId;
                            $flagLabels = [];
                            if ((int) $row['show_on_calendar'] === 1) {
                                $flagLabels[] = 'Calendar';
                            }
                            if ((int) $row['show_on_sidebar'] === 1) {
                                $flagLabels[] = 'Sidebar';
                            }
                            if ((int) $row['show_on_landing'] === 1) {
                                $flagLabels[] = 'Landing';
                            }
                            ?>
                            <tr class="<?php echo $isActive ? 'active-row' : ''; ?>">
                                <td><input type="checkbox" class="tournament-check" name="selected[]" value="<?php echo $row['id']; ?>" <?php if ($isActive) echo 'checked'; ?>></td>
                                <td><span class="status-badge status-<?php echo htmlspecialchars($rowStatus); ?>"><?php echo $statusLabels[$rowStatus] ?? ucfirst($rowStatus); ?></span></td>
                                <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                                <td>
                                    <a href="<?php echo htmlspecialchars($redirectBase === [] ? 'tournaments.php?view=' . $row['id'] : 'tournaments.php?' . http_build_query(array_merge($redirectBase, ['view' => $row['id']]))); ?>">
                                        <?php echo htmlspecialchars($row['title']); ?>
                                    </a>
                                    <div class="table-meta">Ref: <?php echo htmlspecialchars($row['submission_reference']); ?></div>
                                </td>
                                <td><?php echo htmlspecialchars($row['organizer_company'] ?: $row['organizer_name']); ?></td>
                                <td>
                                    <div class="flag-pills">
                                        <?php foreach ($flagLabels as $flag): ?>
                                            <span class="flag-pill"><?php echo htmlspecialchars($flag); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($row['updated_at'] ?? ''); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </form>
            <div class="table-meta">
                Showing <?php echo min($total, ($page - 1) * $perPage + 1); ?>–<?php echo min($total, $page * $perPage); ?> of <?php echo $total; ?> submissions
            </div>
            <?php if ($pages > 1): ?>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $pages; $i++): ?>
                        <?php if ($i === $page): ?>
                            <span class="current"><?php echo $i; ?></span>
                        <?php else: ?>
                            <?php
                            $query = array_merge($redirectBase, ['page' => $i]);
                            $url = 'tournaments.php?' . http_build_query(array_filter($query, static fn($value) => $value !== null && $value !== ''));
                            ?>
                            <a href="<?php echo htmlspecialchars($url); ?>"><?php echo $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($selectedTournament): ?>
        <?php
        $selectedReg = array_map(static fn($item) => $item['slug'], $selectedTournament['registration'] ?? []);
        $selectedGames = array_map(static fn($item) => $item['slug'], $selectedTournament['games'] ?? []);
        ?>
        <div class="card-grid">
            <div class="card">
                <div class="card-header"><h3>Submission Details</h3></div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <h4>Status</h4>
                            <span class="status-badge status-<?php echo htmlspecialchars($selectedTournament['status']); ?>"><?php echo $statusLabels[$selectedTournament['status']] ?? ucfirst($selectedTournament['status']); ?></span>
                            <div class="table-meta" style="margin-top:8px;">Reference: <?php echo htmlspecialchars($selectedTournament['submission_reference']); ?></div>
                            <?php if (!empty($selectedTournament['status_reason'])): ?>
                                <div class="table-meta">Reason: <?php echo htmlspecialchars($selectedTournament['status_reason']); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="detail-item">
                            <h4>Schedule</h4>
                            <div><?php echo htmlspecialchars($selectedTournament['start_date']); ?> → <?php echo htmlspecialchars($selectedTournament['end_date']); ?></div>
                            <?php if (!empty($selectedTournament['start_time']) || !empty($selectedTournament['end_time'])): ?>
                                <div class="table-meta">Times: <?php echo htmlspecialchars((string) $selectedTournament['start_time']); ?> → <?php echo htmlspecialchars((string) $selectedTournament['end_time']); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($selectedTournament['timezone'])): ?>
                                <div class="table-meta">Timezone: <?php echo htmlspecialchars($selectedTournament['timezone']); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="detail-item">
                            <h4>Organizer</h4>
                            <div><?php echo htmlspecialchars($selectedTournament['organizer_company'] ?: $selectedTournament['organizer_name']); ?></div>
                            <div class="table-meta"><?php echo htmlspecialchars($selectedTournament['organizer_email']); ?></div>
                            <?php if (!empty($selectedTournament['organizer_phone'])): ?>
                                <div class="table-meta">Phone: <?php echo htmlspecialchars($selectedTournament['organizer_phone']); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="detail-item">
                            <h4>Location</h4>
                            <?php if ((int) $selectedTournament['is_online_only'] === 1): ?>
                                <div>Online Event</div>
                            <?php else: ?>
                                <div><?php echo htmlspecialchars($selectedTournament['venue_name'] ?? ''); ?></div>
                                <div class="table-meta">
                                    <?php
                                    $venueParts = array_filter([
                                        $selectedTournament['venue_city'] ?? '',
                                        $selectedTournament['venue_state'] ?? '',
                                        $selectedTournament['venue_country'] ?? '',
                                    ]);
                                    echo htmlspecialchars(implode(', ', $venueParts));
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($selectedTournament['event_website'])): ?>
                                <div class="table-meta">Website: <a href="<?php echo htmlspecialchars($selectedTournament['event_website']); ?>" target="_blank" rel="noopener">Visit</a></div>
                            <?php endif; ?>
                        </div>
                        <div class="detail-item">
                            <h4>Registration & Games</h4>
                            <?php if (!empty($selectedTournament['registration'])): ?>
                                <div class="table-meta">Registration: <?php echo htmlspecialchars(implode(', ', array_map(static fn($item) => $item['label'], $selectedTournament['registration']))); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($selectedTournament['games'])): ?>
                                <div class="table-meta">Games: <?php echo htmlspecialchars(implode(', ', array_map(static fn($item) => $item['label'], $selectedTournament['games']))); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="detail-item">
                            <h4>Notes</h4>
                            <?php if (!empty($selectedTournament['description'])): ?>
                                <div class="table-meta">Description:<br><?php echo nl2br(htmlspecialchars($selectedTournament['description'])); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($selectedTournament['registration_notes'])): ?>
                                <div class="table-meta">Registration Notes:<br><?php echo nl2br(htmlspecialchars($selectedTournament['registration_notes'])); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($selectedTournament['moderator_notes'])): ?>
                                <div class="table-meta">Moderator Notes:<br><?php echo nl2br(htmlspecialchars($selectedTournament['moderator_notes'])); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3>Moderation Actions</h3></div>
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                        <input type="hidden" name="tournament_id" value="<?php echo $selectedTournament['id']; ?>">
                        <input type="hidden" name="view" value="<?php echo $selectedTournament['id']; ?>">
                        <div class="form-group">
                            <label for="status_notes">Moderator Notes</label>
                            <textarea id="status_notes" name="status_notes" rows="3" class="form-control" placeholder="Optional notes for the audit log"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Display Flags on Status Change</label>
                            <div>
                                <label><input type="checkbox" name="status_show_on_calendar" <?php if ((int) $selectedTournament['show_on_calendar'] === 1) echo 'checked'; ?>> Calendar</label>
                                <label style="margin-left:12px;"><input type="checkbox" name="status_show_on_sidebar" <?php if ((int) $selectedTournament['show_on_sidebar'] === 1) echo 'checked'; ?>> Sidebar</label>
                                <label style="margin-left:12px;"><input type="checkbox" name="status_show_on_landing" <?php if ((int) $selectedTournament['show_on_landing'] === 1) echo 'checked'; ?>> Landing</label>
                            </div>
                        </div>
                        <div class="form-group" style="display:flex; gap:12px;">
                            <button class="btn btn-success" type="submit" name="set_status" value="approved">Approve</button>
                            <button class="btn btn-warning" type="submit" name="set_status" value="pending">Mark Pending</button>
                            <button class="btn btn-danger" type="submit" name="set_status" value="rejected">Reject</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3>Edit Display & Metadata</h3></div>
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                        <input type="hidden" name="tournament_id" value="<?php echo $selectedTournament['id']; ?>">
                        <input type="hidden" name="update_tournament" value="1">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($selectedTournament['title']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="timezone">Timezone</label>
                                <input type="text" id="timezone" name="timezone" value="<?php echo htmlspecialchars($selectedTournament['timezone'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($selectedTournament['start_date']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($selectedTournament['end_date']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="start_time">Start Time</label>
                                <input type="time" id="start_time" name="start_time" value="<?php echo htmlspecialchars($selectedTournament['start_time'] ? substr((string) $selectedTournament['start_time'], 0, 5) : ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="end_time">End Time</label>
                                <input type="time" id="end_time" name="end_time" value="<?php echo htmlspecialchars($selectedTournament['end_time'] ? substr((string) $selectedTournament['end_time'], 0, 5) : ''); ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="expected_participants">Expected Participants</label>
                                <input type="text" id="expected_participants" name="expected_participants" value="<?php echo htmlspecialchars((string) ($selectedTournament['expected_participants'] ?? '')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="lan_or_online">Event Type</label>
                                <select id="lan_or_online" name="lan_or_online">
                                    <option value="">Not specified</option>
                                    <option value="lan" <?php if (($selectedTournament['lan_or_online'] ?? '') === 'lan') echo 'selected'; ?>>LAN</option>
                                    <option value="online" <?php if (($selectedTournament['lan_or_online'] ?? '') === 'online') echo 'selected'; ?>>Online</option>
                                    <option value="both" <?php if (($selectedTournament['lan_or_online'] ?? '') === 'both') echo 'selected'; ?>>Both</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="event_email">Event Email</label>
                                <input type="email" id="event_email" name="event_email" value="<?php echo htmlspecialchars($selectedTournament['event_email'] ?? ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="event_website">Event Website</label>
                                <input type="text" id="event_website" name="event_website" value="<?php echo htmlspecialchars($selectedTournament['event_website'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="moderator_notes">Moderator Notes</label>
                            <textarea id="moderator_notes" name="moderator_notes" rows="3" class="form-control"><?php echo htmlspecialchars($selectedTournament['moderator_notes'] ?? ''); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="4" class="form-control"><?php echo htmlspecialchars($selectedTournament['description'] ?? ''); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="registration_notes">Registration Notes</label>
                            <textarea id="registration_notes" name="registration_notes" rows="3" class="form-control"><?php echo htmlspecialchars($selectedTournament['registration_notes'] ?? ''); ?></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="registration_types">Registration Methods</label>
                                <select id="registration_types" name="registration_types[]" multiple size="4">
                                    <?php foreach ($registrationOptions as $slug => $option): ?>
                                        <option value="<?php echo htmlspecialchars($slug); ?>" <?php if (in_array($slug, $selectedReg, true)) echo 'selected'; ?>><?php echo htmlspecialchars($option['label']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="games">Valve Games</label>
                                <select id="games" name="games[]" multiple size="6">
                                    <?php foreach ($gameOptions as $slug => $option): ?>
                                        <option value="<?php echo htmlspecialchars($slug); ?>" <?php if (in_array($slug, $selectedGames, true)) echo 'selected'; ?>><?php echo htmlspecialchars($option['label']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Visibility Flags</label>
                            <div>
                                <label><input type="checkbox" name="show_on_calendar" <?php if ((int) $selectedTournament['show_on_calendar'] === 1) echo 'checked'; ?>> Calendar</label>
                                <label style="margin-left:12px;"><input type="checkbox" name="show_on_sidebar" <?php if ((int) $selectedTournament['show_on_sidebar'] === 1) echo 'checked'; ?>> Sidebar</label>
                                <label style="margin-left:12px;"><input type="checkbox" name="show_on_landing" <?php if ((int) $selectedTournament['show_on_landing'] === 1) echo 'checked'; ?>> Landing</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><input type="checkbox" name="temporary_accounts_requested" <?php if ((int) $selectedTournament['temporary_accounts_requested'] === 1) echo 'checked'; ?>> Temporary Steam Accounts Requested</label>
                            <input type="text" name="temporary_accounts_quantity" value="<?php echo htmlspecialchars((string) ($selectedTournament['temporary_accounts_quantity'] ?? '')); ?>" placeholder="Quantity">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3>Audit Log</h3></div>
                <div class="card-body">
                    <?php if (empty($selectedTournament['logs'])): ?>
                        <div class="empty-state">No moderation history yet.</div>
                    <?php else: ?>
                        <ul class="audit-log">
                            <?php foreach ($selectedTournament['logs'] as $log): ?>
                                <li>
                                    <strong><?php echo htmlspecialchars(strtoupper($log['action'])); ?></strong>
                                    <?php if (!empty($log['notes'])): ?>
                                        <div><?php echo nl2br(htmlspecialchars($log['notes'])); ?></div>
                                    <?php endif; ?>
                                    <span><?php echo htmlspecialchars($log['created_at']); ?><?php if (!empty($log['admin'])) echo ' · ' . htmlspecialchars($log['admin']); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
$(function(){
    $('#select-all').on('change', function(){
        $('.tournament-check').prop('checked', this.checked);
    });
    $('.tournament-check').on('change', function(){
        if(!this.checked){
            $('#select-all').prop('checked', false);
        }
    });
});
</script>
<?php include 'admin_footer.php'; ?>
sed -n '1,80p' cms/admin/tournaments.php
