@extends('layouts.auth.app')

@section('breadcrumbs')
    <div class="flex items-center gap-2 text-gray-900">
        <span class="text-sm font-medium text-muted-foreground">Dashboard</span>
    </div>
@endsection

@section('content')
    <div class="w-full p-4 bg-card rounded-lg border sm:p-8">
        <h5 class="mb-2 text-2xl font-bold text-card-foreground">Dashboard</h5>
        <p class="mb-5 text-sm text-muted-foreground">
            Selamat datang di {{ env('APP_NAME', 'Laravel') }}.
        </p>
        <hr class="py-4">
        <div class="w-full grid grid-cols-6 sm:grid-cols-12 gap-4">
            <div class="w-full col-span-6 sm:col-span-12">
                <div class="flex justify-between ">
                    <div>
                        <h5
                            class="leading-none flex justify-start items-center text-3xl font-bold text-gray-900 dark:text-white pb-2">
                            {{ $pemeriksaanCount }}
                            <span>
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                    xmlns="http://www.w3.org/2000/svg" style="size-5">
                                    <path d='M19 11.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0m-2.107 5.42 3.08 3.08' />
                                    <path d='M11.5 13.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4' />
                                </svg>
                            </span>
                        </h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Pemeriksaan Tercatat</p>
                    </div>
                    @if (Auth::user()->role == 'admin')
                        <div>
                            <h5
                                class="leading-none flex justify-start items-center text-3xl font-bold text-gray-900 dark:text-white pb-2">
                                {{ $petugasCount }}<span>
                                    <svg width="24" height="24" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                        stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" style="size-5">
                                        <path
                                            d='M5 20.25c0 .414.336.75.75.75h10.652C17.565 21 18 20.635 18 19.4v-1.445M5 20.25A2.25 2.25 0 0 1 7.25 18h10.152q.339 0 .598-.045M5 20.25V6.2c0-1.136-.072-2.389 1.092-2.982C6.52 3 7.08 3 8.2 3h9.2c1.236 0 1.6.437 1.6 1.6v11.8c0 .995-.282 1.425-1 1.555' />
                                        <path d='M15 14c0-3.861-6-3.861-6 0' />
                                        <path d='M12 11a2 2 0 1 0 0-4 2 2 0 0 0 0 4' />
                                    </svg>
                                </span></h5>
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                Petugas Terdaftar
                            </p>
                        </div>
                    @endif

                </div>
                <div id="area-chart"></div>
                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">

                        <button data-dropdown-toggle="lastDaysdropdown" data-dropdown-placement="bottom"
                            class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                            type="button">
                            {{ match (request()->get('chartDate')) {
                                'week' => '7 Hari Terakhir',
                                'month' => '30 Hari Terakhir',
                                'year' => 'Setahun Terakhir',
                                default => '7 Hari Terakhir',
                            } }}
                            <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <div id="lastDaysdropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <a href="{{ route('dashboard') }}?chartDate=week"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">7
                                        Hari Terakhir</a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard') }}?chartDate=month"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">30
                                        Hari Terakhir</a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard') }}?chartDate=year"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Setahun
                                        Terakhir</a>
                                </li>
                            </ul>
                        </div>

                        <a href="{{ route('pemeriksaan.recap') }}"
                            class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                            Lihat Semua Pemeriksaan
                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        const data = @json($chartData)

        const options = {
            chart: {
                height: "100%",
                maxWidth: "100%",
                type: "area",
                fontFamily: "Geits, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 6,
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: 0
                },
            },
            series: [{
                name: "Pemeriksaan",
                data: data.map((d) => d.count),
                color: "#1A56DB",
            }, ],
            xaxis: {
                categories: data.map((d) => d.label),
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
        }


        if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("area-chart"), options);
            chart.render();
        }
    </script>
@endpush
