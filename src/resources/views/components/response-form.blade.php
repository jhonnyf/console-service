<div class="response-form">
    @if(Session::has('success'))
        <div class="alert alert-success mb-3">
            <p class="mb-0">{{ Session::get('success') }}</p>
        </div>
    @endif

    @if ($errors->any())                            
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <p class="mb-0">{{ $error }}</p>
            </div>
        @endforeach                        
    @endif
</div>