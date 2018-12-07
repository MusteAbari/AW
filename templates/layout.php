<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
	/>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">    <?php require 'stylesheet.php'; ?>
  <title><?php echo $title; ?></title>
  <link rel="icon" href="images/AWLogo.ico" type="image/x-icon" />

  </head>
  <body>
  <?php require 'templates/nav.php'; ?>
    <div class="wrapper">
	<?php echo $content; ?>


      <footer>
        Email:
        <a
          href="mailto:info@ayaswaitressing.co.uk?Subject=Booking%20Enquiry"
          target="_top"
          >info@ayaswaitressing.co.uk</a
        >
      </footer>
    </div>
  </body>
</html>
