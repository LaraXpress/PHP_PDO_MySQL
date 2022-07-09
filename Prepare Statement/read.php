<?php
    // METHOD : 01
    require_once('database.php');            
    $sql  = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while($users = $stmt->fetch()){
        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }
        
    // METHOD : 02
    require_once('database.php');            
    $sql  = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $id = 1;
    $stmt->bindParam(1,$id);
    $stmt->execute();
    while($users = $stmt->fetch()){
        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }    

    // METHOD : 03
    require_once('database.php');        
    $sql  = "SELECT * FROM users WHERE id = ? AND user_name = ?";
    $stmt = $pdo->prepare($sql);
    $id = 1;
    $name = 'Mazedur';
    $stmt->bindParam(1,$id);
    $stmt->bindParam(2,$name);
    $stmt->execute();
    while($users = $stmt->fetch()){
        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }
    
    // METHOD : 04
    require_once('database.php');        
    $sql  = "SELECT * FROM users WHERE id = ? AND user_name = ?";
    $stmt = $pdo->prepare($sql);    
    $stmt->execute([1,'Mazedur']);    
    while($users = $stmt->fetch()){
        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }    
    // METHOD : 05 
    require_once('database.php');        
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $sql  = "SELECT * FROM users WHERE id = ? AND user_name = ?";
    $stmt = $pdo->prepare($sql);    
    $stmt->execute([1,'Mazedur']);    
    while($users = $stmt->fetch()){
        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }    
    
    // METHOD : 06
    require_once('database.php');        
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $sql  = "SELECT * FROM users WHERE id = ? AND user_name = ?";
    $stmt = $pdo->prepare($sql);    
    $stmt->execute([1,'Mazedur']);        
    while($users = $stmt->fetch()){
        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }    

    // METHOD : 07
    require_once('database.php');        
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $sql  = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);    
    $stmt->execute();        
    while($users = $stmt->fetch()){
        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }    

    // METHOD : 08
    require_once('database.php');            
    $sql  = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);    
    $id   = 1;    
    $stmt->bindParam(':id',$id);    
    $stmt->execute();        
    while($users = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }    

    // METHOD : 09
    require_once('database.php');        
    $sql  = "SELECT * FROM users WHERE id = :id AND user_name = :name";
    $stmt = $pdo->prepare($sql);    
    $id   = 1;    
    $name = 'Mazedur';
    $stmt->bindParam(':id',$id);    
    $stmt->bindParam(':name',$name);    
    $stmt->execute();        
    while($users = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }
    */
    // METHOD : 10
    require_once('database.php');        
    $sql  = "SELECT * FROM users WHERE id = :id AND user_name = :name";
    $stmt = $pdo->prepare($sql);    
    $id   = 1;    
    $name = 'Mazedur';    
    $stmt->execute([
        ':id'   => $id,
        ':name' => $name
    ]);        
    while($users = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }
?>
