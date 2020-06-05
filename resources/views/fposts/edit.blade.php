@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Fpost
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($fpost, ['route' => ['fposts.update', $fpost->id], 'method' => 'patch']) !!}

                        @include('fposts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection