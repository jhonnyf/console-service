<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Console</a></li>
                <li class="breadcrumb-item">
                    @if (is_null($id) === false)
                        <a href="{{ route("{$route}.index", request()->all()) }}">{{ $name }}</a>
                    @else
                        {{ $name }}
                    @endif
                </li>
                @if (is_null($id) === false)
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                @endif                
            </ol>
        </nav>
        <h4 class="mb-1 mt-0">{{ $name }}</h4>
    </div>
</div>