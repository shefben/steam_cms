<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../cms/tournaments_service.php';

final class TournamentsServiceTest extends TestCase
{
    private PDO $pdo;
    private TournamentsService $service;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec('PRAGMA foreign_keys = ON');
        $this->createSchema();
        $this->seedLookups();
        $this->service = new TournamentsService($this->pdo);
    }

    public function testValidateSubmissionDetectsMissingFields(): void
    {
        $input = $this->validSubmissionInput();
        $input['tOrgName'] = '';
        $input['tOrgEmail'] = 'invalid-email';

        $result = $this->service->validateSubmission($input);
        $this->assertContains('Organization name is required.', $result['errors']);
        $this->assertContains('A valid organizer email address is required.', $result['errors']);

        $dateInput = $this->validSubmissionInput();
        $dateInput['tTourEndDay'] = '08';
        $dateResult = $this->service->validateSubmission($dateInput);
        $this->assertContains('Tournament end date must be on or after the start date.', $dateResult['errors']);
    }

    public function testSubmissionWorkflowApprovalAndRejection(): void
    {
        $input = $this->validSubmissionInput();
        $validated = $this->service->validateSubmission($input);
        $this->assertSame([], $validated['errors']);

        $created = $this->service->createSubmission($validated['data']);
        $this->assertArrayHasKey('id', $created);
        $id = $created['id'];

        $approved = $this->service->setStatus($id, 'approved', 1, 'Approved in test', [
            'show_on_calendar' => true,
        ]);
        $this->assertSame('approved', $approved['status']);
        $this->assertSame(1, (int) $approved['show_on_calendar']);
        $this->assertNotEmpty($approved['approved_at']);

        $rejected = $this->service->setStatus($id, 'rejected', 1, 'Rejected in test');
        $this->assertSame('rejected', $rejected['status']);
        $this->assertNotEmpty($rejected['rejected_at']);

        $logCount = (int) $this->pdo->query('SELECT COUNT(*) FROM tournament_audit_log WHERE tournament_id = ' . $id)->fetchColumn();
        $this->assertGreaterThanOrEqual(3, $logCount, 'Audit log should include submission + two status changes');
    }

    public function testCalendarRangeCoversThreeMonths(): void
    {
        $anchor = new DateTimeImmutable('2025-01-01');
        $this->createApprovedEvent('Early New Year Bash', '2024-12-30', '2025-01-02');
        $this->createApprovedEvent('January Clash', '2025-01-15', '2025-01-16');
        $this->createApprovedEvent('Spring Scrimmage', '2025-03-05', '2025-03-05');
        $this->createApprovedEvent('Too Late Tournament', '2025-04-10', '2025-04-12');

        $calendar = $this->service->getCalendarData($anchor, 3);
        $this->assertCount(3, $calendar['months'], 'Calendar should expose exactly three months.');

        $monthKeys = array_keys($calendar['events']);
        $this->assertSame(['2025-01', '2025-02', '2025-03'], $monthKeys, 'Event buckets should align to the requested range.');

        $this->assertCount(2, $calendar['events']['2025-01']['items']);
        $this->assertCount(0, $calendar['events']['2025-02']['items']);
        $this->assertCount(1, $calendar['events']['2025-03']['items']);
    }

    private function createApprovedEvent(string $title, string $start, string $end): int
    {
        $input = $this->validSubmissionInput();
        $input['tTourName'] = $title;
        $startDate = new DateTimeImmutable($start);
        $endDate = new DateTimeImmutable($end);
        $input['tTourStartYear'] = $startDate->format('Y');
        $input['tTourStartMonth'] = $startDate->format('m');
        $input['tTourStartDay'] = $startDate->format('d');
        $input['tTourEndYear'] = $endDate->format('Y');
        $input['tTourEndMonth'] = $endDate->format('m');
        $input['tTourEndDay'] = $endDate->format('d');

        $validated = $this->service->validateSubmission($input);
        $this->assertSame([], $validated['errors']);
        $created = $this->service->createSubmission($validated['data']);
        $this->service->setStatus($created['id'], 'approved', 1, 'Auto approve', [
            'show_on_calendar' => true,
        ]);
        return $created['id'];
    }

    /**
     * @return array<string, mixed>
     */
    private function validSubmissionInput(): array
    {
        return [
            'tOrgName' => 'Example Org',
            'tOrgType' => 'Corporation',
            'tIsCafe' => '0',
            'tOrgNameFirst' => 'Alex',
            'tOrgNameLast' => 'Smith',
            'tOrgAddress' => '123 Example Street',
            'tOrgCity' => 'Bellevue',
            'tOrgStateProv' => 'WA',
            'tOrgCountry' => 'USA',
            'tOrgZipPostal' => '98004',
            'tOrgPhone' => '123-456-7890',
            'tOrgEmail' => 'organizer@example.com',
            'tTourName' => 'Valve Test Tournament',
            'tTourParticipants' => '64',
            'tTourStartMonth' => '01',
            'tTourStartDay' => '10',
            'tTourStartYear' => '2025',
            'tTourEndMonth' => '01',
            'tTourEndDay' => '12',
            'tTourEndYear' => '2025',
            'tTourStartTime' => '09:00',
            'tTourEndTime' => '18:00',
            'tTourTimezone' => 'UTC',
            'tTourOnlineOnly' => '1',
            'tTourWeb' => 'https://example.com',
            'tTourEmail' => 'event@example.com',
            'tLanOrOnline' => 'online',
            'tRegType' => ['email'],
            'tValveGamesUsed' => ['cs'],
            'tTourDescription' => 'Test tournament description.',
            'tRegistrationNotes' => 'Bring your own device.',
            'tInCalendar' => '1',
            'tAgreeToLicense' => '1',
            'tPurchaseTemp' => '0',
        ];
    }

    private function createSchema(): void
    {
        $this->pdo->exec('CREATE TABLE admin_users (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT NOT NULL)');
        $this->pdo->exec('INSERT INTO admin_users (id, username) VALUES (1, "admin")');

        $this->pdo->exec('CREATE TABLE tournaments (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            submission_reference TEXT NOT NULL,
            title TEXT NOT NULL,
            organizer_name TEXT,
            organizer_first_name TEXT,
            organizer_last_name TEXT,
            organizer_company TEXT,
            organizer_type TEXT,
            organizer_is_cafe INTEGER DEFAULT 0,
            organizer_email TEXT NOT NULL,
            organizer_phone TEXT,
            organizer_fax TEXT,
            organizer_address1 TEXT,
            organizer_address2 TEXT,
            organizer_city TEXT,
            organizer_state TEXT,
            organizer_postal_code TEXT,
            organizer_country TEXT,
            venue_name TEXT,
            venue_address1 TEXT,
            venue_address2 TEXT,
            venue_city TEXT,
            venue_state TEXT,
            venue_postal_code TEXT,
            venue_country TEXT,
            is_online_only INTEGER DEFAULT 0,
            event_website TEXT,
            event_email TEXT,
            lan_or_online TEXT,
            expected_participants INTEGER,
            start_date TEXT NOT NULL,
            end_date TEXT NOT NULL,
            start_time TEXT,
            end_time TEXT,
            timezone TEXT,
            requested_calendar_listing INTEGER DEFAULT 0,
            show_on_calendar INTEGER DEFAULT 0,
            show_on_sidebar INTEGER DEFAULT 0,
            show_on_landing INTEGER DEFAULT 0,
            temporary_accounts_requested INTEGER DEFAULT 0,
            temporary_accounts_quantity INTEGER,
            description TEXT,
            game_list_summary TEXT,
            registration_notes TEXT,
            status TEXT NOT NULL DEFAULT "pending",
            moderator_notes TEXT,
            status_reason TEXT,
            status_changed_at TEXT,
            status_changed_by INTEGER,
            approved_at TEXT,
            rejected_at TEXT,
            confirmation_sent_at TEXT,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT DEFAULT CURRENT_TIMESTAMP
        )');

        $this->pdo->exec('CREATE TABLE tournament_registration_options (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            slug TEXT NOT NULL,
            label TEXT NOT NULL,
            sort_order INTEGER NOT NULL DEFAULT 0,
            active INTEGER NOT NULL DEFAULT 1
        )');
        $this->pdo->exec('CREATE TABLE tournament_registration_selection (
            tournament_id INTEGER NOT NULL,
            option_id INTEGER NOT NULL,
            PRIMARY KEY (tournament_id, option_id),
            FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON DELETE CASCADE,
            FOREIGN KEY (option_id) REFERENCES tournament_registration_options(id) ON DELETE CASCADE
        )');

        $this->pdo->exec('CREATE TABLE tournament_games (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            slug TEXT NOT NULL,
            label TEXT NOT NULL,
            sort_order INTEGER NOT NULL DEFAULT 0,
            active INTEGER NOT NULL DEFAULT 1
        )');
        $this->pdo->exec('CREATE TABLE tournament_game_selection (
            tournament_id INTEGER NOT NULL,
            game_id INTEGER NOT NULL,
            PRIMARY KEY (tournament_id, game_id),
            FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON DELETE CASCADE,
            FOREIGN KEY (game_id) REFERENCES tournament_games(id) ON DELETE CASCADE
        )');

        $this->pdo->exec('CREATE TABLE tournament_content_blocks (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            page_slug TEXT,
            theme TEXT,
            block_key TEXT,
            block_label TEXT,
            content TEXT,
            position INTEGER,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT DEFAULT CURRENT_TIMESTAMP
        )');

        $this->pdo->exec('CREATE TABLE tournament_audit_log (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            tournament_id INTEGER NOT NULL,
            admin_id INTEGER,
            action TEXT NOT NULL,
            notes TEXT,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON DELETE CASCADE,
            FOREIGN KEY (admin_id) REFERENCES admin_users(id) ON DELETE SET NULL
        )');
    }

    private function seedLookups(): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO tournament_registration_options (slug, label, sort_order, active) VALUES (?, ?, ?, 1)');
        foreach ([
            ['email', 'Email-In Registration', 1],
            ['walk-in', 'Walk-In Registration', 2],
            ['web', 'Web Registration', 3],
        ] as $row) {
            $stmt->execute($row);
        }

        $stmt = $this->pdo->prepare('INSERT INTO tournament_games (slug, label, sort_order, active) VALUES (?, ?, ?, 1)');
        foreach ([
            ['cs', 'Counter-Strike', 1],
            ['css', 'Counter-Strike: Source', 2],
            ['hl2', 'Half-Life 2', 3],
        ] as $row) {
            $stmt->execute($row);
        }
    }
}
