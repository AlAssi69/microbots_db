<table>
    <tr>
        <th>Test</th>
    </tr>
    @foreach ($records as $item)
        <tr>
            <td>{{ $item->name }}</td>
        </tr>
    @endforeach
</table>
