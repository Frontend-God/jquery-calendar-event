<?php 
    $conn = new mysqli('localhost', 'root', '', 'synectx_stapleton');

    if($_POST) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start = date_create($_POST['start']);
        $end = date_create($_POST['end']);
        $allDay = $_POST['allDay'];
        $free = $_POST['free'];
        $color = $_POST['color'];

        $start_date = date_format($start, "Y-m-d H:i:s");
        $end_date = date_format($end, "Y-m-d H:i:s");

        $sql = "UPDATE eventscal SET title='$title', `description`='$description', `start`='$start_date', `end`='$end_date', `allDay`='$allDay', `free`='$free', color='$color' WHERE id='$id'";

        $conn->query($sql);

        echo json_encode(array('success' => true));
    }
?>