@extends('layouts.app')

@section('header')
  <h1>Añadir nuevo tipo de cambio</h1>
@endsection

@section('content')
<div class="container">
     
     {!! Form::open( array('method' => 'POST', 'route' => 'tipos.store')) !!}
        <div class="form-group">
             {!! Form::label('nombre', 'Nombre') !!}
             <div class="form-controls">
                  {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre del tipo de cambio']) !!}
             </div>
        </div>
     {!! Form::submit('Añadir nuevo tipo de cambio', ['class' => 'btn btn-primary']) !!}
     <a href="{{ url('tipos') }}" class="btn btn-warning">Ver todos los tipos de cambios</a> 
     {!! Form::close() !!}
</div>
<br>
<div class="container">
     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
</di>
@endsection