@extends('layouts.app')

@section('header')
  <h1>Cambios de {{ Auth::user()->name }}</h1>
@endsection

@section('content')
<div class="panel panel-default">
  <table class="table table-striped">
    <thead>
      <tr>
        <td>Palabra</td>
        <td>Lengua</td>
        <td>Tipo</td>
        <td>Año testimonio</td>
        <td>Siglo</td>
        <td>Propietario</td>
        <td>Acciones</td>
      </tr>
    </thead>
    <tbody>
      @forelse ($cambios as $cambio)
        <tr>
          <td>{{$cambio->palabra}}</td>
          <td>{{$cambio->lengua->nombre}}</td>
          <td>{{$cambio->tipo->palabra}}</td>
          <td>
            @if($cambio->anno_testimonio)
              {{ $cambio->anno_testimonio }}
            @else
              No especificado
            @endif
          </td>
          <td>{{$cambio->getSiglo()}}</td>
          <td>{{$cambio->user->name}}</td>
          <td class="btn-toolbar">
            @if (Auth::user()->ownsCambio($cambio))
              <a href="{{ route('cambios.edit', $cambio->id) }}" class="btn btn-warning">
                <i class="fa fa-edit" aria-hidden="true"></i> Editar cambio
              </a>
              <form class="boton" action="{{ route('cambios.destroy', $cambio->id) }}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar cambio</button>
              </form>
            @endif
          </td>
        </tr>
      @empty
        <tr><td  colspan="4" class="alert alert-danger">Aún no ha creado ningún referente.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection