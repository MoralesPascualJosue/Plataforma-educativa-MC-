@extends('layouts.listacurso')

@section('content')
<section class="content-header">
</section>

<div class="content">
    <section id="pakete">
        <h1>Lista de participantes del curso</h1>
        <p class="section-text">Aqui se concentran las calificaciones asignadas.
            <em>Tambien se ofrece un resumen de las entregas realizadas!</em></p>

        <a class="export-option" href="../generarlista/{{$curso->id}}">Exportar pdf</a>
        <a class="export-option" href="../generarexcel/{{$curso->id}}">Exportar excel</a>

        <div class="box">
            <!-- The surrounding box -->

            <!-- The front container -->
            <div class="front">
                <table>
                    <thead>
                        <tr>
                            <th class="orange">Estudiante</th>
                            @foreach ($actividades as $actividad)
                            <th>{{$actividad->title}}</th>
                            @endforeach
                            <th>Promedio</th>
                        </tr>
                    </thead>

                    <tbody id="selectable">
                        @foreach ($estudiantes as $estudiante)
                        <tr>
                            <td><button class="show-me_1" id="{{$curso->id}}/{{$estudiante->id}}">{{$estudiante->name}}
                                </button></td>
                            @foreach ($estudiante["calificaciones"] as $item)
                            @if ($item['estado'] == 1)
                            <td class="blue">revision</td>
                            @else
                            @if ($item['qualification'] != "NA")
                            <td class="entypo-check">{{$item["qualification"]}}</td>
                            @else
                            <td class="entypo-cancel">{{$item["qualification"]}}</td>
                            @endif
                            @endif
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- The backside containers -->
            <div class="back first">
                <button class="hide-me_1">Cerrar</button>
                <h3 id="name-est" class="center">Estudiante</h3>
                <div id="hitoriale"></div>
            </div>
        </div><!-- The end of the box -->

    </section><!-- END of section-wrap -->

</div>
@endsection