                     <?php 
                     $id = $this->session->userdata('id');
                     $url = $this->uri->uri_string(); 
                     ?>
                     
                     <!--Salir-->
                     <div class="modal fade" id="salir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                     <div class="modal-content">
                     <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <center><h4 class="modal-title" id="myModalLabel">Salir</h4></center>
                     </div>
                     <div class="modal-body">
                     <h2 class="text-center">¿Esta seguro de cerrar la sección?</h2>
                     <h4 class="text-center"><?php echo $this->Ion_auth_model->user()->row()->username; ?></h4>
                     </div>
                     <div class="modal-footer">
                     <a href="<?php echo site_url(); ?>/auth/logout" class="btn btn-danger"> Si</a>
                     <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                     
                     </div>
                     
                     </div>
                     </div>
                     </div>
                     
                     <!--Cambiar Contraseña-->
                     <div class="modal fade" id="cambiar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                     <div class="modal-content">
                     <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <center><h4 class="modal-title" id="myModalLabel">Cambiar Contraseña</h4></center>
                     </div>
                     <div class="modal-body">
                     <div class="container-fluid">
                     <form method="POST" action="<?php echo site_url(); ?>/auth/change_password">
                     <div class="row form-group">
                      <input type="hidden" class="form-control" name="url" value="<?php echo site_url(); ?>/<?php echo $url ?>">   
                     <div class="form-group">
                     <label>Contraseña Actual</label><input type="password"  class="form-control"  required="" id="old" name="old"  minlength="8" class="form-control">
                     </label>
                     </div>
                     <div class="form-group">
                     <label>Contraseña Nueva</label><input type="password"  class="form-control" required=""  id="new" name="new"  minlength="8" class="form-control">
                     </label>
                     </div>
                     <div class="form-group">
                     <label>Confirmar Contraseña</label><input type="password"  class="form-control" required=""  id="new_confirm" name="new_confirm"  minlength="8" class="form-control">
                     </label>
                     </div>
                     <input type="hidden" value="<?php echo $this->Ion_auth_model->user()->row()->id; ?>"  class="form-control"   id="user_id" name="user_id" >
                     </div> 
                     </div>
                     <div class="modal-footer">
                     <center>
                     <button type="submit" class="btn btn-success">Cambiar</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                     </center>
                     </form>
                     </div>
                     
                     </div>
                     </div>
                     </div>
                     </div>
                     
                     <!--User Perfil-->
                     <div class="modal fade" id="perfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                     <div class="modal-content">
                     <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <center><h4 class="modal-title" id="myModalLabel">Perfil</h4></center>
                     </div>
                     <div class="modal-body">
                     <div class="container-fluid">
                     <form method="POST" action="<?php echo site_url(); ?>/auth/perfil/<?php echo $this->Ion_auth_model->user()->row()->id; ?>">
                     <div class="row form-group">
                     <input type="hidden" class="form-control" name="url" value="<?php echo site_url(); ?>/<?php echo $url ?>">   
                     <div class="col-sm-2">
                     <label class="control-label" style="position:relative; top:7px;">Nombre:</label>
                     </div>
                     <div class="col-sm-10">
                     <input type="text" class="form-control" id="first_name" required="" name="first_name" value="<?php echo htmlspecialchars($this->Ion_auth_model->user()->row()->first_name,ENT_QUOTES,'UTF-8'); ?>">
                     </div>
                     </div>
                     
                     
                     
                     <div class="row form-group">
                     <div class="col-sm-2">
                     <label class="control-label" style="position:relative; top:7px;">Apellido:</label>
                     </div>
                     <div class="col-sm-10">
                     <input type="text" class="form-control" id="last_name" required="" name="last_name" value="<?php echo htmlspecialchars($this->Ion_auth_model->user()->row()->last_name,ENT_QUOTES,'UTF-8'); ?>">
                     </div>
                     </div>
                     <div class="row form-group">
                     <div class="col-sm-2">
                     <label class="control-label" style="position:relative; top:7px;">Email:</label>
                     </div>
                     <div class="col-sm-10">
                     <input type="email" class="form-control" id="email" name="email" required="" disabled value="<?php echo htmlspecialchars($this->Ion_auth_model->user()->row()->email,ENT_QUOTES,'UTF-8'); ?>">
                     </div>
                     </div>
                     
                     
                     
                     <div class="row form-group">
                     <div class="col-sm-2">
                     <label class="control-label" style="position:relative; top:7px;">Teléfono:</label>
                     </div>
                     <div class="col-sm-10">
                     <input type="number" class="form-control" id="phone" name="phone" required="" size="8" maxlength="8" minlength="8" value="<?php echo htmlspecialchars($this->Ion_auth_model->user()->row()->phone,ENT_QUOTES,'UTF-8'); ?>">
                     </div>
                     </div>
                     <?php echo form_hidden('id', $user->id);?>
                     <?php echo form_hidden($csrf); ?>
                     
                     </div> 
                     </div>
                     <div class="modal-footer">
                     <center>
                     <button type="submit" class="btn btn-success">Actualizar</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                     </center>
                     </form>
                     </div>
                     
                     </div>
                     </div>
                     </div>
                     