@extends('console-service::layouts.vertical')

@section('breadcrumb')
    <x-console-service-breadcrumb :route="$route" :name="$name" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">           

                    <div class="text-right mb-3">
                        <a href="{{ route("{$route}.form", ['category_id' => $category_id]) }}" class="btn btn-primary width-lg"><i data-feather="plus" class="icon-xs"></i>adicionar</a>
                    </div>

                    <div class="mb-3 d-flex justify-content-end">
                        <form action="" class="form-inline" method="get" autocomplete="off">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" id="search" value="{{ $search }}" placeholder="Pesquisar">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-primary rounded-right">
                                            <i data-feather="search" class="icon-xs"></i>    
                                        </button>
                                    </div>
                                </div>                                    
                            </div>                                
                        </form>                    
                    </div>

                    <x-console-service-table-fields :tableFields="$tableFields" :tableValues="$tableValues" :route="$route" :extraData="$extraData" />
                    
                </div>
            </div>

        </div>
    </div>
@endsection