@extends('layouts.app')

@section('header')
  Lenguas
@endsection

@section('content')
<div class="panel panel-default">
  <p class="mgb-2">
    <a href="{{ url('lenguas/create') }}" class="btn btn-primary">
			<i class="fa fa-plus" aria-hidden="true"></i> Añadir nueva lengua
		</a>
	</p>
	<table class="table table-striped">
        <thead>
            <tr>
            	<td>Id</td>
              	<td>Img</td>
              	<td>Nombre</td>
              	<td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach($lenguas as $lengua)
	            <tr>
	            	<td>{{$lengua->id}}</td>
	                <td>
	                	<img src="{{asset('images/banderas/'.$lengua->id.'.png')}}" alt="" class="bandera">
	                </td>
                  <td>{{$lengua->nombre}}</td>
                  <td class="btn-toolbar">
                    <a href="{{ route('lenguas.edit', $lengua->id) }}" class="btn btn-warning"> 
                      <i class="fa fa-edit" aria-hidden="true"></i> Editar
                    </a>
                    <form class="boton" action="{{ route('lenguas.destroy', $lengua->id) }}" method="post">
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