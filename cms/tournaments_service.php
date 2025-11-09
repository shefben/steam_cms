<?php

declare(strict_types=1);

require_once __DIR__ . '/db.php';

final class TournamentsService
{
    private PDO $db;

    /** @var array<string, array{label:string, id:int, active:int, sort_order:int}> */
    private array $registrationOptions = [];

    /** @var array<string, array{label:string, id:int, active:int, sort_order:int}> */
    private array $gameOptions = [];

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Fetch structured content blocks for a tournament page.
     *
     * @return array<string, array{label:string, content:string, position:int}>
     */
    public function getContentBlocks(string $page, string $theme): array
    {
        $blocks = $this->fetchContentBlocks($page, $theme);
        if ($blocks === [] && $theme !== '2004') {
            $blocks = $this->fetchContentBlocks($page, '2004');
        }
        return $blocks;
    }

    /**
     * @return array<string, array{label:string, content:string, position:int}>
     */
    private function fetchContentBlocks(string $page, string $theme): array
    {
        $stmt = $this->db->prepare('SELECT block_key, block_label, content, position FROM tournament_content_blocks WHERE page_slug = ? AND theme = ? ORDER BY position');
        $stmt->execute([$page, $theme]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $blocks = [];
        foreach ($rows as $row) {
            $blocks[$row['block_key']] = [
                'label' => $row['block_label'],
                'content' => $row['content'],
                'position' => (int) $row['position'],
            ];
        }
        return $blocks;
    }

    /**
     * Build calendar data for the next N months.
     *
     * @param int $months Number of months to render starting from the anchor month
     *
     * @return array{
     *     anchor: \DateTimeImmutable,
     *     range: array{start: \DateTimeImmutable, end: \DateTimeImmutable},
     *     months: list<array{label:string, weeks:list<list<array<string,mixed>>>>>,
     *     sidebar: list<array<string,mixed>>,
     *     events: array<string, array{label:string, items:list<array<string,mixed>>}>
     * }
     */
    public function getCalendarData(?\DateTimeImmutable $anchor = null, int $months = 3): array
    {
        $anchor = $anchor ? $anchor->setDate((int) $anchor->format('Y'), (int) $anchor->format('m'), 1) : new \DateTimeImmutable('first day of this month');
        $start = $anchor;
        $end = $anchor->modify('+' . ($months - 1) . ' months')->modify('last day of this month');

        $events = $this->fetchCalendarEvents($start, $end);
        $monthsData = $this->buildCalendarMonths($start, $months, $events['eventsByDay']);
        $sidebar = $this->buildSidebarEvents($events['allEvents']);
        $grouped = $this->groupEventsByMonth($events['allEvents'], $start, $end, $months);

        return [
            'anchor' => $anchor,
            'range' => [
                'start' => $start,
                'end' => $end,
            ],
            'months' => $monthsData,
            'sidebar' => $sidebar,
            'events' => $grouped,
        ];
    }

    /**
     * @param array<int, array<string, mixed>> $events
     * @return array<string, array{label:string, items:list<array<string,mixed>>}>
     */
    private function groupEventsByMonth(array $events, \DateTimeImmutable $start, \DateTimeImmutable $end, int $months): array
    {
        $grouped = [];
        $bucket = $start;
        for ($i = 0; $i < $months; $i++) {
            $monthKey = $bucket->format('Y-m');
            $grouped[$monthKey] = [
                'label' => $bucket->format('F Y'),
                'items' => [],
            ];
            $bucket = $bucket->modify('+1 month');
        }

        foreach ($events as $event) {
            $eventStart = $event['start_date'];
            if ($eventStart < $start) {
                $eventStart = $start;
            }
            if ($eventStart > $end) {
                continue;
            }
            $monthKey = $eventStart->format('Y-m');
            if (!isset($grouped[$monthKey])) {
                continue;
            }
            $grouped[$monthKey]['items'][] = $event;
        }

        return $grouped;
    }

    /**
     * @return array{eventsByDay: array<string, list<array<string,mixed>>>, allEvents: list<array<string,mixed>>}
     */
    private function fetchCalendarEvents(\DateTimeImmutable $start, \DateTimeImmutable $end): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM tournaments
             WHERE status = "approved"
               AND show_on_calendar = 1
               AND (
                    (start_date BETWEEN :start AND :end)
                    OR (end_date BETWEEN :start AND :end)
                    OR (start_date <= :start AND end_date >= :start)
               )
             ORDER BY start_date, title'
        );
        $stmt->execute([
            ':start' => $start->format('Y-m-d'),
            ':end' => $end->format('Y-m-d'),
        ]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$rows) {
            return ['eventsByDay' => [], 'allEvents' => []];
        }

        $ids = array_map(fn(array $row): int => (int) $row['id'], $rows);
        $registrationMap = $this->fetchRegistrationSelections($ids);
        $gameMap = $this->fetchGameSelections($ids);

        $eventsByDay = [];
        $allEvents = [];
        foreach ($rows as $row) {
            $startDate = new \DateTimeImmutable($row['start_date']);
            $endDate = new \DateTimeImmutable($row['end_date']);
            $summaryGames = $gameMap[$row['id']] ?? [];
            $registration = $registrationMap[$row['id']] ?? [];
            $event = [
                'id' => (int) $row['id'],
                'submission_reference' => $row['submission_reference'],
                'title' => $row['title'],
                'organizer' => $row['organizer_company'] ?: trim($row['organizer_name'] ?? ''),
                'organizer_contact' => trim(($row['organizer_first_name'] ?? '') . ' ' . ($row['organizer_last_name'] ?? '')),
                'organizer_email' => $row['organizer_email'],
                'organizer_phone' => $row['organizer_phone'],
                'organizer_address' => [
                    'address1' => $row['organizer_address1'],
                    'address2' => $row['organizer_address2'],
                    'city' => $row['organizer_city'],
                    'state' => $row['organizer_state'],
                    'postal_code' => $row['organizer_postal_code'],
                    'country' => $row['organizer_country'],
                ],
                'venue' => [
                    'name' => $row['venue_name'],
                    'address1' => $row['venue_address1'],
                    'address2' => $row['venue_address2'],
                    'city' => $row['venue_city'],
                    'state' => $row['venue_state'],
                    'postal_code' => $row['venue_postal_code'],
                    'country' => $row['venue_country'],
                ],
                'is_online_only' => (bool) $row['is_online_only'],
                'event_website' => $row['event_website'],
                'event_email' => $row['event_email'],
                'lan_or_online' => $row['lan_or_online'],
                'expected_participants' => $row['expected_participants'] !== null ? (int) $row['expected_participants'] : null,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'start_time' => $row['start_time'] ? new \DateTimeImmutable($row['start_date'] . ' ' . $row['start_time']) : null,
                'end_time' => $row['end_time'] ? new \DateTimeImmutable($row['end_date'] . ' ' . $row['end_time']) : null,
                'timezone' => $row['timezone'],
                'games' => $summaryGames,
                'game_list_summary' => $row['game_list_summary'],
                'registration' => $registration,
                'registration_notes' => $row['registration_notes'],
                'description' => $row['description'],
                'calendar_label' => $this->formatDateLabel($startDate, $endDate),
                'calendar_location' => $this->formatLocation($row),
                'temporary_accounts_requested' => (bool) $row['temporary_accounts_requested'],
                'temporary_accounts_quantity' => $row['temporary_accounts_quantity'] !== null ? (int) $row['temporary_accounts_quantity'] : null,
            ];

            $period = new \DatePeriod(
                $startDate,
                new \DateInterval('P1D'),
                $endDate->modify('+1 day')
            );

            foreach ($period as $day) {
                $key = $day->format('Y-m-d');
                $eventsByDay[$key] ??= [];
                $eventsByDay[$key][] = $event;
            }

            $allEvents[] = $event;
        }

        return ['eventsByDay' => $eventsByDay, 'allEvents' => $allEvents];
    }

    /**
     * @param array<int, array<string,mixed>> $rows
     * @return list<array<string,mixed>>
     */
    private function buildSidebarEvents(array $rows): array
    {
        $upcoming = array_filter($rows, static fn(array $event): bool => (bool) $event['is_online_only'] || $event['venue']['city'] || $event['venue']['name']);
        usort($upcoming, static function (array $a, array $b): int {
            $cmp = $a['start_date'] <=> $b['start_date'];
            if ($cmp !== 0) {
                return $cmp;
            }
            return strcmp($a['title'], $b['title']);
        });
        $upcoming = array_slice($upcoming, 0, 6);
        return array_map(function (array $event): array {
            $location = $event['calendar_location'];
            if ($event['is_online_only']) {
                $location = 'Online';
            } elseif (!$location) {
                $location = $event['venue']['name'] ?: '';
            }
            return [
                'id' => $event['id'],
                'title' => $event['title'],
                'dates' => $event['calendar_label'],
                'location' => $location,
                'website' => $event['event_website'],
                'games' => $event['games'],
                'start_date' => $event['start_date'],
            ];
        }, $upcoming);
    }

    /**
     * @param array<string, list<array<string,mixed>>> $eventsByDay
     * @return list<array{label:string, weeks:list<list<array<string,mixed>>>}>
     */
    private function buildCalendarMonths(\DateTimeImmutable $anchor, int $months, array $eventsByDay): array
    {
        $monthsData = [];
        for ($i = 0; $i < $months; $i++) {
            $current = $anchor->modify('+' . $i . ' months');
            $firstDay = $current;
            $label = $current->format('F Y');
            $startWeekDay = (int) $firstDay->format('N'); // 1 (Mon) to 7 (Sun)
            $daysInMonth = (int) $firstDay->format('t');

            $weeks = [];
            $week = [];

            // Fill leading blanks
            for ($blank = 1; $blank < $startWeekDay; $blank++) {
                $week[] = ['type' => 'empty'];
            }

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = $firstDay->setDate((int) $firstDay->format('Y'), (int) $firstDay->format('m'), $day);
                $key = $date->format('Y-m-d');
                $dayEvents = $eventsByDay[$key] ?? [];
                $week[] = [
                    'type' => 'day',
                    'day' => $day,
                    'date' => $date,
                    'has_events' => $dayEvents !== [],
                    'events' => $dayEvents,
                ];
                if (count($week) === 7) {
                    $weeks[] = $week;
                    $week = [];
                }
            }

            if ($week !== []) {
                while (count($week) < 7) {
                    $week[] = ['type' => 'empty'];
                }
                $weeks[] = $week;
            }

            $monthsData[] = [
                'label' => $label,
                'weeks' => $weeks,
            ];
        }
        return $monthsData;
    }

    /**
     * @return array<int, array{slug:string, label:string}>
     */
    private function fetchRegistrationSelections(array $ids): array
    {
        if ($ids === []) {
            return [];
        }
        $in = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare(
            "SELECT trs.tournament_id, tro.slug, tro.label
             FROM tournament_registration_selection trs
             JOIN tournament_registration_options tro ON tro.id = trs.option_id
             WHERE trs.tournament_id IN ($in)
             ORDER BY tro.sort_order"
        );
        $stmt->execute($ids);
        $map = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $map[(int) $row['tournament_id']][] = [
                'slug' => $row['slug'],
                'label' => $row['label'],
            ];
        }
        return $map;
    }

    /**
     * @return array<int, array{slug:string, label:string}>
     */
    private function fetchGameSelections(array $ids): array
    {
        if ($ids === []) {
            return [];
        }
        $in = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare(
            "SELECT tgs.tournament_id, tg.slug, tg.label
             FROM tournament_game_selection tgs
             JOIN tournament_games tg ON tg.id = tgs.game_id
             WHERE tgs.tournament_id IN ($in)
             ORDER BY tg.sort_order"
        );
        $stmt->execute($ids);
        $map = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $map[(int) $row['tournament_id']][] = [
                'slug' => $row['slug'],
                'label' => $row['label'],
            ];
        }
        return $map;
    }

    /**
     * Format location string for calendar sidebar/listing.
     */
    private function formatLocation(array $row): string
    {
        if ((int) $row['is_online_only'] === 1) {
            return 'Online';
        }
        $parts = array_filter([
            $row['venue_name'],
            $row['venue_city'],
            $row['venue_state'],
            $row['venue_country'],
        ]);
        return implode(', ', $parts);
    }

    private function formatDateLabel(\DateTimeImmutable $start, \DateTimeImmutable $end): string
    {
        if ($start->format('Y-m-d') === $end->format('Y-m-d')) {
            return $start->format('M j');
        }
        if ($start->format('Y-m') === $end->format('Y-m')) {
            return $start->format('M j') . ' to ' . $end->format('j');
        }
        if ($start->format('Y') === $end->format('Y')) {
            return $start->format('M j') . ' to ' . $end->format('M j');
        }
        return $start->format('M j, Y') . ' to ' . $end->format('M j, Y');
    }

    /**
     * Validate a tournament submission payload.
     *
     * @return array{errors:list<string>, data:array<string,mixed>}
     */
    public function validateSubmission(array $input): array
    {
        $errors = [];

        $data = [];
        $data['organizer_company'] = trim($input['tOrgName'] ?? '');
        if ($data['organizer_company'] === '') {
            $errors[] = 'Organization name is required.';
        }

        $data['organizer_type'] = trim($input['tOrgType'] ?? '');
        $data['organizer_is_cafe'] = isset($input['tIsCafe']) && $input['tIsCafe'] === '1';
        $data['organizer_first_name'] = trim($input['tOrgNameFirst'] ?? '');
        $data['organizer_last_name'] = trim($input['tOrgNameLast'] ?? '');
        $data['organizer_email'] = trim($input['tOrgEmail'] ?? '');
        if (!filter_var($data['organizer_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'A valid organizer email address is required.';
        }
        $data['organizer_phone'] = trim($input['tOrgPhone'] ?? '');
        if ($data['organizer_phone'] !== '' && !preg_match('/^[0-9+()\-\s]{3,}$/', $data['organizer_phone'])) {
            $errors[] = 'Organizer phone must contain only numbers and phone characters.';
        }
        $data['organizer_fax'] = trim($input['tOrgFax'] ?? '');
        if ($data['organizer_fax'] !== '' && !preg_match('/^[0-9+()\-\s]{3,}$/', $data['organizer_fax'])) {
            $errors[] = 'Organizer fax must contain only numbers and phone characters.';
        }
        $data['organizer_address1'] = trim($input['tOrgAddress'] ?? '');
        $data['organizer_address2'] = trim($input['tOrgAddress2'] ?? '');
        $data['organizer_city'] = trim($input['tOrgCity'] ?? '');
        $data['organizer_state'] = trim($input['tOrgStateProv'] ?? '');
        $data['organizer_postal_code'] = trim($input['tOrgZipPostal'] ?? '');
        $data['organizer_country'] = trim($input['tOrgCountry'] ?? '');

        $data['title'] = trim($input['tTourName'] ?? '');
        if ($data['title'] === '') {
            $errors[] = 'Tournament name is required.';
        }

        $participants = trim($input['tTourParticipants'] ?? '');
        if ($participants !== '') {
            if (!ctype_digit($participants)) {
                $errors[] = 'Estimated number of participants must be numeric.';
            } else {
                $data['expected_participants'] = (int) $participants;
            }
        }

        $startMonth = (int) ($input['tTourStartMonth'] ?? 0);
        $startDay = (int) ($input['tTourStartDay'] ?? 0);
        $startYear = (int) ($input['tTourStartYear'] ?? 0);
        $endMonth = (int) ($input['tTourEndMonth'] ?? 0);
        $endDay = (int) ($input['tTourEndDay'] ?? 0);
        $endYear = (int) ($input['tTourEndYear'] ?? 0);

        if (!checkdate($startMonth, $startDay, $startYear)) {
            $errors[] = 'A valid tournament start date is required.';
        }
        if (!checkdate($endMonth, $endDay, $endYear)) {
            $errors[] = 'A valid tournament end date is required.';
        }

        if (empty($errors)) {
            $startDate = sprintf('%04d-%02d-%02d', $startYear, $startMonth, $startDay);
            $endDate = sprintf('%04d-%02d-%02d', $endYear, $endMonth, $endDay);
            if ($startDate > $endDate) {
                $errors[] = 'Tournament end date must be on or after the start date.';
            }
            $data['start_date'] = $startDate;
            $data['end_date'] = $endDate;
        }

        $data['start_time'] = null;
        $data['end_time'] = null;
        if (!empty($input['tTourStartTime'])) {
            $startTime = trim($input['tTourStartTime']);
            if (preg_match('/^\d{1,2}:\d{2}$/', $startTime)) {
                $data['start_time'] = $startTime . ':00';
            } else {
                $errors[] = 'Tournament start time must be in HH:MM format.';
            }
        }
        if (!empty($input['tTourEndTime'])) {
            $endTime = trim($input['tTourEndTime']);
            if (preg_match('/^\d{1,2}:\d{2}$/', $endTime)) {
                $data['end_time'] = $endTime . ':00';
            } else {
                $errors[] = 'Tournament end time must be in HH:MM format.';
            }
        }
        $data['timezone'] = trim($input['tTourTimezone'] ?? '');

        $data['is_online_only'] = isset($input['tTourOnlineOnly']);
        $data['venue_name'] = trim($input['tTourVenueName'] ?? '');
        $data['venue_address1'] = trim($input['tTourAddress'] ?? '');
        $data['venue_address2'] = trim($input['tTourAddress2'] ?? '');
        $data['venue_city'] = trim($input['tTourCity'] ?? '');
        $data['venue_state'] = trim($input['tTourStateProv'] ?? '');
        $data['venue_postal_code'] = trim($input['tTourZipPostal'] ?? '');
        $data['venue_country'] = trim($input['tTourCountry'] ?? '');
        $data['event_website'] = trim($input['tTourWeb'] ?? '');
        if ($data['event_website'] !== '' && !filter_var($data['event_website'], FILTER_VALIDATE_URL)) {
            $errors[] = 'Tournament website must be a valid URL.';
        }
        $data['event_email'] = trim($input['tTourEmail'] ?? '');
        if ($data['event_email'] !== '' && !filter_var($data['event_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Tournament contact email must be valid.';
        }
        $data['lan_or_online'] = in_array($input['tLanOrOnline'] ?? '', ['lan', 'online', 'both'], true)
            ? $input['tLanOrOnline']
            : null;

        if (!$data['is_online_only'] && $data['venue_city'] === '' && $data['venue_name'] === '' && $data['venue_address1'] === '') {
            $errors[] = 'Please provide a venue name or location for in-person events.';
        }

        $data['registration_request'] = trim($input['tInCalendar'] ?? '0') === '1';
        $data['requested_calendar_listing'] = $data['registration_request'];

        $agree = $input['tAgreeToLicense'] ?? '';
        if ($agree !== '1') {
            $errors[] = 'You must agree to the Limited Game Tournament License to submit.';
        }

        $data['temporary_accounts_requested'] = ($input['tPurchaseTemp'] ?? '') === '1';
        $tempCount = trim($input['tHowManyTemp'] ?? '');
        if ($data['temporary_accounts_requested']) {
            if (!ctype_digit($tempCount) || (int) $tempCount <= 0) {
                $errors[] = 'Please specify how many temporary tournament accounts you require.';
            } else {
                $data['temporary_accounts_quantity'] = (int) $tempCount;
            }
        }

        $registrationRaw = $input['tRegType'] ?? $input['tRegType[]'] ?? [];
        $data['registration_types'] = $this->sanitizeSelection($registrationRaw, $this->getRegistrationOptions());
        $gamesRaw = $input['tValveGamesUsed'] ?? $input['tValveGamesUsed[]'] ?? [];
        $data['games'] = $this->sanitizeSelection($gamesRaw, $this->getGameOptions());

        $description = trim($input['tTourDescription'] ?? '');
        if ($description === '' && $data['temporary_accounts_requested']) {
            $description = 'Temporary accounts requested.';
        }
        $data['description'] = $description;
        $data['registration_notes'] = trim($input['tRegistrationNotes'] ?? '');

        return ['errors' => $errors, 'data' => $data];
    }

    /**
     * @param array|string $selection
     * @param array<string, array{label:string, id:int, active:int, sort_order:int}> $options
     * @return list<string>
     */
    private function sanitizeSelection($selection, array $options): array
    {
        $values = [];
        if (is_string($selection)) {
            $values = [$selection];
        } elseif (is_array($selection)) {
            $values = $selection;
        }
        $values = array_map('strval', $values);
        $values = array_values(array_unique($values));
        return array_values(array_filter($values, static function (string $value) use ($options): bool {
            return isset($options[$value]);
        }));
    }

    /**
     * Persist a validated submission as pending.
     *
     * @param array<string,mixed> $data
     *
     * @return array{ id:int, submission_reference:string }
     */
    public function createSubmission(array $data): array
    {
        $reference = $this->generateReference();
        $stmt = $this->db->prepare(
            'INSERT INTO tournaments (
                submission_reference,
                title,
                organizer_name,
                organizer_first_name,
                organizer_last_name,
                organizer_company,
                organizer_type,
                organizer_is_cafe,
                organizer_email,
                organizer_phone,
                organizer_fax,
                organizer_address1,
                organizer_address2,
                organizer_city,
                organizer_state,
                organizer_postal_code,
                organizer_country,
                venue_name,
                venue_address1,
                venue_address2,
                venue_city,
                venue_state,
                venue_postal_code,
                venue_country,
                is_online_only,
                event_website,
                event_email,
                lan_or_online,
                expected_participants,
                start_date,
                end_date,
                start_time,
                end_time,
                timezone,
                requested_calendar_listing,
                show_on_calendar,
                show_on_sidebar,
                show_on_landing,
                temporary_accounts_requested,
                temporary_accounts_quantity,
                description,
                game_list_summary,
                registration_notes,
                status
             ) VALUES (
                :reference,
                :title,
                :organizer_name,
                :organizer_first_name,
                :organizer_last_name,
                :organizer_company,
                :organizer_type,
                :organizer_is_cafe,
                :organizer_email,
                :organizer_phone,
                :organizer_fax,
                :organizer_address1,
                :organizer_address2,
                :organizer_city,
                :organizer_state,
                :organizer_postal_code,
                :organizer_country,
                :venue_name,
                :venue_address1,
                :venue_address2,
                :venue_city,
                :venue_state,
                :venue_postal_code,
                :venue_country,
                :is_online_only,
                :event_website,
                :event_email,
                :lan_or_online,
                :expected_participants,
                :start_date,
                :end_date,
                :start_time,
                :end_time,
                :timezone,
                :requested_calendar_listing,
                0,
                0,
                0,
                :temporary_accounts_requested,
                :temporary_accounts_quantity,
                :description,
                :game_list_summary,
                :registration_notes,
                "pending"
             )'
        );

        $organizerName = trim(($data['organizer_first_name'] ?? '') . ' ' . ($data['organizer_last_name'] ?? ''));
        if ($organizerName === '' && !empty($data['organizer_company'])) {
            $organizerName = $data['organizer_company'];
        }
        $gameSummary = $this->summariseSelection($data['games'] ?? [], $this->getGameOptions());

        $stmt->execute([
            ':reference' => $reference,
            ':title' => $data['title'],
            ':organizer_name' => $organizerName,
            ':organizer_first_name' => $data['organizer_first_name'] ?? null,
            ':organizer_last_name' => $data['organizer_last_name'] ?? null,
            ':organizer_company' => $data['organizer_company'],
            ':organizer_type' => $data['organizer_type'] ?? null,
            ':organizer_is_cafe' => $data['organizer_is_cafe'] ? 1 : 0,
            ':organizer_email' => $data['organizer_email'],
            ':organizer_phone' => $data['organizer_phone'] ?? null,
            ':organizer_fax' => $data['organizer_fax'] ?? null,
            ':organizer_address1' => $data['organizer_address1'] ?? null,
            ':organizer_address2' => $data['organizer_address2'] ?? null,
            ':organizer_city' => $data['organizer_city'] ?? null,
            ':organizer_state' => $data['organizer_state'] ?? null,
            ':organizer_postal_code' => $data['organizer_postal_code'] ?? null,
            ':organizer_country' => $data['organizer_country'] ?? null,
            ':venue_name' => $data['venue_name'] ?? null,
            ':venue_address1' => $data['venue_address1'] ?? null,
            ':venue_address2' => $data['venue_address2'] ?? null,
            ':venue_city' => $data['venue_city'] ?? null,
            ':venue_state' => $data['venue_state'] ?? null,
            ':venue_postal_code' => $data['venue_postal_code'] ?? null,
            ':venue_country' => $data['venue_country'] ?? null,
            ':is_online_only' => $data['is_online_only'] ? 1 : 0,
            ':event_website' => $data['event_website'] ?? null,
            ':event_email' => $data['event_email'] ?? null,
            ':lan_or_online' => $data['lan_or_online'] ?? null,
            ':expected_participants' => $data['expected_participants'] ?? null,
            ':start_date' => $data['start_date'],
            ':end_date' => $data['end_date'],
            ':start_time' => $data['start_time'],
            ':end_time' => $data['end_time'],
            ':timezone' => $data['timezone'] ?? null,
            ':requested_calendar_listing' => $data['requested_calendar_listing'] ? 1 : 0,
            ':temporary_accounts_requested' => $data['temporary_accounts_requested'] ? 1 : 0,
            ':temporary_accounts_quantity' => $data['temporary_accounts_quantity'] ?? null,
            ':description' => $data['description'] ?? null,
            ':game_list_summary' => $gameSummary,
            ':registration_notes' => $data['registration_notes'] ?? null,
        ]);

        $id = (int) $this->db->lastInsertId();
        $this->syncSelectionTable('tournament_registration_selection', 'option_id', $id, $data['registration_types'] ?? [], $this->getRegistrationOptions());
        $this->syncSelectionTable('tournament_game_selection', 'game_id', $id, $data['games'] ?? [], $this->getGameOptions());
        $this->logAction($id, null, 'submission_created', 'New tournament submission');

        return ['id' => $id, 'submission_reference' => $reference];
    }

    /**
     * @param array<string> $selection
     * @param array<string, array{label:string, id:int, active:int, sort_order:int}> $options
     */
    private function syncSelectionTable(string $table, string $column, int $tournamentId, array $selection, array $options): void
    {
        $this->db->prepare("DELETE FROM {$table} WHERE tournament_id = ?")->execute([$tournamentId]);
        if ($selection === []) {
            return;
        }
        $insert = $this->db->prepare("INSERT INTO {$table} (tournament_id, {$column}) VALUES (?, ?)");
        foreach ($selection as $slug) {
            if (!isset($options[$slug])) {
                continue;
            }
            $insert->execute([$tournamentId, $options[$slug]['id']]);
        }
    }

    /**
     * Generate a short reference identifier for submissions.
     */
    private function generateReference(): string
    {
        $bytes = random_bytes(16);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
    }

    /**
     * @param array<string> $selection
     * @param array<string, array{label:string, id:int, active:int, sort_order:int}> $options
     */
    private function summariseSelection(array $selection, array $options): ?string
    {
        if ($selection === []) {
            return null;
        }
        $labels = [];
        foreach ($selection as $slug) {
            if (isset($options[$slug])) {
                $labels[] = $options[$slug]['label'];
            }
        }
        return $labels ? implode(', ', $labels) : null;
    }

    /**
     * Retrieve tournaments with filters and pagination.
     *
     * @return array{rows:list<array<string,mixed>>, total:int}
     */
    public function listTournaments(array $filters, int $limit = 50, int $offset = 0): array
    {
        $where = [];
        $params = [];

        if (!empty($filters['status']) && in_array($filters['status'], ['pending', 'approved', 'rejected'], true)) {
            $where[] = 'status = :status';
            $params[':status'] = $filters['status'];
        }

        if (!empty($filters['query'])) {
            $where[] = '(title LIKE :query OR organizer_company LIKE :query)';
            $params[':query'] = '%' . $filters['query'] . '%';
        }

        if (!empty($filters['calendar'])) {
            if ($filters['calendar'] === 'yes') {
                $where[] = 'show_on_calendar = 1';
            } elseif ($filters['calendar'] === 'requested') {
                $where[] = 'requested_calendar_listing = 1';
            }
        }

        if (!empty($filters['start_date'])) {
            $where[] = 'start_date >= :start_filter';
            $params[':start_filter'] = $filters['start_date'];
        }

        if (!empty($filters['end_date'])) {
            $where[] = 'end_date <= :end_filter';
            $params[':end_filter'] = $filters['end_date'];
        }

        $whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';
        $countStmt = $this->db->prepare("SELECT COUNT(*) FROM tournaments {$whereSql}");
        $countStmt->execute($params);
        $total = (int) $countStmt->fetchColumn();

        $sql = "SELECT * FROM tournaments {$whereSql} ORDER BY start_date DESC, created_at DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$rows) {
            return ['rows' => [], 'total' => $total];
        }

        $ids = array_map(fn(array $row): int => (int) $row['id'], $rows);
        $registration = $this->fetchRegistrationSelections($ids);
        $games = $this->fetchGameSelections($ids);
        $logs = $this->fetchAuditLogs($ids);

        $result = [];
        foreach ($rows as $row) {
            $row['registration'] = $registration[$row['id']] ?? [];
            $row['games'] = $games[$row['id']] ?? [];
            $row['logs'] = $logs[$row['id']] ?? [];
            $result[] = $row;
        }

        return ['rows' => $result, 'total' => $total];
    }

    /**
     * @return array<int, list<array<string,mixed>>>
     */
    private function fetchAuditLogs(array $ids): array
    {
        if ($ids === []) {
            return [];
        }
        $in = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare(
            "SELECT tal.*, au.username
             FROM tournament_audit_log tal
             LEFT JOIN admin_users au ON au.id = tal.admin_id
             WHERE tal.tournament_id IN ($in)
             ORDER BY tal.created_at DESC"
        );
        $stmt->execute($ids);
        $map = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $map[(int) $row['tournament_id']][] = [
                'action' => $row['action'],
                'notes' => $row['notes'],
                'created_at' => $row['created_at'],
                'admin' => $row['username'] ?? null,
            ];
        }
        return $map;
    }

    /**
     * Retrieve a single tournament with relations.
     */
    public function getTournament(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM tournaments WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $row['registration'] = $this->fetchRegistrationSelections([$id])[$id] ?? [];
        $row['games'] = $this->fetchGameSelections([$id])[$id] ?? [];
        $row['logs'] = $this->fetchAuditLogs([$id])[$id] ?? [];
        return $row;
    }

    /**
     * Update tournament metadata.
     *
     * @param array<string,mixed> $payload
     */
    public function updateTournament(int $id, array $payload, int $adminId): array
    {
        $fields = [];
        $params = [];
        $editable = [
            'title', 'organizer_company', 'organizer_email', 'organizer_phone', 'organizer_fax', 'organizer_type',
            'organizer_first_name', 'organizer_last_name', 'organizer_address1', 'organizer_address2',
            'organizer_city', 'organizer_state', 'organizer_postal_code', 'organizer_country',
            'venue_name', 'venue_address1', 'venue_address2', 'venue_city', 'venue_state', 'venue_postal_code', 'venue_country',
            'event_website', 'event_email', 'lan_or_online', 'expected_participants', 'start_date', 'end_date',
            'start_time', 'end_time', 'timezone', 'moderator_notes', 'description', 'registration_notes',
            'show_on_calendar', 'show_on_sidebar', 'show_on_landing', 'temporary_accounts_requested', 'temporary_accounts_quantity',
        ];

        foreach ($editable as $field) {
            if (array_key_exists($field, $payload)) {
                $fields[] = $field . ' = :' . $field;
                $value = $payload[$field];
                if (in_array($field, ['show_on_calendar', 'show_on_sidebar', 'show_on_landing', 'temporary_accounts_requested'], true)) {
                    $value = $value ? 1 : 0;
                }
                $params[':' . $field] = $value;
            }
        }

        if ($fields) {
            $params[':id'] = $id;
            $params[':updated_at'] = (new \DateTimeImmutable())->format('Y-m-d H:i:s');
            $sql = 'UPDATE tournaments SET ' . implode(', ', $fields) . ', updated_at = :updated_at WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $this->logAction($id, $adminId, 'updated', 'Tournament details updated');
        }

        if (!empty($payload['registration_types'])) {
            $this->syncSelectionTable('tournament_registration_selection', 'option_id', $id, $payload['registration_types'], $this->getRegistrationOptions());
        }
        if (!empty($payload['games'])) {
            $this->syncSelectionTable('tournament_game_selection', 'game_id', $id, $payload['games'], $this->getGameOptions());
        }

        return $this->getTournament($id) ?? [];
    }

    public function setStatus(int $id, string $status, int $adminId, ?string $notes = null, array $flags = []): array
    {
        if (!in_array($status, ['pending', 'approved', 'rejected'], true)) {
            throw new \InvalidArgumentException('Invalid status.');
        }
        $fields = [
            'status' => $status,
            'status_changed_at' => (new \DateTimeImmutable())->format('Y-m-d H:i:s'),
            'status_changed_by' => $adminId,
        ];
        if ($status === 'approved') {
            $fields['approved_at'] = $fields['status_changed_at'];
            $fields['rejected_at'] = null;
        } elseif ($status === 'rejected') {
            $fields['rejected_at'] = $fields['status_changed_at'];
        } else {
            $fields['approved_at'] = null;
            $fields['rejected_at'] = null;
        }
        if (isset($flags['show_on_calendar'])) {
            $fields['show_on_calendar'] = $flags['show_on_calendar'] ? 1 : 0;
        }
        if (isset($flags['show_on_sidebar'])) {
            $fields['show_on_sidebar'] = $flags['show_on_sidebar'] ? 1 : 0;
        }
        if (isset($flags['show_on_landing'])) {
            $fields['show_on_landing'] = $flags['show_on_landing'] ? 1 : 0;
        }

        $set = [];
        foreach ($fields as $field => $value) {
            $set[] = $field . ' = :' . $field;
        }
        $fields['status_reason'] = $notes;
        $set[] = 'status_reason = :status_reason';
        $fields['id'] = $id;

        $fields['updated_at'] = (new \DateTimeImmutable())->format('Y-m-d H:i:s');
        $set[] = 'updated_at = :updated_at';

        $stmt = $this->db->prepare('UPDATE tournaments SET ' . implode(', ', $set) . ' WHERE id = :id');
        $stmt->execute($fields);

        $this->logAction($id, $adminId, 'status_changed', strtoupper($status) . ($notes ? (': ' . $notes) : ''));
        return $this->getTournament($id) ?? [];
    }

    /**
     * @param list<int> $ids
     */
    public function bulkSetStatus(array $ids, string $status, int $adminId, ?string $notes = null, array $flags = []): int
    {
        $count = 0;
        foreach ($ids as $id) {
            $this->setStatus($id, $status, $adminId, $notes, $flags);
            $count++;
        }
        return $count;
    }

    public function logAction(int $id, ?int $adminId, string $action, ?string $notes = null): void
    {
        $stmt = $this->db->prepare('INSERT INTO tournament_audit_log (tournament_id, admin_id, action, notes) VALUES (?,?,?,?)');
        $stmt->execute([$id, $adminId, $action, $notes]);
    }

    /**
     * @return array<string, array{label:string, id:int, active:int, sort_order:int}>
     */
    public function getRegistrationOptions(): array
    {
        if ($this->registrationOptions !== []) {
            return $this->registrationOptions;
        }
        $stmt = $this->db->query('SELECT * FROM tournament_registration_options ORDER BY sort_order');
        $options = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $options[$row['slug']] = [
                'label' => $row['label'],
                'id' => (int) $row['id'],
                'active' => (int) $row['active'],
                'sort_order' => (int) $row['sort_order'],
            ];
        }
        return $this->registrationOptions = $options;
    }

    /**
     * @return array<string, array{label:string, id:int, active:int, sort_order:int}>
     */
    public function getGameOptions(): array
    {
        if ($this->gameOptions !== []) {
            return $this->gameOptions;
        }
        $stmt = $this->db->query('SELECT * FROM tournament_games ORDER BY sort_order');
        $options = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $options[$row['slug']] = [
                'label' => $row['label'],
                'id' => (int) $row['id'],
                'active' => (int) $row['active'],
                'sort_order' => (int) $row['sort_order'],
            ];
        }
        return $this->gameOptions = $options;
    }

    /**
     * Provide counts and upcoming metrics for admin dashboard.
     *
     * @return array{total:int,pending:int,approved:int,rejected:int,upcoming:int,calendar_requests:int}
     */
    public function getStatusSummary(): array
    {
        $summary = [
            'total' => 0,
            'pending' => 0,
            'approved' => 0,
            'rejected' => 0,
            'upcoming' => 0,
            'calendar_requests' => 0,
        ];

        $stmt = $this->db->query('SELECT status, COUNT(*) AS total FROM tournaments GROUP BY status');
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $status = $row['status'];
            $count = (int) $row['total'];
            $summary['total'] += $count;
            if (isset($summary[$status])) {
                $summary[$status] = $count;
            }
        }

        $today = (new \DateTimeImmutable('today'))->format('Y-m-d');
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM tournaments WHERE status = "approved" AND start_date >= :today');
        $stmt->execute([':today' => $today]);
        $summary['upcoming'] = (int) $stmt->fetchColumn();

        $stmt = $this->db->prepare('SELECT COUNT(*) FROM tournaments WHERE status = "pending" AND requested_calendar_listing = 1');
        $stmt->execute();
        $summary['calendar_requests'] = (int) $stmt->fetchColumn();

        return $summary;
    }
}

function cms_tournaments_service(): TournamentsService
{
    static $service = null;
    if ($service instanceof TournamentsService) {
        return $service;
    }
    $service = new TournamentsService(cms_get_db());
    return $service;
}

function cms_tournament_template(string $name, string $theme): string
{
    $name = preg_replace('/\.twig$/', '', $name);
    $paths = [
        __DIR__ . '/../themes/' . $theme . '/templates/' . $name . '.twig',
        __DIR__ . '/../themes/' . $theme . '/layout/' . $name . '.twig',
        __DIR__ . '/../themes/' . $theme . '/layouts/' . $name . '.twig',
        __DIR__ . '/../themes/2004/templates/' . $name . '.twig',
    ];
    foreach ($paths as $path) {
        if (is_file($path)) {
            return $path;
        }
    }
    throw new \RuntimeException('Tournament template "' . $name . '" not found for theme ' . $theme);
}
