<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Locked Field -->
<div class="form-group col-sm-6">
    {!! Form::label('locked', 'Locked:') !!}
    {!! Form::number('locked', null, ['class' => 'form-control']) !!}
</div>

<!-- Fdiscusion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fdiscusion_id', 'Fdiscusion Id:') !!}
    {!! Form::text('fdiscusion_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('fposts.index') }}" class="btn btn-default">Cancel</a>
</div>
