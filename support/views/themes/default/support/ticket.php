
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-select/bootstrap-select.js"></script>
<link rel="stylesheet" href="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-select/bootstrap-select.css">
<style type="text/css">
    .withScroll {
  height: auto;
  overflow: auto;
  overflow: hidden;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Tickets </h1>
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li ><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
     
  </section>
    <!------------------ End Content Header (Page header) ------------------- -->
    <!-------------------------- Main content ------------------------------- -->
    <section class="content">
    <?php if (isset($error) && $error !== ""): ?>
                <div class="col-xs-12">
                    <div class="alert alert-danger alert-bold-border">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>

                        <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error; ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($success) && $success !== ""): ?>
                <div class="col-xs-12">
                    <div class="alert alert-success alert-bold-border">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>

                        <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success; ?>

                    </div>
                </div>
            <?php endif; ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header">
                        <h2 class="box-title col-sm-6"><i class="fa fa-pencil"></i> Manage Ticket</h2>
                    </div>
                    <div class="box-body ticket-main">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-lg-3 left-column ">
                                    <div class="col-xs-10 col-sm-10 col-lg-10 title-left-column">
                                        <select class="form-control" name="department" id="department">
                                            <option value="">ALL</option>
                                            <?php
                                                foreach ($user_groups as $key => $value) {
                                                    echo '<option value="'.$value['role_id'].'">'.$value['role_name'].'</option>';
                                                }
                                            ?>
                                            
                                        </select>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-lg-2 title-left-column">
                                        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#AddTicketModel" type="button"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="custom-info-search">
                                            <ul class="nav">
                                                <li class="append-icon">
                                                    <input type="text" class="form-control" placeholder="Search From Here." onkeyup="ticket_filter(this.value)">
                                                    <i class="fa fa-search"></i> </li>
                                            </ul>
                                        </div>
                                        <div class="custom-info">
                                            <ul id="ticket_details" class="nav">
                                                <?php 
                                                if(isset($ticket_list) && count($ticket_list) > 0)
                                                {
                                                foreach($ticket_list as $key=>$Ticket) {?>
                                                    <a href="<?php echo base_url('support/tickets/ticketdetail/'.$this->commons->encode($Ticket['ticket_id'])); ?>" style="text-decoration:none; cursor:pointer;">
                                                        <li class="ticket-list"> <font style="font-size:16px; color:#333;" title="<?php echo $Ticket['title'];?>"><?php echo $this->commons->neat_trim($Ticket['title'],10,'..');?> </font>
                                                             <?php 
                                                            if($Ticket['status']=='1')    
                                                            {
                                                                echo '<label class="btn btn-xs pull-right custom-label btn-info">OPEN</label>';
                                                            } 
                                                            else if($Ticket['status']=='2') 
                                                            { 
                                                                echo '<label class="btn btn-xs pull-right custom-label btn-danger">PENDING</label>';    
                                                            }
                                                            else if($Ticket['status']=='3') 
                                                            { 
                                                                echo '<label class="btn btn-xs pull-right custom-label btn-success">CLOSED</label>';        
                                                            }
                                                            ?>
                                                            <p class="ticket-short-details"> <i title="Ticket Code">#<?php echo $Ticket['ticket_code'];?></i> | <i title="Role"><?php echo $Ticket['RoleName'];?></i> </p>
                                                            <p class="pull-right time-ago"> <i title="Created On" class="fa fa-clock-o"> <?php echo $this->commons->time_ago($Ticket['date_added']);?></i> </p>
                                                        </li>
                                                    </a>
                                                    <?php 
                                                    }
                                                } ?>    

                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-lg-9 right-column">
                                <!-- ---- Start: Ticket Info----- -->
                                <?php if(isset($Ticket_info)){?>
                                    <div class="row action-btn">
                                        <div class="col-xs-12">
                                            <ul class="nav nav-pills">
                                                <li>
                                                    <button class="btn btn-primary" onclick="edit_ticket()" title="Edit Ticket" data-toggle="modal" data-target="#TicketModel" type="button"> <i class="fa fa-edit"></i> Edit Ticket </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-toggle btn btn-primary" data-toggle="dropdown" href="#" aria-expanded="false" style="margin-bottom:5px;"> Change Status <span class="caret"></span>
                                                        <div class="ripple-wrapper"></div>
                                                    </button>
                                                    <ul class="dropdown-menu info" role="menu">
                                                        <li><a href="<?php echo base_url('support/tickets/changeticketstatus/1/'.$this->commons->encode($Ticket_info['ticket_id']));?>">Open</a></li>
                        <li><a href="<?php echo base_url('support/tickets/changeticketstatus/2/'.$this->commons->encode($Ticket_info['ticket_id']));?>">Pending</a></li>
                        <li><a href="<?php echo base_url('support/tickets/changeticketstatus/3/'.$this->commons->encode($Ticket_info['ticket_id']));?>">Closed</a></li>
                                                    </ul>
                                                </li>
                                               
                                                <li class="pull-right"><a href="<?php echo base_url('support/tickets/delete/'.$this->commons->encode($Ticket_info['ticket_id']))?>" onclick="return confirm('Are You Sure To Delete This Ticket ?');"  title="Delete Ticket">
                      <button class="btn btn-danger"><i class="fa fa-trash" style="color:rgba(255, 255, 255, 0.84) !important;"></i> Delete</button>
                      </a> 
                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-4">
                                            <ul class="nav ticket_info">
                                                <li> Ticket Code <i class="pull-right"> #<?php echo $Ticket_info['ticket_code'];?></i> </li>
                                                <li> Created By <i class="pull-right" title="<?php echo $Ticket_info['create_by'];?>"> <?php echo $this->commons->neat_trim($Ticket_info['create_by'],10,'..');?> </i> </li>
                                                 <li> On Behalf of <i class="pull-right" title="<?php echo $Ticket_info['behalf_of'];?>"> <?php echo $this->commons->neat_trim($Ticket_info['behalf_of'],10,'..');?> </i> </li>
                                                <li> Status <i class="pull-right">
                                                <?php 
                                                    if($Ticket_info['status']=='1')    
                                                    {
                                                        echo '<label class="btn btn-xs pull-right custom-label btn-info">OPEN</label>';
                                                    } 
                                                    else if($Ticket_info['status']=='2') 
                                                    { 
                                                        echo '<label class="btn btn-xs pull-right custom-label btn-danger">PENDING</label>';    
                                                    }
                                                    else if($Ticket_info['status']=='3') 
                                                    { 
                                                        echo '<label class="btn btn-xs pull-right custom-label btn-success">CLOSED</label>';        
                                                    }
                                                ?>
                                                </i> </li>
                                                <li> Priority <i class="pull-right"><?php echo $Ticket_info['priority'];?> </i> </li>
                                                <li> Created <i class="pull-right"> <?php echo date('d-M-Y',strtotime($Ticket_info['date_added']));?> </i> </li>
                                            </ul>
                                            <br/>
                                            <?php if($Ticket_info['description']) :?>
                                              <div class="tkt-desc"> <b>Description :-</b>
                                                <p style="font-size:13px; text-align:justify;">
                                                  <?php echo $Ticket_info['description']?>
                                                </p>
                                              </div>
                                              <?php endif;?>
                                           <?php if($Ticket_info['attachments'] != NULL) : $attachement=explode('|',$Ticket_info['attachments']);?>
                                              <div style="border-top:1px dashed #CCC; padding-bottom:5px;"></div>
                                              <p style="font-size:13px;">Attachment : </p>
                                              <p>
                                              <ul style="padding-left: 15px;">
                                                <?php foreach($attachement as $key=>$attach) :?>
                                                <li><a href="<?php echo HTTP_CATALOG.'uploads/tickets_attachments/'.$attach;?>" target="_blank"> Attachment
                                                  <?php ++$key ?>
                                                  </a> </li>
                                                <?php endforeach;?>
                                              </ul>
                                              </p>
                                              <?php endif;?>
                                        </div>
                                        <div class="col-xs-12 col-lg-8 reply-column">
                                            <div class="row reply-column-title" style="">
                                                <div class="col-sm-12">
                                                    <h3 style="margin:0px;"> <?php echo $Ticket_info['title'];?> </h3>
                                                </div>
                                            </div>
                                            <div class="row reply-column-title" style="">
                                                <div class="col-sm-12">
                                                    <h5 style="margin:0px;">Comments</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div>
                                                        <ul class="timeline">
                                                            <li class="centering-line"></li>
                                                            <li class="item-timeline post-form-timeline">
                                                                <div class="buletan" style="top:55px;left: 1px;"></div>
                                                                <div class="inner-content">
                                                                    <form id="reply-ticket" action="<?php echo base_url('support/tickets/reply')?>" method="post" style="margin-top:-1px" enctype="multipart/form-data" novalidate="novalidate">
                                                                     <input type="hidden" name="ticket_id" value="<?php echo $Ticket_info['ticket_id'];?>">
                                                                    <input type="hidden" name="ticket_reply_id" id="ticket_reply_id">
                                                                   
                                                                        <div class="item-textarea form-group">
                                                                            <textarea id="ReplyText" class="form-control form-white autosize" placeholder="Ticket Reply" rows="5" name="ReplyText"></textarea>
                                                                        </div>
                                                                       <!-- <span class="btn btn-primary btn-file btn-sm form-control" style="margin-bottom:5px;"> <i class="fa fa-plus"></i> Attachments
                                                                              
                                                                             </span> -->
                                                                             <!--  <div class="form-group">
                                                                            <input multiple="" class="form-control" name="Attachments" type="file">
                                                                            
                                                                            <br/>
                                                                            <label class="text-muted">Only 5 MB File Size are Allowed </label>
                                                                            </div> -->
                                                                             <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group myclass-reply">
                                                                                        <label for="fileInput1" class="control-label">Attachment</label>
                                                                                        <input type="file" id="fileInput3" name="Attachments" class="filestyle img-select-data ">
                                                                                        <input id="HAttachments" name="HAttachments" type="hidden">
                                                                                        <br/>
                                                                                        <label class="text-muted">Only 5 MB File Size are Allowed </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <button class="btn btn-primary btn-sm pull-right" type="submit" style="margin-bottom:5px;">Reply Ticket</button>
                                                                    </form>
                                                                </div>
                                                            </li>
                                                            <?php foreach($Ticket_info['Ticket_reply'] as $Ticket_note) :?>
                                                              <li class="item-timeline post-form-timeline" style="width:100%" id="Ticket_note_<?php echo $Ticket_note['ticket_reply_id'];?>">
                                                                <div class="buletan" style="top:35px;left: 1px;position: relative;"></div>
                                                                <div class="inner-content custom-inner-content <?php if($Ticket_note['added_by'] == $this->session->userdata('support_user_id')) { echo 'User_Note'; }?>">
                                                                  <div style="border-bottom:#CCC 1px solid; padding:5px;">
                                                                    <div class="row">
                                                                      <div class="col-xs-12 col-sm-8"> <strong>
                                                                       <?php echo $Ticket_note['created_by']; ?>
                                                                        </strong> </div>
                                                                      <div class="col-xs-12 col-sm-4">
                                                                        <div class="pull-right">
                                                                          <?php if($Ticket_note['added_by'] == $this->session->userdata('support_user_id')) :?>
                                                                          <a href="#" title="Edit Ticket Note" onclick="ticket_note_edit(<?php echo $Ticket_note['ticket_reply_id'];?>)"><i class="fa fa-pencil"></i></a> <a href="#" title="Delete Ticket Note" onclick="ticket_note_delete('<?php echo $Ticket_note['ticket_reply_id']; ?>')"><i class="fa fa-times"></i></a>
                                                                          <?php endif;?>
                                                                        </div>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                  <div class="row">
                                                                        <div class="col-xs-12 col-sm-12">
                                                                  <p class="text-justify">
                                                                    <?php echo $Ticket_note['description']?>
                                                                  </p>
                                                                  <?php if($Ticket_note['attachments'] != NULL) : $Attachments=explode('|',$Ticket_note['attachments']);?>
                                                                  <p> Attachment :
                                                                  <ul style="padding-left: 35px;">
                                                                    <?php foreach($Attachments as $key=>$attach_note) :?>
                                                                    <li><a href="<?php echo HTTP_CATALOG.'uploads/tickets_attachments/'.$attach_note;?>" target="_blank"> Attachment
                                                                      <?php ++$key ?>
                                                                      </a> </li>
                                                                    <?php endforeach;?>
                                                                  </ul>
                                                                  </p>
                                                                  <?php endif;?>
                                                                  <p class="pull-right" style="margin-top:-15px"> <i class="fa fa-clock-o "></i>
                                                                    <?php echo $this->commons->time_ago($Ticket_note['date_added']);?>
                                                                  </p>
                                                                  </div>
                                                                  </div>
                                                                </div>
                                                                <!-- /.inner-content --> 
                                                              </li>
                                                              <?php endforeach;?>
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php }?>
                                    <!-- ---- End: Ticket Info----- -->
                                </div>
                            </div>
                        
                    </div>
                    <!-- End : box-body -->
                </div>
            </div>
        </div>
    </section>
    <!----------------------- Main content ------------------------------->
</div>
<!------------------- End content-wrapper ---------------------------->
<!-------------------Edit Ticket MODEL----------------------- -->
<div class="modal fade" id="TicketModel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-no-shadow">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>Edit Ticket</strong></h3>
            </div>
             <form action="<?php echo base_url('support/tickets/edit_ticket');?>" method="post" enctype="multipart/form-data" id="edit-ticket">
                <input type="hidden" name="ticket_id" id="ticket_id" value="<?php if(isset($Ticket_info['ticket_id'])){ echo $Ticket_info['ticket_id'];}?>">
                <div class="modal-body">
                    <div class="row">
                     <div class="col-lg-12 form-group">
                         <label class="control-label">Select User Type:</label>
                            <select class="form-control" name="user_type" id="edit_user_type" data-live-search="true">
                                <option value="">Select User Type</option>
                                <?php
                                    foreach ($user_groups as $key => $value) {
                                        echo '<option value="'.$value['role_id'].'">'.$value['role_name'].'</option>';
                                    }
                                ?>
                                
                            </select>
                            <script type="text/javascript">
                                $('#edit_user_type').val('<?php if(isset($Ticket_info['department_id'])){ echo $Ticket_info['department_id'];}?>');
                                
                            </script>

                        </div>
                        <div class="col-lg-12 form-group">
                            <label class="control-label">User List :</label>
                            <select name="user_list" id="edit_user_list" class="form-control" data-live-search="true">
                                <option value="">Select User</option>
                                
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Title :</label>
                            <input type="text" name="Title" id="Title" class="form-control" value="<?php if(isset($Ticket_info['title'])){ echo $Ticket_info['title'];}?>">

                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Priority :</label>
                            <select class="selectpicker form-control" name="Priority" id="Priority">
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                            <script type="text/javascript">
                                $('#Priority').val('<?php if(isset($Ticket_info['priority'])){ echo $Ticket_info['priority'];}?>');
                            </script>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Description :</label>
                            <textarea name="Description" id="Description" class="form-control"></textarea>
                            <!-- Text Area Value Assign via function edit_ticket()-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group myclass-edit">
                                <label for="fileInput" class="control-label">Attachment</label>
                                <input type="file" id="fileInput" name="Attachments" class="filestyle img-select-data">
                                <br/>
                                <label class="text-muted">Only 5 MB File Size are Allowed </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Edit </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ================================= End Modal ========================== -->
<!-------------------Add Ticket MODEL----------------------- -->
<div class="modal fade" id="AddTicketModel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>ADD TICKET</strong></h3>
            </div>
            <form action="<?php echo base_url('support/tickets/add_ticket');?>" method="post" enctype="multipart/form-data" id="add-ticket">
                <div class="modal-body">
                    <div class="row">
                         <div class="col-lg-12 form-group">
                         <label class="control-label">Select User Type:</label>
                            <select class="form-control" name="user_type" id="user_type" data-live-search="true">
                                <option value="">Select User Type</option>
                                <?php
                                    foreach ($user_groups as $key => $value) {
                                        echo '<option value="'.$value['role_id'].'">'.$value['role_name'].'</option>';
                                    }
                                ?>
                                
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <label class="control-label">Select User:</label>
                            <select name="user_list" id="user_list" class="form-control" data-live-search="true">
                                <option value="">Select User</option>
                                
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Title :</label>
                            <input type="text" name="Title" class="form-control">
                             
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Serverity :</label>
                            <select class="selectpicker form-control" name="Priority">
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label>Description :</label>
                            <textarea name="Description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group myclass">
                                <label for="fileInput1" class="control-label">Attachment</label>
                                <input type="file" id="fileInput1" name="Attachments" class="filestyle img-select-data ">
                                <br/>
                                <label class="text-muted">Only 5 MB File Size are Allowed </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ================================= Add Ticket : End Modal ========================== -->
<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"></script>
<script src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/jquery-validation/jquery.validate.js"></script> <!-- Form Validation --> 
<script type="text/javascript">

    function ticket_filter(val)
    {
        var rex = new RegExp(val, 'i');
                $('.custom-info .ticket-list').hide();
                $('.custom-info .ticket-list').filter(function () {
                    return rex.test($(this).text());
                }).show();  
    }
    function edit_ticket()
    {
        $("#Description").html("<?php echo isset($Ticket_info['description'])?$Ticket_info['description']:'';?>");   
    }
    /* Deparment wise Tickes List fill*/
    $('select[name=\'department\']').on('change', function() {
        var role_id = $(this).val();
         $.ajax({
            url: "<?php echo base_url('support/tickets/getTicketListByRoleId');?>",
            type: "post",
            data: {role_id:role_id},
             async : false,
            dataType: 'json',
            success: function (response) {
                var html = "";
                if(response)
                {
                    $.each(response, function(key,val) {
                        html += '<a href="'+val.href+'" style="text-decoration:none; cursor:pointer;">';
                        html += '<li class="ticket-list"> <font style="font-size:16px; color:#333;" title="'+val.title+'">'+val.title+'</font>';
                        html +=  val.status;
                        html += '<p class="ticket-short-details"> <i title="Ticket Code">#'+val.ticket_code+'</i> | <i title="Role">'+val.role_name+'</i> </p>';
                        html += '<p class="pull-right time-ago"> <i title="Created On" class="fa fa-clock-o">'+val.date_added+'</i> </p></li></a>'
                    });     
                }
           $('#ticket_details').html(html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    });
  });

    /* Role wise User List fill*/
    $('select[name=\'user_type\']').on('change', function() {
        var role_id = $(this).val();
         $.ajax({
            url: "<?php echo base_url('support/tickets/getUserListByRoleId');?>",
            type: "post",
            data: {role_id:role_id},
             async : false,
            dataType: 'json',
            success: function (response) {
                var html = '<option value="">Select User</option>';
                if(response)
                {
                    $.each(response, function(key,val) {
                        html += '<option value="'+val.user_id+'">'+val.user_name+'</option>';
                    });     
                }
           $('select[name=\'user_list\']').html(html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    });
  });
    function ticket_note_edit(tid)
    {
        $.post('<?php echo base_url('support/tickets/fetch_ticket_reply');?>',{TicketReplyId:tid},function(data){
            $("#reply-ticket #ticket_reply_id").val(data['ticket_reply_id']);
            $("#reply-ticket #ReplyText").val(data['description']);
            $("#reply-ticket #HAttachments").val(data['attachments']);
            },'json');  
    }

    function ticket_note_delete(tid)
    {
        if (confirm('Are You Sure To Delete This Ticket Note ?')) 
        {
            $.post('<?php echo base_url('support/tickets/delete_ticket_note');?>',{TicketReplyId:tid},function(data){
                
            $("#Ticket_note_"+tid).remove();
            });
        } 
        else 
        {
            return false;
        }   
    }    
$(document).ready(function(){

    $('#edit_user_type').trigger('change');
    $('#edit_user_list').val('<?php if(isset($Ticket_info['customer_id'])){ echo $Ticket_info['customer_id'];}?>');
});
jQuery.validator.addMethod('filesize123', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return false; 
});
jQuery.validator.addMethod(
    "MaxSize",
    function(value, element) {

        console.log("file="+value);
        if(value)
        {
            var size = element.files[0].size;
           if (size > 5242880)// checks the file more than 1 MB
           {
                return false;
           } else {
               return true;
           }   
        }
        else
        {
            return true;
        }
        
    },
    "Please upload less than 5 MB file."
);

//======================================================================================
$('#add-ticket').validate({
        highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        // $(".input-group").after();
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(element).closest('.error').remove();
    },
     errorPlacement: function(error, element) {
                     console.log($(element).attr("name"));
                       //$(".input-group").after(error);
                       if($(element).attr("name") == 'Attachments')
                       {
                        $(".myclass .input-group").after(error); 
                       }
                       else
                       {
                        $(element).after(error); 
                       }
                       
                    },
    ignore:[],
    rules: {
            user_type: {
                required: true,
            },
            user_list: {
                required: true,
            },
            Title: {
                required: true,
                
            },
            Priority: {
                required: true,
            },
            Attachments: {
                required: false,
                MaxSize: true,
              
            }
    },
    messages: {
            user_type: {
                    required: "Please Select User Type."
            },
            user_list: {
                    required: "Please Select User."
            },
            Title: {
                    required: "Please Provide Title."
            },
            Priority: {
                required: "Please Provide Priority."
            }
    }
});   

//======================================================================================
$('#edit-ticket').validate({
        highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(element).closest('.error').remove();
    },
    errorPlacement: function(error, element) {
                     console.log($(element).attr("name"));
                       //$(".input-group").after(error);
                       if($(element).attr("name") == 'Attachments')
                       {
                        $(".myclass-edit .input-group").after(error); 
                       }
                       else
                       {
                        $(element).after(error); 
                       }
                       
                    },
    ignore:[],
    rules: {
            user_type: {
                required: true,
            },
            user_list: {
                required: true,
            },
            Title: {
                required: true,
            },
            Priority: {
                required: true,
            },
            Attachments: {
                MaxSize: true,
              
            }
    },
    messages: {
            user_type: {
                    required: "Please Select User Type."
            },
            user_list: {
                    required: "Please Select User."
            },
            Title: {
                    required: "Please Provide Title."
            },
            Priority: {
                required: "Please Provide Priority."
            }
    }
}); 
$('#reply-ticket').validate({
        highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(element).closest('.error').remove();
    },
    errorPlacement: function(error, element) {
                     console.log($(element).attr("name"));
                       //$(".input-group").after(error);
                       if($(element).attr("name") == 'Attachments')
                       {
                        $(".myclass-reply .input-group").after(error); 
                       }
                       else
                       {
                        $(element).after(error); 
                       }
                       
                    },
                    ignore:[],
    rules: {
            ReplyText: {
                required: true,
            },
            Attachments: {
                MaxSize: true,
              
            }
    },
    messages: {
            ReplyText: {
                    required: "Please Provide Description."
            }
    }
});  

</script>