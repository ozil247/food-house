<?php include 'partials/menu.php' ?>

<style>
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        margin-bottom: 20px;
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }

    .styled-table th,
    .styled-table td {
        padding: 16px 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        white-space: nowrap;
    }

    .styled-table th {
        background-color: #f5f5f5;
        font-weight: 600;
    }

    .styled-table tr:hover {
        background-color: #f9f9f9;
    }

    .btn-secondary {
        padding: 6px 12px;
        background-color: green;
        color: white;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-secondary:hover {
        background-color: green;
    }

    .error {
        color: red;
        text-align: center;
    }

    .success {
        color: green;
        text-align: center;
    }

    .main-content {
        padding: 20px;
    }

    .wrapper {
        max-width: 100%;
        margin: 0 auto;
    }
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Orders</h1>
        <br><br>

        <div class="table-responsive">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        $sn = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id               = $row['id'];
                            $food             = htmlspecialchars($row['food']);
                            $price            = $row['price'];
                            $qty              = $row['qty'];
                            $total            = $row['total'];
                            $order_date       = $row['order_date'];
                            $status           = ucfirst($row['status']);
                            $customer_name    = htmlspecialchars($row['customer_name']);
                            $customer_contact = htmlspecialchars($row['customer_contact']);
                            $customer_email   = htmlspecialchars($row['customer_email']);
                            $customer_address = htmlspecialchars($row['customer_address']);
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo "₦" . number_format($price, 2); ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo "₦" . number_format($total, 2); ?></td>
                                <td><?php echo date("d-m-Y H:i:s", strtotime($order_date)); ?></td>
                                <td><?php echo $status; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td><a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='12' class='error'>No orders found.</td></tr>";
                    }

                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'partials/footer.php' ?>
