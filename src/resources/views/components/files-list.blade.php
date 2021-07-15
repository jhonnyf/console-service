<div class="row">  
    @foreach ($files as $file)
        <x-console-service-file-item :file="$file"/>               
    @endforeach
</div>