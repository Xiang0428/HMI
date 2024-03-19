<?php
// 檢查是否設置商品 ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // 獲取商品 ID
    $product_id = $_GET['id'];

    include "connect.php";

    // 刪除商品資料的 SQL 語句
    $sql = "DELETE FROM product WHERE P_id = $product_id";

    // 執行 SQL 語句
    if ($conn->query($sql) === TRUE) {
        // 刪除成功，重新導向回商品列表頁面並顯示警告框
        echo "<script>alert('商品已成功刪除'); window.location.href = 'productList.php';</script>";
    } else {
        // 刪除失敗，重新導向回商品列表頁面並顯示警告框
        echo "<script>alert('刪除商品失敗: " . $conn->error . "'); window.location.href = 'productList.php';</script>";
    }

    // 關閉資料庫連接
    $conn->close();
} else {
    // 如果沒有設置商品 ID，則導向回商品列表頁面
    header("Location: productList.php");
    exit;
}
