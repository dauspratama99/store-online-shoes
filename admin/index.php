<?php
session_start();
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
?>

<html>
<head>
<link rel="shortcut icon" href="../images/ic.png">
<title>YOTHLAND STORE</title>
<link href="../style/button.css" rel="stylesheet" type="text/css">
<link href="../style/style_admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css" />
<script type="text/javascript" src="../plugins/tigra_calendar/tcal.js"></script> 
<script language="javascript" type="text/javascript" src="../plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>
</head>
<div id="wrap">
<body>
<table width="100%"  class="table-main" >
  <tr>
    <td height="110%" colspan="2" align="center"><a href="?open=Login"><img src="../images/isan21.jpg" width="100%" height="300"></a></td>
  </tr>
  <tr valign="top">
    <td width="10%"  style="border-right:5px solid #000000;"><div style="margin:20px; padding:20px;"><?php include "menu.php";?></div></td>
    <td width="150%" height="100" bgcolor=""><div style="margin:3px; padding:3px;"><?php include "buka_file.php";?></div></td>
  </tr>
</table>
</body>
</div>
</html>

