<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Traza_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getData() {
        $this->db->order_by('date');
        $traza = $this->db->get('logs');

        return  $traza ->result();
    }
    function obtenerUser($id) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id =', $id);
        $estudiante = $this->db->get();

        return $estudiante->result();
    }
    function obtenerAction($id) {
        $this->db->select('*');
        $this->db->from('actions');
        $this->db->where('id =', $id);
        $estudiante = $this->db->get();

        return $estudiante->result();
    }

    function logs($accion) {
        $hoy= getdate();
       $dat->user_id = $this->Ion_auth_model->user()->row()->id;
      $dat->action=$accion;
      
       $dat->ip=$this->Ion_auth_model->user()->row()->ip_address;
       $dat->date = $hoy['year'].'-'.$hoy['mon'].'-'.($hoy['mday']).' '.$hoy['hours'].':'.$hoy['minutes'].':'.($hoy['seconds']);
      
     
        $this->db->insert('logs',$dat);
    }
     function traza($accion,$tabla) {
        $hoy= getdate();
       $dat->id_usuario = $this->Ion_auth_model->user()->row()->id;
       $dat->email = $this->Ion_auth_model->user()->row()->email;
       $dat->nombre = $this->Ion_auth_model->user()->row()->first_name;
       $dat->apellidos= $this->Ion_auth_model->user()->row()->last_name;
       $dat->accion=$accion;
       $dat->tabla=$tabla;
       $dat->ip=$this->Ion_auth_model->user()->row()->ip_address;
       $dat->fecha = $hoy['year'].'-'.$hoy['mon'].'-'.($hoy['mday']);
       $dat->hora = $hoy['hours'].':'.$hoy['minutes'].':'.($hoy['seconds']);
        $this->db->insert('traza',$dat);
    }

      function borrar_trazas(){
      return $this->db->truncate('logs');
      }


}