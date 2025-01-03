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
        <span class="text-sm font-medium text-muted-foreground">Pejabat</span>
    </div>
@endsection

@section('content')

<div class="container">
    <a href="{{ route('pejabats.create') }}" class="btn btn-primary mb-3">Tambah Pejabat</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pejabats as $pejabat)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pejabat->nama }}</td>
                <td>{{ $pejabat->jabatan }}</td>
                <td>
                    @if($pejabat->photo)
                        <img src="{{ asset($pejabat->photo) }}" alt="Photo" width="100">
                    @else
                        Tidak ada foto
                    @endif
                </td>
                <td>
                    <a href="{{ route('pejabats.edit', $pejabat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pejabats.destroy', $pejabat->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
