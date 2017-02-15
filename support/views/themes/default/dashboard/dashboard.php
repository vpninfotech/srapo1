
<!-- --------------- Chart Jquery -------------- -->
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/flot/jquery.flot.js"></script> 
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/flot/jquery.flot.resize.min.js"></script>
<!-- Start : Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <!-- Start : Breadcrumb -->
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
      <!-- End : Breadcrumb -->
    </section>

        <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <a class="small-box-footer"></a>
                        <div class="inner">
                            <h3><?php echo $ticket['total']; ?></h3>
                            <p>Total Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comments-o"></i>
                        </div>
                        <a class="small-box-footer"></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <a class="small-box-footer"></a>
                        <div class="inner">
                            <h3><?php echo $operator_ticket['total']; ?></h3>
                            <p>Operator Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comment-o"></i>
                        </div>
                        <a class="small-box-footer"></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <a class="small-box-footer"></a>
                        <div class="inner">
                            <h3><?php echo $manufacturer_ticket['total']; ?></h3>
                            <p>Manufacturer Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comment-o"></i>
                        </div>
                        <a class="small-box-footer"></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <a class="small-box-footer"></a>
                        <div class="inner">
                            <h3><?php echo $finance_ticket['total']; ?></h3>
                            <p>Financer Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comment-o"></i>
                        </div>
                        <a class="small-box-footer"></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <a class="small-box-footer"></a>
                        <div class="inner">
                            <h3><?php echo $logistic_ticket['total']; ?></h3>
                            <p>Logistic Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comment-o"></i>
                        </div>
                        <a class="small-box-footer"></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <a class="small-box-footer"></a>
                        <div class="inner">
                            <h3><?php echo $marketor_ticket['total']; ?></h3>
                            <p>Marketor Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comment-o"></i>
                        </div>
                        <a class="small-box-footer"></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <a class="small-box-footer"></a>
                        <div class="inner">
                            <h3><?php echo $customer_ticket['total']; ?></h3>
                            <p>Customer Tickets</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comment-o"></i>
                        </div>
                        <a class="small-box-footer"></a>
                    </div>
                </div>
               

                <!--<div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-bar-chart-o"></i>Tickets Analytics</h3>
                            <div class="pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i> <i class="caret"></i></a>
      <ul id="range" class="dropdown-menu dropdown-menu-right">
        <li><a href="day">Today</a></li>
        <li><a href="week">Week</a></li>
        <li class="active"><a href="month">Month</a></li>
        <li><a href="year">Year</a></li>
      </ul>
    </div>
                        </div>
                        <div class="box-body">
                             <div id="chart-sale" style="width: 100%; height: 260px;"></div>
                        </div>
                    </div>
                </div>-->
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-bar-chart-o"></i>Tickets Analytics</h3>
                            <div class="pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i> <i class="caret"></i></a>
      <ul id="range" class="dropdown-menu dropdown-menu-right">
        <li><a href="day">Today</a></li>
        <li><a href="week">Week</a></li>
        <li class="active"><a href="month">Month</a></li>
        <li><a href="year">Year</a></li>
      </ul>
    </div>
                        </div>
                        <div class="box-body">
                             <div id="chart-sale" style="width: 100%; height: 260px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-shopping-cart"></i>Latest Tickets</h3>
                        </div>
                        <div class="box-body">
                           <div class="table-responsive">
    <table id="theme-table" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Ticket Code</th>
          <th>Department</th>
          <th>Title</th>
          <th class="text-right">Date Added</th>
          <th class="text-right">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($tickets['ticket'])) { ?>
        <?php foreach ($tickets['ticket'] as $ticket) { ?>
        <tr>
          <td><?php echo '#' . $ticket['ticket_id']; ?></td>
          <td><?php echo $ticket['department']; ?></td>
          <td><?php echo $ticket['title']; ?></td>
          <td class="text-right"><?php echo $ticket['date_added']; ?></td>
          <td class="text-right"><a href="<?php echo $ticket['view']; ?>" data-toggle="tooltip" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
          <td class="text-center" colspan="6">No Order Found</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
                        </div>
                    </div>   
                </div>
           </div>
                
                
        </div>
    </div>
</section>
    <!-- End : Main content -->
  </div>
<!-- End : Content Wrapper. Contains page content -->

<script type="text/javascript"><!--
$('#range a').on('click', function(e) {
	e.preventDefault();
	
	$(this).parent().parent().find('li').removeClass('active');
	
	$(this).parent().addClass('active');
	
	$.ajax({
		type: 'post',
		url: '<?php echo base_url('dashboard/dashboard/chart/') ?>',
		dataType: 'json',
		data: {'range':$(this).attr('href')},
		success: function(json) {
                    console.log(json);
                        if (typeof json['ticket'] == 'undefined') { return false; }
			var option = {	
				shadowSize: 0,
				colors: ['#9FD5F1', '#1065D2'],
				bars: { 
					show: true,
					fill: true,
					lineWidth: 1
				},
				grid: {
					backgroundColor: '#FFFFFF',
					hoverable: true
				},
				points: {
					show: false
				},
				xaxis: {
					show: true,
            		ticks: json['xaxis']
				}
			}
			
			$.plot('#chart-sale', [json['ticket']], option);	
					
			$('#chart-sale').bind('plothover', function(event, pos, item) {
				$('.tooltip').remove();
			  
				if (item) {
					$('<div id="tooltip" class="tooltip top in"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + item.datapoint[1].toFixed(2) + '</div></div>').prependTo('body');
					
					$('#tooltip').css({
						position: 'absolute',
						left: item.pageX - ($('#tooltip').outerWidth() / 2),
						top: item.pageY - $('#tooltip').outerHeight(),
						pointer: 'cusror'
					}).fadeIn('slow');	
					
					$('#chart-sale').css('cursor', 'pointer');		
			  	} else {
					$('#chart-sale').css('cursor', 'auto');
				}
			});
		},
        error: function(xhr, ajaxOptions, thrownError) {
           alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});

$('#range .active a').trigger('click');
//--></script> 
