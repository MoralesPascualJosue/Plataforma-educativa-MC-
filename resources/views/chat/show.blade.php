@extends('chat.chat')


@section('content')

@include('flash::message')

<div class="inbox-wrapper">
    <header class="main-header clearfix">

        <form>
            <input id="busqueda" name="search" type="text" placeholder="Buscar" />
        </form>

        <div class="active-user">
            <li class="itemop nuevomso">Nuevo</li>
            <li class="itemop updatems" id="{{$curso->id}}">Update</li>
            <li class="itemop" style="float: right;">{{ $user->name }}</li>
            <img class=" avatar" src="../{{ $user->perfil->image }}" alt="avatar" />
        </div>
    </header>

    <section class="inbox">
        <ul class="email-list">

            @if (count($chats))
            @foreach ($chats as $item)
            <li class="chat-name" id="{{$curso->id}}/{{$item->id}}">
                <span class="date">{{$item->last["created_at"]}}</span>
                <h3 class="from m-b-5">{{$item->user}}</h3>
                <h2 class="subject">{{$item->name}}</h2>
                <p class="message-snippet">{!! $item->last["body"] !!}</p>
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
                {{-- <div class="no-messages">
                            <i class="fa fa-file-o"> condicion You have no messages.</i>
                        </div> --}}
                <div>
                    <ul class="message-actions">
                        <li><a class="button" href="#" title="Reply"><i class="fa fa-reply fa-fw"></i></a></li>
                        <li><a class="button" href="#" title="Forward"><i class="fa fa-share fa-fw"></i></a></li>
                        <li><a class="button" href="#" title="Delete"><i class="fa fa-trash fa-fw"></i></a></li>
                    </ul>

                    <span class="date">Hoy</span>
                    <img class="avatar" src="../{{$user->perfil->image}}" alt="active email avatar" />
                    <label for="">De:</label>
                    <h3 class="from">{{$user->name}}</h3>
                    <label for="">Para:</label><button class="addadress" id="flip">+</button>
                    <p class="para" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <div id="panel" ondrop="drop(event)" ondragover="allowDrop(event)">
                            @foreach($contacts as $contac)
                            <span class="address" id="{{ $curso->id}}/{{$contac->usuario_id}}" draggable="true"
                                ondragstart="drag(event)">{{ $contac->name }}</span>
                            @endforeach
                        </div>
                    </p>
                    <h2 class="subject subjectms" contenteditable="true">Asunto</h2>
                    <p class="ng-binding contentms" contenteditable="true"></p>
                </div>
            </div>
            <button class="sumitmse" type="submit">Enviar</button>
            <button class="sumitmsc" type="submit">Cancelar</button>
        </div>

    </section>
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