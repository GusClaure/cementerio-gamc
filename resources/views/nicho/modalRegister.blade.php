

<!-- Modal registro bloque -->
<div class="modal fade fullscreen-modal animated bounceIn" tabindex="-1" id="modal-register-nicho" data-backdrop="static" tabindex="-1" role="dialog"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" style="text-align: center">REGISTRO NICHO</h3>
            <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="col-sm-12 col-md-10 col-xl-10 card m-auto">
                <div class="card-body">
            
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-xl-4">
                                <div class="col-sm-12 col-md-12 col-xl-12 form-group">

                                    <label>Cuartel</label>
                                   
                                    <select style="width: 100%"  id="cuartel" onchange="generateCode()" >                                      
                                      <option>SELECCIONAR</option>
                                        @foreach($cuartel as $c)
                                        <option value={{ $c->id}}> {{ $c->codigo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>

                        <div class="col-sm-12 col-md-4 col-xl-4">
                            <div class="col-sm-12 col-md-12 col-xl-12 form-group">

                                <label>Bloque</label>
                               
                                <select style="width: 100%"  class="form-control" id="bloque" onchange="generateCode()" disabled >    
                                      <option>SELECCIONAR</option>

                                    @foreach($bloque as $b)
                                    <option value={{ $b->id}}> {{ $b->codigo }}</option>
                                    @endforeach
                                </select>
                            </div>
                         </div>

                         <div class="col-sm-12 col-md-4 col-xl-4">
                            <div class="form-group">
                                <label>Nro:</label>
                                <input style="text-transform:uppercase;" onblur="generateCode()" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="nro" autocomplete="off">
                            </div>
                         </div>
                    </div>
                    <div class="row">
                      
                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Fila:</label>
                                <input style="text-transform:uppercase;" onblur="generateCode()" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="fila" autocomplete="off">
                            </div>
                        </div>

                       

                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Codigo anterior:</label>
                                <input style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="anterior" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Codigo:</label>
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="code" autocomplete="off" readonly>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Cantidad de  cuerpos:</label>
                                <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="cant" autocomplete="off">
                            </div>
                        </div>    

                    </div>
            


                    <div class="row" >      
                        <div class="col-md-6 col-xl-6">
                            <div class="form-group">
                                <label>Tipo de  nicho:</label>
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="TEMPORAL">TEMPORAL</option>
                                    <option value="PERPETUO">PERPETUO</option>
                                </select>                                
                            </div>
                        </div>   

                        <div class="form-group col-md-6 col-xl-6">
                            <label>Estado:</label>
                            <select name="status" id="status" class="form-control">        
                                <option value="ACTIVO"> ACTIVO</option>
                                <option value="INACTIVO"> INACTIVO</option>
                            </select>                           
                        </div> 
                    </div>

                   
                   
                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" id="btn_guardar_nicho" class="btn btn-success">Registrar nicho</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div> 
            
                </div>
              </div>
            

        </div>
        {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btn-complementacion-producto">Guardar</button>
        </div> --}}
    </div>
</div>
</div>
