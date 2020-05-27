@extends('layouts.front')

@section('content')
<br>
    <div class="container">
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-4">
              @if ($asesor->image ==null)
              <img src="{{ asset('images/avatar.png') }}" class="img-fluid "> 
              @else 
              <img src="{!! $asesor->image !!}" class="img-fluid "> 
              @endif
               
            </div>
           

            <div class="col-md-8">
                <div class="card mt-2  ">
                  <div class="card-header coltitle">
                   <h1 class="text-center textotitle">{!! $asesor->name !!}</h1> 
                  </div>
                  <div class="card-body">
                    <blockquote class="blockquote mb-0">
                      <p>{!! $asesor->bio!!}</p>
                      <footer class="blockquote-footer"><cite title="Source Title">{!! $asesor->name !!}</cite></footer>
                    </blockquote>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection