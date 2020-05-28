<div class="table-responsive">
    <table class="table" id="activities-table">
        <thead>
            <tr>
                <th>Title</th>
        <th>Visible</th>
        <th>Intentos</th>
        <th>Fecha Inicio</th>
        <th>Fecha Final</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($activities as $activitie)
            <tr>
                <td>{{ $activitie->title }}</td>
            <td>{{ $activitie->visible }}</td>
            <td>{{ $activitie->intentos }}</td>
            <td>{{ $activitie->fecha_inicio }}</td>
            <td>{{ $activitie->fecha_final }}</td>
                <td>
                    {!! Form::open(['route' => ['activities.destroy', $activitie->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('activities.show', [$activitie->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('activities.edit', [$activitie->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
