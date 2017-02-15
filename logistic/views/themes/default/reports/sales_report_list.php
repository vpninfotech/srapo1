<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Sales Report<small></small> </h1>
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </ul>
        
    </section>

    <!-- Start : Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h2 class="box-title col-sm-6">
                            <i class="fa fa-list"></i>
                            Sales List
                        </h2>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="well well-sm sales_report">
                            <div class="row">
                                <form action="<?php echo base_url("reports/sales_report/search"); ?>" method="post">
                                    <!-- start : left column -->
                                    <div class="col-sm-6"> 
                                        <!-- Start : Date Picker Group -->
                                        <div class="form-group">
                                            <label for="filter_date_start" class="col-sm-12 control-label">Date Start</label>
                                            <div class="col-sm-12 input-padding">
                                                <div class="input-group date">
                                                    <input id="filter_date_start" name="filter_date_start" placeholder="Date Start" class="form-control pull-right" value="<?php echo $filter_date_start ?>" type="text">
                                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!------ End : Date Picker Group ------>

                                        <!-- Start : Date Picker Group -->
                                        <div class="form-group">
                                            <label for="filter_date_end" class="col-sm-12 control-label">Date End</label>
                                            <div class="col-sm-12 input-padding">
                                                <div class="input-group date">
                                                    <input id="filter_date_end" name="filter_date_end" placeholder="Date End" class="form-control pull-right" value="<?php echo $filter_date_end ?>" type="text">
                                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!------ End : Date Picker Group ------>
                                    </div>
                                    <!-- End : Left column --> 

                                    <div class="col-sm-6">
                                        <!-- Start : Date Picker Group -->
                                        <div class="form-group">
                                            <label for="filter_group" class="col-sm-12 control-label">Group By</label>
                                            <div class="col-sm-12 input-padding">
                                                <select name="filter_group" id="filter_group" class="form-control">
                                                    <?php foreach ($groups as $group) { ?>
                                                    <?php if ($group['value'] == $filter_group) { ?>
                                                        <option value="<?php echo $group['value']; ?>" selected="selected"><?php echo $group['text']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $group['value']; ?>"><?php echo $group['text']; ?></option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <script>
                                                    $("#filter_group").val(<?php echo $filter_group; ?>);
                                                </script> 
                                            </div>
                                        </div>
                                        <!------ End : Date Picker Group ------> 
                                        
                                        <!-- Start : Date Picker Group -->
                                        <div class="form-group">
                                            <label for="filter_order_status_id" class="col-sm-12 control-label">Order Status</label>
                                            <div class="col-sm-12 input-padding">
                                                <select name="filter_order_status_id" id="filter_order_status_id" class="form-control">
                                                    <option value="0">All Statuses</option>
                                                    <?php foreach ($order_statuses as $order_status) { ?>

                                                        <?php if ($order_status['order_status_id'] == $filter_order_status_id) { ?>
                                                            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['order_status_name']; ?></option>
                                                        <?php } else { ?>
                                                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['order_status_name']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <script>
                                                    $("#filter_order_status_id").val(<?php echo $filter_order_status_id; ?>);
                                                </script> 
                                            </div>
                                        </div>
                                        <!------ End : Date Picker Group ------> 

                                        <!--Start : Filter Button-->

                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3 col-lg-2 pull-right">
                                            <button type="submit" id="button-filter" name="button_filter" class="btn btn-primary" value="search"> <i class="fa fa-search"></i> Filter </button>
                                            <button type="submit" id="button-all" name="button_all" class="btn btn-primary" value="all"> <i class="fa fa-search"></i> All </button>
                                        </div>
                                    </div>
                                </form>

                                <!--End : Filter Button--> 
                            </div>
                            <!-- End : right column --> 

                        </div>
                        <!--Start Table-->
                        <table id="theme-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date Start</th>
                                    <th>Date End</th>
                                    <th class="text-right">No. Orders</th>
                                    <th class="text-right">No. Products</th>
                                    <th class="text-right">Tax</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php if (isset($records)) { ?>
                                    <?php foreach ($records as $row) { ?>
                                        <tr>
                                            <td class=""><?php echo $row['date_start']; ?></td>
                                            <td class=""><?php echo $row['date_end']; ?></td>
                                            <td class="text-right"><?php echo $row['orders']; ?></td>
                                            <td class="text-right"><?php echo $row['products']; ?></td>
                                            <td class="text-right"><?php echo $row['tax']; ?></td>
                                            <td class="text-right"><?php echo $row['total']; ?></td>
                                            
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td align="center" colspan="8">No Records</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!--End : Table-->


                    </div>
                    <!-- /.box-body --> 
                </div>
                <!-- /.box --> 
            </div>
        </div>
        <!-- Start Pagination -->
        <div class="row">
            <div class="col-sm-6 col-xs-12 text-left"> <?php echo $pagination; ?> </div>
            <div class="col-sm-6 col-xs-12 text-right">
                <?php
                if (isset($records)) {
                    $count = count($records);
                } else {
                    $count = 0;
                }
                ?>
                Showing <?php echo (int) $range; ?> to <?php echo (int) ($range + $count - 1); ?> of <?php echo (int) $totals; ?> (<?php echo (int) $pages; ?> Pages)</div>
        </div>
        <!-- End Pagination -->
        </section>


<!-- End : Main content --> 
</div>
<!-- /.content-wrapper -->

<!-- page script -->
<script>

    //Date picker
    $('#filter_date_start').datepicker({
        todayHighlight: true,
        format: "yyyy-mm-dd",
        autoclose: true
    });

    //Date picker
    $('#filter_date_end').datepicker({
        todayHighlight: true,
        format: "yyyy-mm-dd",
        autoclose: true
    });


</script>