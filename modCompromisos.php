<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-body" id="registro"><!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Modificando Compromiso de Pago</h4>
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
                                        <p>Por favor ingrese los datos del Compromiso de pago a Modificar:</p>
                                    </div>
                                    <form class="form" action="#" method="post"  v-on:submit.prevent="confMCompromiso">
                                        <div class="form-body">

                                            <div class="row">
                                                <div class="col-md-5 ">
                                                    <h4 class="form-section"><i class="icon-head"></i>Datos del Compromiso de Pago:</h4>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Codigo del Compromiso:<font color="red">*</font></label>
                                                                <input type="text" v-model="idCompromiso" class="form-control" placeholder="Codigo" name="id" required="" readonly="" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Alumno:<font color="red">*</font></label>
                                                                <input type="text" v-model="compromiso['alumno']" class="form-control" placeholder="Datos de Alumno" name="id" required="" readonly="" >
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Apoderado:<font color="red">*</font></label>
                                                                <input type="text" v-model="compromiso['apo']" class="form-control" placeholder="Datos de Alumno" name="id" required="" readonly="" >
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Concepto de Compromiso:<font color="red">*</font></label>
                                                                <textarea class="form-control" v-model="compromiso['descr']" rows="3" cols="5" maxlength="200" placeholder="Concepto de Compromiso."></textarea>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <!-- Detalle compromiso -->
                                                <div class="col-md-7" >
                                                    <div class="row">
                                                        <h4 class="form-section"><i class="icon-blog"></i>Detalles de compromiso:</h4>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Fecha de Creacion:<font color="red">*</font></label>
                                                                <input class="form-control" v-model="compromiso['fecha']" type="date" name="name" readonly=""> </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Monto Total:<font color="red">*</font></label>
                                                                <input class="form-control" v-model="compromiso['monto']" type="text" readonly=""> </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">Estado:<font color="red">*</font></label>
                                                                <select class="form-control" v-model="compromiso['est']">
                                                                    <option value="1">ACTIVO</option>
                                                                    <option value="2">INACTIVO</option>
                                                                    <option value="3">ANULADO</option>
                                                                </select>
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
                                                                    <tr align="center" v-for="dato,index in detalles">
                                                                        <td >{{index+1}}</td>
                                                                        <td>{{dato['descrDet']}}</td>
                                                                        <td>{{dato['fvenci']}}</td>
                                                                        <td>{{new Intl.NumberFormat('es-PE', { style: 'currency', currency: 'PEN' }).format(Number(dato['5']))}}</td>

                                                                        <td v-if="dato['6']==1"><button class="btn btn-warning" @click="confPagar(dato['iddetalle'])" type="button"><img src="img/pago.jpg" alt="alt" height="40px"/>PAGAR</button></td>
                                                                        <td v-if="dato['6']==2"><button class="btn btn-warning" @click="confAnular(dato['iddetalle'])" type="button"><img src="img/salida.png" alt="alt" height="40px"/>ANULAR</button></td>
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
<script src="vue/mCompromiso.js" type="text/javascript"></script>