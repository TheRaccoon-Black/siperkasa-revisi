<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $merk = $request->get('merk');
        $tahun = $request->get('tahun');
        $sortBy = $request->get('sortBy');
        $sort = $request->get('sort', 'asc');

        $query = Kendaraan::query();

        if (!empty($merk)) {
            $query->WhereIn('merk', $merk);
        }

        if (!empty($tahun)) {
            $query->WhereIn('tahun', $tahun);
        }

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('nama_kendaraan', 'like', "%{$search}%");
            });
        }

        if (!empty($sortBy) && is_string($sortBy) && in_array($sort, ['asc', 'desc'])) {
            if ($sortBy == 'tahun') {
                $query->orderByRaw('CAST(' . $sortBy . ' AS UNSIGNED) ' . $sort);
            } else {
                $query->orderBy($sortBy, $sort);
            }
        }

        $kendaraans = $query->paginate(10)->appends(request()->query());

        $groupedMerk = Kendaraan::all()->groupBy('merk')->map(function ($items, $merk) {
            return (object) [
                'merk' => $merk,
                'total' => $items->count()
            ];
        });

        $groupedTahun =
            Kendaraan::all()->groupBy('tahun')->map(function ($items, $tahun) {
                return (object) [
                    'tahun' => $tahun,
                    'total' => $items->count()
                ];
            });

        $rowCallback = function ($value, $field) {
            return $value;
        };

        $filterCount = count(array_filter(array_merge(
            $merk ?? [],
            $tahun ?? []
        ), function ($value) {
            return $value !== null;
        }));

        $sortable = (object) [
            'no_polisi' => (object) ['label' => 'No. Polisi', 'field' => 'no_polisi'],
            'tahun' => (object) ['label' => 'Tahun', 'field' => 'tahun']
        ];

        return view('kendaraans.index', compact('kendaraans', 'groupedMerk', 'groupedTahun', 'rowCallback', 'filterCount', 'sortable'));
    }

    public function create()
    {
        return view('kendaraans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_polisi' => 'required|unique:kendaraans,no_polisi',
            'nama_kendaraan' => 'required',
            'merk' => 'nullable',
            'tahun' => 'nullable|numeric',
        ]);

        Kendaraan::create($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('kendaraans.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_polisi' => 'required|unique:kendaraans,no_polisi,' . $id,
            'nama_kendaraan' => 'required',
            'merk' => 'nullable',
            'tahun' => 'nullable|numeric',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
