<style>
.form-horizontal .checkbox, .form-horizontal .radio {
    min-height: 27px;
    float: left;
    padding-right: 30px;
}
</style>
<!-- page wapper-->
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
        </div>
        <!-- ./breadcrumb -->
        <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
        <!-- page heading-->
       
         <h4 class="account-title"><?php echo $heading_title; ?></h4>
        <!-- ../page heading-->
        <div class="page-content">
            <div class="row">
             <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group required">
          <label class="col-sm-2 control-label" for="input-to-name"><?php echo $entry_to_name; ?></label>
          <div class="col-sm-10">
            <input type="text" name="to_name" value="<?php echo $to_name; ?>" id="input-to-name" class="form-control" />
            <?php if ($error_to_name) { ?>
            <div class="text-danger"><?php echo $error_to_name; ?></div>
            <?php } ?>
          </div>
        </div>
        <div class="form-group required">
          <label class="col-sm-2 control-label" for="input-to-email"><?php echo $entry_to_email; ?></label>
          <div class="col-sm-10">
            <input type="text" name="to_email" value="<?php echo $to_email; ?>" id="input-to-email" class="form-control" />
            <?php if ($error_to_email) { ?>
            <div class="text-danger"><?php echo $error_to_email; ?></div>
            <?php } ?>
          </div>
        </div>
        <div class="form-group required">
          <label class="col-sm-2 control-label" for="input-from-name"><?php echo $entry_from_name; ?></label>
          <div class="col-sm-10">
            <input type="text" name="from_name" value="<?php echo $from_name; ?>" id="input-from-name" class="form-control" />
            <?php if ($error_from_name) { ?>
            <div class="text-danger"><?php echo $error_from_name; ?></div>
            <?php } ?>
          </div>
        </div>
        <div class="form-group required">
          <label class="col-sm-2 control-label" for="input-from-email"><?php echo $entry_from_email; ?></label>
          <div class="col-sm-10">
            <input type="text" name="from_email" value="<?php echo $from_email; ?>" id="input-from-email" class="form-control" />
            <?php if ($error_from_email) { ?>
            <div class="text-danger"><?php echo $error_from_email; ?></div>
            <?php } ?>
          </div>
        </div>
        <div class="form-group required">
          <label class="col-sm-2 control-label"><?php echo $entry_theme; ?></label>
          <div class="col-sm-10">
            <?php foreach ($voucher_themes as $voucher_theme) {  ?>
            <?php if ($voucher_theme['voucher_theme_id'] == $voucher_theme_id) { ?>
            <div class="radio">
              <label>
                <input type="radio" name="voucher_theme_id" value="<?php echo $voucher_theme['voucher_theme_id']; ?>" checked="checked" />
                <?php echo $voucher_theme['name']; ?></label>
            </div>
            <?php } else { ?>
            <div class="radio">
              <label>
                <input type="radio" name="voucher_theme_id" value="<?php echo $voucher_theme['voucher_theme_id']; ?>" />
                <?php echo $voucher_theme['name']; ?></label>
            </div>
            <?php } ?>
            <?php } ?>
            <?php if ($error_theme) { ?>
            <div class="text-danger"><?php echo $error_theme; ?></div>
            <?php } ?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-message"><span data-toggle="tooltip" title="<?php echo $help_message; ?>"><?php echo $entry_message; ?></span></label>
          <div class="col-sm-10">
            <textarea name="message" cols="40" rows="5" id="input-message" class="form-control"><?php echo $message; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-amount"><span data-toggle="tooltip" title="<?php echo $help_amount; ?>"><?php echo $entry_amount; ?></span></label>
          <div class="col-sm-10">
            <input type="text" name="amount" value="<?php echo $amount; ?>" id="input-amount" class="form-control" size="5" />
            <?php if ($error_amount) { ?>
            <div class="text-danger"><?php echo $error_amount; ?></div>
            <?php } ?>
          </div>
        </div>
        <div class="buttons clearfix">
          <div class="pull-right"> <?php echo $text_agree; ?>
            <?php if ($agree) { ?>
            <input type="checkbox" name="agree" value="1" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="agree" value="1" />
            <?php } ?>
            &nbsp;
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-quantity" />
          </div>
        </div>
      </form>
            </div>
        </div>
    </div>
</div>
<!-- ./page wapper-->