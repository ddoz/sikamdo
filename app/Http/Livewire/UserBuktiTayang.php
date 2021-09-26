<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Proposal;
use App\Models\TipeMedia;
use Illuminate\Support\Str;
use Auth;

class UserBuktiTayang extends Component
{
    use WithFileUploads;

    public $isOpen = 0;
    public $mode = 'insert';
    public $isOpenBerkas = 0;
    public $tipemedia_id;
    public $nama_media;
    public $nama_pic;
    public $jabatan_pic;
    public $kartu_identitas_pic; //file
    public $sk_pic; //file
    public $alamat_redaksi_1;
    public $alamat_redaksi_2;
    public $kota;
    public $provinsi;
    public $kode_pos;
    public $email_redaksi;
    public $kontak_redaksi;
    public $website;
    public $surat_permohonan_kerjasama; //file
    public $proposal_penawaran; //file
    public $siup_situ; //file
    public $npwp; //file
    public $sertifikat_kemenkumham; //file
    public $sertifikat_dewan_pers; //file
    public $kode_identifikasi;
    public $user_id;
    public $status;
    public $keterangan;
    public $proposal_id;

    public function render()
    {
        return view('livewire.user-bukti-tayang',[
            'proposals'=>Proposal::where('user_id',Auth::id())->where('status','approve')->get(),
            'tipe_media' =>TipeMedia::all()
        ]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function create()
    {
        $this->mode = 'insert';
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
        $this->mode = 'update';
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
    public function openModalBerkas()
    {
        $this->isOpenBerkas = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModalBerkas()
    {
        $this->isOpenBerkas = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->tipemedia_id = '';
        $this->nama_media = '';
        $this->nama_pic = '';
        $this->jabatan_pic = '';
        $this->kartu_identitas_pic = ''; //file
        $this->sk_pic = ''; //file
        $this->alamat_redaksi_1 = '';
        $this->alamat_redaksi_2 = '';
        $this->kota = '';
        $this->provinsi = '';
        $this->kode_pos = '';
        $this->email_redaksi = '';
        $this->kontak_redaksi = '';
        $this->website = '';
        $this->surat_permohonan_kerjasama = ''; //file
        $this->proposal_penawaran = ''; //file
        $this->siup_situ = ''; //file
        $this->npwp = ''; //file
        $this->sertifikat_kemenkumham = ''; //file
        $this->sertifikat_dewan_pers = ''; //file
        $this->kode_identifikasi = '';
        $this->proposal_id = '';
        $this->kode_identifikasi = '';
        $this->user_id = '';
        $this->status = '';
        $this->keterangan = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function store()
    {
        if($this->mode=='insert') {
            $this->validate([
                'tipemedia_id'=>'required',
                'nama_media'=>'required',
                'nama_pic'=>'required',
                'jabatan_pic'=>'required',
                'kartu_identitas_pic'=>'required|image', //file
                'sk_pic'=>'required|mimes:pdf', //file
                'alamat_redaksi_1'=>'required',
                'alamat_redaksi_2'=>'required',
                'kota'=>'required',
                'provinsi'=>'required',
                'kode_pos'=>'required',
                'email_redaksi'=>'required',
                'kontak_redaksi'=>'required',
                'website'=>'required',
                'surat_permohonan_kerjasama'=>'required|mimes:pdf', //file
                'proposal_penawaran'=>'required|mimes:pdf', //file
                'siup_situ'=>'required|mimes:pdf', //file
                'npwp'=>'required|image', //file
                'sertifikat_kemenkumham'=>'required|mimes:pdf', //file
                'sertifikat_dewan_pers'=>'required|mimes:pdf', //file
            ]);
        }
        if($this->mode=='update') {
            $this->validate([
                'tipemedia_id'=>'required',
                'nama_media'=>'required',
                'nama_pic'=>'required',
                'jabatan_pic'=>'required',
                'alamat_redaksi_1'=>'required',
                'alamat_redaksi_2'=>'required',
                'kota'=>'required',
                'provinsi'=>'required',
                'kode_pos'=>'required',
                'email_redaksi'=>'required',
                'kontak_redaksi'=>'required',
                'website'=>'required',
            ]);
        }
        $data = array(
            'tipemedia_id' => $this->tipemedia_id,
            'nama_media' => $this->nama_media,
            'nama_pic' => $this->nama_pic,
            'jabatan_pic' => $this->jabatan_pic,
            'alamat_redaksi_1' => $this->alamat_redaksi_1,
            'alamat_redaksi_2' => $this->alamat_redaksi_2,
            'kota' => $this->kota,
            'provinsi' => $this->provinsi,
            'kode_pos' => $this->kode_pos,
            'email_redaksi' => $this->email_redaksi,
            'kontak_redaksi' => $this->kontak_redaksi,
            'website' => $this->website,
            'status' => 'draft',
            'user_id' => Auth::id(),
            'kode_identifikasi'=> 'SIKEPLU_'.Str::random(20)
        );

        if($this->kartu_identitas_pic != null) {
            $data['kartu_identitas_pic'] = $this->kartu_identitas_pic->store('public/berkas_proposal');
        }
        if($this->sk_pic != null) {
            $data['sk_pic'] = $this->sk_pic->store('public/berkas_proposal');
        }
        if($this->surat_permohonan_kerjasama != null) {
            $data['surat_permohonan_kerjasama'] = $this->surat_permohonan_kerjasama->store('public/berkas_proposal');
        }
        if($this->proposal_penawaran != null) {
            $data['proposal_penawaran'] = $this->proposal_penawaran->store('public/berkas_proposal');
        }
        if($this->siup_situ != null) {
            $data['siup_situ'] = $this->siup_situ->store('public/berkas_proposal');
        }
        if($this->npwp != null) {
            $data['npwp'] = $this->npwp->store('public/berkas_proposal');
        }
        if($this->sertifikat_kemenkumham != null) {
            $data['sertifikat_kemenkumham'] = $this->sertifikat_kemenkumham->store('public/berkas_proposal');
        }
        if($this->sertifikat_dewan_pers != null) {
            $data['sertifikat_dewan_pers'] = $this->sertifikat_dewan_pers->store('public/berkas_proposal');
        }

        $us = Proposal::updateOrCreate(['id' => $this->proposal_id],$data);
        session()->flash('message', $this->proposal_id ? 'Proposal updated successfully.' : 'Proposal created successfully.');
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
        $us = Proposal::findOrFail($id);
        $this->proposal_id = $id;
        $this->tipemedia_id = $us->tipemedia_id;
        $this->nama_media = $us->nama_media;
        $this->nama_pic = $us->nama_pic;
        $this->jabatan_pic = $us->jabatan_pic;
        $this->alamat_redaksi_1 = $us->alamat_redaksi_1;
        $this->alamat_redaksi_2 = $us->alamat_redaksi_2;
        $this->provinsi = $us->provinsi;
        $this->kota = $us->kota;
        $this->kode_pos = $us->kode_pos;
        $this->email_redaksi = $us->email_redaksi;
        $this->kontak_redaksi = $us->kontak_redaksi;
        $this->website = $us->website;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function berkas($id)
    {
        $us = Proposal::findOrFail($id);
        $this->proposal_id = $id;
        $this->kartu_identitas_pic = $us->kartu_identitas_pic;
        $this->sk_pic = $us->sk_pic;
        $this->surat_permohonan_kerjasama = $us->surat_permohonan_kerjasama;
        $this->proposal_penawaran = $us->proposal_penawaran;
        $this->siup_situ = $us->siup_situ;
        $this->npwp = $us->npwp;
        $this->sertifikat_kemenkumham = $us->sertifikat_kemenkumham;
        $this->sertifikat_dewan_pers = $us->sertifikat_dewan_pers;
        $this->openModalBerkas();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        $this->proposal_id = $id;
        Proposal::find($id)->delete();
        session()->flash('message', 'Proposal deleted successfully.');
    }
}
