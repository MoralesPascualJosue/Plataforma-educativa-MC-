<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Visible Field -->
<div class="form-group col-sm-12">
    {!! Form::label('visible', 'Visible:') !!}
    <label class="radio-inline">
        {!! Form::radio('visible', "1", null) !!} visible
    </label>

    <label class="radio-inline">
        {!! Form::radio('visible', "0", null) !!} oculto
    </label>

</div>

<!-- Intentos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('intentos', 'Intentos:') !!}
    {!! Form::select('intentos', ['1' => 'uno', '2' => 'dos', '3' => 'tres'], null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Inicio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_inicio', 'Fecha Inicio:') !!}
    {!! Form::date('fecha_inicio', null, ['class' => 'form-control','id'=>'fecha_inicio']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#fecha_inicio').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Fecha Final Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_final', 'Fecha Final:') !!}
    {!! Form::date('fecha_final', null, ['class' => 'form-control','id'=>'fecha_final']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#fecha_final').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('activities.index') }}" class="btn btn-default">Cancel</a>
</div>
