@extends('layouts.front')

@section('content')
<br>

<div class="text-center mt-sm-5">
  <h2>Biblioteca de cursos</h2>
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
  {{ $cursos->links() }}
</div>
<br>

@endsection()