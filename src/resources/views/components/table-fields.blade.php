<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover mb-0">
        <thead>
            <tr>                
                @foreach ($tableFields as $colum)
                    @php
                        $label = isset($colum['label']) ? $colum['label'] : $colum['name'];
                    @endphp
                    <th scope="col">{{ $label }}</th>    
                @endforeach
                <th scope="col" style="width: 150px">Ações</th>    
            </tr>
        </thead>
        <tbody>
            @if (count($tableValues) > 0)
                @foreach ($tableValues as $row)
                    <tr>
                        @foreach ($tableFields as $column)
                            <td>{{ \SenventhCode\ConsoleService\App\Services\TableFieldsService::format($row, $column) }}</td>
                        @endforeach
                        <td class="text-center">
                            @php
                                $params_form = ['id' => $row->id];
                                if(isset($extraData) && count($extraData) > 0){
                                    $params_form = array_merge($params_form, $extraData);
                                }                                
                            @endphp
                            @if (method_exists($row, 'files'))
                                @php
                                    $files = $row->files();
                                @endphp
                                @if ($files->exists())
                                    @php
                                        $file = $files->where('file_gallery_id', 1)->get()->last();
                                    @endphp
                                    <a href="{{ route('file.download', ['id' => $file->id]) }}" target="_blank">
                                        <i data-feather="download" class="icon-sm"></i>
                                    </a>    
                                @endif 
                            @endif                           
                            <a href="{{ route("{$route}.form", $params_form) }}">
                                <i data-feather="edit-2" class="icon-sm"></i>
                            </a>                            
                            <a href="{{ route("{$route}.active", ['id' => $row->id]) }}">
                                <i data-feather="{{ $row->active == 1 ? 'check-circle' : 'circle'}}" class="icon-sm"></i>    
                            </a>                            
                            <a href="{{ route("{$route}.destroy", ['id' => $row->id]) }}">
                                <i data-feather="trash-2" class="icon-sm"></i>
                            </a>
                        </td>                                            
                    </tr>
                @endforeach
            @else

            @endif
            
        </tbody>
    </table>
</div>