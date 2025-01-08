<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Checklist;
use App\Models\Kendaraan;
use App\Models\Pemeriksaan;
use App\Models\InfoTambahan;
use Illuminate\Http\Request;
use App\Models\DigitalSignature;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DigitalSignatureController;


class PemeriksaanController extends Controller
{
    public function index()
    {
        return view('pemeriksaans.index');
    }
    public function create(Request $request)
    {
        $jenis = $request->query('jenis', 'utama');
        if($jenis == "nt"){
            $checklists = Checklist::jenisKendaraan('utama')->get();
        }else{
        $checklists = Checklist::jenisKendaraan($jenis)->get();
        }
        $petugas = Petugas::all();
        $petugas2 = Petugas::with('user')->where('user_id', '=', Auth::user()->id)->first();

        // $kendaraan = Kendaraan::all();
        if ($request->query('jenis') == 'utama') {
    $kendaraan = Kendaraan::where('jenis','utama')->get();
} elseif ($request->query('jenis') == 'nt') {
    $kendaraan = Kendaraan::where('jenis','khusus' )->get();
} else {
    $kendaraan = Kendaraan::where('jenis','pendukung' )->get();
}


        // dd($kendaraan);
        return view('pemeriksaans.create', compact('checklists', 'petugas', 'petugas2', 'jenis', 'kendaraan'));
    }
    public function showpdf()
    {

        $pdfPath = asset('pdfs/pkppk.pdf');


        return view('pdf-view', compact('pdfPath'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'id_petugas' => 'required|exists:petugas,user_id',
            'id_kendaraan' => 'required|string',
            'dinas' => 'required|in:pagi,malam',
            'danruPenerima' => 'required|string', //info_tambahan
            'danruPenyerah' => 'required|string', //info_tambahan
            'reguPenerima' => 'required|string', //info_tambahan
            'asstMan' => 'required|string', //info_tambahan
            'reguJagaPenerima' => 'required|string', //info_tambahan
            'checklists' => 'required|array',
            'checklist.*.id_checklist' => 'required|exists:checklists,id',
            'checklist.*.kondisi' => 'required|in:baik,cukup,rusak,tdk ada',
            'checklist.*.keterangan' => 'nullable|string',
        ]);

        $tanggal = \Carbon\Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');
        // $hari = \Carbon\Carbon::parse($request->tanggal)->translatedFormat('l');
        // $hari = strtolower($hari);

        // $tanggalFormatted = \Carbon\Carbon::parse($request->tanggal)->format('d/m/Y');

        // $id_hasil = "{$hari}-{$tanggalFormatted}-{$request->dinas}";
        // Ambil nama hari dalam bahasa Indonesia
        $hari = \Carbon\Carbon::parse($tanggal)->translatedFormat('l');
        $hari = strtolower($hari); // Ubah huruf kecil semua

        // Format tanggal menjadi "dmY" (contoh: 26042024)
        $tanggalFormatted = \Carbon\Carbon::parse($tanggal)->format('dmY');

        // Gabungkan nama hari, tanggal, dan dinas tanpa pemisah
        $id_hasil = "{$hari}{$tanggalFormatted}{$request->dinas}{$request->id_kendaraan}";



        $exists = Pemeriksaan::where('tanggal', $tanggal)
            ->where('id_kendaraan', $request->id_kendaraan)
            ->where('dinas', $request->dinas)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors([
                'dinas' => 'Pemeriksaan untuk dinas ini sudah dilakukan pada tanggal dan kendaraan ini.'
            ])->withInput();
        }
        $id_user = Petugas::where('user_id', $request->id_petugas)->first()->id;

        foreach ($request->checklists as $item) {
            Pemeriksaan::create([
                'id_petugas' => $id_user,
                'dinas' => $request->dinas,
                'id_hasil' => $id_hasil,
                'id_checklist' => $item['id_checklist'],
                'id_kendaraan' => $request->id_kendaraan,
                'tanggal' => $tanggal,
                'kondisi' => $item['kondisi'],
                'keterangan' => $item['keterangan'] ?? null,
            ]);
        }
        $dinasP = $request->dinas == 'pagi' ? 'malam' : 'pagi';
        $tambah = InfoTambahan::create([
            'id_hasil' => $id_hasil,
            'dinasPenerima' => $dinasP,
            'danruPenerima' => $request->danruPenerima,
            'danruPenyerah' => $request->danruPenyerah,
            'komandanPenyerah' => $request->komandanPenyerah,
            'komandanPenerima' => $request->komandanPenerima,
            'reguPenerima' => $request->reguPenerima,
            'reguJagaPenerima' => $request->reguJagaPenerima,
            'Asstman' => $request->asstMan
        ]);
        $signatureController = new DigitalSignatureController();
        $signatureController->createSignatureLinks($id_hasil);


        // return redirect()->route('pemeriksaan.create', ['jenis' => $request->jenis_kendaraan])
        //     ->with('success', 'Pemeriksaan berhasil disimpan!');
        return redirect()->route('pemeriksaan.cetak', ['id_hasil' => $id_hasil]);
    }
    public function cetak($id_hasil)
    {

        $infoTambahan = InfoTambahan::where('id_hasil', $id_hasil)->first();
        $pemeriksaan = Pemeriksaan::where('id_hasil', $id_hasil)
            ->with('checklist', 'petugas.user', 'kendaraan')
            ->get();
        $ttd = DigitalSignature::where('idHasilPemeriksaan', $id_hasil)->first();
        if ($pemeriksaan->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'Data pemeriksaan tidak ditemukan.']);
        }

        // Grupkan hasil berdasarkan kategori
        $sebelum = $pemeriksaan->where('checklist.kategori', 'sebelum');
        $setelah = $pemeriksaan->where('checklist.kategori', 'setelah');
        $testJalan = $pemeriksaan->where('checklist.kategori', 'test_jalan');
        $testPompa = $pemeriksaan->where('checklist.kategori', 'test_pompa');
        $lainLain = $pemeriksaan->where('checklist.kategori', 'lain-lain');

        // Ambil informasi utama (tanggal, dinas, kendaraan, petugas)
        $info = $pemeriksaan->first();

        return view('pemeriksaans.cetak', compact('info', 'ttd', 'infoTambahan', 'sebelum', 'setelah', 'testJalan', 'testPompa', 'lainLain'));
    }

    //     public function recap()
    // {
    //     // Mengambil semua data pemeriksaan, termasuk relasi ke petugas, kendaraan, dan checklist
    //     $hasil = Pemeriksaan::select('id_hasil', 'tanggal', 'dinas', 'id_petugas', 'id_kendaraan')
    //         ->with(['petugas', 'kendaraan'])
    //         ->groupBy('id_hasil', 'tanggal', 'dinas', 'id_petugas', 'id_kendaraan') // Untuk mencegah duplikasi ID hasil
    //         ->orderBy('tanggal', 'desc')
    //         ->get();

    //     return view('pemeriksaans.recap', compact('hasil'));
    // }
    public function recap(Request $request)
    {
        $search = $request->get('search');
        $dinas = $request->get('dinas');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $sortBy = $request->get('sortBy');
        $sort = $request->get('sort', 'asc');


        if (!empty($startDate)) {
            $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', $startDate)->format('Y-m-d');
        }

        if (!empty($endDate)) {
            $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', $endDate)->format('Y-m-d');
        }

        $query = Pemeriksaan::query();

        if (Auth::user()->role == 'petugas') {
            $query->whereHas('petugas', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('role', 'petugas')->where('id', Auth::user()->id);
                });
            });
        }

        $query->with(['petugas', 'kendaraan']);

        if (!empty($dinas)) {
            $query->WhereIn('dinas', $dinas);
        }

        if (!empty($startDate) && !empty($endDate)) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query
                    ->whereHas('kendaraan', function ($query) use ($search) {
                        $query->where('nama_kendaraan', 'like', "%{$search}%");
                    })
                    ->orWhereHas('petugas', function ($query) use ($search) {
                        $query->WhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        });
                    });
            });
        }
        $query->selectRaw('id_hasil, dinas, id_kendaraan, id_petugas, tanggal, MAX(id) as id');

        $query->groupBy('id_hasil', 'tanggal', 'dinas', 'id_petugas', 'id_kendaraan');

        if (!empty($sortBy) && is_string($sortBy) && in_array($sort, ['asc', 'desc'])) {
            if ($sortBy == 'tanggal') {
                $query->orderByRaw('CAST(' . $sortBy . ' AS UNSIGNED) ' . $sort);
            } else {
                $query->orderBy($sortBy, $sort);
            }
        }


        $pemeriksaans = $query->paginate(10)->appends(request()->query());

        $groupedDinas = Pemeriksaan::all()->groupBy('dinas')->map(function ($items, $dinas) {
            return (object) [
                'dinas' => $dinas,
                'total' => $items->count()
            ];
        });

        $rowCallback = function ($value, $field) {
            if ($field == 'dinas') {
                return ucfirst($value);
            }
            if ($field == 'id_kendaraan') {
                $id_kendaraan = $value;
                $kendaraan = Kendaraan::find($id_kendaraan);
                return $kendaraan->nama_kendaraan;
            }
            // if ($field == 'id_petugas') {
            //     $id_petugas = $value;
            //     $petugas = Petugas::find($id_petugas);
            //     return $petugas->nama_petugas;
            // }
            if ($field == 'id_petugas') {
                $id_petugas = $value;
                $petugas = Petugas::find($id_petugas);
                return $petugas ? $petugas->user->name : '-';
            }
            if ($field == 'id_hasil') {
                preg_match('/\d+/', $value, $matches);
                $tanggalRaw = $matches[0];

                $dinas = substr($value, strpos($value, $tanggalRaw) + strlen($tanggalRaw));

                $tanggal = \Carbon\Carbon::createFromFormat('dmY', $tanggalRaw);
                $hari = strtolower($tanggal->locale('id')->isoFormat('dddd'));

                return
                    "{$hari}-{$tanggal->format('d-m-Y')}-{$dinas}";
            }
            if ($field == 'tanggal') {
                $tanggal = \Carbon\Carbon::parse($value);
                return $tanggal->format('d-m-Y');
            }
            return $value;
        };

        $filterCount = count(array_filter(array_merge(
            $dinas ?? []
        ), function ($value) {
            return $value !== null;
        }));

        $sortable = (object) [
            'tanggal' => (object) ['label' => 'Tanggal', 'field' => 'tanggal'],
        ];

        return view('pemeriksaans.recap', compact('pemeriksaans', 'groupedDinas', 'filterCount', 'sortable', 'rowCallback'));
    }


    public function destroy($id)
    {

    // Cari pemeriksaan berdasarkan id_hasil
    $pemeriksaan = Pemeriksaan::where('id_hasil', $id)->first();
dd($id);
    // if ($pemeriksaan) {
    //     $pemeriksaan->delete();
    //     return redirect()->route('pemeriksaan.recap')->with('success', 'Pemeriksaan berhasil dihapus.');
    // } else {
    //     return redirect()->route('pemeriksaan.recap')->with('error', 'Pemeriksaan tidak ditemukan.');
    // }
    //     // return redirect()->route('pemeriksaan.recap')->with('success', 'data pemeriksaan berhasil dihapus.');
    }


    // public function arsip($id_hasil)
    // {
    //     $pemeriksaans = Pemeriksaan::where('id_hasil', $id_hasil)
    //         ->with('checklist', 'petugas', 'kendaraan')
    //         ->get();

    //     if ($pemeriksaans->isEmpty()) {
    //         return redirect()->back()->withErrors(['error' => 'Data arsip tidak ditemukan.']);
    //     }

    //     // Ambil informasi utama (tanggal, dinas, kendaraan, petugas)
    //     $info = $pemeriksaans->first();

    //     return view('pemeriksaans.arsip', compact('info', 'pemeriksaans'));
    // }

    public function fetch(Request $request)
    {
        $query = Pemeriksaan::select('id_hasil', 'tanggal', 'dinas', 'id_petugas', 'id_kendaraan')
            ->with(['petugas', 'kendaraan']);

        // Filter pencarian
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('petugas', function ($q) use ($search) {
                $q->where('nama_petugas', 'LIKE', "%{$search}%");
            })->orWhereHas('kendaraan', function ($q) use ($search) {
                $q->where('nama_kendaraan', 'LIKE', "%{$search}%");
            })->orWhere('tanggal', 'LIKE', "%{$search}%");
        }

        // Urutkan berdasarkan tanggal
        if ($request->has('order')) {
            $query->orderBy('tanggal', $request->order);
        }

        // Kelompokkan berdasarkan dinas
        if ($request->has('group')) {
            $query->orderBy('dinas');
        }

        $hasil = $query->get();


        $hasilFormatted = $hasil->map(function ($item) {
            $tanggal = \Carbon\Carbon::parse($item->tanggal);
            $hari = strtolower($tanggal->translatedFormat('l')); // Contoh: 'sabtu'

            $tanggalFormatted = $tanggal->format('dmY');
            $idHasilBaru = "{$hari}{$tanggalFormatted}{$item->dinas}";
            $idHasilFormatted = "{$hari}-{$tanggal->format('d-m-Y')}-{$item->dinas}";

            return [
                'hasil' => $idHasilBaru,
                'id_hasil' => $idHasilFormatted,
                'tanggal' => $item->tanggal,
                'dinas' => ucfirst($item->dinas),
                'petugas' => $item->petugas->nama_petugas ?? '-',
                'kendaraan' => $item->kendaraan->nama_kendaraan ?? '-',
            ];
        });

        $html = view('pemeriksaans.partials.rekapBody', compact('hasilFormatted'))->render();

        return response()->json(['html' => $html]);
    }
}
