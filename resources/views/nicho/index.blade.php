@extends('adminlte::page')
@section('title', 'Bloque')
@section('plugins.Datatables', true)
@section('plugins.Animation', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)
@section('plugins.Pace', true)


@section('content_header')
    <h1>Listado de nichos</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">


    <div class="row">
        <div class="col-sm-6">
        <button id="new-nicho" type="button" class="btn btn-info col-sm-12" > <i class="fas fa-plus-circle text-white fa-2x"></i> Crear Nicho</button>
        </div>
        </div>

    </div>
 </div>


       
        <div class="col-sm-12">
            <table id="nicho-data" class="table table-striped table-bordered responsive" role="grid"
            aria-describedby="example">
            <thead class="bg-table-header">
               
                    <tr role="row">
                        <th scope="col">#</th>                           
                        <th scope="col">Código</th>  
                        <th scope="col">Cuartel</th>
                        <th scope="col">Bloque</th>
                        <th scope="col">Nro</th>
                        <th scope="col">Fila</th>
                       
                        <th scope="col">Cantidad</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Código Antiguo</th>
                        <th scope="col">Estado</th>   
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @php($count = 1)
                    @foreach ($nicho as $nicho)
                               
                        <tr>
                            <td scope="row">{{ $count++ }}</td>
                           
                            <td>{{ $nicho->codigo }}</td> 
                            <td>{{ $nicho->cuartel_cod }}</td> 
                            <td>{{ $nicho->bloque_id }}</td>
                            <td>{{ $nicho->nro_nicho }}</td>
                            <td>{{ $nicho->fila }}</td>
                          
                            <td>{{ $nicho->cantidad_cuerpos }}</td>
                            <td>{{ $nicho->tipo }}</td>
                            <td>{{ $nicho->codigo_anterior }}</td>
                            
                            <td>{{ $nicho->estado }}</td>  
                            <td>
                                <button type="button" class="btn btn-info" value="{{ $nicho->id }}" id="btn-editar" title="Editar nicho"><i class="fas fa-edit"></i></button>
                                                              
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        

        @include('nicho.modalRegister') 


    <!-- Modal -->
<div class="modal fade  animated bounceIn" id="edit-nicho" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Nicho</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-xl-4">
                        <div class="col-sm-12 col-md-12 col-xl-12 form-group">

                            <label>Cuartel</label>
                           
                            <select style="width: 100%"  id="cuartel_edit" onchange="generateCode_edit()" >                                      
                                <option>SELECCIONAR</option>
                              
                                @foreach($cuartel as $c1)
                                <option value={{ $c1->id}}> {{ $c1->codigo }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <div class="col-sm-12 col-md-4 col-xl-4">
                    <div class="col-sm-12 col-md-12 col-xl-12 form-group">

                        <label>Bloque</label>
                       
                        <select style="width: 100%"  class = "form-control" id="bloque_edit" onchange="generateCode_edit()" >                                      
                            @foreach($bloque as $b1)
                            <option value={{ $b1->id}}> {{ $b1->codigo }}</option>
                            @endforeach
                        </select>
                    </div>
                 </div>

                 <div class="col-sm-12 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label>Nro:</label>
                        <input style="text-transform:uppercase;" onblur="generateCode_edit()" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="nro_edit" autocomplete="off">
                    </div>
                 </div>
            </div>
            <div class="row">
              
                <div class="col-sm-12 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label>Fila:</label>
                        <input style="text-transform:uppercase;" onblur="generateCode_edit()" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="fila_edit" autocomplete="off">
                    </div>
                </div>

             

                <div class="col-sm-12 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label>Codigo anterior:</label>
                        <input style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="anterior_edit" autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3">
                    <div class="form-group">
                        <label>Codigo:</label>
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="code_edit" autocomplete="off" readonly>
                    </div>
                </div>

            </div>
    


            <div class="row" >
                <div class="col-md-4 col-xl-4">
                    <div class="form-group">
                        <label>Cantidad de  cuerpos:</label>
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="cant_edit" autocomplete="off">
                    </div>
                </div>    
                
                <div class="col-md-4 col-xl-4">
                    <div class="form-group">
                        <label>Tipo de  nicho:</label>
                        <select name="tipo" id="tipo_edit" class="form-control">
                            <option value="TEMPORAL">TEMPORAL</option>
                            <option value="PERPETUO">PERPETUO</option>

                        </select>
                        
                    </div>
                </div>   

                <div class="form-group col-md-4 col-xl-4">
                    <label>Estado:</label>
                    <select name="status" id="status_edit" class="form-control">        
                        <option value="ACTIVO"> ACTIVO</option>
                        <option value="INACTIVO"> INACTIVO</option>
                    </select>                           
                </div> 
            </div>


        <div class="modal-footer">
          <button type="button" id="edit-nicho" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btn-editar-va">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>
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

@section('js')
    <script> 
    
    $(document).ready(function () {

        //editar nicho
        $('#btn-editar-va').on('click', function(){
            $.ajax({
                        type: 'PUT',
                        headers: {
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        url: "{{ route('nicho.update') }}",
                        async: false,
                        data: JSON.stringify({
                            'bloque':  $('#bloque_edit').val(),
                            'codigo':  $('#code_edit').val(),
                            'cuartel':  $('#cuartel_edit').val(),
                            'fila':  $('#fila_edit').val(),
                          
                            'nro':  $('#nro_edit').val(),
                            'anterior':  $('#anterior_edit').val(),
                            'cantidad':  $('#cant_edit').val(),
                            'tipo':  $('#tipo_edit').val(),

                            'estado': $('#status_edit').val(),
                            'id': $('#btn-editar-va').val()
                        }),
                        success: function(data_response) {
                            swal.fire({
                            title: "Guardado!",
                            text: "!Registro actualizado con éxito!",
                            type: "success",
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                            });
                            setTimeout(function() { 
                                location.reload();
                            }, 2000);
                            
                        },
                        error: function (error) {
                            
                            if(error.status == 422){
                                Object.keys(error.responseJSON.errors).forEach(function(k){
                                toastr["error"](error.responseJSON.errors[k]);
                                //console.log(k + ' - ' + error.responseJSON.errors[k]);
                                });
                            }else if(error.status == 400){
                                swal.fire({
                            title: "Duplicado!",
                            text: "!Transacción rechazada!",
                            type: "error",
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                            });
                            setTimeout(function() { 
                                location.reload();
                            }, 2000);
                            }

                        }
                    })


        });

        $('#btn_guardar_nicho').on('click', function(){
           
            return  $.ajax({
                        type: 'POST',
                        headers: {
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        url: "{{ route('new.nicho') }}",
                        async: false,
                        data: JSON.stringify({
                            'codigo': $('#code').val(),
                            'bloque':  $('#bloque option:selected').val(),
                            'cuartel':  $('#cuartel').val(),
                            'fila':  $('#fila').val(),
                            'tipo':  $('#tipo').val(),
                         
                            'nro':  $('#nro').val(),
                            'cantidad':  $('#cant').val(),
                            'codigo_anterior':  $('#anterior').val(),
                            'estado':  $('#status option:selected').val(),
                        }),
                        success: function(data_response) {
                            swal.fire({
                            title: "Guardado!",
                            text: "!Registro realizado con éxito!",
                            type: "success",
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                            });
                            setTimeout(function() { 
                                location.reload();
                            }, 2000);
                            //toastr["success"]("Registro realizado con éxito!");
                        },
                        error: function (error) {
                            
                            if(error.status == 422){
                                Object.keys(error.responseJSON.errors).forEach(function(k){
                                toastr["error"](error.responseJSON.errors[k]);
                                //console.log(k + ' - ' + error.responseJSON.errors[k]);
                                });
                            }else if(error.status == 400){
                                swal.fire({
                                    title: "Registro Duplicado!",
                                    text: "!Transacción rechazada!",
                                    type: "error",
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                    });
                                    setTimeout(function() { 
                                        location.reload();
                                    }, 2000);
                            }

                        }
                    })
        });

        $(document).on('click', '#btn-editar', function(){
      
            $('#btn-editar-va').val($(this).val());
     
            $.ajax({
                        type: 'GET',
                        headers: {
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        url: '/nicho/get-nicho/' + $(this).val(),
                        async: false,
                        success: function(data_response) {
                           
                            $('#edit-nicho').modal('show');
                            // $('#bloque_edit option[value="'+data_response.response.bloque_id+'"]').attr("selected", "selected");
                            $('#bloque_edit').val(data_response.response.bloque_id).trigger('change');
                            $('#cuartel_edit').val(data_response.response.cuartel_id).trigger('change');
                            
                            $('#code_edit').val(data_response.response.codigo);  
                            $('#fila_edit').val(data_response.response.fila);  
                            $('#col_edit').val(data_response.response.columna);  
                            $('#anterior_edit').val(data_response.response.codigo_anterior);  
                            $('#cant_edit').val(data_response.response.cantidad_cuerpos);  
                            $('#tipo_edit option[value="'+data_response.response.tipo+'"]').attr("selected", "selected");
                          
                            $('#nro_edit').val(data_response.response.nro_nicho);  

                            $('#status_edit option[value="'+data_response.response.estado+'"]').attr("selected", "selected");
                        }
                    })
        });


        



        $('#new-nicho').on('click', function(){
            $('#modal-register-nicho').modal('show');
        });

        var datatable = $('#nicho-data').DataTable({
        "paging": true,
        "searching": true,
        "language": {

            "sProcessing": '<p style="color: #012d02;">Cargando. Por favor espere...</p>',
            //"sProcessing": '<img src="https://media.giphy.com/media/3o7bu3XilJ5BOiSGic/giphy.gif" alt="Funny image">',
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningun registro",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": 'Buscar:',
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



    //select2 cuartel
    $("#cuartel").select2({
                        width: 'resolve', // need to override the changed default
                        dropdownParent: $('#modal-register-nicho')
                    });

  //select2 cuartel
  $("#cuartel_edit").select2({
                        width: 'resolve', // need to override the changed default
                        dropdownParent: $('#edit-nicho')
                    });

       

    //select2 bloque
    $("#bloque").select2({
                        width: 'resolve', // need to override the changed default
                        dropdownParent: $('#modal-register-nicho')
                    });

  //select2 cuartel
  $("#bloque_edit").select2({
                        width: 'resolve', // need to override the changed default
                        dropdownParent: $('#edit-nicho')
                    });

    });


    function generateCode(){
        var nro=$.trim($('#nro').val());
        var fila=$.trim($('#fila').val());
        var bloq=$.trim($('#bloque option:selected').text()); 
        var cuart=$.trim($('#cuartel option:selected').text());
        var cod="";
       
        if(nro!='' && fila!='' && bloque!='' && cuartel !=''){
            cod=cuart+"."+bloq+"."+nro+"."+fila;
            $('#code').val(cod);
        }
else{
    return false;
}

    }

    function generateCode_edit(){
        var nro=$.trim($('#nro_edit').val());
        var fila=$.trim($('#fila_edit').val());
        var bloq=$.trim($('#bloque_edit option:selected').text()); 
        var cuart=$.trim($('#cuartel_edit option:selected').text());
        var cod="";
       
        if(nro!='' && fila!='' && bloque!='' && cuartel !=''){
            cod=cuart+"."+bloq+"."+nro+"."+fila;
            $('#code_edit').val(cod);
        }
else{
    return false;
}

    }

    $(document).on('change', '#cuartel', function(){
        $('#bloque').empty();
        var sel_cuartel=$('#cuartel').val();
              $('#bloque').prop('disabled', false);
                $.ajax({
                    type: 'POST',
                        headers: {
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        url: "{{ route('bloqueid.get') }}",
                        async: false,
                        data: JSON.stringify({
                            'cuartel': $('#cuartel').val(),
                        }),
                        success: function(data_bloque) {
                           console.log(data_bloque) ;

                            var op1='<option >SELECCIONAR</option>';
                            $('#bloque').append(op1);
                           $.each( data_bloque.response, function( key, value ) {                               
                                 opt2='<option value="'+ value.id +'">'+value.codigo +'</option>';
                                 $('#bloque').append(opt2);
                            });                                                    
                        }
                });
    });


    //bloque_edit

    $(document).on('change', '#cuartel_edit', function(){
        $('#bloque_edit').empty();
        var sel_cuartel=$('#cuartel_edit').val();
              $('#bloque_edit').prop('disabled', false);
                $.ajax({
                    type: 'POST',
                        headers: {
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        url: "{{ route('bloqueid.get') }}",
                        async: false,
                        data: JSON.stringify({
                            'cuartel': $('#cuartel_edit').val(),
                        }),
                        success: function(data_bloque) {
                           console.log(data_bloque) ;

                            var op1='<option >SELECCIONAR</option>';
                            $('#bloque_edit').append(op1);
                           $.each( data_bloque.response, function( key, value ) {                               
                                 opt2='<option value="'+ value.id +'">'+value.codigo +'</option>';
                                 $('#bloque_edit').append(opt2);
                            });                                                    
                        }
                });
    });

    </script>
@stop