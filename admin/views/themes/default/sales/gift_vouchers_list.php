 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Gift Voucher List<small></small> </h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <div class="pull-right"> 
        <button type="button" id="button-send" data-toggle="tooltip" title="Send" class="btn btn-primary"><i class="fa fa-envelope"></i></button>
        <a href="<?php echo $add;?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button class="btn btn-danger" id="button-delete"><i class="fa fa-trash-o"></i></button>
    </div>
  </section>
  
  <!-- Start : Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12" id="emailStatus">
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
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h2 class="box-title col-sm-6"> <i class="fa fa-list"></i>Gift Voucher List </h2>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-gift_vouchers">
              <input type="hidden" name="token" id="token" value="<?php echo $this->session->userdata('token'); ?>" />
              <table id="theme-table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="col-xs-1"> <input type="checkbox" onClick="$('input[name*=\'selected\']').prop('checked', this.checked);">
                    </th>
                    <th class="<?php if ($sort_by == 'code') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/gift_vouchers/index/code/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Code</a></th>
                     <th class="<?php if ($sort_by == 'from_name') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/gift_vouchers/index/from_name/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">From</a></th>
                      
                      <th class="<?php if ($sort_by == 'to_name') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/gift_vouchers/index/to_name/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">To </a></th>
                       
                      <th class="<?php if ($sort_by == 'amount') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/gift_vouchers/index/amount/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Amount</a></th>
                       <th class="<?php if ($sort_by == 'status') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/gift_vouchers/index/status/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Status</a></th>
                       <th class="<?php if ($sort_by == 'date_added') echo "sort_$sort_order";?>"><a href="<?php echo base_url('sales/gift_vouchers/index/date_added/'.(($sort_order == 'ASC') ? 'DESC' : 'ASC').'/'.$this->uri->segment(6)); ?>">Date Added</a></th>
                    
                    <th class="col-xs-2 col-md-2 text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($records)) { ?>
                    <?php foreach($records as $row){?>
                    <tr class="<?php if(($row['is_deleted'] == 1)) { echo "bg-danger"; } ?>">
                      <td><?php if (in_array($row['voucher_id'], $selected)) { ?>
                        <input type="checkbox" name="selected[]" value="<?php echo $row['voucher_id']; ?>" checked="checked" />
                        <?php } else { ?>
                        <input type="checkbox" name="selected[]" value="<?php echo $row['voucher_id']; ?>" />
                        <?php } ?>
                    </td>
                  
                <td class=""><?php echo $row['code']; ?></td>
                <td class=""><?php echo $row['from_name'];?></td>
                <td class=""><?php echo $row['to_name']; ?></td>
                <td class=""><?php echo $row['amount']; ?></td>
                <td class=""><?php echo $row['status']; ?></td>
                <td class=""><?php echo $row['date_added']; ?></td>
                  
               <td class="text-right"><a href="<?php echo $row['edit']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php }} else {?>
                <tr>
                  <td class="" colspan="8" align="center">No Recored</td>
                </tr>
                <?php } ?>
                  </tbody>
                
              </table>
            </form>
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-xs-12 text-left"> <?php echo $pagination; ?> </div>
      <div class="col-sm-6 col-xs-12 text-right">
        <?php if(isset($records)){$count = count($records);}else {$count=0;} ?>
        Showing <?php echo (int)$range; ?> to <?php echo (int)($range+$count-1); ?> of <?php echo (int)$totals; ?> (<?php echo (int)$pages; ?> Pages)</div>
    </div>
    <!-- End Pagination --> 
    
  </section>
  <!-- End : Main content --> 
</div>
<!-- /.content-wrapper --> 
<script type="text/javascript">
$('#button-send').on('click', function() {
    $.ajax({
        url: "<?php echo base_url('sales/gift_vouchers/send/') ?>",
        type: 'post',
        dataType: 'json',
        data: $('input[name^=\'selected\']:checked'),
        beforeSend: function() {
            $('#button-send i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
            $('#button-send').prop('disabled', true);
        },	
        complete: function() {
            $('#button-send i').replaceWith('<i class="fa fa-envelope"></i>');
            $('#button-send').prop('disabled', false);
        },
        success: function(json) {
            $('.alert').remove();

            if (json['error']) {
                $('#emailStatus').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                }

            if (json['success']) {
                $('#emailStatus').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                }		
        },
        error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });	
})
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
    alert("Please select atleast one record")
  }

});


</script>
