<?php

namespace DraperStudio\Flash;

use Illuminate\Session\Store;
use Illuminate\Support\MessageBag;

class FlashNotifier
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function success($message, $title = null)
    {
        return $this->message($message, 'success', $title);
    }

    public function info($message, $title = null)
    {
        return $this->message($message, 'info', $title);
    }

    public function warning($message, $title = null)
    {
        return $this->message($message, 'warning', $title);
    }

    public function error($message, $title = null)
    {
        return $this->message($message, 'danger', $title);
    }

    public function important()
    {
        $this->session->flash('flash_notification.important', true);

        return $this;
    }

    public function overlay($message, $title = 'Notice')
    {
        return $this->message($message, 'info', $title, true);
    }

    public function message($message, $level = 'info', $title = 'Notice', $overlay = false)
    {
        if (is_array($message)) {
            $message = new MessageBag($message);
        }

        $this->session->flash('flash_notification.messages', [
            compact('message', 'level', 'title', 'overlay'),
        ]);

        return $this;
    }
}
