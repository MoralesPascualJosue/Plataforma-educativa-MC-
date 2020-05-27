<div class="table-responsive">
    <table class="table" id="asesors-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Image</th>
        <th>Bio</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($asesors as $asesor)
            <tr>
                <td>{{ $asesor->name }}</td>
            <td><img src="{{ $asesor->image }}" class="img-responsive" width="150" height="150"></td>            
            <td> <p> {!! $asesor->bio !!}  </p> </td>             
                <td>
                    {!! Form::open(['route' => ['asesors.destroy', $asesor->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('asesors.show', [$asesor->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i>s</a>
                        <a href="{{ route('asesors.edit', [$asesor->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i>e</a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $asesors->links() }}
