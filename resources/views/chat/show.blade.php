@extends('chat.chat')


@section('content')

@include('flash::message')

<div class="inbox-wrapper">
    <header class="main-header clearfix">


        <input id="busqueda" name="search" class="search i" type="text" placeholder="Buscar" />
        <input id="curso" type="hidden" name="curso" value="{{$curso->id}}">
        <span class="clear-b">X</span>

        <div class="active-user">
            <li class="itemop nuevomso">Nuevo</li>
            <li class="itemop updatems" id="enviadosms/{{$curso->id}}">Enviados</li>
            <li class="itemop updatems orange-b" id="updatems/{{$curso->id}}">Bandeja de entrada</li>
            <li class="itemop" style="float: right;">{{ $user->name }}</li>
            <img class="avatar" src="../{{ $user->image }}" alt="avatar" />
        </div>
    </header>

    <section class="inbox">
        <ul class="email-list">

            @if (count($chats))
            @foreach ($chats as $item)
            <li class="chat-name" id="{{$item->id}}">
                <span class="date">{{$item->created_at}}</span>
                <h3 class="from m-b-5"><img src="{{asset($item->user->image)}}" class="avatar-min"
                        alt="">{{$item->user->name}}</h3>
                <h2 class="subject">{{$item->asunto}}</h2>
                {{-- <p class="message-snippet">{!! $item->body !!}</p> --}}
            </li>
            @endforeach
            @else
            <li class="no-messages">
                <i class="fa fa-inbox">
                    <span> No tienes mensages.</span>
                </i>
            </li>
            @endif

        </ul>
        <div class="cerrarms">X</div>
        <div class="message out">
            @if($messages ?? 'null')
            <div class="no-messages">
                <i class="fa fa-file-o"> No tienes mensages.</i>
            </div>
            @endif

        </div>

        <div class="nuevoms">
            <div class="message">
                <div>
                    <ul class="message-actions">
                        <li><button class="sumitmse" type="submit">Enviar</button></li>
                        <li><button class="sumitmsc" type="submit">Cancelar</button></li>
                        <li><a class="button" href="#" title="Delete"><i class="fa fa-trash fa-fw"></i></a></li>
                    </ul>

                    <span class="date">Hoy</span>
                    <img class="avatar" src="../{{$user->image}}" alt="active email avatar" />
                    <label for="">De:</label>
                    <h3 class="from">{{$user->name}}</h3>
                    <label for="">Para:</label><button class="addadress" id="flip">+</button>
                    <input type="checkbox" id="grupo" name="grupo" value="grupo">
                    <label for="grupo"> Enviar a todos</label><br>
                    <div id="panel-contacts-destino" class="para">
                    </div>
                    <div id="panel-contacts">
                        @foreach($contacts as $contac)
                        <span class="address" id="{{$contac->user_id}}"><img class="avatar-min"
                                src="{{asset($contac->user->image)}}" alt="avatar">{{ $contac->name }}</span>
                        @endforeach
                    </div>
                    <div>Asunto: <h3 class="subject-s subjectms" contenteditable="true">Asunto</h3>
                    </div>

                    <p class="ng-binding contentms" contenteditable="true"></p>
                </div>
            </div>
        </div>

    </section>

    <div class="menud">
        <div>Eliminar</div>
        <div class="menud-option menud-option-confirmar" id="">Si</div>
        <div class="menud-option menud-option-cancel">No</div>
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