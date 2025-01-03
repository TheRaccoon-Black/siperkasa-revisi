<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $kategori = $request->get('kategori');
        $jenis_kendaraan = $request->get('jenis_kendaraan');

        $query = Checklist::query();

        if (!empty($kategori)) {
            $query->WhereIn('kategori', $kategori);
        }

        if (!empty($jenis_kendaraan)) {
            $query->WhereIn('jenis_kendaraan', $jenis_kendaraan);
        }

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('nama_item', 'like', "%{$search}%");
            });
        }

        $checklists = $query->paginate(10)->appends(request()->query());

        $groupedKategori = Checklist::all()->groupBy('kategori')->map(function ($items, $kategori) {
            return (object) [
                'kategori' => $kategori,
                'total' => $items->count()
            ];
        });

        $groupedJenisKendaraan =
            Checklist::all()->groupBy('jenis_kendaraan')->map(function ($items, $jenis_kendaraan) {
                return (object) [
                    'jenis_kendaraan' => $jenis_kendaraan,
                    'total' => $items->count()
                ];
            });

        $rowCallback = function ($value, $field) {
            if ($field === 'kategori' && $value === 'test_pompa') {
                return '<span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2 py-1 rounded whitespace-nowrap">Test Pompa</span>';
            }
            if ($field === 'kategori' && $value === 'test_jalan') {
                return '<span class="bg-indigo-100 text-indigo-800 text-sm font-medium me-2 px-2 py-1 rounded whitespace-nowrap">Test Jalan</span>';
            }
            if ($field === 'kategori' && $value === 'sebelum') {

                return '<span class="bg-purple-100 text-purple-800 text-sm font-medium me-2 px-2 py-1 rounded">Sebelum</span>';
            }
            if ($field === 'kategori' && $value === 'setelah') {
                return '<span class="bg-pink-100 text-pink-800 text-sm font-medium me-2 px-2 py-1 rounded">Setelah</span>';
            }
            if ($field === 'jenis_kendaraan' && $value === 'utama') {
                return 'Kendaraan Utama';
            }
            if ($field === 'jenis_kendaraan' && $value === 'pendukung') {
                return 'Kendaraan Pendukung';
            }
            return $value;
        };

        $filterCount = count(array_filter(array_merge(
            $kategori ?? [],
            $jenis_kendaraan ?? []
        ), function ($value) {
            return $value !== null;
        }));

        return view('checklists.index', compact('checklists', 'groupedKategori', 'groupedJenisKendaraan', 'rowCallback', 'filterCount'));
    }


    public function create()
    {
        return view('checklists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_item' => 'required|string|max:255',
            'kategori' => 'required|in:sebelum,setelah,test_jalan,test_pompa',
            'jenis_kendaraan' => 'required|in:utama,pendukung',
        ]);

        Checklist::create($request->all());
        return redirect()->route('checklist.index')->with('success', 'Checklist berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $checklist = Checklist::findOrFail($id);
        return view('checklists.edit', compact('checklist'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_item' => 'required|string|max:255',
            'kategori' => 'required|in:sebelum,setelah,test_jalan,test_pompa',
            'jenis_kendaraan' => 'required|in:utama,pendukung',
        ]);

        $checklist = Checklist::findOrFail($id);
        $checklist->update($request->all());

        return redirect()->route('checklist.index')->with('success', 'Checklist berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $checklist = Checklist::findOrFail($id);
        $checklist->delete();

        return redirect()->route('checklist.index')->with('success', 'Checklist berhasil dihapus.');
    }
}
