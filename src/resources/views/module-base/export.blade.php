<table class="table table-striped table-bordered table-hover mb-0">
    <thead>
        <tr>                
            @foreach ($tableFields as $colums)
                @foreach ($colums as $column)
                    @php
                        $label = isset($column['label']) ? $column['label'] : $column['name'];
                    @endphp
                    <th>{{ $label }}</th>
                @endforeach
            @endforeach   
        </tr>
    </thead>
    <tbody>
        @if (count($tableValues) > 0)
            @foreach ($tableValues as $row)
                <tr>
                    @foreach ($tableFields as $colums)
                        @foreach ($colums as $column)
                            <td> {{ \SenventhCode\ConsoleService\App\Services\TableFieldsService::format($row, $column) }}</td>
                        @endforeach
                    @endforeach
                </tr>
            @endforeach
        @endif            
    </tbody>
</table>