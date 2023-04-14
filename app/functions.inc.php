<?php
require_once("../dal/db_conn.php");
session_start();
/////////////////////////// CART FUNCTIONS ///////////////////////////
function addToCart($bp_id)
{
    // if the cart is not set, we create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // add the product to the cart
    if (!array_key_exists($bp_id, $_SESSION['cart'])) {
        $_SESSION['cart'][$bp_id] = 1;
    } else {
        $_SESSION['cart'][$bp_id]++;
    }
}

function modifyCart($bp_id, $quantity)
{
    // if the cart is not set, we create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // add the product to the cart
    $_SESSION['cart'][$bp_id] = $quantity;
}

function getCountForProduct($bp_id)
{
    // if the cart is not set, we create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // add the product to the cart
    if (array_key_exists($bp_id, $_SESSION['cart'])) {
        return $_SESSION['cart'][$bp_id];
    } else {
        return 0;
    }
}
function login($email, $password) {
    $pdo = DBHelper::getConnection();
    echo $email;
    echo $password;
    $stmt=$pdo->prepare("select * from user where email=:email");
    $stmt->execute([
        "email" => $email    
    ]);
    
    if($stmt->rowCount()==1){
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        echo $row["user_id"];
        if(password_verify($password,$row["passwordHash"])) {
            session_regenerate_id();
            $_SESSION["user_data"] = $row;
            $_SESSION["user_id"]=$row["user_id"];
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function logout() {
    $_SESSION=[];
    session_destroy();
    setcookie('PHPSESSID','',time()-3600,"/",'',0,0);
}

function redirectIfLoggedIn() {
    if(!empty($_SESSION["user_id"])) {
        header("Location: products.php");
    }
}

function redirectIfNotLoggedIn() {
    if(empty($_SESSION["user_id"])) {
        header("Location: login.php");
    }
}

function redirectIfNotAdmin() {
    if(empty($_SESSION["user_id"]) && $_SESSION["user_type"] === 'Admin') {
        header("Location: ../app/login.php");
    }
}

function signup($firstName,$lastName,$email,$password, $newFileName) {
    $pdo = DBHelper::getConnection();
    $hashAdmin=password_hash($password,PASSWORD_DEFAULT);
    $pdo->query(
        "INSERT INTO user(firstName,lastName,email,passwordHash,user_type,imageName)
         values
        ('$firstName','$lastName','$email','$hashAdmin', 'User', '$newFileName')");
    $stmt=$pdo->prepare("select user_id, passwordHash from user where Email=:email");
    $stmt->execute([
        "email" => $email
    ]);
        if($stmt->rowCount()==1){
            header("Location: login.php");
        }
    }
?>