@extends('layouts.front')

@section('content')

    <div class="text-center mt-sm-5">
             <h2>Biblioteca de asesores</h2>
             <p>Los mejores</p>
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
            <a href="{{ route('sasesor', $asesor->id) }}" class="btn btn-author"><i class="fas fa-book-reader"></i> Más información</a>
          </div>
        </div>
      </div>

    @endforeach
  
    </div>
      {{ $asesors->links() }}
  </div>
    <br>
@endsection()