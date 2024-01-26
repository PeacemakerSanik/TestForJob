<?php require_once '../functions/connect.php';?>
<?php session_start();?>
<?php
$login=$_POST["login"];
$password=$_POST["password"];
$sql= $pdo->prepare("select id,login from users where login=:login and password=:password");
$sql->execute(array('login' => $login, 'password'=>$password));
$array=$sql->fetch(PDO::FETCH_ASSOC);
if($array["id"]==1){
   $_SESSION['login']=$array["login"];
   header('Location:/admin.php');
}
else if ($array["id"]>1)
{
    $_SESSION['login']=$array["login"];
    header('Location:/user.php');
}
else {
    header('Location:/login.php');
}


