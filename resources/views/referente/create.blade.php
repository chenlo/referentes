@extends('layouts.app')

@section('header')
  <h1>Añadir nuevo referente</h1>
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
    {!! Form::open( array('method' => 'POST', 'route' => 'referentes.store')) !!}
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
                    <tr>  
                        <td><input type="text" name="variantes[]" placeholder="Variante formal" class="form-control" /></td>  
                        <td><button type="button" name="add" id="add" class="btn btn-info">
                            <i class="fa fa-plus"></i> Añadir otro variante</button></td>  
                    </tr>  
                </table>  
            </div>
        </div>
     {!! Form::submit('Añadir nuevo referente', ['class' => 'btn btn-primary']) !!}
     <a href="{{ url('referentes') }}" class="btn btn-warning">Ver todas los referentes</a> 
     {!! Form::close() !!}
     <br>
</div>
<script type="text/javascript">
    $(document).ready(function(){    
        var i=1;    
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