@extends('layouts.listacurso')

@section('content')
<section class="content-header">

    <div class="content">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Calificaciones</th>
                <th>Promedio</th>
            </tr>
            <tr>
                <td></td>
                @foreach ($actividades as $actividad)
                <td>{{$actividad->title}}</td>
                @endforeach
                <td>Promedio</td>
            </tr>
            @foreach ($estudiantes as $estudiante)
            <tr>
                <th>{{$estudiante->name}}</th>
                @foreach ($estudiante["calificaciones"] as $item)
                <th>{{ ($item['estado'] == 1) ? 'Para revision' : $item['qualification'] }} </th>
                @endforeach
                <th>{{ ($estudiante->qualificationestado == 1) ? 'Para revision' : $estudiante->qualificationqualification }}
                </th>
                </>
                @endforeach

        </table>
    </div>
    @endsection