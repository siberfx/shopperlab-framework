<?php

namespace Shopper\Framework\Http\Livewire\Settings\Mails;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Livewire\Component;
use Shopper\Framework\Services\Mailable;

class Mailables extends Component
{
    protected $listeners = ['onMailableAction' => 'render'];

    /**
     * Define if the we can create mailable in production.
     *
     * @var bool
     */
    public bool $isLocal = false;

    public function mount()
    {
        if (in_array(app()->environment(), config('shopper.mails.allowed_environments'))) {
            $this->isLocal = true;
        }
    }

    public function render()
    {
        return view('shopper::livewire.settings.mails.mailables', [
            'mailables' => (null !== $mailables = Mailable::getMailables())
                ? $mailables->sortBy('name')
                : collect([])
        ]);
    }
}