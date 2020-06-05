<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userFdiscusion->user_id }}</p>
</div>

<!-- Fdiscusion Id Field -->
<div class="form-group">
    {!! Form::label('fdiscusion_id', 'Fdiscusion Id:') !!}
    <p>{{ $userFdiscusion->fdiscusion_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $userFdiscusion->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $userFdiscusion->updated_at }}</p>
</div>

