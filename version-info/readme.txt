=== Version Info - Server Health Monitor, PHP & MySQL Version Display, Environment Indicators ===
Contributors: gauchoplugins, brandonfire, freemius
Tags: server info, php version, mysql version, site health, developer tools
Stable tag: 2.0.1
Requires at least: 4.7
Tested up to: 7.0
Requires PHP: 5.6
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Display PHP, MySQL, WP & server versions anywhere in admin. Monitor CPU, RAM, DB size & environment type.

== Description ==

= 🛡️ THE ESSENTIAL TECHNICAL HUD FOR EVERY WORDPRESS PROFESSIONAL =

Stop digging through hidden menus or leaving insecure `phpinfo()` files on your server. **[Version Info](https://versioninfoplugin.com/ "Visit the Version Info website")** is the essential technical dashboard that brings your site's most vital environment data directly into your daily workflow — the admin footer, the admin bar, or a dedicated dashboard widget.

Whether you're a freelancer managing dozens of client sites, a developer debugging a complex plugin conflict, or an agency maintaining a portfolio of high-value properties, having instant access to your **PHP version**, **MySQL version**, **WordPress version**, and **web server type** is a mission-critical utility.

**Version Info** has been trusted by WordPress professionals since 2015 and is now supercharged with a complete PRO + Agency suite for serious site monitoring. Learn more at **[versioninfoplugin.com](https://versioninfoplugin.com/ "Version Info official website")**.

= ✨ What Makes Version Info Different? =

Most server info plugins show you a wall of data you don't need. Version Info is designed around **the data you actually use every day**, placed exactly where you need it — no extra pages, no bloat, no performance impact.

* **Zero Configuration** — Install, activate, done. Versions appear in your footer immediately.
* **Surgical Precision** — Only shows WP, PHP, MySQL, and Server versions. No fluff.
* **Performance First** — Uses native WordPress APIs. Literally zero impact on page load.
* **Developer Hooks** — Every data point is filterable for custom integrations. See the [developer docs](https://docs.versioninfoplugin.com/advanced-configuration-hooks-and-filters "Version Info developer documentation").

= 🚀 Core Features (100% Free, Forever) =

These features will always be free. No bait-and-switch.

* 🛠️ **Admin Footer Display** — See WordPress, PHP, MySQL, and Web Server versions at the bottom of every admin page. Includes a one-click update link when a new WP version is available.
* 🚦 **WP-Admin Bar Nodes** — Pin your version stack to the admin bar for instant visibility while navigating between pages, posts, and settings.
* 📊 **Dashboard Widget** — A dedicated "At a Glance" style widget showing your complete technical stack. Enable it via Screen Options.
* 🔄 **Core Update Alerts** — Automatically compares your WP version with the latest available and shows an update link right in the footer.
* 💻 **Server Detection** — Instantly identify Apache, Nginx, LiteSpeed, or any other server software without leaving WordPress.
* 🌐 **Translation Ready** — Fully localized with translations in 13+ languages including Spanish, German, French, Japanese, Chinese, and more. [Help translate](https://translate.wordpress.org/projects/wp-plugins/version-info/ "Translate Version Info on WordPress.org").

= 🔥 PRO Plan — Advanced Site Intelligence =

Unlock real-time performance monitoring, environment safety, and proactive health checks. Built for developers who take their stack seriously.

**[Upgrade to PRO →](https://versioninfoplugin.com/pricing "Version Info PRO pricing")** Starting at $19/year.

* 📈 **Real-Time CPU & RAM Monitoring** — See your server's pulse, live. Visual percentage bars that auto-refresh every 60 seconds via the WordPress Heartbeat API. Cross-platform: uses `sys_getloadavg()` on Linux, COM objects on Windows, and `/proc/meminfo` for system memory. Fully cached with Transients to prevent server strain.

* 💾 **Database Size Tracking** — Know exactly how bloated your database is before it becomes a problem. Breaks down `data_length` vs. `index_length` for all tables matching your `$wpdb->prefix`. Results cached for 12 hours with a **"Scan Now" AJAX button** for on-demand fresh data. Perfect for monitoring WooCommerce database growth during peak sales.

* 🚨 **Smart Environment Indicators** — Never accidentally run a destructive query on production again. High-visibility color-coded badges in the admin bar: **Red** for Production, **Orange** for Staging, **Green** for Development/Local. Auto-detects `WP_ENVIRONMENT_TYPE`, Bedrock (`WP_ENV`), Kinsta, WP Engine, Pantheon, Flywheel, and more. Optional: highlight the entire admin bar border to match the environment color.

* 📜 **Audit Log of Version History** — A persistent timeline tracking every shift in your WordPress core, PHP, MySQL, plugin, and theme versions. Hooks into `upgrader_process_complete` for real-time logging of WordPress updates. Know exactly *when* and *what* changed for historical troubleshooting. Limited to the last 50 entries to prevent bloat.

* 🛡️ **Health Advisor Notifications** — Proactive alerts that predict problems before they happen. Checks your PHP and MySQL versions against known **End-of-Life (EOL) dates** and flags critical security risks. Integrates directly with the native **WordPress Site Health** screen via `site_status_tests`. Flags PHP < 8.1 as a critical security risk.

* 📤 **JSON System Info Export** — One-click download of your entire technical stack as a structured JSON file. Includes WordPress config, PHP version + all extensions, database details, active theme, all active plugins with versions, server info, and more. Ideal for attaching to support tickets, sharing with hosting providers, or archiving before migrations.

[See the full PRO feature documentation →](https://docs.versioninfoplugin.com/pro-features "Version Info PRO documentation")

= 🏛️ Agency Plan — The Command Center for Client Portfolios =

Everything in PRO, plus enterprise-grade tools for agencies, freelancers, and hosting companies managing multiple sites.

**[Upgrade to Agency →](https://versioninfoplugin.com/pricing "Version Info Agency pricing")** Starting at $49/year.

* 🏷️ **Full Agency White-Labeling** — Make it *your* plugin. Replace "Version Info" and "Gaucho Plugins" with your agency's name everywhere: the plugin list, dashboard widgets, admin bar, footer, and settings page. Hide Freemius-generated Account, Contact, and Support submenus. Uses the `all_plugins` filter for seamless Plugins list rebranding.

* 👥 **Role-Based Admin Visibility** — Keep it simple for clients. A checkbox matrix lets you control exactly which WordPress user roles can see version information in the admin bar, footer, and dashboard widget. Show everything to administrators, hide everything from editors and shop managers. Default: administrator only.

* 🌐 **Multi-Site Network Dashboard** — A centralized command center for WordPress Multisite. A dedicated page under **Network Admin > Settings** shows a table of every site on the network with columns for site name, URL, WP version, PHP version, MySQL version, and database size. Uses `switch_to_blog()` safely with network transient caching. Capped at 100 sites for performance.

* 📧 **System Change Email Alerts** — Get notified the *instant* something changes. Proactive `wp_mail()` notifications the moment a hosting provider changes a PHP version, a WordPress core update completes, or any plugin/theme version shifts. Configurable recipient list (comma-separated), per-component toggles, and defaults to the site admin email.

* 🔍 **PHP Error Log Dashboard** — Debug without FTP or SSH. View the last 100 lines of your `debug.log` (or custom `error_log` path) directly inside WordPress. Uses efficient `fseek()` tail reading — never loads the full log into memory. Sensitive file paths are automatically masked with `[ABSPATH]`. Download the full log as a ZIP file for offline analysis.

[See the full Agency feature documentation →](https://docs.versioninfoplugin.com/agency-features "Version Info Agency documentation")

= 🎯 Real-World Use Cases =

**"The Support Hero"**
A client reports a bug. Instead of asking for their login credentials, you ask them to screenshot their admin footer. You instantly know their PHP version, MySQL version, WordPress version, and web server — without ever logging into their site.

**"The WooCommerce Specialist"**
Black Friday is coming. You use **Database Tracking** to monitor table size growth during the high-traffic event. When `wp_options` grows 300% overnight, you catch the autoloaded transient bloat before it takes down the store.

**"The Agency Owner"**
You hand over a beautifully built site to a high-ticket client. With **White-Labeling**, the client never sees "Gaucho Plugins" — they see *your* agency name everywhere. With **Role-Based Visibility**, the client's editors see a clean dashboard without confusing server information.

**"The Safety-First Developer"**
You manage staging and production environments for the same client. The bright **red "Production" badge** in your admin bar prevents you from ever accidentally running a migration script on the live site. The **admin bar highlight** makes the environment unmistakable.

**"The Managed Hosting Reseller"**
You run 40 sites on a Multisite installation. The **Network Dashboard** gives you a single page showing WP, PHP, and MySQL versions across every site — perfect for planning bulk upgrades. When a host updates PHP overnight, the **Email Alert** hits your inbox before the first support ticket arrives.

**"The Remote Debugger"**
A client's site throws a white screen. You open the **Error Log Dashboard** directly in wp-admin — no FTP client, no SSH terminal. The last 100 lines show a fatal error from a plugin update. The **Version History** tab confirms the plugin updated 10 minutes ago. Root cause found in under 60 seconds.

= ⚡ Performance & Architecture =

Version Info is built with performance as the #1 priority:

* **Transients API** — All resource-heavy metrics (CPU, RAM, DB size) are cached. CPU/RAM uses 60-second TTL; database size uses 12-hour TTL.
* **Heartbeat API** — Live resource updates use the native WordPress Heartbeat, ensuring data refreshes only when the admin page is active.
* **Provider Pattern** — A `ProviderInterface` abstracts all detection logic, making it trivial to add custom providers for AWS, Kinsta, or any host-specific API.
* **Hook-First Architecture** — Every data point fires a WordPress filter (`version_info_wp_version`, `version_info_php_version`, etc.) and every render point fires an action. Extend anything without editing core files. See the [hooks reference](https://docs.versioninfoplugin.com/advanced-configuration-hooks-and-filters "Version Info hooks reference").
* **Broad Compatibility** — The codebase deliberately avoids language features that would lock out legacy hosts, so the plugin still installs on PHP 5.6+ and WordPress 4.7+ (which is, after all, who this plugin is built for). Modern PHP is auto-detected and used where available.
* **WordPress Coding Standards** — Follows WPCS, uses proper escaping, nonce verification, capability checks, and prepared SQL queries throughout.

= 🌍 Works With Your Stack =

Version Info auto-detects and works seamlessly with:

* **Hosts:** Kinsta, WP Engine, Pantheon, Flywheel, Cloudways, SiteGround, and any standard LAMP/LEMP host
* **Environments:** Bedrock, Trellis, Local by Flywheel, MAMP, WAMP, Docker, DevKinsta
* **Servers:** Apache, Nginx, LiteSpeed, OpenLiteSpeed, IIS
* **Multisite:** Full network-level support with dedicated Network Admin page (Agency)
* **Translations:** 13+ languages with full RTL support

= 📣 What WordPress Professionals Are Saying =

> "I install this on every client site. It saves me at least 5 minutes per support ticket." — ★★★★★

> "The environment badges alone are worth the upgrade. I'll never accidentally nuke production again." — ★★★★★

> "Finally, a server info plugin that isn't bloated with stuff I don't need." — ★★★★★

[Read more reviews →](https://wordpress.org/support/plugin/version-info/reviews/?filter=5 "Version Info 5-star reviews")

= 🔗 Resources & Links =

* **[Version Info Website](https://versioninfoplugin.com/ "Visit the Version Info website")**
* **[Documentation & Guides](https://docs.versioninfoplugin.com/ "Version Info documentation")**
* **[PRO & Agency Pricing](https://versioninfoplugin.com/pricing "Version Info pricing")**
* **[Developer Hooks Reference](https://docs.versioninfoplugin.com/advanced-configuration-hooks-and-filters "Version Info hooks reference")**
* **[Support Forum](https://wordpress.org/support/plugin/version-info/ "Version Info support")**
* **[Translate Version Info](https://translate.wordpress.org/projects/wp-plugins/version-info/ "Translate on WordPress.org")**
* **[Gaucho Plugins Portfolio](https://gauchoplugins.com "Gaucho Plugins")**

== Installation ==

= Minimum Requirements =

* WordPress 4.7 or greater
* PHP version 5.6 or greater
* MySQL version 5.5 or greater

Version Info is intentionally backwards-compatible. Because the plugin's whole purpose is to surface PHP / WordPress / server-version information, the people who need it most are typically running older environments. The minimum-supported floor is set as low as the underlying code allows.

= Automatic Installation =

1. Go to **Plugins > Add New** in your WordPress admin.
2. Search for **"Version Info"** and click **Install Now**.
3. Click **Activate** and you're done — version info appears in your admin footer immediately.

= Manual Installation =

1. Download the plugin ZIP from WordPress.org.
2. Upload the `version-info` folder to `/wp-content/plugins/`.
3. Activate through the **Plugins** menu.

= Configuration =

Navigate to **Settings > Version Info** to:

* Toggle display in the Admin Bar, Dashboard Widget, and Footer
* Access PRO tabs for System Resources, Environment, Version History, Health Advisor, and System Export
* Access Agency tabs for White Label, Access Control, Email Alerts, and Error Log

For detailed setup guides, visit the **[Version Info documentation](https://docs.versioninfoplugin.com/ "Version Info documentation")**.

= Upgrading to 2.0.1 =

Version 2.0.1 restores backwards compatibility with PHP 5.6+ and WordPress 4.7+. The previous 2.0.0 release required PHP 8.1+, which was inappropriate for a diagnostic plugin whose users are most often on older environments. No functionality was removed — only the language-level features were refactored. Always backup your site before updating. See the [upgrade guide](https://docs.versioninfoplugin.com/getting-started-installation-and-setup "Version Info 2.0 upgrade guide") for details.

== Frequently Asked Questions ==

= Is this plugin lightweight? Will it slow down my site? =

Absolutely not. The free version uses only native WordPress functions (`get_bloginfo()`, `phpversion()`, `$wpdb->get_var()`) and has near-zero performance impact. The PRO version uses the WordPress Transients API and Heartbeat API to ensure monitoring never blocks page loads or strains your server. Read more about the [performance architecture](https://docs.versioninfoplugin.com/advanced-configuration-known-plugin-conflicts "Version Info performance documentation").

= Does it work on WordPress Multisite? =

Yes! The free version works on a per-site basis. The Agency plan adds a dedicated **Network Admin > Settings > Version Info** page that shows WP, PHP, MySQL versions, and database sizes for every site on the network in a single table.

= Which hosting environments can the Environment Indicator detect? =

It auto-detects: `WP_ENVIRONMENT_TYPE` (WordPress 5.5+ core), `WP_ENV` (Bedrock/Trellis), `KINSTA_ENV_TYPE`, `WPE_ENVIRONMENT` and `IS_WPE_SNAPSHOT` (WP Engine), `PANTHEON_ENVIRONMENT`, `FLYWHEEL_CONFIG_DIR`, and falls back to "Production" for unrecognized hosts. See the [full compatibility list](https://docs.versioninfoplugin.com/pro-features-environment-indicators "Version Info environment detection documentation").

= Can I use this to debug PHP errors remotely? =

Yes! The Agency plan includes a **PHP Error Log Dashboard** that reads your `debug.log` file directly inside WordPress — no FTP or SSH access needed. It shows the last 100 lines efficiently and lets you download the full log as a ZIP.

= Is the PRO version compatible with WordPress.org guidelines? =

Yes. The free version hosted on WordPress.org contains zero premium code. All PRO/Agency features are delivered via the Freemius SDK update mechanism and are clearly separated using the `@fs_premium_only` deployment directive.

= How does the Health Advisor work? =

It integrates with the native **WordPress Site Health** screen by hooking into the `site_status_tests` filter. It checks your current PHP and MySQL versions against known End-of-Life (EOL) dates and flags them as Critical (past EOL), Warning (within 6 months), or Good (actively supported).

= Can my clients see the version information? =

By default, only administrators can see version data. With the Agency plan, you get a **Role-Based Visibility** matrix that lets you choose exactly which roles (Editor, Author, Shop Manager, etc.) can see version info. You can also completely white-label the plugin so clients never know it exists.

= How do email alerts work? =

The Agency plan monitors for version changes on every `admin_init` and via `upgrader_process_complete`. When a change is detected (e.g., PHP 8.1 → 8.2, or a plugin update), it sends a plain-text email to your configured recipients listing what changed, the old version, the new version, and the timestamp.

= Is this plugin developer-friendly? =

Extremely. Every data point fires a WordPress filter (e.g., `version_info_wp_version`, `version_info_mysql_version`). Every render point fires an action. The architecture uses a `ProviderInterface` so you can register custom data providers. The codebase deliberately avoids language features that would lock out legacy hosts, so the plugin still installs on PHP 5.6+. See the [developer documentation](https://docs.versioninfoplugin.com/advanced-configuration-hooks-and-filters "Version Info developer docs") for the complete hooks reference and provider API.

= Where can I find documentation? =

Complete documentation, setup guides, and developer references are available at **[docs.versioninfoplugin.com](https://docs.versioninfoplugin.com/ "Version Info documentation")**.

= Where can I get support? =

Free users can use the [WordPress.org support forum](https://wordpress.org/support/plugin/version-info/ "Version Info support forum"). PRO and Agency customers receive [priority support](https://versioninfoplugin.com/ "Version Info priority support").

== Screenshots ==

1. **Settings Page** — Clean, tabbed interface following native WordPress admin design. General tab with display toggles for admin bar, footer, and dashboard widget.
2. **Environment Badges** — Color-coded Production (red), Staging (orange), and Development (green) indicators in the Admin Bar.
3. **System Resources** — Real-time CPU and RAM monitoring with visual percentage bars and database size breakdown.
4. **Version History** — Timeline view of every WordPress, PHP, MySQL, plugin, and theme version change with timestamps.
5. **Health Advisor** — Predictive EOL alerts for PHP and MySQL integrated into the plugin settings and WordPress Site Health.
6. **Admin Footer** — How version info appears at the bottom of every admin page with optional WP update link.
7. **Network Dashboard** — Multisite overview showing versions and database sizes for every site (Agency).
8. **White Label** — Rebrand the plugin name, author, and hide Freemius menus for a seamless client experience (Agency).
9. **Error Log Viewer** — In-dashboard PHP error log with masked paths and ZIP download (Agency).
10. **System Export** — One-click JSON download with a full preview table of your technical stack (PRO).

== Changelog ==

= 2.0.1 (2026-05-17) =

* **Backwards compatibility:** lowered minimum PHP to **5.6** and minimum WordPress to **4.7**. The previous 2.0.0 minimums (PHP 8.1 / WP 5.5) were inappropriate for a plugin whose audience is by definition running older environments.
* Refactored the codebase to remove PHP 7.0+/7.1+/7.4+/8.0+/8.1+ syntax: `declare(strict_types=1)`, scalar parameter typehints, return type declarations, null coalescing `??`, `Throwable`, typed properties, arrow functions, `match` expressions, `str_starts_with()`, `mixed` parameter type, nullable return types (`?array`, `?string`), `void` return declarations, `private const`, and `array_is_list()`.
* No functionality removed — every PRO/Agency feature still works exactly as in 2.0.0.
* Health Advisor's "PHP minimum version" check now flags pre-7.4 as a recommendation (since the wider ecosystem considers 7.4 the active-support floor), rather than claiming the plugin itself requires 8.1.
* Added EOL data for PHP 5.6, 7.0, 7.1, 7.2, 7.3 and MySQL 5.5 so legacy hosts get accurate advice from Health Advisor.
* Feature-detect `wp_date()` (WP 5.3+) and `wp_timezone_string()` (WP 5.3+) so the plugin degrades gracefully on WP 4.7+.
* Confirmed compatibility with WordPress 7.0.

= 2.0.0 =

**🚀 MAJOR RELEASE: Complete architecture refactor with PRO + Agency feature suite.**

* **NEW:** Modular Provider-based detection architecture with PSR-4 autoloading
* **NEW:** Freemius SDK integration for PRO and Agency licensing
* **NEW:** Tabbed settings page (General, System Resources, Environment, Version History, Health Advisor, System Export, White Label, Access Control, Email Alerts, Error Log)
* **NEW:** Grayed-out PRO/Agency feature previews with upgrade prompts for free users
* **PRO:** Real-time CPU & RAM monitoring via WordPress Heartbeat API
* **PRO:** Database Size tracking with 12-hour cache and AJAX "Scan Now" button
* **PRO:** Smart Environment Indicators with color-coded admin bar badges and optional admin bar border highlight
* **PRO:** Audit Log of Version History — tracks core, plugin, and theme updates via upgrader_process_complete
* **PRO:** Health Advisor Notifications — PHP/MySQL EOL checks integrated with WordPress Site Health
* **PRO:** JSON System Info Export — one-click download of complete tech stack
* **AGENCY:** Full White-Labeling with all_plugins filter for Plugins list rebranding
* **AGENCY:** Role-Based Admin Visibility with per-role checkbox matrix
* **AGENCY:** Multi-Site Network Dashboard under Network Admin > Settings
* **AGENCY:** System Change Email Alerts via wp_mail with configurable recipients
* **AGENCY:** PHP Error Log Dashboard with fseek tail reading and ZIP download
* **TECH:** Minimum PHP raised to 8.1 with strict typing throughout
* **TECH:** Minimum WordPress raised to 5.5
* **TECH:** Hook-first architecture with filters and actions on every data point

= 1.3.3 =

* Verified WordPress 6.9 compatibility.

= 1.3.2 =

* Added settings for displaying the version info on WP-Admin bar and dashboard widget.
* Added namespace, sanitization, and other security improvements.
* Prepared plugin strings for translation.
* Translations added for 13 most common WordPress languages.

= 1.3.1 =

* Updated compatibility details.
* Changed to GPL.

= 1.3.0 =

Plugin transferred to new owner, @gauchoplugins.

== Upgrade Notice ==

= 2.0.1 =
Backwards-compatibility release. Minimum PHP lowered from 8.1 to **5.6**; minimum WordPress lowered from 5.5 to **4.7**. No features removed — Version Info is a diagnostic plugin, so it now actually installs on the legacy environments it was built to diagnose. Safe upgrade for anyone on 2.0.0.

= 2.0.0 =
Major upgrade! Requires PHP 8.1+. Adds PRO features (CPU/RAM monitoring, DB tracking, environment indicators, health advisor, system export) and Agency features (white-labeling, role controls, network dashboard, email alerts, error log viewer). Backup before updating.
