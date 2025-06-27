<?php
// Main page content management for early themes (2002-2004)

if (!in_array($current_theme, ['2002', '2003', '2004'])) {
    echo '<div class="alert alert-warning">Main page content editing is only available for themes 2002, 2003, and 2004.</div>';
    return;
}

$message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update_content':
                try {
                    $content = $_POST['content'];
                    
                    // Check if content exists for this theme
                    $existing = $db->queryOne(
                        "SELECT id FROM main_page_content WHERE theme = ?", 
                        [$current_theme]
                    );
                    
                    if ($existing) {
                        // Update existing content
                        $db->update('main_page_content', [
                            'content' => $content,
                            'updated_by' => $_SESSION['admin_user']['id']
                        ], 'theme = ?', [$current_theme]);
                    } else {
                        // Insert new content
                        $db->insert('main_page_content', [
                            'theme' => $current_theme,
                            'content' => $content,
                            'updated_by' => $_SESSION['admin_user']['id']
                        ]);
                    }
                    
                    $message = '<div class="alert alert-success">Main page content updated successfully!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
                
            case 'reset_content':
                try {
                    $default_content = getDefaultContent($current_theme);
                    
                    $existing = $db->queryOne(
                        "SELECT id FROM main_page_content WHERE theme = ?", 
                        [$current_theme]
                    );
                    
                    if ($existing) {
                        $db->update('main_page_content', [
                            'content' => $default_content,
                            'updated_by' => $_SESSION['admin_user']['id']
                        ], 'theme = ?', [$current_theme]);
                    } else {
                        $db->insert('main_page_content', [
                            'theme' => $current_theme,
                            'content' => $default_content,
                            'updated_by' => $_SESSION['admin_user']['id']
                        ]);
                    }
                    
                    $message = '<div class="alert alert-success">Content reset to default for theme ' . htmlspecialchars($current_theme) . '!</div>';
                } catch (Exception $e) {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
                break;
        }
    }
}

// Get current content
$current_content = $db->queryOne(
    "SELECT * FROM main_page_content WHERE theme = ?", 
    [$current_theme]
);

if (!$current_content) {
    // Create default content if none exists
    $default_content = getDefaultContent($current_theme);
    $current_content = [
        'content' => $default_content,
        'updated_at' => null,
        'updated_by' => null
    ];
}

function getDefaultContent($theme) {
    switch ($theme) {
        case '2002':
            return '<p><b>Steam - the future of digital distribution</b></p>

<p>Steam is Valve\'s revolutionary content delivery platform. With Steam you can:</p>

<ul>
    <li>Get automatic updates for all your games</li>
    <li>Access enhanced anti-piracy protection</li>
    <li>Join the largest gaming community</li>
    <li>Purchase and download games instantly</li>
</ul>

<p><b>Steam System Requirements:</b><br>
• Windows 2000/XP<br>
• DirectX 8.0 or higher<br>
• Internet connection required<br>
• 128MB RAM minimum</p>

<p><font size="1" color="#999999">
    Steam is currently in beta testing. Features and functionality may change.
</font></p>';
            
        case '2003':
            return '<p><b>Welcome to Steam - Your Gaming Platform</b></p>

<p>Steam has entered public beta! Download the Steam client to experience:</p>

<ul>
    <li>Automatic game updates and patches</li>
    <li>Friends list and instant messaging</li>
    <li>Enhanced server browser</li>
    <li>Anti-cheat protection</li>
    <li>Game statistics and achievements</li>
</ul>

<p><b>Now Available on Steam:</b></p>
<ul>
    <li>Counter-Strike 1.6</li>
    <li>Day of Defeat</li>
    <li>Team Fortress Classic</li>
    <li>Deathmatch Classic</li>
</ul>

<p><b>Join thousands of players online!</b> Steam makes it easier than ever to find games, connect with friends, and enjoy the ultimate gaming experience.</p>';
            
        case '2004':
            return '<p><b>Half-Life 2 Available Now!</b></p>

<p>Experience the most anticipated game of the decade through Steam. Half-Life 2 features:</p>

<ul>
    <li>Revolutionary Source engine with realistic physics</li>
    <li>Stunning graphics and immersive gameplay</li>
    <li>Compelling storyline continuing Gordon Freeman\'s saga</li>
    <li>Innovative gameplay mechanics and puzzles</li>
</ul>

<p><b>The Orange Box includes:</b></p>
<ul>
    <li>Half-Life 2</li>
    <li>Half-Life 2: Episode One</li>
    <li>Counter-Strike: Source</li>
    <li>Half-Life: Source</li>
</ul>

<p><b>Steam Platform Features:</b></p>
<ul>
    <li>Instant game downloads</li>
    <li>Automatic updates</li>
    <li>Voice communication</li>
    <li>Friends and community features</li>
    <li>Secure online purchasing</li>
</ul>

<p><b>Purchase Half-Life 2 now and start playing immediately!</b></p>';
            
        default:
            return '<p>Welcome to Steam! Configure your main page content here.</p>';
    }
}
?>

<?= $message ?>

<div class="card">
    <div class="card-header">
        <h3>Main Page Content for <?= htmlspecialchars($current_theme) ?></h3>
        <p style="font-size: 12px; color: #7f8c8d; margin: 5px 0 0 0;">
            Edit the main body content that appears on the homepage for this theme
        </p>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="update_content">
            
            <div class="form-group">
                <label for="content">Main Page Content</label>
                <div style="border: 1px solid #ddd; border-radius: 4px;">
                    <div id="editor-toolbar" style="border-bottom: 1px solid #ddd; padding: 10px; background: #f8f9fa;">
                        <button type="button" onclick="formatText('bold')" class="btn btn-small">B</button>
                        <button type="button" onclick="formatText('italic')" class="btn btn-small">I</button>
                        <button type="button" onclick="formatText('underline')" class="btn btn-small">U</button>
                        <span style="margin: 0 10px;">|</span>
                        <button type="button" onclick="insertHeading()" class="btn btn-small">H</button>
                        <button type="button" onclick="insertLink()" class="btn btn-small">Link</button>
                        <button type="button" onclick="insertImage()" class="btn btn-small">Image</button>
                        <span style="margin: 0 10px;">|</span>
                        <button type="button" onclick="insertList('ul')" class="btn btn-small">• List</button>
                        <button type="button" onclick="insertList('ol')" class="btn btn-small">1. List</button>
                        <span style="margin: 0 10px;">|</span>
                        <button type="button" onclick="insertParagraph()" class="btn btn-small">¶ Paragraph</button>
                        <button type="button" onclick="insertLineBreak()" class="btn btn-small">↵ Break</button>
                    </div>
                    <div id="content-editor" 
                         contenteditable="true" 
                         style="min-height: 400px; padding: 20px; outline: none; font-family: Arial, sans-serif; line-height: 1.5;"
                         onkeyup="updateHiddenField()"
                         onpaste="setTimeout(updateHiddenField, 10)"><?= $current_content['content'] ?></div>
                </div>
                <textarea id="content" name="content" style="display: none;" required><?= htmlspecialchars($current_content['content']) ?></textarea>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-large">Update Main Content</button>
                
                <form method="POST" style="display: inline; margin-left: 10px;" 
                      onsubmit="return confirm('Reset to default content for <?= htmlspecialchars($current_theme) ?>? This will overwrite your current content.')">
                    <input type="hidden" name="action" value="reset_content">
                    <button type="submit" class="btn btn-warning">Reset to Default</button>
                </form>
                
                <a href="../index.php?theme=<?= $current_theme ?>" target="_blank" class="btn btn-primary" style="margin-left: 10px;">
                    👁️ Preview Changes
                </a>
            </div>
        </form>
    </div>
</div>

<?php if ($current_content['updated_at']): ?>
<div class="card">
    <div class="card-header">
        <h3>Content History</h3>
    </div>
    <div class="card-body">
        <p><strong>Last Updated:</strong> <?= date('F j, Y g:i A', strtotime($current_content['updated_at'])) ?></p>
        <?php if ($current_content['updated_by']): ?>
            <?php 
            $updater = $db->queryOne("SELECT username FROM users WHERE id = ?", [$current_content['updated_by']]);
            ?>
            <p><strong>Updated By:</strong> <?= htmlspecialchars($updater['username'] ?? 'Unknown') ?></p>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h3>Theme Information</h3>
    </div>
    <div class="card-body">
        <p><strong>Theme:</strong> <?= htmlspecialchars($current_theme) ?></p>
        <p><strong>Description:</strong> 
            <?php
            switch ($current_theme) {
                case '2002':
                    echo 'Early Steam beta with simple table layout and basic features.';
                    break;
                case '2003':
                    echo 'Steam public beta with two-column layout and expanded features.';
                    break;
                case '2004':
                    echo 'Half-Life 2 era with promotional design and Source engine showcase.';
                    break;
                default:
                    echo 'Steam historical theme.';
            }
            ?>
        </p>
        <p><strong>Layout Type:</strong> Table-based layout with inline styling</p>
        <p><strong>Recommended Content:</strong> Use period-appropriate language and features for this era of Steam</p>
    </div>
</div>

<script>
// WYSIWYG Editor Functions
function formatText(command) {
    document.execCommand(command, false, null);
    updateHiddenField();
}

function insertHeading() {
    const text = prompt('Enter heading text:');
    if (text) {
        document.execCommand('insertHTML', false, '<h3>' + text + '</h3>');
        updateHiddenField();
    }
}

function insertLink() {
    const url = prompt('Enter URL:');
    if (url) {
        const text = prompt('Enter link text:') || url;
        document.execCommand('insertHTML', false, '<a href="' + url + '">' + text + '</a>');
        updateHiddenField();
    }
}

function insertImage() {
    const url = prompt('Enter image URL:');
    if (url) {
        const alt = prompt('Enter alt text:') || 'Image';
        document.execCommand('insertHTML', false, '<img src="' + url + '" alt="' + alt + '" style="max-width: 100%;">');
        updateHiddenField();
    }
}

function insertList(type) {
    if (type === 'ul') {
        document.execCommand('insertUnorderedList', false, null);
    } else {
        document.execCommand('insertOrderedList', false, null);
    }
    updateHiddenField();
}

function insertParagraph() {
    document.execCommand('insertHTML', false, '<p></p>');
    updateHiddenField();
}

function insertLineBreak() {
    document.execCommand('insertHTML', false, '<br>');
    updateHiddenField();
}

function updateHiddenField() {
    const editor = document.getElementById('content-editor');
    const hiddenField = document.getElementById('content');
    hiddenField.value = editor.innerHTML;
}

// Initialize editor
document.addEventListener('DOMContentLoaded', function() {
    updateHiddenField();
});
</script>

<style>
#content-editor {
    line-height: 1.6;
}

#content-editor h1, #content-editor h2, #content-editor h3 {
    margin: 15px 0 10px 0;
    color: #2c3e50;
}

#content-editor p {
    margin: 10px 0;
}

#content-editor a {
    color: #3498db;
    text-decoration: underline;
}

#content-editor ul, #content-editor ol {
    margin: 10px 0;
    padding-left: 30px;
}

#content-editor li {
    margin: 5px 0;
}

#content-editor img {
    max-width: 100%;
    height: auto;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin: 10px 0;
}

#content-editor b, #content-editor strong {
    font-weight: bold;
}

#content-editor i, #content-editor em {
    font-style: italic;
}

#content-editor u {
    text-decoration: underline;
}

/* Period-appropriate styling hints */
.theme-2002 #content-editor {
    font-family: Arial, sans-serif;
    color: #333;
}

.theme-2003 #content-editor {
    font-family: Arial, sans-serif;
    color: #333;
}

.theme-2004 #content-editor {
    font-family: Arial, sans-serif;
    color: #333;
}
</style>
