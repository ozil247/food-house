 <?php include('partials/menu.php') ?>

 <div class="main-content">
     <div class="wrapper">
         <h1>Change Password</h1>

         <br>
         <br>

         <?php if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
            ?>

         <form action="update-password-action.php" method="POST">
             <table class="tbl-30">

                 <tr>
                     <td>Current Password</td>
                     <td><input type="password" name="current_password" id="" placeholder="Old Password"></td>
                 </tr>

                 <tr>
                     <td>New Password</td>
                     <td><input type="password" name="new_password" id="" placeholder="New Password"></td>
                 </tr>

                 <tr>
                     <td>Confirm Password</td>
                     <td><input type="password" name="confirm_password" id="" placeholder="Confirm Password"></td>

                 <tr>
                     <td colspan="2">
                         <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                         <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                     </td>
                 </tr>
             </table>

         </form>
     </div>

 </div>


 <?php include('partials/footer.php');?>