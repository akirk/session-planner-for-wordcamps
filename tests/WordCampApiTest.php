<?php

use PHPUnit\Framework\TestCase;
use SessionPlannerForWordCamps\WordCampApi;

class WordCampApiTest extends TestCase {
    /** @dataProvider allowed_event_urls */
    public function test_only_http_wordcamp_hosts_are_allowed( string $url, bool $expected ): void {
        $this->assertSame( $expected, ( new WordCampApi() )->is_allowed_wordcamp_url( $url ) );
    }

    public static function allowed_event_urls(): array {
        return [
            'event subdomain' => [ 'https://europe.wordcamp.org/2027/', true ],
            'root domain' => [ 'https://wordcamp.org/', true ],
            'lookalike without subdomain separator' => [ 'https://notwordcamp.org/', false ],
            'allowed name in attacker subdomain' => [ 'https://wordcamp.org.attacker.test/', false ],
            'allowed name in userinfo with loopback host' => [ 'https://wordcamp.org@127.0.0.1/', false ],
            'non-HTTP scheme' => [ 'ftp://europe.wordcamp.org/2027/', false ],
        ];
    }

    public function test_pasted_event_url_has_a_canonical_rest_and_cache_base(): void {
        $this->assertSame(
            'https://europe.wordcamp.org/2027/',
            ( new WordCampApi() )->normalize_event_site_url( '  EUROPE.WordCamp.org/2027/?page_id=42#schedule  ' )
        );
    }
}
