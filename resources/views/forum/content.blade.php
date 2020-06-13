@extends('forum.forum')


@section('content')

@include('flash::message')

<div class="container">

    <div class="aside">
        <div class="aside-header">Categorias</div>

        <!-- SIDEBAR -->
        <div class="sidebar">

            <a href="/foro/{{ $curso->id }}">
                <div class="bubble">Todas</div>
            </a>
            <ul class="navcate">
                @foreach($categorias as $category)
                <a href="/foro/{{ $curso->id }}/{{ $category->name }}">
                    <div class="box-cate" style="background-color:{{ $category->color }}">
                        {{ $category->name }}
                    </div>
                </a>
                @endforeach
            </ul>
        </div>
        <!-- END SIDEBAR -->
    </div>

    @if ($curso->cover==null)
    <div class="curse-img-header"
        style="background: url('../resources/welcome1.jpg')  no-repeat; background-size: cover; background-position:0;">
    </div>
    @else
    <div class="curse-img-header"
        style="background: url({{ asset( $curso->cover )}}) no-repeat ; background-size: cover;">
    </div>
    @endif

    <div class="curse-header">
        <div class="avatar-container">
            <div class="user-img-header">
            </div>
        </div>
        <div class="user-name-header">
            <span id="name-u">Foro del curso</span>
        </div>

    </div>

    <div class="curso-message">
        <p class="cursoreview">Temas</p>
    </div>

    <button class="nuevotema">nuevo tema</button>

    <div class="curse-container">

        <div class="column-content">


            @foreach ($discuss as $item)
            <div id="{{$curso->id}}/{{$item->id }}" class="box discuss"
                style="background-color:{{ $item->colorCategoria }}">
                <h2 class="discusstitle">
                    {{ $item->title  }}
                </h2>
                <span class="discussname"> Creado por: {{ $item->usuarioName }}</span>
                <div class=" discussbody">
                    {!! $item->body !!}
                </div>
                <div class="discussitemcon">
                    <p class="discussitem">Visto: {{ $item->views }}</p>
                    <p class="discussitem">Respuestas: {{ $item->answered }}</p>
                </div>
            </div>
            @endforeach

        </div>


        <div id="new_discussion">

            <div class="loader dark" id="new_discussion_loader">
                <div></div>
            </div>

            <form id="form_editor" action="{{ $curso->id }}/creartema" method="POST">
                <div class="row">
                    <div class="">
                        <!-- TITLE -->
                        <label for="title">Titulo: </label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titulo"
                            v-model="title" value="{{ old('title') }}">
                    </div>

                    <div class="">
                        <!-- CATEGORY -->
                        <label for="fcategoria">Categoria: </label>
                        <select id="category_id" class="form-control" name="fcategoria">
                            <option value="">Selecciona una categoria</option>
                            @foreach($categorias as $category)
                            @if(old('fcategoria') == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div><!-- .row -->

                <!-- BODY -->
                <div id="editor">
                    <label id="bodyl"> Agrega tu contenido aqui:</label>
                    <textarea id="body" class="richText" name="body" placeholder="">{{ old('body') }}</textarea>
                </div>
                <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">

                <div id="new_discussion_footer">
                    <button id="submit_discussion" class="btn btn-success pull-right">
                        Crear</button>
                    <a class="btn btn-default pull-right" id="cancel_discussion">Cancel</a>
                    <div style="clear:both"></div>
                </div>
            </form>

        </div><!-- #new_discussion -->

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