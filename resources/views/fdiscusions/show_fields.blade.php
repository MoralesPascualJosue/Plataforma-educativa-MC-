<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $fdiscusion->title }}</p>
</div>

<!-- Views Field -->
<div class="form-group">
    {!! Form::label('views', 'Views:') !!}
    <p>{{ $fdiscusion->views }}</p>
</div>

<!-- Answered Field -->
<div class="form-group">
    {!! Form::label('answered', 'Answered:') !!}
    <p>{{ $fdiscusion->answered }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $fdiscusion->user_id }}</p>
</div>

<!-- Curso Id Field -->
<div class="form-group">
    {!! Form::label('curso_id', 'Curso Id:') !!}
    <p>{{ $fdiscusion->curso_id }}</p>
</div>

<!-- Fcategoria Field -->
<div class="form-group">
    {!! Form::label('fcategoria', 'Fcategoria:') !!}
    <p>{{ $fdiscusion->fcategoria }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $fdiscusion->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $fdiscusion->updated_at }}</p>
</div>

