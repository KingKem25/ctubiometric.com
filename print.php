<?php
// Open a connection to the printer
$printer = printer_open();

// Set up the print job
printer_start_doc($printer, "My Document");
printer_start_page($printer);

// Print some text
$font = printer_create_font("Arial", 16, 16, 0, false, false, false, 0);
printer_select_font($printer, $font);
printer_draw_text($printer, "Hello, world!", 100, 100);
printer_delete_font($font);

// End the print job
printer_end_page($printer);
printer_end_doc($printer);

// Close the printer connection
printer_close($printer);
?>


<table cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
      <th>Here are the Images for certificate</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require('connectDB.php');

    $select_query = mysqli_query($conn, "SELECT * FROM users_logs");
    while($biometricattendance = mysqli_fetch_array($select_query)) {
      $name = $biometricattendance['username'];
      $images_path = "download-certificate/" . $name . "-*.jpg";
      $images = glob($images_path); // get all the images for this user
      if(count($images) > 0) {
        echo "<tr><td><h3>Images for " . $name . ":</h3>";
        foreach($images as $image_path) {
          echo "<img src='" . $image_path . "' width='400'>";
        }
        echo "</td></tr>";
      }
    }
    ?>
  </tbody>
</table>
