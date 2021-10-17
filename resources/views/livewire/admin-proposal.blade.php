<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Pengajuan Proposal') }}
    </h2>
</x-slot>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if (session()->has('message'))
        <div id="alert" class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
            <span class="inline-block align-middle mr-8">
                {{ session('message') }}
            </span>
            <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                <span>×</span>
            </button>
        </div>
    @endif
    @if (count($proposals)>0)
        <div class="py-10">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ __('Tipe Media') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ __('Nama Media') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ __('Nama PIC') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ __('Status') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ __('Status Bukti Tayang') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ __('Keterangan') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ __('Ubah Status') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proposals as $tm) 
                            <tr>
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif">
                                    {{ @$tm->tipemedia->nama }}
                                </td>
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif">
                                    {{ $tm->nama_media }}
                                </td>
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif">
                                    {{ $tm->nama_pic }}
                                </td>
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif">
                                    @if($tm->status=='draft')
                                        <span class="bg-yellow-400 px-5 py-5">{{ strtoupper($tm->status) }}</span>
                                    @elseif($tm->status=='approve')
                                        <span class="bg-green-400 px-5 py-5">{{ strtoupper($tm->status) }}</span>
                                    @elseif($tm->status=='decline')
                                        <span class="bg-red-400 px-5 py-5">{{ strtoupper($tm->status) }}</span>
                                    @endif
                                </td>
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif">
                                    @if($tm->status_bukti_tayang=='0')
                                        Belum Upload
                                    @else
                                        Sudah Upload
                                    @endif
                                </td>
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif">
                                    {{ $tm->keterangan }}
                                </td>
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif">
                                    <form>
                                            <select wire:change="changeStatus($event.target.value,{{$tm->id}})" name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="status">
                                                <option value="">Pilih</option>
                                                <option value="draft">Draft</option>
                                                <option value="approve">Approve</option>
                                                <option value="decline">Decline</option>
                                            </select>
                                    </form>
                                </td>
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif text-right">
                                    <div class="inline-block whitespace-no-wrap">
                                        <button wire:click="berkas({{ $tm->id }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Berkas</button>
                                        <a href="{{route('bukti_tayang',['id'=>$tm->id])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Bukti Tayang</a>
                                        <a href="{{route('persyaratan',['id'=>$tm->id])}}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Persyaratan</a>
                                        <button wire:click="$emit('triggerDelete',{{ $tm->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if($isOpenBerkas)
    <div class="fixed z-100 w-full h-full bg-gray-500 opacity-75 top-0 left-0"></div>
        <div class="fixed z-101 w-full h-full top-0 left-0 overflow-y-auto">
            <div class="table w-full h-full py-6">
                <div class="table-cell text-center align-middle">
                    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl">
                            <form>
                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="kartuindentitasInput" class="block text-gray-700 text-sm font-bold mb-2">Kartu Identitas PIC:</label>
                                            <img width="200" src="{{asset('storage/'.$kartu_identitas_pic)}}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="skpicInput" class="block text-gray-700 text-sm font-bold mb-2">Kartu Identitas PIC:</label>
                                            <a href="{{asset('storage/'.$sk_pic)}}" class="inline-flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" target="_blank">Lihat Dokumen</a>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="skpicInput" class="block text-gray-700 text-sm font-bold mb-2">Surat Permohonan Kerjasama:</label>
                                            <a href="{{asset('storage/'.$surat_permohonan_kerjasama)}}" class="inline-flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" target="_blank">Lihat Dokumen</a>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="skpicInput" class="block text-gray-700 text-sm font-bold mb-2">Proposal Penawaran:</label>
                                            <a href="{{asset('storage/'.$proposal_penawaran)}}" class="inline-flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" target="_blank">Lihat Dokumen</a>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="skpicInput" class="block text-gray-700 text-sm font-bold mb-2">SIUP/SITU:</label>
                                            <a href="{{asset('storage/'.$siup_situ)}}" class="inline-flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" target="_blank">Lihat Dokumen</a>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="skpicInput" class="block text-gray-700 text-sm font-bold mb-2">NPWP:</label>
                                            <img width="300" src="{{asset('storage/'.$npwp)}}" alt="">
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="skpicInput" class="block text-gray-700 text-sm font-bold mb-2">Sertifikat KEMENKUMHAM:</label>
                                            <a href="{{asset('storage/'.$sertifikat_kemenkumham)}}" class="inline-flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" target="_blank">Lihat Dokumen</a>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="skpicInput" class="block text-gray-700 text-sm font-bold mb-2">Sertifikat Dewan PERS:</label>
                                            <a href="{{asset('storage/'.$sertifikat_dewan_pers)}}" class="inline-flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" target="_blank">Lihat Dokumen</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    
                                    <span class="mt-3 flex w-full sm:mt-0 sm:w-auto">
                                        <button wire:click="closeModalBerkas()" type="button" class="inline-flex bg-white hover:bg-gray-200 border border-gray-300 text-gray-500 font-bold py-2 px-4 rounded">Cancel</button>
                                    </span>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($isOpen)
        <div class="fixed z-100 w-full h-full bg-gray-500 opacity-75 top-0 left-0"></div>
        <div class="fixed z-101 w-full h-full top-0 left-0 overflow-y-auto">
            <div class="table w-full h-full py-6">
                <div class="table-cell text-center align-middle">
                    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl">
                            <form>
                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="tipemediaInput" class="block text-gray-700 text-sm font-bold mb-2">Tipe Media:</label>
                                            <select name="tipemedia_id" id="tipemediaInput" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="tipemedia_id">
                                                <option value="">Pilih</option>
                                                @foreach($tipe_media as $tm)
                                                <option value="{{$tm->id}}">{{$tm->nama}}</option>
                                                @endforeach
                                            </select>
                                            @error('tipemedia_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="namamediaInput" class="block text-gray-700 text-sm font-bold mb-2">Nama Media:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="namamediaInput" placeholder="Enter Nama Media" wire:model="nama_media">
                                            @error('nama_media') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="namapicInput" class="block text-gray-700 text-sm font-bold mb-2">Nama PIC:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="namapicInput" placeholder="Enter Nama PIC" wire:model="nama_pic">
                                            @error('nama_pic') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="jabatanpicInput" class="block text-gray-700 text-sm font-bold mb-2">Jabatan PIC:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jabatanpicInput" placeholder="Enter Jabatan PIC" wire:model="jabatan_pic">
                                            @error('jabatan_pic') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="kartuidentitaspicInput" class="block text-gray-700 text-sm font-bold mb-2">Kartu Identitas PIC:</label>
                                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kartuidentitaspicInput" wire:model="kartu_identitas_pic">
                                            @error('kartu_identitas_pic') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="skpicInput" class="block text-gray-700 text-sm font-bold mb-2">SK PIC:</label>
                                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="skpicInput" wire:model="sk_pic">
                                            @error('sk_pic') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="alamatredaksi1Input" class="block text-gray-700 text-sm font-bold mb-2">Alamat Redaksi 1:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamatredaksi1Input" placeholder="Enter Alamat Redaksi 1" wire:model="alamat_redaksi_1">
                                            @error('alamat_redaksi_1') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="alamatredaksi2Input" class="block text-gray-700 text-sm font-bold mb-2">Alamat Redaksi 2:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamatredaksi2Input" placeholder="Enter Alamat Redaksi 2" wire:model="alamat_redaksi_2">
                                            @error('alamat_redaksi_2') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="provinsiInput" class="block text-gray-700 text-sm font-bold mb-2">Provinsi:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="provinsiInput" placeholder="Enter Provinsi" wire:model="provinsi">
                                            @error('provinsi') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="kotaInput" class="block text-gray-700 text-sm font-bold mb-2">Kota:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kotaInput" placeholder="Enter Kota" wire:model="kota">
                                            @error('kota') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="kodeposInput" class="block text-gray-700 text-sm font-bold mb-2">Kode Pos:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kodeposInput" placeholder="Enter Kode Pos" wire:model="kode_pos">
                                            @error('kode_pos') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="emailredaksiInput" class="block text-gray-700 text-sm font-bold mb-2">Email Redaksi:</label>
                                            <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="emailredaksiInput" placeholder="Enter Email Redaksi" wire:model="email_redaksi">
                                            @error('email_redaksi') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="kontakredaksiInput" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telpon Redaksi:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kontakredaksiInput" placeholder="Enter Kontak Redaksi" wire:model="kontak_redaksi">
                                            @error('kontak_redaksi') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="websiteInput" class="block text-gray-700 text-sm font-bold mb-2">Website:</label>
                                            <input type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="websiteInput" placeholder="Enter Website" wire:model="website">
                                            @error('website') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="suratpermohonanInput" class="block text-gray-700 text-sm font-bold mb-2">Surat Permohonan Kerjasama:</label>
                                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="suratpermohonanInput" wire:model="surat_permohonan_kerjasama">
                                            @error('surat_permohonan_kerjasama') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="proposalpenawaranInput" class="block text-gray-700 text-sm font-bold mb-2">Proposal Penawaran:</label>
                                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="proposalpenawaranInput" wire:model="proposal_penawaran">
                                            @error('proposal_penawaran') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="sipuInput" class="block text-gray-700 text-sm font-bold mb-2">SIUP/SITU:</label>
                                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sipuInput" wire:model="siup_situ">
                                            @error('siup_situ') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="npwpInput" class="block text-gray-700 text-sm font-bold mb-2">NPWP:</label>
                                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="npwpInput" wire:model="npwp">
                                            @error('npwp') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="kumhamInput" class="block text-gray-700 text-sm font-bold mb-2">Sertifikat KEMENKUMHAM:</label>
                                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kumhamInput" wire:model="sertifikat_kemenkumham">
                                            @error('sertifikat_kemenkumham') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="persInput" class="block text-gray-700 text-sm font-bold mb-2">Sertifikat Dewan PERS:</label>
                                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="persInput" wire:model="sertifikat_dewan_pers">
                                            @error('sertifikat_dewan_pers') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    
                                </div>
                                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <span class="flex w-full sm:ml-3 sm:w-auto">
                                    <button wire:click.prevent="store()" type="button" class="inline-flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                                </span>
                                <span class="mt-3 flex w-full sm:mt-0 sm:w-auto">
                                    <button wire:click="closeModal()" type="button" class="inline-flex bg-white hover:bg-gray-200 border border-gray-300 text-gray-500 font-bold py-2 px-4 rounded">Cancel</button>
                                </span>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        @this.on('triggerDelete', companyId => {
            Swal.fire({
                title: 'Are You Sure?',
                text: 'Company record will be deleted!',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete!'
            }).then((result) => {
                if (result.value) {
                    @this.call('delete',companyId)
                } else {
                    console.log("Canceled");
                }
            });
        });
    })
</script>
@endpush