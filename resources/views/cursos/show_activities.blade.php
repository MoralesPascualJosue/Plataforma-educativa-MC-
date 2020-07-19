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
                <td>
                    @foreach ($actividades as $actividad)
                <td>{{$actividad->title}}</td>
                @endforeach
                </td>
                <td>Promedio</td>
            </tr>
            @foreach ($estudiantes as $estudiante)
            <tr>
                <td>{{$estudiante->name}}</td>
                <td>
                    @foreach ($estudiante["calificaciones"] as $item)

                    @if ($item['estado'] == 1)
                <td>revision</td>
                @else
                <td>{{$item["qualification"]}}</td>
                @endif
                @endforeach
                </td>
                <td>{{ ($estudiante->qualificationestado == 1) ? 'Para revision' : $estudiante->qualificationqualification }}
                </td>
                @endforeach
            </tr>

        </table>
    </div>
    @endsection