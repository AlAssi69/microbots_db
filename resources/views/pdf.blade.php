<table style="width: 100%; text-align: center;" border="1">
    <tr>
        @foreach ($columns as $column)
            <th>{{ $column }}</th>
        @endforeach
    </tr>
    @foreach ($records as $item)
        <tr>
            @foreach ($columns as $column)
                <td>{{ $item->{$column} }}</td>
            @endforeach
        </tr>
    @endforeach
</table>
