<!-- DataTables -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datatables/dataTables.bootstrap.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/all.css">
<!-- DataTables --> 
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datatables/jquery.dataTables.min.js"></script> 
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datatables/dataTables.bootstrap.min.js"></script> 
<!-- iCheck 1.0.1 -->
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/iCheck/icheck.min.js"></script>
 <link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
<!-- DataTables --> 
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Categories<small></small> </h1>
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
				Category List
            </h2>
            <div class="pull-right">
              <a href="<?php echo $add;?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
              <button class="btn btn-default"><i class="fa fa-copy"></i></button>
              <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="theme-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>
					<input type="checkbox" class="minimal" id="SelectAll">
             	  </th>
                  <th class="col-xs-5 col-sm-7">Category Name</th>
                  <th class="col-xs-1 col-sm-2">Sort Order</th>
                  <th class="col-xs-6 col-sm-3">Actions</th>
                </tr>
              </thead>
              <tbody>
			  <?php for($i=0;$i<=5;$i++){?>
              		<tr>
					<td><input type="checkbox" class="minimal"></td>
                    <td class="">Lehenga Choli / Salwar Kameez</td>
                    <td class="">4</td>
					<td>
                    <div class="text-center">
                        <div class="btn-group">
                        <a class="btn btn-primary btn-xs"><i class="fa fa-picture-o"></i></a> 
                        
                        <a class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a> 
                        
                        <a onclick="return confirm('You are going to delete category, please click ok to delete.')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </div>
                    </td>
                </tr>
			  <?php }?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
      </div>
    </div>
  </div>
  </section>
  <!-- End : Main content --> 
</div>

<script>
	//============ Datatable ==============================
    $('#theme-table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
	  "responsive":true,
	  "pagingType": "full_numbers"
    });
  
  //============= iCheck for checkbox inputs inital ========
    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-green'
    });
    
	//================ Check and Uncheck Checkbox ==============
	$("#SelectAll").on("ifChanged", check_all_box);
	function check_all_box() 
	{
		if(document.getElementById('SelectAll').checked)
		{
			$('input[type="checkbox"].minimal').iCheck('check');
		}
		else
		{
			$('input[type="checkbox"].minimal').iCheck('uncheck');
		} 
	}
	//======= after pagination render control ==============
	 var eventFired = function ( type ) {
		   $('input[type="checkbox"].minimal').iCheck({
		  checkboxClass: 'icheckbox_minimal-green'
		});
	  $("#SelectAll").on("ifChanged", check_all_box);
	function check_all_box() 
	{
		if(document.getElementById('SelectAll').checked)
		{
			$('input[type="checkbox"].minimal').iCheck('check');
		}
		else
		{
			$('input[type="checkbox"].minimal').iCheck('uncheck');
		} 
	}
		}
	 
		$('#theme-table')
			.on( 'order.dt',  function () { eventFired( 'Order' ); } )
			.on( 'search.dt', function () { eventFired( 'Search' ); } )
			.on( 'page.dt',   function () { eventFired( 'Page' ); } )
			.DataTable();
</script>