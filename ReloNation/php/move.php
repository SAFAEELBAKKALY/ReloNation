<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['data'])) {
        $data = json_decode($_POST['data'], true);

        if (isset($data['date'], $data['email'], $data['name'], $data['phone'], $data['type'])) {
            $type = $data['type'];
            $from = $to = $city = null;

            if ($type == 'moving') {
                if (!isset($data['from']) || !isset($data['to']) || empty($data['from']) || empty($data['to'])) {
                    echo json_encode(['status' => 'error', 'message' => 'Please fill out "from" and "to" fields for moving']);
                    exit;
                } else {
                    $from = $data['from'];
                    $to = $data['to'];
                }
            } elseif ($type == 'cleaning') {
                if (!isset($data['city']) || empty($data['city'])) {
                    echo json_encode(['status' => 'error', 'message' => 'Please fill out "city" field for cleaning']);
                    exit;
                } else {
                    $city = $data['city'];
                }
            }

            if (isset($_FILES['videoUpload']) && $_FILES['videoUpload']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = '../vedios/';
                $uploadFile = $uploadDir . basename($_FILES['videoUpload']['name']);

                if (move_uploaded_file($_FILES['videoUpload']['tmp_name'], $uploadFile)) {
                    include_once("connection.php");

                    $name = $data['name'];
                    $email = $data['email'];
                    $phone = $data['phone'];
                    $date = $data['date'];
                    $video = $_FILES['videoUpload']['name'];

                    $stm = $db->prepare("INSERT INTO `demande` (`status`, `FullName`, `Email`, `PhoneNumber`, `Date`, `video`, `DepartureCity`, `CityOfArrival`, `City`, `Service`)
                                            VALUES (:status, :name, :email, :phone, :date, :video, :from, :to, :city, :type)");

                    $stm->execute([
                        ':status' => 0,
                        ':name' => $name,
                        ':email' => $email,
                        ':phone' => $phone,
                        ':date' => $date,
                        ':video' => $video,
                        ':from' => $from,
                        ':to' => $to,
                        ':city' => $city,
                        ':type' => $type,
                    ]);

                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to upload video file']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Please upload a video']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Please fill out all required inputs']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data received']);
    }
}
?>
