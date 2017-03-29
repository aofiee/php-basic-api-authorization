<?
include ('aes.php');
include('vendor/autoload.php');
use Symfony\Component\HttpFoundation\Request;
$request = new Request(
    $_GET,
    $_POST,
    array(),
    $_COOKIE,
    $_FILES,
    $_SERVER
);
//var_dump($request->headers->get('application-authorization'));
$aes = new aes();
$username = 'aofiee';
$password = '255832600df52c4417d0cfef90098091';
$token = $aes->getEncrypted($username.$password);
$authorization = $aes->getEncrypted($aes->getHeaderPK().'KickDudes');
echo 'Application-Authorization: '.$authorization.'<br>';
echo 'Secret: '.$aes->getHeaderPK().'<br>';
echo 'Token-Key: '.$token.'<br><br>';

$decrypt = $aes->getDecrypted($token);
echo 'Decrypt Key: '.$decrypt;
?>
