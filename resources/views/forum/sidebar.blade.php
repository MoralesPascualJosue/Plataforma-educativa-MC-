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