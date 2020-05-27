@extends('layouts.app')

@section('title', 'Inicio')


@section('css')
@endsection

@section('content')


<div class="clases-header">
    <h2>Clases</h2>
</div>

<div class="clases">

    <div class="clases-options-bar">
        @can('edit cursos')
        <div class="options-ba-lr vis-opt">
            <div class="icon">
                <a class="create-cl" href="javascript:void(0);">
                    <img src="{{ asset('resources/icons/apilar-ci.svg') }}" alt="gv">
                </a>
            </div>
            <div class="icon">
                <span>Nuevo curso</span>
            </div>
        </div>
        @endCan
        <div class="options-bar-r">

            <form action="/action_page.php">
                <label class="small-text" for="numberEle">Elementos por página:</label>
                <select id="numberEle" name="numberEle">
                    <option value="12" selected>12</option>
                    <option value="24">24</option>
                    <option value="48">48</option>
                </select>
                <input class="btn" type="submit" value="Go!">
            </form>

        </div>
    </div>


    <div id="clases-content" class="clases-content">
        @include('cursos.showclases')
    </div>
    {{ $cursos->links() }}
</div>

<script>
    $("div.alert")
    .not(".alert-important")
    .delay(3000)
    .fadeOut(350);
</script>

@endsection