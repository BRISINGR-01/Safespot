
<?php
  //these are just in case setting headers forcing it to always expire
  header('Cache-Control: no-cache, must-revalidate');

  // this is the workaround for file_get_contents(...)
  //$data = file_get_contents('php://stdin');
  $data = file_get_contents('php://input');

  $a = $_GET['a'];
  $b = $_GET['b'];
  $filename = "files/".$_GET['filename'];

	require_once('connection.php');
	$db=new Connection();
	$con=$db->getConnection();
	$sql="INSERT INTO `team0`.`example` (`id`,`a`,`b`,`file`) VALUES (NULL, :a, :b, :file) ;";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':a', $a, PDO::PARAM_STR);       
        $stmt->bindValue(':b', $b, PDO::PARAM_STR);
        $stmt->bindValue(':file', $filename, PDO::PARAM_STR);
	$stmt->execute();

	echo $a." ".$b." ".$filename;
?>