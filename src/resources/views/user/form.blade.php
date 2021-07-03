@extends('console-service::layouts.vertical')

@section('breadcrumb')
    <x-console-service-breadcrumb :id="$id" :route="$route" :name="$name" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">       

                    <x-console-service-nav :id="$id" :nav="$nav" />

                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane show active" id="main">
                            <x-console-service-form-fields :formFields="$formFields" :id="$id" :route="$route" :extraData="$extraData" />
                        </div>
                    </div>                    

                </div>
            </div>
        </div>
    </div>
@endsection