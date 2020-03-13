
<?php
/* ========== header ========= */

include ("header.php");
include ("functions.php");

?>

<!-- ========== items ========= -->

<div class="shop">
<?php
if(isset($_GET['category']))
{
	$category = $_GET['category'];
	getItensByCat(array($category));
}
?>
</div>
</body></html>
