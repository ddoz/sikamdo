<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\JadwalPengajuanProposal;

class AdminJadwal extends Component
{
    public $waktu_mulai;
    public $waktu_selesai;
    public $jadwal_id;
    public $isOpen = 0;

    public function render()
    {
        return view('livewire.admin-jadwal',['jadwals'=>JadwalPengajuanProposal::all()]);
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
        $this->waktu_mulai = '';
        $this->waktu_selesai = '';
        $this->jadwal_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function store()
    {
        $this->validate([
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);
        $data = array(
            'waktu_mulai' => \Carbon\Carbon::parse($this->waktu_mulai)->format('Y-m-d H:i:s'),
            'waktu_selesai' => \Carbon\Carbon::parse($this->waktu_selesai)->format('Y-m-d H:i:s'),
            'status_jadwal' => '1',
        );
        $tm = JadwalPengajuanProposal::updateOrCreate(['id' => $this->jadwal_id],$data);
        session()->flash('message', $this->jadwal_id ? 'Jadwal updated successfully.' : 'Jadwal created successfully.');
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
        $tm = JadwalPengajuanProposal::findOrFail($id);
        $this->jadwal_id = $id;
        $this->waktu_mulai = $tm->waktu_mulai;
        $this->waktu_selesai = $tm->waktu_selesai;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        $this->jadwal_id = $id;
        JadwalPengajuanProposal::find($id)->delete();
        session()->flash('message', 'Jadwal deleted successfully.');
    }
}
