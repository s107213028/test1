<?php
session_start();
require("dbconnect.php");
//未完成的status = 0
if (isset($_GET['m'])) {
  $text = $_GET['m'];
  $msg = "<font color = 'red' font size = 30px>$text</font>";
}
else {
  $msg = "GOOD MORNING";
}
//$msg = $_GET['m'];
// $sql = "select count(*) as c from todo where status = 1;";
$sql = "select * from todo order by status;";
//執行成功做result 失敗die
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
//echo "count(*)={$rs['c']};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>

<p>老闆頁面 </p>
<hr />
<?php  echo $msg?> <hr />
<table width="200" border="1">
  <tr>
    <td>id</td>
    <td>title</td>
    <td>content</td>
    <td>principle</td>
    <td>status</td>
    <td>degree</td>
  </tr>
<?php
$sql = "select * from todo where status = 1 order by case degree when '緊急' then 1 when '重要' then 2 when '一般' then 3 end asc ";
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
$line = 0;
while (	$rs=mysqli_fetch_assoc($result)) {
  
	echo "<tr><td>" . $rs['id'] . "</td>";
	echo "<td>{$rs['title']}</td>";
  echo "<td>" , $rs['content'], "</td>";
  echo "<td>" , $rs['principle'], "</td>";
  echo "<td>" . $rs['status'] ,"</td>";
  if ($rs['degree']=='緊急')
    echo "<td><font color='red'>" . $rs['degree'] ,"</font></td>";
  else if($rs['degree']=='重要')
    echo "<td><font color='orange'>" . $rs['degree'] ,"</font></td>";
  else
    echo "<td><font color='yellow'>" . $rs['degree'] ,"</font></td>";
  //echo "<td>" ."<a href='updateMessageForm.php?id={$rs['id']}'>Update</a>". "</td>";
  echo "<td>" ."<a href='todocheck.php?id={$rs['id']}'>Return</a>". "</td>";
  echo "<td>" ."<a href='CancelForm.php?id={$rs['id']}'>OK</a>". "</td>";
  $line += 1;
}
?>
<?php 
echo "已完成".$line. "項" ;
?>
<table width="200" border="1">
  <tr>
    <td>id</td>
    <td>title</td>
    <td>content</td>
    <td>principle</td>
    <td>status</td>
    <td>degree</td>
  </tr><hr>
<?php

$sql = "select * from todo where status = 0  order by case degree when '緊急' then 1 when '重要' then 2 when '一般' then 3 end asc";
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
while (	$rs=mysqli_fetch_assoc($result)) {
	echo "<tr><td>" . $rs['id'] . "</td>";
	echo "<td>{$rs['title']}</td>";
  echo "<td>" , $rs['content'], "</td>";
  echo "<td>" , $rs['principle'], "</td>";
  echo "<td>" . $rs['status'] ,"</td>";
  if ($rs['degree']=='緊急'){
    echo "<td><font color='red'>" . $rs['degree'] ,"</font></td>";
  }
  else if($rs['degree']=='重要')
    echo "<td><font color='orange'>" . $rs['degree'] ,"</font></td>";
  else
    echo "<td><font color='yellow'>" . $rs['degree'] ,"</font></td>";
  echo "<td>" ."<a href='updateMessageForm.php?id={$rs['id']}'>Update</a>". "</td>";
  echo "<td>" ."<a href='CancelForm.php?id={$rs['id']}'>Cancel</a>". "</td>";
}
?>
</table>
<a href="first.php">Back</a>  
<a href="addMessageForm.php">Add task</a>
</body>
</html>
