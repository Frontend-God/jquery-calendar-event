<?php 
    $conn = new mysqli('localhost', 'root', '', 'synectx_stapleton');

    $sql = 'SELECT * FROM eventscal';
    $result = $conn->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);

    for($i = 0; $i < count($data); $i ++) {
        $data[$i]['start'] = date_format(date_create($data[$i]['start']), 'Y-m-d') . 'T' .date_format(date_create($data[$i]['start']), 'H:m');
        $data[$i]['end'] = date_format(date_create($data[$i]['end']), 'Y-m-d') . 'T' .date_format(date_create($data[$i]['end']), 'H:m');
    }

    echo json_encode($data);
?>