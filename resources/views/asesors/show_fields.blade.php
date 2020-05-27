<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $asesor->name }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image location:') !!}
    <p> {!! $asesor->image !!} </p>
    <p> <img src="{{ $asesor->image }}" class="img-responsive" width="150" height="150"> </p>
    
</div>

<!-- Bio Field -->
<div class="form-group">
    {!! Form::label('bio', 'Bio:') !!}
    <p> {!! $asesor->bio !!} </p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $asesor->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $asesor->updated_at }}</p>
</div>

