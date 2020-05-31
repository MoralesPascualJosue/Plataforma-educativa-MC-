<script>
    $("div.alert")
    .not(".alert-important")
    .delay(3000)
    .fadeOut(350);
</script>

@include('flash::message')

<div class="content-tb">
    @cannot('edit cursos')
    <div class="card credentialing">
        {!! Form::open(['route' => ['matricular'], 'method' => 'post'])!!}
        <!-- Title Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('title', 'Registra un curso:') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=> 'Codigo del curso']) !!}
        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Registrar curso', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
    @endif

    @if (count($cursos))
    @foreach($cursos as $curso)

    <a href="{{ route('scursoc', $curso->id) }}" class="card education box">
        {{-- <div class="overlay">
        </div> --}}
        <div class="circle">
            @if ($curso->cover==null)
            <img class="clase-img-top" src="{{ asset('images/image.jpg') }}" width="71px" height="71px">
            @else
            <img class="clase-img-top " src="{{ $curso->cover}}" alt="img {{ $curso->title }}" width="71px"
                height="71px">
            @endif
        </div>
        <p class="clase-tittle">{{ $curso->title }}</p>
    </a>

    @endforeach
    @else
    <div>No tienes cursos registrados</div>
    @endif


</div>