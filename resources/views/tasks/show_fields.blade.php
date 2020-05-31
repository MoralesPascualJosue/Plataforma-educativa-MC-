<!-- Contenido Field -->
<div class="form-group">
    {!! Form::label('contenido', 'Contenido:') !!}
    <p>{{ $task->contenido }}</p>
</div>

<!-- Asesor Id Field -->
<div class="form-group">
    {!! Form::label('asesor_id', 'Asesor Id:') !!}
    <p>{{ $task->asesor_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $task->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $task->updated_at }}</p>
</div>

