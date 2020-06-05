<div class="table-responsive">
    <table class="table" id="fdiscusions-table">
        <thead>
            <tr>
                <th>Title</th>
        <th>Views</th>
        <th>Answered</th>
        <th>User Id</th>
        <th>Curso Id</th>
        <th>Fcategoria</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($fdiscusions as $fdiscusion)
            <tr>
                <td>{{ $fdiscusion->title }}</td>
            <td>{{ $fdiscusion->views }}</td>
            <td>{{ $fdiscusion->answered }}</td>
            <td>{{ $fdiscusion->user_id }}</td>
            <td>{{ $fdiscusion->curso_id }}</td>
            <td>{{ $fdiscusion->fcategoria }}</td>
                <td>
                    {!! Form::open(['route' => ['fdiscusions.destroy', $fdiscusion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('fdiscusions.show', [$fdiscusion->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('fdiscusions.edit', [$fdiscusion->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
