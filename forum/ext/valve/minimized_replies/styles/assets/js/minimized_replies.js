/**
 * Steam Forum Minimized Replies JavaScript
 * Replicates vBulletin-style minimized reply system
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

// Global variables for minimized replies system
var minimizedPosts = {};
var postTree = {};
var currentPostId = 0;
var expandedPosts = {};

/**
 * Initialize minimized replies system
 */
function initializeMinimizedReplies() {
    // Load post data from template variables
    if (typeof MINIMIZED_POSTS !== 'undefined') {
        minimizedPosts = JSON.parse(MINIMIZED_POSTS);
    }

    if (typeof POST_TREE_DATA !== 'undefined') {
        postTree = JSON.parse(POST_TREE_DATA);
    }

    // Set up event handlers
    setupMinimizedClickHandlers();

    // Initialize view mode controls
    initializeViewModeControls();
}

/**
 * Write minimized post link (replicates vBulletin writeLink function)
 */
function writeLink(postId, parentId, depth, userId, treeIcon, preview, postDate, postTime, isNew) {
    var postData = minimizedPosts[postId];
    if (!postData) return;

    var statusIcon = isNew ? 'post_new.gif' : 'post_old.gif';
    var treeIconPath = '../forum/ext/valve/minimized_replies/styles/assets/images/' + treeIcon;
    var statusIconPath = '../forum/ext/valve/minimized_replies/styles/assets/images/' + statusIcon;

    var html = '<div class="alt1 minimized-post" id="div' + postId + '">' +
               '<img src="' + treeIconPath + '" alt="">' +
               '<img src="' + statusIconPath + '" alt=""> ' +
               '<b>' + postData.username + '</b> ' +
               '<a href="#post' + postId + '" onclick="return showPost(' + postId + ')" ' +
               'id="link' + postId + '" style="font-weight: normal;">' +
               '<i>' + preview + '</i></a> ' +
               postDate + ', <span class="time">' + postTime + '</span>' +
               '</div>';

    document.write(html);
}

/**
 * Show full post content (expand minimized post)
 */
function showPost(postId) {
    postId = parseInt(postId);

    if (expandedPosts[postId]) {
        // Post is already expanded, just scroll to it
        scrollToPost(postId);
        return false;
    }

    // Show loading indicator
    showPostLoading(postId);

    // AJAX request to get full post content
    fetch('forum/app.php/valve/minimized_replies/get_post/' + postId, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayExpandedPost(postId, data.post);
            expandedPosts[postId] = true;
            scrollToPost(postId);
        } else {
            showPostError(postId, data.error || 'Error loading post');
        }
    })
    .catch(error => {
        console.error('Error loading post:', error);
        showPostError(postId, 'Network error loading post');
    });

    return false;
}

/**
 * Display expanded post content
 */
function displayExpandedPost(postId, postData) {
    var expandedHtml = buildExpandedPostHtml(postId, postData);

    // Find the minimized post container
    var minimizedDiv = document.getElementById('div' + postId);
    if (minimizedDiv) {
        // Replace minimized content with expanded content
        var expandedContainer = document.createElement('div');
        expandedContainer.innerHTML = expandedHtml;
        expandedContainer.className = 'expanded-post';
        expandedContainer.id = 'expanded' + postId;

        // Insert expanded post after minimized post
        minimizedDiv.parentNode.insertBefore(expandedContainer, minimizedDiv.nextSibling);

        // Hide the minimized version
        minimizedDiv.style.display = 'none';

        // Add collapse button
        addCollapseButton(postId);
    }
}

/**
 * Build expanded post HTML (similar to vBulletin post layout)
 */
function buildExpandedPostHtml(postId, postData) {
    return '<table id="post' + postId + '" class="tborder" cellpadding="6" cellspacing="0" border="0" width="100%" align="center">' +
           '<tr>' +
               '<td class="thead" style="font-weight:normal; border: 1px solid #000000; border-right: 0px">' +
                   '<a name="post' + postId + '"></a>' +
                   '<img class="inlineimg" src="../forum/ext/valve/minimized_replies/styles/assets/images/post_old.gif" alt="Old" border="0" title="Old">' +
                   ' ' + postData.post_time +
               '</td>' +
               '<td class="thead" style="font-weight:normal; border: 1px solid #000000; border-left: 0px" align="right">' +
                   '&nbsp;' +
               '</td>' +
           '</tr>' +
           '<tr valign="top">' +
               '<td class="alt2" width="175" style="border: 1px solid #000000; border-top: 0px; border-bottom: 0px">' +
                   '<div class="bigusername">' + postData.username + '</div>' +
                   '<div class="smallfont">' +
                       (postData.poster_joined ? 'Join Date: ' + postData.poster_joined + '<br>' : '') +
                       (postData.poster_posts ? 'Posts: ' + postData.poster_posts : '') +
                   '</div>' +
               '</td>' +
               '<td class="alt1" style="border: 1px solid #000000; border-left: 0px; border-top: 0px; border-bottom: 0px">' +
                   (postData.post_subject ? '<div class="smallfont"><b>' + postData.post_subject + '</b></div>' : '') +
                   '<div class="post-content">' + postData.message + '</div>' +
                   (postData.signature ? '<div class="signature">' + postData.signature + '</div>' : '') +
               '</td>' +
           '</tr>' +
           '<tr>' +
               '<td class="tfoot" style="border: 1px solid #000000; border-top: 0px" colspan="2">' +
                   '<div class="post-controls">' +
                       '<a href="javascript:void(0)" onclick="collapsePost(' + postId + ')">Minimize Post</a>' +
                   '</div>' +
               '</td>' +
           '</tr>' +
           '</table><br>';
}

/**
 * Collapse expanded post back to minimized view
 */
function collapsePost(postId) {
    var expandedContainer = document.getElementById('expanded' + postId);
    var minimizedDiv = document.getElementById('div' + postId);

    if (expandedContainer && minimizedDiv) {
        // Remove expanded content
        expandedContainer.parentNode.removeChild(expandedContainer);

        // Show minimized version again
        minimizedDiv.style.display = '';

        // Mark as no longer expanded
        delete expandedPosts[postId];
    }
}

/**
 * Show loading indicator for post
 */
function showPostLoading(postId) {
    var linkElement = document.getElementById('link' + postId);
    if (linkElement) {
        linkElement.innerHTML = '<i>Loading...</i>';
        linkElement.style.color = '#999';
    }
}

/**
 * Show error message for post
 */
function showPostError(postId, errorMsg) {
    var linkElement = document.getElementById('link' + postId);
    if (linkElement) {
        linkElement.innerHTML = '<i>Error: ' + errorMsg + '</i>';
        linkElement.style.color = '#ff0000';
    }
}

/**
 * Scroll to specific post
 */
function scrollToPost(postId) {
    var element = document.getElementById('post' + postId) || document.getElementById('div' + postId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

/**
 * Add collapse button to expanded post
 */
function addCollapseButton(postId) {
    // Button is already included in the buildExpandedPostHtml function
}

/**
 * Set up click handlers for minimized posts
 */
function setupMinimizedClickHandlers() {
    // Event delegation for dynamically added minimized posts
    document.addEventListener('click', function(event) {
        var target = event.target;

        // Check if clicked element is a minimized post link
        if (target.tagName === 'A' && target.id && target.id.startsWith('link')) {
            var postId = target.id.replace('link', '');
            if (postId && !isNaN(postId)) {
                event.preventDefault();
                showPost(parseInt(postId));
                return false;
            }
        }
    });
}

/**
 * Initialize view mode controls (threaded/linear)
 */
function initializeViewModeControls() {
    // Add view mode toggle buttons if not present
    var viewModeContainer = document.getElementById('view-mode-controls');
    if (!viewModeContainer) {
        // Create view mode controls
        createViewModeControls();
    }
}

/**
 * Create view mode control buttons
 */
function createViewModeControls() {
    var controlsHtml = '<div id="view-mode-controls" class="smallfont" style="margin: 10px 0;">' +
                      '<div><img class="inlineimg" src="../forum/ext/valve/minimized_replies/styles/assets/images/mode_linear.gif" alt="Linear Mode" title="Linear Mode"> ' +
                      '<a href="javascript:switchViewMode(\'linear\')">Switch to Linear Mode</a></div>' +
                      '<div><img class="inlineimg" src="../forum/ext/valve/minimized_replies/styles/assets/images/mode_hybrid.gif" alt="Hybrid Mode" title="Hybrid Mode"> ' +
                      '<a href="javascript:switchViewMode(\'hybrid\')">Switch to Hybrid Mode</a></div>' +
                      '<div><img class="inlineimg" src="../forum/ext/valve/minimized_replies/styles/assets/images/mode_threaded.gif" alt="Threaded Mode" title="Threaded Mode"> ' +
                      '<strong>Threaded Mode</strong></div>' +
                      '</div>';

    // Find a good place to insert the controls (after breadcrumbs)
    var breadcrumbs = document.querySelector('.navbar');
    if (breadcrumbs && breadcrumbs.parentNode) {
        var controlsContainer = document.createElement('div');
        controlsContainer.innerHTML = controlsHtml;
        breadcrumbs.parentNode.insertBefore(controlsContainer, breadcrumbs.nextSibling);
    }
}

/**
 * Switch view mode (linear/threaded/hybrid)
 */
function switchViewMode(mode) {
    var currentUrl = window.location.href;
    var separator = currentUrl.indexOf('?') !== -1 ? '&' : '?';
    var newUrl = currentUrl.replace(/[&?]mode=[^&]*/g, '') + separator + 'mode=' + mode;

    window.location.href = newUrl;
}

/**
 * Navigation functions for next/previous posts (like vBulletin)
 */
function showPrevNextPost(direction) {
    // 0 = previous, 1 = next
    var postIds = Object.keys(postTree).map(Number).sort((a, b) => a - b);
    var currentIndex = postIds.indexOf(currentPostId);

    if (currentIndex !== -1) {
        var targetIndex = direction ? currentIndex + 1 : currentIndex - 1;
        if (targetIndex >= 0 && targetIndex < postIds.length) {
            var targetPostId = postIds[targetIndex];
            showPost(targetPostId);
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initializeMinimizedReplies();
});

// Also initialize if DOM is already loaded
if (document.readyState !== 'loading') {
    initializeMinimizedReplies();
}