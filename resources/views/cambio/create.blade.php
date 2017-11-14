@extends('layouts.app')

@section('header')
  <h1>Añadir cambio a {{ $referente->palabra }}</h1>
@endsection

@section('content')

    {!! Form::open( array('method' => 'POST', 'route' => 'cambios.store')) !!}
        <input type="hidden" name="referente_id" value="{{ $referente->id }}">
        <div class="form-group{{ $errors->has('lengua_id') ? ' has-error' : '' }}">
            {!! Form::Label('lengua_id', 'Lengua del cambio') !!}
            <div class="form-controls">
                {!! Form::select('lengua_id', $lenguas, Auth::user()->lengua_id, ['class' => 'form-control', 'placeholder' => 'Seleccionar lengua']) !!}
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
                {!! Form::text('palabra', null, ['class' => 'form-control', 'placeholder' => 'Cambio producido']) !!}
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
                {!! Form::select('tipo_id', $tipos, null, ['class' => 'form-control', 'placeholder' => 'Seleccionar tipo']) !!}
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
                {!! Form::textarea('definicion', null, ['class' => 'form-control', 'placeholder' => 'Definición del cambio']) !!}
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
                {!! Form::text('anno_testimonio', null, ['class' => 'form-control', 'placeholder' => 'Año']) !!}
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
                {!! Form::text('siglo', null, ['class' => 'form-control', 'placeholder' => 'Siglo en número']) !!}
                @if ($errors->has('siglo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('siglo') }}</strong>
                    </span>
                @endif
             </div>
        </div>
        {!! Form::submit('Añadir nuevo cambio', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('referentes.show', $referente->id) }}" class="btn btn-warning">Ver el referente</a> 
        {!! Form::close() !!}
@endsection