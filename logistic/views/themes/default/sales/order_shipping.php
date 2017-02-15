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
  <?php foreach ($orders as $order) { ?>
  <div style="page-break-after: always;">
    <h1><?php echo $text_picklist; ?> #<?php echo $order['order_id']; ?></h1>
    <a class="pull-right" style="font-size:20px;" target="_blank" onClick="javascript:print()"><i class="fa fa-print"></i></a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td colspan="2"><?php echo $text_order_detail; ?></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><address>
            <strong><?php echo $order['store_name']; ?></strong><br />
            <?php echo $order['store_address']; ?>
            </address>
            <b><?php echo $text_telephone; ?></b> <?php echo $order['store_telephone']; ?><br />
            <?php if ($order['store_fax']) { ?>
            <b><?php echo $text_fax; ?></b> <?php echo $order['store_fax']; ?><br />
            <?php } ?>
            <b><?php echo $text_email; ?></b> <?php echo $order['store_email']; ?><br />
          </td>
          <td style="width: 50%;"><b><?php echo $text_date_added; ?></b> <?php echo $order['date_added']; ?><br />
            <?php if ($order['invoice_no']) { ?>
            <b><?php echo $text_invoice_no; ?></b> <?php echo $order['invoice_no']; ?><br />
            <?php } ?>
            <b><?php echo $text_order_id; ?></b> <?php echo $order['order_id']; ?><br />
            <?php if ($order['shipping_method']) { ?>
            <b><?php echo $text_shipping_method; ?></b> <?php echo $order['shipping_method']; ?><br />
            <?php } ?></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td style="width: 50%;"><b><?php echo $text_payment_address; ?></b></td>
          <td style="width: 50%;"><b><?php echo $text_contact; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $order['shipping_address']; ?></td>
          <td><?php echo $order['email']; ?><br/>
            <?php echo $order['telephone']; ?></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td><b><?php echo $column_location; ?></b></td>
          <td><b><?php echo $column_reference; ?></b></td>
          <td><b><?php echo $column_product; ?></b></td>
          <td><b><?php echo $column_weight; ?></b></td>
          <td><b><?php echo $column_model; ?></b></td>
          <td class="text-right"><b><?php echo $column_quantity; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($order['product'] as $product) { ?>
        <tr>
          <td><?php echo $product['location']; ?></td>
          <td><?php if ($product['sku']) { ?>
            <?php echo $text_sku; ?> <?php echo $product['sku']; ?><br />
            <?php } ?>
            <?php if ($product['upc']) { ?>
            <?php echo $text_upc; ?> <?php echo $product['upc']; ?><br />
            <?php } ?>
            <?php if ($product['ean']) { ?>
            <?php echo $text_ean; ?> <?php echo $product['ean']; ?><br />
            <?php } ?>
            <?php if ($product['jan']) { ?>
            <?php echo $text_jan; ?> <?php echo $product['jan']; ?><br />
            <?php } ?>
            <?php if ($product['isbn']) { ?>
            <?php echo $text_isbn; ?> <?php echo $product['isbn']; ?><br />
            <?php } ?>
            <?php if ($product['mpn']) { ?>
            <?php echo $text_mpn; ?><?php echo $product['mpn']; ?><br />
            <?php } ?></td>
          <td><?php echo $product['name']; ?>
            <?php foreach ($product['option'] as $option) { ?>
            <br />
            &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
            <?php } ?></td>
          <td><?php echo $product['weight']; ?></td>
          <td><?php echo $product['model']; ?></td>
          <td class="text-right"><?php echo $product['quantity']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php if ($order['comment']) { ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td><b><?php echo $text_comment; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $order['comment']; ?></td>
        </tr>
      </tbody>
    </table>
    <?php } ?>
  </div>
  <?php } ?>
</div>
</body>
</html>