<div class="table-responsive">
    <table class="table" id="fposts-table">
        <thead>
            <tr>
                <th>Body</th>
        <th>Locked</th>
        <th>Fdiscusion Id</th>
        <th>User Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($fposts as $fpost)
            <tr>
                <td>{{ $fpost->body }}</td>
            <td>{{ $fpost->locked }}</td>
            <td>{{ $fpost->fdiscusion_id }}</td>
            <td>{{ $fpost->user_id }}</td>
                <td>
                    {!! Form::open(['route' => ['fposts.destroy', $fpost->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('fposts.show', [$fpost->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('fposts.edit', [$fpost->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
