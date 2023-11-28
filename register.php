<?php
require_once('./conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST['firstname'];
    $prenom = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password != $password2){
        echo "check the confirmation of your password";
    }else{
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
        
            $stmt = $conn->prepare("INSERT INTO users (nom, prenom, email, usr_password) 
                                    VALUES (? , ? , ? , ?)");
    
            $stmt->bindParam(1, $nom);
            $stmt->bindParam(2, $prenom);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $hashedPassword);
    
            if ($stmt->execute()) {
                
                header("Location: userdash.php");
                exit();
            } else {
                echo "Execute failed";
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    
}

include('./login.php');

$conn = null;
?>