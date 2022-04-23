<script id="itemStockActionTemplate" type="text/x-jsrender">
    {{if hasAttachment}}
        <a title="<?php echo __('messages.common.save'); ?>" class="btn action-btn btn-primary btn-sm" href="{{:attachmentSaveUrl}}" download>
             <i class="fa fa-download action-icon"></i>
        </a>
    {{/if}}
    <a title="<?php echo __('messages.common.edit'); ?>" class="btn action-btn btn-success btn-sm" href="{{:url}}">
         <i class="fa fa-edit action-icon"></i>
    </a>
    <a title="Delete" class="btn action-btn btn-danger btn-sm delete-btn" data-id="{{:id}}">
         <i class="fa fa-trash action-icon"></i>
    </a>

</script>
