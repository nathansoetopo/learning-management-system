<table class="table">
    <thead>
        <tr>
            <th scope="col">Status</th>
            <th scope="col">Banyak</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $rec)
            <tr>
                <td>{{$rec->status}}</td>
                <td>{{$rec->presence_count}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
