<?php include('config.php');?>
<?php include('header.php'); ?>

<div class="logo c"><h1>Project Manager</h1></div>
<form action="ajax.php" method="post" id="addp">
<div class="add-project wrap">
<table><tr>
<td>  <input placeholder="name" type="text" name="project" required /></td>
<td>  <button class="but but-ac" type="submit">+Add</button></td>
</tr></table>  </div>
</form>
<ul class="list list-link" id="project-list">
  <?php
$result = mysql_query("SELECT * FROM project ORDER BY  `project`.`id` DESC");

while($row = mysql_fetch_array($result))
  {
    $sc='';
  $total=mysql_num_rows(mysql_query("SELECT status FROM task WHERE pid=".$row['id']));
  $comp=mysql_num_rows(mysql_query("SELECT status FROM task WHERE pid=".$row['id']." AND status='1'"));
  
  if ($total != '0') {
  if ($total == $comp) {
  $status='Done';
  $sc='done';
  }
  else
  $status=$total-$comp.' left';
  }
  else {
  $status='&nbsp;';
  }
  
  echo '<li><a class="'.$sc.' bl" href="task.php?pid='.$row['id'].'">'.$row['name'].'<span class="status info fr">'.$status.'</span></a></li>';
  }

mysql_close($con);
?>

</ul>
<?php include('footer.php'); ?>
