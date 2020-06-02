<!-- Qualification Field -->
<div class="form-group">
    {!! Form::label('qualification', 'Qualification:') !!}
    <p>{{ $qualification->qualification }}</p>
</div>

<!-- Observaciones Field -->
<div class="form-group">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    <p>{{ $qualification->observaciones }}</p>
</div>

<!-- Estado Field -->
<div class="form-group">
    {!! Form::label('estado', 'Estado:') !!}
    <p>{{ $qualification->estado }}</p>
</div>

<!-- Activitie Id Field -->
<div class="form-group">
    {!! Form::label('activitie_id', 'Activitie Id:') !!}
    <p>{{ $qualification->activitie_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $qualification->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $qualification->updated_at }}</p>
</div>

