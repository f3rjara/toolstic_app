<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
include (ROOT_INCLUDE."/connect.php");  
include_once (ROOT_INCLUDE.'/fetch_array.php'); 

require ROOT_PATH.'/vendor/autoload.php';
use \Mailjet\Resources;



$correo = $_POST['correo'];
$codigo = $_POST['codigo'];
$codgen = $_POST['codgen'];

$SqlUser = "SELECT * FROM estudiante WHERE cod_estudiante = '" . $codigo . "' ";

$ResultSql = $conex->query($SqlUser); 

if($ResultSql->num_rows > 0){ 
    $datos_estudiante = $ResultSql->fetch_assoc();  

    $mj = new \Mailjet\Client('23fe03b3b8f94f11d0bb2a6147f60a11','40e5b85270db50282ca4a3d8b97c10ec',true,['version' => 'v3.1']);
    $body = [
    'Messages' => [
        [
        'From' => [
            'Email' => "toolsticweb@gmail.com",
            'Name' => "ToolsTIC - Herramientas Informáticas"
        ],
        'To' => [
            [
            'Email' => utf8_encode($datos_estudiante['correo_estudiante']),
            'Name' => utf8_encode($datos_estudiante['nombres_estudiante'])." ".utf8_encode($datos_estudiante['apellidos_estudiante'])
            ]
        ],
        'Subject' => "Recuperación de contraseña",
        'TextPart' => "ToolsTIC - Heramientas Informáticas Universidad de Nariño",
        'HTMLPart' => "<div class='container' style='
        margin: 0;
    '>
        <link href='https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&amp;display=swap' rel='stylesheet'>
        <div class='div' style='text-align: center; '>
          <img src='http://toolstic.udenar.edu.co/img/logoTic2.png' width='60%'>
        </div>
        <div class='div' style='text-align: center;padding: 30px;background-color: #f4f4f4;margin: 0;'>
                <h2 style='font-family: 'Comfortaa', cursive;'>Recuperación de contraseña para ToolsTIC</h2>
          <p style='font-family: 'Comfortaa', cursive;text-align: justify;padding: 50px 20px 0;'>
            Hace poco nos ha notificado que ha olvidado su contraseña para acceder a la prueba de Homologación de Lenguaje y Herramientas Informáticas de la Universida de Nariño, ToolsTIC. Si desea utilizar la Recuperación de Cuenta para recuperar el acceso a su cuenta. Para ello, copie el siguiente código de verificación en la página de ToolsTIC:
          </p>
         </div>
         
          <div style='
        text-align: center;
        padding: 30px;
    '><h2><button style='padding: 10px 30px;background: white;color: black;font-size: 1.7rem;font-weight: 600;border: 2px solid #019140;'>".utf8_encode($codgen)."</button></h2></div>
         
    <div style='text-align: center;padding: 30px;background-color: #f4f4f4;margin: 0;'>
          <p style='font-family: 'Comfortaa', cursive;'>
             Si el código anterior no funciona, comuniquese con el adminsitrador de ToolsTIC para restaurar su contraseña por defecto.
          </p>
        </div>
      </div>",
        'CustomID' => "toolsticweb"
        ]
    ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success();

    $restext = "El correo fue enviado con exito!";
    $respuesta = true; 
}
else{
    $restext = "El correo ingresado no corresponde al registrado en el sistema.";
    $respuesta = false; 
}


$conex->close();

echo json_encode(array("res"=>$respuesta,"restext"=>$restext, "cod" => $codigo)); 



?>