<?php if(isset($reviews)) { ?>
	<?php foreach($reviews as $review) { ?>
<div class="comment row">
    <div class="col-sm-3 author">
        <div class="grade">
            <span class="reviewRating">
                <?php if ($review['rating']) { ?>
                 <div class="product-star">
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($review['rating'] < $i) { ?>
                  <i class="fa fa-star-o"></i>
                  <?php } else { ?>
                  <i class="fa fa-star"></i>
                  <?php } ?>
                  <?php } ?>
                </div>
                <?php } ?>
            </span>
        </div>
        <div class="info-author">
            <span><strong><?php echo $review['author'];?></strong></span>
            <em><?php echo $review['date_added'];?></em>
        </div>
    </div>
    <div class="col-sm-9 commnet-dettail">
        <?php echo $review['text'];?>
    </div>
</div>
<?php } ?>
<?php } ?>
<br />