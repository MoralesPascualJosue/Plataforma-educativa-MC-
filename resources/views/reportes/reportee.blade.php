<div class="left">
    <tr>
        <td class="info-materia">MATERIA:</td>
        <td class="info-materia-data">{{ $curso->title}}</td>
    </tr>
    <tr>
        <td class="info-materia">PROFESOR:</td>
        <td class="info-materia-data">{{ $asesor->name}}</td>
    </tr>
    <tr>
        <td class="info-materia">PERIODO:</td>
        <td class="info-materia-data">{{ $periodo }}</td>
    </tr>
</div>

<div class="right">
    {{-- <P class="info-materia-r">GRUPO: <span class="info-materia-r-data">ISB</span></P> --}}
    <P class="info-materia-r">ALUMNOS: <span class="info-materia-r-data">{{$curso->participantes}}</span>
    </P>
</div>

<tr></tr>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th class="orange">Nombre del alumno</th>
            @for ($i = 0; $i < $actividades->count(); $i++)
                <th>{{$actividades[$i]->title}}</th>
                @endfor
                <th>Calificación</th>
        </tr>
    </thead>

    <tbody id="selectable">
        @foreach ($estudiantes as $estudiante)
        <tr class="tupla">
            <td>{{$estudiante->numero}}</td>
            <td>
                <p class="est-name" id="{{$curso->id}}/{{$estudiante->id}}">{{$estudiante->name}}
                </p>
            </td>
            @foreach ($estudiante["calificaciones"] as $item)
            @if ($item['qualification'] != "NA")
            <td class="entypo-check">{{$item["qualification"]}}</td>
            @else
            <td class="entypo-cancel">{{$item["qualification"]}}</td>
            @endif
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>