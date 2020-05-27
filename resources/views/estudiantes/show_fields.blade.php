<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $estudiante->name }}</p>
</div>

<!-- Bio Field -->
<div class="form-group">
    {!! Form::label('bio', 'Bio:') !!}
    <p>{{ $estudiante->bio }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $estudiante->image }}</p>
</div>

<!-- Institute Field -->
<div class="form-group">
    {!! Form::label('institute', 'Institute:') !!}
    <p>{{ $estudiante->institute }}</p>
</div>

<!-- Department Field -->
<div class="form-group">
    {!! Form::label('department', 'Department:') !!}
    <p>{{ $estudiante->department }}</p>
</div>

<!-- Telephone Field -->
<div class="form-group">
    {!! Form::label('telephone', 'Telephone:') !!}
    <p>{{ $estudiante->telephone }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $estudiante->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $estudiante->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $estudiante->updated_at }}</p>
</div>

