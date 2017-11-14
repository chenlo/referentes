@extends('layouts.app')

@section('header')
  <h1>Editar {{ $tipo->nombre }} </h1>
@endsection

@section('content')
<div class="panel panel-default">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif     
    {!! Form::model($tipo, [
        'method' => 'PATCH',
        'route' => ['tipos.update', $tipo->id],
    ]) !!}
        <div class="form-group">
             {!! Form::label('nombre', 'Nombre') !!}
             <div class="form-controls">
                  {!! Form::text('nombre', $tipo->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre del tipo de cambio']) !!}
             </div>
        </div>
     {!! Form::submit('Actualizar el tipo de cambio', ['class' => 'btn btn-primary']) !!}
     <a href="{{ url('tipos') }}" class="btn btn-warning">Ver todos los tipos de cambio</a>    
     {!! Form::close() !!}
</di>
@endsection