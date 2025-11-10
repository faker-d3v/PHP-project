<?php
include "database.php";

$table = 'users';

// wrap the error in the desired HTML format
function err($msg) {
    die("<h1 style=\"color: red;\"> $msg </h1>");
}

// create the users table
function init() {
    global $conn;
    global $table;

    try {
        $conn->query("create table if not exists $table (
            Mail VARCHAR(255) primary key,
            Pass text not null
        );");
    } catch (mysqli_sql_exception $e) {
        err('Init error: ' . $e->getMessage());
    }
}

// Add rows to the users table
function debug_insert() {
    global $conn;
    global $table;

    try {
        $conn->query("INSERT INTO $table (Mail, Pass) VALUES
            ('user1@example.com', 'pass123'),
            ('admin@example.com', 'adminpass'),
            ('test@example.com', 'testpass');");
    } catch (mysqli_sql_exception $e) {
        err('debug insert error: ' . $e->getMessage());
    }
}

function get_user($mail, $pass) {
    global $conn;
    global $table;

    $sql = "SELECT * FROM $table where Mail='$mail' and Pass='$pass'";

    try {
        $result = $conn->query($sql);

        // read the row if there's any
        if ($result->num_rows > 0) {
            $singleRow = $result ->fetch_assoc();
            return array($singleRow['Mail'], $singleRow['Pass']);
        }
    } catch (mysqli_sql_exception $e) {
        err('read error: ' . $e->getMessage());
    }

    return null;
}


function user_exists($mail, $pass) {
    $user = get_user($mail, $pass);
    if ($user) {
        return true;
        // $mail = $user[0];
        // $pass = $user[1];
        // echo "Mail: " . $mail . ", Pass: " . $pass;
    } else {
        return false;
        // echo "User not found.";
    }
}


function register($mail, $pass) {
    global $conn;
    global $table;

    // check if user already exists
    if (get_user($mail, $pass)) {
        err('Registration error: User with this email already exists.');
    }

    $sql = "INSERT INTO $table (Mail, Pass) VALUES ('$mail', '$pass')";

    try {
        $conn->query($sql);
        header("Location: login.php");
        // echo "User '$mail' registered successfully.";
    } catch (mysqli_sql_exception $e) {
        err('Registration error: ' . $e->getMessage());
    }
}

init();
// register('a', 'b');


?>

