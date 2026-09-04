<?php
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php wp_app_language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_app_the_title( 'Settings' ); ?></title>
    <?php wp_app_head(); ?>
</head>
<body>
    <?php wp_app_body_open(); ?>

    <main id="session-planner-for-wordcamps-app" class="wcc-app" data-page="settings">
        <header class="wcc-header">
            <div>
                <h1>
                    <a class="wcc-title-link" href="<?php echo esc_url( home_url( '/session-planner-for-wordcamps/' ) ); ?>">
                        <?php echo esc_html__( 'Settings', 'session-planner-for-wordcamps' ); ?>
                    </a>
                </h1>
            </div>
            <div class="wcc-actions">
                <a class="wcc-button" href="<?php echo esc_url( home_url( '/session-planner-for-wordcamps/' ) ); ?>"><?php echo esc_html__( 'Companion', 'session-planner-for-wordcamps' ); ?></a>
            </div>
        </header>

        <div id="wcc-alerts" class="wcc-alerts" aria-live="polite"></div>

        <section class="wcc-settings" aria-label="<?php echo esc_attr__( 'Session Planner for WordCamps settings', 'session-planner-for-wordcamps' ); ?>">
            <div class="wcc-setting-row">
                <div>
                    <h2><?php echo esc_html__( 'Debug Time', 'session-planner-for-wordcamps' ); ?></h2>
                    <p><?php echo esc_html__( 'Show the simulator bar on the companion page.', 'session-planner-for-wordcamps' ); ?></p>
                </div>
                <label class="wcc-switch">
                    <input id="wcc-setting-debug-clock" type="checkbox" <?php checked( \SessionPlannerForWordCamps\UserSettings::is_debug_clock_enabled( get_current_user_id() ) ); ?>>
                    <span><?php echo esc_html__( 'Enabled', 'session-planner-for-wordcamps' ); ?></span>
                </label>
            </div>
            <div class="wcc-settings-actions">
                <button id="wcc-settings-save" class="wcc-button" type="button"><?php echo esc_html__( 'Save Settings', 'session-planner-for-wordcamps' ); ?></button>
                <span id="wcc-settings-status" class="wcc-settings-status" aria-live="polite"></span>
            </div>
        </section>

    </main>

    <?php wp_app_body_close(); ?>
</body>
</html>
