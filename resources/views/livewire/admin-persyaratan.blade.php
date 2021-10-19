<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Persyaratan') }}
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


    <button wire:click="back()" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mt-10"><</button>
    <button wire:click="openModal()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-10">Beri Komentar</button>
    <br><br>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                Identitas Media
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 text-left text-xs font-semibold uppercase tracking-wider">
                                {{ __('Nama Media') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 text-left border-black bg-black text-white text-xs font-semibold uppercase tracking-wider">
                                {{ @$media->nama_media }}
                            </th>
                        </tr>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 text-left text-xs font-semibold uppercase tracking-wider">
                                {{ __('Tipe Media') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ @$media->tipemedia->nama }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

            </div>
        </div>


    @if (count($persyaratan)>0)
        <div class="py-10">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ __('Kriteria') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ __('Detail') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                                {{ __('Nilai') }}
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $nilai_total = 0;
                        @endphp
                        @foreach($persyaratan as $tm) 
                            <tr>
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif">
                                    {{ @$tm->kriteriadetail->kriteria_penilaian->nama_kriteria }}
                                </td>
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif">
                                     {{@$tm->kriteriadetail->nama_penilaian}}
                                </td>
                               
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif">
                                     {{@$tm->kriteriadetail->nilai}}
                                </td>
                                <td class="px-5 py-5 bg-white text-sm @if (!$loop->last) border-gray-200 border-b @endif">

                                </td>
                            </tr>

                            @php 
                                $nilai_total = $nilai_total + $tm->kriteriadetail->nilai;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="px-5 py-5 bg-white text-semibold" colspan="2">Total</td>
                            <td class="px-5 py-5 bg-white text-sm border-gray-200 border-b">{{$nilai_total}}</td>
                            <td class="px-5 py-3 border-b-2  border-black bg-green-300 text-left text-xs font-bold text-white uppercase tracking-wider">
                            Rp. 6.000.000
                                @php
                                    if($nilai_total <= 100) {
                                        "Rp. 4.000.000";
                                    }
                                    if($nilai_total <= 90) {
                                        "Rp.3.000.000";
                                    }
                                    if($nilai_total <= 80) {
                                        "Rp.2.500.000";
                                    }
                                @endphp
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @else
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                Belum Mengisi Persyaratan
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
                                            <label for="komentarInput" class="block text-gray-700 text-sm font-bold mb-2">Komentar:</label>
                                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="komentarInput" placeholder="Isi Komentar" wire:model="komentar"></textarea>
                                            @error('komentar') <span class="text-red-500">{{ $message }}</span>@enderror
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