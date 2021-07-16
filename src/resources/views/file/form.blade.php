@extends('console-service::layouts.modal')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="container-content">
                <x-console-service-nav-languages :route="$navLanguageRoute" :routeParams="$navLanguageRouteParams" :languageId="$language_id" :classItem="$classItem" />

                {!! $form !!} 
            </div>
        </div>
    </div>  
@endsection