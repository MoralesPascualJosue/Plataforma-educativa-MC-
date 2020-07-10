@extends('layouts.app')

@section('title', 'Inicio')

@section('content')


<div class="clases-header">
    <h2>Clases</h2>
</div>

<div class="clases">

    <div class="clases-options-bar">
        @can('edit cursos')
        <div class="options-ba-lr vis-opt">
            <div class="icon create-cl">
                <form action="storeac" method="POST">
                    @csrf
                    {!! Form::hidden("top", "top") !!}
                    <button type="submit"><img src="{{ asset('resources/icons/apilar-ci.svg') }}" alt="gv"></button>
                </form>
            </div>
            <div class="icon">
                <span>Nuevo curso</span>
            </div>
        </div>
        @endCan
        <div class="options-bar-r">

            <form action="inicio">
                <label class="small-text" for="ele">Elementos por página:</label>
                <select id="ele" name="ele">
                    <option value="12" {{ (Request('ele') == 12) ? 'selected' : '' }}>12</option>
                    <option value="24" {{ (Request('ele') == 24) ? 'selected' : '' }}>24</option>
                    <option value="48" {{ (Request('ele') == 48) ? 'selected' : '' }}>48</option>
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