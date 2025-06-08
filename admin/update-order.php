<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>update Order</h1>
        <br><br>
        
        <form action="process-update-order.php" method="POST">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        $row = mysqli_fetch_assoc($res);
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                    } else {
                        header('location:' . SITEURL . 'admin/manage-order.php');
                    }
                }
            } else {
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
            ?>

            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><?php echo $food; ?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><?php echo $price; ?></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td><?php echo $qty; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><?php echo $total; ?></td>
                </tr>
                <tr>
                    <td>Order Date</td>
                    <td><?php echo $order_date; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Ordered") { echo "selected"; } ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == "On Delivery") { echo "selected"; } ?> value="On Delivery">On Delivery</option>
                            <option <?php if ($status == "Delivered") { echo "selected"; } ?> value="Delivered">Delivered</option>
                            <option <?php if ($status == "Cancelled") { echo "selected"; } ?> value="Cancelled">Cancelled</option>
                        </select>           

                    </td>
                </tr>
                <tr></tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>" required> 
                    </td>           
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>" required> 
                    </td>   

                </tr>
                <tr></tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="email" name="customer_email" value="<?php echo $customer_email; ?>" required> 
                    </td>        
                </tr>   
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5" required><?php echo $customer_address; ?></textarea>
                    </td>   
                </tr>
                <tr></tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>        
            
        </form>

    </div>
</div>


<?php include('partials/footer.php') ?>