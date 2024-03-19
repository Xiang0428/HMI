<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品列表</title>
    <!-- 引入Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">商品管理介面</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">商品列表</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="insertProductData.php">新增料號</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>商品列表</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>料號</th>
                    <th>品名規格</th>
                    <th>出貨日</th>
                    <th>批量</th>
                    <th>批量串數</th>

                    <th>手臂要沾的層數</th>
                    <th>乾燥時間</th>
                    <th>砂種類</th>
                    <th>預濕</th>
                    <th>封漿</th>
                </tr>
            </thead>
            <tbody>
                <!-- 連接資料庫 -->
                <?php
                include 'connect.php';

                // 從資料庫中取得商品資料
                $sql = "SELECT * FROM product";
                $products = $conn->query($sql);

                foreach ($products as $product) {

                    echo "<tr>";
                    echo "<td>" . $product['P_name'] . "</td>";
                    echo "<td>" . $product['P_description'] . "</td>";
                    echo "<td>" . $product['ship_date'] . "</td>";
                    echo "<td>" . $product['batch_quantity'] . "</td>";
                    echo "<td>" . $product['batch_serial_number'] . "</td>";
                    //    echo "<td>" . $product['T_tag'] . "</td>";
                    echo "<td>" . $product['layer_arm_dipping'] . "</td>";
                    echo "<td>" . $product['drying_time'] . "</td>";
                    echo "<td>" . $product['sand_type'] . "</td>";
                    echo "<td>" . $product['pre_wetting'] . "</td>";
                    echo "<td>" . $product['sizing'] . "</td>";
                    echo '<td>
                            <!-- 修改按鈕，觸發 JavaScript 函數 -->
                            <button type="button" class="btn btn-primary" onclick="openUpdateModal(' . $product['P_id'] . ')">编辑</button>    
                            <button type="button" class="btn btn-success" onclick="openDetailProductModal(' . $product['P_id'] . ')">詳細資料</button>                  
                            <button type="button"  class="btn btn-danger" onclick="confirmDelete(' . $product['P_id'] . ')">刪除</button> </td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- updateProductModal -->
    <div class="modal fade" id="updateProductModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateProductModal">編輯列表</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="edit_id_number" name="edit_id_number" required />
                        </div>
                        <div class="mb-3">
                            <label for="edit_P_name" class="form-label">料號:</label>
                            <input type="text" class="form-control" id="edit_P_name" name="edit_P_name" required />
                        </div>
                        <div class="mb-3">
                            <label for="edit_P_description" class="form-label">品名規格:</label>
                            <input type="text" class="form-control" id="edit_P_description" name="edit_P_description" required />
                        </div>
                        <div class="mb-3">
                            <label for="edit_ship_date" class="form-label">出貨日:</label>
                            <input type="date" class="form-control" id="edit_ship_date" name="edit_ship_date" required />
                        </div>
                        <div class="mb-3">
                            <label for="edit_batch_quantity" class="form-label">批量(訂單個總數):</label>
                            <input type="number" class="form-control" id="edit_batch_quantity" name="edit_batch_quantity" required />
                        </div>
                        <div class="mb-3">
                            <label for="edit_batch_serial_number" class="form-label">批量串數:</label>
                            <input type="number" class="form-control" id="edit_batch_serial_number" name="edit_batch_serial_number" required />
                        </div>
                        <div class="mb-3">
                            <label for="edit_layer_arm_dipping" class="form-label">手臂要沾的層數:</label>
                            <input type="number" class="form-control" id="edit_layer_arm_dipping" name="edit_layer_arm_dipping" required />
                        </div>
                        <div class="mb-3">
                            <label for="edit_drying_time" class="form-label">乾燥時間:</label>
                            <select class="form-select" id="edit_drying_time" name="edit_drying_time" required>
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
                            <label for="edit_sand_type" class="form-label">砂糖種類:</label>
                            <select class="form-select" id="edit_sand_type" name="edit_sand_type" required>
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
                            <input type="checkbox" class="form-check-input" id="edit_pre_wetting" name="edit_pre_wetting" />
                            <label class="form-check-label" for="pre_wetting">預濕</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="edit_sizing" name="edit_sizing" />
                            <label class="form-check-label" for="edit_sizing">封漿</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" onclick="updateProduct()" class="btn btn-primary">修改</button>
                </div>
            </div>
        </div>
    </div>

    <!-- detailProductModal -->
    <div class="modal fade" id="detailProductModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailProductModal">詳細資料</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="tableContainer">
                    <!-- Table content will be dynamically added here -->
                </div>
                <p>剩餘綁定數量:</p>

            </div>
        </div>
    </div>



</body>
<script>
    //刪除功能
    function confirmDelete(productId) {
        if (confirm("確定要刪除此商品嗎？")) {
            // 如果用戶確認要刪除，則導向到 deleteProduct.php 並帶上商品 ID
            window.location.href = "deleteProduct.php?id=" + productId;
        }
    }

    //編輯modal
    function openUpdateModal(productID) {
        // 發送ajax請求資料
        $.ajax({
            url: 'getProduct.php',
            method: 'GET',
            data: {
                productID: productID,
                sheet: 'product'
            },
            success: function(response) {
          
                $('#edit_id_number').val(productID);
                $('#edit_P_name').val(response.P_name);
                $('#edit_P_description').val(response.P_description);
                $('#edit_ship_date').val(response.ship_date);
                $('#edit_batch_quantity').val(response.batch_quantity);
                $('#edit_batch_serial_number').val(response.batch_serial_number);
                $('#edit_layer_arm_dipping').val(response.layer_arm_dipping);
                $('#edit_drying_time').val(response.drying_time);
                $('#edit_sand_type').val(response.sand_type);
                if (response.pre_wetting == 1) {
                    $('#edit_pre_wetting').prop('checked', true);
                } else {
                    $('#edit_pre_wetting').prop('checked', false);
                }

                if (response.sizing == 1) {
                    $('#edit_sizing').prop('checked', true);
                } else {
                    $('#edit_sizing').prop('checked', false);
                }

                $('#updateProductModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        // 打開 Modal
        var updateProductModal = new bootstrap.Modal(document.getElementById('updateProductModal'));
        updateProductModal.show();
    }

    //詳細資料modal
    function openDetailProductModal(productID) {
        // 發送ajax請求資料
        // 發送ajax請求資料
        $.ajax({
            url: 'getTask.php',
            method: 'GET',
            data: {
                sheet: 'task',
                productID: productID
            },
            success: function(response) {
                console.log(response);

               var data=JSON.parse(response);
                
                // 動態生成表格
                var tableHtml = '<table class="table">';
                tableHtml += '<thead><tr><th>RFID編號</th><th>站台名稱</th><th>站台時間</th></tr></thead>';
                tableHtml += '<tbody>';

                data.forEach(function(item) {
                    
                    tableHtml += '<tr><td>' + item.T_tag + '</td><td>' + item.W_name + '</td><td>' + item.W_time + '</td></tr>';
                });

                tableHtml += '</tbody></table>';

                $('#tableContainer').html(tableHtml); // 將生成的表格插入到 Modal 中

                $('#detailProductModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
        // 打開 Modal
        var detailProductModal = new bootstrap.Modal(document.getElementById('detailProductModal'));
        detailProductModal.show();
    }

    //更新編輯modal資料
    function updateProduct() {
        // 获取用户输入的值
        var productID = $('#edit_id_number').val();
        var P_name = $('#edit_P_name').val();
        var P_description = $('#edit_P_description').val();
        var ship_date = $('#edit_ship_date').val();
        var batch_quantity = $('#edit_batch_quantity').val();
        var batch_serial_number = $('#edit_batch_serial_number').val();
        var layer_arm_dipping = $('#edit_layer_arm_dipping').val();
        var drying_time = $('#edit_drying_time').val();
        var sand_type = $('#edit_sand_type').val();
        var pre_wetting = $('#edit_pre_wetting').prop('checked') ? 1 : 0;
        var sizing = $('#edit_sizing').prop('checked') ? 1 : 0;

        // 发送AJAX请求以更新产品信息
        $.ajax({
            url: 'updateProduct.php',
            method: 'POST',
            data: {
                productID: productID,
                P_name: P_name,
                P_description: P_description,
                ship_date: ship_date,
                batch_quantity: batch_quantity,
                batch_serial_number: batch_serial_number,
                layer_arm_dipping: layer_arm_dipping,
                drying_time: drying_time,
                sand_type: sand_type,
                pre_wetting: pre_wetting,
                sizing: sizing,

            },
            success: function(response) {
                console.log('Product updated successfully');
                alert("編輯成功")
                window.location.href = 'productList.php'
            },
            error: function(xhr, status, error) {
                console.error('Error updating product:', xhr.responseText);
            }
        });
    }
</script>


</html>