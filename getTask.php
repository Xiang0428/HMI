<?php session_start();
include 'connect.php';

// url取得ID
if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];
    $sheet = $_GET['sheet'];


    $sql = "SELECT * FROM $sheet WHERE P_id = $productID";

    // 執行查询
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 結果轉為array
        while ($row = mysqli_fetch_assoc($result)) {
            // 每跑一次迴圈就抓一筆值，最後放進data陣列中
            $datas[] = $row;
        
        }

        echo json_encode($datas);    
    } else {
        // 如果未找到匹配的记录，则返回空数组
        echo json_encode(array());
    }
} else {
    // 如果未提供产品ID，则返回空数组
    echo json_encode(array());
}

// 关闭数据库连接
$conn->close();
