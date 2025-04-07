<?php

$data = array("features" => [1.2, 3.4, 5.6]);
$data_json = json_encode($data);

// Khởi tạo cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://f5d1-35-203-179-202.ngrok-free.app/predict");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_json))
);

$response = curl_exec($ch);

// Kiểm tra lỗi cURL
if(curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    $response_data = json_decode($response, true);
    if (isset($response_data['prediction'])) {
        echo "Dự đoán: " . $response_data['prediction'][0][0];
    } else {
        echo "Lỗi: Không nhận được dữ liệu dự đoán từ server.";
    }
}

curl_close($ch);
?>
