@extends('petugas.template.template')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Checklist</h3>
            <a href="{{ route('checklist.index') }}" class="btn btn-secondary float-right">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('checklist.update', $checklist->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_item">Nama Item</label>
                    <input type="text" name="nama_item" id="nama_item" class="form-control"
                        value="{{ $checklist->nama_item }}" placeholder="Masukkan Nama Item" required>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="sebelum" {{ $checklist->kategori == 'sebelum' ? 'selected' : '' }}>Sebelum</option>
                        <option value="setelah" {{ $checklist->kategori == 'setelah' ? 'selected' : '' }}>Setelah</option>
                        <option value="test_jalan" {{ $checklist->kategori == 'test_jalan' ? 'selected' : '' }}>Test Jalan
                        </option>
                        <option value="test_pompa" {{ $checklist->kategori == 'test_pompa' ? 'selected' : '' }}>Test Pompa
                        </option>
                        <option value="lain-lain" {{ $checklist->kategori == 'lain-lain' ? 'selected' : '' }}>Lain-lain
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_kendaraan">Jenis Kendaraan</label>
                    <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-control" required>
                        <option value="">-- Pilih Jenis Kendaraan --</option>
                        <option value="utama" {{ $checklist->jenis_kendaraan == 'utama' ? 'selected' : '' }}>Utama</option>
                        <option value="pendukung" {{ $checklist->jenis_kendaraan == 'pendukung' ? 'selected' : '' }}>
                            Pendukung</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
