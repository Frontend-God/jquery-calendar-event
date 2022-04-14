<?php 
    $conn = new mysqli('localhost', 'root', '', 'synectx_stapleton');

    if($_POST) {
        $id = $_POST['id'];

        $sql = "DELETE FROM eventscal WHERE id='$id'";

        $conn->query($sql);

        echo json_encode(array('success' => true));
    }
?>