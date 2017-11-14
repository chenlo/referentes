@extends('layouts.app')

@section('header')
  <h1>Editar {{ $lengua->nombre }} </h1>
@endsection

@section('content')
<div class="panel panel-default">     
    {!! Form::model($lengua, [
        'method' => 'PATCH',
        'route' => ['lenguas.update', $lengua->id],
        'files' => true
    ]) !!}
        <div class="form-group">
             {!! Form::label('nombre', 'Nombre') !!}
             <div class="form-controls">
                  {!! Form::text('nombre', $lengua->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre de la lengua']) !!}
             </div>
        </div>
        <div class="form-group">
             {!! Form::label('imagen', 'Imagen actual') !!}
             
             <div class="form-controls">
                <img src="{{ asset('images/banderas/'.$lengua->id.'.png')}}" alt="" class="">
                {!! Form::file('imagen', null) !!}
             </div>
        </div>
     {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
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