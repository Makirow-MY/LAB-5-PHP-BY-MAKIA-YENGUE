<?php
session_start();

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'LibraryDB');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql) === TRUE) {
    echo "<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db(DB_NAME);

// Create Books table
$sql_books = "CREATE TABLE IF NOT EXISTS Books (
    book_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    author VARCHAR(255),
    price DECIMAL(10,2),
    genre VARCHAR(100),
    publication_year INT
)";

// Create Users table
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    user_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Execute table creation queries
if ($conn->query($sql_books) !== TRUE) {
    echo "Error creating Books table: " . $conn->error . "<br>";
}

if ($conn->query($sql_users) !== TRUE) {
    echo "Error creating Users table: " . $conn->error . "<br>";
}

// Insert sample users
$users = [
    ['username' => 'Makia Yengue', 'email' => 'makia@gmail.com', 'password'=> password_hash("Makia123.", PASSWORD_DEFAULT)],
    ['username' => 'Naomie Ekon', 'email' => 'naomie@gmail.com', 'password'=> password_hash("Naomie123.", PASSWORD_DEFAULT)],
];

foreach ($users as $user) {
    $check_user = "SELECT * FROM users WHERE email = '{$user['email']}'";
    $result = $conn->query($check_user);
    
    if ($result->num_rows == 0) {
        $insert_user = "INSERT INTO users (username, email, password) 
                       VALUES ('{$user['username']}', '{$user['email']}', '{$user['password']}')";
        if (!$conn->query($insert_user)) {
            echo "Error inserting user: " . $conn->error . "<br>";
        }
    }
}

// Insert sample books
$books = [
    ['title'=> 'The Great Gatsby', 'author'=> 'F. Scott Fitzgerald', 'price'=> 8600, 'genre'=>'Horror', 'year'=>1925],
    ['title'=> 'Alice In Wonderland', 'author'=> 'Alexander Fleming', 'price'=> 12200, 'genre'=>'Fantasy', 'year'=>2022],
    ['title'=> 'As You Like It', 'author'=> 'William Shakespeare', 'price'=> 5500, 'genre'=>'Romance', 'year'=>1976],
    ['title'=> 'Harry potter and the chamber of secrets', 'author'=> 'J.K. Rowling', 'price'=> 10000, 'genre'=>'Supernatural', 'year'=>2009],
];

foreach ($books as $book) {
    $check_book = "SELECT * FROM books WHERE title = '{$book['title']}' AND author = '{$book['author']}'";
    $result = $conn->query($check_book);
    
    if ($result->num_rows == 0) {
        $insert_book = "INSERT INTO books (title, author, genre, price, publication_year) 
                       VALUES ('{$book['title']}', '{$book['author']}', '{$book['genre']}', {$book['price']}, {$book['year']})";
        if (!$conn->query($insert_book)) {
            echo "Error inserting book: " . $conn->error . "<br>";
        }
    }
}

// $conn->close();
?>