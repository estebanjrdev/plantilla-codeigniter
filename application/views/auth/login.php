              <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
              <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
              
              <title>Bienvenido</title>
              
              <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
              
              <link rel="icon" href="<?php echo base_url(); ?>boostrat/images/favicon.ico" type="image/ico" />
              <link href="<?php echo base_url(); ?>boostrat/css/font-awesome.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/css/animate.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/css/admin.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/css/font-awesome-animation.min.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/plugins/toggle-switch/toggles.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/plugins/checkbox/icheck.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/plugins/checkbox/minimal/blue.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/plugins/checkbox/minimal/green.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/plugins/checkbox/minimal/grey.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/plugins/checkbox/minimal/orange.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/plugins/checkbox/minimal/pink.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/plugins/checkbox/minimal/purple.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>plugins/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet">
              <link href="<?php echo base_url(); ?>plugins/dropzone/dropzone.css" rel="stylesheet">
              <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>boostrat/plugins/bootstrap-datepicker/css/datepicker.css" />
              <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>boostrat/plugins/bootstrap-timepicker/compiled/timepicker.css" />
              <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>boostrat/plugins/bootstrap-colorpicker/css/colorpicker.css" />
              <link href="<?php echo base_url(); ?>boostrat/plugins/data-tables/DT_bootstrap.css" rel="stylesheet">
              <link href="<?php echo base_url(); ?>boostrat/plugins/advanced-datatable/css/demo_table.css" rel="stylesheet">
              <link href="<?php echo base_url(); ?>boostrat/plugins/advanced-datatable/css/demo_page.css" rel="stylesheet">
              <link href="<?php echo base_url(); ?>boostrat/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
              <link href="<?php echo base_url(); ?>boostrat/assets/css/sweetalert2.min.css" rel="stylesheet">
              <link rel="stylesheet" href="<?php echo base_url(); ?>boostrat/plugins/file-uploader/css/jquery.fileupload.css">
              <link rel="stylesheet" href="<?php echo base_url(); ?>boostrat/plugins/file-uploader/css/jquery.fileupload-ui.css">
              </head>
              <body class="light_theme  fixed_header left_nav_fixed">
              
              <div class="wrapper">
              
              <div class="login_page">
              <div class="login_content">
              <div class="panel-heading border login_heading">BolaCubana</div>	
              <div id="infoMessage"><p><font color="#f6c23e"><?php echo $message;?></font></p></div>
              <form role="form" method="post" class="form-horizontal" action="<?php echo site_url(); ?>/auth/login">
              <div class="form-group">
              
              <div class="col-sm-10">
              <input type="text" placeholder="Correo" name="identity" required="" class="form-control">
              </div>
              </div>
              <div class="form-group">
              
              <div class="col-sm-10">
              <input type="password" placeholder="Contraseña" name="password" required="" class="form-control">
              </div>
              </div>
              <div class="form-group">
              <div class=" col-sm-10">
             
              <button class="btn btn-default pull-right" type="submit">Iniciar</button>
              </div>
              </div>
              
              </form>
              </div>
              </div>
              
              
              
              
              
              
              
              
              </div>
              <!--\\\\\\\ wrapper end\\\\\\-->
              <!-- Modal -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Compose New Task</h4>
              </div>
              <div class="modal-body"> content </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
              </div>
              </div>
              </div>
              </div>
              <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Compose New Task</h4>
              </div>
              <div class="modal-body"> sgxdfgxfg </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
              </div>
              </div>
              </div>
              </div>
              <!-- sidebar chats -->
              <nav class="atm-spmenu atm-spmenu-vertical atm-spmenu-right side-chat">
              <div class="header">
              <input type="text" class="form-control chat-search" placeholder=" Search">
              </div>
              <div href="#" class="sub-header">
              <div class="icon"><i class="fa fa-user"></i></div> <p>Online (4)</p>
              </div>
              <div class="content">
              <p class="title">Family</p>
              <ul class="nav nav-pills nav-stacked contacts">
              <li class="online"><a href="#"><i class="fa fa-circle-o"></i> Steven Smith</a></li>
              <li class="online"><a href="#"><i class="fa fa-circle-o"></i> John Doe</a></li>
              <li class="online"><a href="#"><i class="fa fa-circle-o"></i> Michael Smith</a></li>
              <li class="busy"><a href="#"><i class="fa fa-circle-o"></i> Chris Rogers</a></li>
              </ul>
              
              <p class="title">Friends</p>
              <ul class="nav nav-pills nav-stacked contacts">
              <li class="online"><a href="#"><i class="fa fa-circle-o"></i> Vernon Philander</a></li>
              <li class="outside"><a href="#"><i class="fa fa-circle-o"></i> Kyle Abbott</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Dean Elgar</a></li>
              </ul>   
              
              <p class="title">Work</p>
              <ul class="nav nav-pills nav-stacked contacts">
              <li><a href="#"><i class="fa fa-circle-o"></i> Dale Steyn</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Morne Morkel</a></li>
              </ul>
              
              </div>
              <div id="chat-box">
              <div class="header">
              <span>Richard Avedon</span>
              <a class="close"><i class="fa fa-times"></i></a>    </div>
              <div class="messages nano nscroller has-scrollbar">
              <div class="content" tabindex="0" style="right: -17px;">
              <ul class="conversation">
              <li class="odd">
              <p>Hi John, how are you?</p>
              </li>
              <li class="text-right">
              <p>Hello I am also fine</p>
              </li>
              <li class="odd">
              <p>Tell me what about you?</p>
              </li>
              <li class="text-right">
              <p>Sorry, I'm late... see you</p>
              </li>
              <li class="odd unread">
              <p>OK, call me later...</p>
              </li>
              </ul>
              </div>
              <div class="pane" style="display: none;"><div class="slider" style="height: 20px; top: 0px;"></div></div></div>
              <div class="chat-input">
              <div class="input-group">
              <input type="text" placeholder="Enter a message..." class="form-control">
              <span class="input-group-btn">
              <button class="btn btn-danger" type="button">Send</button>
              </span>      </div>
              </div>
              </div>
              </nav>
              <!-- /sidebar chats -->   
              
              <script src="<?php echo base_url(); ?>theme/js/jquery-2.1.0.js"></script>
              <script src="<?php echo base_url(); ?>theme/js/bootstrap.min.js"></script>
              <script src="<?php echo base_url(); ?>theme/js/common-script.js"></script>
              <script src="<?php echo base_url(); ?>theme/js/jquery.slimscroll.min.js"></script>
              <script src="<?php echo base_url(); ?>theme/plugins/data-tables/jquery.dataTables.js"></script>
              <script src="<?php echo base_url(); ?>theme/plugins/data-tables/DT_bootstrap.js"></script>
              <script src="<?php echo base_url(); ?>theme/plugins/data-tables/dynamic_table_init.js"></script>
              <script src="<?php echo base_url(); ?>theme/plugins/edit-table/edit-table.js"></script>
              <script>
              jQuery(document).ready(function() {
              EditableTable.init();
              });
              </script>
              
              <script src="<?php echo base_url(); ?>theme/js/jPushMenu.js"></script> 
              <script src="<?php echo base_url(); ?>theme/js/side-chats.js"></script>
              
              </body>
              </html>
              