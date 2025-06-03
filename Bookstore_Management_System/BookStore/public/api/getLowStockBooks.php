<?php
/**
 * File Name: getLowStockBooks.php
 * Description: Connects to the database and retrieves low stock book records then send to API web client
 *
 * Author: Muhammad Amir Hail Bin Mohamad Hazi
 * Date: 22 September 2024
 *
 * @package inventorymanagement
 */

$servername = "127.0.0.1";
$username = "bookstore";
$password = "secret";
$dbname = "book_store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select low stock books
$query = "SELECT * FROM books WHERE stock_quantity < 5";
$result = $conn->query($query);

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

header('Content-Type: application/json');
echo json_encode($books);

// Close the database connection
$conn->close();
?>