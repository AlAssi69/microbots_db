<table style="width: 100%; text-align: center;" border="1">
    <tr>
        @foreach ($columns as $column)
            @if (str($column)->contains('.'))
                @php
                    [$name, $dsa] = explode('.', $column);
                @endphp
                <th>{{ $name }}</th>
            @else
                <th>{{ $column }}</th>
            @endif
        @endforeach
    </tr>
    @foreach ($records as $item)
        <tr>
            @foreach ($columns as $column)
                <td>
                    @if (str($column)->contains('.'))
                        @php
                            [$relation, $field] = explode('.', $column);
                        @endphp
                        {{ $item->{$relation}?->{$field} }}
                    @else
                        {{ $item->{$column} }}
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
</table>
