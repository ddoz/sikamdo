<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Proposal;
use App\Models\FormulirBuktiTayang;
use App\Models\BuktiTayang;
use App\Models\KriteriaPilih;
use App\Models\KriteriaPenilaian;
use Illuminate\Support\Str;
use Auth;

class UserIsiPersyaratan extends Component
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

        $isian = KriteriaPilih::where('proposal_id',$this->proposal_id)->get();
        $form = KriteriaPenilaian::where('tipemedia_id',$this->tipemedia_id)->get();
        return view('livewire.user-isi-persyaratan', [
            'form' => $form,
            'isian' => $isian
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

        $form = KriteriaPenilaian::select(['kriteria_penilaian_details.*'])->join("kriteria_penilaian_details","kriteria_penilaian_details.kriteria_penilaian_id","kriteria_penilaians.id")->where('tipemedia_id',$this->tipemedia_id)->get();
        $err = 0;
        foreach($form as $fbt) {
            if(count($this->inputs)>0) {
                $input = $this->inputs["id_".$fbt->kriteria_penilaian_id];
                if($input==$fbt->id) {
                    $arrToInsert = array(
                        "proposal_id" => $this->proposal_id,
                        "kriteria_id" => $fbt->kriteria_penilaian_id,
                        "kriteriadetail_id" => $fbt->id,
                        "nilai" => $fbt->nilai,
                        "user_id" => Auth::id()
                    );
                    $cek = KriteriaPilih::where('kriteria_id',$fbt->kriteria_penilaian_id)
                                    ->where('proposal_id',$this->proposal_id);
        
                    if($cek->exists()) {
                        $cek = KriteriaPilih::where('kriteria_id',$fbt->kriteria_penilaian_id)
                                    ->where('proposal_id',$this->proposal_id)
                                    ->update($arrToInsert);
        
                    }else {
                        $tm = KriteriaPilih::create($arrToInsert);
                    }
                }
                $fail = 0;
                $err = 0;
            }else {
                $err = 1;
            }

            if($err) {
                $fail = 1;
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
