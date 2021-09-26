<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TipeMedia;
use App\Models\FormulirBuktiTayang;

class FormulirBuktiTayangs extends Component
{
    public $kolom;
    public $tipe;
    public $tipemedia_id;
    public $tipemedia_id_insert;
    public $formulir_id;
    public $isOpen = 0;

    public $namamedia;

    public function mount($id)
    {
        $this->tipemedia_id = $id;
    }

    public function render()
    {
        $tm = TipeMedia::find($this->tipemedia_id);
        if($this->namamedia=="") {
            $this->namamedia = $tm->nama;
        }
        $formulir = FormulirBuktiTayang::where('tipemedia_id', $this->tipemedia_id)->get();
        return view('livewire.formulir-bukti-tayangs',['tipe_media'=>$this->namamedia,'formulir'=>$formulir]);
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
        $this->kolom = '';
        $this->tipe = '';
        // $this->tipemedia_id = '';
        $this->formulir_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function store()
    {
        $this->validate([
            'kolom' => 'required',
            'tipe' => 'required',
        ]);
        $data = array(
            'kolom' => $this->kolom,
            'tipe' => $this->tipe,
            'tipemedia_id' => $this->tipemedia_id,
        );
        $tm = FormulirBuktiTayang::updateOrCreate(['id' => $this->formulir_id],$data);
        session()->flash('message', $this->formulir_id ? 'Formulir updated successfully.' : 'Tipe Media created successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function back() {
        return redirect()->to('/tipe_media');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $tm = FormulirBuktiTayang::findOrFail($id);
        $this->tipemedia_id = $tm->tipemedia_id;
        $this->kolom = $tm->kolom;
        $this->tipe = $tm->tipe;
        $this->formulir_id = $id;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        $this->formulir_id = $id;
        FormulirBuktiTayang::find($id)->delete();
        session()->flash('message', 'Formulir deleted successfully.');
    }
}
