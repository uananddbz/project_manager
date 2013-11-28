<?php include('config.php');?>
<?php include('header.php'); ?>
<?php
//confirm that pid is set
if (isset($_GET['pid'])) {
$pid=$_GET['pid'];
$result = mysql_query("SELECT * FROM project WHERE id='$pid'");
if (mysql_num_rows($result) < 1)
  {
  die('<h1><a href="index.php">back</a> project not found</h1>');
  }
while($row = mysql_fetch_array($result))
  {
  $project=$row['name'];
  }
   $task = mysql_query("SELECT * FROM task WHERE pid='$pid' AND status='0' ORDER BY `id` DESC"); 
   $done=mysql_query("SELECT * FROM task WHERE pid='$pid' AND status='1' ORDER BY `id` DESC");
   $comp=mysql_num_rows($done);
   $total=mysql_num_rows($task)+$comp;
}
else
  die('Error');
?>
<div class="logo c"><h1>Project Manager</h1></div>
<div class="header wrap">

<h2 class="il fl"><?=$project;?></h2>
<a class="but but-ac fl af" href="#">+ ADD</a><a class="but fl" href="index.php">< back</a>
<img src="loading.gif" class="fl" id="loading" alt="loading" />
</div>



<div class="grid">

<div class="a">
<div class="del c">Delete</div>
    <form action="ajax.php" method="post" id="addt">
      <input type="hidden" name="pid" value="<?=$pid?>" />
	    <div class="add-task">
	  <table class="form">
<tr><td><input placeholder="Task Name" type="text" name="task" required/></td><td><button type="submit">+ ADD</button></td></tr></table>
<div class="cont"><select name="pr">
<option value="h">+1</option>
<option value="n" selected="selected">0</option>
<option value="l">-1</option>
</select>
<a href="#" id="ad">+add description</a></div>
<div class="cont" id="d"><textarea name="des" rows="4" placeholder="task description"></textarea></div></div>
    </form>

<ol class="list list-hover" id="task-list">
  <?php
while($row = mysql_fetch_array($task))
  { 
  
switch ($row['pr'])
{
case 'l':
  $prc="l";
  break;
case 'n':
  $prc="n";
  break;
case 'h':
  $prc="h";
  break;
}
   
  echo '<li data-id="'.$row['id'].'"><small class="pr fl '.$prc.'">&nbsp;</small><a href="#" class="name">'.$row['name'].'</a><a href="#" class="fr but task_done"><small>Done</small></a><p class="des"><small>'.$row['des'].'</small></p></li>';
  }
?>
</ol></div>

<div class="b">
<div class="all-done">
<h3>All Done</h3><hr/>
<ul class="list" id="done-list">
  <?php
while($row = mysql_fetch_array($done))
  {   
  echo '<li data-id="'.$row['id'].'"><a href="#" class="fl name">'.$row['name'].'</a><br/><p class="des"><small>'.$row['des'].'</small></p></li>';
  }

mysql_close($con);
?>
</ul>
</div>

</div>
<?php include('footer.php'); ?>
