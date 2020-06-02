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
            @foreach ($estudiantes as $estudiante)
            <tr>
                <th>{{$estudiante->name}}</th>
                <th><button class="btn entregarev" href="javascript:void(0);"
                        id="{{ $estudiante->id }}">Entrega</button>
                </th>
                <th>{{ ($estudiante->qualificationestado == 1) ? 'Para revision' : $estudiante->qualificationqualification }}
                </th>
            </tr>
            @endforeach

        </table>
    </div>
    @endsection