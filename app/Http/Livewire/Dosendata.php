<?php

namespace App\Http\Livewire;

use App\Imports\DosensImport;
use App\Models\Dosen as ModelsDosen;
use App\Models\Kpdosbim as ModelsKpdosbim;
use App\Models\Tadosbim as ModelsTadosbim;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Dosendata extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $dosenid, $nip, $name, $jabfa, $level, $ta, $kp, $file;
    public $searchTerm;
    public $modalFormVisible;
    public $perPage = 5;
    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $isOpen  = 0;

    public function render()
    {
        $data   = ModelsDosen::where(function ($query) {
            if($this->searchTerm != "") {
                $query->where('nip', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('name', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('jabfa', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('level', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate($this->perPage);
        return view('livewire.dosendata', [
            'data' => $data
        ]);
    }

    public function sorting($column)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumn = $column;
    }

    public function showModal()
    {
        $this->isOpen = true;
    }

    public function hideModal()
    {
        $this->isOpen = false;
    }

    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function store()
    {
        $this->validate([
            'nip'       => ['required', 'unique:dosens'],
            'name'      => 'required|min:3',
            'jabfa'     => 'required',
            'level'     => 'required',
        ],
        [
            'nip.required'      => 'Tolong Isi NPP',
            'nip.unique'        => 'Data tidak bisa double',
            'name.required'     => 'Tolong Isi Nama Lengkap',
            'name.min'          => 'Minimal 3 Karakter',
            'jabfa.required'    => 'Tolong Isi Jabfa',
            'level.required'    => 'Tolong Isi Level',
        ]);

        if (($this->ta == 1) && ($this->kp == 1)) {
            ModelsDosen::create([
                'nip'   => $this->nip,
                'name'  => $this->name,
                'jabfa' => $this->jabfa,
                'level' => $this->level,
                'ta'    => 1,
                'kp'    => 1,
            ]);
            ModelsKpdosbim::create([
                'nip'           => $this->nip,
                'name'          => $this->name,
                'kuota'         => 0,
                'jml_terima'    => 0,
                'status'        => 1,
            ]);
            ModelsTadosbim::create([
                'nip'           => $this->nip,
                'name'          => $this->name,
                'kuota'         => 0,
                'jml_terima'    => 0,
                'status'        => 1,
            ]);
        } elseif (($this->ta == 1)) {
            ModelsDosen::create([
                'nip'   => $this->nip,
                'name'  => $this->name,
                'jabfa' => $this->jabfa,
                'level' => $this->level,
                'ta'    => 1,
                'kp'    => 0,
            ]);
            ModelsTadosbim::create([
                'nip'           => $this->nip,
                'name'          => $this->name,
                'kuota'         => 0,
                'jml_terima'    => 0,
                'status'        => 1,
            ]);
        } elseif (($this->kp == 1)) {
            ModelsDosen::create([
                'nip'   => $this->nip,
                'name'  => $this->name,
                'jabfa' => $this->jabfa,
                'level' => $this->level,
                'ta'    => 0,
                'kp'    => 1,
            ]);
            ModelsKpdosbim::create([
                'nip'           => $this->nip,
                'name'          => $this->name,
                'kuota'         => 0,
                'jml_terima'    => 0,
                'status'        => 1,
            ]);
        } else {
            ModelsDosen::create([
                'nip'   => $this->nip,
                'name'  => $this->name,
                'jabfa' => $this->jabfa,
                'level' => $this->level,
                'ta'    => 0,
                'kp'    => 0,
            ]);
        }

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Dosen Berhasil Ditambahkan',
            'timer'=>3000,
            'icon'=>'success'
        ]);

        // Mereset Form
        $this->nip = "";
        $this->name = "";
        $this->jabfa = "";
        $this->level = "";
        $this->ta = "";
        $this->kp = "";
    }

    public function import(){
        $this->validate([
            'file'  => 'mimes:xlsx, xls, xlm, xla, xlc, xlt, xlw, xlsb, xlsm'
        ],
        [
            'file.mimes' => 'Hanya bisa file excel(.xlsx/.xls/.xlsb/.xlsm/.xlm/.xla/.xlc',
        ]);
        Excel::import(new DosensImport, $this->file);
        $this->file = "";
        $this->emit('fileimported');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Data Berhasil Diimport',
            'timer' => 3000,
            'icon'  => 'success'
        ]);
    }

    public function edit($id)
    {
        $dosen = ModelsDosen::findOrFail($id);
        $this->dosenid    = $dosen->id;
        $this->nip        = $dosen->nip;
        $this->name       = $dosen->name;
        $this->jabfa      = $dosen->jabfa;
        $this->level      = $dosen->level;

        $this->showModal();
    }

    public function update()
    {
        $this->validate([
            'name'      => 'required|min:3',
            'jabfa'     => 'required',
            'level'     => 'required',
        ],
        [
            'name.required'     => 'Tolong Isi Nama Lengkap',
            'name.min'          => 'Minimal 3 Karakter',
            'jabfa.required'    => 'Tolong Isi Jabfa',
            'level.required'    => 'Tolong Isi Level',
        ]);

        ModelsDosen::updateOrCreate(['id' => $this->dosenid], [
            'name'   => $this->name,
            'jabfa'  => $this->jabfa,
            'level'  => $this->level,
        ]);

        $this->hideModal();
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Data Berhasil Di Update',
            'timer'=>3000,
            'icon'=>'success'
        ]);
        $this->dosenid  = "";
        $this->nip      = "";
        $this->name     = "";
        $this->jabfa    = "";
        $this->level    = "";
    }

    public function nonaktifta($id) {
        if ($id){
            $data = ModelsDosen::find($id);
            $data->ta = 0;
            $data->save();
            $nip = ModelsDosen::where('id', $id)->select('nip')->pluck('nip')->first();
            $dsn = ModelsTadosbim::where('nip', '=', $nip)->first();
            if ($dsn){
                $dsn->delete();
            }
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Berhasil di Nonaktifkan dari TA',
                'timer' => 3000,
                'icon'  => 'success'
            ]);
        }
    }

    public function aktifta($id) {
        if ($id){
            $data = ModelsDosen::find($id);
            $data->ta = 1;
            $data->save();
            $nip = ModelsDosen::where('id', $id)->select('nip')->pluck('nip')->first();
            $dsn = ModelsDosen::where('nip', '=', $nip)->select('name')->pluck('name')->first();
            $cek = ModelsTadosbim::where('nip', '=', $nip)->first();
            if (!$cek) {
                ModelsTadosbim::create([
                    'nip'           => $nip,
                    'name'          => $dsn,
                    'kuota'         => 0,
                    'jml_terima'    => 0,
                    'status'        => 1,
                ]);
            }
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Berhasil di Aktifkan pada TA',
                'timer' => 3000,
                'icon'  => 'success'
            ]);
        }
    }

    public function nonaktifkp($id) {
        if ($id){
            $data = ModelsDosen::find($id);
            $data->kp = 0;
            $data->save();
            $nip = ModelsDosen::where('id', $id)->select('nip')->pluck('nip')->first();
            $dsn = ModelsKpdosbim::where('nip', '=', $nip)->first();
            if ($dsn){
                $dsn->delete();
            }
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Berhasil di Nonaktifkan dari KP',
                'timer'=>3000,
                'icon'=>'success'
            ]);
        }
    }

    public function aktifkp($id) {
        if ($id){
            $data = ModelsDosen::find($id);
            $data->kp = 1;
            $data->save();
            $nip = ModelsDosen::where('id', $id)->select('nip')->pluck('nip')->first();
            $dsn = ModelsDosen::where('nip', '=', $nip)->select('name')->pluck('name')->first();
            $cek = ModelsKpdosbim::where('nip', '=', $nip)->first();
            if (!$cek) {
                ModelsKpdosbim::create([
                    'nip'           => $nip,
                    'name'          => $dsn,
                    'kuota'         => 0,
                    'jml_terima'    => 0,
                    'sisa'          => 0,
                    'status'        => 1,
                ]);
            }
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Berhasil di Aktifkan pada KP',
                'timer'=>3000,
                'icon'=>'success'
            ]);
        }
    }

    public function destroy($id)
    {
        if ($id){
            $data = ModelsDosen::find($id);
            $data->delete();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Dosen Berhasil Dihapus',
                'timer'=>3000,
                'icon'=>'success'
            ]);
        }
    }
}
