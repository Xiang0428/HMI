<?php

// 在這裡執行資料庫更新操作
$servername = "localhost"; // 資料庫伺服器位置
$username = "AI_User"; // 資料庫使用者名稱
$password = "NFU0401!"; // 資料庫密碼
$database = "test"; // 資料庫名稱

// 建立連接
$conn = new mysqli($servername, $username, $password, $database);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接資料庫失敗：" . $conn->connect_error);
}
