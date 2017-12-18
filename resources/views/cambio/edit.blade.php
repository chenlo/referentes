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
        <div class="form-group">
            <div class="table-responsive">  
                {!! Form::label('acepcions', 'Acepciones') !!}
                <table class="table table-bordered" id="dynamic_field">
                    <tr>
                        <td colspan="2"> <button type="button" name="add" id="add" class="form-control btn btn-info">
                            <i class="fa fa-plus"></i> Añadir otra acepción</button>
                        </td>
                    </tr> 
                    @foreach($cambio->acepcions as $acepcion)
                        <tr id="row{{ $loop->iteration }}" class="dynamic-added">
                            <td><input type="text" name="acepcions[]" value="{{ $acepcion->palabra }}" class="form-control" /></td>
                            <td><button type="button" name="remove" id="{{ $loop->iteration }}" class="btn btn-danger btn_remove"><i class="fa fa-remove"> Eliminar</button></td>
                        </tr>
                    @endforeach
                </table>  
            </div>
        </div>
        <legend>Recategorización</legend>
        <div class="form-group">
            <div class="form-controls row">
                <div class="col-sm-6">
                    {!! Form::select('inicial_categoria_id', $categorias_iniciales, $cambio->recategorizacion->inicialCategoria->id, ['class' => 'form-control', 'placeholder' => 'Seleccionar categoría inicial']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::select('final_categoria_id', $categorias_finales, $cambio->recategorizacion->finalCategoria->id, ['class' => 'form-control', 'placeholder' => 'Seleccionar categoría final']) !!}
                </div>
            </div>
        </div>
        <legend>Cronología</legend>
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
    <br>
     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
<script type="text/javascript">
    $(document).ready(function(){    
        var i = {{ $cambio->acepcions->count() }};    
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