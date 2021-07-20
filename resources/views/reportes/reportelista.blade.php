<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Document</title>
    <style>
        table {
            font-size: 12px;
        }

        th {
            border: 1px solid black;
            padding: 2px;
        }

        .block-topp {
            text-transform: uppercase;
        }

        /**/


        .info-materia {
            font-size: 12px;
            line-height: 2px;
        }

        .info-materia-r {
            font-size: 12px;
            line-height: 2px;
            text-align: right;
            right: 50px;
        }

        .box {
            text-align: center;
            width: 100%;
        }

        .right {
            position: absolute;
            top: 0px;
            left: 530px;
        }

        .info-materia-data {
            position: absolute;
            left: 80px;
            font-weight: 700;
        }

        .info-materia-r-data {
            text-align: left;
            font-weight: 700;
        }

        .est-name {
            width: 200px;
        }

        .box {
            text-align: center;
        }

        .box tr {
            border-bottom: 1px solid black;
        }

        #selectable {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="block-topp">
            <div class="left">
                <P class="info-materia">MATERIA: <span class="info-materia-data">{{ $curso->title}}</span></P>
                <P class="info-materia">PROFESOR: <span class="info-materia-data">{{ $asesor->name}}</span></P>
                <P class="info-materia">PERIODO: <span class="info-materia-data">{{ $periodo}}</span></P>
            </div>

            <div class="right">
                <P class="info-materia-r">ALUMNOS: <span class="info-materia-r-data">{{$curso->participantes}}</span>
                </P>
            </div>
        </div>

        <div class="box">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th class="orange">Nombre del alumno</th>
                        @for ($i = 0; $i < count($actividadesa); $i++) @if ($actividadesa[$i]['type']=='activitie' )
                            <th>A{{$i+1}}</th>
                            @else
                            <th>P{{$i+1}}</th>
                            @endif
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
                        <td class="entypo-cancel">{{$item["qualification"]}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- The end of the box -->

    </div>

    <div class="footer">

    </div>

</body>

</html>