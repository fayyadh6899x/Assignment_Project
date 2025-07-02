<?php require 'db.php';
if(isset($_GET['nim'])){
  $nim = $_GET['nim'];
  $del = $conn->prepare("DELETE FROM mahasiswa WHERE nim=?");
  $del->bind_param("s",$nim);
  $del->execute();
}
header('Location: index.php');

