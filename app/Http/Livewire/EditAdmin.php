<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;



class EditAdmin extends Component
{
    use WithSweetAlert;
    use WithSweetAlertToast;

    public $is_edit_mode_on = false;

    public $admin_id;
    public $name;
    public $email;
    public $password;
    public $confirm;

    protected $rules = [
        'name' => ['required', 'string'],
        'email' => ['required', 'email'],
        'password' => ['nullable', 'string', 'min:8'],
    ];


    protected $listeners = [
        'onAdminEdit' => 'enableAdminEditMode',
    ];


    public function render()
    {
        return view('admin.components.edit-admin');
    }

    public function updateAdmin()
    {
        $this->validate();

        if($this->password != $this->confirm)
        {
            return $this->errorToast('Confirm password not match!');
        }

        $user = User::find($this->admin_id);

        $user->name = $this->name;
        $user->email = $this->email;

        if($this->password)
        {
            $user->password = Hash::make($this->password);
        }
        
        if($user->save())
        {
            $this->reset();
            $this->emit('onAdminUpdated');
            $this->is_edit_mode_on = false;
            return $this->success('Updated', '');
        }

        return $this->error('Failed', 'Failed to updated. Something went wrong');
    }

    public function enableAdminEditMode($id)
    {
        $user = User::find($id);

        $this->admin_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;

        $this->is_edit_mode_on = true;
    }

    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }


}
