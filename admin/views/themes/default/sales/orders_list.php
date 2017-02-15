 <!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Orders<small></small> </h1>
       <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <div class="pull-right">
        <a href="<?php echo $add;?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
      </div>
    </section>
    
    <!-- Start : Main content -->
    <section class="content">
    <div class="row" >
       <div class="col-xs-12 myerror">
       </div>
    </div>
   <div class="well well-sm sales_report">
              <div class="row">
              <form action="<?php echo base_url("sales/orders/search"); ?>" method="post">
                <!-- start : left column -->
                <div class="col-sm-4">
                  <!------- start : input group ------>
                  <div class="form-group">
                    <label for="product" class="col-sm-12 control-label">Order Id</label>
                    <div class="col-sm-12 input-padding">
                      <input type="text" name="filter_order_id" id="filter_order_id" class="form-control" placeholder="Order Id" value="<?php echo $filter_order_id;?>">
                    </div>
                  </div>
                  <!------- end : input group ------>
                  
                  <!------- start : input group ------>
                  <div class="form-group">
                    <label for="author" class="col-sm-3 col-md-2 control-label">Customer</label>
                    <div class="col-sm-12 input-padding">
                      <input type="text" name="filter_customer" id="filter_customer" class="form-control" placeholder="Customer" value="<?php echo $filter_customer?>">
                    </div>
                  </div>
                  <!------- end : input group ------>

                </div>
                <!-- End : Left column -->
                
                <!-- start : right column -->
                <div class="col-sm-4">
                  <!-- Start : input Group -->
                    <div class="form-group">
                      <label for="group_by" class="col-sm-12 control-label">
                      Order Status
                      </label>
                      <div class="col-sm-12 input-padding">
                          <select name="filter_order_status" id="filter_order_status" class="form-control">
                            <option value="*">  </option> 
                            <?php
                            foreach ($order_status_list as $key => $value) {
                              echo '<option value="'.$value['order_status_id'].'">'.$value['order_status_name'].'</option>';
                            }
                            ?> 
                           </select>
                           <script type="text/javascript">
                             $('#filter_order_status').val('<?php echo $filter_order_status?>')
                           </script>

                      </div>
                    </div>
                    <!-- End : input Group -->
                    <!-- Start : Total -->
                     <div class="form-group">
                    <label for="author" class="col-sm-3 col-md-2 control-label">Total</label>
                    <div class="col-sm-12 input-padding">
                      <input type="text" name="filter_total" id="filter_total" class="form-control" placeholder="Total" value="<?php echo $filter_total?>">
                    </div>
                  </div>
                  </div>
                  <!-- End : Total -->
                  <div class="col-sm-4">
                    <!-- Start : Date Picker Group -->
                    <div class="form-group">
                      <label for="date_added" class="col-sm-12 control-label">Date Added</label>
                      <div class="col-sm-12 input-padding">
                          <div class="input-group date">
                            <input id="filter_date_added" name="filter_date_added" placeholder="Date Added" class="form-control pull-right" type="text" value="<?php echo $filter_date_added;?>">
                              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                    </div>
                    <!------ End : Date Picker Group ------>
                    <!-- Start : Date Picker Group -->
                    <div class="form-group">
                      <label for="date_added" class="col-sm-12 control-label">Date Modified</label>
                      <div class="col-sm-12 input-padding">
                          <div class="input-group date">
                            <input id="filter_date_modified" name="filter_date_modified" placeholder="Date Modified" class="form-control pull-right" type="text" value="<?php echo $filter_date_modified;?>">
                              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                    </div>
                    <!------ End : Date Picker Group ------>
                    
                    
                </div>
                <!-- End : right column -->
                <!--Start : Filter Button-->
                     <div class="col-md-12">
                        <div class="col-md-3 col-lg-3 pull-right">
                           <button type="submit" id="button-filter" name="button_filter" class="btn btn-primary" value="search"> <i class="fa fa-search"></i> Filter </button>
                           <button type="submit" id="button-all" name="button_all" class="btn btn-primary" value="all"> <i class="fa fa-search"></i> All </button>
                        </div>
                      </div>
                    <!--End : Filter Button-->
                </form>
              </div>
            </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h2 class="box-title col-sm-6"><i class="fa fa-list"></i>Order List</h2>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-product">
                <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
             <table id="theme-table" class="table table-bordered table-hover ">
            <thead>
              <tr>
                <th> <input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);">
                </th>
                 <th class="<?php if ($sort_by == 'order_id') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/orders/index/order_id/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Order Id</a></th>
                <th class="<?php if ($sort_by == 'customer') echo "sort_$sort_order";?>">
                <a href="<?php echo base_url('sales/orders/index/customer/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Customer</a></th>
                <th class=" <?php if ($sort_by == 'status') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/orders/index/status/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Status</a></th>
                  <th class=" <?php if ($sort_by == 'total') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/orders/index/total/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Total</a></th>
                <th class=" <?php if ($sort_by == 'date_added') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/orders/index/date_added/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Date Added</a></th>
                <th class="<?php if ($sort_by == 'date_modified') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/orders/index/date_modified/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Date Modified</a></th>
                
                <th class="col-xs-2 col-md-2 text-right">Action</th>
              </tr>
            </thead>

              <tbody>
                 
              <?php if(isset($records)) { ?>
              <?php foreach($records as $row){?>
              <tr class="">
                <td><?php if (in_array($row['order_id'], $selected)) { ?>
                  <input type="checkbox" name="selected[]" value="<?php echo $row['order_id']; ?>" checked="checked" />
                  <?php } else { ?>
                  <input type="checkbox" name="selected[]" value="<?php echo $row['order_id']; ?>" />
                  <?php } ?></td>
                  <td class=""><?php echo $row['order_id']; ?></td>
                <td class=""><?php echo $row['customer']; ?></td>
                <td class=""><?php echo $row['status']; ?></td>
                <td class=""><?php echo $row['total']; ?></td>
                <td class=""><?php echo $row['date_added']; ?></td>
                <td class=""><?php echo $row['date_modified']; ?></td>
                <td class="text-right"><a href="<?php echo $row['view']; ?>" data-toggle="tooltip" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a>
                <a href="<?php echo $row['edit']; ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                <button type="button" value="<?php echo $row['order_id']; ?>" id="button-delete<?php echo $row['order_id']; ?>" data-loading-text="Loading..." data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                </td>
              </tr>
              <?php }?>
              <?php } else {?>
              <tr>
                <td align="center" colspan="8">No Records</td>
              </tr>
              <?php }?>
            </tbody>
            </table>
            </form>
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
    <?php if(isset($records)){$count = count($records);}else {$count=0;} ?>
    Showing <?php echo (int)$range; ?> to <?php echo (int)($range+$count-1); ?> of <?php echo (int)$totals; ?> (<?php echo (int)$pages; ?> Pages)</div>
</div>
<!-- End Pagination -->
  </div>
  </section>
  <!-- End : Main content --> 
</div>
<!-- /.content-wrapper -->
<script src="<?php echo ADMIN_PATH . $this->common->config('admin_theme'); ?>/js/common.js"></script>

<script type="text/javascript"><!--
$('input[name=\'filter_customer\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url('customers/customer/autocomplete');?>',
      type:'post',
      data:{filter_name:request},
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['customer_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'filter_customer\']').val(item['label']);
  }
});
//--></script>
<script>

  //Date picker
    $('#filter_date_added').datepicker({
      autoclose: true
    });
  
  //Date picker
    $('#filter_date_modified').datepicker({
      autoclose: true
    });
  
  $('button[id^=\'button-delete\']').on('click', function(e) {
  if (confirm('Are you sure?')) {
    var node = this;

    $.ajax({
      url: '<?php echo base_url('api/api_order/delete'); ?>',
      type:'post',
      data:{order_id:$(node).val()},
      dataType: 'json',
      crossDomain: true,
      beforeSend: function() {
        $(node).button('loading');
      },
      complete: function() {
        $(node).button('reset');
      },
      success: function(json) {
        $('.alert').remove();

        if (json['error']) {
          $('.myerror').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        if (json['success']) {
          $('.myerror').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          location.reload();
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
});
  </script>