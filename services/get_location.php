<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

session_start();


header("Content-Type: application/json");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "latitude" => 0,
        "longitude" => 0,
        "status" => 1,
        "error" => ""
    );

    $id_sales = $_POST['id'];

    $sql = "SELECT track_lng, track_lat FROM `sales` WHERE id_sales = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_sales]);
    $user = $stmt->fetch();
    $result["latitude"] = $user['track_lng'];
    $result["longitude"] = $user['track_lat'];

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}
?>