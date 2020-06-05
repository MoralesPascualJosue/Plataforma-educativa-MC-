<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Fdiscusion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fdiscusion_id', 'Fdiscusion Id:') !!}
    {!! Form::text('fdiscusion_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('userFdiscusions.index') }}" class="btn btn-default">Cancel</a>
</div>
