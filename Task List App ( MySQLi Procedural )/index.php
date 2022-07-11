<?php require_once 'includes/header.php'; ?>
<?php 
    if(isset($_POST['submit'])){
        $user_name     = trim($_POST['user_name']);
        $user_email    = trim($_POST['user_email']);        
        $user_password = 'admin1234';
        if(empty($user_name) || empty($user_email)){
            $error = true;
        }else{
            $sql  = "INSERT INTO users SET user_name = ?, user_email = ?, user_password = ? ";            
            $stmt = mysqli_stmt_init($conn);                        
            if(!mysqli_stmt_prepare($stmt,$sql)){
                die("fetched to fail from Database" . mysqli_connect_error());
            }else{
                mysqli_stmt_bind_param($stmt,'sss',$user_name, $user_email, $user_password);
                mysqli_stmt_execute($stmt);
            }            
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
                    <input type="submit" name="submit" class="form-control btn btn-secondary" value="Add New User">
                    <?php echo (isset($error) ? "<span style='color:red;'>Field can not be Blank</span>" : ""); ?>
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
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
             <?php
              $sql  = 'SELECT * FROM users';
              $stmt = mysqli_stmt_init($conn);
              if(!mysqli_stmt_prepare($stmt, $sql)) {
                die("Query failed");
              } else {
                mysqli_stmt_execute($stmt);
                $result      = mysqli_stmt_get_result($stmt);
                while($row   = mysqli_fetch_assoc($result)) {
                  $user_id   = $row['user_id'];
                  $user_name = $row['user_name'];
                  $user_email= $row['user_email']; ?>
                  <tr>
                    <th><?php echo $user_id; ?></th>
                    <td><?php echo $user_name; ?></td>
                    <td><?php echo $user_email; ?></td>
                    <td><a href="index.php?edit=<?php echo $user_id; ?>" class="btn btn-success btn-sm">Edit</a></td>
                    <td><a href="index.php?del=<?php echo $user_id; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                  </tr>
                <?php } 
              }
            ?>                
            </tbody>
        </table>
        <?php 
            if(isset($_GET['del'])){
                $user_id = $_GET['del'];
                $sql  = "DELETE FROM users WHERE user_id = ?";                
                $stmt = mysqli_stmt_init($conn);                
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    die("Fail to delete from Database" . mysqli_connect_error());
                }else{                                  
                    mysqli_stmt_bind_param($stmt,'i', $user_id);
                    mysqli_stmt_execute($stmt);
                    header('location:index.php');     
                }
            }
        ?>
    </div>
<?php require_once 'includes/footer.php'; ?>
