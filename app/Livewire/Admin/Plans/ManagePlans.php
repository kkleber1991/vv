<?php

namespace App\Livewire\Admin\Plans;

use App\Models\Plan;
use Livewire\Component;

class ManagePlans extends Component
{
    public $planId;
    public $name;
    public $price;
    public $description;
    public $max_ads;
    public $max_photos;
    public $max_videos;
    public $boosts_per_week;
    public $boost_type = 'padrao';
    public $has_verification_seal = false;
    public $has_priority_support = false;
    public $is_popular = false;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|min:3',
        'price' => 'required|numeric|min:0',
        'description' => 'required',
        'max_ads' => 'required|integer|min:0',
        'max_photos' => 'required|integer|min:0',
        'max_videos' => 'required|integer|min:0',
        'boosts_per_week' => 'required|integer|min:0',
        'boost_type' => 'required|in:padrao,destacado,super_destaque',
        'has_verification_seal' => 'boolean',
        'has_priority_support' => 'boolean',
        'is_popular' => 'boolean'
    ];

    public function render()
    {
        return view('livewire.admin.plans.manage-plans', [
            'plans' => Plan::all()
        ])->layout('layouts.app');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'max_ads' => $this->max_ads,
            'max_photos' => $this->max_photos,
            'max_videos' => $this->max_videos,
            'boosts_per_week' => $this->boosts_per_week,
            'boost_type' => $this->boost_type,
            'has_verification_seal' => $this->has_verification_seal,
            'has_priority_support' => $this->has_priority_support,
            'is_popular' => $this->is_popular,
        ];

        if ($this->isEditing) {
            Plan::find($this->planId)->update($data);
            session()->flash('message', 'Plano atualizado com sucesso!');
        } else {
            Plan::create($data);
            session()->flash('message', 'Plano criado com sucesso!');
        }

        $this->resetForm();
    }

    public function edit(Plan $plan)
    {
        $this->planId = $plan->id;
        $this->name = $plan->name;
        $this->price = $plan->price;
        $this->description = $plan->description;
        $this->max_ads = $plan->max_ads;
        $this->max_photos = $plan->max_photos;
        $this->max_videos = $plan->max_videos;
        $this->boosts_per_week = $plan->boosts_per_week;
        $this->boost_type = $plan->boost_type;
        $this->has_verification_seal = $plan->has_verification_seal;
        $this->has_priority_support = $plan->has_priority_support;
        $this->is_popular = $plan->is_popular;
        $this->isEditing = true;
    }

    public function delete(Plan $plan)
    {
        if ($plan->users()->count() > 0) {
            session()->flash('error', 'Não é possível excluir um plano que possui usuários!');
            return;
        }

        $plan->delete();
        session()->flash('message', 'Plano excluído com sucesso!');
    }

    public function resetForm()
    {
        $this->reset([
            'planId', 'name', 'price', 'description', 'max_ads', 'max_photos',
            'max_videos', 'boosts_per_week', 'boost_type', 'has_verification_seal',
            'has_priority_support', 'is_popular', 'isEditing'
        ]);
    }
} 