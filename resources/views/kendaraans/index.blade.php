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
        <span class="text-sm font-medium text-muted-foreground">Kendaraan</span>
    </div>
@endsection

@section('content')
    <div class="w-full p-4 bg-card rounded-lg border sm:p-8">
        <h5 class="mb-2 text-xl font-bold text-card-foreground">Daftar Kendaraan</h5>
        <p class="mb-5 text-sm text-muted-foreground">
            Daftar kendaraan ini menampilkan seluruh kendaraan yang terdaftar di dalam sistem.<br class="hidden sm:block">
            Anda dapat mengelola data kendaraan disini.
        </p>
        <form method="GET" action="{{ route('kendaraan.index') }}">
            <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                <x-datatable :columns="['No', 'No Polisi', 'Nama Kendaraan', 'Merk', 'Tahun']" :rows="$kendaraans" :search="true" :fields="['no_polisi', 'nama_kendaraan', 'merk', 'tahun']" :colAction="['edit', 'delete']"
                    :rowCallback="$rowCallback">
                    @slot('addButton')
                        <div class="col-span-6">
                            <x-button :color="'secondary'" class="w-full" data-modal-target="modal-add"
                                data-modal-toggle="modal-add">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Tambah Kendaraan
                            </x-button>
                        </div>
                    @endslot

                    @slot('sortButton')
                        <div class="col-span-3">
                            <x-button id="sortDropdownButton" class="w-full" data-dropdown-toggle="sortDropdown"
                                :color="'secondary'">

                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    class="h-4 w-4 mr-2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d='M4.5 7h15m-15 5h10m-10 5h4' />
                                </svg>
                                Urutkan

                                @if (request()->get('sortBy') != null)
                                    <span
                                        class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-primary bg-gray-100 border rounded-full">
                                        <svg width="24" height="24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                            stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d='m6 13.626 1.606 1.722c.886.95 1.329 1.424 1.825 1.574.436.131.9.096 1.315-.1.473-.224.852-.761 1.612-1.836L18 7' />
                                        </svg>
                                    </span>
                                @else
                                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                @endif
                            </x-button>
                        </div>
                    @endslot

                    @slot('filterButton')
                        <div class="col-span-3">
                            <x-button id="filterDropdownButton" class="w-full" data-dropdown-toggle="filterDropdown"
                                :color="'secondary'">
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    class="h-4 w-4 mr-2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d='M4.5 7h15M7 12h10m-7 5h4' />
                                </svg>
                                Filter

                                @if ($filterCount > 0)
                                    <span
                                        class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-primary bg-gray-100 border rounded-full">
                                        {{ $filterCount }}
                                    </span>
                                @else
                                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                @endif
                            </x-button>
                        </div>
                    @endslot

                    @slot('editScript')
                        <script>
                            function defaultEditFunction(data) {
                                const url = "{{ route('kendaraan.update', ['id' => '__id__']) }}".replace('__id__', data.id);

                                const form = document.getElementById('form-edit');
                                const inputNoPolisi = document.getElementById('no_polisi-edit');
                                const inputNamaKendaraan = document.getElementById('nama_kendaraan-edit');
                                const inputMerk = document.getElementById('merk-edit');
                                const inputTahun = document.getElementById('tahun-edit');

                                inputNoPolisi.value = data.no_polisi;
                                inputNamaKendaraan.value = data.nama_kendaraan;
                                inputMerk.value = data.merk;
                                inputTahun.value = data.tahun;

                                form.action = url;
                            }
                        </script>
                    @endslot

                    @slot('deleteScript')
                        <script>
                            function defaultDeleteFunction(data) {
                                const url = "{{ route('kendaraan.destroy', ['id' => '__id__']) }}".replace('__id__', data.id);

                                const form = document.getElementById('form-delete');

                                form.action = url;
                            }
                        </script>
                    @endslot
                </x-datatable>
                <div id="sortDropdown" class="border z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="grid grid-cols-6 gap-2">
                        <h6 class="mb-1 text-sm font-medium text-gray-900 dark:text-white">
                            Berdasarkan</h6>
                        <div class="col-span-6">
                            <ul class="space-y-2 text-sm" aria-labelledby="sortDropdownButton">
                                @foreach ($sortable as $item)
                                    <li class="flex items-center">
                                        <input id="{{ $item->field }}" type="radio" value="{{ $item->field }}"
                                            name="sortBy"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            @if (request()->get('sortBy') != null) {{ $item->field == request()->get('sortBy') ? 'checked' : '' }} @endif>
                                        <label for="{{ $item->field }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $item->label }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <hr class="col-span-6 mt-2" />
                        <div class="col-span-6 py-2">
                            <ul class="space-y-2 text-sm" aria-labelledby="sortDropdownButton">
                                <li class="flex items-center">
                                    <input id="asc-sort" type="radio" value="asc" name="sort"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        @if (request()->get('sort') == 'asc') checked @endif
                                        @if (request()->get('sort') == null) checked @endif>
                                    <label for="asc-sort"
                                        class="flex gap-1 ml-2 text-sm font-medium text-gray-900 dark:text-gray-100 capitalize">
                                        Asc
                                        <svg width="24" height="24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                            stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" class="size-4">
                                            <path
                                                d='M9.5 13.667 7 7l-2.5 6.667m5 0L10.75 17M9.5 13.667h-5M3.25 17l1.25-3.333M17.25 7.5v9m3.5-6L17.25 7l-3.5 3.5' />
                                        </svg>
                                    </label>
                                </li>
                                <li class="flex items-center">
                                    <input id="desc-sort" type="radio" value="desc" name="sort"
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        @if (request()->get('sort') == 'desc') checked @endif>
                                    <label for="desc-sort"
                                        class="flex gap-1 ml-2 text-sm font-medium text-gray-900 dark:text-gray-100 capitalize">
                                        desc
                                        <svg width="24" height="24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                            stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" class="size-4">
                                            <path
                                                d='M9.5 13.667 7 7l-2.5 6.667m5 0L10.75 17M9.5 13.667h-5M3.25 17l1.25-3.333M17.25 7.5v9m3.5-3.5-3.5 3.5-3.5-3.5' />
                                        </svg>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="grid grid-cols-6 gap-2 mt-2">
                        <div class="col-span-2">
                            <x-button :type="'button'" :color="'primary'" class="w-full" onclick="defaultResetSort()">
                                <svg width="24" height="24" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                    stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                                    <path d='M20.5 8c-1.392-3.179-4.823-5-8.522-5C7.299 3 3.453 6.552 3 11.1' />
                                    <path
                                        d='M16.489 8.4h3.97A.54.54 0 0 0 21 7.86V3.9M3.5 16c1.392 3.179 4.823 5 8.522 5 4.679 0 8.525-3.552 8.978-8.1' />
                                    <path d='M7.511 15.6h-3.97a.54.54 0 0 0-.541.54v3.96' />
                                </svg>
                            </x-button>
                        </div>
                        <div class="col-span-4">
                            <x-button :type="'submit'" :color="'primary'" class="w-full h-full">Terapkan</x-button>
                        </div>
                    </div>
                </div>
                <div id="filterDropdown" class="border z-10 hidden w-96 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="grid grid-cols-6 gap-2">
                        <div class="col-span-3">
                            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                                Merk</h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                @foreach ($groupedMerk as $item)
                                    <li class="flex items-center">
                                        <input id="{{ $item->merk }}" type="checkbox" value="{{ $item->merk }}"
                                            name="merk[]"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            @if (request()->get('merk') != null) {{ in_array($item->merk, request()->get('merk')) ? 'checked' : '' }} @endif>
                                        <label for="{{ $item->merk }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ call_user_func($rowCallback, $item->merk, 'merk') }}
                                            ({{ $item->total }})
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-span-3">
                            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                                Tahun</h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                @foreach ($groupedTahun as $item)
                                    <li class="flex items-center">
                                        <input id="{{ $item->tahun }}" type="checkbox" value="{{ $item->tahun }}"
                                            name="tahun[]"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            @if (request()->get('tahun') != null) {{ in_array($item->tahun, request()->get('tahun')) ? 'checked' : '' }} @endif>
                                        <label id="{{ $item->tahun }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ call_user_func($rowCallback, $item->tahun, 'tahun') }}
                                            ({{ $item->total }})
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <x-button :type="'submit'" :color="'primary'" class="w-full mt-2">Terapkan</x-button>
                </div>
            </div>
        </form>
    </div>

    {{-- modal add --}}
    <form method="POST" action="{{ route('kendaraan.store') }}" id="form-add">
        @csrf
        @method('POST')
        <x-modal :id="'modal-add'" :title="'Tambah Kendaraan'">
            @slot('form')
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <x-form-input name="no_polisi" id="no_polisi-add" required="true" placeholder="Masukan No Polisi"
                            label="No Polisi" />
                    </div>
                    <div class="col-span-2">
                        <x-form-input name="nama_kendaraan" id="nama_kendaraan-add" required="true"
                            placeholder="Masukan Nama Kendaraan" label="Nama Kendaraan" />
                    </div>
                    <div class="col-span-2">
                        <x-form-input name="merk" id="merk-add" required="true" placeholder="Masukan Merk Kendaraan"
                            label="Merk Kendaraan" />
                    </div>
                    <div class="col-span-2">
                        <x-form-input name="tahun" id="tahun-add" required="true" type="number" placeholder="xxxx"
                            label="Tahun" />
                    </div>

                </div>
                <x-button :type="'submit'" :color="'primary'" class="w-full">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                    Tambahkan Kendaraan
                </x-button>
            @endslot
        </x-modal>
    </form>


    {{-- modal edit --}}
    <form method="POST" action="{{ route('kendaraan.update', 0) }}" id="form-edit">
        @csrf
        @method('PUT')
        <x-modal :id="'modal-edit'" :title="'Edit Kendaraan'">
            @slot('form')
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <x-form-input name="no_polisi" id="no_polisi-edit" required="true" placeholder="Masukan No Polisi"
                            label="No Polisi" />
                    </div>
                    <div class="col-span-2">
                        <x-form-input name="nama_kendaraan" id="nama_kendaraan-edit" required="true"
                            placeholder="Masukan Nama Kendaraan" label="Nama Kendaraan" />
                    </div>
                    <div class="col-span-2">
                        <x-form-input name="merk" id="merk-edit" required="true" placeholder="Masukan Merk Kendaraan"
                            label="Merk Kendaraan" />
                    </div>
                    <div class="col-span-2">
                        <x-form-input name="tahun" id="tahun-edit" required="true" type="number" placeholder="xxxx"
                            label="Tahun" />
                    </div>
                </div>
                <x-button :type="'submit'" :color="'primary'" class="w-full">
                    <svg class="me-1 -ms-1 w-5 h-5" width="24" height="24" fill="none" stroke="currentColor"
                        stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d='M4 21h16M5.666 13.187A2.28 2.28 0 0 0 5 14.797V18h3.223c.604 0 1.183-.24 1.61-.668l9.5-9.505a2.28 2.28 0 0 0 0-3.22l-.938-.94a2.277 2.277 0 0 0-3.222.001z' />
                    </svg>
                    Edit Kendaraan
                </x-button>
            @endslot
        </x-modal>
    </form>

    <form action="{{ route('kendaraan.destroy', 0) }}" method="post" id="form-delete">
        @csrf
        @method('DELETE')
        <x-modal :id="'modal-delete'" :title="'Hapus Kendaraan'">
            @slot('form')
                <div class="grid gap-4 mt-4 mb-8 grid-cols-2">
                    <div class="col-span-2 text-muted-foreground text-center">Apakah anda yakin ingin menghapus
                        kendaraan
                        ini?</div>
                </div>
                <div class="flex gap-4">
                    <x-button :type="'button'" :color="'secondary'" class="w-full" data-modal-toggle="modal-delete">
                        Tidak
                    </x-button>
                    <x-button :type="'submit'" :color="'danger'" class="w-full">
                        <svg class="me-1 -ms-1 w-5 h-5" width="24" height="24" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                            xmlns="http://www.w3.org/2000/svg" class="size-5">
                            <path
                                d='m18 7-.886 10.342c-.111 1.29-.166 1.936-.453 2.424a2.5 2.5 0 0 1-1.078.99c-.511.244-1.16.244-2.455.244h-2.256c-1.296 0-1.944 0-2.455-.244a2.5 2.5 0 0 1-1.078-.99c-.287-.488-.342-1.134-.453-2.424L6 7m-1.5-.5h4.615m0 0 .386-2.672c.112-.486.516-.828.98-.828h3.038c.464 0 .867.342.98.828l.386 2.672m-5.77 0h5.77m0 0H19.5' />
                        </svg>
                        Hapus Kendaraan
                    </x-button>
                </div>
            @endslot
        </x-modal>
    </form>
@endsection

@push('scripts')
    <script>
        function defaultResetSort() {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('sort');
            urlParams.delete('sortBy');
            window.location.search = urlParams.toString();
        };
    </script>
@endpush
