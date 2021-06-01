<?php

namespace App\Http\Livewire;

use App\Mail\KoorkpMail;
use App\Models\Koorkp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Koorkpdata extends Component
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
        $data   = Koorkp::where(function ($query) {
            if($this->searchTerm != "") {
                $query->where('nip', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('name', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('email', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate($this->perPage);
        return view('livewire.koorkp', [
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
            'nip'       => ['required', 'unique:koorkps'],
            'name'      => 'required|min:3',
            'email'     => 'required|email|unique:koorkps',
        ],
        [
            'nip.required'      => 'Tolong Isi NPP',
            'nip.unique'        => 'NPP sudah digunakan',
            'name.required'     => 'Tolong Isi Nama Lengkap',
            'name.min'          => 'Minimal 3 Karakter',
            'email.required'    => 'Tolong Isi Email',
            'email.email'       => 'Tolong Isi dengan format email',
        ]);

        Koorkp::create([
            'nip'       => $this->nip,
            'name'      => $this->name,
            'email'     => $this->email,
            'password'  => Hash::make('dinuskp123'),
            'status'    => 1,
        ]);

        $details = $this->email;
        $this->modalFormVisible = false;
        Mail::to($details)->send(new KoorkpMail($details));
        // Mereset Form
        $this->nip = "";
        $this->name = "";
        $this->email = "";
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Koordinator Berhasil Ditambahkan',
            'timer' => 3000,
            'icon'  => 'success'
        ]);
    }

    public function nonaktif($id)
    {
        if ($id){
            $data = Koorkp::find($id);
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
            $data = Koorkp::find($id);
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
            $data = Koorkp::find($id);
            $data->delete();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Koordinator Berhasil Dihapus',
                'timer'=>3000,
                'icon'=>'success'
            ]);
        }
    }
}
