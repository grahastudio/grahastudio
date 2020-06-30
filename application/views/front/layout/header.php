<?php
$meta = $this->meta_model->get_meta();

// error_reporting(0);
// ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $meta->title ?> | <?php echo $meta->tagline ?></title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/upload/image/' . $meta->favicon) ?>">
    <meta name="description" content="<?php echo $meta->description ?>">
    <meta name="keywords" content="<?php echo $meta->title . ',' . $meta->keywords ?>">
    <meta name="author" content="<?php echo $meta->title ?>">
    <meta name="google-site-verification" content="<?php echo $meta->google_meta ?>" />
    <meta name="msvalidate.01" content="<?php echo $meta->bing_meta ?>" />



    <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/icon/fontawesome5/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/template/css/component-chosen.css">
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/template/css/bootstrap-datetimepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/template/css/timepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/template/css/dataTables.bootstrap4.min.css" />
  <!-- Font CSS File -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/fonts/open-sans/style.css">


</head>

<body>
