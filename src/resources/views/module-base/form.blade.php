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
                    @if ($enableLanguages)
                        <x-console-service-nav-languages :route="$navLanguageRoute" :routeParams="$navLanguageRouteParams" :languageId="$language_id" :classItem="$classItem" />    
                    @endif                    

                    {!! $form !!}
                </div>
            </div>
        </div>
    </div>
@endsection