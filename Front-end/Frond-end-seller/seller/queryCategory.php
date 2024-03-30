<?php

$sql = "SELECT id, category_name FROM categorys ORDER BY category_name ASC";
$stmt = mysqli_prepare($con, $sql);


if ($stmt->execute()) {
  $result = $stmt->get_result();
  $categories = array();
  while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
  }
} else {
  echo "Error executing statement: " . $stmt->error;
}
