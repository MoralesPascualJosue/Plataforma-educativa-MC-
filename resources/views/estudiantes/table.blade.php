<div class="table-responsive">
    <table class="table" id="estudiantes-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Bio</th>
        <th>Image</th>
        <th>Institute</th>
        <th>Department</th>
        <th>Telephone</th>
        <th>User Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($estudiantes as $estudiante)
            <tr>
                <td>{{ $estudiante->name }}</td>
            <td>{{ $estudiante->bio }}</td>
            <td>{{ $estudiante->image }}</td>
            <td>{{ $estudiante->institute }}</td>
            <td>{{ $estudiante->department }}</td>
            <td>{{ $estudiante->telephone }}</td>
            <td>{{ $estudiante->user_id }}</td>
                <td>
                    {!! Form::open(['route' => ['estudiantes.destroy', $estudiante->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('estudiantes.show', [$estudiante->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('estudiantes.edit', [$estudiante->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
