<div class="table-responsive">
    <table class="table" id="matriculados-table">
        <thead>
            <tr>
                <th>Estudiante Id</th>
        <th>Curso Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($matriculados as $matriculado)
            <tr>
                <td>{{ $matriculado->estudiante_id }}</td>
            <td>{{ $matriculado->curso_id }}</td>
                <td>
                    {!! Form::open(['route' => ['matriculados.destroy', $matriculado->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('matriculados.show', [$matriculado->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('matriculados.edit', [$matriculado->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
