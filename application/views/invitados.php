<body class="light_theme  fixed_header left_nav_fixed">
  <div class="wrapper">
    <!--\\\\\\\ wrapper Start \\\\\\-->
    <div class="header_bar">
      <!--\\\\\\\ header Start \\\\\\-->
      <div class="brand">
        <!--\\\\\\\ brand Start \\\\\\-->
        <div class="logo" style="display:block"><span class="theme_color">BolaCubana</span> </div>
        <div class="small_logo" style="display:none"><img src="<?php echo base_url(); ?>/theme/azcuba.jpg" width="50" height="47" alt="s-logo" /> <img src="<?php echo base_url(); ?>/theme/azcuba.jpg" width="122" height="20" alt="r-logo" /></div>
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
            <li class="dropdown"> <a href="" data-toggle="dropdown"><span class="user_adminname"><?php echo $this->Ion_auth_model->user()->row()->first_name; ?></span> <b class="caret"></b> </a>
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
      <!--\\\\\\\ inner start \\\\\\-->
      <div class="left_nav">

        <!--\\\\\\\left_nav start \\\\\\-->

        <div class="left_nav_slidebar">
         
        </div>
      </div>
      <!--\\\\\\\left_nav end \\\\\\-->
      <div class="contentpanel">
        <div class="pull-left breadcrumb_admin clear_both">
          <div class="pull-left page_title theme_color">
            <h1></h1>
          </div>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>/auth">Inicio</a></li>
          </ol>
        </div>
        <!--\\\\\\\ contentpanel start\\\\\\-->
        <div id="main-content">
          <div class="page-content">
            <?php
            if ($success_message) {
              echo "<div class=\"col-lg-12\"><div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div></div>";
            }
            ?>
            <?php
            if ($message) {
              echo "<div class=\"col-lg-12\"><div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div></div>";
            }
            ?>
           
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