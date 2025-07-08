<?php include_once("files/DB_FUNCTION_INC.php"); ?>
<!DOCTYPE html>
<html lang="en" data-x="html" data-x-toggle="html-overflow-hidden">
<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
  session_start();
  if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
  } elseif (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = "ENG";
  }
  if (isset($metaCanonical)) {
    echo " <link rel='canonical' href='" . $metaCanonical . "' />";
  }
  if ($_SESSION['lang'] == "ENG") {
    if (isset($metaDescription)) {
      echo " <meta name='description' content='" . $metaDescription . "' />";
    }
    if (isset($metaKeywords)) {
      echo " <meta name='keywords' content='" . $metaKeywords . "' />";
    }
  }
  if ($_SESSION['lang'] == "FRA") {
    if (isset($metaDescriptionFRA)) {
      echo " <meta name='description' content='" . $metaDescriptionFRA . "' />";
    }
    if (isset($metaKeywordsFRA)) {
      echo " <meta name='keywords' content='" . $metaKeywordsFRA . "' />";
    }
    $metaTitle = $metaTitleFRA;
  }

  ?>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZV1F4BGG1V"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-ZV1F4BGG1V');
  </script>
  <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
  <title> <?php echo $metaTitle ?></title>
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?php echo $WORKPATH ?>fonts/css2.css">
  <link rel="stylesheet" href="<?php echo $WORKPATH ?>css/vendors.css">
  <link rel="stylesheet" href="<?php echo $WORKPATH ?>css/main.css">
  <link rel="stylesheet" href="<?php echo $WORKPATH ?>css/backoffice.css">
  <link rel="stylesheet" href="<?php echo $WORKPATH ?>css/datatable.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $WORKPATH ?>css/datepickrange.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $WORKPATH ?>css/backoffice.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.21/css/intlTelInput.css" />
</head>