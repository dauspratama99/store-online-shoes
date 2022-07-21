<style type="text/css">
<!--
body,td,th {
	color: white;
}
body {
	background-color: blue;
	background-image: url(../images/bg1.jpg);

}
-->
</style><?php
if(! empty($_SESSION['SES_ADMIN'])) {
	echo "<h1 align='center' style='margin:-5px 0px 5px 0px; padding:0px;'>Administrator</h1></p>";
	exit;
}
?>
