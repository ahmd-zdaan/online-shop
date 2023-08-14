<?php
session_start();

$severname = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'online_shop';

$connect = mysqli_connect($severname, $username, $password, $dbname);

if (!$connect) {
    die('Failed to Connect: ' . mysqli_connect_error());
}

// ================== Functions ==================

function get($table, $condition = '', $select = '*')
{
    global $connect;

    $query = "SELECT " . $select . " FROM " . $table . " " . $condition;
    $result = mysqli_query($connect, $query);

    return $result;
}

function login($email, $password)
{
    $result = get("user", "WHERE email='" . $email . "'");

    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);
        if (password_verify($password, $result['password'])) {
            $_SESSION['email'] = $result['email'];
            echo '<script>window.location.href = "index.php"</script>';
        } else {
            echo '<script>alert("Password incorrect")</script>';
        }
    } else {
        echo '<script>alert("Email not found")</script>';
    }
}

function register($user_name, $role, $email, $password, $confirmPassword, $address, $country_id, $postal_code, $phone)
{
    $result = get("user", "WHERE email='" . $email . "'");

    if (mysqli_num_rows($result) == 0) {
        if ($password == $confirmPassword) {
            $password_encrypt = password_hash($password, PASSWORD_DEFAULT);
            $result = insert('user', [
                'user_name' => $user_name,
                'role' => $role,
                'email' => $email,
                'password' => $password_encrypt,
                'address' => $address,
                'country_id' => $country_id,
                'postal_code' => $postal_code,
                'phone' => $phone
            ]);
            if ($result) {
                $_SESSION['email'] = $email;
                echo '<script>window.location.href = "index.php"</script>';
            }
        } else {
            echo "<script>alert('Confirm password incorrect')</script>";
        }
    } else {
        echo "<script>alert('Email already exists')</script>";
    }
}

function check($check)
{
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

function log_out()
{
    session_destroy();
    echo '<script>window.location.href = "index.php?page=login"</script>';
}

function wishlist($email, $product_id)
{
    global $connect;

    $result = get("user", "WHERE id='" . $email . "'");
    $data = mysqli_fetch_assoc($result);

    $query = "UPDATE user SET wishlist='" . $product_id . "' WHERE id='" . $email . "'";
    $result = mysqli_query($connect, $query);
}

function rupiah($angka)
{
    $hasil = 'Rp' . number_format($angka, 2, ',', '.');
    return $hasil;
}

function insert($table, $data)
{
    global $connect;

    $keys = array_keys($data);
    $values = array_map(function ($values) use ($connect) {
        return "'" . mysqli_real_escape_string($connect, $values) . "'";
    }, array_values($data));

    $query = "INSERT INTO $table (" . implode(",", $keys) . ") VALUES (" . implode(",", $values) . ")";

    // var_dump($query); die;

    if (mysqli_query($connect, $query)) {
        return true;
    } else {
        return false;
    }
}

function dateConvert($input)
{
    $explode = explode('-', $input);
    $output = '';

    $day = $explode[0];
    $month = $explode[1];
    $year = $explode[2];

    if ($day == '01') {
        $day = '1st';
    } elseif ($day == '02') {
        $day = '2nd';
    } elseif ($day == '03') {
        $day = '3rd';
    } else {
        $day .= 'th';
    }

    if ($month == '01') {
        $month = 'January';
    } elseif ($month == '02') {
        $month = 'February';
    } elseif ($month == '03') {
        $month = 'March';
    } elseif ($month == '04') {
        $month = 'April';
    } elseif ($month == '05') {
        $month = 'May';
    } elseif ($month == '06') {
        $month = 'June';
    } elseif ($month == '07') {
        $month = 'July';
    } elseif ($month == '08') {
        $month = 'August';
    } elseif ($month == '09') {
        $month = 'September';
    } elseif ($month == '10') {
        $month = 'October';
    } elseif ($month == '11') {
        $month = 'November';
    } elseif ($month == '12') {
        $month = 'December';
    }

    $output = $day . ' ' . $month . ', ' . $year;

    return $output;
}

function cutFromEnd($string, $value)
{
    $result = rtrim($string, substr($string, -$value));
    return $result;
}
