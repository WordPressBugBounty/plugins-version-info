<?php

declare(strict_types=1);

namespace GauchoPlugins\VersionInfo;

class SettingsPage {

    private const PRO_TABS    = [ 'system_resources', 'environment', 'version_history', 'health_advisor', 'system_export' ];
    private const AGENCY_TABS = [ 'white_label', 'access_control', 'email_alerts', 'error_log' ];

    public function register(): void {
        add_action( 'admin_menu', [ $this, 'add_page' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    public function add_page(): void {
        add_options_page(
            __( 'Version Info Settings', 'version-info' ),
            __( 'Version Info', 'version-info' ),
            'manage_options',
            'version-info',
            [ $this, 'render' ]
        );
    }

    public function register_settings(): void {
        // General tab — own group so saving doesn't affect other tabs.
        register_setting( 'version_info_general_group', 'version_info_show_footer', [
            'type'              => 'boolean',
            'sanitize_callback' => [ $this, 'sanitize_bool' ],
            'default'           => true,
        ] );
        register_setting( 'version_info_general_group', 'version_info_show_admin_bar', [
            'type'              => 'boolean',
            'sanitize_callback' => [ $this, 'sanitize_bool' ],
            'default'           => false,
        ] );
        register_setting( 'version_info_general_group', 'version_info_show_dashboard_widget', [
            'type'              => 'boolean',
            'sanitize_callback' => [ $this, 'sanitize_bool' ],
            'default'           => false,
        ] );

        // Environment tab — isolated group.
        register_setting( 'version_info_environment_group', 'version_info_show_env_badge', [
            'type'              => 'boolean',
            'sanitize_callback' => [ $this, 'sanitize_bool' ],
            'default'           => false,
        ] );
        register_setting( 'version_info_environment_group', 'version_info_env_admin_bar_highlight', [
            'type'              => 'boolean',
            'sanitize_callback' => [ $this, 'sanitize_bool' ],
            'default'           => false,
        ] );

        // White Label tab — isolated group.
        register_setting( 'version_info_white_label_group', 'version_info_wl_plugin_name', [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ] );
        register_setting( 'version_info_white_label_group', 'version_info_wl_author_name', [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ] );
        register_setting( 'version_info_white_label_group', 'version_info_wl_hide_branding', [
            'type'              => 'boolean',
            'sanitize_callback' => [ $this, 'sanitize_bool' ],
            'default'           => false,
        ] );

        // Access Control tab — isolated group.
        register_setting( 'version_info_access_control_group', 'version_info_allowed_roles', [
            'type'              => 'array',
            'sanitize_callback' => [ $this, 'sanitize_roles' ],
            'default'           => [ 'administrator' ],
        ] );

        // Email Alerts tab — isolated group.
        register_setting( 'version_info_email_alerts_group', 'version_info_alert_enabled', [
            'type'              => 'boolean',
            'sanitize_callback' => [ $this, 'sanitize_bool' ],
            'default'           => false,
        ] );
        register_setting( 'version_info_email_alerts_group', 'version_info_alert_recipients', [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ] );
        register_setting( 'version_info_email_alerts_group', 'version_info_alert_types', [
            'type'              => 'array',
            'sanitize_callback' => [ $this, 'sanitize_alert_types' ],
            'default'           => [ 'wordpress', 'php', 'mysql' ],
        ] );
    }

    public function sanitize_bool( mixed $input ): bool {
        return filter_var( $input, FILTER_VALIDATE_BOOLEAN );
    }

    /**
     * @param mixed $input
     * @return string[]
     */
    public function sanitize_roles( mixed $input ): array {
        if ( ! is_array( $input ) ) {
            return [ 'administrator' ];
        }
        return array_map( 'sanitize_key', $input );
    }

    /**
     * @param mixed $input
     * @return string[]
     */
    public function sanitize_alert_types( mixed $input ): array {
        if ( ! is_array( $input ) ) {
            return [ 'wordpress', 'php', 'mysql' ];
        }
        $valid = [ 'wordpress', 'php', 'mysql' ];
        return array_values( array_intersect( array_map( 'sanitize_key', $input ), $valid ) );
    }

    public function render(): void {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $tabs = [
            'general'          => __( 'General', 'version-info' ),
            'system_resources' => __( 'System Resources', 'version-info' ),
            'environment'      => __( 'Environment', 'version-info' ),
            'version_history'  => __( 'Version History', 'version-info' ),
            'health_advisor'   => __( 'Health Advisor', 'version-info' ),
            'system_export'    => __( 'System Export', 'version-info' ),
            'white_label'      => __( 'White Label', 'version-info' ),
            'access_control'   => __( 'Access Control', 'version-info' ),
            'email_alerts'     => __( 'Email Alerts', 'version-info' ),
            'error_log'        => __( 'Error Log', 'version-info' ),
        ];

        /** @var array<string, string> $tabs */
        $tabs = apply_filters( 'version_info_settings_tabs', $tabs );

        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        $current_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general';
        if ( ! array_key_exists( $current_tab, $tabs ) ) {
            $current_tab = 'general';
        }

        $can_use_premium = vi_fs()->can_use_premium_code();
        $is_agency       = $can_use_premium && vi_fs()->is_plan( 'agency' );

        echo '<div class="wrap">';
        echo '<h1>' . esc_html__( 'Version Info Settings', 'version-info' ) . '</h1>';

        echo '<h2 class="nav-tab-wrapper">';
        foreach ( $tabs as $tab_id => $tab_label ) {
            $url   = add_query_arg(
                [ 'page' => 'version-info', 'tab' => $tab_id ],
                admin_url( 'options-general.php' )
            );
            $class = ( $current_tab === $tab_id ) ? ' nav-tab-active' : '';

            echo '<a href="' . esc_url( $url ) . '" class="nav-tab' . esc_attr( $class ) . '">';
            echo esc_html( $tab_label );

            if ( in_array( $tab_id, self::AGENCY_TABS, true ) && ! $is_agency ) {
                echo ' <span class="dashicons dashicons-lock" style="font-size:14px;line-height:inherit;vertical-align:text-bottom;"></span>';
            } elseif ( in_array( $tab_id, self::PRO_TABS, true ) && ! $can_use_premium ) {
                echo ' <span class="dashicons dashicons-lock" style="font-size:14px;line-height:inherit;vertical-align:text-bottom;"></span>';
            }

            echo '</a>';
        }
        echo '</h2>';

        $this->render_tab( $current_tab, $can_use_premium, $is_agency );

        echo '</div>';
    }

    private function render_tab( string $tab_id, bool $can_use_premium, bool $is_agency ): void {
        if ( in_array( $tab_id, self::AGENCY_TABS, true ) && ! $is_agency ) {
            $this->render_agency_tab_placeholder( $tab_id );
            return;
        }

        if ( in_array( $tab_id, self::PRO_TABS, true ) && ! $can_use_premium ) {
            $this->render_pro_tab_placeholder( $tab_id );
            return;
        }

        switch ( $tab_id ) {
            case 'general':
                $this->render_general_tab();
                break;
            default:
                do_action( "version_info_render_tab_{$tab_id}" );
                break;
        }
    }

    private function render_general_tab(): void {
        ?>
        <form method="post" action="options.php">
            <?php settings_fields( 'version_info_general_group' ); ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><?php esc_html_e( 'Show Version Info in Admin Bar', 'version-info' ); ?></th>
                    <td>
                        <input type="checkbox" name="version_info_show_admin_bar" value="1"
                            <?php checked( 1, get_option( 'version_info_show_admin_bar', false ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e( 'Show Version Info as Dashboard Widget', 'version-info' ); ?></th>
                    <td>
                        <input type="checkbox" name="version_info_show_dashboard_widget" value="1"
                            <?php checked( 1, get_option( 'version_info_show_dashboard_widget', false ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e( 'Show Version Info in Footer', 'version-info' ); ?></th>
                    <td>
                        <input type="checkbox" name="version_info_show_footer" value="1"
                            <?php checked( 1, get_option( 'version_info_show_footer', true ) ); ?> />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        <?php
    }

    private function render_pro_tab_placeholder( string $tab_id ): void {
        $previews = [
            'system_resources' => [
                'title'       => __( 'System Resources', 'version-info' ),
                'description' => __( 'Monitor real-time CPU load and memory usage directly from your WordPress dashboard.', 'version-info' ),
                'features'    => [
                    __( 'CPU load percentage with visual bar', 'version-info' ),
                    __( 'RAM usage percentage with visual bar', 'version-info' ),
                    __( 'Database size tracking (data + index)', 'version-info' ),
                    __( 'Live updates via WordPress Heartbeat API', 'version-info' ),
                ],
            ],
            'environment' => [
                'title'       => __( 'Environment Indicators', 'version-info' ),
                'description' => __( 'Instantly identify your environment type with a color-coded badge in the Admin Bar.', 'version-info' ),
                'features'    => [
                    __( 'Auto-detects Production, Staging, Development, and Local', 'version-info' ),
                    __( 'Supports WP_ENVIRONMENT_TYPE, Bedrock, Kinsta, WP Engine, and more', 'version-info' ),
                    __( 'Color-coded Admin Bar badge', 'version-info' ),
                ],
            ],
            'version_history' => [
                'title'       => __( 'Version History', 'version-info' ),
                'description' => __( 'Track changes in your WordPress, PHP, and MySQL versions over time.', 'version-info' ),
                'features'    => [
                    __( 'Automatic detection of version changes', 'version-info' ),
                    __( 'Hooks into WordPress core, plugin, and theme update process', 'version-info' ),
                    __( 'Sortable history table with timestamps', 'version-info' ),
                ],
            ],
            'health_advisor' => [
                'title'       => __( 'Health Advisor', 'version-info' ),
                'description' => __( 'Predictive alerts for end-of-life software and critical server issues.', 'version-info' ),
                'features'    => [
                    __( 'PHP end-of-life date tracking', 'version-info' ),
                    __( 'MySQL end-of-life date tracking', 'version-info' ),
                    __( 'Integrates with WordPress Site Health screen', 'version-info' ),
                ],
            ],
            'system_export' => [
                'title'       => __( 'System Info Export', 'version-info' ),
                'description' => __( 'Download a complete snapshot of your technical stack as a JSON file.', 'version-info' ),
                'features'    => [
                    __( 'One-click JSON download of all system info', 'version-info' ),
                    __( 'Includes PHP extensions, active plugins, and theme data', 'version-info' ),
                    __( 'Ideal for support ticket attachments', 'version-info' ),
                ],
            ],
        ];

        $preview = $previews[ $tab_id ] ?? null;
        if ( ! $preview ) {
            return;
        }

        $this->render_locked_placeholder( $preview, 'pro' );
    }

    private function render_agency_tab_placeholder( string $tab_id ): void {
        $previews = [
            'white_label' => [
                'title'       => __( 'White Label', 'version-info' ),
                'description' => __( 'Fully rebrand the plugin with your own name and remove all Gaucho Plugins branding.', 'version-info' ),
                'features'    => [
                    __( 'Custom plugin name throughout the dashboard', 'version-info' ),
                    __( 'Custom author name attribution', 'version-info' ),
                    __( 'Hide Freemius account and support menu items', 'version-info' ),
                ],
            ],
            'access_control' => [
                'title'       => __( 'Access Control', 'version-info' ),
                'description' => __( 'Control which WordPress user roles can see version information across your site.', 'version-info' ),
                'features'    => [
                    __( 'Per-role visibility toggles', 'version-info' ),
                    __( 'Applies to admin bar, footer, and dashboard widget', 'version-info' ),
                    __( 'Default restricted to administrators', 'version-info' ),
                ],
            ],
            'email_alerts' => [
                'title'       => __( 'Email Alerts', 'version-info' ),
                'description' => __( 'Receive priority email notifications whenever a version change is detected on your site.', 'version-info' ),
                'features'    => [
                    __( 'Alerts for WordPress, PHP, and MySQL version changes', 'version-info' ),
                    __( 'Configurable recipient list', 'version-info' ),
                    __( 'Per-component alert toggles', 'version-info' ),
                ],
            ],
            'error_log' => [
                'title'       => __( 'PHP Error Log', 'version-info' ),
                'description' => __( 'View and download your PHP error log directly from the WordPress dashboard.', 'version-info' ),
                'features'    => [
                    __( 'Tail last 100 lines without loading full log into memory', 'version-info' ),
                    __( 'Sensitive file paths automatically masked', 'version-info' ),
                    __( 'Download full log as ZIP for offline analysis', 'version-info' ),
                ],
            ],
        ];

        $preview = $previews[ $tab_id ] ?? null;
        if ( ! $preview ) {
            return;
        }

        $this->render_locked_placeholder( $preview, 'agency' );
    }

    /**
     * @param array{title: string, description: string, features: string[]} $preview
     */
    private function render_locked_placeholder( array $preview, string $tier ): void {
        if ( 'agency' === $tier ) {
            $label   = __( 'This is an Agency feature.', 'version-info' );
            $message = __( 'Upgrade to the Agency plan to unlock this feature.', 'version-info' );
            $button  = __( 'Upgrade to Agency', 'version-info' );
        } else {
            $label   = __( 'This is a PRO feature.', 'version-info' );
            $message = __( 'Upgrade to Version Info PRO to unlock this feature.', 'version-info' );
            $button  = __( 'Upgrade to PRO', 'version-info' );
        }

        echo '<div style="position:relative;margin-top:20px;">';

        echo '<div style="opacity:0.45;pointer-events:none;">';
        echo '<h2>' . esc_html( $preview['title'] ) . '</h2>';
        echo '<p>' . esc_html( $preview['description'] ) . '</p>';
        echo '<table class="form-table" role="presentation">';
        foreach ( $preview['features'] as $feature ) {
            echo '<tr><th scope="row">' . esc_html( $feature ) . '</th>';
            echo '<td><span class="dashicons dashicons-yes-alt" style="color:#999;"></span></td></tr>';
        }
        echo '</table>';
        echo '</div>';

        echo '<div class="notice notice-info" style="margin-top:15px;padding:15px;">';
        echo '<p><strong>' . esc_html( $label ) . '</strong> ';
        echo esc_html( $message ) . '</p>';
        echo '<p><a href="' . esc_url( vi_fs()->get_upgrade_url() ) . '" class="button button-primary">';
        echo esc_html( $button );
        echo '</a></p>';
        echo '</div>';

        echo '</div>';
    }
}
