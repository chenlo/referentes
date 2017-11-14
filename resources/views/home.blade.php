@extends('layouts.app')

@section('header')
  <h3>Gestor de referentes</h3>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading"><h4>Referentes</h4></div>
          <div class="panel-body big-number">
            {{ Referentes\Referente::count() }}
          </div>
        </div>      
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading"><h4>Cambios</h4></div>
          <div class="panel-body big-number">
            {{ Referentes\Cambio::count() }}
          </div>
        </div>      
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading"><h4>Lenguas</h4></div>
          <div class="panel-body big-number">
            {{ Referentes\Lengua::count() }}
          </div>
        </div>      
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading"><h4>Colaboradores</h4></div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                  <tr>
                    <td>Nombre</td>
                    <td>Núm. de referentes</td>
                    <td>Núm. de cambios</td>
                  </tr>
              </thead>
              <tbody>
                  @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->getCountReferentes() }}</td>
                        <td>{{ $user->getCountCambios() }}</td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
          </div>
        </div>      
      </div>
    </div>
  </div>
  
@endsection