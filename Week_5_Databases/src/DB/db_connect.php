<?php
function dbConn(): mysqli
{
  $servername = "localhost";
  $username = "ecc";
  $password = "";
  $db = 'ecc_demo';

  // Create connection
  $conn = new mysqli($servername, $username, $password, $db);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
  return $conn;
}

function closeConnection(mysqli $conn)
{
  $conn->close();
}
