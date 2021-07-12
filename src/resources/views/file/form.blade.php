<div class="container p-0 bg-transparent">
    <div class="card mb-0">
        <div class="card-header text-right">
            <button data-fancybox-close class="bg-transparent fancybox-button fancybox-button--close" title="Fechar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 10.6L6.6 5.2 5.2 6.6l5.4 5.4-5.4 5.4 1.4 1.4 5.4-5.4 5.4 5.4 1.4-1.4-5.4-5.4 5.4-5.4-1.4-1.4-5.4 5.4z"/></svg>
            </button>
        </div>
        <div class="card-body">
            
            <x-nav-languages :route="$navLanguageRoute" :routeParams="$navLanguageRouteParams" :languageId="$language_id" :classItem="$classItem" />

            {!! $form !!}          
        </div>
    </div>
</div>