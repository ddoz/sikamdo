<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Proposal;
use App\Models\KriteriaPenilaian;
use App\Models\KriteriaPenilaianDetail;
use App\Models\BuktiTayang;
use Illuminate\Support\Str;
use Auth;

class FormulirPersyaratanDetail extends Component
{
    public $nama_penilaian;
    public $tipe;
    public $kriteria_penilaian_id;
    public $kriteria_penilaian_id_insert;
    public $formulir_id;
    public $isOpen = 0;

    public $namakriteria;

    public function mount($id)
    {
        $this->kriteria_penilaian_id = $id;
    }

    public function render()
    {
        $tm = KriteriaPenilaian::find($this->kriteria_penilaian_id);
        if($this->namakriteria=="") {
            $this->namakriteria = $tm->nama_kriteria;
        }
        $formulir = KriteriaPenilaianDetail::where('kriteria_penilaian_id', $this->kriteria_penilaian_id)->get();
        return view('livewire.formulir-persyaratan-detail',['namakriteria'=>$this->namakriteria,'formulir'=>$formulir]);
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
        $this->nama_penilaian = '';
        $this->nilai = '';
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
            'nama_penilaian' => 'required',
            'nilai' => 'required',
        ]);
        $data = array(
            'nama_penilaian' => $this->nama_penilaian,
            'kriteria_penilaian_id' => $this->kriteria_penilaian_id,
            'nilai' => $this->nilai,
        );
        $tm = KriteriaPenilaianDetail::updateOrCreate(['id' => $this->formulir_id],$data);
        session()->flash('message', $this->formulir_id ? 'Formulir updated successfully.' : 'Created successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function back() {
        return redirect()->to('/kriteria_penilaian');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $tm = KriteriaPenilaianDetail::findOrFail($id);
        $this->nama_penilaian = $tm->nama_penilaian;
        $this->nilai = $tm->nilai;
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
        KriteriaPenilaianDetail::find($id)->delete();
        session()->flash('message', 'Formulir deleted successfully.');
    }
}
