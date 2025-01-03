@forelse ($hasilFormatted as $item)
    <tr>
        <td>{{ $item['id_hasil'] }}</td>
        <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</td>
        <td>{{ $item['dinas'] }}</td>
        <td>{{ $item['petugas'] }}</td>
        <td>{{ $item['kendaraan'] }}</td>
        <td>
            <a href="{{ route('pemeriksaan.cetak', $item['hasil']) }}" class="btn btn-primary btn-sm">Detail</a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">Tidak ada data.</td>
    </tr>
@endforelse
