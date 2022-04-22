@extends('adminlte::page')
@section('title', 'Pago Mantenimiento')
@section('plugins.Datatables', true)
@section('plugins.Animation', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)

@section('content_header')
    <h1>Detalle de transacciones diarias</h1>
@stop

@section('content')

  
         <div class="card">
     <div class="card-body">

     <div class="row">
        <div class="col-sm-6">
        <a  href="{{ route('pay') }}" id="new-mant"  class="btn btn-info col-sm-12" > <i class="fas fa-plus-circle text-white fa-2x"></i> Nuevo Pago</a>
        </div>
        </div>     
         </div>
        </div>
     


    <table id="mant-data" class="table table-striped table-bordered responsive" role="grid"
    aria-describedby="example">
    <thead class="bg-table-header">
       
            <tr role="row">
                <th scope="col">#</th>  
                <th scope="col">FECHA</th>
                <th scope="col">FUR</th>
                <th scope="col">RESPONSABLE</th>
                <th scope="col">GESTION/ES</th>   
                <th scope="col">MONTO</th>  
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>

        <tbody>
            @php($count = 1)
            @foreach ($mant as $mant)
                       
                <tr>
                    <td scope="row">{{ $count++ }}</td>
                   
                    <td>{{ $mant->fecha_pago }}</td>  
                    <td>{{ $mant->fur }}</td>   
                    <td>{{ $mant->nombre }} </td>
                    <td>{{ $mant->gestion }}</td>                          
                    <td>{{ $mant->monto }}</td>                          

                 
                   
                    <td>
                        <button type="button" class="btn btn-info" value="{{ $mant->id }}" id="btn-editar" title="ver detalle"><i class="fas fa-eye"></i></button>
                        {{-- @if($mant->estado =='ACTIVO')
                        <button type="button" class="btn btn-warning" value="{{ $mant->id }}" id="btn-desactivar"><i class="fas fa-thumbs-down"></i></button>
                        @else
                        <button type="button" class="btn btn-success" value="{{ $mant->id }}" id="btn-desactivar"><i class="fas fa-thumbs-up"></i></button>
                        @endif --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    

@stop

@section('css')
<style>
    .modal {
    padding: 2% !important;
    }
    .modal .modal-dialog {
    width: 100%;
    max-width: none;
    
    margin: 0;
    }
    .modal .modal-content {
    height: 95%;
    border: 0;
    border-radius: 0;
    }
    .modal .modal-body {
    overflow-y: auto;
    }
</style>
@stop

@section('js')
    <script> 
    
    $(document).ready(function () {


        var datatable = $('#mant-data').DataTable({
        "paging": true,
        "searching": true,
        "language": {

            "sProcessing": '<p style="color: #012d02;">Cargando. Por favor espere...</p>',
            //"sProcessing": '<img src="https://media.giphy.com/media/3o7bu3XilJ5BOiSGic/giphy.gif" alt="Funny image">',
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ninguna ubicación registrada aún",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": 'Buscar Pago:',
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": 'Primero',
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        },
    });

       
    });

    </script>
@stop