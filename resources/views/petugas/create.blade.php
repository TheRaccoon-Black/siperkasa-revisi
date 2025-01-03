@extends('petugas.template.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Petugas</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('petugas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_petugas">Nama Petugas</label>
                <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" placeholder="Masukkan nama petugas" required>
            </div>
            <div class="form-group">
                <label for="regu">Regu</label>
                <input type="text" name="regu" id="regu" class="form-control" placeholder="Masukkan regu" required>
            </div>
            <div class="form-group">
                <label for="petugas_id">ID Petugas</label>
                <input type="text" name="petugas_id" id="petugas_id" class="form-control" placeholder="Masukkan ID petugas" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
