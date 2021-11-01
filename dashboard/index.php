<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Becarios Tonalli a.c.</h1>
    
    <?php
include_once "bd/conexion.php";
$objeto =  new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT Id, Becario, Actividad, Estado, Fecha, Hora_de_entrada, Hora_de_salida FROM becarios";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


        <div class="container">
           <div class="row">
               <div class="col-lg-12">
                  <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
                     
               </div>
            </div>
        </div>
        <br>
        <div class="container">
           <div class="row">
               <div class="col-lg-12">
                  <div class="table-responsive">
                      <table id="tablabecarios" class="table table-striped table-bordered table-condensed" style="width:100%">
                         <thead class="text-center">
                          <tr>
                             <th>Id</th>
                             <th>Becario</th>
                             <th>Actividad</th>
                             <th>Estado</th>
                             <th>Fecha</th>
                             <th>Hora_de_entrada</th>
                             <th>Hora_de_salida</th>
                             <th>Acciones</th>
                          </tr>
                         </thead>
                         <tbody>
                             <?php
                             foreach($data as $dat) {
                             ?>
                             <tr>
                           <td><?php echo $dat ["Id"] ?></td>
                           <td><?php echo $dat ["Becario"] ?></td>
                           <td><?php echo $dat ["Actividad"] ?></td>
                           <td><?php echo $dat ["Estado"] ?></td>
                           <td><?php echo $dat ["Fecha"] ?></td>
                           <td><?php echo $dat ["Hora_de_entrada"] ?></td>
                           <td><?php echo $dat ["Hora_de_salida"] ?></td>
                           <td></td>
                            </tr>
                            <?php
                             }
                             ?>
                         </tbody>
                      </table>
                   </div>    
               </div>
            </div>
        </div>
        
        <!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                </div>
            <form id="formbecarios">
                <div class="modal-body">
                    <div class="form-group">
                    <label for="Becario" class="col-form-label">Becario:</label>
                    <input type="text" class="form-control" id="Becario">
                    </div>
                    <div class="form-group">
                    <label for="Actividad" class="col-form-label">Actividad:</label>
                    <input type="text" class="form-control" id="Actividad">
                    </div>
                    <div class="form-group">
                    <label for="Estado" class="col-form-label">Estado:</label>
                        <select name="Estado" id="Estado">
                            <option value="Sin iniciar">Sin iniciar</option>
                            <option value="En proceso">En proceso</option>
                            <option value="En pausa">En pausa</option>
                            <option value="Finalizado">Finalizado</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="Fecha" class="col-form-label">Fecha:</label>
                    <input type="date" class="form-control" id="Fecha">
                    </div>
                    <div class="form-group">
                    <label for="Hora_de_entrada" class="col-form-label">Hora_de_entrada:</label>
                    <input type="time" class="form-control" id="Hora_de_entrada">
                    </div>
                    <div class="form-group">
                    <label for="Hora_de_salida" class="col-form-label">Hora_de_salida:</label>
                    <input type="time" class="form-control" id="Hora_de_salida">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
            </form>
            </div>
          </div>
        </div>
    
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>