<!-- Estudiante Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estudiante_id', 'Estudiante Id:') !!}
    {!! Form::select('estudiante_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Curso Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('curso_id', 'Curso Id:') !!}
    {!! Form::select('curso_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('matriculados.index') }}" class="btn btn-default">Cancel</a>
</div>
