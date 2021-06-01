<div>
    <div wire:loading wire:target="store, destroy, aktif, nonaktif, createShowModal, showModalKP, showModalTA,
    downloadrekapall, exportBimbing, exportEwmp, exportHonor,">
        <div class='loader'>
            <div class='loader_overlay'></div>
            <div class='loader_cogs'>
                <div class='loader_cogs__top'>
                    <div class='top_part'></div>
                    <div class='top_part'></div>
                    <div class='top_part'></div>
                    <div class='top_hole'></div>
                </div>
                <div class='loader_cogs__left'>
                    <div class='left_part'></div>
                    <div class='left_part'></div>
                    <div class='left_part'></div>
                    <div class='left_hole'></div>
                </div>
                <div class='loader_cogs__bottom'>
                    <div class='bottom_part'></div>
                    <div class='bottom_part'></div>
                    <div class='bottom_part'></div>
                    <div class='bottom_hole'><!-- lol --></div>
                </div>
                <p style="font-weight: bolder; font-size: x-large" class="text-center text-black">loading</p>
            </div>
        </div>
    </div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="content mt-2">
            <div class="container-fluid">
                {{-- Row 2 --}}
                {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-success">
                                <h3 class="card-title text-center">Input Tahun Ajaran Baru</h3>
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent="$emit('triggerStore', '1')" class="w-full max-w-lg">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                                Semester
                                            </label>
                                            <div class="relative">
                                                <select wire:model="semester" class="block appearance-none w-full bg-cool-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="semester">
                                                    <option>Pilih Salah Satu</option>
                                                    <option value="Ganjil">Ganjil</option>
                                                    <option value="Genap">Genap</option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                                </div>
                                            </div>
                                            @error('semester')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                                Tahun 1
                                            </label>
                                            <input wire:model="tahun1" class="appearance-none block w-full bg-cool-gray-50 text-gray-700 border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="contoh: 2020">
                                            @error('tahun1')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror
                                            <div wire:loading wire:target="tahun1">
                                                Loading...
                                            </div>
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                                Tahun 2
                                            </label>
                                            <input wire:model="tahun2" class="appearance-none block w-full bg-cool-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="contoh: 2021">
                                            @error('tahun2')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror
                                            <div wire:loading wire:target="tahun2">
                                                Loading...
                                            </div>
                                        </div>
                                        <div class="w-full px-3 text-right py-4">
                                            <button type="submit" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" >Tambah</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-danger">
                                <h3 class="card-title text-center">Pengaturan Tahun Ajaran Baru</h3>
                            </div>
                        </div>
                        <div class="my-2 flex sm:flex-row flex-col">
                            <div class="flex flex-row mb-1 sm:mb-0">
                                <div class="relative">
                                    <select wire:model="perPage"
                                        class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>25</option>
                                        <option>50</option>
                                        <option>100</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="block relative">
                                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                        <path
                                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                        </path>
                                    </svg>
                                </span>
                                <input placeholder="Search" wire:model.debounce.500ms="searchTerm"
                                    class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                            </div>
                        </div>
                        <div class="flex mb-2 mt-1 md:mt-0 flex-end ml-1">
                            <button wire:click="createShowModal" class="bg-blue-400 text-white hover:bg-blue-300 m-1 p-2 font-bold text-sm
                                focus:outline-none rounded-lg uppercase transition duration-150 ease-in-out" type="button">
                                {{ __('Mulai Tahun Ajaran Baru') }}
                            </button>
                        </div>
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                <table class="min-w-full leading-normal">
                                    <thead class=" bg-pink-300 text-center">
                                        <tr>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                                style="cursor: pointer" wire:click="sorting('code')">
                                                KODE
                                                @include('partials._sort-icon',['field'=>'code'])
                                            </th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                                style="cursor: pointer" wire:click="sorting('semester')">
                                                SEMESTER
                                                @include('partials._sort-icon',['field'=>'semester'])
                                            </th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                                style="cursor: pointer" wire:click="sorting('tahun1')">
                                                TAHUN AKADEMIK
                                                @include('partials._sort-icon',['field'=>'tahun1'])
                                            </th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                                style="cursor: pointer" wire:click="sorting('status')">
                                                STATUS
                                                @include('partials._sort-icon',['field'=>'status'])
                                            </th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                                >
                                                AKSI
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($data))
                                            @foreach ($data as $item =>$v)
                                                <tr class="text-center">
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ $v["code"] }}
                                                        </p>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-gray-50 text-sm">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ $v["semester"] }}
                                                        </p>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ $v["tahun1"] }} / {{ $v["tahun2"] }}
                                                        </p>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-gray-50 text-sm">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            <div class="mt-2 right-2">
                                                                @if ($v["status"] == '1')
                                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                        <label class="btn btn-success active">
                                                                            <input wire:click="aktif({{$v["id"]}})" type="radio" name="status{{$v["id"]}}" checked> Aktif
                                                                        </label>
                                                                        <label class="btn btn-secondary">
                                                                            <input wire:click="nonaktif({{$v["id"]}})" type="radio" name="status{{$v["id"]}}"> Non Aktif
                                                                        </label>
                                                                    </div>
                                                                    {{-- <button type="button" class="rounded-full px-4 mr-2 bg-green-400 text-white p-2 rounded  leading-none flex items-center">
                                                                        Aktif
                                                                    </button> --}}
                                                                @else
                                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                        <label class="btn btn-secondary">
                                                                            <input wire:click="aktif({{$v["id"]}})" type="radio" name="status{{$v["id"]}}"> Aktif
                                                                        </label>
                                                                        <label class="btn btn-danger active">
                                                                            <input wire:click="nonaktif({{$v["id"]}})" type="radio" name="status{{$v["id"]}}" checked> Non Aktif
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </p>
                                                    </td>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        <button class="btn btn-danger btn-link" wire:click="$emit('triggerDestroy', '{{Crypt::encryptString($v["id"])}}')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                                    <h6>Tidak Ada Data!</h6>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $data->links('vendor.pagination.simple-tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
                <x-jet-dialog-modal wire:model="modalDownloadKP">
                    <x-slot name="title">
                        {{ __('Download Data KP') }}
                    </x-slot>

                        <x-slot name="content">
                            <div class="flex flex-col sm:flex-row text-right">
                                <button wire:click="downloadrekapall" class="bg-blue-400 text-white hover:bg-blue-300 m-1 p-2 font-bold text-sm
                                    focus:outline-none rounded-lg uppercase transition duration-150 ease-in-out" type="button">
                                    Download Rekap Nilai
                                </button>
                                <button wire:click="exportBimbing" class="bg-blue-400 text-white hover:bg-blue-300 m-1 p-2 font-bold text-sm
                                    focus:outline-none rounded-lg uppercase transition duration-150 ease-in-out" type="button">
                                    Download Rekap Bimbingan
                                </button>
                                <button wire:click="exportEwmp" class="bg-purple-400 text-white hover:bg-purple-300 m-1 p-2 font-bold text-sm
                                    focus:outline-none rounded-lg uppercase transition duration-150 ease-in-out" type="button">
                                    Download EWMP
                                </button>
                                <button wire:click="exportHonor" class="bg-red-400 text-white hover:bg-red-300 m-1 p-2 font-bold text-sm
                                    focus:outline-none rounded-lg uppercase transition duration-150 ease-in-out" type="button">
                                    Download Rekap Honor
                                </button>
                            </div>
                        </x-slot>

                        <x-slot name="footer">
                            <div class="w-full px-3 text-right py-4">
                                <x-jet-secondary-button wire:click="$toggle('modalDownloadKP')" wire:loading.attr="disabled">
                                    {{ __('Tutup') }}
                                </x-jet-secondary-button>
                            </div>
                        </x-slot>

                </x-jet-dialog-modal>
                <x-jet-dialog-modal wire:model="modalDownloadTA">
                    <x-slot name="title">
                        {{ __('Download Data TA') }}
                    </x-slot>

                        <x-slot name="content">
                            {{-- <div class="flex flex-col sm:flex-row text-right">
                                <button wire:click="downloadrekapall" class="bg-blue-400 text-white hover:bg-blue-300 m-1 p-2 font-bold text-sm
                                    focus:outline-none rounded-lg uppercase transition duration-150 ease-in-out" type="button">
                                    Download Rekap Nilai
                                </button>
                                <button wire:click="exportBimbing" class="bg-blue-400 text-white hover:bg-blue-300 m-1 p-2 font-bold text-sm
                                    focus:outline-none rounded-lg uppercase transition duration-150 ease-in-out" type="button">
                                    Download Rekap Bimbingan
                                </button>
                                <button wire:click="exportEwmp" class="bg-purple-400 text-white hover:bg-purple-300 m-1 p-2 font-bold text-sm
                                    focus:outline-none rounded-lg uppercase transition duration-150 ease-in-out" type="button">
                                    Download EWMP
                                </button>
                                <button wire:click="exportHonor" class="bg-red-400 text-white hover:bg-red-300 m-1 p-2 font-bold text-sm
                                    focus:outline-none rounded-lg uppercase transition duration-150 ease-in-out" type="button">
                                    Download Rekap Honor
                                </button>
                            </div> --}}
                        </x-slot>

                        <x-slot name="footer">
                            <div class="w-full px-3 text-right py-4">
                                <x-jet-secondary-button wire:click="$toggle('modalDownloadTA')" wire:loading.attr="disabled">
                                    {{ __('Tutup') }}
                                </x-jet-secondary-button>
                            </div>
                        </x-slot>

                </x-jet-dialog-modal>
                <x-jet-dialog-modal wire:model="modalFormVisible">
                    <x-slot name="title">
                        {{ __('Tahun Ajaran Baru') }}
                    </x-slot>

                    {{-- <form wire:submit.prevent="$emit('triggerStore', '1')" class="w-full max-w-lg"> --}}
                        <x-slot name="content">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                            Semester
                                        </label>
                                        <div class="relative">
                                            <select wire:model="semester" class="block appearance-none w-full bg-cool-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="semester">
                                                <option>Pilih Salah Satu</option>
                                                <option value="Ganjil">Ganjil</option>
                                                <option value="Genap">Genap</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                            </div>
                                        </div>
                                        @error('semester')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            Tahun 1
                                        </label>
                                        <input wire:model="tahun1" class="appearance-none block w-full bg-cool-gray-50 text-gray-700 border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="contoh: 2020">
                                        @error('tahun1')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                        <div wire:loading wire:target="tahun1">
                                            Loading...
                                        </div>
                                    </div>
                                    <div class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                            Tahun 2
                                        </label>
                                        <input wire:model="tahun2" class="appearance-none block w-full bg-cool-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="contoh: 2021">
                                        @error('tahun2')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                        <div wire:loading wire:target="tahun2">
                                            Loading...
                                        </div>
                                    </div>
                                </div>
                        </x-slot>

                        <x-slot name="footer">
                            <div class="w-full px-3 text-right py-4">
                                <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                                    {{ __('Batal') }}
                                </x-jet-secondary-button>

                                <button type="button" wire:loading.attr="disabled" wire:click="$emit('triggerStore', '1')"
                                    class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" >Tambah</button>
                            </div>
                        </x-slot>
                    {{-- </form> --}}
                </x-jet-dialog-modal>
            </div>
        </div>
    </div>
</div>

</div>
@push('scripts')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function(){
            @this.on('triggerStore', id => {
                Swal.fire({
                    title: "Tahun Ajaran Sebelumnya Akan Di Nonaktifkan",
                    text: "Pastikan Seluruh Proses KP atau TA telah selesai, karena akan berpengaruh pada proses yang masih berjalan",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: 'var(--danger)',
                    cancelButtonColor: 'var(--primary)',
                    confirmButtonText: 'Tambah'
                }).then((result) => {
                    if(result.value) {
                        @this.call('store')
                    }else{
                        Swal.fire({
                            title: 'Batal Menambah',
                            icon: 'error'
                        });
                    }
                });
            });
        })
        document.addEventListener('DOMContentLoaded', function(){
            @this.on('triggerDestroy', id => {
                Swal.fire({
                    title: "Sebelum Menghapus Silahkan Download Seluruh Data KP dan TA",
                    text: "Seluruh Data Pada Tahun Ajaran ini Akan Dihapus",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: 'var(--danger)',
                    cancelButtonColor: 'var(--primary)',
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if(result.value) {
                        Swal.fire({
                            title: "Anda Telah Mendownload Seluruh Data?",
                            text: "Yakin Tetap Menghapus?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: 'var(--danger)',
                            cancelButtonColor: 'var(--primary)',
                            confirmButtonText: 'Hapus'
                        }).then((result) => {
                            if(result.value) {
                                @this.call('destroy', id)
                            }else{
                                Swal.fire({
                                    title: 'Batal Dihapus',
                                    icon: 'error'
                                });
                            }
                        });
                    }else{
                        Swal.fire({
                            title: 'Batal Dihapus',
                            icon: 'error'
                        });
                    }
                });
            });
        })
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            @this.on('triggerStore', id => {
                swal({
                    title: "Tahun Ajaran Sebelumnya Akan Di Nonaktifkan",
                    text: "Pastikan Seluruh Proses KP atau TA telah selesai, karena akan berpengaruh pada proses yang masih berjalan",
                    icon: "warning",
                    buttons: {
                        hapus: {
                            text: "Batal",
                            value: "hapus",
                        },
                        confirm: {
                            text: "Tambah",
                            value: "confirm",
                        },
                        // cancel: "Batal",
                    },
                })
                .then((value) => {
                    switch (value) {

                        case "hapus":
                        swal({
                            title: "Aksi Dibatalkan",
                            icon: "error",
                        });
                        break;

                        case "confirm":
                        @this.call('store')
                        break;

                        default:
                        swal({
                            title: "Aksi Dibatalkan",
                            icon: "error",
                        });
                    }
                });
            });
        })
        document.addEventListener('DOMContentLoaded', function(){
            @this.on('triggerDestroy', id => {
                swal({
                    title: "Sebelum Menghapus Silahkan Download Seluruh Data KP dan TA",
                    text: "Seluruh Data Pada Tahun Ajaran ini Akan Dihapus",
                    icon: "warning",
                    buttons: {
                        hapus: {
                            text: "Hapus",
                            value: "hapus",
                        },
                        kp: {
                            text: "Download Data KP",
                            value: "kp",
                        },
                        ta: {
                            text: "Download Data TA",
                            value: "ta",
                        },
                        // cancel: "Batal",
                    },
                })
                .then((value) => {
                    switch (value) {

                        case "hapus":
                        @this.call('destroy', id);
                        break;

                        case "kp":
                        @this.call('showModalKP');
                        break;

                        case "ta":
                        @this.call('showModalTA');
                        break;

                        default:
                        swal({
                            title: "Aksi Dibatalkan",
                            icon: "error",
                        });
                    }
                });
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('body').addClass('loaded');
            }, 300);
        });
    </script>
@endpush
