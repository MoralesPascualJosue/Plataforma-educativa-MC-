<div class="table-responsive">
    <table class="table" id="works-table">
        <thead>
            <tr>
                <th>Contenido</th>
        <th>Entregas</th>
        <th>Activitie Id</th>
        <th>Estudiante Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($works as $work)
            <tr>
                <td>{{ $work->contenido }}</td>
            <td>{{ $work->entregas }}</td>
            <td>{{ $work->activitie_id }}</td>
            <td>{{ $work->estudiante_id }}</td>
                <td>
                    {!! Form::open(['route' => ['works.destroy', $work->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('works.show', [$work->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('works.edit', [$work->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
