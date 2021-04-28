<div class="app-content content container-fluid" id="registro" >
    <div class="content-wrapper">
        <div class="content-body"    id="registro"><!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Compromisos de Pago</h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="card-body collapse in" >
                                <div class="card-block">

                                    <div class="form-body">

                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <h4 class="form-section"><i class="icon-head"></i>Ingrese Datos del Compromiso de Pago:</h4>
                                                <div class="row">

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Buscar comprimiso de pago:<font color="red">*</font></label>
                                                            <select v-model="tipo" class="form-control" v-on:change="consulta()">
                                                                <option value="1">Datos de Alumno</option>
                                                                <option value="2">Datos de Apoderado</option>
                                                                <option value="3">Concepto</option>
                                                                <option value="4">Fecha de Creacion</option>
                                                                <option value="5">Codigo</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Buscar comprimiso de pago<font color="red">*</font></label>
                                                            <input type="text" v-model="busqu" v-on:keyup="consulta()" class="form-control" placeholder="Busqueda" name="id">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Buscar comprimiso de pago:<font color="red">*</font></label>
                                                            <select v-model="est" class="form-control" v-on:change="consulta()">
                                                                <option value="1">Activo</option>
                                                                <option value="2">Inactivo</option>
                                                                <option value="3">Anulado</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group"><br>
                                                            <a href="./compromisos.php?vista=reg" class="btn btn-primary">REGISTRAR NUEVO COMPROMISO</a>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <th>N°</th>
                                                                    <th>Datos de Alumno</th>
                                                                    <th>Datos de Apoderado</th>
                                                                    <th>Concepto de Compromiso</th>
                                                                    <th>Creacion</th>
                                                                    <th>Monto Total</th>
                                                                    <th>Imprimir</th>
                                                                    <th>Editar</th>

                                                                </tr>
                                                                <tr v-for="comp in compromisos">
                                                                    <td>{{comp['idcompromisos']}}</td>
                                                                    <td>{{comp['alu']}}</td>
                                                                    <td>{{comp['apo']}}</td>
                                                                    <td>{{comp['descrComp']}}</td>
                                                                    <td>{{comp['creacion']}}</td>
                                                                    <td>{{new Intl.NumberFormat('es-PE', { style: 'currency', currency: 'PEN' }).format(Number(comp['monto']))}}</td>
                                                                    <td><button type="button" @click="popUp(comp['idcompromisos'])"><img src="./img/print.jpg" alt="alt" width="50px"/></button></td>
                                                                    <td><button><a v-bind:href="'?vista=mod&id='+comp['idcompromisos']"><img src="./img/edit.jpg" alt="alt" width="50px"/></a></button></td>
                                                                </tr>
                                                            </table>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>



                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </section>

        </div>
    </div> </div>
<script src="vue/vCompromiso.js" type="text/javascript"></script>