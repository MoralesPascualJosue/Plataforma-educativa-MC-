<div class="table-responsive">
    <table class="table" id="contenidos-table">
        <thead>
            <tr>
                <th>Curso Id</th>
        <th>Activitie Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contenidos as $contenido)
            <tr>
                <td>{{ $contenido->curso_id }}</td>
            <td>{{ $contenido->activitie_id }}</td>
                <td>
                    {!! Form::open(['route' => ['contenidos.destroy', $contenido->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('contenidos.show', [$contenido->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('contenidos.edit', [$contenido->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
