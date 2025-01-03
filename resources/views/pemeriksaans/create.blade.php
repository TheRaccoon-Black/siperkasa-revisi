@extends('layouts.auth.app')

@section('breadcrumbs')
    <div class="flex items-center gap-2 text-gray-900">
        <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:underline">Dashboard</a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 shrink-0">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </div>
        <span class="text-sm font-medium text-muted-foreground">Pemeriksaan {{ ucfirst($jenis) }}</span>
    </div>
@endsection

@section('content')
    <div class="w-full p-4 bg-card rounded-lg border sm:p-8">
        <h5 class="mb-2 text-xl font-bold text-card-foreground">Form Pemeriksaan - {{ ucfirst($jenis) }}</h5>
        <p class="mb-5 text-sm text-muted-foreground">
            Form pemeriksaan ini digunakan untuk melakukan pemeriksaan kendaraan {{ ucfirst($jenis) }}.<br class="hidden sm:block"> Anda
            dapat mengisi data pemeriksaan disini.
        </p>
        <form action="{{ route('pemeriksaan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="jenis_kendaraan" value="{{ $jenis }}">
            <div class="grid grid-cols-6 sm:grid-cols-12 gap-y-2 gap-x-4 space-y-2">
                <div class="col-span-6">
                    <h6 class="mb-1 text-sm font-medium text-gray-900 dark:text-white">
                        Dinas</h6>
                    <ul class="space-y-2 text-sm" aria-labelledby="sortDropdownButton">
                        @foreach (collect(['pagi' => 'Pagi', 'malam' => 'Malam'])->map(fn($label, $field) => (object) ['field' => $field, 'label' => $label]) as $item)
                            <li class="flex items-center">
                                <input id="{{ $item->field }}" type="radio" value="{{ $item->field }}" name="dinas"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="{{ $item->field }}"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $item->label }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-span-6">
                    <h6 class="mb-1 text-sm font-medium text-gray-900 dark:text-white">
                        Tanggal
                    </h6>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                xmlns="http://www.w3.org/2000/svg" class="size-5 text-gray-500 dark:text-gray-400">
                                <path
                                    d='M16.5 5V3m-9 2V3M3.25 8h17.5M3 10.044c0-2.115 0-3.173.436-3.981a3.9 3.9 0 0 1 1.748-1.651C6.04 4 7.16 4 9.4 4h5.2c2.24 0 3.36 0 4.216.412.753.362 1.364.94 1.748 1.65.436.81.436 1.868.436 3.983v4.912c0 2.115 0 3.173-.436 3.981a3.9 3.9 0 0 1-1.748 1.651C17.96 21 16.84 21 14.6 21H9.4c-2.24 0-3.36 0-4.216-.412a3.9 3.9 0 0 1-1.748-1.65C3 18.128 3 17.07 3 14.955z' />
                            </svg>
                        </div>
                        <input datepicker datepicker-buttons datepicker-autoselect-today id="default-datepicker"
                            type="text" datepicker-format="d-m-y"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Pilih Tanggal" name="tanggal">
                    </div>
                </div>
                <div class="col-span-6">
                    <x-form-input name="danruPenerima" id="danruPenerima-add" required="true"
                        placeholder="Masukan Komandan Regu" label="Komandan Regu Penerima" />
                </div>

                <div class="col-span-6">

                    <h6 class="mb-1 text-sm font-medium text-gray-900 dark:text-white">
                        <span label=>Petugas: <br> {{ $petugas2->user->name }} ({{ $petugas2->regu }})</span>
                    </h6>
                    <input type="hidden" name="id_petugas" id="id_petugas-add" value="{{ $petugas2->user_id }}">

                </div>
                <div class="col-span-6">
                    <x-form-input name="danruPenyerah" id="danruPenyerah-add" required="true"
                        placeholder="Masukan Komandan Regu" label="Komandan Regu Penyerah" />
                </div>
                <div class="col-span-6">
                    <x-form-input name="asstMan" id="asstMan-add" required="true" placeholder="Masukan Assmant"
                        label="Assistant Manager" />
                </div>

                <div class="col-span-6">
                    <x-form-select name="id_kendaraan" id="id_kendaraan-add" required="true" label="Kendaraan">
                        @foreach ($kendaraan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kendaraan }}</option>
                        @endforeach
                    </x-form-select>
                </div>
                <div class="col-span-6">
                    <x-form-select name="reguPenerima" id="reguPenerima-add" required="true" label="Regu Penerima">
                        <option value="A">Regu A</option>
                        <option value="B">Regu B</option>
                        <option value="c">Regu C</option>
                    </x-form-select>
                </div>

                <div class="col-span-6 sm:col-span-12">
                    <hr>
                </div>

                <div class="col-span-6 sm:col-span-12">
                    <h6
                        class="mb-2 flex justify-center gap-1 text-sm font-medium text-center text-gray-900 dark:text-white">
                        <span>
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                xmlns="http://www.w3.org/2000/svg" class="size-5 text-blue-600">
                                <path
                                    d='M9.713 3.64c.581-.495.872-.743 1.176-.888a2.58 2.58 0 0 1 2.222 0c.304.145.595.393 1.176.888.599.51 1.207.768 2.007.831.761.061 1.142.092 1.46.204.734.26 1.312.837 1.571 1.572.112.317.143.698.204 1.46.063.8.32 1.407.83 2.006.496.581.744.872.889 1.176.336.703.336 1.52 0 2.222-.145.304-.393.595-.888 1.176a3.3 3.3 0 0 0-.831 2.007c-.061.761-.092 1.142-.204 1.46a2.58 2.58 0 0 1-1.572 1.571c-.317.112-.698.143-1.46.204-.8.063-1.407.32-2.006.83-.581.496-.872.744-1.176.889a2.58 2.58 0 0 1-2.222 0c-.304-.145-.595-.393-1.176-.888a3.3 3.3 0 0 0-2.007-.831c-.761-.061-1.142-.092-1.46-.204a2.58 2.58 0 0 1-1.571-1.572c-.112-.317-.143-.698-.204-1.46a3.3 3.3 0 0 0-.83-2.006c-.496-.581-.744-.872-.89-1.176a2.58 2.58 0 0 1 .001-2.222c.145-.304.393-.595.888-1.176.52-.611.769-1.223.831-2.007.061-.761.092-1.142.204-1.46a2.58 2.58 0 0 1 1.572-1.571c.317-.112.698-.143 1.46-.204a3.3 3.3 0 0 0 2.006-.83' />
                                <path d='m8.667 12.633 1.505 1.721a1 1 0 0 0 1.564-.073L15.333 9.3' />
                            </svg>
                        </span>
                        <span>
                            Checklist Pemeriksaan
                        </span>

                    </h6>
                    @if ($checklists->isEmpty())
                        <p class="mb-1 text-sm font-medium text-center text-red-500 dark:text-white">Tidak ada item
                            checklist untuk
                            jenis kendaraan ini.</p>
                    @else
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-gray-800 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="pt-3 pb-1">
                                        Item
                                    </th>
                                    <th scope="col" class="pt-3 pb-1">
                                        Kondisi
                                    </th>
                                    <th scope="col" class="pt-3 pb-1">
                                        Keterangan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checklists as $checklist)
                                    <tr class="bg-white dark:bg-gray-800 border-b">
                                        <td scope="row" class="py-4 pe-4 font-medium text-gray-900 dark:text-white">
                                            {{ $checklist->nama_item }}</td>
                                        <td class="py-4 pe-4">
                                            <x-form-select name="checklists[{{ $loop->index }}][kondisi]"
                                                id="kondisi-add" required="true">
                                                <option value="">Pilih Kondisi</option>
                                                <option value="baik">Baik</option>
                                                <option value="cukup">Cukup</option>
                                                <option value="rusak">Rusak</option>
                                                <option value="tdk ada">Tidak Ada</option>
                                            </x-form-select>
                                            <input type="hidden" name="checklists[{{ $loop->index }}][id_checklist]"
                                                value="{{ $checklist->id }}">
                                        </td>
                                        <td class="py-4">
                                            <textarea name="checklists[{{ $loop->index }}][keterangan]" id="message" rows="1"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Tulis keterangan..."></textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="py-2">
                            <x-button :type="'submit'" :color="'primary'" class="w-full mt-2">Simpan</x-button>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
