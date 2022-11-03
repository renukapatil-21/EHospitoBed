<?php
    require "connection.php";
    session_start();
    $req_id = $_POST['req_id'];
    $sql = "update request_bed set status = 'rejected' where req_index = ".$req_id."";
    if ($conn->query($sql) === TRUE) {
		echo "<script>window.location = 'doc_bed_req.php';</script>";
	} else {
		echo "<script> alert('unable to change the status'); </script>";
	}
?>