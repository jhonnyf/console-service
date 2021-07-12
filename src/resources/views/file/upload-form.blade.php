<div class="container p-0 bg-transparent">
    <div class="card mb-0">
        <div class="card-header text-right">
            <button data-fancybox-close class="bg-transparent fancybox-button fancybox-button--close" title="Fechar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 10.6L6.6 5.2 5.2 6.6l5.4 5.4-5.4 5.4 1.4 1.4 5.4-5.4 5.4 5.4 1.4-1.4-5.4-5.4 5.4-5.4-1.4-1.4-5.4 5.4z"/></svg>
            </button>
        </div>
        <div class="card-body">
            <h4 class="header-title mt-0 mb-4">Upload de arquivos</h4>                                      

            <form action="{{ route('files.upload-submit', ['module' => $module, 'link_id' => $link_id, 'file_gallery_id' => $file_gallery_id]) }}" method="post" class="dropzone mb-3" id="dropzone-form">
                @csrf   
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>

                <div class="dz-message needsclick">
                    <i class="h1 text-muted  uil-cloud-upload"></i>
                    <h3>Solte os arquivos aqui ou clique para fazer o upload.</h3>                               
                </div>
            </form>
        </div>
    </div>
</div>