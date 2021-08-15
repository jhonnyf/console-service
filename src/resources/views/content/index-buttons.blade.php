<div class="text-right mb-3">
    <a href="{{ route("{$route}.download", ['category_id' => $category_id, 'file_gallery_id' => 1]) }}" class="btn btn-primary width-lg"><i data-feather="download" class="icon-xs"></i> download de arquivos</a>
    <a href="{{ route("{$route}.export", ['category_id' => $category_id]) }}" class="btn btn-primary width-lg"><i data-feather="download" class="icon-xs"></i> exportar excel</a>
    <a href="{{ route("{$route}.form", ['category_id' => $category_id]) }}" class="btn btn-primary width-lg"><i data-feather="plus" class="icon-xs"></i> adicionar</a>
</div>