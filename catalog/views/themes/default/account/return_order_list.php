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
        <!-- page heading-->
        <!--<h2 class="page-heading">
            <span class="page-heading-title2">Your Transaction</span>
        </h2>-->
        <!-- ../page heading-->
<div class="page-content">
            <h4 class="account-title">Product Returns</h4>
            <br>
            <?php if(isset($records)) { ?>
            <div class="table-responsive">
                <table class="table table-bordered cart_summary list">
                  <thead>
                    <tr>
                    <td class="text-right">Return ID</td>
                    <td class="">Status</td>
                    <td class="">Date Added</td>
                    <td class="text-right">Order ID</td>
                    <td class="">Customer</td>
                    <td class="text-right"></td>                    
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php foreach($records as $record) { ?>
                    <tr>
                        <td class="text-right">#<?php echo $record['return_id']; ?></td>
                        <td class="text-left"><?php echo $record['status']; ?></td>
                        <td class="text-left"><?php echo $record['date_added']; ?></td>
                        <td class="text-right"><?php echo $record['order_id']; ?></td>
                        <td class="text-left"><?php echo $record['name']; ?></td>
                        <td class="text-right"><a href="<?php echo $record['view']; ?>" class="btn btn-quantity" style="margin-right: 5px;"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
            </div>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                <div class="col-sm-6 text-right"><?php if(isset($records)){$count = count($records);}else {$count=0;} ?>
    Showing <?php echo (int)$range; ?> to <?php echo (int)($range+$count-1); ?> of <?php echo (int)$totals; ?> (<?php echo (int)$pages; ?> Pages)</div>
            </div>
            <?php } else { ?>                
                <p>"You have not made any previous returns!"</p>                
            <?php } ?>
            <div class="buttons">
                    <div class="pull-right">
                        <a class="btn btn-primary button btn-continue" href="<?php echo site_url('account/account'); ?>">Back</a>
                    </div>
                </div>
        </div>
      </div>
      </div>