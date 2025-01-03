<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $regu = $request->get('regu');
        // $users = User::all();
        $users = User::whereDoesntHave('petugas')->get();
        // $users_edit = User::with('petugas')->All();
        $users_edit = User::with('petugas')->get();


        $query = Petugas::query();

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })->orWhere('regu', 'like', "%{$search}%")
                    ->orWhere('petugas_id', 'like', "%{$search}%");
            });
        }

        if (!empty($regu) && is_array($regu)) {
            $query->whereIn('regu', $regu);
        }

        $petugas = $query->with('user')->paginate(10)->appends(request()->query());

        // $petugas = $query->paginate(10)->appends(request()->query());

        $grouped = Petugas::all()->groupBy('regu')->map(function ($items, $regu) {
            return (object) [
                'regu' => $regu,
                'total' => $items->count(),
            ];
        });

        $filterCount = count(array_filter($regu ?? [], function ($value) {
            return $value !== null;
        }));

        return view('petugas.index', compact('petugas', 'users','users_edit', 'grouped', 'filterCount'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'regu' => 'required|string|max:255',
            'petugas_id' => 'required|string|max:255|unique:petugas',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('error', 'Petugas gagal ditambahkan.');
        }

        Petugas::create($request->all());

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'regu' => 'required|string|max:255',
            'petugas_id' => 'required|string|max:255|unique:petugas,petugas_id,' . $id,
        ]);

        $petugas = Petugas::findOrFail($id);
        $petugas->update($request->all());

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }




    //------------------------------------------------------user--------------------------------------------------------

    public function user(Request $request)
    {
        $search = $request->get('search');
        $role = $request->get('role');

        $query = User::query();

        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }

        if (!empty($role) && is_array($role)) {
            $query->whereIn('role', $role);
        }

        $users = $query->paginate(10)->appends(request()->query());

        // $petugas = $query->paginate(10)->appends(request()->query());

        $grouped = User::all()->groupBy('role')->map(function ($items, $role) {
            return (object) [
                'role' => $role,
                'total' => $items->count(),
            ];
        });

        $filterCount = count(array_filter($role ?? [], function ($value) {
            return $value !== null;
        }));
        return view('petugas.user', compact('users', 'grouped', 'filterCount'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string',
            'unique_token' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'role', 'unique_token']));

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'unique_token' => 'required|string|unique:users,unique_token',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'unique_token' => $request->unique_token,
        ]);

        return redirect()->back()->with('success', 'User added successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
}
