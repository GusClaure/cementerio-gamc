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
                        <h4>BUSCAR REGISTRO</h4>
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

    <div id="contenido" style="display: none">
            <div class="card">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-xl-3">
                         <label>Cuartel</label>                                   
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clear" id="cuartel" autocomplete="off">
                    </div> 
                    
                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>Codigo antiguo</label>                                   
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clear" id="anterior" autocomplete="off">
                    </div> 

                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>Tipo nicho</label>                                   
                        <select name="tipo_nicho" id="tipo_nicho" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="TEMPORAL">TEMPORAL</option>
                            <option value="PERPETUO">PERPETUO</option>                            
                        </select> 
                    </div>
                    
                </div>
            </div>
     

            {{-- datos difunto --}}
            <div class="card">                
                <div class="card-header">
                    <h4>DATOS DIFUNTOS</h4>
                </div>
            <div class="card-body">           
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-xl-3">
                            <label>Carnet de Identidad</label> 
                            <div class="input-group input-group-lg">                                 
                            <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="search" class="form-control clear" id="search_dif" autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default"  id="buscarDifunto">
                                    <i class="fa fa-search"></i>
                                </button>
                            
                            <input type="hidden" name="difunto_search" id="difunto_search">
                            </div>
                    </div>
                </div> 

                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>Nombres</label>                                   
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clear" id="nombres_dif" autocomplete="off">
                    </div>
                
                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>Primer apellido</label>                                   
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clear" id="paterno_dif" autocomplete="off">
                    </div>

                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>Segundo apellido</label>                                   
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clear" id="materno_dif" autocomplete="off">
                    </div>
                
                </div>

               
                <div class="row">
                    
                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>Fecha Nacimiento</label>                                   
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="date" class="form-control clear" id="fechanac_dif" autocomplete="off">
                    </div>
                
                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>Fecha Defuncion</label>                                   
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="date" class="form-control clear" id="fechadef_dif" autocomplete="off">
                    </div>

                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>Causa</label>                                   
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clear" id="causa" autocomplete="off">
                    </div>

                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>SERECI</label>                                   
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clear" id="sereci" autocomplete="off">
                        
                    </div>
                </div>


                <div class="row">
                    {{-- <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>Estado civil</label>   
                        <select name="ecivil" id="ecivil_dif" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="CASADO">CASADO</option>
                            <option value="CONCUBINADO">CONCUBINADO</option>
                            <option value="DIVORCIADO">DIVORCIADO</option>
                            <option value="SOLTERO">SOLTERO</option>
                            <option value="VIUDO">VIUDO</option>
                        </select> 
                    </div> --}}
                    

                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>Tipo Difunto/label>                                   
                        <select name="tipo_dif" id="tipo_dif" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="ADULTO">ADULTO</option>
                            <option value="PARVULO">PARVULO</option>                            
                        </select> 
                    </div>

                    <div class="col-sm-12 col-md-3 col-xl-3">
                        <label>Genero</label>                                   
                        <select name="genero" id="genero_dif" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="FEMENINO">FEMENINO</option>
                            <option value="MASCULINO">MASCULINO</option>                            
                        </select> 
                    </div>

                   
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                            <label>Adjuntar certificado de defunción :</label>
                            <div class="col-sm-12">
                                <div id="cert-defuncion" class="dropzone" style="text-align: center"> </div>                   
                                <hr>
                                <input type="hidden" id="url-certification">
                            </div>
                    </div>                    
                </div>
            </div>
        </div>
            {{-- datos responsables --}}
             <div class="card">                
                    <div class="card-header">
                        <h4>DATOS RESPONSABLE</h4>
                    </div>
                <div class="card-body">           
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-xl-3">
                                <label>Carnet de Identidad</label> 
                                <div class="input-group input-group-lg">                                 
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="search" class="form-control" id="search_resp" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default"  id="buscarResp">
                                        <i class="fa fa-search"></i>
                                    </button>
                          
                            <input type="text" name="responable_search" id="responsable_search">
                                </div>
                        </div>
                    </div> 

                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <label>Nombres</label>                                   
                            <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clear" id="nombres_resp" autocomplete="off">
                        </div>
                    
                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <label>Primer apellido</label>                                   
                            <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clear" id="paterno_resp" autocomplete="off">
                        </div>

                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <label>Segundo apellido</label>                                   
                            <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clear" id="materno_resp" autocomplete="off">
                        </div>
                    
                    </div>

                   
                    <div class="row">
                        
                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <label>Fecha Nacimiento</label>                                   
                            <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="date" class="form-control" id="fechanac_resp" autocomplete="off">
                        </div>
                    
                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <label>Teléfono</label>                                   
                            <input  type="tel"  class="form-control" id="telefono" autocomplete="off" maxlength="7">
                        </div>

                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <label>Celular</label>                                   
                            <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="cellular_resp" autocomplete="off">
                        </div>

                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <label>Estado civil</label>   
                            <select name="ecivil" id="ecivil_resp" class="form-control">
                                <option value="">Seleccionar</option>
                                <option value="CASADO">CASADO</option>
                                <option value="CONCUBINADO">CONCUBINADO</option>
                                <option value="DIVORCIADO">DIVORCIADO</option>
                                <option value="SOLTERO">SOLTERO</option>
                                <option value="VIUDO">VIUDO</option>
                            </select> 
                        </div>
                    </div>

                    <input type="hidden" name="difunto_search" id="difunto_search">
                    <input type="hidden" name="responable_search" id="responsable_search">

                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-xl-3">
                                <label>E-mail</label>                                   
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="email_resp" autocomplete="off">
                        </div>
                        

                        <div class="col-sm-12 col-md-7 col-xl-7">
                            <label>Domicilio</label>                                   
                            <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="domicilio_resp" autocomplete="off">
                        </div>
                        <div class="col-sm-12 col-md-2 col-xl-2">
                            <label>Genero</label>                                   
                            <select name="genero_resp" id="genero_resp" class="form-control">
                                <option value="">Seleccionar</option>
                                <option value="FEMENINO">FEMENINO</option>
                                <option value="MASCULINO">MASCULINO</option>                            
                            </select> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>INFORMACION PAGOS</h4>
                </div>

                <div class="card-body">
                    <div class="row pb-2">
                        <div class="col-sm-12 col-md-4 col-xl-4"> 
                           Razon: <span id="razon" class="clear"></span>
                        </div>

                        <div class="col-sm-12 col-md-3 col-xl-3"> 
                            Comprobante: <span id="comprob" class="clear"></span>
                         </div>

                         <div class="col-sm-12 col-md-3 col-xl-3"> 
                            Tiempo: <span id="tiemp" class="clear"></span>
                         </div>

                         <div class="col-sm-12 col-md-3 col-xl-3"> 
                            Ultimo Pago: <span id="pago_cont" class="clear"></span>
                         </div>
                    </div>

                    <div class="row pb-2">
                         <div class="col-sm-12 col-md-3 col-xl-3"> 
                            Concepto: <span id="concepto" class="clear"></span>
                         </div>

                         <div class="col-sm-12 col-md-3 col-xl-3"> 
                            Fecha: <span id="fecha_p" class="clear"></span>
                         </div>

                         <div class="col-sm-12 col-md-3 col-xl-3"> 
                            Gestiones: <span id="gestiones" class="clear"></span>
                         </div>

                         <div class="col-sm-12 col-md-3 col-xl-3"> 
                            Monto: <span id="monto_pagos" class="clear"></span>
                         </div>

                         

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>ASIGNACION SERVICIOS</h4>
                </div>

                <div class="card-body">
                   
                         <div class="row">
                                <div class="col-sm-6">  
                                    <label>Tipo Servicio</label>   
                                         <select  id="tipo_servicio_value"  class="form-control select2-multiple select2-hidden-accessible" style="width: 100%">
                                            @foreach ($tipo_service as $value)
                                                @if($value['cuenta'] =='15224150' ||   $value['cuenta'] =='15224350' )
                                                @else
                                                   <option value="{{ $value['cuenta'] }}">{{ $value['descripcion'] }}</option>
                                                @endif
                                            @endforeach
                                        </select> 
                                </div>

                                <div class="col-sm-6" id="service" style="display:none">
                                    <label>Servicio</label> 
                                        <select  id="servicio-hijos" class="form-control select2-multiple select2-hidden-accessible" style="width: 100%"></select>
                                </div>
                          </div>


                          <div class="card-header">
                            <h4>DETALLE DE SERVICIOS SOLICITADOS</h4>
                        </div>

                    <div class="row" style="padding-top: 15px;">
                            <div class="col-sm-6">
                            <div class="card">
                            <div class="card-body" id="servicios-data">
                                Ningun dato seleccionado.
                            </div>
                            </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="card">
                            <div class="card-body" id="servicios-hijos">
                                Ningun dato seleccionado.
                            </div>
                            </div>
                            </div>
                    </div>

                    <div id="cal_price" style="text-align: center">
                        <div class="card">
                            <div class="card-body" id="servicios-hijos-price" style="text-align: center">
                                <h1>0Bs</h1>
                            </div>
                        </div>
                    </div>

   
                           
                         
                </div>


                <div class="row pb-2" id="conservacion" style="display:none">
                    <div class="col-sm-4 col-md-4 col-xl-4" id="gestion_box">
                        <label>Gestiones</label> 
                        <input style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clean" id="gestion_b" autocomplete="off" >                  
                     </div>

                        <div class="col-sm-4 col-md-4 col-xl-4" id="cantidad_box" >
                            <label>Cantidad de gestiones</label> 
                                 <input style="text-transform:uppercase;" value="1" onkeyup="calcMant()" type="text" class="form-control clean" id="cantidad_b" autocomplete="off">                  
                        </div>
                         

                        <div class="col-sm-4 col-md-4 col-xl-4" id="unidad_box">
                            <label>Unidad</label> 
                            <input style="text-transform:uppercase;" value="Glb" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control clean" id="unidad_b" autocomplete="off">                  
                        </div>
                    

                      <div class="col-sm-4 col-md-4 col-xl-4" id="precio_box">
                        <label>Precio Unitario</label> 
                        <input style="text-transform:uppercase;"   onkeyup="calcMant()"  type="text" class="form-control clean" id="precio_b" autocomplete="off" readonly>                  
                     </div>

                     <div class="col-sm-4 col-md-4 col-xl-4" id="monto_box">
                        <label>Subtotal</label> 
                        <input style="text-transform:uppercase;"   type="text" class="form-control clean" id="monto_b" autocomplete="off" readonly>                  
                     </div>
                                          
                  
                    {{-- <div class="col-sm-2 col-md-2 col-xl-2">
                        <button type="button" class="btn btn-info" id="btn_add" style="display: none">
                            <i class="fa fa-search"></i>AGREGAR
                        </button>
                    </div> --}}
                </div>                                    


                <input type="hidden" name="origen" id="origen">
                <input type="hidden" name="pag_con" id="pag_con" value="aaa">
                <input type="hidden" name="pag_con_ant" id="pag_con_ant">
                <input type="hidden" name="tiempo" id="tiempo">
                <input type="hidden" name="vencido" id="vencido" value="asdada">

                <div class="card">                  
    
                    <div class="card-body" style="display:none" id="ren" >
                             <div class="row pb-2">
                                <input type="number" name="precio_renov" id="precio_renov" class="form-control precio_renov" value="0">


                                    <div class="col-sm-12 col-md-3 col-xl-3">  
                                        <label for=""># de renovacion anterior</label>
                                        <input type="number" name="renov_ant" id="renov_ant" class="form-control renov"  onkeyup="calcRenov()">
                                    </div>

                                    <div class="col-sm-12 col-md-3 col-xl-3">  
                                        <label for="">Ultimo cobro renovacion</label>
                                        <input type="number" name="precio_renov_ant" id="precio_renov_ant" class="form-control precio_renov_ant" value="0">

                                    </div>

                                    <div class="col-sm-12 col-md-3 col-xl-3">  
                                        <label for=""># de renovacion </label>

                                        <input type="number" name="renov" id="renov" class="form-control renov" onblur="calcRenov()">
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-xl-3">  
                                        <label for="">Monto renovacion </label>

                                        <input type="number" name="monto_renov" id="monto_renov" class="form-control monto_renov">
                                    </div>
                             </div>
                    </div>
                </div>


                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" id="btn_guardar_servicio" class="btn btn-success">Registrar servicio</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div> 
    </div> 
@stop
@section('css')
<style>
 
  .select2-selection__rendered{
      color:#333232;
  }
  .select2-results__option--selected{
      background-color: #175603 !important;
  }
  
</style>

@section('js')
    <script> 
$(document).ready(function () 
{   

        //code selected select2 services
        $('#tipo_servicio_value').select2({
            multiple: true,
            width: 'resolve',
            placeholder:'Servicios Cementerio',
            theme: "classic",
            allowClear: true,
            "language": {
            "noResults": function(e){
                return "Nada Encontrado";
            }
           }
        });

      


        //select event foreach
        $('#tipo_servicio_value').on('select2:select', function (e) {
            var data_request = $(this).val();
        
            $('#service').show(1000);
            $parrafos = '';
            $('#servicios-data').empty();
            $.each($(this).select2('data'), function( index, value ) {
                
                $parrafos = '<p id="'+value.id+'">' + $parrafos + (index + 1) + '.- '+ value.text+'</p>';
                $('#servicios-data').html($parrafos);
                });

            //carga select servicios hijos
            $.ajax({
                        type: 'POST',
                        headers: {
                            'Content-Type':'application/json'
                        },
                        url: '{{ env("URL_MULTISERVICE") }}/api/v1/cementerio/generate-all-servicios-nicho',
                        async: false,
                        data: JSON.stringify({
                            'data':  data_request
                        }),
                        success: function(data_response) {
                            console.log(data_response.response);
                           $('#servicio-hijos').empty();
                           $.each(data_response.response, function( index, value ) {
                            //alert(value.num_sec)
                                if(value.num_sec == '630' || value.num_sec == '628' || value.num_sec=='526' || value.num_sec=='1995'){}
                                else{
                                   // alert('sadasd');
                                    $('#servicio-hijos').append('<option value="'+value.num_sec+'">'+value.cuenta + ' - ' +value.descripcion + ' - '+ value.monto1 + ' Bs.</option>')
                                }
                          

                                    if(value.cuenta == '15224301'){
                                        $('#precio_renov').val(value.monto1);
                                       // $('#ren').show(value.monto1);
                                      //  Renov();
                                    }
                                    // //alert(value.cuenta);
                                    if(value.cuenta == '15224361'){
                                        $('#precio_b').val(value.monto1);
                                         $('#monto_b').val(value.monto1);
                                    }

                            });
                        }
                    });
        });

        //unselect event forech  //hacer que busque y limpie el html
        $('#tipo_servicio_value').on('select2:unselect', function (e) {
            if($(this).select2('data').length == 0){
                $('#servicio-hijos').empty();
            }
            $parrafos = '';
            $('#servicios-data').empty();
            $.each($("#tipo_servicio_value").select2("data"), function( index, value ) { alert("sss");
                $parrafos = '<p id="'+value.id+'">' + $parrafos + (index + 1) + '.- '+ value.text+'</p>';
                $('#servicios-data').html($parrafos);
                });
        });

        setTimeout( function() 
        { 
            $("#tipo_servicio_value").val(null).trigger('change');
         }, 100);

        
        //--------------------------------------------------------------------

            $('#servicio-hijos').select2({
                multiple: true,
                width: 'resolve',
                placeholder:'Servicios Cementerio',
                theme: "classic",
                allowClear: true,
                "language": {
                "noResults": function(e){
                    return "Nada Encontrado";
                }
              }
            });
        

            //select event forech services hijo
            $('#servicio-hijos').on('select2:select', function (e) {
                $("#tipo_servicio_value").prop("disabled", true);
                var data_request = $(this).val();
                        $parrafos = '';
                        $('#servicios-hijos').empty();
                        $.each($(this).select2('data'), function( index, value ) {  
                            if(value.id == '642')
                            {
                                // $('#precio_renov').val(value.monto1);
                                 $('#ren').show();
                                Renov();
                            }
                            if(value.id=='525'){
                                //alert(value.descripcion);
                                 mostrarConservacion(value.monto1) ;
                            }
                            $parrafos = '<p id="'+value.id+'">' + $parrafos + (index + 1) + ' - '+ value.text+'</p>';
                            $('#servicios-hijos').html($parrafos);
                            });
            });
  

            //unselect event forech services hijos
            $('#servicio-hijos').on('select2:unselect', function (e) { 

                //console.log($('#servicio-hijos').val());
               
                if ($("#servicio-hijos").select2("data").length == 0){
                    $("#tipo_servicio_value").prop("disabled", false);
                }
                $parrafos = '';
                $('#servicios-hijos').empty();
                $.each($("#servicio-hijos").select2("data"), function( index, value ) {

                    $parrafos = '<p id="'+value.id+'">' + $parrafos + (index + 1) + ' - '+ value.text+'</p>';                   
                    $('#servicios-hijos').html($parrafos);
                   
                    // if(value.id == 642 ){
                    //         $('#ren').show();
                    //      }
                         
                         
                    //      if(value.id != 642){
                    //         $('#ren').hide();
                    //      }else if(value.id == 525){
                    //         $('#conservacion').show();
                    //      }else if(value.id != 525){
                    //         $('#conservacion').hide();
                    //      }
                         
                      
                    });


                          if(e.params.data.id == 642){
                             $('#ren').hide();
                          }

                          if(e.params.data.id == 525){
                             $('#conservacion').hide();
                          }

                    console.log(e.params.data.id);

                      if($('#servicio-hijos').val().length == 0){
                                $('#ren').hide();
                                $('#conservacion').hide();
                            }

                  
                     


                   

            });

       
        });



$(document).on('click', '#buscarDifunto', function() {
   
              var ci = $('#search_dif').val();
                console.log("sadasdadasd");
              //var ci ="52525252";
              if(ci.length<1)
              {
                  //alert("el campo Ci esta vacio");
                  Swal.fire(
                                                'Busqueda finalizada!',
                                                'El campo C.I. esta vacio .',
                                                'warning'
                                                )
              }
              else{
              var type ="deceased"; 
              dats=  buscar_ci(ci,type);
                console.log("entra a estooooooooooooo"+dats);            
            }
            
          
        });
$(document).on('click', '#buscarResp', function() {
   
              var ci = $('#search_resp').val();
              console.log("esta es el carnet del gus:"+ ci);  
              //var ci ="52525252";
              if(ci.length<1)
              {
                  //alert("el campo Ci esta vacio");
                  Swal.fire(
                                                'Busqueda finalizada!',
                                                'El campo C.I. esta vacio .',
                                                'warning'
                                                )
                  
              }
              else{
              var type ="responsable"; 
              dats=  buscar_ci_resp(ci,type);
                console.log("entra a esteeeeeeeeeeeeeeeee"+dats);            
            }
            
          
        $(document).on('click', '#buscar', function() {
        
            $('.clear').val("");
            $('.clear').html("");
            $('.clean').val("");
            $('.clean').html("");


            $('#pag_con').val();
            $('#sp').append('<i class="fa fa-spinner fa-spin"></i>');
            $('#form').hide();
            var bloque = $('#bloque').val();
            var nicho = $('#nro_nicho').val();
            var fila = $('#fila').val();
            if (bloque && nicho && fila) {              
                dats=  buscar_datos(bloque, nicho, fila);
                console.log(dats);       

               }
        
        });

//         $(document).on('click', '#buscar', function() {
   
//    $('.clear').val("");
//    $('#pag_con').val();
//    $('#sp').append('<i class="fa fa-spinner fa-spin"></i>');
//    $('#form').hide();
//    var bloque = $('#bloque').val();
//    var nicho = $('#nro_nicho').val();
//    var fila = $('#fila').val();
//    if (bloque && nicho && fila) {              
//      dats=  buscar_datos(bloque, nicho, fila);
//        console.log(dats);            

//    }
 
// });


        
        function buscar_datos(bloque, nicho, fila) {
             var datos = "";
                $('#contenido').show();
                    $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'Content-Type': 'application/json'
                            },
                            url: "{{ route('buscar.nicho') }}",
                            method: 'POST',
                            dataType: 'json',
                            data: JSON.stringify({
                                "bloque": bloque,
                                "nicho": nicho,
                                "fila": fila
                            }),
                            success: function(data) {

                                if (data.mensaje) {
                                        $('#sp').empty();
                                    console.log(data);
                                    // cargar campos del los forms
                                    $('#origen').val('tabla_nueva');
                                    //setear campos
                                  //  $('#cuartel').val()


                                }
                                else{
                                    $.ajax({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                                    'Content-Type': 'application/json'
                                                },
                                                url: "https://multiservdev.cochabamba.bo/api/v1/cementerio/get-data",
                                                method: 'POST',
                                                dataType: 'json',
                                                data: JSON.stringify({
                                                    "bloque": bloque,
                                                    "nicho": nicho,
                                                    "fila": fila
                                                }),
                                                success: function(data) {
                                                    $('#sp').empty();
                                                    $('#form').show();
                                                    $('#origen').val('tabla_antigua');
                                                    if(data.response.datos_difuntos!="")
                                                        {
                                                             // datos difunto                         
                                                            if(data.response.datos_difuntos !="")
                                                            {
                                                                var fecha=data.response.datos_difuntos[0].fecha;
                                                                    var año= fecha.substr(0, 4);
                                                                    var mes= fecha.substr(4, 2);
                                                                    var dia= fecha.substr(6, 2);
                                                                    var nuevaf=año+"-"+mes+"-"+dia; 
                                                                
                                                                    $('#pag_con').val(data.response.datos_difuntos[0].pag_con);
                                                                    $('#causa').val(data.response.datos_difuntos[0].causa_fall);
                                                                    $('#nombres_dif').val(data.response.datos_difuntos[0].difunto);   
                                                                    if(data.response.datos_difuntos[0].tiempo  !=""){
                                                                        $('#tiemp').html(data.response.datos_difuntos[0].tiempo);
                                                                        $('#tiempo').val(data.response.datos_difuntos[0].tiempo);
                                                                        $('#tipo_nicho').val('TEMPORAL');
                                                                        calcularPlazo(data.response.datos_difuntos[0].tiempo , año,nuevaf );  
                                                                                                                                  
                                                                    } else{
                                                                        $('#tipo_nicho').val('PERPETUO');

                                                                    }                                                         
                                                                
                                                                    $('#pago_cont').html(data.response.datos_difuntos[0].pag_con);
                                                                    $('#pago_cont_ant').html(data.response.datos_difuntos[0].pag_con);
                                                                    $('#fechadef_dif').val(nuevaf);

                                                                    
                                                                    var genero="";
                                                                    
                                                                        if (data.response.datos_difuntos[0].sexo == "M") {
                                                                            genero = "MASCULINO";
                                                                        } else {
                                                                        genero = "FEMENINO";
                                                                        }
                                                                        $('#genero_dif').val(genero);
                                                                
                                                            }
                                                             // datos responsable

                                                                    if(data.response.responsable!=""){
                                                                            $('#search_resp').val(data.response.responsable[0].carnet);                                                            
                                                                            $('#telefono').val(data.response.responsable[0].telef);
                                                                            $('#domicilio').val(data.response.responsable[0].direccion);
                                                                            $('#nombres_resp').val(data.response.responsable[0].razon);
                                                                    }
                                                                    if(data.response.pagos!=""){
                                                                        $('#razon').html(data.response.pagos[0].razon);
                                                                        $('#comprob').html(data.response.pagos[0].comprob);
                                                                        $('#concepto').html(data.response.pagos[0].concepto);
                                                                        $('#gestiones').html(data.response.pagos[0].gestiones);
                                                                        $('#monto_pagos').html(data.response.pagos[0].monto);
                                                                    
                                                                            if(data.response.pagos[0].fecha){
                                                                                var ult=data.response.pagos[0].fecha;
                                                                                var ultaño= fecha.substr(0, 4);
                                                                                var ultmes= fecha.substr(4, 2);
                                                                                var ultdia= fecha.substr(6, 2);
                                                                                var ultimof=ultaño+"-"+ultmes+"-"+ultdia; 
                                                                                $('#fecha_p').html(ultimof);
                                                                            }

                                                                         }

                                                        } else{
                                                            $('#sp').empty();
                                                                Swal.fire(
                                                                        'Busqueda finalizada!',
                                                                        'El registro no ha  sido encontrado o no existe .',
                                                                        'error'
                                                                        )
                                                                    
                                                                    $('.clear').val("");
                                                                    $('#form').hide();
                                                            }   






                                                }
                                    });

                                }
                            }
                    });

        }


        // calcularPlazo nicho
        function calcularPlazo(tiempo, año, nfecha){
           let plazo=0;
           plazo=parseInt(año)+parseInt(tiempo); 
           var fecha = new Date();
	       var year = fecha.getFullYear();  
           
            if(plazo<year){
                var vencimiento= fechaVencimiento(nfecha, tiempo);

                $('#infoPlazo').html('El plazo del enterratorio venció el año '+ plazo +' en fecha '+ vencimiento+'');
              
                $('#vencido').val(vencimiento);

                         swal.fire({
                                    title: "Notificación!",
                                    text: "!El plazo del enterratorio venció el año "+ plazo +" en fecha "+vencimiento +"!",
                                    type: "warning",
                                  //  timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: true
                                    });
                                    setTimeout(function() { 
                                       return false;
                                    }, 2000);
            }
            else if(plazo==year){
                var vencimiento= fechaVencimiento(nfecha, tiempo);
                $('#infoPlazo').html('El plazo del enterratorio vence el '+ vencimiento +'');
               // var venc= parseInt(fecha)-parseInt(nfecha);
            
                $('#vencido').val(vencimiento);
                         swal.fire({
                                    title: "Notificación!",
                                    text: "!El plazo del enterratorio vence el " + vencimiento +"!",
                                    type: "warning",
                                  //  timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: true
                                    });
                                    setTimeout(function() { 
                                       return false;
                                    }, 2000);
            }
            else{
                var vencimiento= fechaVencimiento(nfecha, tiempo);
                $('#vencido').val(vencimiento);

                nplazo=parseInt(year)-parseInt(plazo);
                $('#infoPlazo').html('Quedan '+ nplazo +' años de plazo del enterratorio, la fecha de vencimiento es '+ vencimiento + '');
                swal.fire({
                                    title: "Notificación!",
                                    text: "!El plazo del enterratorio vence el "+ plazo + " la fecha de vencimiento es " + vencimiento + "!",
                                    type: "warning",
                                  //  timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: true
                                    });
                                    setTimeout(function() { 
                                       return false;
                                    }, 2000);
            }
        }




        $('#btn_guardar_servicio').on('click', function(){
                
               return  $.ajax({
                               type: 'POST',
                               headers: {
                                   'Content-Type':'application/json',
                                   'X-CSRF-TOKEN':'{{ csrf_token() }}',
                               },
                               url: "{{ route('new.servicio') }}",
                               async: false,
                               data: JSON.stringify({
                                                              
                                   'nro_nicho': $('#nro_nicho').val(),
                                   'bloque':  $('#bloque').val(),
                                   'cuartel':  $('#cuartel').val(),
                                   'fila':  $('#fila').val(),
                                   'tipo':  $('#tipo').val(),
                                   'columna':  $('#columna').val(),
                                   'anterior':  $('#anterior').val(),
                                   'ci_dif':  $('#search_dif').val(),
                                   'nombres_dif':  $('#nombres_dif').val(),
                                   'paterno_dif':  $('#paterno_dif').val(),
                                   'materno_dif':  $('#materno_dif').val(),
                                   'fechanac_dif':  $('#fechanac_dif').val(),
                                   'fechadef_dif':  $('#fechadef_dif').val(),
                                   'causa':  $('#causa').val(),
                                   'ecivil_dif':  $('#ecivil_dif').val(),
                                   'tipo_dif':  $('#tipo_dif').val(),
                                   'genero_dif':  $('#genero_dif').val(),
                                   'ci_resp':  $('#search_resp').val(),
                                   'nombres_resp':  $('#nombres_resp').val(),
                                   'paterno_resp':  $('#paterno_resp').val(),
                                   'materno_resp':  $('#materno_resp').val(),
                                   'fechanac_resp':  $('#fechanac_resp').val(),
                                   'telefono':  $('#telefono').val(),
                                   'celular':  $('#celular').val(),
                                   'ecivil':  $('#ecivil').val(),
                                   'email':  $('#email').val(),
                                   'domicilio':  $('#domicilio').val(),
                                   'genero_resp':  $('#genero_resp').val(),
                                   'pag_con':  $('#pag_con').val(),
                                   'tiempo':  $('#tiempo').val(),
                                    
                                   'tipo_serv':$('#tipo_servicio_value').val(),
                                   'serv':$('#servicio-hijos').val(),
                                   'servname':$('#servicio-hijos option:selected').text(),


                                   
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
      
              

                        
                function mostrarConservacion(precio_mant){
                  
                        $('#precio_b').val(precio_mant);
                        $('#monto_b').val(precio_mant);
                        $('#conservacion').show();
                }
                                    
                       

                function calcMant(){
                    var g=$('#pag_con_ant').val();
                   var cant= $('#cantidad_b').val();
                   var precio= $('#precio_b').val();
                    if(cant!='' && precio !=''){
                        var total=cant*precio;  
                       var ultima_gestion=parseInt(g)+ parseInt(cant);
                        $('#pag_con').val(ultima_gestion);
                        $('#monto_b').val(total);
                    }
                }

                function Renov(){
                    var renov_ant=$('#renov_ant').val();                  
                        if(renov_ant==''){
                           renov_ant=0;
                           var precio=$('#precio_renov').val();
                           $('#precio_renov_ant').val(precio);
                           anios_ren=$('#vencido').val();
                           if(anios_ren==0){  $('#renov').val(1);}
                           else{ $('#renov').val(anios_ren);}
                          
                        }
                        calcRenov();
                      
                    }

                    $(document).on('blur', '#renov_ant', function(){
                        Renov();
                        calcRenov();
                    })
                

                function calcRenov()
                {
                    $('#monto_renov').val(0);   
                    var precio_ant=$('#precio_renov_ant').val();
                    var porcentaje=0;
                    var cuota_ant=0;
                    var cuota1=$('#precio_renov').val();
                    var acum=0;

                    for(var i=0 ; i<$('#renov').val(); i++){
                       alert(i);
                        if(i==0){
                            cuota=cuota1;  
                            cuota_ant=cuota1;                      
                        }
                        else{
                            porcentaje=cuota_ant*(20/100);
                            cuota=  parseFloat(cuota_ant) + parseFloat(porcentaje); alert(cuota);
                            cuota_ant=cuota;
                        }
                       
                        acum=parseFloat(acum)+ parseFloat(cuota); alert(acum);
                        
                    }
                  
                    $('#monto_renov').val(acum);                       
                 
               }
                           
        function filterOption(){
            if($('#vencido').val() <= 0){
                   alert($('#vencido').val());
                $("#tipo_servicio_value option[value='15224300']").remove();
            
                 }     
        }
             
        $(document).on('keypress' , '#tipo_servicio_value', function(){
            $("#tipo_servicio_value option[value='15224300']").remove();
            filterOption();
        })
         


        // aporte george


$(document).on('click', '#buscarDifunto', function() {
   
   var ci = $('#search_dif').val();
     console.log("sadasdadasd");
   //var ci ="52525252";
   if(ci.length<1)
   {
       //alert("el campo Ci esta vacio");
       Swal.fire(
                                     'Busqueda finalizada!',
                                     'El campo C.I. esta vacio .',
                                     'warning'
                                     )
   }
   else{
   var type ="deceased"; 
   dats=  buscar_ci(ci,type);
     console.log("entra a estooooooooooooo"+dats);            
 }
 

});
$(document).on('click', '#buscarResp', function() {

   var ci = $('#search_resp').val();
   console.log("esta es el carnet del gus:"+ ci);  
   //var ci ="52525252";
   if(ci.length<1)
   {
       //alert("el campo Ci esta vacio");
       Swal.fire(
                                     'Busqueda finalizada!',
                                     'El campo C.I. esta vacio .',
                                     'warning'
                                     )
       
   }
   else{
   var type ="responsable"; 
   dats=  buscar_ci_resp(ci,type);
     console.log("entra a esteeeeeeeeeeeeeeeee"+dats);            
 }
 

});
function buscar_ci(ci,type) {
        var datos = "";
      
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            url: "{{ route('search.difunto.responsable') }}",
            method: 'POST',
            dataType: 'json',
            data: JSON.stringify({
                "ci": ci,
                "type": type
            }),
            success: function(data) {
                if(data.response==null)
                {
                    //alert("El CI ingresado no esta registrado");
                    Swal.fire(
                            'Busqueda finalizada!',
                            'El C.I. ingresado no esta registrado .',
                            'warning'
                            )
                }
                else{
                console.log("si entro a esta madre"+ data.response.fecha_nacimiento);    
                $('#nombres_dif').val(data.response.nombres);
                $('#paterno_dif').val(data.response.primer_apellido);
                $('#materno_dif').val(data.response.segundo_apellido);
                $('#fechanac_dif').val(data.response.fecha_nacimiento);
                $('#fechadef_dif').val(data.response.fecha_defuncion);
                $('#tipo_dif').val(data.response.tipo);
                $('#sereci').val(data.response.certificado_defuncion);
                $('#causa').val(data.response.causa);
                $('#genero_dif').val(data.response.genero);
                $("#difunto_search").val(data.response.id);
                //$('#ecivil_dif').val(data.response.estado_civil);
                }

            },
            error : function(xhr, status) {
                //alert('Disculpe, existió un problema');
                Swal.fire(
                    'Busqueda finalizada!',
                    'El registro no ha  sido encontrado o no existe .',
                    'error'
                )
            },

            // complete : function(xhr, status) {
            //     alert('Petición realizada');
            // }
          
        });
        // return datos;
    }

    function buscar_ci(ci,type) {
        var datos = "";
      
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            url: "{{ route('search.difunto.responsable') }}",
            method: 'POST',
            dataType: 'json',
            data: JSON.stringify({
                "ci": ci,
                "type": type
            }),
            success: function(data) {
                if(data.response==null)
                {
                    //alert("El CI ingresado no esta registrado");
                    Swal.fire(
                            'Busqueda finalizada!',
                            'El C.I. ingresado no esta registrado .',
                            'warning'
                            )
                }
                else{
                console.log("si entro a esta madre"+ data.response.fecha_nacimiento);    
                $('#nombres_dif').val(data.response.nombres);
                $('#paterno_dif').val(data.response.primer_apellido);
                $('#materno_dif').val(data.response.segundo_apellido);
                $('#fechanac_dif').val(data.response.fecha_nacimiento);
                $('#fechadef_dif').val(data.response.fecha_defuncion);
                $('#tipo_dif').val(data.response.tipo);
                $('#sereci').val(data.response.certificado_defuncion);
                $('#causa').val(data.response.causa);
                $('#genero_dif').val(data.response.genero);
                $("#difunto_search").val(data.response.id);
                //$('#ecivil_dif').val(data.response.estado_civil);
                }

            },
            error : function(xhr, status) {
                //alert('Disculpe, existió un problema');
                Swal.fire(
                    'Busqueda finalizada!',
                    'El registro no ha  sido encontrado o no existe .',
                    'error'
                )
            },

            // complete : function(xhr, status) {
            //     alert('Petición realizada');
            // }
          
        });
        // return datos;
    }

    function buscar_ci_resp(ci,type) {
        var datos = "";
      
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            url: "{{ route('search.difunto.responsable') }}",
            method: 'POST',
            dataType: 'json',
            data: JSON.stringify({
                "ci": ci,
                "type": type
            }),
            success: function(data) {
                if(data.response==null)
                {
                    Swal.fire(
                            'Busqueda finalizada!',
                            'El C.I. ingresado no esta registrado .',
                            'warning'
                            )
                }
                else{
                console.log("si entro a esta chingada"+ data.response.fecha_nacimiento);    
                $('#nombres_resp').val(data.response.nombres);
                $('#paterno_resp').val(data.response.primer_apellido);
                $('#materno_resp').val(data.response.segundo_apellido);
                $('#fechanac_resp').val(data.response.fecha_nacimiento);
                $('#telefono_resp').val(data.response.telefono);
                $('#cellular_resp').val(data.response.celular);
                $('#ecivil_resp').val(data.response.estado_civil);
                $('#email_resp').val(data.response.email);
                $('#domicilio_resp').val(data.response.domicilio);
                $('#genero_resp').val(data.response.genero);
                $("#responsable_search").val(data.response.id);
                //$('#ecivil_dif').val(data.response.estado_civil);
                }

            },
            error : function(xhr, status) {
               // alert('Disculpe, existió un problema');
                Swal.fire(
                            'Busqueda finalizada!',
                            'El registro no ha  sido encontrado o no existe .',
                            'error'
                            )
            },

            // complete : function(xhr, status) {
            //     alert('Petición realizada');
            // }
            
        });
        // return datos;
    }


    // calcular fecha vencimiento
    function fechaVencimiento(fecha, tiempo){
                var d = new Date(fecha);
                var strDate = parseInt(d.getFullYear())+parseInt(tiempo);
                var strDate =strDate + "/" + (d.getMonth()+1) + "/" + (d.getDate()+1);               
                
                 console.log(strDate);
                 return strDate;
                }

    </script>

    @stop