@extends('console-service::layouts.vertical')

@section('breadcrumb')
    <x-console-service-breadcrumb :id="$id" :route="$route" :name="$name" />
@endsection

@section('nav')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-body">
                    <x-console-service-nav :id="$id" :nav="$nav" />
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    @if (isset($enableLanguages) && $enableLanguages == true && $id > 0)
                        <x-console-service-nav-languages :route="$navLanguageRoute" :routeParams="$navLanguageRouteParams" :languageId="$language_id" :classItem="$classItem" />    
                    @endif                    

                    {!! $form !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('console-service/assets/libs/ckeditor/ckeditor.min.js') }}"></script>
@endsection