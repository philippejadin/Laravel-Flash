<?php

/*
 * This file is part of Laravel Flash.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Package\Test;

/**
 * Class FlashTest.
 */
class FlashTest extends \Orchestra\Testbench\TestCase
{
    protected $session;
    protected $flash;

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->session = \Mockery::mock('Laracasts\Flash\SessionStore');
    }

    /** @test */
    public function it_displays_default_flash_notifications()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.messages', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'info');

        \Flash::message('Welcome Aboard');
    }

    /** @test */
    public function it_displays_info_flash_notifications()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.messages', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'info');

        \Flash::info('Welcome Aboard');
    }

    /** @test */
    public function it_displays_success_flash_notifications()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.messages', 'Welcome Aboard');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'success');

        \Flash::success('Welcome Aboard');
    }

    /** @test */
    public function it_displays_error_flash_notifications()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.messages', 'Uh Oh');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'danger');

        \Flash::error('Uh Oh');
    }

    /** @test */
    public function it_displays_warning_flash_notifications()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.messages', 'Be careful!');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'warning');

        \Flash::warning('Be careful!');
    }

    /** @test */
    public function it_displays_custom_message_titles()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.messages', 'You are now signed up.');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Success Heading');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'success');

        \Flash::success('You are now signed up.', 'Success Heading');
    }

    /** @test */
    public function it_displays_flash_overlay_notifications()
    {
        $this->session->shouldReceive('flash')->with('flash_notification.messages', 'Overlay Message');
        $this->session->shouldReceive('flash')->with('flash_notification.title', 'Notice');
        $this->session->shouldReceive('flash')->with('flash_notification.level', 'info');
        $this->session->shouldReceive('flash')->with('flash_notification.overlay', true);

        \Flash::overlay('Overlay Message');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['DraperStudio\Flash\ServiceProvider'];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return ['Flash' => 'DraperStudio\Flash\Facades\Flash'];
    }
}
