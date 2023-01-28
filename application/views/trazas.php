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
      <li><a href="<?php echo site_url(); ?>/auth/trazas">Trazas</a></li>
      </ol>
      </div>
      <div id="main-content">
      <div class="page-content">
      
      <div class="row">
      <div class="col-md-12">
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
             <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
     <center>        <h3 class="content-header">Trazas de Navegación</h3> </center>
           </div>
        <div class="porlets-content">
         <div class="adv-table editable-table ">
                        <div class="clearfix">
                        <div class="btn-group">
                        <a href="<?php echo site_url(); ?>/auth/delete_trazas"  class="btn btn-danger">Borrar Trazas</a>
                        </div>
                        <div class="btn-group pull-right">
                        <a href="<?php echo site_url(); ?>/auth/exportar"  class="btn btn-success">Exportar Trazas</a>
                        </div>
                        </div>
                        </br>
                         <table class="table table-striped" id="editable-sample">
                             <thead>
                             <tr>
                                 <th class="text-center">Fecha</th>
                                 <th class="text-center">Nombre</th>
                                 <th class="text-center">Apellidos</th>
                                 <th class="text-center">Email</th>
                                 <th class="text-center">Acción</th>
                                 
                                 <th class="text-center">Ipaddress</th>
                             </tr>
                             </thead>
                             <tbody>
                             <?php foreach ($traza as $u): ?>
                             <tr>
                             <td class="text-center"><?php echo $u->date; ?></td>
                             <td class="text-center"><?php 
                             $obtenerUser = $this->traza_model->obtenerUser($u->user_id);
                             
                             echo $obtenerUser[0]->first_name; ?></td>
                             <td class="text-center"><?php 
                             $obtenerUser = $this->traza_model->obtenerUser($u->user_id);
                             
                             echo $obtenerUser[0]->last_name; ?></td>
                             <td class="text-center"><?php 
                             $obtenerUser = $this->traza_model->obtenerUser($u->user_id);
                             
                             echo $obtenerUser[0]->email; ?></td>
                             <td class="text-center"><?php
                             $obtener = $this->traza_model->obtenerAction($u->action);
                             
                             echo $obtener[0]->action; ?></td>
                             <td class="text-center"><?php echo $u->ip; ?></td>                      
                             
    
                             </tr>
                             <?php endforeach; ?>      
                             
               
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
      <!-- Modal -->
      
      
      
      
      
      <?php include('auth/perfil_usuarios.php'); ?>
      
      
             