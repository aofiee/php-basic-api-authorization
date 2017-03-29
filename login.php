<?php
include ('aes.php');
include('vendor/autoload.php');
include('db.php');
use Symfony\Component\HttpFoundation\Request;

$request = new Request(
    $_GET,
    $_POST,
    array(),
    $_COOKIE,
    $_FILES,
    $_SERVER
);
$json_decode = json_decode($request->getContent());
if($request->headers->get('application-authorization') != '/FJrr2h1w/KhJ/Ltygyx1h20s/09JrfIyl7yrgC1Ls/67d9V5x4IxW0TkMWQfVm+wN6n65AKSaEVzVwV3YJleA==' && $request->headers->get('secret') != '8Z0PJ95FMTGDB3FB4t1SM5tgU8ZVcIsaiSBLtQ=='){
    die(json_encode(
        array(
          'status' => false,
          'desc' => 'Application-authorization not match.'
        )
      ));
}
$query = QB::table('user_tab')->where('username', '=', $json_decode->username)->where('password', '=', md5($json_decode->password));
$result = $query->get();
if($result){
  $aes = new aes();
  $token = $aes->getEncrypted($username.$password.'@'.time());
  $data = array(
    'token' => $token,
  );
  QB::table('user_tab')->where('username','=', $json_decode->username)->update($data);
  die(json_encode(
    array(
      'status' => true,
      'desc' => 'Login completed.',
      'token' => $token,
    )
  ));
}else{
  die(json_encode(
    array(
      'status' => false,
      'desc' => 'permission denied'
    )
  ));
}
?>
