<?php
require('connectDB.php');
require('fpdf/fpdf.php');

$font = "C:/xampp/htdocs/biometricattendance/Roboto.ttf";
$folderName = 'download-certificate/' . date('d-m-Y');

// Create the folder if it doesn't exist
if (!file_exists($folderName)) {
    mkdir($folderName, 0777, true);
}

if (isset($_POST['date'])) {
    $date = $_POST['date']; // get the date value from the form input
} else {
    $date = date('Y-m-d'); // use the current date if no date is specified
}

$select_query = mysqli_query($conn, "SELECT * FROM users_logs WHERE checkindate = '$date'");

while($biometricattendance = mysqli_fetch_array($select_query))
{
    $image = imagecreatefromjpeg("certificate.jpg");
    $color = imagecolorallocate($image, 19,21,22);
    $id = $biometricattendance['serialnumber'];
    $name = $biometricattendance['username'];
    $dater = preg_replace('/-/', '', $biometricattendance['checkindate']);
    imagettftext($image, 90,0,630,730, $color, $font, $name);
    imagettftext($image, 20,0,1410,810, $color, $font, $biometricattendance['checkindate']);
    imagejpeg($image,"$folderName/$name-$dater.jpg");
    imagedestroy($image);
}

echo '<script>alert("You have successfully created the certificates");</script>';
echo '<script>window.location.href = "'.$_SERVER['HTTP_REFERER'].'";</script>';
?>
