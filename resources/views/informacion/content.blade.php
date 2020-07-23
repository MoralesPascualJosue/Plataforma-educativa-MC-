@extends('informacion.informacion')


@section('content')

@include('flash::message')

<div class="container">
    <input type="hidden" id="curso" name="curso" value="{{$curso->id}}">

    <div class="first">
        <div class="info-content">
            <div class="info-content-top"></div>
            <div class="info-content-top-text">Matriculados</div>
            <div class="info-content-bottom">{{$matriculados}}</div>
        </div>

        <div class="info-content">
            <div class="info-content-top"></div>
            <div class="info-content-top-text">Actividades</div>
            <div class="info-content-bottom">{{$tactividades}}</div>
        </div>
    </div>
    <div class="second">
        <div class="chart-container">
            <canvas id="chart"></canvas>
        </div>
    </div>
    <div class="third">
        <div class="chart-container2">
            <canvas id="chart2"></canvas>
        </div>
    </div>
    <div class="">
        <img src="{{ asset($curso->cover) }}" alt="">
    </div>
    <div class="">
        <div class="info-content">
            <div class="info-content-top"></div>
            <div class="info-content-top-text">Promedio del curso</div>
            <div class="info-content-bottom">{{$promedio}}</div>
        </div>
    </div>
    <div class="">
        <h3>Clave:</h2>
            {{ $curso->password }}
    </div>
    <div class="">
        <h3>Creado en:</h2>
            {{ $curso->created_at }}
    </div>

</div>


<script>
    $("div.alert")
        .not(".alert-important")
        .delay(3000)
        .fadeOut(350);
</script>



@endsection

@push('script')
@endpush