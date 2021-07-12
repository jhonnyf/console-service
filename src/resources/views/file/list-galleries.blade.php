@extends('console-service::layouts.vertical')

@section('breadcrumb')
    <x-console-service-breadcrumb :id="$link_id" :route="$route" :name="$name" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">       

                    <x-console-service-nav :id="$link_id" :nav="$nav" />

                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane show active" id="main">                             
                            <p class="mb-0">Selecione abaixo uma galeria para fazer upload</p>
                        </div>
                    </div>                    

                </div>
            </div>

            @if ($filesGalleries->count() > 0)
                @foreach ($filesGalleries as $gallery)
                    <div class="card">
                        <div class="card-body">       
                            
                            <div class="row mb-4">
                                <div class="col">
                                    <h6 class="header-title">{{ $gallery['file_gallery'] }}</h6>
                                </div>
                                <div class="col text-right">
                                    <a href="javascript:;" data-url="{{ route('file.upload-form', ['module' => $module, 'link_id' => $link_id, 'file_gallery_id' => $gallery['id']]) }}" class="btn btn-primary open-upload">UPLOAD</a>
                                </div>
                            </div>      
                            
                            <div class="row">
                                @if ($entity->exists())
                                    @php
                                        $filesGallery = $entity->get()->toQuery()->where('file_gallery_id', $gallery['id']);
                                    @endphp
                                    @foreach ($filesGallery->get() as $file)
                                        
                                        <div class="col-4 mb-4">
                                            <img src="{{ asset("storage/{$file->file_path}") }}" class="img-fluid img-thumbnail mb-3">
                                            <div class="d-flex justify-content-around">
                                                <div>
                                                    <a data-url="{{ route('files.form', ['id' => $file->id]) }}" class="btn btn-dark btn-sm edit-form"><i data-feather="edit-2" class="icon-sm"></i></a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('files.active', ['id' => $file->id]) }}" class="btn btn-dark btn-sm"><i data-feather="{{ $file->active == 1 ? 'check-circle' : 'circle'}}" class="icon-sm"></i></a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('files.destroy', ['id' => $file->id]) }}" class="btn btn-dark btn-sm"><i data-feather="trash-2" class="icon-sm"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
        
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/fancybox/fancybox.min.css') }}">
@endsection

@section('script')
    <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/fancybox/fancybox.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/files.js') }}"></script>
@endsection