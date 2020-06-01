@extends('layouts.lista')

@section('content')
<section class="content-header">

</section>
<section class="seccionToggle">
    <div class="wrap">
        <p class="subtitle">Entregas realizadas</p>
        <textarea class="vista" name="" id="editorworkv">
                @foreach($works as $work)
                    <hr><hr>
                    <br>
                    <h1>Entrega {{ $work->entregas }}</h1>                        
                    <br>
                    {{$work->contenido}}
                @endforeach
        </textarea>
    </div>
</section>

<a href="#" id="btn-toggle" class="btn-toggle" style="visibility: hidden"></a>

<div class="content">
    <table>
        <tr>
            <th>Nombre</th>
            <th>Entrega</th>
            <th>Calificacion</th>
        </tr>
        @foreach ($estudiantes as $estudiante)
        <tr>
            <th>{{$estudiante->name}}</th>
            <th><button class="btn entregarev" href="javascript:void(0);" id="{{ $estudiante->id }}">Entrega</button>
            </th>
            <th>pendiente</th>
        </tr>
        @endforeach

    </table>
</div>
@endsection