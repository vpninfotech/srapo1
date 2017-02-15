<style>
    .order_success p {
        margin: 0 0 10px;
    }
</style>
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->

        <!-- ./breadcrumb -->
        <!-- page heading-->

        <!-- Start : page heading-->
        <div class="page-content order_success">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="page-heading">
                        <?php if ($this->session->flashdata('success')) { ?>
                            <span class="page-heading-title2">Congratulations...!</span>
                        <?php } elseif ($this->session->flashdata('warning')) { ?>
                            <span class="page-heading-title2">Invalid...!</span>
                        <?php } ?>
                    </h2>
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php } elseif ($this->session->flashdata('warning')) { ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('warning'); ?></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- End : page heading-->
    </div>
</div>