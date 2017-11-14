@extends('layouts.app')

@section('header')
  <h1>Editar {{ $cambio->palabra }} </h1>
@endsection

@section('content')
     
    {!! Form::model($cambio, [
        'method' => 'PATCH',
        'route' => ['cambios.update', $cambio->id]
    ]) !!}
        <div class="form-group{{ $errors->has('lengua_id') ? ' has-error' : '' }}">
            {!! Form::Label('lengua_id', 'Lengua del cambio') !!}
            <div class="form-controls">
                {!! Form::select('lengua_id', $lenguas, $cambio->lengua->id, ['class' => 'form-control', 'placeholder' => 'Seleccionar lengua']) !!}
                @if ($errors->has('lengua_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lengua_id') }}</strong>
                    </span>
                @endif
            </div> 
        </div>
        <div class="form-group{{ $errors->has('palabra') ? ' has-error' : '' }}">
             {!! Form::label('palabra', 'Cambio') !!}
             <div class="form-controls">
                {!! Form::text('palabra', $cambio->palabra, ['class' => 'form-control', 'placeholder' => 'Cambio producido']) !!}
                @if ($errors->has('palabra'))
                    <span class="help-block">
                        <strong>{{ $errors->first('palabra') }}</strong>
                    </span>
                @endif
             </div>
        </div>
        <div class="form-group{{ $errors->has('tipo_id') ? ' has-error' : '' }}">
            {!! Form::Label('tipo_id', 'Tipo de cambio') !!}
            <div class="form-controls">
                {!! Form::select('tipo_id', $tipos, $cambio->tipo->id, ['class' => 'form-control', 'placeholder' => 'Seleccionar tipo']) !!}
                @if ($errors->has('tipo_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tipo_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('definicion') ? ' has-error' : '' }}">
             {!! Form::label('definicion', 'Definición') !!}
             <div class="form-controls">
                {!! Form::textarea('definicion', $cambio->definicion, ['class' => 'form-control', 'placeholder' => 'Definición del cambio']) !!}
                @if ($errors->has('definicion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('definicion') }}</strong>
                    </span>
                @endif
             </div>
        </div>
        <div class="form-group{{ $errors->has('anno_testimonio') ? ' has-error' : '' }}">
             {!! Form::label('anno_testimonio', 'Año del primer testimonio') !!}
             <div class="form-controls">
                {!! Form::text('anno_testimonio', $cambio->anno_testimonio, ['class' => 'form-control', 'placeholder' => 'Año']) !!}
                @if ($errors->has('anno_testimonio'))
                    <span class="help-block">
                        <strong>{{ $errors->first('anno_testimonio') }}</strong>
                    </span>
                @endif
             </div>
        </div>
        <div class="form-group{{ $errors->has('siglo') ? ' has-error' : '' }}">
             {!! Form::label('siglo', 'Siglo del primer testimonio') !!}
             <div class="form-controls">
                {!! Form::text('siglo', $cambio->siglo, ['class' => 'form-control', 'placeholder' => 'Siglo en número']) !!}
                @if ($errors->has('siglo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('siglo') }}</strong>
                    </span>
                @endif
             </div>
        </div>
     {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
     <a href="{{ url('cambios') }}" class="btn btn-warning">Ver todos mis cambios</a>    
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

@endsection