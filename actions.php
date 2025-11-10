<?php

include 'database.php';

$table = 'students';

// wrap the error in the desired HTML format
function err($msg) {
    // echo "<h1> $msg </h1>";
    die("<h1 style=\"color: red;\"> $msg </h1>");
}

// create the students table with dummy data
function init() {   
    global $conn;
    global $table;

    try {
    $conn->query("create table if not exists $table (
        ID int PRIMARY KEY,
        Name text not null,
        Dept text not null,
        Course text not null,
        CGPA float not null
    );");
    } catch (mysqli_sql_exception $e) {
        err('Init error: ' . $e->getMessage());
    }
}

// Read all the rows. Returns 
function read() {
    global $conn;
    global $table;

    $sql = 'SELECT * FROM ' . $table;

    // catch errors here
    try {
        $result = $conn->query($sql);
    } catch (mysqli_sql_exception $e) {
        err('read error: ' . $e->getMessage());
    }

    return $result;
}

// Add row to the marksheet
function create($id, $name, $dept, $course, $cgpa) {
    global $conn;
    global $table;

    $sql = "insert into $table values ($id, '$name', '$dept', '$course', $cgpa)";

    try {
        $conn->query($sql);
    } catch (mysqli_sql_exception $e) {
        err('create error: ' . $e->getMessage());
    }
}

// Delete the row with this ID
function delete($id) {
    global $conn;
    global $table;

    $sql = "delete from $table where id = $id";

    try {
        $conn->query($sql);
    } catch (mysqli_sql_exception $e) {
        err('delete error: ' . $e->getMessage());
    }

    // executes silently. No failure
}

/***********************************************/
/* These below are debug functions for testing */
/***********************************************/

function debug_insert() {
    global $conn;
    global $table;

    try {
        $conn->query("INSERT INTO $table (ID, Name, Dept, Course, CGPA) VALUES
            (21, 'John Smith', 'Computer Science', 'Introduction to Programming', 3.8),
            (22, 'Jane Doe', 'Physics', 'Classical Mechanics', 3.9),
            (23, 'Peter Jones', 'Mathematics', 'Calculus I', 3.7),
            (24, 'Alice Wonderland', 'Literature', 'English Composition', 3.5),
            (25, 'Bob The Builder', 'Engineering', 'Structural Design', 3.2),
            (26, 'Charlie Chaplin', 'Film Studies', 'History of Cinema', 3.9);");
    } catch (mysqli_sql_exception $e) {
        err('debug insert error: ' . $e->getMessage());
    }
}

function debug_display() {
    $result = read();
    // print however you want
    while ($row = $result->fetch_assoc()) {
        // row is a dictionary. Access all the columns this way `row["Name"]`
        // or just iterate over the keys to print every column
        foreach ($row as $col) {
            echo "$col ";
        }
        echo '<br>';
    }
}

/***********************/
/* Example calls below */
/***********************/

// must call
init();
// debug_insert();
// debug_display();

// create(1032, "Nigga wat", "EEE", "bad coursse", 4.99);
// delete(1032);


