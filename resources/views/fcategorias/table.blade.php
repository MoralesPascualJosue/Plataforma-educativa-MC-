<div class="table-responsive">
    <table class="table" id="fcategorias-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Color</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($fcategorias as $fcategoria)
            <tr>
                <td>{{ $fcategoria->name }}</td>
            <td>{{ $fcategoria->color }}</td>
                <td>
                    {!! Form::open(['route' => ['fcategorias.destroy', $fcategoria->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('fcategorias.show', [$fcategoria->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('fcategorias.edit', [$fcategoria->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
