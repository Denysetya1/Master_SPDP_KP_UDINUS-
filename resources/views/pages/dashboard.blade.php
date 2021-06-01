<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div wire:loading wire:target="store, destroy, aktifta, nonaktifta, aktifkp, nonaktifkp, import">
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
                    <div class="row">
                        {{-- Row 1 --}}
                        <div class="col-12 col-md-12">
                            <div class="card">
                                <div class="card-header card-header-success">
                                    <h3 class="card-title text-center">SELAMAT DATANG</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card card-stats shadow">
                                <div class="card-header card-header-warning card-header-icon">
                                    <div class="card-icon shadow-inner">
                                        <i class="material-icons">date_range</i>
                                    </div>
                                    <h3 class="card-category">Tahun Akademik</h3>
                                    <h3 class="card-title">
                                        {{ DB::table('tahunajarans')->where('status', '=', 1)->value('semester') }}&MediumSpace;
                                        {{ DB::table('tahunajarans')->where('status', '=', 1)->value('tahun1') }}/{{ DB::table('tahunajarans')->where('status', '=', 1)->value('tahun2') }}
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                      <i class="material-icons">assignment_turned_in</i> Aktif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  @include('sweetalert::alert')
</x-app-layout>
