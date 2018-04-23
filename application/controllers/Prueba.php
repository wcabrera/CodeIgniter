<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;


class Prueba extends REST_Controller {

public function index(){

    echo "hola mundo";
}

public function __construct(){

    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
    header("Access-Control-Allow-Origin: *");

    parent::__construct();
    $this->load->database();
}



public function obtener_arreglo_get($index=0){


    //echo json_encode($arreglo[$index]);

    if($index>2){
        $respuesta=array('error'=>TRUE,'mensaje'=>'No existe elemento con la posicion '.$index);
        $this->response($respuesta,REST_Controller::HTTP_BAD_REQUEST);


    }else{
        $arreglo= array("manzanaz","pera","piña");
        $respuesta=array('error'=>FALSE,'fruta'=>$arreglo[$index]);
        $this->response($respuesta);
    }

   // $this->response($respuesta);

}

public function obtener_producto_get($codigo){
    // $echo  "da";
   
      $query = $this->db->query("select * from `productos` where codigo='".$codigo."'");
  
    
                 // echo json_encode($query->result());
      
                  $this->response($query->result());
         // echo 'Total Results: ' . $query->num_rows();
          }
  
  

}