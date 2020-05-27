<!-- Anuncio Field -->
<div class="form-group">
    {!! Form::label('anuncio', 'Anuncio:') !!}
    <p>{{ $anuncio->anuncio }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $anuncio->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $anuncio->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $anuncio->updated_at }}</p>
</div>

