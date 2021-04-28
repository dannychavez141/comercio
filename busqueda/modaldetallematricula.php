
<section id="basic-modals">
  <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">

                  <!-- Modal -->
                  <div class="modal fade text-xs-left" id="iconModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel2"><i class="icon-road2"></i>Detalles de Matricula</h4>
                      </div>
                      <div class="modal-body" id="detallemod">
                      <table>
                        <tr>
                          <th>Nro de Matricula:</th>
                          <td>{{idmat}}</td>
                        </tr>
                        <tr>
                          <th>DNI del Alumno:</th>
                          <td>{{dnialu}}</td>
                        </tr>
                        <tr>
                          <th>Alumno(a):</th>
                          <td>{{alumno}}</td>
                        </tr>
                        <tr>
                          <th>DNI de Apoderado:</th>
                          <td>{{dniapo}}</td>
                        </tr>
                        <tr>
                          <th>Apoderado(a):</th>
                          <td>{{apo}}</td>
                        </tr>
                         <tr>
                          <th>Grado - Seccion Y Año Escolar:</th>
                          <td>{{grado}}</td>
                        </tr>
                        <tr>
                          <th>Fecha de Matricula:</th>
                          <td>{{fecha}}</td>
                        </tr>
                        <tr>
                          <th>Direccion:</th>
                          <td>{{direccion}}</td>
                        </tr>
                        <tr>
                          <th>Telefono:</th>
                          <td>{{telefono}}</td>
                        </tr>
                        <tr>
                          <th>Matriculado por:</th>
                          <td>{{usuario}}</td>
                        </tr>
                        <tr>
                          <th>Estado de Matricula:</th>
                          <td>{{estado}}</td>
                        </tr>
                      </table>
          
                      
                      <div class="modal-footer">
                      <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                     
                     </div>
                      </div>
                    </div>
                    </div>
                  </div>   
                </div>
              </div>
<br>


  <div id="datos" onload="buscar()"></div>
</section>
