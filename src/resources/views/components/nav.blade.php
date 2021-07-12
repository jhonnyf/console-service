@php
    $currentUrl = url()->full(); 
@endphp

<ul class="nav flex-column">        
    @if (count($nav) > 0)
        @foreach ($nav as $item)
            <li class="nav-item mb-3">
                <a href="{{ $item['route'] }}" class="nav-link btn btn-light {{ $currentUrl == $item['route'] ? 'active' : '' }}">
                    <span class="d-block d-sm-none"><i class="uil-home-alt"></i></span>
                    <span class="d-none d-sm-block ">{{ $item['name'] }}</span>
                </a>    
            </li>
        @endforeach        
    @endif
</ul>
