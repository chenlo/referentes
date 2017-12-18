@extends('layouts.app')

@section('header')
  <h1>{{ $cambio->palabra }}</h1>
@endsection
@section('content')
<div class="panel panel-default">
    <div class="container">
       <div class="row">
         <div class="col-md-9">
          <strong>Palabra</strong>
          <p>{{ $referente->palabra }}</p>
          <strong>Información enciclopédica</strong>
          <p>{{ $referente->informacion_enciclopedica }}</p>
         </div>
         <div class="col-md-3">
            @if (Auth::user()->ownsReferente($referente))
              <a href="{{ route('referentes.edit', $referente->id) }}" class="btn btn-warning">
                <i class="fa fa-edit" aria-hidden="true"></i> Editar referente
              </a>
            @endif
         </div>
       </div>
        <div class="row">
           <div class="col-md-12">
              <strong>Variantes</strong>
              @forelse($referente->variantes as $variante)
                <p>
                  <strong>{{ $loop->iteration }}. </strong>
                  {{ $variante->palabra }}
                </p>
              @empty
                <p>No tiene variantes</p>
              @endforelse
           </div>
        </div>
    </div>
    <div class="container">
      <div class="row">
          <div class="col-md-9">
              <h3>Cambios</h3>
          </div>
          <div class="col-md-3">
              <a href="{{ url('cambios/create/'.$referente->id) }}" class="btn btn-success">
              <i class="fa fa-plus-square" aria-hidden="true"></i> Añadir cambio
            </a>
          </div>
      </div>
    </div>
      @forelse($referente->cambios as $cambio)
        <div class="panel-default">
          <div class="panel-heading">
            <img src="{{asset('images/banderas/'.$cambio->lengua->id.'.png')}}" alt="" class="bandera-ficha">
            <span class="cambio-header">{{ $cambio->palabra }}</span>
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
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-6">
                <strong>Tipo de cambio</strong>
                <p>{{ $cambio->tipo->nombre }}</p>
                <strong>Acepciones</strong>
                @forelse($cambio->acepcions as $acepcion)
                  <p>
                    <strong>{{ $loop->iteration }}. </strong>
                    {{ $acepcion->palabra }}
                  </p>
                @empty
                  <p>No tiene acepciones</p>
                @endforelse
              </div>
              <div class="col-md-6">
                <strong>Lengua</strong>
                <p>{{ $cambio->lengua->nombre }}</p>
                <strong>Año del primer testimonio</strong>
                <p>
                  @if($cambio->anno_testimonio)
                    {{ $cambio->anno_testimonio }}
                  @else
                    No especificado
                  @endif
                </p>
                <strong>Siglo</strong>
                <p>{{ $cambio->getSiglo() }}</p>
              </div>
            </div>
          </div>   
          </div> 
      @empty
        <div class="panel-default mgt-2">
          <span class="alert alert-danger">No tiene cambios</span>
        </div>
      @endforelse
    
    <p class="mgt-2"><a href="{{ url('referentes') }}" class="btn btn-info">Ver todos los referentes</a></p>
</div>
@endsection