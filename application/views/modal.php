<?php 
      $url = $this->uri->uri_string();
?>
                     
<div class="modal fade" id="edit_<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Perfil</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="<?php echo site_url(); ?>/auth/perfil/<?php echo $user->id; ?>">
				<div class="row form-group">
				<input type="hidden" class="form-control" name="url" value="<?php echo site_url(); ?>/<?php echo $url?>"> 
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Nombre:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="first_name" required="" name="first_name" value="<?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8'); ?>">
					</div>
				</div>
				
				
				
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Apellido:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="last_name" required="" name="last_name" value="<?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8'); ?>">
					</div>
				</div>
				<div class="row form-group">
				<div class="col-sm-2">
				<label class="control-label" style="position:relative; top:7px;">Email:</label>
				</div>
				<div class="col-sm-10">
				<input type="email" class="form-control" id="email" name="email" required="" value="<?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8'); ?>">
				</div>
				</div>
				
				
				
				<div class="row form-group">
				<div class="col-sm-2">
				<label class="control-label" style="position:relative; top:7px;">Teléfono:</label>
				</div>
				<div class="col-sm-10">
				<input type="number" class="form-control" id="phone" name="phone" required="" size="8" maxlength="8" minlength="8" value="<?php echo htmlspecialchars($user->phone,ENT_QUOTES,'UTF-8'); ?>">
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

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Eliminar Usuario</h4></center>
            </div>
            <div class="modal-body">
            <form method="POST" action="<?php echo site_url(); ?>/auth/borrar_user/<?php echo $user->id; ?>">	
            	<h4 class="text-center">¿Esta seguro de Eliminar  el Usuario?</h4>
				<h3 class="text-center"><?php echo htmlspecialchars($user->username,ENT_QUOTES,'UTF-8'); ?></h3>
				
			</div>
            <div class="modal-footer">
                <button  type="submit" class="btn btn-danger">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
             </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="roll_<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">¿Esta seguro de cambiar el Roll?</h4></center>
            </div>
            <div class="modal-body">
            <form method="POST" action="<?php echo site_url(); ?>/auth/roll_edit">	
		
			<input type="hidden" value="<?php echo $user->id; ?>"  class="form-control"   id="id_roll" name="id_roll" >
			<?php       
			foreach($roles as $p){
			$pro=$p->id;
			$checked = null;
			$item = null;
			foreach($user->groups as $grp) {
			if ($pro == $grp->id) {
			$checked= ' checked="checked"';
			break;
			}
			}
			?>
			<label class="radio-inline">
			<input type="radio" name="roll" value="<?php echo $pro; ?>" <?php echo $checked; ?>>
			<?php echo $p->description; ?> </label>&nbsp;&nbsp;&nbsp;
			
			<?php 
			
			}
			?>
			
		
			</div>
            <div class="modal-footer">
                <button  type="submit" class="btn btn-danger">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
             </form>
            </div>

        </div>
    </div>
</div>