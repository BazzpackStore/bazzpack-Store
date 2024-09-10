<?php
session_start();
unset($_SESSION['username']);
?>
<script>
location.replace('index.php');
</script>