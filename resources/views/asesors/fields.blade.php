<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>

<!-- Bio Field -->
<div class="form-group col-sm-12 col-lg-12" id="container">
    {!! Form::label('bio', 'Bio:') !!}
    {!! Form::textarea('bio', null, ['class' => 'form-control', 'id' => 'editor']) !!}   
    
    <div id="sidebar"></div>      
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('asesors.index') }}" class="btn btn-default">Cancel</a>
</div>
