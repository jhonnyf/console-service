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
                    <div class="row">
                        @foreach ($addresses as $address)
                            <div class="col-md-3 address">
                                {{ $address->zipcode }} <br>
                                {{ $address->address }}, {{ $address->number }} {{ $address->complement }} <br>
                                {{ $address->district }}, {{ $address->city }} - {{ $address->state }} <br>
                                {{ $address->country }}

                                <div class="d-flex mt-3">
                                    <a href="{{ route('user.address', ['id' => $id, 'address_id' => $address->id]) }}" class="mr-3"><i data-feather="edit-2" class="icon-sm"></i></a>
                                    <a href="{{ route('user.address', ['id' => $id, 'address_id' => $address->id]) }}"><i data-feather="trash-2" class="icon-sm"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">                           
                    {!! $form !!}
                </div>
            </div>
        </div>
    </div>
@endsection