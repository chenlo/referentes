@extends('layouts.app')

@section('header')
  <h1>Tipos de cambio</h1>
@endsection

@section('content')
<div class="panel panel-default">
	<p class="mgb-2">
  		<a href="{{ url('tipos/create') }}" class="btn btn-primary">
		  <i class="fa fa-plus" aria-hidden="true"></i> Añadir nuevo tipo de cambio
	  	</a>
  	</p>
	<table class="table table-striped">
        <thead>
            <tr>
            	<td>Id</td>
              	<td>Nombre</td>
              	<td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach($tipos as $tipo)
	            <tr>
	            	<td>{{$tipo->id}}</td>
	                <td>{{$tipo->nombre}}</td>
					<td class="btn-toolbar">
					  <a href="{{ route('tipos.edit', $tipo->id) }}" class="btn btn-warning"> 
						<i class="fa fa-edit" aria-hidden="true"></i> Editar
					  </a>
					  <form class="boton" action="{{ route('tipos.destroy', $tipo->id) }}" method="post">
						{{csrf_field()}}
						<input name="_method" type="hidden" value="DELETE">
						<button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>
					  </form>
					</td>
	            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection