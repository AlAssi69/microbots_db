<table>
    <tr>
        @foreach ($records->first()->getFillable() as $fillable)
            <th>{{ $fillable }}</th>
        @endforeach
    </tr>
    @foreach ($records as $item)
        <tr>
            @foreach ($item->getFillable() as $fillable)
                <td>{{ $item->{$fillable} }}</td>
            @endforeach
        </tr>
    @endforeach
</table>
