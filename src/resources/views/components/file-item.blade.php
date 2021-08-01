<div class="file col-md-4 mb-3">         
    <div class="file-thumb">
        <div class="text-center container-image">
            @if (strpos($file->mime_type, 'image') !== false)
                <img src="{{ asset("storage/{$file->file_path}") }}" class="img-fluid img-thumbnail">   
            @else                
                <i data-feather="file-text"></i>            
            @endif        
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('file.form', ['id' => $file->id]) }}" class="btn btn-light act-form"><i data-feather="edit"></i></a>
            <a href="{{ route('file.active', ['id' => $file->id]) }}" class="btn btn-light act-active">{!! $file->active  === 1 ? '<i data-feather="check-circle"></i>' : '<i data-feather="circle"></i>' !!}</a>
            <a href="{{ route('file.destroy', ['id' => $file->id]) }}" class="btn btn-light act-destroy"><i data-feather="trash"></i></a>
        </div>
    </div>
</div>