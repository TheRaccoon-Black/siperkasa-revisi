<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DigitalSignature;
use App\Models\InfoTambahan;
use Illuminate\Support\Facades\Storage;
use PhpOption\None;

class DigitalSignatureController extends Controller
{
    // public function createSignatureLinks(Request $request)
    public function createSignatureLinks($id_hasil)
{
    $signature = DigitalSignature::create([
        // 'idHasilPemeriksaan' => $request->idHasilPetugas,
        'idHasilPemeriksaan' => $id_hasil,
        'linkDanruPenerima' => Str::uuid(),
        'linkDanruPenyerah' => Str::uuid(),
        'linkAsstMan' => Str::uuid(),
    ]);

}
public function showSignatureLinks($id_hasil){
    $signature = DigitalSignature::where('idHasilPemeriksaan', $id_hasil)->firstOrFail();
    return view('signatures.links', [
        'signature' => $signature,
    ]);
}

public function showSignatureForm($link)
{

    $signature = DigitalSignature::where('linkDanruPenerima', $link)
        ->orWhere('linkDanruPenyerah', $link)
        ->orWhere('linkAsstMan', $link)
        ->firstOrFail();

    $role = $this->getRoleByLink($signature, $link);

    $info = InfoTambahan::where('id_hasil', $signature->idHasilPemeriksaan)->first();

    $name = match ($role) {
        'Danru Penerima' => $info->danruPenerima,
        'Danru Penyerah' => $info->danruPenyerah,
        'Asst Man' => $info->Asstman,
        default => '',
    };

    if ($this->isSignatureFilled($signature, $role)) {
        $isFilled = true;
        return view('signatures.form', compact('signature', 'role', 'isFilled', 'name'));
    }

    return view('signatures.form', compact('signature', 'role', 'name'));
}

private function isSignatureFilled($signature, $role)
{
    if ($role === 'Danru Penerima' && !empty($signature->ttdDanruPenerima)) {
        return true;
    } elseif ($role === 'Danru Penyerah' && !empty($signature->ttdDanruPenyerah)) {
        return true;
    } elseif ($role === 'Asst Man' && !empty($signature->ttdAsstMan)) {
        return true;
    }

    return false;
}

private function getRoleByLink($signature, $link)
{
    if ($signature->linkDanruPenerima === $link) {
        return 'Danru Penerima';
    } elseif ($signature->linkDanruPenyerah === $link) {
        return 'Danru Penyerah';
    } elseif ($signature->linkAsstMan === $link) {
        return 'Asst Man';
    }
    return null;
}

public function saveSignature(Request $request, $link)
{
    $request->validate([
        'signature' => 'required', // Base64 dari signature pad
    ]);

    $signature = DigitalSignature::where('linkDanruPenerima', $link)
        ->orWhere('linkDanruPenyerah', $link)
        ->orWhere('linkAsstMan', $link)
        ->firstOrFail();

    $role = $this->getRoleByLink($signature, $link);

    $signatureData = $request->input('signature');
    $fileName = uniqid() . '.png';
    $filePath = 'signatures/' . $fileName;

    file_put_contents($filePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData)));

    if ($role === 'Danru Penerima') {
        $signature->update(['ttdDanruPenerima' => $filePath]);
    } elseif ($role === 'Danru Penyerah') {
        $signature->update(['ttdDanruPenyerah' => $filePath]);
    } elseif ($role === 'Asst Man') {
        $signature->update(['ttdAsstMan' => $filePath]);
    }

    return redirect()->route('signatures.success', ['link' => $link]);
}

public function success($link)
{
    $signature = DigitalSignature::where('linkDanruPenerima', $link)
        ->orWhere('linkDanruPenyerah', $link)
        ->orWhere('linkAsstMan', $link)
        ->firstOrFail();

    return view('signatures.success', compact('signature'));
}



}
