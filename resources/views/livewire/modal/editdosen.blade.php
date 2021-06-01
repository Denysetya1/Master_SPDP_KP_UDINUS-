<div class="modal fade show" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="padding-right: 17px; display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Dosen</h5>
                <button wire:click="hideModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update" class="w-full">
                    <input wire:model="dosenid" name="dosenid" class="appearance-none block w-full bg-cool-gray-50 text-gray-700 border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                type="hidden" readonly>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nip">
                                NIP
                            </label>
                            <input wire:model="nip" name="nip" class="appearance-none block w-full bg-cool-gray-50 text-gray-700 border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                type="text" readonly>
                            @error('nip')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nama
                            </label>
                            <input wire:model="name" name="name" class="appearance-none block w-full bg-cool-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                            @error('name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                Jabfa
                            </label>
                            <input wire:model="jabfa" name="jabfa" class="appearance-none block w-full bg-cool-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                            @error('jabfa')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                Level
                            </label>
                            <div class="relative">
                                <select wire:model="level" name="level" class="block appearance-none w-full bg-cool-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="semester">
                                    <option>Pilih Salah Satu</option>
                                    <option value="Pemula">Pemula</option>
                                    <option value="Madya">Madya</option>
                                    <option value="Khusus">Khusus</option>
                                    <option value="Utama">Utama</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                            @error('level')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full px-3 text-right py-4">
                        <button type="submit" class="shadow bg-green-400 hover:bg-green-300 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" >Update</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
