<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Presence extends Component
{
    public $users = [];

    public function render()
    {
        return view('livewire.presence');
    }

    public function getListeners()
    {
        //For hps, just add account id for channel name.

        return [
            "echo-presence:live.user,joining" => 'joining',
            "echo-presence:live.user,here" => 'here',
            "echo-presence:live.user,leaving" => 'leaving',
        ];
    }

    public function joining($data)
    {
        $this->users[] = $data;

    }

    public function here($data)
    {
        $this->users = $data;
    }

    public function leaving($data)
    {
        $users = collect($this->users);

        $firstIndex = $users->search(function ($authData) use ($data) {
            return $authData['id'] == $data['id'];
        });

        $users->splice($firstIndex, 1);

        $this->users = $users->toArray();
    }

}
