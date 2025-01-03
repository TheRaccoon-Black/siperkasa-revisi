@extends('layouts.auth.app')

@section('title', 'Daftar pejabat')
@section('breadcrumbs')
    <div class="flex items-center gap-2 text-gray-900">
        <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:underline">Dashboard</a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 shrink-0">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </div>
        <span class="text-sm font-medium text-muted-foreground">Edit Pejabat</span>
    </div>
@endsection

@section('content')
<div class="container">
    <h1>Edit Pejabat</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pejabats.update', $pejabat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $pejabat->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ old('jabatan', $pejabat->jabatan) }}" required>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Foto</label>
            @if ($pejabat->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $pejabat->photo) }}" alt="Photo" width="150">
                </div>
            @endif
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('pejabats.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
