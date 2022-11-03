<?php
$conn = mysqli_connect("localhost", "root", "", "sinar_gemilang");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
