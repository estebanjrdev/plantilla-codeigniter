
    <div class="panel default blue_title h2">
    
    
    <div class="panel-heading "><center>Desactivar Usuario</center></div>
    <div class="panel-body">
     <center> <h4>¿Estás seguro que quieres desactivar el usuario?</h4></center>
   <center> <h5><?php echo sprintf( $user->username);?></h5></center>
    
    <?php echo form_open("auth/deactivate/".$user->id);?>
    
    
     <div class="form-group">
     <center>
        
    <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
    <input type="radio" name="confirm" value="yes" checked="checked" />
    
    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
    <input type="radio" name="confirm" value="no" />
       
    </center>
    </div>
    
    <?php echo form_hidden($csrf); ?>
    <?php echo form_hidden(['id' => $user->id]); ?>
     <div class="form-group">
     <center>
    <button  type="submit" class="btn btn-success btn-round" >Desactivar</button>
    <button type="button" class="btn btn-danger btn-round"  data-dismiss="modal"> Cancelar</button>
    </center>
    </div>
    <?php echo form_close();?>
    </div>
    </div>
    