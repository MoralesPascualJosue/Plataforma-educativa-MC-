<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $curso->title }}</p>
</div>

<!-- Review Field -->
<div class="form-group">
    {!! Form::label('review', 'Review:') !!}
    <p>{{ $curso->review }}</p>
</div>

<!-- Cover Field -->
<div class="form-group">
    {!! Form::label('cover', 'Cover:') !!}
    <p>{{ $curso->cover }}</p>
    <p> <img src="{{ $curso->cover }}" class="img-responsive" width="150" height="150"> </p>
</div>

<!-- Asesor Id Field -->
<div class="form-group">
    {!! Form::label('asesor_id', 'Asesor Id:') !!}
    <p>{{ $curso->asesor_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $curso->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $curso->updated_at }}</p>
</div>

