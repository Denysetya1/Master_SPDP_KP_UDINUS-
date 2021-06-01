<div>
    <div wire:loading wire:target="store, destroy, aktif, nonaktif, import, createShowModal, searchTerm, perPage, sorting">
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
    @if (session()->has('success'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="content mt-2">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="content mt-2">
                <div class="container-fluid">
                    {{-- Row 1 --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-info">
                                    <h3 class="card-title text-center">Koordinator KP</h3>
                                </div>
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-12 text-right mb-3">
                                        <button class="shadow bg-indigo-500 hover:bg-indigo-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                        wire:click="createShowModal">
                                            {{ __('Input Data') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right mb-3">
                                        <input class="w-full text-sm transition border border-transparent focus:outline-none focus:border-gray-700 rounded py-1 px-2 pl-10 appearance-none leading-normal"
                                        wire:model.debounce.500ms="searchTerm" type="text" placeholder="Search..."/>
                                        <div class="absolute search-icon" style="top: .5rem; right: 1.4rem;">
                                            <svg class="fill-current pointer-events-none text-black w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 text-right mb-3">
                                        <div class="flex flex-row relative w-20">
                                            <select wire:model="perPage" class="block appearance-none bg-cool-gray-50 border border-gray-400
                                                hover:border-gray-500 px-4 py-2 pr-8 rounded shadow-md leading-tight focus:outline-none focus:shadow-outline text-black">
                                                <option>5</option>
                                                <option>10</option>
                                                <option>25</option>
                                                <option>50</option>
                                                <option>100</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-1 flex items-center text-gray-700">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive-sm">
                                    <table class="table table table-hover table-bordered">
                                        <thead class="table-primary text-center">
                                            <th style="font-weight: bolder; cursor: pointer" wire:click="sorting('nip')">
                                                NPP
                                                @include('partials._sort-icon',['field'=>'nip'])
                                            </th>
                                            <th style="font-weight: bolder; cursor: pointer" wire:click="sorting('name')">
                                                Nama
                                                @include('partials._sort-icon',['field'=>'name'])
                                            </th>
                                            <th style="font-weight: bolder; cursor: pointer" wire:click="sorting('jabfa')">
                                                Email
                                                @include('partials._sort-icon',['field'=>'jabfa'])
                                            </th>
                                            <th style="font-weight: bolder; cursor: pointer" wire:click="sorting('level')">
                                                Status
                                                @include('partials._sort-icon',['field'=>'level'])
                                            </th>
                                            <th style="font-weight: bolder;">AKSI</th>
                                        </thead>
                                        <tbody>
                                            @if (count($data))
                                                @foreach ($data as $item =>$v)
                                                    <tr class="text-center">
                                                        <td class="text-center">
                                                            {{ $v["nip"] }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $v["name"] }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $v["email"] }}
                                                        </td>
                                                        <td class=" font-bold text-center">
                                                            <div class="mt-2 right-2">
                                                                @if ($v["status"] == '1')
                                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                        <label class="btn btn-secondary active">
                                                                            <input wire:click="aktif({{$v["id"]}})" type="radio" name="status{{$v["id"]}}" checked> Aktif
                                                                        </label>
                                                                        <label class="btn btn-secondary">
                                                                            <input wire:click="nonaktif({{$v["id"]}})" type="radio" name="status{{$v["id"]}}"> Non Aktif
                                                                        </label>
                                                                    </div>
                                                                @else
                                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                        <label class="btn btn-secondary">
                                                                            <input wire:click="aktif({{$v["id"]}})" type="radio" name="status{{$v["id"]}}"> Aktif
                                                                        </label>
                                                                        <label class="btn btn-secondary active">
                                                                            <input wire:click="nonaktif({{$v["id"]}})" type="radio" name="status{{$v["id"]}}" checked> Non Aktif
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class=" text-center">
                                                            <button class="btn btn-danger btn-link" wire:click="$emit('triggerDestroy', {{$v["id"]}})">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr><td colspan="5" class=" bg-gray-100 text-center"><h4>Tidak Ada Data!</h4></td></tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-jet-dialog-modal wire:model="modalFormVisible">
                        <x-slot name="title">
                            {{ __('Tambah Koordinator KP') }}
                        </x-slot>

                        {{-- <form wire:submit.prevent="$emit('triggerStore', '1')" class="w-full max-w-lg"> --}}
                            <x-slot name="content">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                            NPP
                                        </label>
                                        <input wire:model="nip" class="appearance-none block w-full bg-cool-gray-50 text-gray-700 border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" type="text">
                                        @error('nip')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                        <div wire:loading wire:target="nip">
                                            Loading...
                                        </div>
                                    </div>
                                    <div class="w-full px-3 mt-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                            Email
                                        </label>
                                        <input wire:model="email" class="appearance-none block w-full bg-cool-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="email">
                                        @error('email')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                        <div wire:loading wire:target="email">
                                            Loading...
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                            Nama
                                        </label>
                                        <input wire:model="name" class="appearance-none block w-full bg-cool-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                                        @error('name')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                        <div wire:loading wire:target="name">
                                            Loading...
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            Password Default nya
                                        </button>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="w-full px-3">
                                            <div class="card card-body">
                                                dinuskp123
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-slot>

                            <x-slot name="footer">
                                <div class="w-full px-3 text-right py-4">
                                    <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                                        {{ __('Batal') }}
                                    </x-jet-secondary-button>

                                    <button type="button" wire:loading.attr="disabled" wire:click="store"
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    @include('sweetalert::alert')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            @this.on('triggerDestroy', id => {
                Swal.fire({
                    title: "Lanjut Menghapus?",
                    text: "Koordinator Akan Dihapus Permanent",
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
    <script>
        window.addEventListener('swal',function(e){
            Swal.fire(e.detail);
        });
    </script>
@endpush
