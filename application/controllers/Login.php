<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;


class Login extends REST_Controller {


public function __construct(){

    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
    header("Access-Control-Allow-Origin: *");

    parent::__construct();
    $this->load->database();
}

public function index_post(){
    $data=$this->post();

   // echo 'mostrando data '.$data;
    if(!isset($data['correo']) OR !isset($data['contrasena'])){
        $respuesta=array(
            'error'=> TRUE,
            'mensaje'=>'La infomracion enviada no es valida'
        );

        $this->response($respuesta,REST_Controller::HTTP_BAD_REQUEST);
        return;

    }

// Tenemos correo y contraseña en un post

$condiciones=array('correo'=>$data['correo'],
                    'contrasena'=>$data['contrasena']);

$query =$this->db->get_where('login',$condiciones);
$usuario=$query->row();
if(!isset($usuario)){
    $respuesta=array(
        'error'=> TRUE,
        'mensaje'=>'Usuario y/o contrasena no es valida'
    );

    $this->response($respuesta,REST_Controller::HTTP_BAD_REQUEST);
    return;
}

// AQUI!, tenemos un usuario y contraseña
//TOKEN
$token=bin2hex(openssl_random_pseudo_bytes(20));
$token=hash('ripemd160',$data['correo']);


// Guardar en base de datos el token

$this->db->reset_query();
$actualizar_token=array('token'=>$token);

$this->db->where('id',$usuario->id);
$hecho=$this->db->update('login',$actualizar_token);

$respuesta=array(
        'error'=>FALSE,
        'token'=>$token,
        'id_usuario'=>$usuario->id
);



$this->response($respuesta);

}





}