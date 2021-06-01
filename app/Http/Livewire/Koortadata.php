<?php

namespace App\Http\Livewire;

use App\Mail\KoortaMail;
use App\Models\Koortah;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Koortadata extends Component
{
    use WithPagination;
    public $nip, $name, $email;
    public $searchTerm;
    public $modalFormVisible;
    public $perPage = 5;
    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $isOpen  = 0;

    public function render()
    {
        $data   = Koortah::where(function ($query) {
            if($this->searchTerm != "") {
                $query->where('nip', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('name', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('email', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate($this->perPage);
        return view('livewire.koortadata', [
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

    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function store()
    {
        $this->validate([
            'nip'       => ['required', 'unique:koortahs'],
            'name'      => 'required|min:3',
            'email'     => 'required|email|unique:koortahs',
        ],
        [
            'nip.required'      => 'Tolong Isi NPP',
            'nip.unique'        => 'NPP sudah digunakan',
            'name.required'     => 'Tolong Isi Nama Lengkap',
            'name.min'          => 'Minimal 3 Karakter',
            'email.required'    => 'Tolong Isi Email',
            'email.email'       => 'Tolong Isi dengan format email',
        ]);

        Koortah::create([
            'nip'       => $this->nip,
            'name'      => $this->name,
            'email'     => $this->email,
            'password'  => Hash::make('dinusta123'),
            'status'    => 1,
        ]);

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Koordinator Berhasil Ditambahkan',
            'timer'=>3000,
            'icon'=>'success'
        ]);
        $details = $this->email;
        $this->modalFormVisible = false;
        Mail::to($details)->send(new KoortaMail($details));
        // Mereset Form
        $this->nip = "";
        $this->name = "";
        $this->email = "";
    }

    public function nonaktif($id)
    {
        if ($id){
            $data = Koortah::find($id);
            $data->status = 0;
            $data->save();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Berhasil Diubah',
                'timer'=>3000,
                'icon'=>'success'
            ]);
        }
    }

    public function aktif($id)
    {
        if ($id){
            $data = Koortah::find($id);
            $data->status = 1;
            $data->save();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Berhasil Diubah',
                'timer'=>3000,
                'icon'=>'success'
            ]);
        }
    }

    public function destroy($id)
    {
        if ($id){
            $data = Koortah::find($id);
            $data->delete();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Koordinator Berhasil Dihapus',
                'timer'=>3000,
                'icon'=>'success'
            ]);
        }
    }
}
