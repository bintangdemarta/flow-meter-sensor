<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flow_meter_db";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data terbaru dari tabel
$sql = "SELECT current_flow, total_flow, flow_rate_per_meter FROM flow_data ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    $data = array(
        "current_flow" => 0,
        "total_flow" => 0,
        "flow_rate_per_meter" => 0
    );
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
