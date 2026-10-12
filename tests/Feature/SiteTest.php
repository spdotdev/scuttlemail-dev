<?php

namespace Spdotdev\ScuttlemailDev\Tests\Feature;

use Spdotdev\ScuttlemailDev\Tests\TestCase;

class SiteTest extends TestCase
{
    public function test_homepage_renders_on_the_configured_host(): void
    {
        $this->get('http://scuttlemail.dev/')
            ->assertOk()
            ->assertSee('Scuttle')
            ->assertSee('Development')
            ->assertSee('Scuttle Development builds and secures software for businesses');
    }

    public function test_homepage_links_to_the_scuttle_dev_contact_and_privacy_pages_only(): void
    {
        $this->get('http://scuttlemail.dev/')
            ->assertSee('href="https://scuttle.dev/#contact"', false)
            ->assertSee('href="https://scuttle.dev/privacy"', false)
            ->assertDontSee('mailto:', false)
            ->assertDontSee('info@scuttle.dev');
    }

    public function test_homepage_is_responsive_and_theme_toggle_is_an_icon(): void
    {
        $this->get('http://scuttlemail.dev/')
            ->assertSee('name="viewport" content="width=device-width, initial-scale=1.0"', false)
            ->assertSee('class="icon-moon"', false)
            ->assertSee('class="icon-sun"', false)
            ->assertSee('aria-label="Toggle light and dark theme"', false);
    }

    public function test_homepage_has_light_and_dark_theme_support(): void
    {
        $this->get('http://scuttlemail.dev/')
            ->assertSee('prefers-color-scheme: dark', false)
            ->assertSee("data-theme='light'", false)
            ->assertSee('id="theme-toggle"', false);
    }

    public function test_homepage_is_indexable_and_does_not_load_external_assets(): void
    {
        $this->get('http://scuttlemail.dev/')
            ->assertSee('content="index, follow"', false)
            ->assertDontSee('<script src', false)
            ->assertDontSee('rel="stylesheet"', false);
    }

    public function test_homepage_does_not_show_company_registration_or_opt_out_text(): void
    {
        $this->get('http://scuttlemail.dev/')
            ->assertDontSee('KvK')
            ->assertDontSee('unsubscribe')
            ->assertDontSee('opt out');
    }

    public function test_other_hosts_do_not_get_this_site(): void
    {
        $this->get('http://example.com/')->assertNotFound();
    }

    public function test_robots_txt_is_served_at_the_root(): void
    {
        $this->get('http://scuttlemail.dev/robots.txt')
            ->assertOk()
            ->assertSee('Sitemap: https://scuttlemail.dev/sitemap.xml');
    }

    public function test_sitemap_xml_is_served_at_the_root(): void
    {
        $this->get('http://scuttlemail.dev/sitemap.xml')
            ->assertOk()
            ->assertSee('<urlset', false)
            ->assertSee('https://scuttlemail.dev/', false);
    }

    public function test_www_redirects_permanently_to_the_bare_domain(): void
    {
        $this->get('http://www.scuttlemail.dev/')
            ->assertStatus(301)
            ->assertRedirect('https://scuttlemail.dev/');
    }

    public function test_www_redirect_keeps_the_path_and_query(): void
    {
        $this->get('http://www.scuttlemail.dev/robots.txt?a=1')
            ->assertStatus(301)
            ->assertRedirect('https://scuttlemail.dev/robots.txt?a=1');
    }
}
