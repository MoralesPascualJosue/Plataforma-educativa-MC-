<!-- Contenido Field -->
<div class="form-group">
    {!! Form::label('contenido', 'Contenido:') !!}
    <p>{{ $work->contenido }}</p>
</div>

<!-- Entregas Field -->
<div class="form-group">
    {!! Form::label('entregas', 'Entregas:') !!}
    <p>{{ $work->entregas }}</p>
</div>

<!-- Activitie Id Field -->
<div class="form-group">
    {!! Form::label('activitie_id', 'Activitie Id:') !!}
    <p>{{ $work->activitie_id }}</p>
</div>

<!-- Estudiante Id Field -->
<div class="form-group">
    {!! Form::label('estudiante_id', 'Estudiante Id:') !!}
    <p>{{ $work->estudiante_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $work->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $work->updated_at }}</p>
</div>

