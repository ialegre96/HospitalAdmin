<script id="departmentActionTemplate" type="text/x-jsrender">
   <a title="<?php echo __('messages.common.edit') ?>" class="btn action-btn btn-success btn-sm edit-btn" data-id="{{:id}}">
            <i class="fa fa-edit action-icon"></i>
   </a>
   <a title="<?php echo __('messages.common.delete') ?>" class="btn action-btn btn-danger btn-sm delete-btn" data-id="{{:id}}">
            <i class="fa fa-trash action-icon"></i>
   </a>



</script>

<script id="departmentIsActiveTemplate" type="text/x-jsrender">
    <label class="switch switch-label switch-outline-primary-alt swich-center">
         <input name="is_active" data-id="{{:id}}" class="switch-input is-active" type="checkbox" value="1" {{:checked}} >
          <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
    </label>


</script>
