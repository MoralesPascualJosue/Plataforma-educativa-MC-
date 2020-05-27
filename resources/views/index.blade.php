@extends('layouts.front')

@section('content')
<br>

<div class="text-center mt-sm-5">
  <h2>Últimos Cursos</h2>
  <p>La mejor colección.</p>
</div>


<div class="container">
  <div class="row">

    @foreach($cursos as $curso)

    <div class="col-md-4">

      <div class="card">
        @if ($curso->cover==null)
        <img class="card-img-top" src="{{ asset('images/image.jpg') }}" width="300" height="300">
        @else
        <img class="card-img-top " src="{{ $curso->cover}}" alt="{{ $curso->title }}" width="300" height="300">
        @endif




        <div class="card-body">
          <h5 class="card-title">{{ $curso->title }}</h5>
          <p class="card-text">{!!substr($curso->review, 0,150)!!}...</p>

          <a href="{{ route('scurso', $curso->id) }}" class="btn btn-primary"><i class="fas fa-book-reader"></i> Más
            información</a>

        </div>
      </div>

    </div>

    @endforeach


  </div>
  <a href="{{ route('pcursos') }}" class="btn btn-secondary text-center">MÁS CURSOS</a>
</div>
<br>




<div class="seller">

  <div class="text-center ">
    <br>
    <h2>Últimos asesores</h2>
    <p>Grandes asesores de la educacion universal</p>
  </div>



  <div class="container">
    <div class="row">


      @foreach ($asesors as $asesor)


      <div class="col-md-4">
        <div class="card">
          <div class="text-center">
            @if ($asesor->image==null)
            <img class="avatar" src="{{ asset('images/avatar.png') }}" width="150" height="150" alt="">
            @else
            <img class="avatar" src="{{ $asesor->image}}" width="150" height="150" alt="">
            @endif
          </div>
          <div class="card-body">
            <h5 class="card-title text-danger text-center">{{ $asesor->name}} </h5>
            <p class="card-text ">{!!substr($asesor->bio, 0,50)!!}..</p>
          </div>
          <div class="card-footer text-center">
            <a href="{{ route('sasesor', $asesor->id) }}" class="btn btn-author"><i class="fas fa-book-reader"></i> Más
              información</a>
          </div>
        </div>
      </div>

      @endforeach

    </div>
    <a href="{{ route('pasesors') }}" class="btn btn-primary text-center">MÁS ASESORES</a>
  </div>
  <br>
  @endsection()