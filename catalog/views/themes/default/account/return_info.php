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
    <?php if(isset($error_warning) && $error_warning!==""): ?>
            <div class="alert alert-danger alert-bold-border">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button><i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error_warning;?> 
            </div>
        <?php endif; ?>
        <?php if(isset($success) && $success!==""): ?>
            <div class="alert alert-success alert-bold-border">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button><i class="fa fa-check-circle"></i>&nbsp;<?php echo $success;?> 
            </div>
        <?php endif; ?>
            <h4 class="account-title">Return Information</h4>
            <br>           
            <div class="table-responsive">
                <table class="table table-bordered cart_summary list">
                    <thead>
                        <tr>
                            <td class="text-left" colspan="2">Return Details</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>                        
                            <td class="text-left" style="width:50%;">
                                <b>Return ID: </b>#<?php echo $return_id; ?><br>
                                <b>Date Added: </b><?php echo $date_added; ?><br>
                            </td>
                            <td class="text-left" style="width:50%;">
                                <b>Order ID: </b>#<?php echo $order_id; ?><br>
                                <b>Order Date: </b><?php echo $date_ordered; ?><br>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <h3>Product Information</h3>
            <br>           
            <div class="table-responsive">
                <table class="table table-bordered cart_summary list">
                    <thead>
                        <tr>
                            <td class="text-left" style="width: 33.3%;">Product Name</td>
                            <td class="text-left" style="width: 33.3%;">Model</td>
                            <td class="text-right" style="width: 33.3%;">Quantity</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>                        
                            <td class="text-left"><?php echo $product; ?></td>
                            <td class="text-left"><?php echo $model; ?></td>
                            <td class="text-right"><?php echo $quantity; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <h3>Reason for Return</h3>
            <br>           
            <div class="table-responsive">
                <table class="table table-bordered cart_summary list">
                    <thead>
                        <tr>
                            <td class="text-left" style="width: 33.3%;">Reason</td>
                            <td class="text-left" style="width: 33.3%;">Opened</td>
                            <td class="text-right" style="width: 33.3%;">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>                        
                            <td class="text-left"><?php echo $reason; ?></td>
                            <td class="text-left"><?php echo $opened; ?></td>
                            <td class="text-right"><?php echo $action; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php if ($comment) { ?>
            <br>           
            <div class="table-responsive">
                <table class="table table-bordered cart_summary list">
                    <thead>
                        <tr>
                            <td class="text-left">Return Comments</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>                        
                            <td class="text-left"><?php echo $comment; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php } ?>
            <br>
            <h3>Return History</h3>
            <br>           
            <div class="table-responsive">
                <table class="table table-bordered cart_summary list">
                    <thead>
                        <tr>
                            <td class="text-left" style="width: 33.3%;">Date Added</td>
                            <td class="text-left" style="width: 33.3%;">Status</td>
                            <td class="text-left" style="width: 33.3%;">Comment</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($histories) { ?>
                        <?php foreach ($histories as $history) { ?>
                        <tr>                        
                            <td class="text-left"><?php echo $history['date_added']; ?></td>
                            <td class="text-left"><?php echo $history['status']; ?></td>
                            <td class="text-left"><?php echo $history['comment']; ?></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td class="text-center" colspan="3">No results!</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="buttons">
                <div class="pull-right">
                    <a class="btn btn-primary button btn-continue" href="<?php echo site_url('account/return_order'); ?>">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>