<?php
ob_start();
session_start();
require_once('./conn.php');

function test_input($data) {
     
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $query = "SELECT * FROM users WHERE email = :email AND usr_password = :pass";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $password, PDO::PARAM_STR);
    $res = $stmt->execute();
    // var_dump($res);
    // print_r($_POST);
    // die('hello');
    

    
 

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $user;
    if (isset($user)) {
        $_SESSION['user_id'] = $user['usr_id'];
        $_SESSION['user_role'] = $user['role'];
        
        
        if($user['role'] == 'admin'){
            $error = "add email or password";
            echo'admin';
            header('Location: admindash.php');
        }elseif ($user['role'] == 'product owner'){
            header('Location: podash.php');
        }elseif ($user['role'] == 'scrum master'){
            header('Location: smdash.php');
        }else{
            header('Location: userdash.php');
        }
        // _____________________________________________________________________________
        // switch ($user['role']) {
        //     case 'admin':
        //         header('Location: admindash.php');
        //         break;
        //     case 'product owner' :
        //         header('Location: podash.php');
        //         break;
        //     case 'scrum master' :
        //         header('Location: smdash.php');
        //         break;
        //     default :
        //     header('Location: userdash.php');
        // }
        // ____________________________________________________________________________________
       
    } else {
        echo "Invalid email or password";
       
    }
}
?>