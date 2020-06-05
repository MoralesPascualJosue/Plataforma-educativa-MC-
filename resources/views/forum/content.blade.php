@extends('forum.forum')


@section('content')

<script>
    $("div.alert")
        .not(".alert-important")
        .delay(3000)
        .fadeOut(350);
</script>

@include('flash::message')

<div class="container">

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
        <p class="cursoreview">Mensaje</p>

    </div>

    <div class="curse-container">

        <div class="column-content">
            @foreach ($discuss as $item)
            <div class="box">
                <li>
                    {{ $item->title  }}
                </li>
                <li>
                    {{ $item->body }}
                </li>
            </div>
            @endforeach
        </div>


    </div>

</div>
@endsection

@push('script')
@endpush