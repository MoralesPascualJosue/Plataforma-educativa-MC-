<!-- Estudiante Id Field -->
<div class="form-group">
    {!! Form::label('estudiante_id', 'Estudiante Id:') !!}
    <p>{{ $matriculado->estudiante_id }}</p>
</div>

<!-- Curso Id Field -->
<div class="form-group">
    {!! Form::label('curso_id', 'Curso Id:') !!}
    <p>{{ $matriculado->curso_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $matriculado->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $matriculado->updated_at }}</p>
</div>

