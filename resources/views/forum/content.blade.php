@extends('forum.forum')


@section('content')

@include('flash::message')

<div class="container">
    @if ($curso->cover==null)
    <div class="curse-img-header"
        style="background: url('../resources/welcome1.jpg')  no-repeat; background-size: cover; background-position:0;">
        @else
        <div class="curse-img-header"
            style="background: url({{ asset( $curso->cover )}}) no-repeat ; background-size: cover;">
            @endif
            <div class="curse-header">
                <div class="user-name-header">
                    <button class="nuevotema">nuevo tema</button>
                    <span id="name-u">Foro del curso
                        <div class="curso-message">
                            <p class="cursoreview">Temas</p>
                        </div>
                    </span>
                </div>
            </div>
        </div>

        <div class="aside">
            <div class="aside-header">Categorias</div>

            <!-- SIDEBAR -->
            <div class="sidebar">

                <div class="categoria" id="/foro/{{ $curso->id }}">
                    <div class="bubble">Todas</div>
                </div>
                <ul class="navcate">
                    @foreach($categorias as $category)
                    <div class="categoria" id="/foro/{{ $curso->id }}?en={{ $category->name }}">
                        <div class="box-cate" style="background-color:{{ $category->color }}">
                            {{ $category->name }}
                        </div>
                    </div>
                    @endforeach
                </ul>
            </div>
            <!-- END SIDEBAR -->
        </div>

        <div class="curse-container">

            <div class="column-content">

                <div id="new_discussion">

                    <div class="loader dark" id="new_discussion_loader">
                        <div></div>
                    </div>

                    <form id="form_editor" action="{{ $curso->id }}/creartema" method="POST">
                        <div class="row">
                            <div class="inline-c">
                                <!-- TITLE -->
                                <label for="title">Tema: </label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Escribe tu tema aqui." v-model="title" value="{{ old('title') }}">
                            </div>

                            <div class="inline-c">
                                <!-- CATEGORY -->
                                <label for="fcategoria">Categoria: </label>
                                <select id="category_id" class="form-control" name="fcategoria">
                                    @foreach($categorias as $category)
                                    @if(old('fcategoria') == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                    @endforeach
                                </select>

                                <input type="checkbox" id="grupo" name="grupo" value="grupo">
                                <label for="grupo">Nueva: </label><br>
                                <div class="scategoria">
                                    <input type="text" class="form-control" id="categoria" name="categoria"
                                        placeholder="Escribe tu categoria">
                                    <input id="nuevacategoria" type="hidden" name="nuevacategoria" value="nueva ">
                                    <input type="color" name="color" value="#f9f9f9">
                                </div>
                            </div>
                        </div><!-- .row -->

                        {{-- <!-- BODY -->
                        <div id="editor">
                            <label id="bodyl"> Agrega tu contenido aqui:</label>
                            <textarea id="body" class="richText" name="body" placeholder="">{{ old('body') }}</textarea>
                </div> --}}
                <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">

                <div id="new_discussion_footer">
                    <button id="submit_discussion" class="btnd btn-success pull-right" type="submit">Crear</button>
                    <button class="btnd btn-default pull-right" id="cancel_discussion" type="button">Cancel</button>
                </div>
                </form>

            </div><!-- #new_discussion -->


            @foreach ($discuss as $item)
            <div id="{{$curso->id}}/{{$item->id }}" class="discuss">
                <p class="top-dis" style="background-color:{{ $item->colorCategoria }}">{{$item->created_at}} <span
                        class="discussname">
                        Creado por: {{ $item->usuarioName }}</span></p>
                <h2 class="discusstitle">
                    {{ $item->title  }}
                </h2>
                {{-- <div class=" discussbody">
                    {!! $item->body !!}
                </div> --}}
                <div class="discussitemconc">
                    <p class="discussitem">Visto: {{ $item->views }}</p>
                    <p class="discussitem">Respuestas: {{ $item->answered }}</p>
                </div>
            </div>
            @endforeach

        </div>

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