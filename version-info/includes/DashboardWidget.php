<?php

declare(strict_types=1);

namespace GauchoPlugins\VersionInfo;

class DashboardWidget {

    public function register(): void {
        add_action( 'wp_dashboard_setup', [ $this, 'maybe_add_widget' ] );
    }

    public function maybe_add_widget(): void {
        if ( ! get_option( 'version_info_show_dashboard_widget', false ) || ! Plugin::current_user_can_view() ) {
            return;
        }

        wp_add_dashboard_widget(
            'version_info_dashboard_widget',
            __( 'Version Info', 'version-info' ),
            [ $this, 'render' ]
        );
    }

    public function render(): void {
        global $wpdb;

        $items = [
            'wordpress' => [
                'label' => __( 'WordPress Version:', 'version-info' ),
                'value' => apply_filters( 'version_info_wp_version', get_bloginfo( 'version' ) ),
            ],
            'php' => [
                'label' => __( 'PHP Version:', 'version-info' ),
                'value' => apply_filters( 'version_info_php_version', phpversion() ),
            ],
            'server' => [
                'label' => __( 'Web Server:', 'version-info' ),
                'value' => apply_filters(
                    'version_info_server_software',
                    sanitize_text_field( $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' )
                ),
            ],
            'mysql' => [
                'label' => __( 'MySQL Version:', 'version-info' ),
                'value' => apply_filters( 'version_info_mysql_version', (string) $wpdb->db_version() ),
            ],
        ];

        /** @var array<string, array{label: string, value: string}> $items */
        $items = apply_filters( 'version_info_dashboard_widget_items', $items );

        echo '<ul>';
        foreach ( $items as $item ) {
            echo '<li><strong>' . esc_html( $item['label'] ) . '</strong> ' . esc_html( $item['value'] ) . '</li>';
        }
        echo '</ul>';
    }
}
