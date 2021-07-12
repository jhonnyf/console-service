@extends('console-service::layouts.vertical')

@section('breadcrumb')
    <x-console-service-breadcrumb :id="$link_id" :route="$route" :name="$name" />
@endsection

@section('nav')
    <x-console-service-nav :id="$link_id" :nav="$nav" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">      
                    
                    <ul class="nav nav-tabs mb-3">
                        @foreach ($filesGalleries as $fileGallery)
                            <li class="nav-item">
                                @php
                                    $route_params = request()->all();

                                    $route_params['module']  = $module;
                                    $route_params['link_id'] = $link_id;
                                    $route_params['file_gallery_id']  = $fileGallery->id;
                                    
                                @endphp
                                <a class="nav-link {{ $fileGallery->id == request()->get('file_gallery_id') ? 'active' : ''}}" aria-current="page" href="{{ route('file.list-galleries', $route_params) }}">{{ $fileGallery->file_gallery }}</a>
                            </li>                
                        @endforeach                
                    </ul>

                    @if($file_gallery_id > 0)
                        <form action="{{ route('file.upload-submit', ['module' => $module, 'link_id' => $link_id, 'file_gallery_id' => $file_gallery_id]) }}" method="POST" class="dropzone mt-3 mb-3">
                            @csrf
                            <div class="dz-message needsclick">
                                <i class="h1 text-muted  uil-cloud-upload"></i>
                                <h3>Solte os arquivos aqui ou clique para fazer o upload.</h3>
                                <span class="text-muted font-13">(Arquivos com no máximo 4MB)</span>
                            </div>
                        </form>    
                        
                        <div class="files-list">
                            <x-console-service-files-list :files="$files"/>
                        </div>
                    @else
                        <p class="text-center">Selecione uma galeria para fazer o upload do seu arquivo</p>
                    @endisset
                                    

                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('console-service/assets/libs/dropzone/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('console-service/assets/libs/fancybox/fancybox.min.css') }}">
@endsection

@section('script')
    <script src="{{ URL::asset('console-service/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('console-service/assets/libs/fancybox/fancybox.min.js') }}"></script>
    <script src="{{ URL::asset('console-service/assets/js/pages/files.js') }}"></script>
@endsection