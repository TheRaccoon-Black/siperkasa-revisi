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
        <span class="text-sm font-medium text-muted-foreground">Rekap Pemeriksaan</span>
    </div>
@endsection

@section('content')
    <div class="w-full p-4 bg-card rounded-lg border sm:p-8">
        <h5 class="mb-2 text-xl font-bold text-card-foreground">Rekap Pemeriksaan</h5>
        <p class="mb-5 text-sm text-muted-foreground">
            Rekap pemeriksaan ini menampilkan seluruh pemeriksaan yang terdaftar di dalam sistem.<br
                class="hidden sm:block">
            Anda dapat melihat detail pemeriksaan disini.
        </p>
        <form method="GET" action="{{ route('pemeriksaan.recap') }}">
            <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                <x-datatable :columns="['No', 'Keterangan Hasil', 'Tanggal', 'Dinas', 'Petugas', 'Kendaraan']" :rows="$pemeriksaans" :search="true" :fields="['id_hasil', 'tanggal', 'dinas', 'id_petugas', 'id_kendaraan']" :colAction="['detail']"
                    :rowCallback="$rowCallback" :detailRoute="'pemeriksaan.cetak'" :detailId="'id_hasil'">

                    @slot('button')
                        <div class="col-span-6 sm:col-span-3">
                            <x-button id="daterangeDropdownButton" data-dropdown-ignore-click-outside-class="datepicker"
                                class="w-full" data-dropdown-toggle="daterangeDropdown" :color="'secondary'">
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2">
                                    <path
                                        d='M7.527 20.841C6.861 21.274 6 20.772 6 19.952V3.942c0-.52.336-.942.75-.942h10.5c.414 0 .75.422.75.942v16.01c0 .82-.861 1.322-1.527.89l-3.946-2.562a.96.96 0 0 0-1.054 0z' />
                                </svg>
                                Pilih Tanggal

                                @if (request()->get('startDate') != null && request()->get('endDate') != null)
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
                                Dinas</h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                @foreach ($groupedDinas as $item)
                                    <li class="flex items-center">
                                        <input id="{{ $item->dinas }}" type="checkbox" value="{{ $item->dinas }}"
                                            name="dinas[]"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            @if (request()->get('dinas') != null) {{ in_array($item->dinas, request()->get('dinas')) ? 'checked' : '' }} @endif>
                                        <label for="{{ $item->dinas }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ call_user_func($rowCallback, $item->dinas, 'dinas') }}
                                            ({{ $item->total }})
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <x-button :type="'submit'" :color="'primary'" class="w-full mt-2">Terapkan</x-button>
                </div>
                <div id="daterangeDropdown"
                    class="border z-10 hidden w-96 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="grid grid-cols-6 gap-2">
                        <div class="col-span-6">
                            <h6 class="mb-1 text-sm font-medium text-gray-900 dark:text-white"> Pilih Jarak Tanggal</h6>
                        </div>
                        <div class="col-span-6">
                            <div id="date-range-picker" date-rangepicker datepicker-autohide class="flex items-center">
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg width="24" height="24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                            stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"
                                            class="size-5 text-gray-500 dark:text-gray-400">
                                            <path
                                                d='M16.5 5V3m-9 2V3M3.25 8h17.5M3 10.044c0-2.115 0-3.173.436-3.981a3.9 3.9 0 0 1 1.748-1.651C6.04 4 7.16 4 9.4 4h5.2c2.24 0 3.36 0 4.216.412.753.362 1.364.94 1.748 1.65.436.81.436 1.868.436 3.983v4.912c0 2.115 0 3.173-.436 3.981a3.9 3.9 0 0 1-1.748 1.651C17.96 21 16.84 21 14.6 21H9.4c-2.24 0-3.36 0-4.216-.412a3.9 3.9 0 0 1-1.748-1.65C3 18.128 3 17.07 3 14.955z' />
                                        </svg>
                                    </div>
                                    <input id="datepicker-range-start" name="startDate" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Tanggal Awal" value="{{ request()->get('startDate') }}">
                                </div>
                                <span class="mx-4 text-gray-500">-</span>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg width="24" height="24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                            stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"
                                            class="size-5 text-gray-500 dark:text-gray-400">
                                            <path
                                                d='M16.5 5V3m-9 2V3M3.25 8h17.5M3 10.044c0-2.115 0-3.173.436-3.981a3.9 3.9 0 0 1 1.748-1.651C6.04 4 7.16 4 9.4 4h5.2c2.24 0 3.36 0 4.216.412.753.362 1.364.94 1.748 1.65.436.81.436 1.868.436 3.983v4.912c0 2.115 0 3.173-.436 3.981a3.9 3.9 0 0 1-1.748 1.651C17.96 21 16.84 21 14.6 21H9.4c-2.24 0-3.36 0-4.216-.412a3.9 3.9 0 0 1-1.748-1.65C3 18.128 3 17.07 3 14.955z' />
                                        </svg>
                                    </div>
                                    <input id="datepicker-range-end" name="endDate" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Tanggal Akhir" value="{{ request()->get('endDate') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-6 gap-2 mt-2">
                        <div class="col-span-1">
                            <x-button :type="'button'" :color="'primary'" class="w-full"
                                onclick="defaultResetDaterange()">
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
                        <div class="col-span-5">
                            <x-button :type="'submit'" :color="'primary'" class="w-full h-full">Terapkan</x-button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function defaultResetSort() {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('sort');
            urlParams.delete('sortBy');
            window.location.search = urlParams.toString();
        };

        function defaultResetDaterange() {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('startDate');
            urlParams.delete('endDate');
            window.location.search = urlParams.toString();
        };
    </script>
@endpush
