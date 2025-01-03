@extends('layouts.auth.app')

@push('styles')
    <style>
        .pdf-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100dvh;
        }

        .pdf-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
@endpush

@section('breadcrumbs')
    <div class="flex items-center gap-2 text-gray-900">
        <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:underline">Dashboard</a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 shrink-0">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </div>
        <span class="text-sm font-medium text-muted-foreground">Lihat SOP</span>
    </div>
@endsection

@section('content')
    <div class="pdf-container">
        <iframe src="{{ $pdfPath }}" title="PDF Viewer"></iframe>
    </div>
@endsection


@push('scripts')
    <script src="//mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>
    <script type="module">
        var {
            pdfjsLib
        } = globalThis;

        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.mjs';

        var loadingTask = pdfjsLib.getDocument('{{ $pdfPath }}');

        loadingTask.promise.then(function(pdf) {
            var pageNumber = 1;
        })
    </script>
@endpush
