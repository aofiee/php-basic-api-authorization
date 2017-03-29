<?php
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
switch ($json_decode->apiname) {
  case 'getuserprofile':
    $query = QB::table('user_tab')
        ->select('bio')
        ->join('biography', 'biography.uid', '=', 'user_tab.uid')->where('user_tab.token', '=', $request->headers->get('token'));
    $result = $query->get();
    if($result){
      die(json_encode(
        array(
            'status' => true,
            'profile' => $result,
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
    break;
    default:
      die(json_encode(
        array(
          'status' => false,
          'desc' => 'permission denied'
        )
      ));
    break;
}
?>
