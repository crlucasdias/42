<!-- ========== always stuff ========= -->

<?php
/* ========== header ========= */

include ("header.php");
include ("functions.php");
include ("constants.php");
?>

<!---------- extra ---------->
</div>
<center>
<div class="message">
Welcome to store.com<br>
We sell yellow things, pointy things, and edible things.

<?php
	getItensByCat(CATEGORIES);
?>
</div>
</center>

</body></html>