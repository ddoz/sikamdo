<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    public $name;
    public $email;
    public $password;
    public $user_level;
    public $user_id;
    public $isOpen = 0;

    public function render()
    {
        return view('livewire.users',['users'=>User::all()]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->user_level = '';
        $this->user_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function store()
    {
        $this->validate([
            'email' => 'required|unique:users,email,'.$this->user_id,
        ]);
        $data = array(
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'user_level' => $this->user_level
        );
        $us = User::updateOrCreate(['id' => $this->user_id],$data);
        session()->flash('message', $this->user_id ? 'Users updated successfully.' : 'Users created successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $us = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $us->name;
        $this->password = $us->password;
        $this->user_level = $us->user_level;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        $this->user_id = $id;
        User::find($id)->delete();
        session()->flash('message', 'Users deleted successfully.');
    }
}
