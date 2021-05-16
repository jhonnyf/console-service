<ul class="metismenu" id="menu-bar">   
    <li>
        <a href="{{ route('dashboard') }}">
            <i data-feather="home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="menu-title">Modulos</li>
    <li>
        <a href="javascript: void(0);">
            <i data-feather="users"></i>
            <span>Usuário</span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="nav-second-level" aria-expanded="false">
            @php
                $usersTypes = \App\Models\Categories::find(2)->categorySecondary;                
            @endphp
            @if ($usersTypes->count() > 0)
                @foreach ($usersTypes as $item)
                    <li>
                        <a href="{{ route('users.index', ['category_id' => $item->id ]) }}">{{ $item->contents->first()->title }}</a>
                    </li>
                @endforeach
            @endif            
        </ul>
    </li>
    <li>
        <a href="{{ route('categories.index') }}">
            <i data-feather="sliders"></i>
            <span>Categoria</span>            
        </a>        
    </li>
    <li>
        <a href="javascript: void(0);">
            <i data-feather="file-text"></i>
            <span>Conteúdo</span>
            <span class="menu-arrow"></span>          
        </a> 
        <ul class="nav-second-level" aria-expanded="false">
            @php
                $usersTypes = \App\Models\Categories::find(3)->categorySecondary;                
            @endphp
            @if ($usersTypes->count() > 0)
                @foreach ($usersTypes as $item)
                    <li>
                        <a href="{{ route('contents.index', ['category_id' => $item->id ]) }}">{{ $item->contents->first()->title }}</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </li>
    <li>
        <a href="{{ route('products.index') }}">
            <i data-feather="package"></i>
            <span>Produto</span>            
        </a>        
    </li>
    <li class="menu-title">Configurações</li>
    <li>
        <a href="{{ route('languages.index') }}">
            <i data-feather="mic"></i>
            <span>Linguagem</span>            
        </a>        
    </li>
    <li>
        <a href="{{ route('filesGalleries.index') }}">
            <i data-feather="file-plus"></i>
            <span>Tipo de galeria</span>            
        </a>        
    </li>
    <li>
        <a href="{{ route('coins.index') }}">
            <i data-feather="dollar-sign"></i>
            <span>Moeda</span>            
        </a>        
    </li>
</ul>
