<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- 引入Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">商品管理介面</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="productList.php">商品列表</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="insertProductData.php">新增料號</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>新增料號資訊表單</h2>
        <form method="post" action="insertProductData.php">
            <div class="mb-3">
                <label for="P_name" class="form-label">料號:</label>
                <input type="text" class="form-control" id="P_name" name="P_name" required />
            </div>
            <div class="mb-3">
                <label for="P_description" class="form-label">品名規格:</label>
                <input type="text" class="form-control" id="P_description" name="P_description" required />
            </div>
            <div class="mb-3">
                <label for="ship_date" class="form-label">出貨日:</label>
                <input type="date" class="form-control" id="ship_date" name="ship_date" required />
            </div>
            <div class="mb-3">
                <label for="batch_quantity" class="form-label">批量(訂單個總數):</label>
                <input type="number" class="form-control" id="batch_quantity" name="batch_quantity" required />
            </div>
            <div class="mb-3">
                <label for="batch_serial_number" class="form-label">批量串數:</label>
                <input type="number" class="form-control" id="batch_serial_number" name="batch_serial_number" required />
            </div>

            <div class="mb-3">
                <label for="layer_arm_dipping" class="form-label">手臂要沾的層數:</label>
                <input type="number" class="form-control" id="layer_arm_dipping" name="layer_arm_dipping" required />
            </div>
            <div class="mb-3">
                <label for="drying_time" class="form-label">乾燥時間:</label>
                <select class="form-select" id="drying_time" name="drying_time" required>
                    <option value="2">2 小時</option>
                    <option value="4">4 小時</option>
                    <option value="8">8 小時</option>
                    <option value="12">12 小時</option>
                    <option value="16">16 小時</option>
                    <option value="20">20 小時</option>
                    <option value="24">24 小時</option>
                    <option value="28">28 小時</option>
                    <option value="32">32 小時</option>
                    <option value="36">36 小時</option>
                    <option value="40">40 小時</option>
                    <option value="44">44 小時</option>
                    <option value="48">48 小時</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="sand_type" class="form-label">砂種類:</label>
                <select class="form-select" id="sand_type" name="sand_type" required>
                    <option value="鋯砂">鋯砂</option>
                    <option value="60">60</option>
                    <option value="35">35</option>
                    <option value="22">22</option>
                    <option value="35/22">35/22</option>
                    <option value="石英60">石英60</option>
                    <option value="石英35">石英35</option>
                    <option value="石英22">石英22</option>
                    <option value="鋯砂/灌漿砂">鋯砂/灌漿砂</option>
                    <option value="60/灌漿砂">60/灌漿砂</option>
                    <option value="35/灌漿砂">35/灌漿砂</option>
                    <option value="22/灌漿砂">22/灌漿砂</option>
                    <option value="35/22/灌漿砂">35/22/灌漿砂</option>
                    <option value="石英60/灌漿砂">石英60/灌漿砂</option>
                    <option value="石英60/灌漿砂">石英35/灌漿砂</option>
                    <option value="石英22/灌漿砂">石英22/灌漿砂</option>
                </select>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="pre_wetting" name="pre_wetting" />
                <label class="form-check-label" for="pre_wetting">預濕</label>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="sizing" name="sizing" />
                <label class="form-check-label" for="sizing">封漿</label>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </form>
    </div>


    <?php
    include "connect.php";

    // 檢查是否有 POST 請求
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 從表單獲取資料
        $P_name = $_POST["P_name"];
        $P_description = $_POST["P_description"];
        $ship_date = $_POST["ship_date"];
        $batch_quantity = $_POST["batch_quantity"];
        $batch_serial_number = $_POST["batch_serial_number"];
        $layer_arm_dipping = $_POST["layer_arm_dipping"];
        $drying_time = $_POST["drying_time"];
        $sand_type = $_POST["sand_type"];
        $pre_wetting = isset($_POST["pre_wetting"]) ? 1 : 0; // 如果有勾選預濕，設為 1，否則設為 0
        $sizing = isset($_POST["sizing"]) ? 1 : 0; // 如果有勾選封漿，設為 1，否則設為 0

        // 準備 SQL 指令
        $sql = "INSERT INTO product (P_name, P_description, ship_date, batch_quantity, batch_serial_number, layer_arm_dipping, drying_time, sand_type, pre_wetting, sizing) 
        VALUES ('$P_name', '$P_description', '$ship_date', $batch_quantity, $batch_serial_number, $layer_arm_dipping, $drying_time, '$sand_type', $pre_wetting, $sizing)";

        // 執行 SQL 指令
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("新紀錄已成功插入"); window.location.href = "productList.php";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // 關閉資料庫連線
    $conn->close(); ?>

</body>

</html>