<?php

///////////// redirects to index //////////////

/* ========== header ========= */

include ("header.php");

unset($_SESSION['loggued_on_user']);
echo '<script type="text/javascript">';
    echo  'removeAllFromCart();';
    echo   '</script>';
?>
<script> removeAllFromCart(); </script>
<?php
//header("Location: http://localhost:". $_SERVER['SERVER_PORT'] . "/index.php");
//die();
?>