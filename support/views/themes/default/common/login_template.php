<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/fonts/font-awesome/css/font-awesome.min.css">
<?php
  /** -- Copy from here -- */
  if(isset($meta) && count($meta)>0)
  foreach($meta as $name=>$content){
    echo "\n\t\t";
    ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
       }
  echo "\n";

  if(isset($canonical) && $canonical!=="")
  {
    echo "\n\t\t";
    ?><link rel="canonical" href="<?php echo $canonical?>" /><?php

  }
  echo "\n\t";

  foreach($css as $file){
    echo "\n\t\t";
    ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
  } echo "\n\t";

  
  /** -- to here -- */
?>
</head>
<body class="hold-transition login-page">
<?php echo $output;
foreach($js as $file){
      echo "\n\t\t";
      ?><script src="<?php echo $file; ?>"></script><?php
  } echo "\n\t";

?>
</body>
<!-- iCheck -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  
  /* login page slider image script*/
   
     $.backstretch([
      "<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/slider-1.jpg",
      "<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/slider-2.jpg",
	    "<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/slider-3.jpg",
      "<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/images/slider-4.jpg"
      ], {
        fade: 600,
        duration: 4000,
    });
</script>

</html>
