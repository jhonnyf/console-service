@extends('console-service::layouts.vertical')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Console</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categoria</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Categoria</h4>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row structure-category">
                <x-console-service-categories-list :category="$category" />
            </div>
        </div>
    </div>

@endsection

@section('script-bottom')
    <script src="{{ URL::asset('console-service/assets/js/pages/category.js') }}"></script>
@endsection