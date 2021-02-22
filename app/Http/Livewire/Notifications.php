<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $showNotification = false;
    public $userId;
    public $message;

    public function mount()
    {
        $this->userId = auth()->id();
    }
    public function render()
    {
        return view('livewire.notifications');
    }

    public function getListeners()
    {
        return [
            "echo-notification:App.User.{$this->userId},RealTimeNotification" => 'notify',
        ];
    }

    public function notify($data)
    {
        $this->showNotification = true;
        $this->message = $data['message'];
    }
}
