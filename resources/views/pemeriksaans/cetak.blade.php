<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cetak</title>
    <style>
        @media print {
            body {
                transform: scale(0.95);
                /* Kurangi sedikit ukuran konten */
                transform-origin: top left;
                /* Pastikan posisi skala tetap rapi */
            }

            table {
                width: 100%;
                /* Pastikan tabel menggunakan lebar penuh */
            }

            .container {
                margin: 0;
                padding: 0;
            }

            .hide-on-print {
                display: none !important;
            }
        }

        @page {
            size: A4;
            margin: 1cm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 20px;
        }


        .rotate-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            /* font-style: italic;   */
            /* text-align: center;
    vertical-align: middle; */
            /* padding: 5px;          */
            /* height: 120px;            */
            white-space: nowrap;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            text-transform: uppercase;
            margin: 0;
        }

        .header p {
            font-size: 12px;
            margin: 0;
        }

        .header .logo {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        /* Table */
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Footer */
        .footer {
            margin-top: 0px;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
        }

        .footer .signature {
            text-align: center;
        }

        .footer .signature div {
            margin-top: 50px;
        }

        .footer .signature .line {
            margin-top: 10px;
            font-size: 10px;
            text-align: center;
            width: 80%;
            margin: 10px auto 0 auto;
            padding-top: 5px;
        }

        .footer .signature .name-space {
            height: 40px;
            /* Memberikan ruang sekitar empat baris */
            margin-top: 10px;
            /* Jarak antara tanda tangan dan area nama */
        }

        .footer .signature img {
            width: 70px;
            height: 70px;
            position: absolute;
            margin-left: -40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>LOGBOOK KEGIATAN DAN CHECKLIST</h1>
            <h1>
    KENDARAAN
    @if($info->Kendaraan->jenis == 'khusus')
        Pendukung
    @else
    {{$info->checklist->jenis_kendaraan}} @endif ARFF {{$info->Kendaraan->nama_kendaraan}}
</h1>


            @php
                $tanggal = \Carbon\Carbon::parse($info->tanggal)->format('l/d-M-Y');

                // Ganti nama hari ke dalam bahasa Indonesia
                $hariIndonesia = [
                    'Monday' => 'Senin',
                    'Tuesday' => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday' => 'Kamis',
                    'Friday' => 'Jumat',
                    'Saturday' => 'Sabtu',
                    'Sunday' => 'Minggu',
                ];

                // Ganti nama bulan ke dalam bahasa Indonesia
                $bulanIndonesia = [
                    'Jan' => 'Jan',
                    'Feb' => 'Feb',
                    'Mar' => 'Mar',
                    'Apr' => 'Apr',
                    'May' => 'Mei',
                    'Jun' => 'Jun',
                    'Jul' => 'Jul',
                    'Aug' => 'Agu',
                    'Sep' => 'Sep',
                    'Oct' => 'Okt',
                    'Nov' => 'Nov',
                    'Dec' => 'Des',
                ];

                // Pecah tanggal ke dalam bagian hari, tanggal, dan bulan-tahun
                [$hariInggris, $tanggalBulan] = explode('/', $tanggal);

                // Ambil bulan dalam format singkat
                [$tanggalHari, $bulanInggris, $tahun] = explode('-', $tanggalBulan);

                // Gantikan hari dan bulan dengan format Indonesia
                $hari = $hariIndonesia[$hariInggris] ?? $hariInggris;
                $bulan = $bulanIndonesia[$bulanInggris] ?? $bulanInggris;

                // Format akhir
                $tanggalIndonesia = "{$hari}/{$tanggalHari}-{$bulan}-{$tahun}";
            @endphp

            <p>HARI / TANGGAL ( {{ $tanggalIndonesia }} )</p>

            <img src="{{ asset('/img/logo2.png') }}" alt="Logo" class="logo" width="100">
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th rowspan="1">No</th>
                    <th rowspan="1">Pemeriksaan Kendaraan</th>
                    <th colspan="4">Hasil Pemeriksaan</th>
                    <th rowspan="1">Menyerahkan</th>
                    <th rowspan="1">Menerima</th>
                </tr>
                <tr>
                    <th rowspan="3">A</th>
                    <th rowspan="3">Sebelum Dihidupkan <br>(Check Level)</th>
                    <th rowspan="3">
                        <div class="rotate-text">Baik</div>
                    </th>
                    <th rowspan="3">
                        <div class="rotate-text">Cukup</div>
                    </th>
                    <th rowspan="3">
                        <div class="rotate-text">Rusak</div>
                    </th>
                    <th rowspan="3">
                        <div class="rotate-text">Tidak Ada</div>
                    </th>
                    <!--<th>Regu/Dinas: {{ $info->petugas->regu }}/{{ ucfirst($info->dinas) }}</th>-->
                    <th>Regu/Dinas: {{ ucfirst($info->petugas->regu) }}.</th>
                    <!--<th>Regu/Dinas: {{ $infoTambahan->reguPenerima }}/{{ ucfirst($infoTambahan->dinasPenerima) }} </th>-->
                    <th>Regu/Dinas: {{ ucfirst($infoTambahan->reguPenerima) }}. </th>
                </tr>
                <tr>
                    <th>Danru: {{ $infoTambahan->danruPenyerah }}</th>
                    <th>Danru: {{ $infoTambahan->danruPenerima }}</th>
                </tr>
                <tr>


                    <th colspan="2">Keterangan</th>

                </tr>
            </thead>
            <tbody>
                <!-- Section A -->
                {{-- <tr style="font-weight: bold;background-color: #C6C6C6;">
                    <td>A</td>
                    <td colspan="7" style="text-align: left; font-weight: bold;background-color: #C6C6C6;">Sebelum Dihidupkan (Check Level)</td>
                </tr> --}}
                @php
                    $k = 1;
                @endphp
                @foreach ($sebelum as $index => $item)
                    <tr>
                        <td>{{ $k++ }}</td>
                        <td style="text-align: left;">{{ $item->checklist->nama_item }}</td>
                        <td>{!! $item->kondisi === 'baik' ? '✔' : '' !!}</td>
                        <td>{!! $item->kondisi === 'cukup' ? '✔' : '' !!}</td>
                        <td>{!! $item->kondisi === 'rusak' ? '✔' : '' !!}</td>
                        <td>{!! $item->kondisi === 'tdk ada' ? '✔' : '' !!}</td>
                        <td colspan="2" style="text-align: left;">{{ $item->keterangan }}</td>

                    </tr>
                @endforeach

                <!-- Section B -->
                <tr>
                    <td>B</td>
                    <td>Setelah Dihidupkan <br> (Check Mekanik)</td>
                    <td style="text-align: center; font-weight: bold; background-color: #C6C6C6;" colspan="6"></td>
                </tr>
                @php
                    $l = 1;
                @endphp
                @foreach ($setelah as $index => $item)
                    <tr>
                        <td>{{ $l++ }}</td>
                        <td style="text-align: left;">{{ $item->checklist->nama_item }}</td>
                        <td>{!! $item->kondisi === 'baik' ? '✔' : '' !!}</td>
                        <td>{!! $item->kondisi === 'cukup' ? '✔' : '' !!}</td>
                        <td>{!! $item->kondisi === 'rusak' ? '✔' : '' !!}</td>
                        <td>{!! $item->kondisi === 'tdk ada' ? '✔' : '' !!}</td>
                        <td colspan="2" style="text-align: left;">{{ $item->keterangan }}</td>

                    </tr>
                @endforeach
                <!-- Section c -->
                <tr>
                    <td>C</td>
                    <td>Test Jalan</td>
                    <td colspan="6" style="text-align: center; font-weight: bold; background-color: #C6C6C6;"></td>
                </tr>
                @php
                    $n = 1;
                @endphp
                @foreach ($testJalan as $index => $item)
                    <tr">
                        <td>{{ $n++ }}</td>
                        <td style="text-align: left;">{{ $item->checklist->nama_item }}</td>
                        <td>{!! $item->kondisi === 'baik' ? '✔' : '' !!}</td>
                        <td>{!! $item->kondisi === 'cukup' ? '✔' : '' !!}</td>
                        <td>{!! $item->kondisi === 'rusak' ? '✔' : '' !!}</td>
                        <td>{!! $item->kondisi === 'tdk ada' ? '✔' : '' !!}</td>
                        <td colspan="2" style="text-align: left;">{{ $item->keterangan }}</td>

                        </tr>
                @endforeach
                <!-- Section d -->
                <tr>
                    <td>D</td>
                    @if ($lainLain->isEmpty())
                        <td>Test Pompa</td>
                    @else
                        <td>Lain-lain</td>
                    @endif
                    <td style="text-align: center; font-weight: bold; background-color: #C6C6C6;" colspan="6"></td>
                </tr>
                @php
                    $m = 1;
                @endphp
                @if ($lainLain->isEmpty())
                    @foreach ($testPompa as $index => $item)
                        <tr>
                            <td>{{ $m++ }}</td>
                            <td style="text-align: left;">{{ $item->checklist->nama_item }}</td>
                            <td>{!! $item->kondisi === 'baik' ? '✔' : '' !!}</td>
                            <td>{!! $item->kondisi === 'cukup' ? '✔' : '' !!}</td>
                            <td>{!! $item->kondisi === 'rusak' ? '✔' : '' !!}</td>
                            <td>{!! $item->kondisi === 'tdk ada' ? '✔' : '' !!}</td>
                            <td colspan="2" style="text-align: left;">{{ $item->keterangan }}</td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($lainLain as $index => $item)
                        <tr>
                            <td>{{ $m++ }}</td>
                            <td style="text-align: left;">{{ $item->checklist->nama_item }}</td>
                            <td>{!! $item->kondisi === 'baik' ? '✔' : '' !!}</td>
                            <td>{!! $item->kondisi === 'cukup' ? '✔' : '' !!}</td>
                            <td>{!! $item->kondisi === 'rusak' ? '✔' : '' !!}</td>
                            <td>{!! $item->kondisi === 'tdk ada' ? '✔' : '' !!}</td>
                            <td colspan="2" style="text-align: left;">{{ $item->keterangan }}</td>
                        </tr>
                    @endforeach
                @endif

                <!-- Sections C and D can follow the same structure -->
            </tbody>
        </table>
        <div style="display: flex; justify-content: center; align-items: center;" class="hide-on-print">
            <a href="{{ route('signatures.showLinks', ['id_hasil' => $info->id_hasil]) }}"
                style="border: 1px solid #000; border-radius: 10px; padding: 10px; text-decoration: none; background-color: #f2f2f2; color: #000; margin: 10px; display: flex; align-items: center;">
                Tanda Tangan Disini
                <span style="display: inline-flex; align-items: center; justify-content: center; margin-left: 5px;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d='M6.92 6.956 5.45 5.473m9.309 1.483 1.47-1.483m-10.78 10.88 1.47-1.484m3.92-9.89V3m-5.88 7.913H3m13.875 5.923 3.814-1.506a.496.496 0 0 0 0-.921l-9.165-3.615a.492.492 0 0 0-.635.64l3.582 9.251c.162.42.75.42.912 0z' />
                    </svg>
                </span>
            </a>

            <a href="#" onclick="printPage(event)"
                style="border: 1px solid #000; border-radius: 10px; padding: 10px; text-decoration: none; background-color: #f2f2f2; color: #000; margin: 10px; display: flex; align-items: center;">
                Print
                <span style="display: inline-flex; align-items: center; justify-content: center; margin-left: 5px;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d='M19 10V5a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1v5m15 0H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-8a1 1 0 0 0-1-1' />
                        <path d='M17.5 20v-3a1 1 0 0 0-1-1H11a1 1 0 0 0-1 1v3m-4-7h2' />
                    </svg>
                </span>
            </a>
        </div>

        <script>
            function printPage(e) {
                e.preventDefault();
                window.print();
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                if (window.self !== window.top) {
                    document.querySelector('.hide-on-print').style.display = 'none';
                }
            });
        </script>

        <!-- Footer -->
        {{-- <div class="footer">
            <div class="signature">
                <div>Menerima<br>Komandan Jaga</div>
            </div>
            <div class="signature">
                <div>Mengetahui<br>ASST-MAN OF A/S & RFF</div>
            </div>
            <div class="signature">
                <div>Menyerahkan<br>Komandan Jaga</div>
            </div>
        </div> --}}
        <div class="footer">
            <div class="signature">
                <div>Menerima<br>Komandan Jaga {{ $infoTambahan->reguPenerima }}</div>
                @if ($ttd->ttdDanruPenerima == null)
                    <div class="name-space"></div>
                @else
                    <img src="{{ asset($ttd->ttdDanruPenerima) }}" alt="">
                    <div class="name-space"></div>
                @endif
                <div class="line">{{ $infoTambahan->danruPenerima }}</div>
            </div>
            <div class="signature">
                <div>Mengetahui<br>AS & RFF Dept.Head</div>
                @if ($ttd->ttdAsstMan == null)
                    <div class="name-space"></div>
                @else
                    <img src="{{ asset($ttd->ttdAsstMan) }}" alt="">
                    <div class="name-space"></div>
                @endif
                <div class="line">{{ $infoTambahan->Asstman }}</div>
            </div>
            <div class="signature">
                <div>Menyerahkan<br>Komandan Jaga {{ $info->petugas->regu }}</div>
                @if ($ttd->ttdDanruPenyerah == null)
                    <div class="name-space"></div>
                @else
                    <img src="{{ asset($ttd->ttdDanruPenyerah) }}" alt="">
                    <div class="name-space"></div>
                @endif
                <div class="line">{{ $infoTambahan->danruPenyerah }}</div>
            </div>
        </div>
    </div>
    {{-- {{$info}} --}}
    {{-- <a href="{{route('signatures.showLinks', ['id_hasil' => $info->id_hasil])}}"><button>TTD</button><a> --}}
</body>

</html>
