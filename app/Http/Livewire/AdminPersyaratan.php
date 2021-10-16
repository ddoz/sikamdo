<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Proposal;
use App\Models\KriteriaPilih;
use Illuminate\Support\Str;
use Auth;


class AdminPersyaratan extends Component
{
    use WithFileUploads;
    public $proposal_id;
    public $tipemedia_id;
    public $bukti_id;
    public $komentar;
    public $inputs = [];
    public $files = [];
    public $isOpen = false;

    public function mount($id)
    {
        $this->proposal_id = $id;
    }

    public function render()
    {
        $tm = [];
        if($this->tipemedia_id=="") {
            $tm = Proposal::find($this->proposal_id);
            $this->tipemedia_id = $tm->tipemedia_id;
        }


        return view('livewire.admin-persyaratan', [
            'media' => $tm, 
            'persyaratan' => KriteriaPilih::where('proposal_id',$this->proposal_id)->get()
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
        return redirect()->to('/proposal');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

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

    public function store()
    {
        $this->validate([
            'komentar' => 'required',
        ]);

        $arrToInsert = array(
            "keterangan" => $this->komentar
        );
        
        $cek = Proposal::where('id',$this->proposal_id)
                    ->update($arrToInsert);
        $this->closeModal();
        session()->flash('message', $this->proposal_id ? 'Keterangan updated successfully.' : 'Keterangan created successfully.');

    }
}
