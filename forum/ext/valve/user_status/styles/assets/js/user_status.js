/**
 * Steam User Status Extension JavaScript
 * vBulletin-style user status functionality
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

// Global variables
var userStatusModule = {
    updateTimer: null,
    currentUserId: 0,
    updateInterval: 60000, // 1 minute default

    /**
     * Initialize user status module
     */
    init: function() {
        // Set current user ID if available
        if (typeof USER_ID !== 'undefined') {
            this.currentUserId = USER_ID;
        }

        // Set update interval from config
        if (typeof USER_STATUS_UPDATE_INTERVAL !== 'undefined') {
            this.updateInterval = USER_STATUS_UPDATE_INTERVAL * 1000;
        }

        // Initialize event handlers
        this.setupEventHandlers();

        // Start automatic status updates if user is logged in
        if (this.currentUserId > 0) {
            this.startStatusUpdates();
        }

        // Load initial online users
        this.loadOnlineUsers();
    },

    /**
     * Setup event handlers
     */
    setupEventHandlers: function() {
        var self = this;

        // Status update form submission
        $(document).on('submit', '.user-status-form', function(e) {
            e.preventDefault();
            self.updateStatus($(this));
        });

        // Quick status selector
        $(document).on('click', '.quick-status-trigger', function(e) {
            e.preventDefault();
            self.toggleQuickStatusMenu($(this));
        });

        // Quick status option selection
        $(document).on('click', '.quick-status-menu .status-option', function(e) {
            e.preventDefault();
            self.selectQuickStatus($(this));
        });

        // Close quick status menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.quick-status-selector').length) {
                $('.quick-status-menu').removeClass('active');
            }
        });

        // Steam status integration
        $(document).on('change', '#steam_status', function() {
            self.handleSteamStatusChange($(this));
        });

        // Refresh online users button
        $(document).on('click', '.refresh-online-users', function(e) {
            e.preventDefault();
            self.loadOnlineUsers();
        });
    },

    /**
     * Update user status via AJAX
     */
    updateStatus: function(form) {
        var self = this;
        var formData = form.serialize();

        // Add form token
        if (typeof FORM_TOKEN !== 'undefined') {
            formData += '&form_token=' + FORM_TOKEN;
        }

        // Show loading state
        form.find('.submit-button').prop('disabled', true).text('Updating...');
        $('.user-status').addClass('updating');

        $.ajax({
            url: 'app.php/valve/user_status/update',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Update status display
                    self.updateStatusDisplay(response);
                    self.showStatusMessage('Status updated successfully', 'success');
                } else {
                    self.showStatusMessage(response.error || 'Failed to update status', 'error');
                }
            },
            error: function() {
                self.showStatusMessage('Network error occurred', 'error');
            },
            complete: function() {
                form.find('.submit-button').prop('disabled', false).text('Update Status');
                $('.user-status').removeClass('updating').addClass('updated');
                setTimeout(function() {
                    $('.user-status').removeClass('updated');
                }, 500);
            }
        });
    },

    /**
     * Update status display elements
     */
    updateStatusDisplay: function(statusData) {
        // Update user status indicators throughout the page
        $('.user-status[data-user-id="' + this.currentUserId + '"]').html(statusData.status_indicator);

        // Update Steam status if present
        if (statusData.steam_status) {
            $('.steam-status[data-user-id="' + this.currentUserId + '"]').removeClass()
                .addClass('steam-status steam-status-' + statusData.steam_status)
                .text(statusData.steam_status === 'in-game' && statusData.current_game ?
                      'Playing: ' + statusData.current_game : statusData.steam_status);
        }

        // Update status message displays
        $('.status-message[data-user-id="' + this.currentUserId + '"]').text(statusData.status_message);
    },

    /**
     * Toggle quick status menu
     */
    toggleQuickStatusMenu: function(trigger) {
        var menu = trigger.siblings('.quick-status-menu');

        // Close other menus
        $('.quick-status-menu').not(menu).removeClass('active');

        // Toggle current menu
        menu.toggleClass('active');
    },

    /**
     * Select quick status option
     */
    selectQuickStatus: function(option) {
        var statusMode = option.data('status-mode');
        var statusMessage = option.data('status-message') || '';
        var steamStatus = option.data('steam-status') || '';

        // Update form fields if present
        $('#status_mode').val(statusMode);
        $('#status_message').val(statusMessage);
        $('#steam_status').val(steamStatus);

        // Submit form automatically
        var form = option.closest('.quick-status-selector').siblings('.user-status-form');
        if (form.length) {
            this.updateStatus(form);
        }

        // Close menu
        $('.quick-status-menu').removeClass('active');
    },

    /**
     * Handle Steam status changes
     */
    handleSteamStatusChange: function(select) {
        var steamStatus = select.val();
        var gameField = $('#current_game');

        if (steamStatus === 'in-game') {
            gameField.show().focus();
        } else {
            gameField.hide().val('');
        }
    },

    /**
     * Load online users with status
     */
    loadOnlineUsers: function() {
        var container = $('.online-users-status-container');
        if (!container.length) return;

        container.addClass('loading');

        $.ajax({
            url: 'app.php/valve/user_status/online',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    userStatusModule.displayOnlineUsers(response.users);
                }
            },
            error: function() {
                console.error('Failed to load online users');
            },
            complete: function() {
                container.removeClass('loading');
            }
        });
    },

    /**
     * Display online users list
     */
    displayOnlineUsers: function(users) {
        var container = $('.online-users-status-list');
        if (!container.length) return;

        container.empty();

        if (users.length === 0) {
            container.html('<div class="no-users">No users currently online</div>');
            return;
        }

        $.each(users, function(index, user) {
            var userHtml = '<div class="user-entry" data-user-id="' + user.user_id + '">' +
                          '<span class="username" style="color: ' + (user.user_colour || '') + '">' + user.username + '</span> ' +
                          user.status_indicator;

            if (user.status_message) {
                userHtml += ' <span class="status-message">' + user.status_message + '</span>';
            }

            if (user.steam_status && user.steam_status !== 'offline') {
                var steamText = user.steam_status;
                if (user.steam_status === 'in-game' && user.current_game) {
                    steamText = 'Playing: ' + user.current_game;
                }
                userHtml += ' <span class="steam-status steam-status-' + user.steam_status + '">' + steamText + '</span>';
            }

            userHtml += '</div>';
            container.append(userHtml);
        });
    },

    /**
     * Start automatic status updates
     */
    startStatusUpdates: function() {
        var self = this;

        if (this.updateTimer) {
            clearInterval(this.updateTimer);
        }

        this.updateTimer = setInterval(function() {
            self.refreshUserStatuses();
        }, this.updateInterval);
    },

    /**
     * Stop automatic status updates
     */
    stopStatusUpdates: function() {
        if (this.updateTimer) {
            clearInterval(this.updateTimer);
            this.updateTimer = null;
        }
    },

    /**
     * Refresh user statuses on page
     */
    refreshUserStatuses: function() {
        var self = this;
        var userIds = [];

        // Collect all user IDs visible on page
        $('.user-status[data-user-id]').each(function() {
            var userId = $(this).data('user-id');
            if (userId && userIds.indexOf(userId) === -1) {
                userIds.push(userId);
            }
        });

        // Load updated status for each user
        $.each(userIds, function(index, userId) {
            self.getUserStatus(userId);
        });

        // Also refresh online users list
        this.loadOnlineUsers();
    },

    /**
     * Get specific user status
     */
    getUserStatus: function(userId) {
        $.ajax({
            url: 'app.php/valve/user_status/get/' + userId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    userStatusModule.updateUserStatusDisplay(userId, response);
                }
            },
            error: function() {
                console.error('Failed to get user status for user ID: ' + userId);
            }
        });
    },

    /**
     * Update user status display for specific user
     */
    updateUserStatusDisplay: function(userId, statusData) {
        // Update status indicators for this user
        $('.user-status[data-user-id="' + userId + '"]').html(statusData.status_indicator);

        // Update Steam status
        if (statusData.steam_status) {
            $('.steam-status[data-user-id="' + userId + '"]')
                .removeClass()
                .addClass('steam-status steam-status-' + statusData.steam_status)
                .text(statusData.steam_status === 'in-game' && statusData.current_game ?
                      'Playing: ' + statusData.current_game : statusData.steam_status);
        }

        // Update status messages
        $('.status-message[data-user-id="' + userId + '"]').text(statusData.status_message);
    },

    /**
     * Show status message to user
     */
    showStatusMessage: function(message, type) {
        var messageClass = type === 'error' ? 'error' : 'success';
        var messageHtml = '<div class="status-notification ' + messageClass + '">' + message + '</div>';

        // Remove existing notifications
        $('.status-notification').remove();

        // Add new notification
        $('body').append(messageHtml);

        // Auto-hide after 3 seconds
        setTimeout(function() {
            $('.status-notification').fadeOut(function() {
                $(this).remove();
            });
        }, 3000);
    }
};

// Initialize when DOM is ready
$(document).ready(function() {
    userStatusModule.init();
});

// Also initialize if DOM is already loaded
if (document.readyState !== 'loading') {
    userStatusModule.init();
}