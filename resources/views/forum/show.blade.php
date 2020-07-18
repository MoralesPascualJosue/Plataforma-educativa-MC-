@extends('forum.forum')


@section('content')

@include('flash::message')
<a href="/foro/{{ $curso->id}}" class="regresar" id="{{ $curso->id}}">Regresar</a>
<div class="containerfs">

    @if ( $discuss['propiedad'] == 1)
    <div class="tools-course canedit">
        <ul class="course-tools">
            <li class="course-tool-tab tooltip edit" id="{{ $discuss->id }}">
                <a class="course-tab-content" href="javascript:void(0);">
                    <img src="{{ asset("resources/icons/edit-a.svg") }}" alt="editar">
                </a>
                <span class="tooltiptext">Editar</span>
            </li>

            <li class="course-tool-tab tooltip delete" id="{{ $discuss->id }}">
                <a class="course-tab-content" href="javascript:void(0)">
                    <img src="{{ asset("resources/icons/delete-a.svg") }}" alt="eliminar">
                </a>
                <span class="tooltiptext">Eliminar</span>
            </li>

        </ul>
    </div>
    @endif



    <div class="curse-headerfs">
        <div class="user-name-header">
            <span id="name-d">{{ $discuss->title }}</span>

            <div class="contenidod">
                {!! $discuss->body !!}
            </div>
        </div>

    </div>

    <div class="curse-containerfs">

        <div class="posts-content">
            @foreach ($fposts as $item)
            <div id="{{$item->id }}" class="discussli">
                <div class="imagep"><img src="{{ asset($item->image) }}" alt="Asesor"></div>
                <div class=" discussbody">
                    {!! $item->body !!}
                </div>
                <div class="discussitemcon">
                    <p class="userpost">-{{ $item->usuarioName}}-</p>
                    @if($item->propiedad == 1)
                    <p class="discussitem  eliminarcomentario" id="{{$item->id }}">Eliminar</>
                        <p class="discussitem editarcomentario" id="{{$item->id }}">Editar</p>
                        @endif
                </div>
            </div>
            @endforeach
        </div>

        <button class="nuevocomentario"> Comentar </button>


        <div id="new_discussion">

            <div class="loader dark" id="new_discussion_loader">
                <div></div>
            </div>

            <form id="form_editor" action="/foro/update/{{ $discuss->id }}" method="POST">
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
                <input type="hidden" name="curso" id="curso" value="{{ $curso->id}}">
                <input type="hidden" name="curso" id="curso" value="{{ $curso->id}}">

                <div id="new_discussion_footer">
                    <button id="submit_discussion" class="btn pull-right">
                        actualizar</button>
                    <a class="btn pull-right" id="cancel_discussion">Cancel</a>
                    <div style="clear:both"></div>
                </div>
            </form>

        </div><!-- #new_discussion -->

        <div id="new_comentario">

            <div class="loader dark" id="new_discussion_loader">
                <div></div>
            </div>

            <form id="form_comentario" action="../comentar/{{$discuss->id }}" method="POST">
                <!-- BODY -->
                <div id="editorws">
                    <label id="bodycomen"> Agrega tu contenido aqui:</label>
                    <textarea id="bodycomentario" class="richText" name="body"
                        placeholder="">{{ old('body') }}</textarea>
                </div>
                <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">
                <input type="hidden" name="curso" id="curso" value="{{ $curso->id}}">

                <div id="new_discussion_footer">
                    <button id="submit_discussion" class="btn btn-success pull-right"><i class="chatter-new"></i>
                        Crear</button>
                    <a class="btn btn-default pull-right" id="cancel_discussion">Cancel</a>
                    <div style="clear:both"></div>
                </div>
            </form>

        </div><!-- #new_comentarion -->

        <div id="edit_comentario">

            <div class="loader dark" id="new_discussion_loader">
                <div></div>
            </div>

            <form id="form_comentario" action="/foro/modificarco/{{ $discuss->id }}" method="POST">
                <!-- BODY -->
                <div id="editorwsc">
                    <label id="bodyeditcomen"> Agrega tu contenido aqui:</label>
                    <textarea id="bodyeditcomentario" class="richText" name="body"
                        placeholder="">{{ old('body') }}</textarea>
                </div>
                <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">
                <input type="hidden" name="curso" id="curso" value="{{ $curso->id}}">
                <input type="hidden" name="comentario" id="comentario" value="">

                <div id="new_discussion_footer">
                    <button id="submit_discussion" class="btn btn-success pull-right"><i class="chatter-new"></i>
                        actualizar</button>
                    <a class="btn btn-default pull-right" id="cancel_discussion">Cancel</a>
                    <div style="clear:both"></div>
                </div>
            </form>

        </div><!-- #new_comentarion -->

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