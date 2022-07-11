<?php require_once 'includes/header.php'; ?>
    <div class="container">
        <h2 class="pt-4">User Update</h2>        
        <?php 
            if($_SERVER['REQUEST_METHOD']== 'GET'){
                header('location:index.php');
            }else{
                $user_id = $_POST['val'];
                $sql     = "SELECT * FROM users WHERE user_id = ?";
                $stmt    = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    die('Failed');
                }else{
                    mysqli_stmt_bind_param($stmt,'i',$user_id);
                    mysqli_stmt_execute($stmt);                    
                    $result = mysqli_stmt_get_result($stmt);
                    if($row = mysqli_fetch_assoc($result)){
                        $user_name     = $row['user_name'];
                        $user_email    = $row['user_email'];
                        $user_password = $row['user_password'];
                    }
                }
            }
        ?>
       <?php 
            if(isset($_POST['update'])){
                $user_name     = trim($_POST['user_name']);
                $user_email    = trim($_POST['user_email']);        
                $user_password = trim($_POST['user_password']);        
                $user_id       = $_POST['val'];        
                if(empty($user_name) || empty($user_email) || empty($user_password)){
                    $error = true;
                }else{
                    $sql  = "UPDATE users SET user_name = ?, user_email = ?, user_password = ? WHERE user_id = ? ";            
                    $stmt = mysqli_stmt_init($conn);                        
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        die("updated fail from Database" . mysqli_connect_error());
                    }else{
                        mysqli_stmt_bind_param($stmt,'sssi',$user_name, $user_email, $user_password, $user_id);
                        mysqli_stmt_execute($stmt);
                        header('location:index.php');
                    }            
                }
            }
        ?>
        <form class="py-2" method="post" action="edit-user.php">
            <?php echo (isset($error) ? "<span style='color:red;'>Field can not be Blank</span>" : ""); ?>
            <div class="form-group">
                <label for="username">Username</label>                
                <input type="hidden" name="val" value="<?= $user_id; ?>">
                <input type="text" name="user_name" class="form-control" id="username" value="<?= $user_name; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="user_email" class="form-control" id="email" value="<?= $user_email; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="user_password"  class="form-control" id="password" value="<?= $user_password; ?>">
            </div>
            <button type="submit" name="update" class="btn btn-success">Update</button>
        </form>        
    </div>
<?php require_once 'includes/footer.php'; ?>
