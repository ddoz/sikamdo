<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Proposal;
use App\Models\FormulirBuktiTayang;
use App\Models\BuktiTayang;
use Illuminate\Support\Str;
use Auth;

class UserKirimBuktiTayang extends Component
{

    use WithFileUploads;
    public $proposal_id;
    public $tipemedia_id;
    public $bukti_id;
    public $inputs = [];
    public $files = [];

    public function mount($id)
    {
        $this->proposal_id = $id;
    }

    public function render()
    {
        if($this->tipemedia_id=="") {
            $tm = Proposal::find($this->proposal_id);
            $this->tipemedia_id = $tm->tipemedia_id;
        }
        return view('livewire.user-kirim-bukti-tayang', [
            'form' =>FormulirBuktiTayang::where('tipemedia_id',$this->tipemedia_id)->get(),
            'buktitayang' => BuktiTayang::where('proposal_id',$this->proposal_id)->get()
        ]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->reset('files');
        $this->reset('inputs');
    }

    public function back() {
        return redirect()->to('/pengiriman_bukti');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function store()
    {
        $this->validate([
            'inputs.id_.*' => 'required',
        ]);

        $formulirBuktiTayang = FormulirBuktiTayang::where('tipemedia_id',$this->tipemedia_id)->get();
        $err = 0;
        foreach($formulirBuktiTayang as $fbt) {
            if($fbt->tipe=='file') {
                if(count($this->files)>0) {
                    $input = $this->files["id_".$fbt->id];
                    $input = $input->store("public/berkas_pengiriman");
                    $err = 0;
                }else {
                    $err = 1;
                }
            }else {
                if(count($this->inputs)>0) {
                    $input = $this->inputs["id_".$fbt->id];
                    $err = 0;
                }else {
                    $err = 1;
                }
            }

            if($err) {
                $fail = 1;
            }else {
                $arrToInsert = array(
                    "proposal_id" => $this->proposal_id,
                    "formula_id" => $fbt->id,
                    "value" => $input
                );
                // $cek = BuktiTayang::where('formula_id',$fbt->id)
                //                 ->where('proposal_id',$this->proposal_id);
    
                // if($cek->exists()) {
                //     $cek = BuktiTayang::where('formula_id',$fbt->id)
                //                 ->where('proposal_id',$this->proposal_id)
                //                 ->update($arrToInsert);
    
                // }else {
                    $tm = BuktiTayang::create($arrToInsert);
                // }
                $fail = 0;
            }
        }
        if($fail) {
            session()->flash('message', 'Harap isi semua data.');
        }else {
            $this->resetInputFields(); 
            session()->flash('message', $this->bukti_id ? 'Bukti Tayang updated successfully.' : 'Bukti Tayang created successfully.');
        }

    }
}
