@if ($coins->exists())
    <ul class="nav nav-pills navtab-bg nav-justified mb-3">
        @foreach ($coins->get() as $coin)
            <li class="nav-item">
                @php
                    $route_params['coin_id'] = $coin->id;
                @endphp                
                <a {{ in_array('ajax-item', $class_item) ? 'data-url=' . route($route, $route_params) :  'href=' . route($route, $route_params) }} class="nav-link {{ implode(' ', $class_item) }} {{ $coin_id == $coin->id ? 'active' : '' }}">
                    {{ $coin->coin }}
                </a>
            </li>
        @endforeach 
    </ul>    
@endif