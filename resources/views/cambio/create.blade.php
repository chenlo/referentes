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
        <div class="form-group">
            <div class="table-responsive">  
                {!! Form::label('acepcions', 'Acepciones') !!}
                <table class="table table-bordered" id="dynamic_field">  
                    <tr>  
                        <td><input type="text" name="acepcions[]" placeholder="Acepción" class="form-control" /></td>  
                        <td><button type="button" name="add" id="add" class="btn btn-info">
                            <i class="fa fa-plus"></i> Añadir otra acepción</button></td>  
                    </tr>  
                </table>  
            </div>
        </div>
        <legend>Recategorización</legend>
         <div class="form-group{{ $errors->has('inicial_categoria_id')||$errors->has('final_categoria_id') ? ' has-error' : '' }}">
            <div class="form-controls row">
                <div class="col-sm-6">
                    {!! Form::select('inicial_categoria_id', $categorias_iniciales, null, ['class' => 'form-control', 'placeholder' => 'Seleccionar categoría inicial']) !!}
                    @if ($errors->has('inicial_categoria_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('inicial_categoria_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-sm-6">
                    {!! Form::select('final_categoria_id', $categorias_finales, null, ['class' => 'form-control', 'placeholder' => 'Seleccionar categoría final']) !!}
                    @if ($errors->has('final_categoria_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('final_categoria_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <legend>Cronología</legend>
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
        <br>
        {!! Form::submit('Añadir nuevo cambio', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('referentes.show', $referente->id) }}" class="btn btn-warning">Ver el referente</a> 
        {!! Form::close() !!}
    <script type="text/javascript">
        $(document).ready(function(){    
            var i=1;    
            $('#add').click(function(){  
               i++;  
               $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="acepcions[]" placeholder="Acepción" class="form-control" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-remove"> Eliminar</button></td></tr>');  
            });  

            $(document).on('click', '.btn_remove', function(){  
               var button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
            });  
        });  
    </script>
@endsection