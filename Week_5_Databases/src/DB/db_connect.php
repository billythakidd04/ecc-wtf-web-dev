<?php
function dbConn(): mysqli
{
  $servername = "localhost";
  $username = "ecc";
  $password = "";

  // Create connection
  $conn = new mysqli($servername, $username, $password);

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
