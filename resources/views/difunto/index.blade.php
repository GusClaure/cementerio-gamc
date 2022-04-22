@extends('adminlte::page')
@section('title', 'Cuartel')
@section('plugins.Datatables', true)
@section('plugins.Animation', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)
@section('plugins.dropzone', true)


@section('content_header')
    <h1>Listado de Difuntos</h1>
@stop

@section('content')

  
         <div class="card">
     <div class="card-body">
     <button id="new-difunto" type="button" class="btn btn-info col-4" > <i class="fas fa-plus-circle text-white fa-2x"></i> Crear Difunto</button>
         </div>
        </div>

    <table id="difunto-data" class="table table-striped table-bordered responsive" role="grid"
    aria-describedby="example">
    <thead class="bg-table-header">
       
            <tr role="row">
                <th scope="col">#</th>                           
                <th scope="col">Cedula de identidad</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha de defunción</th>  
                <th scope="col">Causa</th>
                <th scope="col">Tipo</th>       
                <th scope="col">Opciones</th>
            </tr>
        </thead>

        <tbody>
            @php($count = 1)
            @foreach ($difunto as $difunto)
                       
                <tr>
                    <td scope="row">{{ $count++ }}</td>
                   
                    <td>{{ $difunto->ci }}</td>                           
                    <td>{{ $difunto->nombre }}</td>
                    <td>{{ $difunto->fecha_defuncion }}</td>
                    <td>{{ $difunto->causa }}</td>
                    <td>{{ $difunto->tipo }}</td>
                   
                    <td>
                        <button type="button" class="btn btn-info" value="{{ $difunto->id }}" id="btn-editar-difunto-value" title="Editar datos difunto"><i class="fas fa-edit"></i></button>
                        @if($difunto->estado =='ACTIVO')
                        <button type="button" class="btn btn-warning" value="{{ $difunto->id }}" id="btn-desactivar"><i class="fas fa-thumbs-down"></i></button>
                        @else
                        <button type="button" class="btn btn-success" value="{{ $difunto->id }}" id="btn-desactivar"><i class="fas fa-thumbs-up"></i></button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
<!-- Modal registro nuevo difunto -->
<div class="modal fade fullscreen-modal animated bounceIn" id="modal-register-difunto" data-backdrop="static" tabindex="-1" role="dialog"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" style="text-align: center">Registro Nuevo Difunto</h3>
            <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="card">
                <div class="card-body">
            
                    <div class="row">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cedula de Identidad:</label>
                                    <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="ci" autocomplete="off">
                                </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nombre :</label>
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="nombre" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Primer apellido :</label>
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="primer_apellido" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Segundo apellido :</label>
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="segundo_apellido" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de nacimiento :</label>
                                <input type="date"  class="form-control" max="{{ date('Y-m-d') }}" placeholder="fecha de nacimiento" id="fecha_nacimiento" >
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de defunción :</label>
                                <input type="date"  class="form-control" placeholder="fecha de defuncion" max="{{ date('Y-m-d') }}" id="fecha_defuncion"  >
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Certificado de defunción :</label>
                                <input  type="number" class="form-control" id="certificado_defuncion" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Causa :</label>
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="causa" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipo :</label>
                                <select name="tipo_dif" id="tipo" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <option value="ADULTO">ADULTO</option>
                                    <option value="PARVULO">PARVULO</option>                            
                                </select> 
                            </div>
                        </div>

                        <div class="col-sm-6">
                 
                            <div class="form-group">
                                <label>Genero :</label>
                                <select name="status" id="genero" class="form-control">
            
                                    <option value="MASCULINO">MASCULINO</option>
                                    <option value="FEMENINO">FEMENINO</option>
        
                                </select>
                               
                            </div> 
                        </div>
                        <hr>
                        <label>Adjuntar certificado de defunción :</label>
                        <div class="col-sm-12">
                            <div id="cert-defuncion" class="dropzone" style="text-align: center">
                        </div>
                        <hr>
                        <input type="hidden" id="url-certification">
                    </div>
            
                   
                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" id="btn_guardar_difunto" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div> 
            
                </div>
              </div>
        </div>
        </div>
    </div>
</div>
</div>


  
<!-- Modal upload difunto -->
<div class="modal fade fullscreen-modal animated bounceIn" id="modal-update-difunto" data-backdrop="static" tabindex="-1" role="dialog"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" style="text-align: center">Editar Datos Difunto</h3>
            <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="card">
                <div class="card-body">
            
                    <div class="row">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cedula de Identidad:</label>
                                    <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="ci-edit" autocomplete="off">
                                </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nombre :</label>
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="nombre-edit" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Primer apellido :</label>
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="primer_apellido-edit" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Segundo apellido :</label>
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="segundo_apellido-edit" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de nacimiento :</label>
                                <input type="date"  class="form-control" max="{{ date('Y-m-d') }}" placeholder="fecha de nacimiento" id="fecha_nacimiento-edit" >
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de defunción :</label>
                                <input type="date"  class="form-control" placeholder="fecha de defuncion" max="{{ date('Y-m-d') }}" id="fecha_defuncion-edit"  >
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Certificado de defunción :</label>
                                <input  type="number" class="form-control" id="certificado_defuncion-edit" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Causa :</label>
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="causa-edit" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipo :</label>
                                <select name="tipo_dif" id="tipo-edit" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <option value="ADULTO">ADULTO</option>
                                    <option value="PARVULO">PARVULO</option>                            
                                </select> 
                            </div>
                        </div>

                        <div class="col-sm-6">
                 
                            <div class="form-group">
                                <label>Genero :</label>
                                <select name="status" id="genero-edit" class="form-control">
            
                                    <option value="MASCULINO">MASCULINO</option>
                                    <option value="FEMENINO">fEMENINO</option>
        
                                </select>
                               
                            </div> 
                        </div>
                        <div class="form-group col-12">
                            <label>Estado</label>
                            <select name="status" id="estado-edit" class="form-control col-12" style="width: 100%">
        
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
    
                            </select>
                           
                        </div> 
                        <hr>
                        <div class="col-sm-12" style="text-align: center" id="show-file">
                           
                        </div>
                        <hr>
                        <input type="hidden" id="url-certification-edit">
                    </div>
            
                    <hr>
                   
                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" id="btn_difunto-editar" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div> 
            
                </div>
              </div>
        </div>
        </div>
    </div>
</div>
</div>














@stop

@section('css')
<style>
    .dropzone .dz-preview .dz-error-message {
    top: 150px!important;
}
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

        $("#cert-defuncion").dropzone({
        dictDefaultMessage: "Arrastre y suelte aquí los archivos …<br>(o haga clic para seleccionar archivos)",
        dictRemoveFile: 'Remover Archivo',
        dictCancelUpload: 'Cancelar carga',
        dictResponseError: 'Server responded with  code.',
        dictCancelUploadConfirmation: '¿Estás seguro/a de que deseas cancelar esta carga?',
        url: "{{ env('URL_FILE') }}/api/v1/repository/upload-files",
        paramName: "documens_files[]",
        addRemoveLinks: true,
        acceptedFiles: 'image/jpeg, image/png, image/jpg, application/pdf',
        parallelUploads: 1,
        maxFiles: 1,
        init: function() {
        this.on("complete", function(file) {
            if(file.type != 'application/pdf' && file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/jpeg') {
                this.removeFile(file);
                toastr["error"]('No se puede subir el archivo '+ file.name);
                return false;
            }
        });

        this.on("removedfile", function(file) {
            $.ajax({
                        type: 'DELETE',
                        headers: {
                            'Content-Type':'application/json'
                        },
                        url: "{{ env('URL_FILE') }}/api/v1/repository/remove-file",
                        async: false,
                        data: JSON.stringify({
                            'url':  JSON.parse(file.xhr.response).response[0].url_file
                        }),
                        success: function(data_response) {
                        }
                    })

        });

        this.on("maxfilesexceeded", function(file){
            file.previewElement.classList.add("dz-error");
            $('.dz-error-message').text('No se puede subir mas archivos!');
        });

        },
        sending: function(file, xhr, formData){
                    formData.append('sistema_id', '00e8a371-8927-49b6-a6aa-0c600e4b6a19');
                    formData.append('collector', 'certificados de difuncion');
                   
                },
        success: function (file, response) {
            file.previewElement.classList.add("dz-success");
            $('#url-certification').val(response.response[0].url_file);
            // $(file._removeLink).attr('href', response.response[0].url_file);
            // $(file._removeLink).attr('id', 'btn-remove-file'); 
        },
        error: function (file, response) {
         
            if(response == 'You can not upload any more files.'){
                toastr["error"]('No se puede subir mas archivos');
                this.removeFile(file);
            }
            file.previewElement.classList.add("dz-error");
            $('.dz-error-message').text('No se pudo subir el archivo '+ file.name);
        }
    });




        //editar difunto
        $('#btn_difunto-editar').on('click', function(){
            $.ajax({
                        type: 'PUT',
                        headers: {
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        url: "{{ route('difunto.update') }}",
                        async: false,
                        data: JSON.stringify({
                            'ci':  $('#ci-edit').val(),
                            'nombres':  $('#nombre-edit').val(),
                            'primer_apellido':  $('#primer_apellido-edit').val(),
                            'segundo_apellido':  $('#segundo_apellido-edit').val(),
                            'fecha_nacimiento':  $('#fecha_nacimiento-edit').val(),
                            'fecha_defuncion':  $('#fecha_defuncion-edit').val(),
                            'certificado_defuncion':  $('#certificado_defuncion-edit').val(),
                            'causa':  $('#causa-edit').val(),
                            'tipo': $('#tipo-edit').val(),
                            'genero': $('#genero-edit').val(),
                            'status': $('#estado-edit').val(),
                            'id': $('#btn_difunto-editar').val()
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
                            //toastr["success"]("Registro realizado con éxito!");
                        },
                        error: function (error) {
                            
                            if(error.status == 422){
                                Object.keys(error.responseJSON.errors).forEach(function(k){
                                toastr["error"](error.responseJSON.errors[k]);
                                //console.log(k + ' - ' + error.responseJSON.errors[k]);
                                });
                            }else if(error.status == 419){
                                location.reload();
                            }

                        }
                    })

        });




        $(document).on('click', '#btn-desactivar', function(){
            $.ajax({
                        type: 'GET',
                        headers: {
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        url: '/difunto/disable-difunto/' + $(this).val(),
                        async: false,
                        success: function(data_response) {
                            swal.fire({
                            title: data_response.response,
                            text: "",
                            type: "success",
                            timer: 1000,
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
                            }else if(error.status == 419){
                                location.reload();
                            }

                        }
                    })
        });


        //modal editar difunto
        $(document).on('click', '#btn-editar-difunto-value', function(){
    
            $.ajax({
                        type: 'GET',
                        headers: {
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        url: '/difunto/get-difunto/' + $(this).val(),
                        async: false,
                        success: function(data_response) {
                         
                           $('#btn_difunto-editar').val(data_response.response.id);
                            $('#modal-update-difunto').modal('show');

                            $('#nombre-edit').val(data_response.response.nombres);
                            $('#ci-edit').val(data_response.response.ci);
                            $('#primer_apellido-edit').val(data_response.response.primer_apellido);
                            $('#segundo_apellido-edit').val(data_response.response.segundo_apellido);
                            $('#fecha_nacimiento-edit').val(data_response.response.fecha_nacimiento);
                            $('#fecha_defuncion-edit').val(data_response.response.fecha_defuncion);
                            $('#certificado_defuncion-edit').val(data_response.response.certificado_defuncion);
                            $('#causa-edit').val(data_response.response.causa);
                            $('#tipo-edit').val(data_response.response.tipo);
                            $("#genero-edit").val(data_response.response.genero).change();
                            $("#estado-edit").val(data_response.response.estado).change();
                            
                            if(openFile(data_response.response.certificado_file) == 'image'){
                                $('#show-file').html('<img src="'+data_response.response.certificado_file+'" class="img-rounded img-fluid" alt="Responsive image" alt="Cinque Terre">')
                            }else{
                                $('#show-file').html('<iframe  style="border:1px solid #666CCC" src="'+data_response.response.certificado_file+'" frameborder="1" scrolling="auto" height="500" width="90%" ></iframe>');
                            }
                        }
                    })
        });



        $('#modal-update-difunto').on('hidden.bs.modal', function () {
                $('#show-file').empty();
            });



        $('#btn_guardar_difunto').on('click', function(){
            $.ajax({
                        type: 'POST',
                        headers: {
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        url: "{{ route('new.difunto') }}",
                        async: false,
                        data: JSON.stringify({
                            'ci':  $('#ci').val(),
                            'nombres':  $('#nombre').val(),
                            'primer_apellido':  $('#primer_apellido').val(),
                            'segundo_apellido':  $('#segundo_apellido').val(),
                            'fecha_nacimiento':  $('#fecha_nacimiento').val(),
                            'fecha_defuncion':  $('#fecha_defuncion').val(),
                            'certificado_defuncion':  $('#certificado_defuncion').val(),
                            'causa':  $('#causa').val(),
                            'tipo': $('#tipo').val(),
                            'genero': $('#genero').val(),
                            'certificado_file': $('#url-certification').val() //aqui
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
                            }else if(error.status == 419){
                                location.reload();
                            }

                        }
                    })
        });



        $('#new-difunto').on('click', function(){

            $('#modal-register-difunto').modal('show');
        });

        var datatable = $('#difunto-data').DataTable({
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
            "sSearch": 'Buscar difunto:',
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


    function openFile(file) {
    var extension = file.substr( (file.lastIndexOf('.') +1) );
    switch(extension) {
        case 'jpg':
        case 'png':
            return 'image';  // There's was a typo in the example where
        break;                         // the alert ended with pdf instead of gif.
        case 'zip':
        case 'rar':
            alert('was zip rar');
        break;
        case 'pdf':
            return 'pdf';
        break;
        default:
           return 'desconocido';
    }
};
    </script>
@stop