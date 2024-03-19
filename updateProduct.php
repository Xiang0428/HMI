<?php
include 'connect.php'; // 包含您的数据库连接代码

// 检查是否提供了必要的数据
if (isset($_POST['productID']) && isset($_POST['P_name']) && isset($_POST['P_description']) && isset($_POST['ship_date']) && isset($_POST['batch_quantity']) && isset($_POST['batch_serial_number'])  && isset($_POST['layer_arm_dipping']) && isset($_POST['drying_time']) && isset($_POST['sand_type']) && isset($_POST['pre_wetting']) && isset($_POST['sizing'])) {
    // 获取POST请求中的数据
    $productID = $_POST['productID'];
    $P_name = $_POST['P_name'];
    $P_description = $_POST['P_description'];
    $ship_date = $_POST['ship_date'];
    $batch_quantity = $_POST['batch_quantity'];
    $batch_serial_number = $_POST['batch_serial_number'];
    $layer_arm_dipping = $_POST['layer_arm_dipping'];
    $drying_time = $_POST['drying_time'];
    $sand_type = $_POST['sand_type'];
    $pre_wetting = $_POST['pre_wetting'];
    $sizing = $_POST['sizing'];

    // 准备更新数据库的SQL语句
    $sql = "UPDATE product SET 
            P_name = '$P_name', 
            P_description = '$P_description', 
            ship_date = '$ship_date', 
            batch_quantity = '$batch_quantity', 
            batch_serial_number = '$batch_serial_number', 
            layer_arm_dipping = '$layer_arm_dipping', 
            drying_time = '$drying_time', 
            sand_type = '$sand_type', 
            pre_wetting = '$pre_wetting', 
            sizing = '$sizing' 
            WHERE P_id = $productID";

    // 执行更新操作
    if ($conn->query($sql) === TRUE) {
        // 更新成功
        echo "<script>alert('商品已修改成功'); window.location.href = 'productList.php';</script>";
    } else {
        // 更新失败
        echo "<script>alert('商品修改失敗');" . $conn->error;
    }
} else {
    // 如果未提供必要的数据，返回错误消息
    echo " 遺失資料";
}

// 关闭数据库连接
$conn->close();
