<?php
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php wp_app_language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html( wp_app_title( 'Session Planner for WordCamps' ) ); ?></title>
    <?php wp_app_head(); ?>
</head>
<body>
    <?php wp_app_body_open(); ?>

    <main id="session-planner-for-wordcamps-app" class="wcc-app" data-page="plan">
        <header class="wcc-header wcc-plan-header">
            <div class="wcc-plan-heading">
                <div class="wcc-plan-title-row">
                    <h1>
                        <a id="wcc-page-title-link" class="wcc-title-link" href="<?php echo esc_url( home_url( '/session-planner-for-wordcamps/' ) ); ?>">
                            <span id="wcc-page-title"><?php echo esc_html__( 'Session Planner for WordCamps', 'session-planner-for-wordcamps' ); ?></span>
                        </a>
                    </h1>
                    <div class="wcc-selected-actions wcc-title-actions">
                        <a id="wcc-open-event" class="wcc-button" href="#" target="_blank" rel="noopener noreferrer"><?php echo esc_html__( 'Event Site', 'session-planner-for-wordcamps' ); ?></a>
                        <button id="wcc-companion-visibility" class="wcc-button" type="button" hidden><?php echo esc_html__( 'Attend', 'session-planner-for-wordcamps' ); ?></button>
                        <button id="wcc-travel-app" class="wcc-button" type="button" hidden><?php echo esc_html__( 'Add to Travel App', 'session-planner-for-wordcamps' ); ?></button>
                        <a id="wcc-change-event" class="wcc-button" href="<?php echo esc_url( home_url( '/session-planner-for-wordcamps/plan-your/' ) ); ?>"><?php echo esc_html__( 'Change WordCamp', 'session-planner-for-wordcamps' ); ?></a>
                    </div>
                </div>
                <p id="wcc-current-event" class="wcc-current-event"></p>
            </div>
            <div id="wcc-plan-summary" class="wcc-plan-summary"></div>
        </header>

        <section id="wcc-planner-nav" class="wcc-planner-nav" aria-label="<?php echo esc_attr__( 'Planner controls', 'session-planner-for-wordcamps' ); ?>">
            <div class="wcc-tabs" role="tablist" aria-label="<?php echo esc_attr__( 'Schedule views', 'session-planner-for-wordcamps' ); ?>">
                <button id="wcc-tab-schedule" class="wcc-tab is-active" type="button" role="tab" aria-selected="true" data-view="schedule"><?php echo esc_html__( 'Schedule', 'session-planner-for-wordcamps' ); ?></button>
                <button id="wcc-tab-plan" class="wcc-tab" type="button" role="tab" aria-selected="false" data-view="plan"><?php echo esc_html__( 'My Plan', 'session-planner-for-wordcamps' ); ?></button>
            </div>
            <div class="wcc-actions">
                <a class="wcc-button" href="<?php echo esc_url( home_url( '/session-planner-for-wordcamps/' ) ); ?>"><?php echo esc_html__( 'Companion', 'session-planner-for-wordcamps' ); ?></a>
                <a id="wcc-plan-notes-link" class="wcc-button" href="<?php echo esc_url( home_url( '/session-planner-for-wordcamps/notes/' ) ); ?>"><?php echo esc_html__( 'Notes', 'session-planner-for-wordcamps' ); ?></a>
                <button id="wcc-refresh-schedule" class="wcc-button" type="button"><?php echo esc_html__( 'Refresh Schedule', 'session-planner-for-wordcamps' ); ?></button>
            </div>
        </section>

        <div id="wcc-alerts" class="wcc-alerts" aria-live="polite"></div>

        <section class="wcc-content">
            <section class="wcc-main" aria-label="<?php echo esc_attr__( 'WordCamp schedule', 'session-planner-for-wordcamps' ); ?>">
                <div id="wcc-status" class="wcc-status"></div>
                <div id="wcc-schedule" class="wcc-schedule"></div>
            </section>
        </section>

    </main>

    <?php wp_app_body_close(); ?>
</body>
</html>
