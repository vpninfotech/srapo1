<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/jqvmap/jqvmap.css">
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/jqvmap/jquery.vmap.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/jqvmap/maps/jquery.vmap.world.js"></script>

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
           <a href="#" class="small-box-footer">Today Sale : <?php echo $sales['percentage']; ?>%</a>
            <div class="inner">
              <h3><?php echo $sales['total']; ?></h3>
              <p>Total Sale</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('sales/sale'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
           <a href="#" class="small-box-footer">Today Sales Return: <?php echo $sales_return['percentage']; ?>%</a>
            <div class="inner">
               <h3><?php echo $sales_return['total']; ?></h3>

              <p>Total Sales Return</p>
            </div>
            <div class="icon">
              <i class="fa fa-credit-card"></i>
            </div>
            <a href="<?php echo base_url('sales/sale_return'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
           <a href="#" class="small-box-footer">Today Due Balance : <?php echo $duebalance['percentage']; ?>%</a>
            <div class="inner">
              <h3><?php echo $duebalance['total']; ?></h3>

              <p>Total Due Balance</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
           <a href="#" class="small-box-footer">Today Tickets : <?php echo $tickets['percentage']; ?>%</a>
            <div class="inner">
              <h3><?php echo $tickets['total']; ?></h3>

              <p>Total Tickets</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url('support/tickets'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

            <div class="row">
                

                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-bar-chart-o"></i>Sales Analytics</h3>
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
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-shopping-cart"></i>Latest Orders</h3>
                        </div>
                        <div class="box-body">
                           <div class="table-responsive">
    <table id="theme-table" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th class="col-sm-2 text-right">Purchase Id</th>
          <th class="col-sm-2 text-right">Order Id</th>
          <th class="text-right">Date Added</th>
          <th class="text-right">Total</th>
          <th class="text-right">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($orders['orders'])) { ?>
        <?php foreach ($orders['orders'] as $order) { ?>
        <tr>
          <td class="text-right"><?php echo $order['purchase_id']; ?></td>
          <td class="text-right"><?php echo $order['order_id']; ?></td>
          <td class="text-right"><?php echo $order['date_added']; ?></td>
          <td class="text-right"><?php echo $order['total']; ?></td>
          <td class="text-right"><a href="<?php echo $order['view']; ?>" data-toggle="tooltip" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
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
    </div>
</section>
    <!-- End : Main content -->
  </div>
<!-- End : Content Wrapper. Contains page content -->
<script type="text/javascript">
$(document).ready(function() {
    
    $.ajax({
        url: '<?php echo base_url('dashboard/dashboard/map/') ?>',
        dataType: 'json',
        success: function(json) {
            data = [];
                    
            for (i in json) {
                data[i] = json[i]['total'];
            }
                    
            $('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: '#FFFFFF',
                borderColor: '#FFFFFF',
                color: '#9FD5F1',
                hoverOpacity: 0.7,
                selectedColor: '#666666',
                enableZoom: true,
                showTooltip: true,
                values: data,
                normalizeFunction: 'polynomial',
                onLabelShow: function(event, label, code) {
                    if (json[code]) {
                        label.html('<strong>' + label.text() + '</strong><br />' + 'Orders : ' + json[code]['total'] + '<br />' + 'Sales : ' + json[code]['amount']);
                    }
                }
            });         
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });         
});
</script> 
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
                        if (typeof json['order'] == 'undefined') { return false; }
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
            
            $.plot('#chart-sale', [json['order'], json['customer']], option);   
                    
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