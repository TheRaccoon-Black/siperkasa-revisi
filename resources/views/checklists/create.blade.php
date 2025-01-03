@extends('petugas.template.template')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Checklist</h3>
            <a href="{{ route('checklist.index') }}" class="btn btn-secondary float-right">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('checklist.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_item">Nama Item</label>
                    <input type="text" name="nama_item" id="nama_item" class="form-control"
                        placeholder="Masukkan Nama Item" required>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="sebelum">Sebelum</option>
                        <option value="setelah">Setelah</option>
                        <option value="test_jalan">Test Jalan</option>
                        <option value="test_pompa">Test Pompa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_kendaraan">Jenis Kendaraan</label>
                    <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-control" required>
                        <option value="">-- Pilih Jenis Kendaraan --</option>
                        <option value="utama">Utama</option>
                        <option value="pendukung">Pendukung</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
