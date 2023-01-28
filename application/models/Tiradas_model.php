<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tiradas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper("fechas");
    }
    function getData(){
    $this->db->order_by('fecha');
    $tiradas = $this->db->get('tiradas');
    
    return $tiradas->result();
    }
    
    function getCharada(){
    $this->db->order_by('numero');
    $charada = $this->db->get('charada');
    
    return $charada->result();
    }
    
    
    function buscar($fecha){
    $this->db->select('*');
    $this->db->from('tiradas');
    $this->db->where('fecha =', $fecha);
    $tiradas = $this->db->get();
    return $tiradas->result();
    }
    
    function ultimaFecha() {
    $sql = $this->db->query("SELECT MAX(`fecha`) FROM `tiradas` ");
    return $sql->result_array();
    }
    
    function ultimosietedia() {
    $sql = $this->db->query("SELECT `fecha`,`tirada` FROM `tiradas` ORDER BY `fecha` DESC LIMIT 10 ");
    return $sql->result();
    }
    
    function obtenerFechas($fecha) {
    $sql = $this->db->query("SELECT `fecha`  FROM `tiradas` WHERE `fecha` ='". $fecha."'" );
    return $sql->row_array();
    }
    
    function getRoll(){
    $roles = $this->db->get('groups');
    
    return $roles->result();
    }
    
    
    public function eliminar($id){
    $this->db->where('id',$id);
    if($this->db->delete('tiradas')){
    return TRUE;
    }
    return FALSE;
    
    }
    
     function insert_cant_pronostico($data){
       $pro =$data['pro'];
     $this->db->set('cant_pronostico', $pro);
     $this->db->where('id=' . $data['id']);
     if ($this->db->update('users')) {
     return TRUE;
     }
     return FALSE;
     }
     
     
    function insert($data) {
    $fecha =$data['fecha'];
    $tiro =$data['tiro'];
    $this->db->set('fecha', $fecha);
    $this->db->set('tirada', $tiro);
    if ($this->db->insert('tiradas')) {
    return TRUE;
    }
    $dec=decena($tiro);
    $ter=terminale($tiro);
    $sql1 =$this->db->query("INSERT INTO `todas_tiradas`(`fecha`,`tirada`, `decena`, `terminal`) VALUES ('$fecha','$tiro','$dec','$ter')");
    return FALSE;
    }
    
    function update($data) {
    $tiro =$data['tiro'];
    $this->db->set('tirada', $tiro);
    
    $this->db->where('id=' . $data['id']);
    
    if ($this->db->update('tiradas')) {
    return TRUE;
    }
    return FALSE;
    }
    
    public function tirada_hoy(){
    $consulta = $this->db->query('SELECT tirada FROM tiradas WHERE DAYOFWEEK(fecha) = DAYOFWEEK(CURRENT_DATE()) ');
    return $consulta->result();
    }
    
    public function lunes(){
    $consulta = $this->db->query('SELECT tirada FROM tiradas WHERE DAYOFWEEK(fecha) =2 ');
    return $consulta->result();
    }
    
    public function martes(){
    $consulta = $this->db->query('SELECT tirada FROM tiradas WHERE DAYOFWEEK(fecha) =3 ');
    return $consulta->result();
    }
    
    public function miercoles(){
    $consulta = $this->db->query('SELECT tirada FROM tiradas WHERE DAYOFWEEK(fecha) =4 ');
    return $consulta->result();
    }
    
    public function jueves(){
    $consulta = $this->db->query('SELECT tirada FROM tiradas WHERE DAYOFWEEK(fecha) =5 ');
    return $consulta->result();
    }
    
    public function viernes(){
    $consulta = $this->db->query('SELECT tirada FROM tiradas WHERE DAYOFWEEK(fecha) =6 ');
    return $consulta->result();
    }
    
    public function sabado(){
    $consulta = $this->db->query('SELECT tirada FROM tiradas WHERE DAYOFWEEK(fecha) =7 ');
    return $consulta->result();
    }
    
    public function domingo(){
    $consulta = $this->db->query('SELECT tirada FROM tiradas WHERE DAYOFWEEK(fecha) =1 ');
    return $consulta->result();
    }
    
    public function decUno(){
    $sql = $this->db->query('SELECT COUNT(tirada) FROM tiradas WHERE tirada BETWEEN 1 AND 9 ');
    return $sql->row_array();
    }
    
    public function decDos(){
    $sql = $this->db->query('SELECT COUNT(tirada) FROM tiradas WHERE tirada BETWEEN 10 AND 19 ');
    return $sql->row_array();
    }
    
    public function decTres(){
    $sql = $this->db->query('SELECT COUNT(tirada) FROM tiradas WHERE tirada BETWEEN 20 AND 29 ');
    return $sql->row_array();
    }
    
    public function decCuatro(){
    $sql = $this->db->query('SELECT COUNT(tirada) FROM tiradas WHERE tirada BETWEEN 30 AND 39 ');
    return $sql->row_array();
    }
    
    public function decCinco(){
    $sql = $this->db->query('SELECT COUNT(tirada) FROM tiradas WHERE tirada BETWEEN 40 AND 49 ');
    return $sql->row_array();
    }
    
    public function decSeis(){
    $sql = $this->db->query('SELECT COUNT(tirada) FROM tiradas WHERE tirada BETWEEN 50 AND 59 ');
    return $sql->row_array();
    }
    
    public function decSiete(){
    $sql = $this->db->query('SELECT COUNT(tirada) FROM tiradas WHERE tirada BETWEEN 60 AND 69 ');
    return $sql->row_array();
    }
    
    public function decOcho(){
    $sql = $this->db->query('SELECT COUNT(tirada) FROM tiradas WHERE tirada BETWEEN 70 AND 79 ');
    return $sql->row_array();
    }
    
    public function decNueve(){
    $sql = $this->db->query('SELECT COUNT(tirada) FROM tiradas WHERE tirada BETWEEN 80 AND 89 ');
    return $sql->row_array();
    }
    
    public function decDiez(){
    $sql = $this->db->query('SELECT COUNT(tirada) FROM tiradas WHERE tirada BETWEEN 90 AND 100 ');
    return $sql->row_array();
    }
    
   public function atrazados(){
   $sql0 = $this->db->query('TRUNCATE TABLE `atrazados`');
   for($i=1;$i<=100;$i++){
   
   $sql =$this->db->query('INSERT INTO `atrazados`(`tiro`, `fecha`, `atrasado`)  SELECT `tirada`,MAX(`fecha`) ,DATEDIFF(CURRENT_DATE(),MAX(`fecha`)) FROM  `tiradas` WHERE `tirada`='.$i);
   }
   
   } 
   
   public function unDiaComoHoy(){
   $sql = $this->db->query("SELECT `tirada`, `fecha` FROM `tiradas` WHERE EXTRACT( DAY FROM `fecha`) = EXTRACT(DAY FROM CURRENT_DATE()) AND  EXTRACT( MONTH FROM `fecha`) = EXTRACT(MONTH FROM CURRENT_DATE()) ORDER BY `fecha` DESC LIMIT 20");
   return $sql->result();
   }
   
   public function obtenerAtrasados() {
   $sql = $this->db->query("SELECT `tiro`, `fecha`, `atrasado` FROM `atrazados` ORDER BY `atrasado` DESC LIMIT 20" );
   return $sql->result();
   }
   
  /* public function decena_terminale() {
   $sql0 = $this->db->query('TRUNCATE TABLE `decena_terminale`');
   $sql = $this->db->query("SELECT `tirada`, `fecha` FROM `tiradas`  ORDER BY `fecha` DESC LIMIT 365" );
   foreach($sql->result() as $val){
   $fech=$val->fecha;
   $dec=decena($val->tirada);
   $ter=terminale($val->tirada);
   $sql1 =$this->db->query("INSERT INTO `decena_terminale`(`fecha`, `decena`, `terminal`) VALUES ('$fech','$dec','$ter')");
   }
   }*/
   
   
   public function atrazo_decter(){
  $sql0 = $this->db->query('TRUNCATE TABLE `atrazo_dec`');
  $sql2 = $this->db->query('TRUNCATE TABLE `atrazo_ter`');
   for($i=0;$i<=9;$i++){
   
   $sql =$this->db->query('INSERT INTO `atrazo_dec`(`dec`, `atrazodec`,`fecha`)  SELECT `decena` ,DATEDIFF(CURRENT_DATE(),MAX(`fecha`)),MAX(`fecha`) FROM  `todas_tiradas` WHERE `decena`='.$i);
   $sql1 =$this->db->query('INSERT INTO `atrazo_ter`(`ter`, `atrazoter`,`fecha`)  SELECT `terminal` ,DATEDIFF(CURRENT_DATE(),MAX(`fecha`)),MAX(`fecha`) FROM  `todas_tiradas` WHERE `terminal`='.$i);
   }
  } 
  
  public function obtenerdecena() {
  $sql = $this->db->query("SELECT * FROM `atrazo_dec` ORDER BY `atrazodec` DESC LIMIT 730" );
  return $sql->result();
  }
  
  public function obtenerterminale() {
  $sql = $this->db->query("SELECT * FROM `atrazo_ter` ORDER BY `atrazoter` DESC LIMIT 730" );
  return $sql->result();
  }
  
/*  public function todas_tiradas() {
//  $sql0 = $this->db->query('TRUNCATE TABLE `decena_terminale`');
  $sql = $this->db->query("SELECT * FROM `tiradas`  ORDER BY `fecha`" );
  foreach($sql->result() as $val){
  $fech=$val->fecha;
  $tiro = $val->tirada;
  $dec=decena($val->tirada);
  $ter=terminale($val->tirada);
  $sql1 =$this->db->query("INSERT INTO `todas_tiradas`(`fecha`,`tirada`, `decena`, `terminal`) VALUES ('$fech','$tiro','$dec','$ter')");
  }
  }*/
  
  public function viene_terminal() {
  $sql = $this->db->query("SELECT `terminal` FROM `todas_tiradas` ORDER BY `fecha`  " );
  return $sql->result();
  }
  
  public function viene_decena() {
  $sql = $this->db->query("SELECT `decena` FROM `todas_tiradas` ORDER BY `fecha`  " );
  return $sql->result();
  }
  
  
  public function ultima_tirada() {
  $sql = $this->db->query("SELECT `tirada` FROM `tiradas`  ORDER BY `fecha` DESC LIMIT 1");
  return $sql->result();
  }
  
  public function notificar() {
  $sql = $this->db->query("SELECT DATEDIFF(CURRENT_DATE(),MAX(`fecha`)) FROM `tiradas`");
  return $sql->result_array();
  }
  
  public function posible_hoy(){
  $sql0 = $this->db->query('TRUNCATE TABLE `hoy_viene`');
  $sql1 = $this->db->query("SELECT `tirada` FROM `tiradas`  ORDER BY `fecha` DESC LIMIT 1");
  $sql = $this->db->query("SELECT * FROM `tiradas`  ORDER BY `fecha`" );
  $arr=array();
  foreach($sql1->result() as $u){
  $ultima = $u->tirada;
  }
  foreach($sql->result() as $val){
  $arr[] = $val->tirada;
   }
   $p=24;
     for($i=1;$i<=100;$i++){
   $temporal= terminal_viene($arr,24,$i);
   $insert=$this->db->query("INSERT INTO `hoy_viene`(`tirada`,`viene`, `veces`) VALUES ('$p','$i','$temporal')");
  }
   
   }
  }
  
  