<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>

<!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/fonts/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/fonts/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/css/AdminLTE.css">
  
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/css/skins/skin-green.css">
  
  <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/css/custom.css">
  
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
  <style type="text/css">
    .table thead td {
    font-weight: bold;
}
  </style>
</head>
<body>
<div class="container">

  <?php foreach ($purchases as $purchase) { ?>
  <div style="page-break-after: always;">
    <h1><?php echo $text_invoice; ?> #<?php echo $purchase['purchase_id']; ?></h1>
   <a class="pull-right" style="font-size:20px;" target="_blank" onClick="javascript:print()"><i class="fa fa-print"></i></a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td colspan="2"><?php echo $text_purchase_detail; ?></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="width: 50%;"><address>
            <strong><?php echo $purchase['store_name']; ?></strong><br />
            <?php echo $purchase['store_address']; ?>
            </address>
            <b><?php echo $text_telephone; ?></b> <?php echo $purchase['store_telephone']; ?><br />
            <?php if ($purchase['store_fax']) { ?>
            <b><?php echo $text_fax; ?></b> <?php echo $purchase['store_fax']; ?><br />
            <?php } ?>
            <b><?php echo $text_email; ?></b> <?php echo $purchase['store_email']; ?><br />
            </td>
          <td style="width: 50%;"><b><?php echo $text_date_added; ?></b> <?php echo $purchase['date_added']; ?><br />
            <?php if ($purchase['invoice_no']) { ?>
            <b><?php echo $text_invoice_no; ?></b> <?php echo $purchase['invoice_no']; ?><br />
            <?php } ?>
            <!--<b><?php echo $text_order_id; ?></b> <?php echo $purchase['order_id']; ?><br />--> 
		   <?php if ($purchase['manufacturer_name']) { ?>
            <b><?php echo 'Manufacturer Name:'; ?></b> <?php echo $purchase['manufacturer_name']; ?><br />
            <?php } ?>
			<?php if ($purchase['manufacturer_email']) { ?>
            <b><?php echo 'Manufacturer Email:'; ?></b> <?php echo $purchase['manufacturer_email']; ?><br />
            <?php } ?>
			<?php if ($purchase['manufacturer_mobile']) { ?>
            <b><?php echo 'Manufacturer Mobile:'; ?></b> <?php echo $purchase['manufacturer_mobile']; ?><br />
            <?php } ?>
			<?php if ($purchase['manufacturer_address']) { ?>
            <b><?php echo 'Manufacturer Address:'; ?></b> <?php echo $purchase['manufacturer_address']; ?><br />
            <?php } ?>
        </tr>
      </tbody>
    </table>
   
    <table class="table table-bordered">
      <thead>
        <tr>
          <td><b><?php echo $column_product; ?></b></td>
          <td><b><?php echo $column_model; ?></b></td>
          <td class="text-right"><b><?php echo $column_quantity; ?></b></td>
          <td class="text-right"><b><?php echo $column_price; ?></b></td>
          <td class="text-right"><b><?php echo $column_total; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($purchase['product'] as $product) { ?>
        <tr>
          <td><?php echo $product['name']; ?>
            <?php foreach ($product['option'] as $option) { ?>
            <br />
            &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
            <?php } ?></td>
          <td><?php echo $product['model']; ?></td>
          <td class="text-right"><?php echo $product['quantity']; ?></td>
          <td class="text-right"><?php echo $product['price']; ?></td>
          <td class="text-right"><?php echo $product['total']; ?></td>
        </tr>
        <?php } ?>        
        <?php foreach ($purchase['total'] as $total) { ?>
        <tr>
          <td class="text-right" colspan="4"><b><?php echo $total['title']; ?></b></td>
          <td class="text-right"><?php echo $total['text']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php if ($purchase['comment']) { ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td><b><?php echo $text_comment; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $purchase['comment']; ?></td>
        </tr>
      </tbody>
    </table>
    <?php } ?>
  </div>
  <?php } ?>
</div>
</body>
</html>