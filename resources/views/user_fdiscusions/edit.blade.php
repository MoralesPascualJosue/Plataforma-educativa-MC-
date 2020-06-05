@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Fdiscusion
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userFdiscusion, ['route' => ['userFdiscusions.update', $userFdiscusion->id], 'method' => 'patch']) !!}

                        @include('user_fdiscusions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection