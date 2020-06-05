<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    <p>{{ $fpost->body }}</p>
</div>

<!-- Locked Field -->
<div class="form-group">
    {!! Form::label('locked', 'Locked:') !!}
    <p>{{ $fpost->locked }}</p>
</div>

<!-- Fdiscusion Id Field -->
<div class="form-group">
    {!! Form::label('fdiscusion_id', 'Fdiscusion Id:') !!}
    <p>{{ $fpost->fdiscusion_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $fpost->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $fpost->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $fpost->updated_at }}</p>
</div>

