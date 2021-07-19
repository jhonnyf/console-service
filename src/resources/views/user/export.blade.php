<table>
    <thead>
        <tr>                
            @foreach ($tableFields as $colums)
                @foreach ($colums as $column)
                    <th>{{ $column['name'] }}</th>    
                @endforeach
            @endforeach
        </tr>
    </thead>
    <tbody>
        @if (count($tableValues) > 0)
                @foreach ($tableValues as $row)
                    <tr>
                        @foreach ($tableFields as $table => $colums)
                            @foreach ($colums as $column)
                                @php
                                    $rowItem = $row;

                                    if ($table == 'users_extensions') {
                                        $rowItem = $row->extension;
                                    }

                                    if ($table == 'users_addresses') {
                                        $rowItem = $row->addresses->first();
                                    }

                                @endphp
                                <td> {{ \SenventhCode\ConsoleService\App\Services\TableFieldsService::format($rowItem, $column) }}</td>
                            @endforeach
                        @endforeach
                    </tr>
                @endforeach
            @endif        
    </tbody>
</table>