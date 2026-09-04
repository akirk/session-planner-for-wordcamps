<?php
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php wp_app_language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_app_the_title( 'Session Notes' ); ?></title>
    <?php wp_app_head(); ?>
</head>
<body>
    <?php wp_app_body_open(); ?>

    <main id="session-planner-for-wordcamps-app" class="wcc-app" data-page="notes">
        <header class="wcc-header wcc-plan-header">
            <div class="wcc-plan-heading">
                <h1>
                    <a id="wcc-page-title-link" class="wcc-title-link" href="<?php echo esc_url( home_url( '/session-planner-for-wordcamps/' ) ); ?>">
                        <span id="wcc-page-title"><?php echo esc_html__( 'Session Notes', 'session-planner-for-wordcamps' ); ?></span>
                    </a>
                </h1>
                <p id="wcc-current-event" class="wcc-current-event"></p>
            </div>
            <div class="wcc-notes-header-side">
                <div class="wcc-actions">
                    <a class="wcc-button" href="<?php echo esc_url( home_url( '/session-planner-for-wordcamps/' ) ); ?>"><?php echo esc_html__( 'Companion', 'session-planner-for-wordcamps' ); ?></a>
                    <a id="wcc-notes-plan-link" class="wcc-button" href="<?php echo esc_url( home_url( '/session-planner-for-wordcamps/plan-your/' ) ); ?>"><?php echo esc_html__( 'Plan your day', 'session-planner-for-wordcamps' ); ?></a>
                </div>
                <div id="wcc-plan-summary" class="wcc-plan-summary"></div>
            </div>
        </header>

        <section class="wcc-planner-nav" aria-label="<?php echo esc_attr__( 'Notes controls', 'session-planner-for-wordcamps' ); ?>">
            <label class="wcc-field">
                <span><?php echo esc_html__( 'WordCamp', 'session-planner-for-wordcamps' ); ?></span>
                <select id="wcc-notes-event-select"></select>
            </label>
        </section>

        <div id="wcc-alerts" class="wcc-alerts" aria-live="polite"></div>

        <section class="wcc-content">
            <section class="wcc-main" aria-label="<?php echo esc_attr__( 'Session notes', 'session-planner-for-wordcamps' ); ?>">
                <div id="wcc-status" class="wcc-status"></div>
                <div id="wcc-schedule" class="wcc-schedule"></div>
            </section>
        </section>

    </main>

    <?php wp_app_body_close(); ?>
</body>
</html>
