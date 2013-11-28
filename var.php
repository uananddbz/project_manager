<?php
function runsql($a,$ret) {
if (!mysql_query($a))
  {
  die('Error: ' . mysql_error());
  }
return $ret;
}


?>