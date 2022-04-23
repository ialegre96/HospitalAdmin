<script id="enquiryActionTemplate" type="text/x-jsrender">
    <a href="{{:url}}" title="<?php echo __('messages.common.view') ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
<i class="fas fa-eye fs-4"></i>
    </a>



</script>

<script id="enquiryStatusTemplate" type="text/x-jsrender">
 <label class="form-check form-switch form-check-custom form-check-solid form-switch-sm">
         <input name="status" data-id="{{:id}}" class="form-check-input status" type="checkbox" value="1" {{:checked}} >
          <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
    </label>

</script>
