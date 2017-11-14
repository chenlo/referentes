@extends('layouts.app')

@section('header')
  <h1>Añadir nueva lengua</h1>
@endsection

@section('content')
<div class="panel panel-default">
    {!! Form::open( array('method' => 'POST', 'route' => 'lenguas.store', 'novalidate' => 'novalidate', 'files' => true)) !!}
        <div class="form-group">
             {!! Form::label('nombre', 'Nombre') !!}
             <div class="form-controls">
                  {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la lengua']) !!}
             </div>
        </div>
        <div class="form-group">
             {!! Form::label('imagen', 'Imagen') !!}
             <div class="form-controls mgb-1">
                   {!! Form::file('imagen', null) !!}
             </div>
             <a href="{{url('images/banderas.zip')}}">Descargar archivo con banderas</a>
        </div>
     {!! Form::submit('Añadir nueva lengua', ['class' => 'btn btn-primary']) !!}
     <a href="{{ url('lenguas') }}" class="btn btn-warning">Ver todas las lenguas</a> 
     {!! Form::close() !!}

     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
</div>
@endsection