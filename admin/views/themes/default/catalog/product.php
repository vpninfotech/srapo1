<link href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/summernote/summernote.js"></script>
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/select2/select2.min.css">
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/select2/select2.min.js"></script>
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/select2/select2.full.min.js"></script>


<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap timepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/timepicker/bootstrap-timepicker.min.css">
<!-- bootstrap timepicker -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/timepicker/bootstrap-timepicker.min.js"></script>


<!-- DATE TIME PICKER -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datetimepicker/bootstrap-datetimepicker.min.css">
<!-- bootstrap timepicker -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Products </h1>
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </ul>

        <div class="pull-right">
            <button class="btn btn-primary" type="submit" value="save" name="product_save" form="form-product" title="Save"><i class="fa fa-save"></i></button>
            <a href="<?php echo $cancel; ?>" class="btn btn-default" title="Back"><i class="fa fa-reply"></i></a>
        </div>
    </section>
    <!------------------ End Content Header (Page header) ---------------------> 
   
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
       
            
            <div class="row">
                <?php if (isset($error) && $error !== ""): ?>
                <div class="col-xs-12">
                    <div class="alert alert-danger alert-bold-border">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>

                        <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error; ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($success) && $success !== ""): ?>
                <div class="col-xs-12">
                    <div class="alert alert-success alert-bold-border">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>

                        <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success; ?>

                    </div>
                </div>
            <?php endif; ?>
                
                 

                <div class="col-xs-12">
                    <div class="box box-default">
                       
                        <div class="box-header">
                            <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i><?php echo $text_form; ?></h2>
                        </div>    
                        <div class="box-body">
                             <form class="form-horizontal" action="<?php echo $form_action ?>" method="post" name="form-product" id="form-product"> 
                <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                            <div>

                                <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
                                        <li><a href="#tab-data" data-toggle="tab">Data</a></li>
                                        <li><a href="#tab-links" data-toggle="tab">Links</a></li>
                                        <li><a href="#tab-attribute" data-toggle="tab">Attribute</a></li>
                                        <li><a href="#tab-option" data-toggle="tab">Option</a></li>
                                        <li><a href="#tab-discount" data-toggle="tab">Discount</a></li>
                                        <li><a href="#tab-special" data-toggle="tab">Special</a></li>
                                        <li><a href="#tab-image" data-toggle="tab">Image</a></li>
                                    </ul>
                                    <div class="tab-content"> 
                                        <!-- Start : tab-pane -->
                                        <div class="tab-pane active" id="tab-general"> 
                                            <!------- start : input group ------>
                                            <div class="form-group required <?php
                                            if (form_error('product_name') !== "") {
                                                echo "has-error";
                                            }
                                            ?>">
                                                <label for="product_name" class="col-sm-3 col-md-2 control-label">Product Name</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" name="product_name" id="product" class="form-control" placeholder="Product Name" value="<?php echo $product_name; ?>">
<?php echo form_error('product_name', '<div class="text-danger">', '</div>'); ?> 
                                                </div>
                                            </div>
                                            <!------- end : input group ------> 

                                            <!------- start : text area group ------>
                                            <div class="form-group">
                                                <label for="product_description" class="col-sm-3 col-md-2 control-label">Description</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <textarea class="form-control" name="product_description" id="input-description"><?php echo $product_description; ?></textarea>
                                                </div>
                                            </div>
                                            <!------- End : text area group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group required <?php
if (form_error('metatag') !== "") {
    echo "has-error";
}
?>">
                                                <label for="metatag" class="col-sm-3 col-md-2 control-label">Meta Tag Title</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" class="form-control" name="metatag" id="metatag" placeholder="Meta Tag Title" value="<?php echo $metatag; ?>">
<?php echo form_error('metatag', '<div class="text-danger">', '</div>'); ?> </div>
                                            </div>
                                            <!------- end : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="metadesc" class="col-sm-3 col-md-2 control-label">Meta Tag Description</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <textarea class="form-control" name="metadesc" id="metadesc" rows="5" placeholder="Meta Tag Description"><?php echo $metadesc; ?></textarea>
                                                </div>
                                            </div>
                                            <!------- end : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="metakeyword" class="col-sm-3 col-md-2 control-label">Meta Tag Keywords</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <textarea class="form-control" name="metakeyword" id="metakeyword" rows="5" placeholder="Meta Tag Keywords" data-role="tagsinput" value=""><?php echo $metakeyword; ?></textarea>
                                                </div>
                                            </div>
                                            <!------- end : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="p_tag" class="col-sm-3 col-md-2 control-label"> <span data-toggle="tooltip" title="" data-original-title="comma separated">Product Tags</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" name="p_tag" id="p_tag" class="form-control" placeholder="Product Tags" value="<?php echo $p_tag; ?>" >
                                                </div>
                                            </div>
                                            <!------- end : input group ------> 

                                        </div>
                                        <!-- End : tab-pane-General --> 

                                        <!-- Start : tab-pane Data -->
                                        <div class="tab-pane" id="tab-data"> 

                                            <!------- start : image group ------>
                                            <div class="form-group">
                                              <label class="col-sm-3 col-md-2 control-label" for="image">Image</label>
                                              <div class="col-sm-4 col-md-4"> <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                                <input type="hidden" name="image" value="<?php echo $config_image; ?>" id="input-image" />
                                              </div>
                                              <div class="clearfix"></div>
                                            </div>
                                            <!------- End : image group ------>
                                             <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="catalog_no" class="col-sm-3 col-md-2 control-label">Catalog Number</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="catalog_no" name="catalog_no" class="form-control" placeholder="Catalog Number" value="<?php echo $catalog_no; ?>">  
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 
                                             <!------- Start : input group ------>
                                            <div class="form-group required <?php if (form_error('catalog_product') !== "") { echo "has-error"; } ?>">
                                                <label class="col-sm-3 col-md-2 control-label" for="catalog_product"><span data-toggle="tooltip" title="" data-original-title="Product is display front side or not">Catalog Product</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <select name="catalog_product" id="catalog_product" class="form-control">
                                                       <option value="0">No</option>
                                                        <option value="1">Yes</option> 
                                                    </select>
                                                    <script>
                                                        $("#catalog_product").val(<?= isset($catalog_product) ? $catalog_product : '' ?>);
                                                    </script> 
                                                    <?php echo form_error('catalog_product', '<div class="text-danger">', '</div>'); ?>
                                                </div>

                                            </div>
                                            <!------- End : input group ------> 
                                            
                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="manufacturer_catalog_no" class="col-sm-3 col-md-2 control-label">Manufacturer Catalog Number</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="catalog_no" name="manufacturer_catalog_no" class="form-control" placeholder="Manufacturer Catalog Number" value="<?php echo $manufacturer_catalog_no; ?>">  
                                                </div>
                                            </div>
                                            <!------- End : input group ------>
                                            <!------- start : input group ------>
                                            <div class="form-group required <?php if (form_error('manufacturer_product_code') !== "") { echo "has-error"; } ?>">
                                                <label for="manufacturer_product_code" class="col-sm-3 col-md-2 control-label">Manufacturer Product Code</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="manufacturer_product_code" name="manufacturer_product_code" class="form-control" placeholder="Manufacturer Product Code" value="<?php echo $manufacturer_product_code; ?>">  
                                                    <?php echo form_error('manufacturer_product_code', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- End : input group ------>
                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="manufacturer_catalog_name" class="col-sm-3 col-md-2 control-label">Manufacture  Catalog Name</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="manufacurer_catalog_name" name="manufacurer_catalog_name" class="form-control" placeholder="Manufacturer Catalog Name" value="<?php echo $manufacturer_catalog_name; ?>">  
                                                </div>
                                            </div>
                                            <!------- End : input group ------>
                                            
                                            
                                            <!------- start : input group ------>
                                            <div class="form-group required <?php if (form_error('model') !== "") { echo "has-error";}?>">
                                                <label for="model" class="col-sm-3 col-md-2 control-label">Model</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="model" name="model" class="form-control" placeholder="Model" value="<?php echo $model; ?>">
                                                    <?php echo form_error('model', '<div class="text-danger">', '</div>'); ?> 
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="sku" class="col-sm-3 col-md-2 control-label"> <span data-toggle="tooltip" title="" data-original-title="Stock Keeping Unit">SKU</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" name="sku" id="sku" class="form-control" placeholder="SKU" value="<?php echo $sku; ?>">
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="upc" class="col-sm-3 col-md-2 control-label"> <span data-toggle="tooltip" title="" data-original-title="Universal Product Code">UPC</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="upc" name="upc" class="form-control" placeholder="UPC" value="<?php echo $upc ?>">
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="ean" class="col-sm-3 col-md-2 control-label"> <span data-toggle="tooltip" title="" data-original-title="European Article Number">EAN</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="ean" name="ean" class="form-control" placeholder="EAN" value="<?php echo $ean ?>">
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="jan" class="col-sm-3 col-md-2 control-label"> <span data-toggle="tooltip" title="" data-original-title="Japanese Article Number">JAN</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="jan" name="jan" class="form-control" placeholder="JAN" value="<?php echo $jan ?>">
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="isbn" class="col-sm-3 col-md-2 control-label"> <span data-toggle="tooltip" title="" data-original-title="International Standard Book Number">ISBN</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="isbn" name="isbn" class="form-control" placeholder="ISBN" value="<?php echo $isbn; ?>">
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="mpn" class="col-sm-3 col-md-2 control-label"> <span data-toggle="tooltip" title="" data-original-title="Manufacturer Part Number">MPN</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="mpn" name="mpn" class="form-control" placeholder="MPN" value="<?php echo $mpn; ?>">
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="location" class="col-sm-3 col-md-2 control-label">Location</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="location" name="location" class="form-control" placeholder="Location" value="<?php echo $location; ?>">
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                              <!------- start : input group ------>
                                            <div class="form-group required <?php if (form_error('manufacturer_price') !== "") { echo "has-error"; } ?>">
                                                <label for="manufacturer_price" class="col-sm-3 col-md-2 control-label">Manufacturer Price</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="manufacturer_price" name="manufacturer_price" class="form-control" placeholder="Manufacturer Price" value="<?php echo $manufacturer_price; ?>">
                                                    <?php echo form_error('manufacturer_price', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- End : input group ------>
                                            <!------- start : input group ------>
                                            <div class="form-group <?php if (form_error('price') !== "") { echo "has-error"; } ?>">
                                                <label for="price" class="col-sm-3 col-md-2 control-label">Price</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="price" name="price" class="form-control" placeholder="Price" value="<?php echo $price; ?>">
                                                    <?php echo form_error('price', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-2 control-label" for="tax_class">Tax Class</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <select name="tax_class_id" id="tax_class" class="form-control">
                                                        <option value="0"> ---None--- </option>
                                                        <?php foreach($tax_classes as $tax_class) { ?>
                                                            <?php if($tax_class['tax_class_id'] == $tax_class_id) { ?>
                                                        <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                                                            <?php } else { ?>
                                                        <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                    <script>
                                                        $("#tax_class_id").val(<?= isset($tax_class_id) ? $tax_class_id : '' ?>);
                                                    </script> 
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group <?php if (form_error('qty') !== "") { echo "has-error"; } ?> ">
                                                <label for="qty" class="col-sm-3 col-md-2 control-label">Quantity</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="qty" name="qty" class="form-control" value="<?php echo $qty; ?>" placeholder="Quantity">
                                                    <?php echo form_error('qty', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group <?php if (form_error('m_qty') !== "") { echo "has-error"; } ?> ">
                                                <label for="m_qty" class="col-sm-3 col-md-2 control-label"> <span data-toggle="tooltip" title="" data-original-title="Force a minimum ordered amount">Minimum Quantity</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="m_qty" name="m_qty" class="form-control" value="<?php echo $m_qty; ?>" placeholder="Minimum Quantity">
                                                    <?php echo form_error('m_qty', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-2 control-label" for="sub">Subtract Stock</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <select name="subtract" id="subtract" class="form-control">
<?php if ($subtract) { ?>
                                                            <option value="1" selected="selected">Yes</option>
                                                            <option value="0">No</option>
<?php } else { ?>
                                                            <option value="1">Yes</option>
                                                            <option value="0" selected="selected">No</option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 
                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="stock_status_id" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Status shown when a product is out of stock">Out Of Stock Status</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <select name="stock_status_id" id="input-stock-status" class="form-control">
<?php foreach ($stock_statuses as $stock_status) { ?>
    <?php if ($stock_status['stock_status_id'] == $stock_status_id) { ?>
                                                                <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['stock_status_name']; ?></option>
    <?php } else { ?>
                                                                <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['stock_status_name']; ?></option>
    <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group <?php if (form_error('shipping') !== "") { echo "has-error"; } ?>">
                                                <label for="shipping" class="col-sm-3 col-md-2 control-label">Requires Shipping</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <label>
                                                        <?php if ($shipping) { ?>
                                                            <input type="radio" id="shipping-yes" name="shipping" class="minimal" value="1" checked="checked">&nbsp;&nbsp;Yes&nbsp;&nbsp;
<?php } else { ?>
                                                            <input type="radio" id="shipping-yes" name="shipping" value="1" class="minimal">&nbsp;&nbsp;Yes&nbsp;&nbsp;
<?php } ?>
                                                    </label>
                                                    <label>
<?php if (!$shipping) { ?>
                                                            <input type="radio" id="shipping-no" name="shipping" value="0" class="minimal" checked="checked">&nbsp;&nbsp;No 
<?php } else { ?>
                                                            <input type="radio" id="shipping-no" name="shipping" value="0" class="minimal">&nbsp;&nbsp;No
<?php } ?>
                                                    </label>
                                                    <?php echo form_error('shipping', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group required <?php if (form_error('seo_url') !== "") { echo "has-error"; } ?>">
                                                <label for="seo_url" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="Do not use spaces, instead replace spaces with - and make sure the SEO URL is globally unique.">SEO URL</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="seo_url" name="seo_url" class="form-control" value="<?php echo $seo_url; ?>" placeholder="SEO URL">
                                                    <?php echo form_error('seo_url', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            
                                            
                                            <div class="form-group">
                                                <label for="date_available" class="col-sm-3 col-md-2 control-label">Date Available</label>
                                                <div class="col-sm-4 col-md-4">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control pull-right" id="input-date-available" value="<?php echo $date_available; ?>" name="date_available">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default" type="button"> <i class="fa fa-calendar"></i> </button>
                                                        </span> </div>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group <?php if (form_error('length') !== "" || form_error('width') !== "" || form_error('height') !== "") { echo "has-error"; } ?>">
                                                <label class="col-sm-3 col-md-2 control-label" for="lwh">Dimensions (L x W x H)</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <input type="text" id="length" name="length" value="<?php echo $length; ?>" placeholder="Length" class="form-control">
                                                            <?php echo form_error('length', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" id="width" name="width" value="<?php echo $width; ?>" placeholder="Width" class="form-control">
                                                            <?php echo form_error('width', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" id="height" name="height" value="<?php echo $height; ?>" placeholder="Height" class="form-control">
                                                            <?php echo form_error('height', '<div class="text-danger">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-2 control-label" for="length_class">Length Class</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <select name="length_class" id="input-length-class" class="form-control">
                    <?php foreach ($length_classes as $length_class) { ?>
                    <?php if ($length_class['length_id'] == $length_class) { ?>
                    <option value="<?php echo $length_class['length_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $length_class['length_id']; ?>"><?php echo $length_class['title']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group <?php if (form_error('weight') !== "") { echo "has-error"; } ?>">
                                                <label class="col-sm-3 col-md-2 control-label" for="weight">Weight</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="weight" name="weight" placeholder="Weight" value="<?php echo $weight; ?>" class="form-control">
                                                    <?php echo form_error('weight', '<div class="text-danger">', '</div>'); ?>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-2 control-label" for="weight_class">Weight Class</label>
                                             <div class="col-sm-9 col-md-10">
                                                       <select name="weight_class" id="input-weight-class" class="form-control">
                    <?php foreach ($weight_classes as $weight_class) { ?>
                    <?php if ($weight_class['weight_id'] == $weight_class) { ?>
                    <option value="<?php echo $weight_class['weight_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $weight_class['weight_id']; ?>"><?php echo $weight_class['title']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- Start : input group ------>
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-2 control-label" for="status">Status</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <select name="status" id="status" class="form-control">
                                                        <?php if ($status) { ?>
                                                            <option value="0">Disabled</option>
                                                            <option value="1" selected="selected">Enabled</option>
                                                        <?php } else { ?>
                                                            <option value="0" selected="selected">Disabled</option>
                                                            <option value="1">Enabled</option>
                                                        <?php } ?>
                                                    </select>
                                                    <script>
                                                        $("#status").val(<?= isset($status) ? $status : '' ?>);
                                                    </script> 
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 


                                            <!------- End : input group ------>
                                            <div class="form-group">
                                                <label class="col-sm-3 col-md-2 control-label" for="sort_order">Sort Order</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="sort_order" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="Sort Order" class="form-control">
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 
                                            <?php if($this->session->userdata('role_id')== 1) { ?>
                                            <!------- start : Select group ------>
                                            <div class="form-group">
                                              <label class="col-sm-3 col-md-2 control-label" for="status">Soft Deleted</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="checkbox" name="is_deleted" onclick="checkAddress(this)" id="is_deleted" value="<?php echo $is_deleted; ?>" <?php if($is_deleted==1) echo 'checked'; ?> />                 
                                                    <script type="text/javascript">
                                                          function checkAddress(checkbox)
                                                          {
                                                              if (checkbox.checked)
                                                              {
                                                                  $("#is_deleted").val("1");
                                                              }
                                                              else
                                                              {
                                                                  $("#is_deleted").val("0");
                                                              }
                                                          }
                                                    </script>
                                                </div>
                                            </div>
                                            <!------- End : Select group ------>
                                            <?php } ?>
                                        </div>
                                        <!-- End : tab-pane- Data --> 

                                        <!-- Start : tab-pane -->
                                        <div class="tab-pane" id="tab-links"> 
                                            <!------- Start : input group ------>
                                            <div class="form-group">
                                                <label for="input-manufacturer" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="(Auto Complete)">Manufacturer Name</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" name="manufacturer" value="<?php echo $manufacturer ?>" placeholder="Manufecturer" id="input-manufacturer" class="form-control" />
                                                    <input type="hidden" name="manufacturer_id" value="<?php echo $manufacturer_id ?>" />
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- Start : input group ------>
                                            <div class="form-group">
                                                <label for="categories" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="(Auto Complete)">Category</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="category_name" name="category_name" value="" class="form-control" placeholder="Categories">
                                                    <div id="product-category" class="well well-sm" style="height: 150px; overflow: auto;">
<?php foreach ($product_category as $product_category) { ?>
                                                            <div id="product-category<?php echo $product_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_category['category_name']; ?>
                                                                <input type="hidden" name="product_category[]" value="<?php echo $product_category['category_id']; ?>" />
                                                            </div>
<?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------- End : input group ------>

                                            <!------- Start : input group ------>
                                            <div class="form-group">
                                                <label for="filters" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="(Auto Complete)">Filters</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="filter_name" name="filter_name" class="form-control" placeholder="Filters">
                                                    <div id="product-filter" class="well well-sm" style="height: 150px; overflow: auto;">
<?php foreach ($product_filters as $product_filter) { ?>
                                                            <div id="product-category<?php echo $product_filter['filter_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_filter['filter_name']; ?>
                                                                <input type="hidden" name="product_filter[]" value="<?php echo $product_filter['filter_id']; ?>" />
                                                            </div>
<?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 
                                            
                                             <!------- Start : input group ------>
                                            <div class="form-group">
                                                <label for="download" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="(Auto Complete)">Downloads</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="filter_name" name="download_name" class="form-control" placeholder="Downloads">
                                                    <div id="product-download" class="well well-sm" style="height: 150px; overflow: auto;">
<?php foreach ($product_downloads as $product_download) { ?>
                                                            <div id="product-download<?php echo $product_download['download_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_download['name']; ?>
                                                                <input type="hidden" name="product_download[]" value="<?php echo $product_download['download_id']; ?>" />
                                                            </div>
<?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 

                                            <!------- start : input group ------>
                                            <div class="form-group">
                                                <label for="rel_products" class="col-sm-3 col-md-2 control-label"><span data-toggle="tooltip" title="" data-original-title="(Auto Complete)">Related Products</span></label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input type="text" id="related" name="related" class="form-control" placeholder="Related Products">
                                                    <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
<?php foreach ($product_relateds as $product_related) { ?>
                                                            <div id="product-related<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['product_name']; ?>
                                                                <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                                                            </div>
<?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------- End : input group ------> 
                                        </div>
                                        <!-- End : tab-pane-Links --> 

                                        <!-- Start : tab-pane -->
                                        <div class="tab-pane" id="tab-attribute">
                                            <div class="table-responsive table-padding">
                                                <table class="table table-striped table-bordered table-hover table-padding" id="attribute">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-left col-sm-2">Attribute</td>
                                                            <td class="text-left">Text</td>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $attribute_row = 0; ?>
                                                        <?php foreach ($product_attributes as $product_attribute) { ?>
                                                        <tr id="attribute-row<?php echo $attribute_row; ?>">
                                                          <td class="text-left" style="width: 40%;"><input type="text" name="product_attribute[<?php echo $attribute_row; ?>][attribute_name]" value="<?php echo $product_attribute['attribute_name']; ?>" placeholder="Attribute" class="form-control" />
                                                            <input type="hidden" name="product_attribute[<?php echo $attribute_row; ?>][attribute_id]" value="<?php echo $product_attribute['attribute_id']; ?>" /></td>
                                                          <td class="text-left">
                                                            <div class="input-group"><span class="input-group-addon"><img src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/images/gb.png" title="English"/></span>
                                                              <textarea name="product_attribute[<?php echo $attribute_row; ?>][text]" rows="5" placeholder="Text" class="form-control"><?php echo isset($product_attribute['text']) ? $product_attribute['text']: ''; ?></textarea>
                                                            </div>
                                                            </td>
                                                          <td class="text-left"><button type="button" onclick="$('#attribute-row<?php echo $attribute_row; ?>').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-minus-circle"></i></button></td>
                                                        </tr>
                                                        <?php $attribute_row++; ?>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <td colspan="2"></td>
                                                    <td class="text-left"><button class="btn btn-primary" id="add" name="add" type="button" data-original-title="Add" data-toggle="tooltip" onClick="addattribute()"> <i class="fa fa-plus-circle"></i> </button></td>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- End : tab-pane- Attribute --> 

                                        <!-- Start : tab-pane -->
                                        <div class="tab-pane" id="tab-option">
                                            <div class="row">
                                              <div class="col-sm-2">
                                                <ul class="nav nav-pills nav-stacked" id="option">
                                                  <?php $option_row = 0; ?>
                                                  <?php foreach ($product_options as $product_option) { ?>
                                                        <li><a href="#tab-option<?php echo $option_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('a[href=\'#tab-option<?php echo $option_row; ?>\']').parent().remove(); $('#tab-option<?php echo $option_row; ?>').remove(); $('#option a:first').tab('show');"></i> <?php echo $product_option['name']; ?></a></li>
                                                  <?php $option_row++; ?>
                                                  <?php } ?>
                                                  <li>
                                                    <input type="text" name="option" value="" placeholder="Options" id="input-option" class="form-control" />
                                                  </li>
                                                </ul>
                                              </div>
                                              <div class="col-sm-10">
                                                <div class="tab-content">
                                                  <?php $option_row = 0; ?>
                                                  <?php $option_value_row = 0; ?>
                                                  <?php foreach ($product_options as $product_option) { ?>
                                                  <div class="tab-pane" id="tab-option<?php echo $option_row; ?>">
                                                    <input type="hidden" name="product_option[<?php echo $option_row; ?>][product_option_id]" value="<?php echo $product_option['product_option_id']; ?>" />
                                                    <input type="hidden" name="product_option[<?php echo $option_row; ?>][name]" value="<?php echo $product_option['name']; ?>" />
                                                    <input type="hidden" name="product_option[<?php echo $option_row; ?>][option_id]" value="<?php echo $product_option['option_id']; ?>" />
                                                    <input type="hidden" name="product_option[<?php echo $option_row; ?>][type]" value="<?php echo $product_option['type']; ?>" />
                                                    <div class="form-group">
                                                      <label class="col-sm-2 control-label" for="input-required<?php echo $option_row; ?>">Required</label>
                                                      <div class="col-sm-10">
                                                        <select name="product_option[<?php echo $option_row; ?>][required]" id="input-required<?php echo $option_row; ?>" class="form-control">
                                                          <?php if ($product_option['required']) { ?>
                                                          <option value="1" selected="selected">Yes</option>
                                                          <option value="0">No</option>
                                                          <?php } else { ?>
                                                          <option value="1">Yes</option>
                                                          <option value="0" selected="selected">No</option>
                                                          <?php } ?>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <?php if ($product_option['type'] == 'text') { ?>
                                                    <div class="form-group">
                                                      <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>">Option Value</label>
                                                      <div class="col-sm-10">
                                                        <input type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" placeholder="Option Value" id="input-value<?php echo $option_row; ?>" class="form-control" />
                                                      </div>
                                                    </div>
                                                    <?php } ?>
                                                    <?php if ($product_option['type'] == 'textarea') { ?>
                                                    <div class="form-group">
                                                      <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>">Option Value</label>
                                                      <div class="col-sm-10">
                                                        <textarea name="product_option[<?php echo $option_row; ?>][value]" rows="5" placeholder="Option Value" id="input-value<?php echo $option_row; ?>" class="form-control"><?php echo $product_option['value']; ?></textarea>
                                                      </div>
                                                    </div>
                                                    <?php } ?>
                                                    <?php if ($product_option['type'] == 'file') { ?>
                                                    <div class="form-group" style="display: none;">
                                                      <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>">Option Value</label>
                                                      <div class="col-sm-10">
                                                        <input type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" placeholder="Option Value" id="input-value<?php echo $option_row; ?>" class="form-control" />
                                                      </div>
                                                    </div>
                                                    <?php } ?>
                                                    <?php if ($product_option['type'] == 'date') { ?>
                                                    <div class="form-group">
                                                      <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>">Option Value</label>
                                                      <div class="col-sm-3">
                                                        <div class="input-group date">
                                                          <input type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" placeholder="Option Value" data-date-format="YYYY-MM-DD" id="input-value<?php echo $option_row; ?>" class="form-control date-start" />
                                                          <span class="input-group-btn">
                                                          <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                          </span></div>
                                                      </div>
                                                    </div>
                                                    <?php } ?>
                                                    <?php if ($product_option['type'] == 'time') { ?>
                                                    <div class="form-group">
                                                      <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>">Option Value</label>
                                                      <div class="col-sm-10">
                                                        <div class="bootstrap-timepicker">
                                                        <div class="input-group">
                                                          <input type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" placeholder="Option Value"  id="input-value<?php echo $option_row; ?>" class="form-control timepicker" />
                                                          <span class="input-group-btn">
                                                          <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                                                          </span></div></div>
                                                      </div>
                                                    </div>
                                                    <?php } ?>
                                                    <?php if ($product_option['type'] == 'datetime') { ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>">Option Value</label>
                                                        <div id="datetimepicker1" class="col-sm-10 datetimepicker1 input-append date">
                                                            <input size="16" type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" id="input-value<?php echo $option_row; ?>" class="form-control add-on" data-format="dd/MM/yyyy hh:mm:ss"></input>
                                                        </div>
                                                    </div>
                                                    <!--<div class="form-group">
                                                        <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>">Option Value</label>
                                                        <div class="col-sm-10 input-append date form_datetime">
                                                            <input size="16" type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" id="input-value<?php echo $option_row; ?>" readonly class="form-control ">
                                                                <span class="add-on"><i class="icon-th"></i></span>
                                                        </div>
                                                    </div>-->
                                                    <!--<div class="form-group">
                                                        <label class="col-sm-2 control-label" for="input-value<?php echo $option_row; ?>">Option Value</label>
                                                        <div class="col-sm-10 input-append date form_datetime">
                                                            <input size="16" type="text" name="product_option[<?php echo $option_row; ?>][value]" value="<?php echo $product_option['value']; ?>" placeholder="Option Value" id="input-value<?php echo $option_row; ?>" readonly class="form-control ">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>-->
                                                    
                                                    <?php } ?>
                                                    <?php if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') { ?>
                                                    <div class="table-responsive">
                                                      <table id="option-value<?php echo $option_row; ?>" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                          <tr>
                                                            <td class="text-left">Option Value</td>
                                                            <td class="text-right">Quantity</td>
                                                            <td class="text-left">Subtract</td>
                                                            <td class="text-right">Price</td>
                                                            <td class="text-right">Points</td>
                                                            <td class="text-right">Weight</td>
                                                            <td></td>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <?php foreach ($product_option['product_option_value'] as $product_option_value) { ?>
                                                          <tr id="option-value-row<?php echo $option_value_row; ?>">
                                                            <td class="text-left"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][option_value_id]" class="form-control">
                                                                <?php if (isset($option_values[$product_option['option_id']])) { ?>
                                                                <?php foreach ($option_values[$product_option['option_id']] as $option_value) { ?>
                                                                <?php if ($option_value['option_value_id'] == $product_option_value['option_value_id']) { ?>
                                                                <option value="<?php echo $option_value['option_value_id']; ?>" selected="selected"><?php echo $option_value['name']; ?></option>
                                                                <?php } else { ?>
                                                                <option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>
                                                                <?php } ?>
                                                                <?php } ?>
                                                                <?php } ?>
                                                              </select>
                                                              <input type="hidden" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][product_option_value_id]" value="<?php echo $product_option_value['product_option_value_id']; ?>" /></td>
                                                            <td class="text-right"><input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][quantity]" value="<?php echo $product_option_value['quantity']; ?>" placeholder="Quantity" class="form-control" /></td>
                                                            <td class="text-left"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][subtract]" class="form-control">
                                                                <?php if ($product_option_value['subtract']) { ?>
                                                                <option value="1" selected="selected">Yes</option>
                                                                <option value="0">No</option>
                                                                <?php } else { ?>
                                                                <option value="1">Yes</option>
                                                                <option value="0" selected="selected">No</option>
                                                                <?php } ?>
                                                              </select></td>
                                                            <td class="text-right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price_prefix]" class="form-control">
                                                                <?php if ($product_option_value['price_prefix'] == '+') { ?>
                                                                <option value="+" selected="selected">+</option>
                                                                <?php } else { ?>
                                                                <option value="+">+</option>
                                                                <?php } ?>
                                                                <?php if ($product_option_value['price_prefix'] == '-') { ?>
                                                                <option value="-" selected="selected">-</option>
                                                                <?php } else { ?>
                                                                <option value="-">-</option>
                                                                <?php } ?>
                                                              </select>
                                                              <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price]" value="<?php echo $product_option_value['price']; ?>" placeholder="Price" class="form-control" /></td>
                                                            <td class="text-right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points_prefix]" class="form-control">
                                                                <?php if ($product_option_value['points_prefix'] == '+') { ?>
                                                                <option value="+" selected="selected">+</option>
                                                                <?php } else { ?>
                                                                <option value="+">+</option>
                                                                <?php } ?>
                                                                <?php if ($product_option_value['points_prefix'] == '-') { ?>
                                                                <option value="-" selected="selected">-</option>
                                                                <?php } else { ?>
                                                                <option value="-">-</option>
                                                                <?php } ?>
                                                              </select>
                                                              <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points]" value="<?php echo $product_option_value['points']; ?>" placeholder="Points" class="form-control" /></td>
                                                            <td class="text-right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight_prefix]" class="form-control">
                                                                <?php if ($product_option_value['weight_prefix'] == '+') { ?>
                                                                <option value="+" selected="selected">+</option>
                                                                <?php } else { ?>
                                                                <option value="+">+</option>
                                                                <?php } ?>
                                                                <?php if ($product_option_value['weight_prefix'] == '-') { ?>
                                                                <option value="-" selected="selected">-</option>
                                                                <?php } else { ?>
                                                                <option value="-">-</option>
                                                                <?php } ?>
                                                              </select>
                                                              <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight]" value="<?php echo $product_option_value['weight']; ?>" placeholder="Weight" class="form-control" /></td>
                                                            <td class="text-left"><button type="button" onclick="$(this).tooltip('destroy');$('#option-value-row<?php echo $option_value_row; ?>').remove();" data-toggle="tooltip" title="" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                                          </tr>
                                                          <?php $option_value_row++; ?>
                                                          <?php } ?>
                                                        </tbody>
                                                        <tfoot>
                                                          <tr>
                                                            <td colspan="6"></td>
                                                            <td class="text-left"><button type="button" onclick="addOptionValue('<?php echo $option_row; ?>');" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                                          </tr>
                                                        </tfoot>
                                                      </table>
                                                    </div>
                                                    <select id="option-values<?php echo $option_row; ?>" style="display: none;">
                                                      <?php if (isset($option_values[$product_option['option_id']])) { ?>
                                                      <?php foreach ($option_values[$product_option['option_id']] as $option_value) { ?>
                                                      <option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>
                                                      <?php } ?>
                                                      <?php } ?>
                                                    </select>
                                                    <?php } ?>
                                                  </div>
                                                  <?php $option_row++; ?>
                                                  <?php } ?>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        <!-- End : tab-pane- Option --> 

                                        <!-- Start : tab-pane -->
                                        <div class="tab-pane" id="tab-discount">
                                            <div class="table-responsive table-padding">
                                                <table class="table table-striped table-bordered table-hover table-padding" id="discount">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-left">Customer Group</td>
                                                            <td class="text-left">Quantity</td>
                                                            <td class="text-left">Priority</td>
                                                            <td class="text-left">Price</td>
                                                            <td class="text-left col-sm-2">Date Start</td>
                                                            <td class="text-left col-sm-2">Date End</td>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php $discount_row = 0; ?>
<?php foreach ($product_discounts as $product_discount) { ?>
                                                            <tr id="discount-row<?php echo $discount_row; ?>">
                                                                <td class="text-left"><select name="product_discount[<?php echo $discount_row; ?>][customer_group_id]" class="form-control">
                                                            <?php foreach ($customer_groups as $customer_group) { ?>
                                                                <?php if ($customer_group['customer_group_id'] == $product_discount['customer_group_id']) { ?>
                                                                                <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['group_name']; ?></option>
        <?php } else { ?>
                                                                                <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['group_name']; ?></option>
        <?php } ?>
    <?php } ?>
                                                                    </select></td>
                                                                <td class="text-right"><input type="text" id="product_discount[<?php echo $discount_row; ?>][quantity]" name="product_discount[<?php echo $discount_row; ?>][quantity]" value="<?php echo $product_discount['quantity']; ?>" placeholder="Quantity" class="form-control" /></td>
                                                                <td class="text-right"><input type="text" id="product_discount[<?php echo $discount_row; ?>][priority]" name="product_discount[<?php echo $discount_row; ?>][priority]" value="<?php echo $product_discount['priority']; ?>" placeholder="Priority" class="form-control" /></td>
                                                                <td class="text-right"><input type="text" id="product_discount[<?php echo $discount_row; ?>][price]" name="product_discount[<?php echo $discount_row; ?>][price]" value="<?php echo $product_discount['price']; ?>" placeholder="Price" class="form-control" /></td>
                                                                <td class="text-left"><div class="input-group date">
                                                                        <input type="text" id="product_discount[<?php echo $discount_row; ?>][date_start]" name="product_discount[<?php echo $discount_row; ?>][date_start]" value="<?php echo $product_discount['date_start']; ?>" placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control date-start" />
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                                        </span></div></td>
                                                                <td class="text-left" ><div class="input-group date">
                                                                        <input type="text" id="product_discount[<?php echo $discount_row; ?>][date_end]" name="product_discount[<?php echo $discount_row; ?>][date_end]" value="<?php echo $product_discount['date_end']; ?>" placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control date-end" />
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                                        </span></div></td>
                                                                <td class="text-left"><button type="button" onclick="$('#discount-row<?php echo $discount_row; ?>').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-minus-circle"></i></button></td>
                                                            </tr>
    <?php $discount_row++; ?>
<?php } ?> 
                                                    </tbody>
                                                    <tfoot>
                                                    <td colspan="6"></td>
                                                    <td class="text-left"><button class="btn btn-primary" id="add_discount" name="add_discount" type="button" data-original-title="Add" data-toggle="tooltip" onClick="addDiscount()"> <i class="fa fa-plus-circle"></i> </button></td>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- End : tab-pane- Discount --> 

                                        <!-- Start : tab-pane -->
                                        <div class="tab-pane" id="tab-special">
                                            <div class="table-responsive table-padding">
                                                <table class="table table-striped table-bordered table-hover table-padding" id="special">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-left">Customer Group</td>
                                                            <td class="text-left">Priority</td>
                                                            <td class="text-left">Price</td>
                                                            <td class="text-left">Date Start</td>
                                                            <td class="text-left">Date End</td>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $special_row = 0; ?>
                                                            <?php foreach ($product_specials as $product_special) { ?>
                                                            <tr id="special-row<?php echo $special_row; ?>">
                                                                <td class="text-left"><select name="product_special[<?php echo $special_row; ?>][customer_group_id]" class="form-control">
                                                                        <?php foreach ($customer_groups as $customer_group) { ?>
                                                                            <?php if ($customer_group['customer_group_id'] == $product_special['customer_group_id']) { ?>
                                                                                <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['group_name']; ?></option>
                                                                            <?php } else { ?>
                                                                                <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['group_name']; ?></option>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </select></td>
                                                                <td class="text-right"><input type="text" name="product_special[<?php echo $special_row; ?>][priority]" value="<?php echo $product_special['priority']; ?>" placeholder="Priority" class="form-control" /></td>
                                                                <td class="text-right"><input type="text" name="product_special[<?php echo $special_row; ?>][price]" value="<?php echo $product_special['price']; ?>" placeholder="Price" class="form-control" /></td>
                                                                <td class="text-left" style="width: 20%;"><div class="input-group date">
                                                                        <input type="text" name="product_special[<?php echo $special_row; ?>][date_start]" value="<?php echo $product_special['date_start']; ?>" placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control date-start" />
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                                        </span></div></td>
                                                                <td class="text-left" style="width: 20%;"><div class="input-group date">
                                                                        <input type="text" name="product_special[<?php echo $special_row; ?>][date_end]" value="<?php echo $product_special['date_end']; ?>" placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control date-end" />
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                                        </span></div></td>
                                                                <td class="text-left"><button type="button" onclick="$('#special-row<?php echo $special_row; ?>').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-minus-circle"></i></button></td>
                                                            </tr>
                                                            <?php $special_row++; ?>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <td colspan="5"></td>
                                                    <td class="text-left"><button class="btn btn-primary" id="add_special" name="add_special" type="button" data-original-title="Add" data-toggle="tooltip" onClick="addSpecial()"> <i class="fa fa-plus-circle"></i> </button></td>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- End : tab-pane- Special --> 

                                        <!-- Start tab-pane -->
                                        <div class="tab-pane" id="tab-image">
                                            <div class="table-responsive">
                                                <table id="images" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-left">Thumbnail</td>
                                                            <td class="text-left">Sort Order</td>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $image_row = 0; ?>
                                                        <?php foreach ($product_images as $product_image) { ?>
                                                        <tr id="image-row<?php echo $image_row; ?>">
                                                          <td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $product_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="product_image[<?php echo $image_row; ?>][image]" value="<?php echo $product_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
                                                          <td class="text-right"><input type="text" name="product_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $product_image['sort_order']; ?>" placeholder="Sort Order" class="form-control" /></td>
                                                          <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-minus-circle"></i></button></td>
                                                        </tr>
                                                        <?php $image_row++; ?>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="2"></td>
                                                            <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane --> 
                                    </div>
                                    <!-- /.tab-content -->

                                </div>
                                <!-- nav-tabs-custom --> 
                            </div></form>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        
    </section>
    <!----------------------- Main content ------------------------------->
</div>
<!------------------- End content-wrapper ----------------------------> 

<script type="text/javascript" src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"></script> 
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/js/common.js"></script>
<script>
//Manufacturer
            $('input[name=\'manufacturer\']').autocomplete({
                'source': function (request, response) {
                    $.ajax({
                        url: "<?php echo base_url('catalog/manufacturers/autocomplete/') ?>",
                        dataType: 'json',
                        type: 'POST',
                        data: {'manufacturer': request},
                        success: function (json) {
                            response($.map(json, function (item) {
                                return {
                                    label: item['name'],
                                    value: item['manufacturer_id']
                                }
                            }));
                        }
                    });
                },
                'select': function (item) {
                    $('input[name=\'manufacturer\']').val(item['label']);
                    $('input[name=\'manufacturer_id\']').val(item['value']);
                }
            });

// Category
            $('input[name=\'category_name\']').autocomplete({
                'source': function (request, response) {
                    $.ajax({
                        url: "<?php echo base_url('catalog/category/autocomplete/') ?>",
                        dataType: 'json',
                        type: 'POST',
                        data: {'category_name': request},
                        success: function (json) {
                            response($.map(json, function (item) {
                                return {
                                    label: item['category_name'],
                                    value: item['category_id']
                                }
                            }));
                        }
                    });
                },
                'select': function (item) {
                    $('input[name=\'category_name\']').val('');

                    $('#product-category' + item['value']).remove();

                    $('#product-category').append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_category[]" value="' + item['value'] + '" /></div>');
                }
            });

            $('#product-category').delegate('.fa-minus-circle', 'click', function () {
                $(this).parent().remove();
            });

// Filter
            $('input[name=\'filter_name\']').autocomplete({
                'source': function (request, response) {
                    $.ajax({
                        url: "<?php echo base_url('catalog/filter/filter_autocomplete/') ?>",
                        dataType: 'json',
                        type: 'POST',
                        data: {'filter_name': request},
                        success: function (json) {
                            response($.map(json, function (item) {
                                return {
                                    label: item['filter_name'],
                                    value: item['filter_id']
                                }
                            }));
                        }
                    });
                },
                'select': function (item) {
                    $('input[name=\'filter_name\']').val('');

                    $('#product-filter' + item['value']).remove();

                    $('#product-filter').append('<div id="product-filter' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_filter[]" value="' + item['value'] + '" /></div>');
                }
            });

            $('#product-filter').delegate('.fa-minus-circle', 'click', function () {
                $(this).parent().remove();
            });
            
// Downloads
            $('input[name=\'download_name\']').autocomplete({
                'source': function (request, response) {
                    $.ajax({
                        url: "<?php echo base_url('catalog/downloads/autocomplete/') ?>",
                        dataType: 'json',
                        type: 'POST',
                        data: {'download_name': request},
                        success: function (json) {
                            response($.map(json, function (item) {
                                return {
                                    label: item['name'],
                                    value: item['download_id']
                                }
                            }));
                        }
                    });
                },
                'select': function (item) {
                    $('input[name=\'download_name\']').val('');

                    $('#product-download' + item['value']).remove();

                    $('#product-download').append('<div id="product-download' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_download[]" value="' + item['value'] + '" /></div>');
                }
            });

            $('#product-download').delegate('.fa-minus-circle', 'click', function () {
                $(this).parent().remove();
            });

// Product Related
            $('input[name=\'related\']').autocomplete({
                'source': function (request, response) {
                    $.ajax({
                        url: "<?php echo base_url('catalog/product/autocomplete/') ?>",
                        dataType: 'json',
                        type: 'POST',
                        data: {'product_name': request},
                        success: function (json) {
                            response($.map(json, function (item) {
                                return {
                                    label: item['product_name'],
                                    value: item['product_id']
                                }
                            }));
                        }
                    });
                },
                'select': function (item) {
                    $('input[name=\'related\']').val('');

                    $('#product-related' + item['value']).remove();

                    $('#product-related').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_related[]" value="' + item['value'] + '" /></div>');
                }
            });

            $('#product-related').delegate('.fa-minus-circle', 'click', function () {
                $(this).parent().remove();
            });
</script>

<script>/*$("textarea").tagsinput('items')*/</script> 
<script type="text/javascript">
    //Initializa Summernote
    $('#input-description').summernote({height: 300});

    //Initialize Select2 Elements
    $(".select2").select2();

    //Date picker
    $('#input-date-available').datepicker({
        todayHighlight:true,
        startDate: "+0d",
        format: "yyyy-mm-dd",
        autoclose: true
    });
 
    $('.date-start').datepicker({
            todayHighlight:true,
            startDate: "+0d",
            format:"yyyy-mm-dd",
            autoclose: true,
        });
        
        //$('.date-start').change(function(){
        //    $('.date-end').val($('.date-start').val());
        //});
        //alert($('.date-end').val($('.date-start').val()));
        //var endDate = $('.date-end').val($('.date-start').val());
       
        $('.date-end').datepicker({
            todayHighlight:true,
            startDate: "+0d",
            format:"yyyy-mm-dd",
            autoclose: true,
        });
    
    /*$('.date').datepicker({
            format:"yyyy-mm-dd",
            autoclose: true
    });*/
    
    $(".timepicker").timepicker({
        showInputs: false
    });
   
    //DateTime
    $(".datetimepicker1").datetimepicker({
        todayHighlight:true,
        startDate: "+0d",
                    format:"yyyy-MM-dd hh:mm:ss",
    });

   

    
    //iCheck for checkbox and radio inputs
    /*$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });*/


    var elem = '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
    $('[data-toggle="popover"]').popover({animation: true, content: elem, html: true});


    /* Start : image preview script */

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#show-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".img-select-data").change(function () {
        readURL1(this);
    });
    /* End : image preview script */

</script> 
<script type="text/javascript">
var image_row = <?php echo $image_row; ?>;
var baseurl = "<?php print base_url(); ?>";

function addImage() {

        html = '<tr id="image-row' + image_row + '">';
        html += '<td class="text-left" ><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="your image" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
        html += '<td class="text-right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control" /></td>';

        html += '<td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row + '\').remove();" data-toggle="tooltip" title="" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

        html += '</tr>';
        
        $('#images tbody').append(html);
        
        image_row++;
        
        //$(":file").filestyle();  // initialize file style css

    }
</script> 
<script type="text/javascript">

    var attribute_row = <?php echo $attribute_row; ?>;

    function addattribute() {
        html = '<tr id="attribute-row' + attribute_row + '">';
        html += '<td><input type="text" id="product_attribute[' + attribute_row + '][attribute_name]" name="product_attribute[' + attribute_row + '][attribute_name]" placeholder="Attribute" class="form-control" />   <input type="hidden" id="product_attribute[' + attribute_row + '][attribute_id]" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';

        html += '<td class="col-sm-8 text-left">';
        html += '<div class="input-group"><span class="input-group-addon"><img src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/images/gb.png" title="English" /></span><textarea id="product_attribute[' + attribute_row + '][text]" name="product_attribute[' + attribute_row + '][text]" rows="5" placeholder="Text" class="form-control"></textarea></div>';
        html += '  </td>';

        html += '<td class="text-left"><button type="button" onclick="$(\'#attribute-row' + attribute_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#attribute tbody').append(html);
        
        attributeautocomplete(attribute_row);
        
        attribute_row++;
        
        
    }
    
function attributeautocomplete(attribute_row) {

    $('input[name=\'product_attribute[' + attribute_row + '][attribute_name]\']').autocomplete({
        'source': function(request, response) {
            $.ajax({
                url: "<?php echo base_url('catalog/attributes/autocomplete/') ?>",
                                dataType: 'json',
                                        type: 'POST',
                                        data: {'attribute_name': request},
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            category: item['attribute_group'],
                            label: item['attribute_name'],
                            value: item['attribute_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'product_attribute[' + attribute_row + '][attribute_name]\']').val(item['label']);
            $('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').val(item['value']);
        }
               
    });

}

$('#attribute tbody tr').each(function(index, element) {
    attributeautocomplete(index);
});
</script> 

<script type="text/javascript">
//Option

var option_row = <?php echo $option_row; ?>;
$('input[name=\'option\']').autocomplete({
    'source': function(request, response) {
        $.ajax({
            url: "<?php echo base_url('catalog/options/autocomplete/') ?>",
            dataType: 'json',
                    type: 'POST',
                    data: {'option': request},
            success: function(json) {
                response($.map(json, function(item) {
                    return {
                        category: item['category'],
                        label: item['name'],
                        value: item['option_id'],
                        type: item['type'],
                        option_value: item['option_value']
                    }
                }));
            }
        });
    },
    
    'select': function(item) {
        html  = '<div class="tab-pane" id="tab-option' + option_row + '">';
        html += '   <input type="hidden" name="product_option[' + option_row + '][product_option_id]" value="" />';
        html += '   <input type="hidden" name="product_option[' + option_row + '][name]" value="' + item['label'] + '" />';
        html += '   <input type="hidden" name="product_option[' + option_row + '][option_id]" value="' + item['value'] + '" />';
        html += '   <input type="hidden" name="product_option[' + option_row + '][type]" value="' + item['type'] + '" />';

        html += '   <div class="form-group">';
        html += '     <label class="col-sm-2 control-label" for="input-required' + option_row + '">Required</label>';
        html += '     <div class="col-sm-10"><select name="product_option[' + option_row + '][required]" id="input-required' + option_row + '" class="form-control">';
        html += '         <option value="1">Yes</option>';
        html += '         <option value="0">No</option>';
        html += '     </select></div>';
        html += '   </div>';

        if (item['type'] == 'text') {
                html += '   <div class="form-group">';
                html += '     <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
                html += '     <div class="col-sm-10"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="Option Value" id="input-value' + option_row + '" class="form-control" /></div>';
                html += '   </div>';
        }

        if (item['type'] == 'textarea') {
                html += '   <div class="form-group">';
                html += '     <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
                html += '     <div class="col-sm-10"><textarea name="product_option[' + option_row + '][value]" rows="5" placeholder="Option Value" id="input-value' + option_row + '" class="form-control"></textarea></div>';
                html += '   </div>';
        }

        if (item['type'] == 'file') {
                html += '   <div class="form-group" style="display: none;">';
                html += '     <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
                html += '     <div class="col-sm-10"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="Option Value" id="input-value' + option_row + '" class="form-control" /></div>';
                html += '   </div>';
        }

        if (item['type'] == 'date') {
                html += '   <div class="form-group">';
                html += '     <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
                html += '     <div class="col-sm-3"><div class="input-group"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="Option Value" data-date-format="YYYY-MM-DD" id="input-value' + option_row + '" class="form-control date-start" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
                html += '   </div>';
        }

        if (item['type'] == 'time') {
                
                html += '   <div class="form-group">';                
                html += '     <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';                        
                html += '         <div class="col-sm-10"><div class="bootstrap-timepicker"><div class="input-group"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="Option Value"  id="input-value' + option_row + '" class="form-control timepicker" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button></span></div></div></div>';               
                html += '       </div>';
        }

        if (item['type'] === 'datetime') {
            
        html += '   <div class="form-group">';
        html += '          <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
        html += '           <div id="datetimepicker1" class="col-sm-10 datetimepicker1 input-append date">';
        html += '               <input size="16" type="text" name="product_option[' + option_row + '][value]" value="" id="input-value' + option_row + '" class="form-control add-on" data-format="dd/MM/yyyy hh:mm:ss"></input>';
        html += '           </div>';
        html += '   </div>';
        
            
            /*    html += ' <div class="form-group">';
                html += '          <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
                html += '          <div class="col-sm-10 input-append date form_datetime">';
                html += '           <input size="16" type="text" name="product_option[' + option_row + '][value]" value="" id="input-value' + option_row + '" readonly class="form-control ">';
                html += '           <span class="add-on"><i class="icon-th"></i></span>';
                html += '          </div>';
                html += '   </div>';*/
        }

        if (item['type'] == 'select' || item['type'] == 'radio' || item['type'] == 'checkbox' || item['type'] == 'image') {
            html += '<div class="table-responsive">';
            html += '  <table id="option-value' + option_row + '" class="table table-striped table-bordered table-hover">';
            html += '    <thead>';
            html += '      <tr>';
            html += '        <td class="text-left">Option Value</td>';
            html += '        <td class="text-right">Quantity</td>';
            html += '        <td class="text-left">Subtract</td>';
            html += '        <td class="text-right">Price</td>';
            html += '        <td class="text-right">Points</td>';
            html += '        <td class="text-right">Weight</td>';
            html += '        <td></td>';
            html += '      </tr>';
            html += '    </thead>';
            html += '    <tbody>';
            html += '    </tbody>';
            html += '    <tfoot>';
            html += '      <tr>';
            html += '        <td colspan="6"></td>';
            html += '        <td class="text-left"><button type="button" onclick="addOptionValue(' + option_row + ');" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';
            html += '      </tr>';
            html += '    </tfoot>';
            html += '  </table>';
            html += '</div>';

            html += '  <select id="option-values' + option_row + '" style="display: none;">';

            for (i = 0; i < item['option_value'].length; i++) {
                html += '  <option value="' + item['option_value'][i]['option_value_id'] + '">' + item['option_value'][i]['name'] + '</option>';
            }

            html += '  </select>';
            html += '</div>';
        }

        $('#tab-option .tab-content').append(html);

        $('#option > li:last-child').before('<li><a href="#tab-option' + option_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'a[href=\\\'#tab-option' + option_row + '\\\']\').parent().remove(); $(\'#tab-option' + option_row + '\').remove(); $(\'#option a:first\').tab(\'show\')"></i> ' + item['label'] + '</li>');

        $('#option a[href=\'#tab-option' + option_row + '\']').tab('show');
                
                //Date
                $('.date-start').datepicker({
                    todayHighlight:true,
                    startDate: "+0d",
                    format:"yyyy-mm-dd",
                    autoclose: true
                });
                //Time
                $(".timepicker").timepicker({
                    showInputs: false
                });
                //DateTime
                $(".datetimepicker1").datetimepicker({
                    todayHighlight:true,
                    startDate: "+0d",
                    format:"yyyy-MM-dd, hh:mm:ss",
                });
                
        option_row++;
    }
        
});   
</script>

<script type="text/javascript"> 
var option_value_row = <?php echo $option_value_row; ?>;

function addOptionValue(option_row) {
    
    html  = '<tr id="option-value-row' + option_value_row + '">';
    html += '  <td class="text-left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]" class="form-control">';
    html += $('#option-values' + option_row).html();
    html += '  </select><input type="hidden" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
    html += '  <td class="text-right"><input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][quantity]" value="" placeholder="Quantity" class="form-control" /></td>';
    html += '  <td class="text-left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][subtract]" class="form-control">';
    html += '    <option value="1">Yes</option>';
    html += '    <option value="0">No</option>';
    html += '  </select></td>';
    html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price_prefix]" class="form-control">';
    html += '    <option value="+">+</option>';
    html += '    <option value="-">-</option>';
    html += '  </select>';
    html += '  <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price]" value="" placeholder="Price" class="form-control" /></td>';
    html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points_prefix]" class="form-control">';
    html += '    <option value="+">+</option>';
    html += '    <option value="-">-</option>';
    html += '  </select>';
    html += '  <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points]" value="" placeholder="Points" class="form-control" /></td>';
    html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight_prefix]" class="form-control">';
    html += '    <option value="+">+</option>';
    html += '    <option value="-">-</option>';
    html += '  </select>';
    html += '  <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight]" value="" placeholder="Weight" class="form-control" /></td>';
    html += '  <td class="text-left"><button type="button" onclick="$(this).tooltip(\'destroy\');$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" rel="tooltip" title="" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#option-value' + option_row + ' tbody').append(html);
        $('[rel=tooltip]').tooltip();

    option_value_row++;
        
}
</script>
<script type="text/javascript">
    var discount_row = <?php echo $discount_row; ?>;

    function addDiscount() {
        html = '<tr id="discount-row' + discount_row + '">';
        html += '<td><select name="product_discount[' + discount_row + '][customer_group_id]" class="form-control" style="width:90px;">';
<?php foreach ($customer_groups as $customer_group) { ?>
            html += '    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo addslashes($customer_group['group_name']); ?></option>';
<?php } ?>
        html += '</select></td>';

        html += '<td class="text-right"><input type="text" id="product_discount[' + discount_row + '][quantity]" name="product_discount[' + discount_row + '][quantity]" value="" placeholder="Quantity" class="form-control"></td>';

        html += '<td class="text-right"><input type="text" id="product_discount[' + discount_row + '][priority]" name="product_discount[' + discount_row + '][priority]" value=""  placeholder="Priority" class="form-control"></td>';

        html += '<td class="text-right"><input type="text" id="product_discount[' + discount_row + '][price]" name="product_discount[' + discount_row + '][price]"  value=""  placeholder="Price" class="form-control"></td>';

        html += '<td class="col-sm-2 text-left"><div class="input-group date"><input type="text" id="product_discount[' + discount_row + '][date_start]" name="product_discount[' + discount_row + '][date_start]" value=""  placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control date-start"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';

        html += '<td class="col-sm-2 text-left"><div class="input-group date"><input type="text" id="product_discount[' + discount_row + '][date_end]" name="product_discount[' + discount_row + '][date_end]" value=""  placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control date-end"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';

        html += '<td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

        html += '</tr>';

        $('#discount tbody').append(html);
        
      
        
        $('.date-start').datepicker({
            todayHighlight:true,
            startDate: "+0d",
            format:"yyyy-mm-dd",
            autoclose: true,
        });
        
        //$('.date-start').change(function(){
        //    $('.date-end').val($('.date-start').val());
        //});
        //alert($('.date-end').val($('.date-start').val()));
        //var endDate = $('.date-end').val($('.date-start').val());
       
        $('.date-end').datepicker({
            todayHighlight:true,
            startDate: "+0d",
            format:"yyyy-mm-dd",
            autoclose: true,
        });

        discount_row++;
    }

</script> 
<script type="text/javascript">
    var special_row = <?php echo $special_row; ?>;

    function addSpecial() {
        html = '<tr id="special-row' + special_row + '">';
        html += '<td><select name="product_special[' + special_row + '][customer_group_id]" class="form-control" style="width:120px">';
<?php foreach ($customer_groups as $customer_group) { ?>
            html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo addslashes($customer_group['group_name']); ?></option>';
<?php } ?>
        html += '</select></td>';


        html += '<td class="text-right"><input type="text" id="product_special[' + special_row + '][priority]" name="product_special[' + special_row + '][priority]" value="" placeholder="Priority" class="form-control"></td>';

        html += '<td class="text-right"><input type="text" id="product_special[' + special_row + '][price]" name="product_special[' + special_row + '][price]" value=""  placeholder="Price" class="form-control"></td>';

        html += '<td class="col-sm-2 text-left"><div class="input-group date"><input type="text" id="product_special[' + special_row + '][date_start]" name="product_special[' + special_row + '][date_start]" value=""  placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control date-start"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';

        html += '<td class="col-sm-2 text-left"><div class="input-group date"><input type="text" id="product_special[' + special_row + '][date_end]" name="product_special[' + special_row + '][date_end]" value=""  placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control date-end"><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';

        html += '<td class="text-left"><button type="button" onclick="$(\'#special-row' + special_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

        html += '</tr>';

        $('#special tbody').append(html);

        $('.date-start').datepicker({
            todayHighlight:true,
            startDate: "+0d",
            format:"yyyy-mm-dd",
            autoclose: true,
        });
        
        //$('.date-start').change(function(){
        //    $('.date-end').val($('.date-start').val());
        //});
        //alert($('.date-end').val($('.date-start').val()));
        //var endDate = $('.date-end').val($('.date-start').val());
       
        $('.date-end').datepicker({
            todayHighlight:true,
            startDate: "+0d",
            format:"yyyy-mm-dd",
            autoclose: true,
        });

        special_row++;
    }

</script> 
<script type="text/javascript">
    $('#option a:first').tab('show');
</script>

