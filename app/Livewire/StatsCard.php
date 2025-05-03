<?php

namespace App\Livewire;

use Livewire\Component;

class StatsCard extends Component
{
    public $title;
    public $value;
    public $iconName;
    public $color;
    public $description;
    public $prefix;



    public function mount($title, $value, $icon="icon-users", $color = 'primary', $description = '', $prefix = '')
    {
        $this->title = $title;
        $this->value = $value;
        $this->iconName = $icon;
        $this->color = $color;
        $this->description = $description;
        $this->prefix = $prefix;
    }

    public function render()
    {
        return view('livewire.stats-card');
    }
}
