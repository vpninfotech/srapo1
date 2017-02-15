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
      <h1>Tickets Reply</h1>
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
            <i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo $error; ?> </div>
      </div>
      <?php endif; ?>
      <?php if (isset($success) && $success !== ""): ?>
      <div class="col-xs-12">
         <div class="alert alert-success alert-bold-border">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position:relative;right:0px">×</button>
            <i class="fa fa-check-circle"></i>&nbsp;<?php echo $success; ?> </div>
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
                     <div class="col-xs-12 col-sm-12 col-lg-12 right-column"> 
                        <!-- ---- Start: Ticket Info----- -->
                        <?php if(isset($Ticket_info)){?>
                        <div class="row action-btn">
                           <div class="col-xs-12">
                              <ul class="nav nav-pills">
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
                              </ul>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12 col-lg-4">
                              <ul class="nav ticket_info">
                                 <li> Ticket Code <i class="pull-right"> #<?php echo $Ticket_info['ticket_code'];?></i> </li>
                                 <li> Created By <i class="pull-right" title="<?php echo $Ticket_info['create_by'];?>"> <?php echo $this->commons->neat_trim($Ticket_info['create_by'],30,'..');?> </i> </li>
                                 <li> On Behalf of <i class="pull-right" title="<?php echo $Ticket_info['behalf_of'];?>"> <?php echo $this->commons->neat_trim($Ticket_info['behalf_of'],30,'..');?> </i> </li>
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
                                 <p style="font-size:13px; text-align:justify;"> <?php echo $Ticket_info['description']?> </p>
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
                                                <form id="reply-ticket" action="<?php echo base_url('support/'.$this->uri->segment(2).'/reply')?>" method="post" style="margin-top:-1px" enctype="multipart/form-data" novalidate="novalidate">
                                                   <input type="hidden" name="ticket_id" value="<?php echo $Ticket_info['ticket_id'];?>">
                                                   <input type="hidden" name="ticket_reply_id" id="ticket_reply_id">
                                                   <div class="item-textarea form-group">
                                                      <textarea id="ReplyText" class="form-control form-white autosize" placeholder="Ticket Reply" rows="5" name="ReplyText"></textarea>
                                                   </div>
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
                                             <div class="inner-content custom-inner-content <?php if($Ticket_note['added_by'] == $this->session->userdata('Duser_id')) { echo 'User_Note'; }?>">
                                                <div style="border-bottom:#CCC 1px solid; padding:5px;">
                                                   <div class="row">
                                                      <div class="col-xs-12 col-sm-8"> <strong> <?php echo $Ticket_note['created_by']; ?> </strong> </div>
                                                      <div class="col-xs-12 col-sm-4">
                                                         <div class="pull-right">
                                                            <?php if($Ticket_note['added_by'] == $this->session->userdata('Duser_id')) :?>
                                                            <a href="#" title="Edit Ticket Note" onclick="ticket_note_edit(<?php echo $Ticket_note['ticket_reply_id'];?>)"><i class="fa fa-pencil"></i></a> <a href="#" title="Delete Ticket Note" onclick="ticket_note_delete('<?php echo $Ticket_note['ticket_reply_id']; ?>')"><i class="fa fa-times"></i></a>
                                                            <?php endif;?>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-xs-12 col-sm-12">
                                                      <p class="text-justify"> <?php echo $Ticket_note['description']?> </p>
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
                                                      <p class="pull-right" style="margin-top:-15px"> <i class="fa fa-clock-o "></i> <?php echo $this->commons->time_ago($Ticket_note['date_added']);?> </p>
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

<script type="text/javascript" src="<?php echo ADMIN_PATH.$this->common->config('admin_theme'); ?>/plugins/bootstrap-filestyle/bootstrap-filestyle.js"></script> 
<script type="text/javascript">

   
    

   
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