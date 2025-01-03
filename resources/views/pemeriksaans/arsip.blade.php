@extends('pemeriksaans.template.template')

@section('content')
<div class="container mt-4">
    <h1>Arsip Pemeriksaan</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Pemeriksaan</h5>
            <p><strong>Tanggal:</strong> {{ $info->tanggal }}</p>
            <p><strong>Dinas:</strong> {{ ucfirst($info->dinas) }}</p>
            <p><strong>Petugas:</strong> {{ $info->petugas->nama_petugas }}</p>
            <p><strong>Kendaraan:</strong> {{ $info->kendaraan->nama_kendaraan }}</p>
        </div>
    </div>

    <h3>Detail Pemeriksaan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item Checklist</th>
                <th>Kondisi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemeriksaans as $pemeriksaan)
                <tr>
                    <td>{{ $pemeriksaan->checklist->nama_item }}</td>
                    <td>{{ ucfirst($pemeriksaan->kondisi) }}</td>
                    <td>{{ $pemeriksaan->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pemeriksaan.recap') }}" class="btn btn-secondary mt-3">Kembali ke Arsip</a>
</div>
@endsection
