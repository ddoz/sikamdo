<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\KriteriaPenilaian;
use App\Models\TipeMedia;

class FormulirPersyaratan extends Component
{
    public $nama_kriteria;
    public $formulir_id;
    public $tipemedia_id;
    public $multiple;
    public $status;
    public $isOpen = 0;

    public function render()
    {
        return view('livewire.formulir-persyaratan',['formulirpersyaratan'=>KriteriaPenilaian::all(),'tipemedia'=>TipeMedia::all()]);
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
        $this->nama_kriteria = '';
        $this->formulir_id = '';
        $this->tipemedia_id = '';
        $this->status = '';
        $this->multiple = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function store()
    {
        $this->validate([
            'nama_kriteria' => 'required|unique:kriteria_penilaians,nama_kriteria,',
        ]);
        $data = array(
            'nama_kriteria' => $this->nama_kriteria,
            'tipemedia_id' => $this->tipemedia_id,
        );
        $tm = KriteriaPenilaian::updateOrCreate(['id' => $this->formulir_id],$data);
        session()->flash('message', $this->formulir_id ? 'Tipe Media updated successfully.' : 'Tipe Media created successfully.');
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
        $tm = KriteriaPenilaian::findOrFail($id);
        $this->formulir_id = $id;
        $this->tipemedia_id = $tm->tipemedia_id;
        $this->nama_kriteria = $tm->nama_kriteria;
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
        try {
            KriteriaPenilaian::find($id)->delete();
            session()->flash('message', 'Kriteria deleted successfully.');
        } catch(\Illuminate\Database\QueryException $e) {
            session()->flash('message', 'Kriteria cannot be deleted.');
        }
    }
}
