@extends('layouts.app')

@section('header')
  <h1>Referentes de {{ Auth::user()->name }}</h1>
@endsection

@section('content')
<div class="panel panel-default">
	<p class="mgb-2">
		<a href="{{ url('referentes/create') }}" class="btn btn-primary">
			<i class="fa fa-plus" aria-hidden="true"></i> Añadir nuevo referente
		</a>
	</p>
	<table class="table table-striped">
		<thead>
			<tr>
				<td>Id</td>
				<td>Palabra</td>
				<td>Cambios</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			@forelse ($referentes as $referente)
				<tr>
					<td>{{$referente->id}}</td>
					<td>{{$referente->palabra}}</td>
					<td>
						<ul class="cambios">
							@forelse($referente->cambios as $cambio)
								<li>
									<img src="{{asset('images/banderas/'.$cambio->lengua->id.'.png')}}" alt="">
									{{ $cambio->palabra }}
								</li>
							@empty
								<li>No tiene</li>
							@endforelse
						</ul>
					</td>
					<td class="btn-toolbar">
						<a href="{{ route('referentes.show', $referente->id) }}" class="btn btn-info">
							<i class="fa fa-eye" aria-hidden="true"></i> Ver
						</a>
						<a href="{{ route('referentes.edit', $referente->id) }}" class="btn btn-warning">
							<i class="fa fa-edit" aria-hidden="true"></i> Editar
						</a>
						<form class="boton" action="{{ route('referentes.destroy', $referente->id) }}" method="post">
							{{csrf_field()}}
							<input name="_method" type="hidden" value="DELETE">
							<button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>
						</form>
						<a href="{{ url('cambios/create/'.$referente->id) }}" class="btn btn-success">
							<i class="fa fa-plus-square" aria-hidden="true"></i> Añadir cambio
						</a>
					</td>
				</tr>
			@empty
				<tr><td  colspan="4" class="alert alert-danger">Aún no ha creado ningún referente.</td></tr>
			@endforelse
		</tbody>
	</table>
</div>
@endsection