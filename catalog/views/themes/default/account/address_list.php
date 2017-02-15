<style>
@media (max-width: 320px) {
    .menu-hidden4 {
        display: none !important;
    } 
}
@media (min-width: 321px) and (max-width: 360px) {
    .menu-hidden4 {
        display: none !important;
    }  
}
@media (min-width: 361px) and (max-width: 480px) {
    .menu-hidden4{
        display: none !important;
    }   
}
@media (min-width: 481px) and (max-width: 600px) {
    .menu-hidden4 {
        display: none !important;
    } 
}
@media (min-width: 601px) and (max-width: 640px) {
    .menu-hidden4 {
        display: none !important;
    } 
}
</style>div class="content">
    <?php if(isset($error_warning) && $error_warning!==""): ?>
      <div class="alert alert-danger alert-bold-border">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button>
        <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error_warning;?> </div>
    <?php endif; ?>
    
    <?php if($this->session->userdata('success1')!==NULL): ?>
      <div class="alert alert-success alert-bold-border">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px;font-size:20px">×</button>
        <i class="fa fa-check-circle"></i>&nbsp;<?php echo $this->session->userdata('success1');?> </div>
    <?php endif; ?>
    
    <form name="addressList" id="addressList" method="post">
    <table class="table">
        <tbody>
        <h4>View Address</h4>
        <br>
        <?php if(isset($records)) { ?>
        <?php foreach ($records as $record) { ?>
        <tr>
            <td class="text-left">
                <?php if($record['name']) {?>
                <?php echo $record['name']; ?>
                <br>
                <?php } ?>
                
                <?php if($record['company']) {?>
                <?php echo $record['company']; ?>
                <br>
                <?php } ?>
                
                <?php if($record['address_1']) {?>
                <?php echo $record['address_1'] ?>
                <br>
                <?php } ?>
                
                <?php if($record['address_2']) {?>
                <?php echo $record['address_2'] ?>
                <br>
                <?php } ?>
                
                <?php if($record['city']) {?>
                <?php echo $record['city']." ".$record['postcode']; ?>
                <br>
                <?php } ?>
                
                <?php if($record['state_id']) {?>
                <?php echo $this->common->getStateNameById($record['state_id']); ?>
                <br>
                <?php } ?>
                
                <?php if($record['country_id']) {?>
                <?php echo $this->common->getCountryNameById($record['country_id']); ?>
                <?php } ?>
            </td>

            <td class="text-center action-address">
                <!--<input type="submit" name="btnDelete" id="btnDelete" value="Delete" class="btn btn-danger button btn-delete pull-right" />-->
                <a class="btn btn-danger button btn-delete pull-right" href="<?php echo $record['delete']; ?>">Delete</a>
                <a class="btn btn-info button btn-edit pull-right" href="<?php echo $record['edit'];  ?>">Edit</a>

            </td>
        </tr>
        <?php } ?>
        <?php } else {?>
        <tr>
            <td colspan="2" style="color: grey">You have no addresses in your account.</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    </form>
    <div class="buttons">
        <div class="pull-left">
             <a class="btn btn-primary button btn-continue" href="<?php echo site_url('account/account'); ?>">Back</a>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary button btn-continue" href="<?php echo site_url('account/address_book/add') ?>">New Address</a>
        </div>
    </div>
</div>