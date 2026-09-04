<?php

namespace SessionPlannerForWordCamps;

use WP_Error;

defined( 'ABSPATH' ) || exit;

/**
 * Integrates with Traveler through the WordPress Abilities API.
 *
 * Nothing here depends on the Traveler plugin directly: the Companion only
 * looks up `traveler/*` abilities and executes them, so the integration
 * disappears when the plugin is not active or the user may not use it.
 */
class TravelerIntegration {
    const REQUIRED_ABILITIES = [
        'traveler/list-trips',
        'traveler/get-trip',
        'traveler/create-travel-plan',
    ];

    /**
     * Whether every ability the integration needs is registered and permitted
     * for the current user.
     */
    public function is_available(): bool {
        if ( ! function_exists( 'wp_get_ability' ) ) {
            return false;
        }

        foreach ( self::REQUIRED_ABILITIES as $name ) {
            $ability = wp_get_ability( $name );
            if ( ! $ability || true !== $ability->check_permissions( [] ) ) {
                return false;
            }
        }

        return true;
    }

    /**
     * Client configuration, or null when Traveler is not available.
     */
    public function get_client_config(): ?array {
        if ( ! $this->is_available() ) {
            return null;
        }

        return [
            'label' => wp_get_ability( 'traveler/create-travel-plan' )->get_label(),
        ];
    }

    /**
     * Adds a WordCamp to Traveler.
     *
     * Reuses the user's travel plan with the same title when one exists,
     * otherwise creates one spanning the WordCamp's dates.
     *
     * @return array|WP_Error { created: bool, trip: array }
     */
    public function add_event( array $event ) {
        if ( ! $this->is_available() ) {
            return new WP_Error( 'session_planner_for_wordcamps_traveler_unavailable', __( 'Traveler is not available.', 'session-planner-for-wordcamps' ), [ 'status' => 404 ] );
        }

        $title = trim( (string) ( $event['title'] ?? '' ) );
        if ( '' === $title ) {
            $title = trim( (string) ( $event['location'] ?? '' ) );
        }
        if ( '' === $title ) {
            return new WP_Error( 'session_planner_for_wordcamps_traveler_title', __( 'This WordCamp has no title to name the travel plan after.', 'session-planner-for-wordcamps' ), [ 'status' => 400 ] );
        }

        $existing = $this->find_trip_by_title( $title );
        if ( is_wp_error( $existing ) ) {
            return $existing;
        }

        if ( $existing ) {
            $trip = $this->run( 'traveler/get-trip', [ 'id' => (int) $existing['id'] ] );
            if ( is_wp_error( $trip ) ) {
                return $trip;
            }

            return [
                'created' => false,
                'trip'    => $this->unwrap_trip( $trip ),
            ];
        }

        $input = [ 'title' => $title ];
        $timezone = (string) ( $event['timezone'] ?? '' );
        $starts_at = $this->format_ability_date( $event['start'] ?? null, $timezone );
        $ends_at = $this->format_ability_date( $event['end'] ?? null, $timezone );
        if ( '' !== $starts_at ) {
            $input['starts_at'] = $starts_at;
        }
        if ( '' !== $ends_at ) {
            $input['ends_at'] = $ends_at;
        }

        $result = $this->run( 'traveler/create-travel-plan', $input );
        if ( is_wp_error( $result ) ) {
            return $result;
        }

        return [
            'created' => ! empty( $result['created'] ),
            'trip'    => $this->unwrap_trip( $result ),
        ];
    }

    /**
     * Normalizes an ability result to the travel plan it describes.
     *
     * `traveler/create-travel-plan` wraps the plan in a `trip` key, while
     * `traveler/get-trip` returns its fields at the top level. The client only
     * needs the plan itself, and it needs the `url` either way.
     */
    private function unwrap_trip( array $result ): array {
        if ( isset( $result['trip'] ) && is_array( $result['trip'] ) ) {
            return $result['trip'];
        }

        return isset( $result['id'] ) ? $result : [];
    }

    /**
     * @return array|null|WP_Error
     */
    private function find_trip_by_title( string $title ) {
        $result = $this->run( 'traveler/list-trips', [] );
        if ( is_wp_error( $result ) ) {
            return $result;
        }

        $wanted = $this->normalize_title( $title );
        foreach ( $result['trips'] ?? [] as $trip ) {
            if ( is_array( $trip ) && ! empty( $trip['id'] ) && $this->normalize_title( (string) ( $trip['title'] ?? '' ) ) === $wanted ) {
                return $trip;
            }
        }

        return null;
    }

    /**
     * @return array|WP_Error
     */
    private function run( string $name, array $input ) {
        $ability = wp_get_ability( $name );
        if ( ! $ability ) {
            return new WP_Error( 'session_planner_for_wordcamps_traveler_unavailable', __( 'Traveler is not available.', 'session-planner-for-wordcamps' ), [ 'status' => 404 ] );
        }

        $result = $ability->execute( $input );
        if ( is_wp_error( $result ) ) {
            if ( ! isset( $result->get_error_data()['status'] ) ) {
                $result->add_data( [ 'status' => 400 ] );
            }
            return $result;
        }

        return is_array( $result ) ? $result : [];
    }

    private function normalize_title( string $title ): string {
        return function_exists( 'mb_strtolower' ) ? mb_strtolower( trim( $title ) ) : strtolower( trim( $title ) );
    }

    private function format_ability_date( $timestamp, string $timezone ): string {
        $timestamp = is_numeric( $timestamp ) ? (int) $timestamp : 0;
        if ( $timestamp <= 0 ) {
            return '';
        }

        try {
            $zone = '' !== $timezone ? new \DateTimeZone( $timezone ) : wp_timezone();
        } catch ( \Exception $e ) {
            $zone = wp_timezone();
        }

        return ( new \DateTimeImmutable( '@' . $timestamp ) )->setTimezone( $zone )->format( 'Y-m-d' );
    }
}
