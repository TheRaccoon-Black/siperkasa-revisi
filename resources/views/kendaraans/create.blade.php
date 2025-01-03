@extends('petugas.template.template')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Kendaraan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('kendaraan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>No Polisi</label>
                    <input type="text" name="no_polisi" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <input type="text" name="nama_kendaraan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Merk</label>
                    <input type="text" name="merk" class="form-control">
                </div>
                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
@endsection
