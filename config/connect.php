<?php
session_start();

$severname = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'online_shop';

$connect = mysqli_connect($severname, $username, $password, $dbname);

if (!$connect) {
    die('Failed to Connect : '.mysqli_connect_error());
}

// ================== Function ==================

function get($table, $condition='', $function='*') {
    global $connect;

    $query = "SELECT ".$function." FROM ".$table." ".$condition;
    $result = mysqli_query($connect, $query);

    return $result; 
}

function login($email, $password) {
    $result = get("user","WHERE email='".$email."'");

    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);
        if (password_verify($password, $result['password'])) {
            $_SESSION['email'] = $result['email'];

            // echo '<script>alert("Successfully login!")</script>';
            echo '<script>window.location.href = "index.php"</script>';
        } else {
            echo '<script>alert("Password incorrect")</script>';
        }
    } else {
        echo '<script>alert("Email not found")</script>';
    }
}

function register($nama, $email, $password, $confirmPassword, $address, $city, $country, $telephone) {
    global $connect;
    
    $result = get("user","WHERE email='".$email."'");
    
    if (mysqli_num_rows($result) == 0) {
        if ($password == $confirmPassword) {
            $password_encrypt = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO user (name, email, password, address, city, country, telephone) VALUES ('$nama.', '$email.', '$password_encrypt', '$address', '$city', '$country', '$telephone')";
            $result = mysqli_query($connect, $query);
            if ($result) {
                $_SESSION['email'] = $email;
                // echo "<script>alert('Account successfully registered!')</script>";
                echo '<script>window.location.href = "index.php"</script>';
            }
        } else {
            echo "<script>alert('Confirm password incorrect')</script>";
        }
    } else {
        echo "<script>alert('Email already exists')</script>";
    }
}

function check($check) {
    switch ($check) {
        case 'login':
            if (!isset($_SESSION['email'])) {
                echo '<script>window.location.href = "index.php?page=login"</script>';
            }
            break;
        case 'register':
            if (isset($_SESSION['email'])) {
                echo '<script>window.location.href = "index.php"</script>';
            }
            break;
    }
}

function log_out() {
    session_destroy();
    echo '<script>window.location.href = "index.php?page=login"</script>';
}

function wishlist($email, $product_id) {
    global $connect;

    $result = get("user", "WHERE id='".$email."'");
    $data = mysqli_fetch_assoc($result);

    $query = "UPDATE user SET wishlist='".$product_id."' WHERE id='".$email."'";
    $result = mysqli_query($connect, $query);
}

function rupiah($angka) {
    $hasil = 'Rp'.number_format($angka, 2, ',', '.');
    return $hasil;
}

function insert($table, $data) {
    global $connect;

    $keys = array_keys($data);
    $values = array_map(function($values) use ($connect) {
        return "'".mysqli_real_escape_string($connect, $values)."'";
    }, array_values($data));
    
    $query = "INSERT INTO $table (".implode(",", $keys).") VALUES (".implode(",", $values).")";
    if (mysqli_query($connect, $query)) {
        return true;
    } else {
        return false;
    }
}

function update() {
    
}

?>