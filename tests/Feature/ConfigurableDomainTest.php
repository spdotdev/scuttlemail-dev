<?php

namespace Spdotdev\ScuttlemailDev\Tests\Feature;

use Illuminate\Foundation\Application;
use Spdotdev\ScuttlemailDev\Tests\TestCase;

class ConfigurableDomainTest extends TestCase
{
    /**
     * @param  Application  $app
     */
    protected function defineEnvironment($app): void
    {
        parent::defineEnvironment($app);

        // Routes bind the domain at boot, so it has to be set before the
        // service provider loads them (this is what SCUTTLEMAIL_DOMAIN does).
        $app['config']->set('scuttlemail-dev.domain', 'staging.local');
    }

    public function test_site_answers_on_the_configured_domain_only(): void
    {
        $this->get('http://staging.local/')->assertOk()->assertSee('Scuttle');
        $this->get('http://scuttlemail.dev/')->assertNotFound();
    }
}
