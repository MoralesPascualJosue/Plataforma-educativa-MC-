<!-- Qualification Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qualification', 'Qualification:') !!}
    {!! Form::text('qualification', null, ['class' => 'form-control']) !!}
</div>

<!-- Observaciones Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::number('estado', null, ['class' => 'form-control']) !!}
</div>

<!-- Activitie Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activitie_id', 'Activitie Id:') !!}
    {!! Form::text('activitie_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('qualifications.index') }}" class="btn btn-default">Cancel</a>
</div>
