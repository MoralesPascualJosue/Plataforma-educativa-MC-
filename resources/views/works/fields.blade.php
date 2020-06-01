<!-- Contenido Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('contenido', 'Contenido:') !!}
    {!! Form::textarea('contenido', null, ['class' => 'form-control']) !!}
</div>

<!-- Entregas Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entregas', 'Entregas:') !!}
    {!! Form::number('entregas', null, ['class' => 'form-control']) !!}
</div>

<!-- Activitie Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activitie_id', 'Activitie Id:') !!}
    {!! Form::text('activitie_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Estudiante Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estudiante_id', 'Estudiante Id:') !!}
    {!! Form::text('estudiante_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('works.index') }}" class="btn btn-default">Cancel</a>
</div>
