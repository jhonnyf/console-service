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
                $usersTypes = \App\Models\Category::find(2)->secondary;                
            @endphp
            @if ($usersTypes->count() > 0)
                @foreach ($usersTypes as $item)
                    <li>
                        <a href="{{ route('user.index', ['category_id' => $item->id ]) }}">{{ $item->contents->first()->title }}</a>
                    </li>
                @endforeach
            @endif            
        </ul>
    </li>
    <li>
        <a href="{{ route('category.index') }}">
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
                $usersTypes = \App\Models\Category::find(3)->secondary;                
            @endphp
            @if ($usersTypes->count() > 0)
                @foreach ($usersTypes as $item)
                    <li>
                        <a href="{{ route('content.index', ['category_id' => $item->id ]) }}">{{ $item->contents->first()->title }}</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </li>    
    {{-- <li class="menu-title">Configurações</li>
    <li>
        <a href="{{ route('language.index') }}">
            <i data-feather="mic"></i>
            <span>Linguagem</span>            
        </a>        
    </li>
    <li>
        <a href="{{ route('file-gallery.index') }}">
            <i data-feather="file-plus"></i>
            <span>Tipo de galeria</span>            
        </a>        
    </li> --}}
</ul>
