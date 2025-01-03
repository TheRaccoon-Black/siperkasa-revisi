@extends('layouts.auth.app')

@section('title', 'Daftar Petugas')

@section('breadcrumbs')
    <div class="flex items-center gap-2 text-gray-900">
        <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:underline">Dashboard</a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 shrink-0">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </div>
        <span class="text-sm font-medium text-muted-foreground">Petugas</span>
    </div>
@endsection

@section('content')
    <div class="w-full p-4 bg-card rounded-lg border sm:p-8">
        <h5 class="mb-2 text-xl font-bold text-card-foreground">Daftar Petugas</h5>
        <p class="mb-5 text-sm text-muted-foreground">
            Daftar petugas ini menampilkan seluruh petugas yang terdaftar di dalam sistem.<br class="hidden sm:block"> Anda
            dapat mengelola data petugas
            disini.
        </p>
        <form method="GET" action="{{ route('petugas.index') }}">
            <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                <x-datatable :columns="['No', 'Nama Petugas', 'Regu', 'ID Petugas']" :rows="$petugas" :search="true" :fields="['nama_petugas', 'regu', 'petugas_id']" :colAction="['edit', 'delete']">
                    @slot('addButton')
                        <div class="col-span-6">
                            <x-button :color="'secondary'" class="w-full" data-modal-target="modal-add"
                                data-modal-toggle="modal-add">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Tambah Petugas
                            </x-button>
                        </div>
                    @endslot

                    @slot('filterButton')
                        <div class="col-span-6">
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
                                const url = "{{ route('petugas.update', ['id' => '__id__']) }}".replace('__id__', data.id);

                                const form = document.getElementById('form-edit');
                                const inputUserId = document.getElementById('user_id-edit');
                                const inputRegu = document.getElementById('regu-edit');
                                const inputPetugasId = document.getElementById('petugas_id-edit');

                                inputUserId.value = parseInt(data.id) + 1;
                                inputRegu.value = data.regu;
                                inputPetugasId.value = data.petugas_id;

                                form.action = url;
                            }
                        </script>
                    @endslot

                    @slot('deleteScript')
                        <script>
                            function defaultDeleteFunction(data) {
                                const url = "{{ route('petugas.destroy', ['id' => '__id__']) }}".replace('__id__', data.id);

                                const form = document.getElementById('form-delete');

                                form.action = url;
                            }
                        </script>
                    @endslot
                </x-datatable>
                <div id="filterDropdown" class="border z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                        Filter Regu</h6>
                    <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                        @foreach ($grouped as $item)
                            <li class="flex items-center">
                                <input id="{{ $item->regu }}" type="checkbox" value="{{ $item->regu }}" name="regu[]"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                    @if (request()->get('regu') != null) {{ in_array($item->regu, request()->get('regu')) ? 'checked' : '' }} @endif>
                                <label for="{{ $item->regu }}"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $item->regu }} ({{ $item->total }})
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <x-button :type="'submit'" :color="'primary'" class="w-full mt-2">Terapkan</x-button>
                </div>
                {{-- {{$users_edit}} --}}
            </div>
        </form>
    </div>

    {{-- modal add --}}
    <form method="POST" action="{{ route('petugas.store') }}" id="form-add">
        @csrf
        @method('POST')
        <x-modal :id="'modal-add'" :title="'Tambah Petugas'">
            @slot('form')
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <x-form-select name="user_id" id="user_id-add" required="true" label="Nama Petugas">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </x-form-select>
                    </div>
                    <div class="col-span-2">
                        <x-form-input name="regu" id="regu-add" required="true" placeholder="Masukan Regu" label="Regu" />
                    </div>
                    <div class="col-span-2">
                        <x-form-input name="petugas_id" id="petugas_id-add" required="true" placeholder="Masukan ID Petugas"
                            label="ID Petugas" />
                    </div>
                </div>
                <x-button :type="'submit'" :color="'primary'" class="w-full">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                    Tambahkan Petugas
                </x-button>
            @endslot
        </x-modal>
    </form>

    {{-- modal edit --}}
    <form method="POST" action="{{ route('petugas.update', 0) }}" id="form-edit">
        @csrf
        @method('PUT')
        <x-modal :id="'modal-edit'" :title="'Edit Petugas'">
            @slot('form')
                <div class="grid gap-4 mb-4 grid-cols-2">
                    {{-- <div class="col-span-2">
                        <x-form-select name="user_id" id="user_id-edit" required="true" label="Nama Petugas"> --}}
                    {{-- <option value="" disabled selected>Pilih Nama Petugas</option> --}}
                    {{-- @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach

                        </x-form-select>
                    </div> --}}
                    <div class="col-span-2">
                        <x-form-input name="user_id" id="user_id-edit" required="true" placeholder="Nama Petugas"
                            label="Petugas" />
                    </div>
                    <div class="col-span-2">
                        <x-form-input name="regu" id="regu-edit" required="true" placeholder="Masukan Regu"
                            label="Regu" />
                    </div>
                    <div class="col-span-2">
                        <x-form-input name="petugas_id" id="petugas_id-edit" required="true"
                            placeholder="Masukan ID Petugas" label="ID Petugas" />
                    </div>
                </div>
                <x-button :type="'submit'" :color="'primary'" class="w-full">
                    <svg class="me-1 -ms-1 w-5 h-5" width="24" height="24" fill="none" stroke="currentColor"
                        stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d='M4 21h16M5.666 13.187A2.28 2.28 0 0 0 5 14.797V18h3.223c.604 0 1.183-.24 1.61-.668l9.5-9.505a2.28 2.28 0 0 0 0-3.22l-.938-.94a2.277 2.277 0 0 0-3.222.001z' />
                    </svg>
                    Edit Petugas
                </x-button>
            @endslot
        </x-modal>
    </form>

    <form action="{{ route('petugas.destroy', 0) }}" method="post" id="form-delete">
        @csrf
        @method('DELETE')
        <x-modal :id="'modal-delete'" :title="'Hapus Petugas'">
            @slot('form')
                <div class="grid gap-4 mt-4 mb-8 grid-cols-2">
                    <div class="col-span-2 text-muted-foreground text-center">Apakah anda yakin ingin menghapus
                        petugas
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
                        Hapus Petugas
                    </x-button>
                </div>
            @endslot
        </x-modal>
    </form>
@endsection
