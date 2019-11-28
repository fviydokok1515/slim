<?php
namespace App\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class Member
{
    public function login(Request $request, Response $response, $args)
    {
        $formData = $request->getParams();
        $responseData = null ;
        $db = new \App\Tools\Database();
        $result = $db->query("SELECT * FROM member WHERE username = '".$formData['user']."'LIMIT 1");

if($result['rowCount']>0){
    if($result['result'][0]['password'] == $formData['pass']){
 $responseData = array(
        "message" => "เข้าสู้ระบบสำเร็จ",
        "success" => true,
        "data" => $result['result'][0],
 );
    }else{
    $responseData = array(
        "message" => "รหัสไม่ถูก",
        "success" => false,
   ); 
}
}else{
    $responseData = array(
        "message" => "ไม่พบผู้ใช้งาน",
        "success" => false,
    );
}
        $response->getBody()->write(\json_encode($responseData));
        return $response;
    }
}