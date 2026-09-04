<?php
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php wp_app_language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_app_the_title( 'Session Planner for WordCamps' ); ?></title>
    <?php wp_app_head(); ?>
</head>
<body>
    <?php wp_app_body_open(); ?>

    <section id="wcc-debug-clock" class="wcc-debug-clock" aria-label="<?php echo esc_attr__( 'Debug time simulator', 'session-planner-for-wordcamps' ); ?>" <?php echo \SessionPlannerForWordCamps\UserSettings::is_debug_clock_enabled( get_current_user_id() ) ? '' : 'hidden'; ?>>
        <div>
            <span class="wcc-kicker"><?php echo esc_html__( 'Debug Time', 'session-planner-for-wordcamps' ); ?></span>
            <strong id="wcc-debug-current"></strong>
        </div>
        <button id="wcc-debug-play" class="wcc-debug-play" type="button" aria-pressed="false"><?php echo esc_html__( 'Play', 'session-planner-for-wordcamps' ); ?></button>
        <label class="wcc-debug-rate">
            <span id="wcc-debug-slider-mode"><?php echo esc_html__( 'Time', 'session-planner-for-wordcamps' ); ?></span>
            <input id="wcc-debug-rate" type="range" min="-180" max="180" step="5" value="0">
            <strong id="wcc-debug-rate-label">+0m</strong>
        </label>
        <div class="wcc-debug-jumps" aria-label="<?php echo esc_attr__( 'Quick time adjustments', 'session-planner-for-wordcamps' ); ?>">
            <button type="button" data-debug-start="wordcamp"><?php echo esc_html__( 'Start', 'session-planner-for-wordcamps' ); ?></button>
            <button type="button" data-debug-jump="-20">-20m</button>
            <button type="button" data-debug-jump="20">+20m</button>
            <button type="button" data-debug-jump="-60">-1h</button>
            <button type="button" data-debug-jump="60">+1h</button>
            <button type="button" data-debug-jump="-1440">-1d</button>
            <button type="button" data-debug-jump="1440">+1d</button>
        </div>
        <button id="wcc-debug-reset" class="wcc-button" type="button"><?php echo esc_html__( 'Reset', 'session-planner-for-wordcamps' ); ?></button>
        <button id="wcc-debug-close" class="wcc-debug-close" type="button" aria-label="<?php echo esc_attr__( 'Close debug time and turn off the setting', 'session-planner-for-wordcamps' ); ?>">X</button>
    </section>
    <main id="session-planner-for-wordcamps-app" class="wcc-app is-focused is-live-companion" data-page="companion">

        <div id="wcc-alerts" class="wcc-alerts" aria-live="polite"></div>

        <section class="wcc-content">
            <section class="wcc-main" aria-label="<?php echo esc_attr__( 'WordCamp companion timeline', 'session-planner-for-wordcamps' ); ?>">
                <div id="wcc-status" class="wcc-status"></div>
                <div id="wcc-schedule" class="wcc-schedule"></div>
            </section>
        </section>

    </main>

    <?php wp_app_body_close(); ?>
</body>
</html>
