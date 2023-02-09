<?php

namespace Castlegate\AdminNotifications;

class Plugin
{
    /**
     * User roles who can see admin notifications.
     *
     * @var array
     */
    private $notificaton_roles = [
        'administrator',
    ];

    /**
     * CSS selectors used to hide admin notifications.
     *
     * @var array
     */
    private $css = [
        'body.wp-admin .update-plugins',
        'body.wp-admin #wp-admin-bar-updates',
        'body.wp-admin .update-nag',
        'body.wp-admin .update',
        'body.wp-admin .error',
        'body.wp-admin .is-dismissible',
        'body.wp-admin .notice',
    ];

    /**
     * Set the admin_head action used to hide admin notifications.
     *
     * @return self
     */
    public function __construct()
    {
        add_action('admin_head', [$this, 'init']);
    }

    /**
     * Outputs CSS to hide admin notifications if the currently logged in user
     * is not in the allowed list of user roles.
     *
     * @return void
     */
    public function init(): void
    {
        // Check if the current user can see admin notifications or not.
        $user = wp_get_current_user();
        $current_user_roles = (array) $user->roles;

        // Check the current user matches one of the allowed roles for notifications
        foreach ($this->getRoles() as $role) {
            if (in_array($role, $current_user_roles)) {
                return;
            }
        }

        // Output styles.
        echo '<style>'.implode(', ', $this->getCss()).'{display: none !important;}</style>';
    }

    /**
     * Return a filtered list of CSS selectors used to hide admin notifications.
     *
     * @return array
     */
    private function getCss(): array
    {
        return apply_filters('cgit/wp_admin_notificatons/css', $this->css);
    }

    /**
     * Return a filtered list of roles which are allowed to see admin
     * notifications.
     *
     * @return array
     */
    private function getRoles(): array
    {
        return apply_filters('cgit/wp_admin_notificatons/notificaton_roles', $this->notificaton_roles);
    }
}
