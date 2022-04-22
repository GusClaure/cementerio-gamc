@extends('adminlte::page')
@section('title', 'Register Servicio')
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)

@section('content_header')
    <h1>Listado de servicios</h1>
@stop

@section('content')


  
        <div class="modal-body">
            <div class="col-sm-12 col-md-12 col-xl-12 card m-auto">

                <div class="card" >
                    <div class="card-header">
                        <h2 id="infoPlazo" class="clean"></h2>
                    </div>
                </div>

                {{-- datos busqueda --}}

                <div class="card">
                    <div class="card-header">
                        <h4>REGISTRAR PAGO MANTENIMIENTO NICHO</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-xl-3">
                                <label>NRO NICHO</label>                                   
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control " id="nro_nicho" autocomplete="off">
                            </div>

                            <div class="col-sm-12 col-md-3 col-xl-3">
                                <label>BLOQUE</label>                                   
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control " id="bloque" autocomplete="off">
                            </div>
                            <div class="col-sm-12 col-md-3 col-xl-3">
                                <label>FILA</label>                                   
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control " id="fila" autocomplete="off">
                            </div>

                            <div class="col-sm-12 col-md-3 col-xl-3 p-4 mt-2">
                                <button type="button" class="btn btn-info" id="buscar">
                                    <span id="sp"></span> <i class="fa fa-search"></i>BUSCAR
                                </button>
                            </div>
                        </div>         
                    </div>
                </div>

        </div> 
    </div> 
@stop