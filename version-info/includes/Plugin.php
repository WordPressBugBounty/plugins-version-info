<?php

declare (strict_types = 1);
namespace GauchoPlugins\VersionInfo;

class Plugin {
    private AdminBar $admin_bar;

    private DashboardWidget $dashboard_widget;

    private SettingsPage $settings_page;

    public function init() : void {
        $this->admin_bar = new AdminBar();
        $this->dashboard_widget = new DashboardWidget();
        $this->settings_page = new SettingsPage();
        add_action( 'plugins_loaded', [$this, 'load_text_domain'] );
        add_filter( 'update_footer', [$this, 'version_in_footer'], 11 );
        $this->admin_bar->register();
        $this->dashboard_widget->register();
        $this->settings_page->register();
        $this->maybe_init_pro();
    }

    public static function current_user_can_view() : bool {
        $roles = (array) get_option( 'version_info_allowed_roles', ['administrator'] );
        /** @var string[] $roles */
        $roles = apply_filters( 'version_info_allowed_roles', $roles );
        $user = wp_get_current_user();
        if ( !$user->exists() ) {
            return false;
        }
        return !empty( array_intersect( $roles, (array) $user->roles ) );
    }

    public function load_text_domain() : void {
        load_plugin_textdomain( 'version-info', false, dirname( plugin_basename( VERSION_INFO_FILE ) ) . '/languages' );
    }

    public function version_in_footer() : string {
        if ( !get_option( 'version_info_show_footer', true ) || !self::current_user_can_view() ) {
            return '';
        }
        return $this->get_footer_version_details();
    }

    private function get_footer_version_details() : string {
        $wp_version = apply_filters( 'version_info_wp_version', get_bloginfo( 'version' ) );
        $update_message = '';
        $updates = get_core_updates();
        if ( !empty( $updates ) && !is_wp_error( $updates ) ) {
            foreach ( $updates as $update ) {
                if ( version_compare( $wp_version, $update->version, '<' ) ) {
                    $update_message = sprintf(
                        ' (<a href="%s">%s %s</a>)',
                        esc_url( admin_url( 'update-core.php' ) ),
                        __( 'Get Version', 'version-info' ),
                        esc_html( $update->version )
                    );
                    break;
                }
            }
        }
        global $wpdb;
        $server_software = apply_filters( 'version_info_server_software', sanitize_text_field( $_SERVER['SERVER_SOFTWARE'] ?? __( 'Unknown', 'version-info' ) ) );
        $mysql_version = apply_filters( 'version_info_mysql_version', (string) $wpdb->get_var( 'SELECT VERSION()' ) );
        $php_version = apply_filters( 'version_info_php_version', phpversion() );
        $details = sprintf(
            /* translators: %1$s: WP version, %2$s: update link, %3$s: PHP version, %4$s: server software, %5$s: MySQL version */
            __( 'WordPress %1$s%2$s | PHP %3$s | Web Server %4$s | MySQL %5$s', 'version-info' ),
            esc_html( $wp_version ),
            $update_message,
            esc_html( $php_version ),
            esc_html( $server_software ),
            esc_html( $mysql_version )
        );
        return apply_filters( 'version_info_footer_details', $details );
    }

    private function maybe_init_pro() : void {
    }

}
