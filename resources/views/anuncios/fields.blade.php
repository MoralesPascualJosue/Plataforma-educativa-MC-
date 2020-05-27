<!-- Anuncio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('anuncio', 'Anuncio:') !!}
    {!! Form::text('anuncio', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('anuncios.index') }}" class="btn btn-default">Cancel</a>
</div>