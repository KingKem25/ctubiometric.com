<!DOCTYPE html>
<html>
<head>
  <title>Show Certificates</title>
<link rel="stylesheet" type="text/css" href="css/userslog.css">
<script>
  $(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
</script>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/user_log.js"></script>

</head>
<body>
<?php include'header.php'; ?> 
<main>
<section>

<h1 class="slideInDown animated">Select a date and display an image:</h1>
<div class="form-style-5 slideInDown animated">
  <form method="POST">
    <input type="date" id="date" name="date" style="background-color: white; color: black ; cursor:pointer">
    <input type="submit" value="Submit" name="submit" style="background-color: orange; color: black ; cursor:pointer">
    <input type="submit" name="To_Excel" style="background-color: orange; color: black ; cursor:pointer" value="Export as PDF">

    <?php
if (isset($_POST['To_Excel'])) {
  ob_start();
  require('fpdf/fpdf.php');
  $selected_date = date('d-m-Y', strtotime($_POST['date']));

  $folder_path  = 'download-certificate/'.$selected_date;
  // Folder path containing images
  // Get list of image files in the folder
  $files = glob($folder_path . '/*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}', GLOB_BRACE);

  // Create new PDF document
  $pdf = new FPDF();
  $pdf->AddPage('L');

  // Loop through the image files and add them to the PDF
  foreach($files as $file) {
    // Get image dimensions
    list($width, $height) = getimagesize($file);

    // Calculate size to fit image on landscape page
    if ($width > $height) {
      $ratio = $width / $height;
      $new_width = 275;
      $new_height = $new_width / $ratio;
    } else {
      $ratio = $height / $width;
      $new_height = 185;
      $new_width = $new_height / $ratio;
    }

    // Add image to current page
    if ($pdf->GetY() + $new_height > $pdf->GetPageHeight()) {
      $pdf->AddPage('L');
    }
    $pdf->Image($file, null, $pdf->GetY(), $new_width, $new_height);
    $pdf->Ln(10);
  }

  if (empty($files)) {
    echo "No image files found in folder!";
    exit;
  }

  // Output the PDF to a file
  $pdf->Output('F', $selected_date . '.pdf');

  ob_end_clean();

  // Output a message to indicate where the file was saved
  echo "PDF SAVED SUCCESSFULLY " ;
  exit; // Stop further execution of the script
}

?>





  </form>
</div>
<div class="tbl-header slideInRight animated">
  <table cellpadding="0" cellspacing="0" border="0">
    <thead>
      <tr style="background-color: #FEE68E; font-family: Poppins">
        <th >Here are the Images for certificate</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <?php
          if(isset($_POST['submit'])) {
          if(isset($_POST['date'])) {
            $selected_date = date('d-m-Y', strtotime($_POST['date']));
            echo '<h2>'.$selected_date.'</h2>';
            $dir = './download-certificate/'.$selected_date;
            if(is_dir($dir)) {
              $files = scandir($dir);
              foreach($files as $file) {
                if($file != '.' && $file != '..') {
           echo '<div style="display:block;"><img src="'.$dir.'/'.$file.'" alt="'.$file.'" width="600" style="margin-bottom: 20px;"></div>';
        }
              }
            } else {
              echo 'No images found for '.$selected_date;
            }
          }
        }
  
        
          ?>
        </td>
      </tr>
    </tbody>
  </table>
</div>


  <div class="tbl-content slideInRight animated">
    <div id="userslog"></div>
  </div>



        <?php
      /*  require('connectDB.php');

        // Set the path to the folder where the images are stored
        $dir = "download-certificate";

        // Check for connection errors
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve all the image filenames from the folder
        $files = scandir($dir);

        // Loop through the filenames and display each image on the webpage
        foreach ($files as $file) {
            if (in_array($file, array(".", ".."))) continue;
            echo "<img src='$dir/$file' alt='$file'  width='800px' height='500px' />";
            
        // Store the filename in the MySQL database
        $sql = "INSERT INTO images (images) VALUES ('$file')";
        if (mysqli_query($conn, $sql)) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        }

        // Close the MySQL database connection
        mysqli_close($conn);


        */?>
  
        </section>
</main>
</body>
</html>

