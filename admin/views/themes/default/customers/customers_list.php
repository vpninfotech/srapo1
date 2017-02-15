<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Customers<small></small> </h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <div class="pull-right"> <a href="<?php echo $add;?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
      <button class="btn btn-danger" id="button-delete"><i class="fa fa-trash-o"></i></button>
    </div>
  </section>
  
  <!-- Start : Main content -->
  <section class="content">
  <div class="row">
    <div class="col-xs-12">
      <?php if ($error_warning) { ?>
      <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      <?php } ?>
      <?php if ($success) { ?>
      <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      <?php } ?>
    </div>
  </div>
  <div class="well well-sm sales_report">
    <div class="row">
      <form action="<?php echo base_url("customers/customer/search"); ?>" method="post">
        <!-- start : left column -->
        <div class="col-sm-4"> 
          <!------- start : input group ------>
          <div class="form-group">
            <label for="filter_name" class="col-sm-12 control-label">Customer Name</label>
            <div class="col-sm-12 input-padding">
              <input type="text" name="filter_name" id="filter_name" class="form-control" placeholder="Customer Name" value="<?php echo $filter_name; ?>">
            </div>
          </div>
          <!------- end : input group ------> 
          
          <!------- start : input group ------>
          <div class="form-group">
            <label for="filter_email" class="col-sm-3 col-md-2 control-label">Email</label>
            <div class="col-sm-12 input-padding">
              <input type="text" name="filter_email" id="filter_email" class="form-control" placeholder="Email" value="<?php echo $filter_email; ?>">
            </div>
          </div>
          <!------- end : input group ------> 
          
        </div>
        <!-- End : Left column --> 
        
        <!-- start : right column -->
        <div class="col-sm-4"> 
          <!-- Start : input Group -->
          <div class="form-group">
            <label for="filter_customer_group_id" class="col-sm-12 control-label">Customer Group</label>
            <div class="col-sm-12 input-padding">
              <select name="filter_customer_group_id" id="filter_customer_group_id" class="form-control">
                <option value="*"> </option>
                <?php if(isset($customer_group)) { ?>
                <?php foreach($customer_group as $row) { ?>
                <option value="<?php echo $row['customer_group_id']; ?>"><?php echo $row['group_name']; ?> </option>
                <?php } } ?>
              </select>
              <script>
					  $("#filter_customer_group_id").val(<?php echo $filter_customer_group_id; ?>);
					</script> 
            </div>
          </div>
          <!-- End : input Group --> 
          <!-- Start : Total -->
          <div class="form-group">
            <label for="filter_status" class="col-sm-3 col-md-2 control-label">Status</label>
            <div class="col-sm-12 input-padding">
              <select name="filter_status" id="filter_status" class="form-control">
                <option value=""> </option>
                <option value="1"> Enabled </option>
                <option value="0"> Disabled </option>
              </select>
              <script>
					  $("#filter_status").val(<?php echo $filter_status; ?>);
					</script> 
            </div>
          </div>
        </div>
        <!-- End : Total -->
        <div class="col-sm-4">
        <!-- Start : Date Picker Group -->
        <div class="form-group">
          <label for="filter_date_added" class="col-sm-12 control-label">Date Added</label>
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
          <label for="filter_ip" class="col-sm-3 col-md-2 control-label">IP</label>
          <div class="col-sm-12 input-padding">
            <input type="text" name="filter_ip" id="filter_ip" class="form-control" placeholder="IP" value="<?php echo $filter_ip;?>">
          </div>
        </div>
        <!------ End : Date Picker Group ------> 
        
        <!--Start : Filter Button-->
       

      
    </div>
    <div class="col-md-12">
      <div class="col-md-3 pull-right">
         <button type="submit" id="button-filter" name="button_filter" class="btn btn-primary" value="search"> <i class="fa fa-search"></i> Filter </button>
         <button type="submit" id="button-all" name="button_all" class="btn btn-primary" value="all"> <i class="fa fa-search"></i> All </button>
      </div>
    </div>
        </form>
    <!--End : Filter Button--> 
  </div>
  </form>
  <!-- End : right column --> 
  
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h2 class="box-title col-sm-6"> <i class="fa fa-list"></i> Customers List </h2>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-customers">
          <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
          <table id="theme-table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th> <input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);">
                </th>
                <th class="<?php if ($sort_by == 'firstname') echo "sort_$sort_order";?>"><a href="<?php echo base_url('customers/customer/index/firstname/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">First Name</a></th>
                <th class="<?php if ($sort_by == 'lastname') echo "sort_$sort_order";?>"><a href="<?php echo base_url('customers/customer/index/lastname/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Last Name</a></th>
                <th class="<?php if ($sort_by == 'email') echo "sort_$sort_order";?>"><a href="<?php echo base_url('customers/customer/index/email/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Email</a></th>
                <th class="<?php if ($sort_by == 'user_status') echo "sort_$sort_order";?>"><a href="<?php echo base_url('customers/customer/index/user_status/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Status</a></th>
                <th class="<?php if ($sort_by == 'ip') echo "sort_$sort_order";?>"><a href="<?php echo base_url('customers/customer/index/ip/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Ip</a></th>
                <th class="<?php if ($sort_by == 'date_added') echo "sort_$sort_order";?>"><a href="<?php echo base_url('customers/customer/index/date_added/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Date Added</a></th>
                <th class="col-xs-2 col-md-2 text-right">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(isset($records)) { ?>
              <?php foreach($records as $row){?>
              <tr class="<?php if(($row['is_deleted'] == 1)) { echo "bg-danger"; } ?>">
                <td><?php if (in_array($row['customer_id'], $selected)) { ?>
                  <input type="checkbox" name="selected[]" value="<?php echo $row['customer_id']; ?>" checked="checked" />
                  <?php } else { ?>
                  <input type="checkbox" name="selected[]" value="<?php echo $row['customer_id']; ?>" />
                  <?php } ?></td>
                <td class=""><?php echo $row['firstname']; ?></td>
                <td class=""><?php echo $row['lastname']; ?></td>
                <td class=""><?php echo $row['email']; ?></td>
                <td class=""><?php echo $row['user_status']; ?></td>
                <td class=""><?php echo $row['ip']; ?></td>
                <td class=""><?php echo $row['date_added']; ?></td>
                <td class="text-right"><a href="<?php echo $row['edit']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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
</section>
</div>

<!-- End : Main content --> 

<!-- /.content-wrapper --> 
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/js/common.js"></script>

<script>
// Name AutoComplate          
$('input[name=\'filter_name\']').autocomplete({
    'source': function(request,response) {
        $.ajax({
            url: "<?php echo base_url('customers/customer/autocomplete/') ?>",
            dataType: 'json',
                        type:'POST',
                        data : {'filter_name':request},
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
            $('input[name=\'filter_name\']').val(item['label']);
    }	
});

// Email AutoComplate
$('input[name=\'filter_email\']').autocomplete({
    'source': function(request,response) {
        $.ajax({
            url: "<?php echo base_url('customers/customer/autocomplete/') ?>",
            dataType: 'json',
			type:'POST',
			data : {'filter_email':request},			
            success: function(json) {
                response($.map(json, function(item) {
                    return {
                        label: item['email'],
                        value: item['customer_id']
                    }
                }));
            }
        });
    },
    'select': function(item) {
            $('input[name=\'filter_email\']').val(item['label']);
    }	
});
</script> 
<script>
//Date picker
$('#filter_date_added').datepicker({
   autoclose: true,
   format : 'dd-mm-yyyy',
   todayHighlight:true,
   pickTime: false
});


</script>
<script type="text/javascript">
$('#button-delete').click(function(){
  if($('form input[type=checkbox]:checked').size() > 0)
  {
    var res = confirm('Are you sure ?');
    if(res)
    {
      $('form').submit();
    }  
  }
  else
  {
    alert("Please select atleast one value")
  }

});

</script>