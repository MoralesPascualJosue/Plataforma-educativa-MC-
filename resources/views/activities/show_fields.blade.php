<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $activitie->title }}</p>
</div>

<!-- Visible Field -->
<div class="form-group">
    {!! Form::label('visible', 'Visible:') !!}
    <p>{{ $activitie->visible }}</p>
</div>

<!-- Intentos Field -->
<div class="form-group">
    {!! Form::label('intentos', 'Intentos:') !!}
    <p>{{ $activitie->intentos }}</p>
</div>

<!-- Fecha Inicio Field -->
<div class="form-group">
    {!! Form::label('fecha_inicio', 'Fecha Inicio:') !!}
    <p>{{ $activitie->fecha_inicio }}</p>
</div>

<!-- Fecha Final Field -->
<div class="form-group">
    {!! Form::label('fecha_final', 'Fecha Final:') !!}
    <p>{{ $activitie->fecha_final }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $activitie->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $activitie->updated_at }}</p>
</div>

