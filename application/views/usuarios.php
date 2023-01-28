      <body class="light_theme  fixed_header left_nav_fixed">
      <div class="wrapper">
      <!--\\\\\\\ wrapper Start \\\\\\-->
      <div class="header_bar">
      <!--\\\\\\\ header Start \\\\\\-->
      <div class="brand">
      <!--\\\\\\\ brand Start \\\\\\-->
      <div class="logo" style="display:block"><span class="theme_color">BolaCubana</span> </div>
      <div class="small_logo" style="display:none"><img src="images/s-logo.png" width="50" height="47" alt="s-logo" /> <img src="images/r-logo.png" width="122" height="20" alt="r-logo" /></div>
      </div>
      <!--\\\\\\\ brand end \\\\\\-->
      <div class="header_top_bar">
      <!--\\\\\\\ header top bar start \\\\\\-->
      <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
      <div class="top_left">
      <div class="top_left_menu">
      
      </div>
      </div>
      <div class="top_right_bar">
      <div class="top_right">
      <div class="top_right_menu">
      
      </div>
      </div>
      <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"> <a href="" data-toggle="dropdown"><span class="user_adminname"><?php  echo $this->Ion_auth_model->user()->row()->first_name; ?></span> <b class="caret"></b> </a>
      <ul class="dropdown-menu">
      <div class="top_pointer"></div>
      <li> <a href="" data-toggle="modal" data-target="#perfil"><i class="fa fa-user"></i> Perfil</a> </li> 
      <li> <a href="" data-toggle="modal" data-target="#cambiar"><i class="fa fa-pencil"></i>Contraseña</a> </li>
      <li> <a href="" data-toggle="modal" data-target="#salir"><i class="fa fa-power-off"></i> Salir</a> </li>
      </ul>
      </li>
      </ul>
      
      
      
      </div>
      </div>
      <!--\\\\\\\ header top bar end \\\\\\-->
      </div>
      <!--\\\\\\\ header end \\\\\\-->
      <div class="inner">
      <!--\\\\\\\ inner start \\\\\\--><div class="left_nav">
      
      <!--\\\\\\\left_nav start \\\\\\-->
      
      <div class="left_nav_slidebar">
      <ul>
      <li><a href="<?php echo site_url(); ?>/auth"><i class="fa fa-home"></i> Inicio <span class="plus"><i class="fa fa-check"></i></span> </a>
      <li><a href="<?php echo site_url(); ?>/auth/usuarios"><i class="fa fa-users"></i> Usuarios <span class="plus"><i class="fa fa-check"></i></span> </a>
      <li><a href="<?php echo site_url(); ?>/auth/trazas"><i class="fa fa-tasks"></i> Trazas <span class="plus"><i class="fa fa-check"></i></span> </a>
      
      
      
      </ul>
      </div>
      </div>
      <!--\\\\\\\left_nav end \\\\\\-->
      <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
      <div class="pull-left page_title theme_color">
      <h1></h1>
      </div>
      <ol class="breadcrumb">
      <li><a href="<?php echo site_url(); ?>/auth/usuarios">Usuarios</a></li>
      </ol>
      </div>
      <div id="main-content">
      <div class="page-content">
      
      <div class="row">
      <div class="col-md-12">
      
      <script>
     // ica que validaremos letras mayúsculas y minúsculas (case-insensitive)
      
    //  Así, una posible implementación para nuestra validación sería la siguiente:
      
      // La siguiente funcion valida el elemento input
      function validar() {
      // Variable que usaremos para determinar si el input es valido
      let isValid = false;
      
      // El input que queremos validar
      const input = document.forms['create']['first_name'];
      
      //El div con el mensaje de advertencia:
      const message = document.getElementById('message');
      
      input.willValidate = false;
      
      // El tamaño maximo para nuestro input
      const maximo = 35;
      
      // El pattern que vamos a comprobar  /[\u0400-\u04FF]+/g
      const pattern = new RegExp('^[ A-Z\u00D1-\u00F1]+$', 'i');
      
      // Primera validacion, si input esta vacio entonces no es valido
      if(!input.value) {
      isValid = false;
      } else {
      // Segunda validacion, si input es mayor que 35
      if(input.value.length > maximo) {
      isValid = false;
      } else {
      // Tercera validacion, si input contiene caracteres diferentes a los permitidos
      if(!pattern.test(input.value)){ 
      // Si queremos agregar letras acentuadas y/o letra ñ debemos usar
      // codigos de Unicode (ejemplo: Ñ: \u00D1  ñ: \u00F1)
      isValid = false;
      } else {
      // Si pasamos todas la validaciones anteriores, entonces el input es valido
      isValid = true;
      }
      }
      }
      
      //Ahora coloreamos el borde de nuestro input
      if(!isValid) {
      // rojo: no es valido
      input.style.borderColor = 'salmon'; // me parece que 'salmon' es un poco menos agresivo que 'red'
      // mostramos mensaje
      message.hidden = false;
      } else {
      // verde: si es valido
     input.style.borderColor = 'WindowFrame'; // 'palegreen' se ve mejor que 'green' en mi opinion
      // ocultamos mensaje;
      message.hidden = true;
      }
      
      // devolvemos el valor de isValid
      return isValid;
      }
      //validar apellido 
      function apellido() {
      let isValid1 = false;
      const input1 = document.forms['create']['last_name'];
      const message1 = document.getElementById('messagea');
      input1.willValidate = false;
      const maximo1 = 35;
      const pattern1 = new RegExp('^[ A-Z\u00D1-\u00F1]+$', 'i');
      
      if(!input1.value) {
      isValid1 = false;
      } else {
      if(input1.value.length > maximo1) {
      isValid1 = false;
      } else {
      if(!pattern1.test(input1.value)){ 
      isValid1 = false;
      } else {
      isValid1 = true;
      }
      }
      }
      
      if(!isValid1) {
      input1.style.borderColor = 'salmon'; // me parece que 'salmon' es un poco menos agresivo que 'red'
      message1.hidden = false;
      } else {
      input1.style.borderColor = 'WindowFrame'; // 'palegreen' se ve mejor que 'green' en mi opinion
      message1.hidden = true;
      }
      
      return isValid1;
      }
   
      // validar formato de email 
      function email() {
      let isValid2 = false;
      const input2 = document.forms['create']['email'];
      const message2 = document.getElementById('message_email');
      input2.willValidate = false;
      //cadena.slice(-6,8)
     // var cadena = document.getElementById('email');
      if(input2.value.slice(-19) == "@colombia.azcuba.cu") {
      isValid2 = true;
      } else {
      isValid2 = false;
      }
      if(!isValid2) {
      input2.style.borderColor = 'salmon'; // me parece que 'salmon' es un poco menos agresivo que 'red'
      message2.hidden = false;
      } else {
      input2.style.borderColor = 'WindowFrame'; // 'palegreen' se ve mejor que 'green' en mi opinion
      message2.hidden = true;
      }
      
      return isValid2;
      }
      
      
      </script>
      
    <?php
    
    if ($message) {
    echo "<div class=\"col-lg-12\"><div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div></div>";
    }
    
    if ($success_message) {
    echo "<div class=\"col-lg-12\"><div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div></div>";
    }
    ?>
    <div class="block-web">
    <div class="header">
    <center>  <h3 class="content-header">Gestión de Usuarios</h3> </center>
    </div>
    <div class="porlets-content">
    <div class="adv-table editable-table ">
    <div class="clearfix">
    <div class="btn-group">
    <button data-toggle="modal" data-target="#myModal" class="btn btn-primary">
    Nuevo Usuario 
    </button>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="btn-group">
    <button data-toggle="modal" data-target="#roles" class="btn btn-success">
    Roles del Sistema 
    </button>
    </div>
    <div class="btn-group pull-right">
    <a href="<?php echo site_url(); ?>/auth/exportar_user"  class="btn btn-success">Exportar Usuarios</a>
    </div>
    </div>
    </br>
    <table class="table table-striped" id="editable-sample">
    <thead>
    <tr>
    <th class="text-center">Nombre</th>
    <th class="text-center">Apellidos</th>
    <th class="text-center">Email</th>
    <th class="text-center">Teléfono</th>
    <th class="text-center">Editar Roll</th>
      <th class="text-center">Estado</th>
      <th class="text-center">Editar</th>
    <th class="text-center">Eliminar</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user):?>
    <tr>
    <td class="text-center"><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
    <td class="text-center"><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
    <td class="text-center"><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
    <td class="text-center"><?php echo htmlspecialchars($user->phone,ENT_QUOTES,'UTF-8');?></td>      
    <td class="text-center"><a href="#roll_<?php echo $user->id;?>" class="btn btn-info btn-xs" data-toggle="modal"><?php foreach ($user->groups as $group):?>
    <?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8') ;?>
    <?php endforeach?></a>
    </td>   
        <td class="text-center"><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link'),'data-toggle="modal" data-target="#activo"  class="btn btn-success btn-xs"') : anchor("auth/activate/". $user->id, lang('index_inactive_link'),'data-toggle="tooltip" data-placement="top" title="Activar" class="value tooltips btn btn-danger btn-xs"');?></td>  
         <td class="text-center"><a href="#edit_<?php echo $user->id;?>" class="btn btn-warning btn-xs" data-toggle="modal">Editar</a></td>
    <td class="text-center"><a href="#delete_<?php echo $user->id;?>" class="btn btn-danger btn-xs" data-toggle="modal">Eliminar</a></td>
    
    <?php include('modal.php'); ?>
    </tr>
    <?php endforeach;?>
    </tbody>
    </table>
    
    </div><!--/porlets-content-->  
    </div><!--/block-web--> 
    <!--/col-md-12--> 
    </div>
      
      </div>
      </div>
      </div>
      </div>
      
      
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
      </div>
      <!--\\\\\\\ content panel end \\\\\\-->
      </div>
      <!--\\\\\\\ inner end\\\\\\-->
      </div>
      <!--\\\\\\\ wrapper end\\\\\\-->
      
      
      
      <!-- roles -->
      
      <div class="modal fade" id="roles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <center> <h4 class="modal-title" id="myModalLabel">Roles</h4></center>
      </div>
      <div class="modal-body">
  
      <div class="block-web">
      
      <div class="porlets-content">
      <div class="basic-wizard" id="progressWizard">
      <ul class="nav nav-pills nav-justified">
      <li class="active"><a data-toggle="tab" href="#ptab1">Existentes</a></li>
      <li><a data-toggle="tab" href="#ptab2">Agregar</a></li>
      </ul>
      <div class="tab-content">
      <div id="ptab1" class="tab-pane active">
      <div class="col-lg-6"> 
      <section class="panel default blue_title h2">
    
      <div class="panel-body">
      
      <table class="table table-hover">
      <thead>
      <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Eliminar</th>
      </tr>
      </thead>
      <tbody>
      <?php 
      $contador = 0;
      foreach ($roles as $r):
      $contador ++;
      ?>
      <tr>
      <td><?php echo htmlspecialchars($contador,ENT_QUOTES,'UTF-8');?></td>
      <td><?php echo htmlspecialchars($r->description,ENT_QUOTES,'UTF-8');?></td>
      <td><a href="<?php echo site_url(); ?>/auth/borrar_group/<?php echo $r->id; ?>" class="btn btn-danger btn-xs">Eliminar</a></td>
      </tr>
      <?php endforeach;?>
      </tbody>
      </table>
      
      </div>
      </section>
      </div>
      </div>
      <div id="ptab2" class="tab-pane">
      <form role="form" method="POST" action="<?php echo site_url(); ?>/auth/create_group">
      <div class="form-group">
      <label>Nombre</label><input type="text" class="form-control" required=""  id="group_name" name="group_name">
      </label>
      </div>
      <div class="form-group">
      <label>Descripción</label><input type="text" class="form-control" required=""  id="description" name="description">
      
      </div>
      
      <div class="form-group">
      <center>
      <button   type="submit" class="btn btn-primary btn-round" >Insertar</button>
      <button type="button" class="btn btn-danger btn-round"  data-dismiss="modal"> Cancelar</button>
      </center>
      
      </div>
      </form>
      </div>
      </div><!-- /tab-content -->
      
      </div><!--/progressWizard-->
      </div><!--/porlets-content--> 
      </div><!--/block-web--> 
 
      </div>
      </div>
      </div>
      </div>
      
      
      

      
      
      
      
      <!--Crear Usuario-->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <center> <h4 class="modal-title" id="myModalLabel">Insertar Usuario</h4></center>
      </div>
      <div class="modal-body">
      <form role="form" method="POST" id="create" name="create" action="<?php echo site_url(); ?>/auth/create_user" >
      
      
      
      <div class="form-group">
      <label>Nombre</label><input  class="form-control" type="text" id="first_name" required="" name="first_name" onkeyup="validar()" onblur="validar()">
      <div id="message" style="position: absolute; left: 25px; top: 70px; color: salmon; z-index: 10" hidden>
      Introduzca solo letras (a-z).
      </div>
      </div>
      
      <div class="form-group">
      <label>Apellidos</label><input type="text"  class="form-control" required=""  id="last_name" name="last_name" onkeyup="apellido()" onblur="apellido()">
      <div id="messagea" style="position: absolute; left: 25px; top: 138px; color: salmon; z-index: 10" hidden>
      Introduzca solo letras (a-z).
      </div>
      </div>
      
      <div class="form-group">
      <label>Email</label><input type="email"  class="form-control" required=""  id="email" name="email">
   <!--   <div id="message_email" style="position: absolute; left: 25px; top: 206px; color: salmon; z-index: 10" hidden>
      Formato de correo debe ser @colombia.azcuba.cu
      </div> -->
      </div>
      
      <div class="form-group">
      <label>Teléfono</label> <div class="input-group"><span class="input-group-addon">+53</span><input parsley-type="phone" type="text"  class="form-control" required=""  size="8" maxlength="8" minlength="8" id="phone" name="phone"></div>
      </div>
      
      <div class="form-group">
      <label>Contraseña</label><input type="password" value="12345678" disabled class="form-control" required=""  id="password" name="password"  minlength="8" class="form-control">
      </label>
      </div>
      <div class="form-group">
      <label>Confirmar Contraseña</label><input type="password" value="12345678" disabled class="form-control" required=""  id="password_confirm" name="password_confirm"  minlength="8" class="form-control">
      
      </div>
      
      <div class="form-group">
      <center>
      <button   type="submit" class="btn btn-primary btn-round" >Insertar</button>
      <button type="button" class="btn btn-danger btn-round"  data-dismiss="modal"> Cancelar</button>
      </center>
      
      </div>
      
      </form>
      </div>
      </div>
      </div>
      </div>
      
      
      <?php include('auth/perfil_usuarios.php'); ?>
      
      <!--Desactivar User-->
      <div class="modal fade" id="activo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <center><h4 class="modal-title" id="myModalLabel">Desactivar</h4></center>
      </div>
      <div class="modal-body">
      
      </div>
      </div>
      </div>
      </div>
      
      