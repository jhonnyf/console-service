@if ($languages->exists())
    <ul class="nav nav-pills navtab-bg nav-justified mb-3">
        @foreach ($languages->get() as $language)
            <li class="nav-item">
                @php
                    $route_params['language_id'] = $language->id;
                @endphp                
                <a {{ in_array('ajax-item', $class_item) ? 'data-url=' . route($route, $route_params) :  'href=' . route($route, $route_params) }} class="nav-link {{ implode(' ', $class_item) }} {{ $language_id == $language->id ? 'active' : '' }}">
                    {{ $language->language }}
                </a>
            </li>
        @endforeach 
    </ul>    
@endif