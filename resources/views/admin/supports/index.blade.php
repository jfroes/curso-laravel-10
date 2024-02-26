<h1>Listagem dos Suportes</h1>


<table>
    <thead>
        <th>assunto</th>
        <th>status</th>
        <th>description</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($supports as $support)
            <tr>
                <td>{{$support -> subject}}</td>
                <td>{{$support -> status}}</td>
                <td>{{$support -> body}}</td>
                <td>
                   <a href="{{ route('supports.show', $support -> id)}}"> ir </a>
                   <a href="{{ route('supports.edit', $support -> id)}}"> editar </a>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
