@extends('console-service::layouts.vertical')

@section('breadcrumb')
    <x-console-service-breadcrumb :id="$id" :route="$route" :name="$name" />
@endsection

@section('nav')
    <x-console-service-nav :id="$id" :nav="$nav" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">                           
                    {!! $form !!}
                </div>
            </div>
        </div>
    </div>
@endsection