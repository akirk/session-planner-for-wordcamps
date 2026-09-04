<?php
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php wp_app_language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html( wp_app_title( 'Upcoming WordCamps' ) ); ?></title>
    <?php wp_app_head(); ?>
</head>
<body>
    <?php wp_app_body_open(); ?>

    <main id="session-planner-for-wordcamps-app" class="wcc-app" data-page="plan-selector">
        <header class="wcc-header">
            <div>
                <h1 class="wcc-heading-with-count">
                    <a class="wcc-title-link" href="<?php echo esc_url( home_url( '/session-planner-for-wordcamps/' ) ); ?>">
                        <?php echo esc_html__( 'Upcoming WordCamps', 'session-planner-for-wordcamps' ); ?>
                    </a>
                    <span id="wcc-event-count" class="wcc-count"></span>
                </h1>
                <p id="wcc-current-event" class="wcc-current-event" hidden></p>
            </div>
            <div id="wcc-plan-summary" class="wcc-plan-summary wcc-actions">
                <a class="wcc-button" href="<?php echo esc_url( home_url( '/session-planner-for-wordcamps/' ) ); ?>"><?php echo esc_html__( 'Companion', 'session-planner-for-wordcamps' ); ?></a>
                <button id="wcc-refresh-events" class="wcc-button" type="button"><?php echo esc_html__( 'Refresh Events', 'session-planner-for-wordcamps' ); ?></button>
            </div>
        </header>

        <div id="wcc-alerts" class="wcc-alerts" aria-live="polite"></div>

        <section class="wcc-plan-selector" aria-label="<?php echo esc_attr__( 'Upcoming WordCamps', 'session-planner-for-wordcamps' ); ?>">
            <div id="wcc-event-list" class="wcc-event-list wcc-event-list-wide"></div>
        </section>

    </main>

    <?php wp_app_body_close(); ?>
</body>
</html>
