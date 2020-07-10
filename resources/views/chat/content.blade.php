@extends('chat.chat')


@section('content')

@include('flash::message')

@if ($curso->cover==null)
<div class="container" style="background: url('../resources/welcome1.jpg') no-repeat ; background-size: cover;">
    @else
    <div class="container" style="background: url({{ asset( $curso->cover )}}) no-repeat ; background-size: cover;">
        @endif

        <div class="box item1">
            <div class="participantes">

            </div>
        </div>

        <div class=" box item2">
            <div class="conversaciones">
                <div class="aside-header">Conversaciones</div>
                @foreach($chats as $chat)
                <div class="chat" id="{{ $chat->id }}">
                    <div class="chat-name" id="{{$curso->id }}/{{ $chat->id }}">{{ $chat->name }}</div>
                    <div class="eliminarc" id="{{ $chat->id }}">X</div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="box item22">
            <div class="messages">
                <section class="msger" id="0">
                    <header class="msger-header">
                        <div class="msger-header-title">
                            SimpleChat
                        </div>
                        <div class="msger-header-options">
                            <span><i class="fas fa-cog cerrarchat">Cerrar</i></span>
                        </div>
                    </header>

                    <main class="msger-chat">

                    </main>

                    <form class="msger-inputarea">
                        <input type=" text" class="msger-input" placeholder="Escribe tu mensage...">
                        <button type="submit" class="msger-send-btn">Enviar</button>
                    </form>
                </section>
            </div>
        </div>


        <div class="curse-container box item3">
            <div>
                <div class="name-user">{{ $user['perfil']->name }} </div>
                <div class="img-user"><img id="usr-img" src="{{ asset($user['perfil']->image) }}" alt=""></div>
            </div>

            <div class="aside-header">Contactos</div>

            @foreach($contacts as $contac)
            <div class="tooltip contacto" id="{{$contac->usuario_id}}">
                <div class="contact-name">{{ $contac->name }} </div>
                <div class="contacto-img">
                    <img src="{{ asset($contac->image) }}" alt="img">
                </div>
                <span class="tooltiptext">
                    <div class="tooltiptext-item newmessage" id="{{ $curso->id}}/{{$contac->usuario_id}}">Mensaje</div>
                    <div class="line"></div>
                    <div class="tooltiptext-item addchat" id="{{$contac->usuario_id}}">Agregar a chat</div>
                </span>
            </div>
            @endforeach

        </div>

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