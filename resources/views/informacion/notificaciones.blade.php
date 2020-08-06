@extends('layouts.app')

@section('title', 'Notificaciones')

@section('content')
<div class="clases-header">
    <h2><span>{{$curso['notificacionesnum']}}</span> Notificaciones</h2>
</div>

<div class="clases">
    @forelse ($curso['notificaciones'] as $notificacion)
    <li class="list-n">
        <a href="/sactivitiec/{{ $notificacion->data['activitie'] }}" class="data-n">
            {{$notificacion->data['title']}}
            <span class="time-n">{{$notificacion->created_at->diffForHumans()}}</span>
        </a>
    </li>
    @empty
    <li class="list-n">
        <a href="#" class="data-n">
            Sin notificaciones pendientes
        </a>
    </li>
    @endforelse
    <div class="clases-header">
        <h2>Notificaciones leidas</h2>
    </div>
    @forelse ($curso['readnotificaciones'] as $notificacion)
    <li class="list-n">
        <a href="/sactivitiec/{{ $notificacion->data['activitie'] }}" class="data-n">
            {{$notificacion->data['title']}}
            <span class="time-n">{{$notificacion->created_at->diffForHumans()}}</span>
        </a>
    </li>
    @empty
    <li class="list-n">
        <a href="#" class="data-n">
            Sin notificaciones
        </a>
    </li>
    @endforelse

</div>
@endsection