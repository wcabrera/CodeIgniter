<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;


class Pedidos extends REST_Controller {


public function __construct(){

    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
    header("Access-Control-Allow-Origin: *");

    parent::__construct();
    $this->load->database();
}
public function index_get(){

    // $query=$this->db->query('select * from `lineas`');

    // $respuesta=array(
    //             'error'=>FALSE,
    //             'pedidos'=>$query->result_array()
    // );

    // $this->response($respuesta);

   // echo "hola mundo";
}


public function realizar_orden_post($token="0",$id_usuario="0"){

    $data=$this->post();
    if($token=="0" || $id_usuario=="0"){
        $respuesta=array(
            'error'=>TRUE,
            'mensaje'=>"Token invalido y/o usuario invalido"
        );
      //  echo 'Total Results: ' .$data;
      //  $this->response($respuesta,REST_Controller::HTTP_BAD_REQUEST);
    }
        echo 'Total Results: ' .$data;
}

}