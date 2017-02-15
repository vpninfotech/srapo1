<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </div>
        <!-- ./breadcrumb -->
        <div class="page-content">
        <?php if(isset($error) && $error!==""): ?>
            <div class="alert alert-danger alert-bold-border">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button><i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error;?> 
            </div>
        <?php endif; ?>
        <?php if($this->session->userdata('success')!==NULL): ?>
            <div class="alert alert-success alert-bold-border">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button><i class="fa fa-check-circle"></i>&nbsp;<?php echo $this->session->userdata('success');?> 
            </div>
        <?php endif; ?>
            <h4 class="account-title">Order History</h4>
            <br>
            <?php if(isset($records)) { ?>
            <div class="table-responsive">
                <table class="table table-bordered cart_summary list">
                    <thead>
                        <tr>
                            <td class="text-right">Order ID</td>
                            <td class="">Customer</td>
                            <td class="text-right">No. of Products</td>
                            <td class="">Payment Method</td>
                            <td class="">Status</td>
                            <td class="text-right">Total</td>
                            <td class="">Date Added</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($records as $record) { ?>
                            <tr>
                                <td class="text-right">#<?php echo $record['order_id']; ?></td>
                                <td class=""><?php echo $record['name']; ?></td>
                                <td class="text-right"><?php echo $record['products']; ?></td>
                                 <td class=""><?php echo $record['payment_method']; ?></td>
                                <td class=""><?php echo $record['status']; ?></td>
                                <td class="text-right"><?php echo $record['total']; ?></td>
                                <td class=""><?php echo $record['date_added']; ?></td>
                                <td class="text-right">
                                    <a href="<?php echo $record['view']; ?>" class="btn btn-quantity" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>
                                    <!--<button class="btn btn-quantity"><i class="fa fa-refresh"></i></button>-->
                                </td>
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
                <p>"You have not made any previous orders!"</p>                
            <?php } ?>
            <div class="buttons">
                <div class="pull-right">
                    <a class="btn btn-primary button btn-continue" href="<?php echo site_url('account/account'); ?>">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>