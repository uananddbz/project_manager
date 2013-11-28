<?php include('config.php'); ?>
<?php include('var.php'); ?>
<?php
  date_default_timezone_set("Asia/Kolkata");
  $t=date("Y-m-d H:i:s",time());
  
if (isset($_GET['done'])) {

$id=$_GET['done'];
$sql="UPDATE task SET done = '$t', status = '1' WHERE id = '$id'";
echo runsql($sql,"task set done");
}

elseif (isset($_GET['del'])) {

$id=$_GET['del'];
$sql="DELETE FROM `test`.`task` WHERE `task`.`id` = '$id';";
echo runsql($sql,"task deleted");
}

elseif (isset($_GET['ndone'])) {

$id=$_GET['ndone'];
$sql="UPDATE task SET done = '$t', status = '0' WHERE id = '$id'";
echo runsql($sql,"task set not done");
}

elseif (isset($_POST['task'])) {
$name=$_POST['task'];
$pid=$_POST['pid'];
$pr=$_POST['pr'];
$des=$_POST['des'];
$sql="INSERT INTO task (name,pid,pr,des) VALUES ('$name','$pid','$pr','$des')";
if (!mysql_query($sql))
  {
  die('Error: ' . mysql_error());
  }
$result =mysql_query("SELECT * FROM `task` WHERE `name` = '$name' ORDER BY `id` DESC LIMIT 0 , 1");
while($row = mysql_fetch_array($result))
  {
echo $row['id'];
  }

}


elseif (isset($_POST['project'])) {
$name=$_POST['project'];
$sql="INSERT INTO project (name,start) VALUES ('$name','$t')";
if (!mysql_query($sql))
  {
  die('Error: ' . mysql_error());
  }
$result =mysql_query("SELECT * FROM `project` WHERE `name` = '$name' ORDER BY `id` DESC LIMIT 0 , 1");
while($row = mysql_fetch_array($result))
  {
echo $row['id'];
  }


}

?>