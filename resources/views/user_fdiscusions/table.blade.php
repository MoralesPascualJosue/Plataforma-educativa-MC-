<div class="table-responsive">
    <table class="table" id="userFdiscusions-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Fdiscusion Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($userFdiscusions as $userFdiscusion)
            <tr>
                <td>{{ $userFdiscusion->user_id }}</td>
            <td>{{ $userFdiscusion->fdiscusion_id }}</td>
                <td>
                    {!! Form::open(['route' => ['userFdiscusions.destroy', $userFdiscusion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('userFdiscusions.show', [$userFdiscusion->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('userFdiscusions.edit', [$userFdiscusion->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
