<?php

namespace App\Http\Livewire;

use App\Exports\EwmpExport;
use App\Exports\KpmhsExport;
use App\Exports\RekaphonorsExport;
use App\Models\Kpdosbim;
use App\Models\Kpdsn;
use App\Models\Tahunajaran as ModelsTahunajaran;
use App\Models\Kuotakptotal;
use App\Models\Kuotatatotal;
use App\Models\Mhskp;
use App\Models\Nilaikpset;
use App\Models\Penilaiankp;
use App\Models\Settingkp;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Tahunajaran extends Component
{
    use WithPagination;
    public $semester, $tahun1, $tahun2, $non;
    public $searchTerm;
    public $modalFormVisible;
    public $modalDownloadKP;
    public $modalDownloadTA;
    public $perPage = 5;
    public $sortColumn = 'created_at';
    public $sortDirection = 'desc';

    public function render()
    {
        $data   = ModelsTahunajaran::where(function ($query) {
            if($this->searchTerm != "") {
                $query->where('code', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('semester', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('tahun1', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('tahun2', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate($this->perPage);
        return view('livewire.tahunajaran', [
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

    public function showModalKP()
    {
        $this->modalDownloadKP = true;
    }

    public function showModalTA()
    {
        $this->modalDownloadTA = true;
    }

    public function store()
    {
        $this->validate([
            'semester'  => 'required',
            'tahun1'    => 'required|numeric',
            'tahun2'    => 'required|numeric',
        ],
        [
            'semester.required'  => 'Tolong Pilih Salah Satu',
            'tahun1.required'    => 'Tolong Isi Tahun',
            'tahun1.numeric'     => 'Tolong Isi Menggunakan Angka',
            'tahun2.required'    => 'Tolong Isi Tahun',
            'tahun2.numeric'     => 'Tolong Isi Menggunakan Angka',
        ]);

        if ($this->semester == 'Ganjil') {
            $code   = $this->tahun1.'-1';
        } else{
            $code   = $this->tahun1.'-2';
        }

        //Menghapus tahun ajaran sebelumnya
        // $findId = ModelsTahunajaran::where('status', '=', 1)->select('id')->pluck('id')->first();
        // if ($findId) {
        //     $ubah   = ModelsTahunajaran::find($findId);
        //     $ubah->delete();
        //     $kuota = Kpdosbim::where('status', '=', 1)->first();
        //     if ($kuota) {
        //         if(($kuota->count()) > 1){
        //             foreach ($$kuota as $key => $value) {
        //                 $value->kuota = 0;
        //                 $value->jml_terima = 0;
        //                 $value->jml_ajuan = 0;
        //                 $value->sisa = 0;
        //                 $value->save();
        //             }
        //         }
        //     }
        // }

        // Menonaktifkan Tahun Ajaran lama
        $cariId = ModelsTahunajaran::where('status', '=', 1)->get();
        if ($cariId) {
            foreach ($cariId as $cId) {
                $ubah   = ModelsTahunajaran::find($cId['id']);
                $ubah->status = 0;
                $ubah->save();
            }
        }

        $rule   = Settingkp::where('name', '=', 'Pengajuan Dosbim')->first();
        $rule->open      = null;
        $rule->close     = null;
        $rule->status    = 0;
        $rule->save();

        $rule2  = Settingkp::where('name', '=', 'Pendaftaran Sidang')->first();
        $rule2->batch     = 'Pertama';
        $rule2->open      = null;
        $rule2->close     = null;
        $rule2->status    = 0;
        $rule2->save();

        ModelsTahunajaran::create([
            'code'      => $code,
            'tahun1'    => $this->tahun1,
            'tahun2'    => $this->tahun2,
            'semester'  => $this->semester,
            'status'    => 1,
        ]);

        //Tambah Kuota KP
        Kuotakptotal::create([
            'tahun_code'    => $code,
            'total'         => 400,
            'jml_ajuan'     => 0,
        ]);

        //Tambah Kuota TA
        Kuotatatotal::create([
            'tahun_code'    => $code,
            'total'         => 400,
            'jml_ajuan'     => 0,
        ]);

        // Mereset Kuota Dosbim KP
        $kuotados = Kpdosbim::all();
        foreach ($kuotados as $kuotad) {
            $reset = Kpdosbim::where('nip', $kuotad['nip'])->first();
            $reset->jml_ajuan  = 0;
            $reset->jml_terima = 0;
            $reset->sisa       = $kuotad['kuota'];
            $reset->save();
        }

        $this->modalFormVisible = false;
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Berhasil Ditambahkan',
            'timer' => 3000,
            'icon'  => 'success'
        ]);

        // Mereset Form
        $this->semester = "Pilih Salah Satu";
        $this->tahun1 = "";
        $this->tahun2 = "";
    }

    public function nonaktif($id) {
        if ($id){
            $cek  = ModelsTahunajaran::count();
            if ($cek == 1) {
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'Tidak Bisa Menonaktifkan Satu satunya Tahun Ajaran, Tambahkan Tahun Ajaran Baru terlebih Dahulu',
                    'timer' => 5000,
                    'icon'  => 'error'
                ]);
            } else {
                $data = ModelsTahunajaran::find($id);
                $data->status = 0;
                $data->save();
                $kuota = Kpdosbim::where('status', '=', 1)->get();
                if ($kuota) {
                    if(($kuota->count()) > 1){
                        foreach ($kuota as $value) {
                            $value->jml_terima = 0;
                            $value->jml_ajuan  = 0;
                            $value->kuota = 0;
                            $value->sisa  = 0;
                            $value->save();
                        }
                    }
                }
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'Berhasil Diubah',
                    'timer'=>3000,
                    'icon'=>'success'
                ]);
            }
        }
    }

    public function aktif($id) {
        $cariId = ModelsTahunajaran::where('status', '=', 1)->select('id')->pluck('id')->first();
        if ($cariId) {
            $ubah   = ModelsTahunajaran::find($cariId);
            $ubah->status = 0;
            $ubah->save();
        }

        if ($id){
            $data = ModelsTahunajaran::find($id);
            $data->status = 1;
            $data->save();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Berhasil Diubah',
                'timer'=>3000,
                'icon'=>'success'
            ]);
        }
    }

    public function destroy($ids)
    {
        if ($ids){
            $id     = Crypt::decryptString($ids);
            $data   = ModelsTahunajaran::find($id);
            $kuota  = Kpdosbim::where('status', '=', 1)->get();
            // dd($kuota);
            if ($kuota) {
                if(($kuota->count()) > 1){
                    foreach ($kuota as $value) {
                        $value->jml_terima = 0;
                        $value->jml_ajuan  = 0;
                        $value->kuota = 0;
                        $value->sisa  = 0;
                        $value->save();
                    }
                }
            }
            $data->delete();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Berhasil Dihapus',
                'timer'=>3000,
                'icon'=>'success'
            ]);
        }
    }

    public function downloadrekapall()
    {
        $tahun    = ModelsTahunajaran::where('status', '=', 1)->first();
        $pros     = Nilaikpset::where('jenis', '=', 'Rekap')->first();
        $nilai    = Penilaiankp::where('tahun_code', $tahun['code'])->orderBy('nim')->get();
        $filename = 'Lembar Rekap Penilaian KP - Semester '.$tahun['semester'].' '.$tahun['tahun1'].'-'.$tahun['tahun2'].'';
        $template = new TemplateProcessor('dokumen/RekapAll.docx');
        $ix       = 1;
        $template->cloneRow('row', $nilai->count());
        for ($i=0; $i < $nilai->count(); $i++) {
            $cek_mhs  = Mhskp::get()->toArray();
            $cek_dsn  = Kpdsn::get()->toArray();
            for ($j=0; $j < count($cek_mhs); $j++) {
                if ($nilai[$i]['nim'] == $cek_mhs[$j]['nim']) {
                    // $name       = $cek_mhs[$j]['name'];
                    if (!$cek_mhs[$j]['judul'] && !$cek_mhs[$j]['instansi']) {
                        $judul      = 'Belum Menginputkan';
                        $instansi   = 'Belum Menginputkan';
                    }elseif (!$cek_mhs[$j]['judul']){
                        $judul      = 'Belum Menginputkan';
                        $instansi   = $cek_mhs[$j]['instansi'];
                    }elseif (!$cek_mhs[$j]['instansi']){
                        $judul      = $cek_mhs[$j]['judul'];
                        $instansi   = 'Belum Menginputkan';
                    }else {
                        $judul      = $cek_mhs[$j]['judul'];
                        $instansi   = $cek_mhs[$j]['instansi'];
                    }
                }
            }
            for ($k=0; $k < count($cek_dsn); $k++) {
                if ($cek_dsn[$k]['nip'] == $nilai[$i]['nip']) {
                    $namedsn    = $cek_dsn[$k]['name'];
                    $dosbim   = $cek_dsn[$k]['nip'].$cek_dsn[$k]['name'];
                    $awal     = substr($cek_dsn[$k]['nip'], -1);
                    $nama     = substr(Crypt::encryptString($cek_dsn[$k]['nip']), $awal, 10);
                    if (!$cek_dsn[$k]['ttd']) {
                        QrCode::format('png')->size(250)->style('round', 0.5)->eyeColor(0, 39, 159, 219, 244, 238, 53)->generate($dosbim, 'https://dosen.kptis1.dinus.web.id/'.$nama.'.png');
                        $update = Kpdsn::where('nip', '=', $cek_dsn[$k]['nip'])->first();
                        $update->ttd = 'images/'.$nama.'.png';
                        $update->save();
                        $ttd = 'images/'.$nama.'.png';
                    } else {
                        $ttd = $cek_dsn[$k]['ttd'];
                    }
                }
            }
            // Penyelia
            if (!$nilai[$i]['n_tot_penyelia']) {
                $npeny = 'Null';
                $hsl1  = '-';
            } else {
                $npeny = $nilai[$i]['n_tot_penyelia'];
                $hsl1  = $npeny / 100 * $pros['prosentase1'];
            }
            // Dosbim
            if (!$nilai[$i]['n_tot_dosbim']) {
                $ndos = 'Null';
                $hsl2 = '-';
            } else {
                $ndos = $nilai[$i]['n_tot_dosbim'];
                $hsl2 = $ndos / 100 * $pros['prosentase2'];
            }
            // Penguji
            if (!$nilai[$i]['n_tot_penguji']) {
                $npuji = 'Null';
                $hsl3  = '-';
            } else {
                $npuji = $nilai[$i]['n_tot_penguji'];
                $hsl3  = $npuji / 100 * $pros['prosentase3'];
            }
            // Total
            if (!$nilai[$i]['n_finish']) {
                $nsls  = '-';
                $con   = '-';
            } else {
                $nsls  = $nilai[$i]['n_finish'];
                if ($nilai[$i]['n_finish'] >= 85) {
                    $con = 'A';
                } elseif ($nilai[$i]['n_finish'] >= 80 && $nilai[$i]['n_finish'] < 85) {
                    $con = 'AB';
                } elseif ($nilai[$i]['n_finish'] >= 70 && $nilai[$i]['n_finish'] < 80) {
                    $con = 'B';
                } elseif ($nilai[$i]['n_finish'] >= 65 && $nilai[$i]['n_finish'] < 70) {
                    $con = 'BC';
                } elseif ($nilai[$i]['n_finish'] >= 60 && $nilai[$i]['n_finish'] < 65) {
                    $con = 'C';
                } elseif ($nilai[$i]['n_finish'] >= 60 && $nilai[$i]['n_finish'] < 65) {
                    $con = 'CD';
                } elseif ($nilai[$i]['n_finish'] >= 50 && $nilai[$i]['n_finish'] < 60) {
                    $con = 'BC';
                } else {
                    $con = 'E';
                }
            }


            $template->setValue('row#'.$ix, $i);
            $template->setValue('nim#'.$ix, $nilai[$i]['nim']);
            $template->setValue('mhs#'.$ix, $nilai[$i]['mahasiswa']);
            $template->setValue('jdl#'.$ix, $judul);
            $template->setValue('t4#'.$ix, $instansi);
            $template->setValue('n1#'.$ix, $npeny);
            $template->setValue('n2#'.$ix, $ndos);
            $template->setValue('n3#'.$ix, $npuji);
            $template->setValue('p1#'.$ix, $pros['prosentase1']);
            $template->setValue('p2#'.$ix, $pros['prosentase2']);
            $template->setValue('p3#'.$ix, $pros['prosentase3']);
            $template->setValue('h1#'.$ix, $hsl1);
            $template->setValue('h2#'.$ix, $hsl2);
            $template->setValue('h3#'.$ix, $hsl3);
            $template->setValue('total#'.$ix, $nsls);
            $template->setValue('hrf#'.$ix, $con);
            $template->setValue('tgl#'.$ix, $nilai[$i]['updated_at']->isoFormat('D MMMM Y'));
            $template->setValue('dsn#'.$ix, $namedsn);
            $template->setValue('nip#'.$ix, $nilai[$i]['nip']);
            $template->setImageValue('ttd#'.$ix,array('path' => public_path($ttd), 'width' => 120, 'height' => 120, 'ratio' => false));
            $ix = $ix + 1;
        }
        $template->saveAs($filename.'.docx');

        return response()->download($filename.'.docx')->deleteFileAfterSend(true);
    }
    public function exportBimbing() {
        return Excel::download(new KpmhsExport, 'Record Mahasiswa dan Dosbim KP.xlsx');
    }

    public function exportEwmp() {
        return Excel::download(new EwmpExport, 'Record EWMP KP.xlsx');
    }
    public function exportHonor()
    {
        return Excel::download(new RekaphonorsExport, 'Rekap Honor Penguji KP.xlsx');
    }
}
