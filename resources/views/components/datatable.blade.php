<!-- Start coding here -->
<div class="w-full relative sm:rounded-lg overflow-hidden">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 py-4 px-1">
        <div class="w-full md:w-1/2">
            @if ($search)
                <form class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="simple-search" name="search"
                            value="{{ request()->get('search') ?? '' }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Search">
                    </div>
                </form>
            @endif
        </div>
        <div
            class="w-full grid gap-2 lg:gap-0 grid-cols-6 lg:w-auto lg:flex lg:flex-row lg:space-y-0 lg:items-center lg:justify-end lg:space-x-3 lg:flex-shrink-0">

            {{ $addButton ?? '' }}

            {{ $exportButton ?? '' }}

            {{ $importButton ?? '' }}

            {{ $printButton ?? '' }}

            {{ $sortButton ?? '' }}

            {{ $filterButton ?? '' }}

            {{ $button ?? '' }}

        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left ">
            <thead class="text-xs text-sidebar-foreground uppercase bg-sidebar-background">
                <tr>
                    @foreach ($columns as $col)
                        <th scope="col" class="px-4 py-3">{{ $col }}</th>
                    @endforeach
                    @if ($colAction)
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 1;
                @endphp

                @if ($rows->isEmpty())
                    <tr class="border-b dark:border-gray-700">
                        <td colspan="{{ $colAction ? count($columns) + 1 : count($columns) }}"
                            class="px-4 py-3 text-center">Tidak ada data.</td>
                    </tr>
                @endif

                @foreach ($rows as $row)
                    <tr class="border-b dark:border-gray-700">
                        <th scope="row"
                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $index++ }}
                        </th>
                        @foreach ($fields as $field)
                            <td class="px-4 py-3">
                                {!! $rowCallback ? call_user_func($rowCallback, $row->{$field}, $field) : $row->{$field} !!}
                            </td>
                        @endforeach

                        @if ($colAction)
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button id="{{ $row->id }}-dropdown-button"
                                    data-dropdown-toggle="{{ $row->id }}-dropdown" data-dropdown-placement="left"
                                    class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                    type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div id="{{ $row->id }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 !mr-1">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="{{ $row->id }}-dropdown-button">
                                        {{ $dropdown ?? '' }}
                                        @if (in_array('detail', $colAction) && $detailRoute)
                                            <li>
                                                <a href="{{ route($detailRoute, $detailId ? $row->{$detailId} : $row->id) }}"
                                                    data-id="{{ $row->id }}"
                                                    class="flex w-full gap-2 text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    <svg width="24" height="24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        xmlns="http://www.w3.org/2000/svg" class="size-5">
                                                        <path
                                                            d='M9.713 3.64c.581-.495.872-.743 1.176-.888a2.58 2.58 0 0 1 2.222 0c.304.145.595.393 1.176.888.599.51 1.207.768 2.007.831.761.061 1.142.092 1.46.204.734.26 1.312.837 1.571 1.572.112.317.143.698.204 1.46.063.8.32 1.407.83 2.006.496.581.744.872.889 1.176.336.703.336 1.52 0 2.222-.145.304-.393.595-.888 1.176a3.3 3.3 0 0 0-.831 2.007c-.061.761-.092 1.142-.204 1.46a2.58 2.58 0 0 1-1.572 1.571c-.317.112-.698.143-1.46.204-.8.063-1.407.32-2.006.83-.581.496-.872.744-1.176.889a2.58 2.58 0 0 1-2.222 0c-.304-.145-.595-.393-1.176-.888a3.3 3.3 0 0 0-2.007-.831c-.761-.061-1.142-.092-1.46-.204a2.58 2.58 0 0 1-1.571-1.572c-.112-.317-.143-.698-.204-1.46a3.3 3.3 0 0 0-.83-2.006c-.496-.581-.744-.872-.89-1.176a2.58 2.58 0 0 1 .001-2.222c.145-.304.393-.595.888-1.176.52-.611.769-1.223.831-2.007.061-.761.092-1.142.204-1.46a2.58 2.58 0 0 1 1.572-1.571c.317-.112.698-.143 1.46-.204a3.3 3.3 0 0 0 2.006-.83' />
                                                        <path d='M12 16v-5h-.5m0 5h1M12 8.5V8' />
                                                    </svg> Detail
                                                </a>
                                            </li>
                                        @endif
                                        @if (in_array('edit', $colAction))
                                            <li>
                                                <button type="button" data-id="{{ $row->id }}"
                                                    @foreach ($fields as $field) data-{{ $field }}="{{ $row->{$field} }}" @endforeach
                                                    class="flex w-full gap-2 text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                    onclick="{{ $editFunctionName ?? 'defaultEditFunction' }}({
                                                        id: this.getAttribute('data-id'),
                                                        @foreach ($fields as $field)
                                                            '{{ $field }}': this.getAttribute('data-{{ $field }}'), @endforeach
                                                    })"
                                                    data-modal-target="modal-edit" data-modal-toggle="modal-edit">
                                                    <svg width="24" height="24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        xmlns="http://www.w3.org/2000/svg" class="size-5">
                                                        <path
                                                            d='M9.533 11.15A1.82 1.82 0 0 0 9 12.438V15h2.578c.483 0 .947-.192 1.289-.534l7.6-7.604a1.82 1.82 0 0 0 0-2.577l-.751-.751a1.82 1.82 0 0 0-2.578 0z' />
                                                        <path
                                                            d='M21 12c0 4.243 0 6.364-1.318 7.682S16.242 21 12 21s-6.364 0-7.682-1.318S3 16.242 3 12s0-6.364 1.318-7.682S7.758 3 12 3' />
                                                    </svg> Edit
                                                </button>
                                            </li>
                                        @endif
                                    </ul>
                                    @if (in_array('delete', $colAction))
                                        <div class="py-1 text-red-primary">
                                            <button type="button" data-id="{{ $row->id }}"
                                                class="flex w-full gap-2 text-left py-2 px-4 text-sm bg-white hover:bg-secondary dark:hover:bg-gray-600"
                                                onclick="{{ $deleteFunctionName ?? 'defaultDeleteFunction' }}({
                                                        id: this.getAttribute('data-id')
                                                })"
                                                data-modal-target="modal-delete" data-modal-toggle="modal-delete">
                                                <svg width="24" height="24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                                    stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"
                                                    class="size-5">
                                                    <path
                                                        d='m18 7-.886 10.342c-.111 1.29-.166 1.936-.453 2.424a2.5 2.5 0 0 1-1.078.99c-.511.244-1.16.244-2.455.244h-2.256c-1.296 0-1.944 0-2.455-.244a2.5 2.5 0 0 1-1.078-.99c-.287-.488-.342-1.134-.453-2.424L6 7m-1.5-.5h4.615m0 0 .386-2.672c.112-.486.516-.828.98-.828h3.038c.464 0 .867.342.98.828l.386 2.672m-5.77 0h5.77m0 0H19.5' />
                                                </svg> Hapus
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $rows->links() }}
</div>

@push('scripts')
    {{ $editScript ?? '' }}
    {{ $deleteScript ?? '' }}
@endpush
