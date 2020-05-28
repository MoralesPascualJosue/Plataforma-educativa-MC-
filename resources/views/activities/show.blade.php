@extends('layouts.activitie')

@section('content')
<section class="content-header">
    <h1>
        Activitie
    </h1>
</section>
<div class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">
                @include('activities.show_fields')
                <a href="{{ route('scursoc','1') }}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection