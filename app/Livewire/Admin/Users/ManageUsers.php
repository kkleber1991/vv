<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ManageUsers extends Component
{
    use WithPagination;

    public $userId;
    public $name;
    public $email;
    public $password;
    public $role;
    public $plan_id;
    public $isEditing = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'role' => 'required|exists:roles,name',
        'plan_id' => 'required|exists:plans,id',
        'password' => 'nullable|min:8'
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['userId', 'name', 'email', 'password', 'role', 'plan_id', 'isEditing']);
    }

    public function save()
    {
        if ($this->isEditing) {
            $this->rules['email'] = 'required|email|unique:users,email,' . $this->userId;
        } else {
            $this->rules['email'] = 'required|email|unique:users';
            $this->rules['password'] = 'required|min:8';
        }

        $this->validate();

        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'plan_id' => $this->plan_id,
        ];

        if ($this->password) {
            $userData['password'] = Hash::make($this->password);
        }

        if ($this->isEditing) {
            $user = User::find($this->userId);
            $user->update($userData);
            $user->syncRoles([$this->role]);
            session()->flash('message', 'Usuário atualizado com sucesso!');
        } else {
            $user = User::create($userData);
            $user->assignRole($this->role);
            session()->flash('message', 'Usuário criado com sucesso!');
        }

        $this->resetForm();
    }

    public function edit(User $user)
    {
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->first()->name ?? '';
        $this->plan_id = $user->plan_id;
        $this->isEditing = true;
    }

    public function delete(User $user)
    {
        if ($user->id === auth()->id()) {
            session()->flash('error', 'Você não pode excluir seu próprio usuário!');
            return;
        }

        $user->delete();
        session()->flash('message', 'Usuário excluído com sucesso!');
    }

    public function render()
    {
        $users = User::where('name', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->paginate(10);

        return view('livewire.admin.users.manage-users', [
            'users' => $users,
            'roles' => Role::all(),
            'plans' => Plan::all()
        ])->layout('layouts.app');
    }
} 