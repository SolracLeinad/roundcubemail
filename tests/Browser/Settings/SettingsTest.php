<?php

namespace Tests\Browser\Settings;

use Tests\Browser\Components\App;

class SettingsTest extends \Tests\Browser\TestCase
{
    public function testSettings()
    {
        $this->browse(static function ($browser) {
            $browser->go('settings');

            // task should be set to 'settings'
            $browser->with(new App(), static function ($browser) {
                $browser->assertEnv('task', 'settings');
            });

            $browser->assertSeeIn('#layout-sidebar .header', 'Settings');

            // Sidebar menu
            $browser->with('#settings-menu', static function ($browser) {
                $browser->assertSeeIn('li.preferences', 'Preferences');
                $browser->assertSeeIn('li.folders', 'Folders');
                $browser->assertSeeIn('li.identities', 'Identities');
                $browser->assertSeeIn('li.responses', 'Responses');
            });

            // Task menu
            $browser->assertTaskMenu('settings');
        });
    }
}
