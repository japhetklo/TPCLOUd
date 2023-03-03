<?php
if (isset($_SESSION['idAdmin'])) {
}else{
	header('location:login');
}
?>