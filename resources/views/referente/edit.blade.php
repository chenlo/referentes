@extends('layouts.app')

@section('header')
  <h1>Editar {{ $referente->palabra }}</h1>
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
    {!! Form::model($referente, ['method' => 'PATCH', 'route' => ['referentes.update', $referente->id] ]) !!}	
        <div class="form-group">
             {!! Form::label('palabra', 'Referente inicial') !!}
             <div class="form-controls">
                  {!! Form::text('palabra', null, ['class' => 'form-control', 'placeholder' => 'Referente inicial']) !!}
             </div>
        </div>
        <div class="form-group">
             {!! Form::label('informacion_enciclopedica', 'Información enciclopédica') !!}
             <div class="form-controls">
                  {!! Form::textarea('informacion_enciclopedica', null, ['class' => 'form-control', 'placeholder' => 'Información enciclopédica']) !!}
             </div>
        </div>
     {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
     <a href="{{ url('referentes') }}" class="btn btn-warning">Ver todas los referentes</a> 
     {!! Form::close() !!}
     <br>
</div>
@endsection