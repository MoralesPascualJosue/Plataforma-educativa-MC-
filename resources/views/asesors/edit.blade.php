@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Asesor
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($asesor, ['route' => ['asesors.update', $asesor->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('asesors.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@push('scripts')
    <script src="{{asset('ckeditor/ckeditor5 1/build/ckeditor.js')}}"> </script> 
    <script src="{{asset('ckeditor/ckfinder/ckfinder.js')}}"> </script>    
    <script src="{{ asset('js/ck.js') }}"></script>         
@endpush