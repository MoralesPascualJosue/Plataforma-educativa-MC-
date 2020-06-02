<div class="table-responsive">
    <table class="table" id="qualifications-table">
        <thead>
            <tr>
                <th>Qualification</th>
        <th>Observaciones</th>
        <th>Estado</th>
        <th>Activitie Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($qualifications as $qualification)
            <tr>
                <td>{{ $qualification->qualification }}</td>
            <td>{{ $qualification->observaciones }}</td>
            <td>{{ $qualification->estado }}</td>
            <td>{{ $qualification->activitie_id }}</td>
                <td>
                    {!! Form::open(['route' => ['qualifications.destroy', $qualification->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('qualifications.show', [$qualification->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('qualifications.edit', [$qualification->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
