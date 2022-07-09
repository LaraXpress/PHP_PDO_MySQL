<?php require_once('./includes/header.php'); ?>
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        header('location:index.php');
    }else{
        $id   = $_POST['val'];
        $sql  = "SELECT * FROM users where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,            
        ]);
        if($user = $stmt->fetch(PDO::FETCH_ASSOC)){
            $user_id       = $user['id'];
            $user_name     = $user['user_name'];
            $user_email    = $user['user_email'];
            $user_password = $user['user_password'];
        }
    }
?>
    <div class="container">
        <h2 class="pt-4">User Update</h2>        
        <?php 
            if(isset($_POST['edit'])){
                $user_id       = $_POST['update_id'];
                $user_name     = $_POST['user_name'];
                $user_email    = $_POST['user_email'];
                $user_password = $_POST['user_password'];
                if(empty($user_name) || empty($user_email) || empty($user_password)){
                    echo "<span style='color:red;'>Field Can't be blank!</span>";
                }else{
                    $sql  = "UPDATE users SET user_name = :name, user_email = :email, user_password = :password where id = :id";
                    $stmt     = $pdo->prepare($sql);                
                    $stmt->execute([
                        ':id'       => $user_id,
                        ':name'     => $user_name,
                        ':email'    => $user_email,                    
                        ':password' => $user_password,                    
                    ]);
                    header("location:index.php");
                }                
            }
        ?>
        <form class="py-2" autocomplete="off" method="post" action="edit-user.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="user_name" class="form-control" value ="<?php echo $user_name; ?>">
                <input type="hidden" name="update_id" value="<?php echo $user_id; ?>"> 
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="user_email" class="form-control" id="email" value ="<?php echo $user_email; ?>">
            </div>            
            <div class="form-group">
                <label for="email">Password</label>
                <input type="password" name="user_password" class="form-control" id="email" value ="<?php echo $user_password; ?>">
            </div> 
            <button type="submit" name="edit" class="btn btn-primary">Update</button>            
        </form>                           
    </div>

<?php require_once('./includes/footer.php'); ?>
