@extends('petugas.template.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Petugas</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_petugas">Nama Petugas</label>
                <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" value="{{ $petugas->nama_petugas }}" required>
            </div>
            <div class="form-group">
                <label for="regu">Regu</label>
                <input type="text" name="regu" id="regu" class="form-control" value="{{ $petugas->regu }}" required>
            </div>
            <div class="form-group">
                <label for="petugas_id">ID Petugas</label>
                <input type="text" name="petugas_id" id="petugas_id" class="form-control" value="{{ $petugas->petugas_id }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
