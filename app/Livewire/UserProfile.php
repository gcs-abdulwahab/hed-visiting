<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Component
{
    public $isOpen = false;
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
