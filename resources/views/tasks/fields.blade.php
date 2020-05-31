<!-- Contenido Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('contenido', 'Contenido:') !!}
    {!! Form::textarea('contenido', null, ['class' => 'form-control']) !!}
</div>

<!-- Asesor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('asesor_id', 'Asesor Id:') !!}
    {!! Form::text('asesor_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('tasks.index') }}" class="btn btn-default">Cancel</a>
</div>
