<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TipeMedia;

class Tipemedias extends Component
{
    public $nama;
    public $tipemedia_id;
    public $isOpen = 0;

    public function render()
    {
        return view('livewire.tipemedias',['tipemedias'=>TipeMedia::all()]);
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
        $this->nama = '';
        $this->tipemedia_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function store()
    {
        $this->validate([
            'nama' => 'required|unique:tipe_media,nama,'.$this->tipemedia_id,
        ]);
        $data = array(
            'nama' => $this->nama
        );
        $tm = TipeMedia::updateOrCreate(['id' => $this->tipemedia_id],$data);
        session()->flash('message', $this->tipemedia_id ? 'Tipe Media updated successfully.' : 'Tipe Media created successfully.');
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
        $tm = TipeMedia::findOrFail($id);
        $this->tipemedia_id = $id;
        $this->nama = $tm->nama;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        $this->tipemedia_id = $id;
        TipeMedia::find($id)->delete();
        session()->flash('message', 'Tipe Media deleted successfully.');
    }
}
