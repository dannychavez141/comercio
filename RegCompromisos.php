<div class="app-content content container-fluid">
    <div class="content-wrapper">

        <div class="content-body" id="registro"><!-- Basic form layout section start -->

            <section id="basic-form-layouts">

                <div class="row match-height">
                    <!-- Button trigger modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle" v-if="vista==1">Seleccione Un Alumno</h5>
                                    <h5 class="modal-title" id="exampleModalLongTitle" v-else-if="vista==2">Seleccione Un Apoderado</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"  v-if="vista==1">
                                    <div> <label>BUSCAR ALUMNO:</label> <input type="text" v-model="busqAlu" v-on:keyup="consultaAlumnos()" class="form-control"></div>
                                    <table class="table table-sm">
                                        <tr>
                                            <td>DNI</td>
                                            <td>Apellidos y Nombres</td>
                                            <td>Accion</td>
                                        </tr>

                                        <tr v-for="alumno,index in alumnos">
                                            <td>{{alumno['dni']}}</td>
                                            <td>{{alumno['alu']}}</td>
                                            <td><button><img src="img/elegir.PNG" alt="alt"  @click="elegirAlu(alumno)" width="30em" data-dismiss="modal"/></button> </td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="modal-body"  v-if="vista==2">
                                    <div> <label>BUSCAR APODERADO:</label> <input type="text" v-model="busqApo" v-on:keyup="consultaApoderados()" class="form-control"></div>
                                    <table class="table table-sm">
                                        <tr>
                                            <td>DNI</td>
                                            <td>Apellidos y Nombres</td>
                                            <td>Accion</td>
                                        </tr>

                                        <tr v-for="datos,index in padres">
                                            <td>{{datos['dni']}}</td>
                                            <td>{{datos['datos']}}</td>
                                            <td><button><img src="img/elegir.PNG" alt="alt" @click="elegirApo(datos)" width="30em" data-dismiss="modal"/></button> </td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- -------- -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Registrando Compromiso de Pago</h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    <div class="card-text">
                                        <p>Por favor ingrese los datos del Compromiso de pago a Registrar</p>
                                    </div>

                                    <form class="form" action="#" method="post" v-on:submit.prevent="registrar">
                                        <div class="form-body">

                                            <div class="row">
                                                <div class="col-md-5 ">
                                                    <h4 class="form-section"><i class="icon-head"></i>Ingrese Datos del Compromiso de Pago:</h4>
                                                    <div class="row">

                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Alumno:<font color="red">*</font></label>
                                                                <input type="text" v-model="alumno['alu']" class="form-control" readonly placeholder="Datos de Alumno" name="id" required=""  >

                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="projectinput6">Buscar Alumno</label><br>
                                                                <button type="button" class="btn btn-primary" @click="vista=1" data-toggle="modal" data-target="#exampleModalCenter">
                                                                    Buscar Alumno
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Apoderado:<font color="red">*</font></label>
                                                                <input type="text"  v-model="padre['datos']"class="form-control"  placeholder="Datos de Alumno" name="id" required="" readonly="" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="projectinput6">Buscar Apoderado:</label><br>
                                                                <button type="button" class="btn btn-primary"  @click="vista=2" data-toggle="modal" data-target="#exampleModalCenter">
                                                                    Buscar Apoderado
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Concepto de Compromiso:<font color="red">*</font></label>
                                                                <textarea class="form-control" v-model="compromiso['descr']" name="name" rows="3" cols="5" maxlength="200" placeholder="Concepto de Compromiso."></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Fecha de Creacion:<font color="red">*</font></label>
                                                                <input class="form-control" v-model="fCrea" type="date" value=""> </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Monto Total:<font color="red">*</font></label>
                                                                <input class="form-control" v-model="compromiso['monto']" type="text" readonly=""> </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Estado:<font color="red">*</font></label>
                                                                <select class="form-control" v-model="est">
                                                                    <option value="1">ACTIVO</option>
                                                                    <option value="2">INACTIVO</option>
                                                                    <option value="3">ANULADO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Detalle compromiso -->
                                                <div class="col-md-7" >
                                                    <div class="row">
                                                        <h4 class="form-section"><i class="icon-blog"></i>Detalles de compromiso:</h4>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">   Descripcion de Detalle:<font color="red">*</font></label>
                                                                <textarea class="form-control" rows="5" cols="10" v-model="detalle['descrDet']" placeholder="Escribir el detalle de la deuda"></textarea> </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Fecha de vencimiento:<font color="red">*</font></label>
                                                                <input class="form-control" v-model="fVenc" type="date" value=""> </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="projectinput1">CANTIDAD:<font color="red">*</font></label>
                                                                <input type="hidden" class="form-control" v-model="detalle['canti']"  placeholder="Escriba la catidad">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="projectinput1">MONTO:<font color="red">*</font></label>
                                                                <input type="number"  class="form-control" step="0.01"  v-model="detalle['monto']"  placeholder="Escriba el monto de la deuda" >
                                                            </div>
                                                        </div><div class="col-md-4">
                                                            <div class="form-group">
                                                                <br>
                                                                <button class="btn btn-primary" type="button" @click='añadirDetalle()'>Agregar</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <table class="table table-sm table-bordered" >
                                                                    <tr align="center">
                                                                        <th s>N°</th>
                                                                        <th>Descripcion</th>
                                                                        <th>F.venci</th>
                                                                        <th>Monto</th>
                                                                        <th>Edit.</th>
                                                                    </tr>
                                                                    <tr align="center" v-for="dato,index in detallesCom">
                                                                        <td >{{index+1}}</td>
                                                                        <td>{{dato['descrDet']}}</td>
                                                                        <td>{{dato['fvenci']}}</td>
                                                                        <td>{{new Intl.NumberFormat('es-PE', { style: 'currency', currency: 'PEN' }).format(Number(dato['monto']))}}</td>
                                                                        <td><button class="btn btn-warning" @click='quitarDetalle(index)' type="button"><img src="img/salida.png" alt="alt" height="20px"/></button></td>
                                                                    </tr>


                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <a href="compromisos.php"><button type="button" class="btn btn-warning mr-1">
                                                    <i class="icon-cross2"></i> Cancelar
                                                </button></a>
                                            <button type="submit" class="btn btn-primary" value="R" name="baccion">
                                                <i class="icon-check2"></i> Guardar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div> </div>
<script src="vue/rCompromiso.js" type="text/javascript"></script>