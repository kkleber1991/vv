<?php

namespace App\Livewire\Plans;

use App\Models\Plan;
use Livewire\Component;

class ShowPlans extends Component
{
    public function render()
    {
        return view('livewire.plans.show-plans', [
            'plans' => Plan::all()
        ])->layout('layouts.frontend');
    }
} 