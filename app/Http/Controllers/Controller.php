<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\LoginLog;
use App\Models\Kendaraan;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function dashboard(Request $request)
    {
        $query = Pemeriksaan::query();

        $query->selectRaw('id_hasil, dinas, id_kendaraan, id_petugas, tanggal');
        $query->groupBy('id_hasil', 'tanggal', 'dinas', 'id_petugas', 'id_kendaraan');

        if (Auth::user()->role == 'petugas') {
            $query->whereHas('petugas', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                });
            });
            $petugasCount = 0;
            $pemeriksaanCount = count($query->get());
        } else {
            $petugasCount = count(Petugas::all());
            $pemeriksaanCount = count($query->get());
        }


        $chartDate = $request->get('chartDate', 'week');
        $now = \Carbon\Carbon::now();
        $chartData = [];
        if ($chartDate == 'week') {
            $chartData = [];
            for ($i = 0; $i < 7; $i++) {
                $date = $now->copy()->subDays($i);

                $dailyQuery = clone $query;

                $chartData[] = (object) [
                    'label' => $date->locale('id_ID')->translatedFormat('l, j F'),
                    'date' => $date->format('Y-m-d'),
                    'count' => count($dailyQuery->whereDate('tanggal', $date->format('Y-m-d'))->get()),
                ];
            }
        } elseif ($chartDate == 'month') {
            for ($i = 0; $i < 30; $i++) {
                $date = $now->copy()->subDays($i);

                $dailyQuery = clone $query;

                $chartData[] = (object) [
                    'label' => $date->locale('id_ID')->translatedFormat('j F'),
                    'date' => $date->format('Y-m-d'),
                    'count' => count($dailyQuery->whereDate('tanggal', $date->format('Y-m-d'))->get()),
                ];
            }
        } elseif ($chartDate == 'year') {
            for ($i = 0; $i < 12; $i++) {
                $date = $now->copy()->subMonths($i);

                $startOfMonth = $date->startOfMonth()->format('Y-m-d');
                $endOfMonth = $date->endOfMonth()->format('Y-m-d');

                $monthQuery = clone $query;

                $chartData[] = (object) [
                    'label' => $date->locale('id_ID')->translatedFormat('F Y'),
                    'date' => $date->format('Y-m'),
                    'count' => count($monthQuery->whereBetween('tanggal', [$startOfMonth, $endOfMonth])->get()),
                ];
            }
        }



        return view('dashboard', compact('pemeriksaanCount', 'chartData', 'petugasCount'));
    }

    public function landing()
{
    // Menghitung jumlah pemeriksaan berdasarkan grup 'id_hasil'
    // $jumlahPemeriksaan = Pemeriksaan::groupBy('id_hasil')->count();
    $jumlahPemeriksaan = Pemeriksaan::distinct('id_hasil')->count('id_hasil');


    // Menghitung jumlah petugas
    $jumlahPetugas = Petugas::count();

    // Menghitung jumlah log masuk
    $loginLog = LoginLog::count();

    // Menghitung jumlah kendaraan
    $kendaraan = Kendaraan::count();

    // Mengirim data ke view
    return view('landing', compact('jumlahPemeriksaan', 'jumlahPetugas', 'loginLog', 'kendaraan'));
}

}
