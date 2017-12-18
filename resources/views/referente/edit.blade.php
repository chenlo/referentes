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
         <div class="form-group">
            <div class="table-responsive">  
                {!! Form::label('variantes', 'Variantes formales') !!}
                <table class="table table-bordered" id="dynamic_field">  
                    @foreach($referente->variantes as $variante)
                        <tr id="row{{ $loop->iteration }}" class="dynamic-added"><td><input type="text" name="variantes[]" value="{{ $variante->palabra }}" class="form-control" /></td><td><button type="button" name="remove" id="{{ $loop->iteration }}" class="btn btn-danger btn_remove"><i class="fa fa-remove"> Eliminar</button></td></tr>
                    @endforeach
                    <tr>  
                        <td><input type="text" name="variantes[]" placeholder="Variante formal" class="form-control" /></td>  
                        <td><button type="button" name="add" id="add" class="btn btn-info">
                            <i class="fa fa-plus"></i> Añadir otro variante</button></td>  
                    </tr> 
                </table>  
            </div>
        </div>
     {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
     <a href="{{ url('referentes') }}" class="btn btn-warning">Ver todas los referentes</a> 
     {!! Form::close() !!}
     <br>
</div>
<script type="text/javascript">
    $(document).ready(function(){    
        var i = {{ $referente->variantes->count() }};    
        $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="variantes[]" placeholder="Variante formal" class="form-control" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-remove"> Eliminar</button></td></tr>');  
        });  

        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
        });  
    });  
</script>
@endsection