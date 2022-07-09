<?php require_once('./includes/header.php'); ?>
<?php 
    if(isset($_POST['addUser'])){
        $user_name     = trim($_POST['user_name']);
        $user_email    = trim($_POST['user_email']);
        $user_password = 'abcd';
        if(empty($user_name) || empty($user_email)){
            $error = true;
        }else{
            $sql      = "INSERT INTO users(user_name, user_email, user_password) values(:name, :email, :password)";
            $stmt     = $pdo->prepare($sql);                
            $stmt->execute([
                ':name'     => $user_name,
                ':email'    => $user_email,                    
                ':password' => $user_password,                    
            ]);
            header("location:index.php");
        }
    }
?>
    <div class="container">        
        <form class="py-4" method="post" action="index.php">
            <div class="row">
                <div class="col">
                    <input type="text" name="user_name" class="form-control" placeholder="Username">
                </div>
                <div class="col">
                    <input type="text" name="user_email" class="form-control" placeholder="Email Address">
                </div>
                <div class="col">
                    <input type="submit" name="addUser" class="form-control btn btn-secondary" value="Add New User">                    
                    <?php echo isset($error) ? "<span style='color:red;'>Field Can't be blank!</span>" : ''; ?>
                </div>
            </div>
        </form>        
        <h2>All Users</h2>
        <table class="table">
            <thead class="thead-dark">                
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>                
              </tr>
            </thead>
            <tbody>
                <?php 
                    $sql  = "SELECT * FROM users";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    while($user     = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $user_id    = $user['id'];
                        $user_name  = $user['user_name'];
                        $user_email = $user['user_email']; ?>                                        
              <tr>
                <th><?= $user_id ?></th>
                <th><?= $user_name ?></th>
                <th><?= $user_email ?></th>                
                <td>
                    <form method="post" action="edit-user.php">
                        <input type="hidden" name="val" value="<?php echo $user_id; ?>">
                        <input type="submit" name="update" value="Edit" class="btn btn-success btn-sm">
                    </form>                    
                    <form method="post" action="index.php">
                        <input type="hidden" name="val" value="<?php echo $user_id; ?>">
                        <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm">
                    </form>                    
                </td>                            
              </tr>              
              <?php  } ?>
            </tbody>
        </table>
        <?php 
            if(isset($_POST['delete'])){
                $id   = $_POST['val'];
                $sql  = "DELETE FROM users where id = :id";
                $stmt = $pdo->prepare($sql);                
                $stmt->execute([
                    ':id' => $id        
                ]);
                header('location:index.php');
            }            
        ?>
    </div>
<?php require_once('./includes/footer.php'); ?>
