<script id="packagesReportActionTemplate" type="text/x-jsrender">
   <a title="<?php echo __('messages.common.edit'); ?>" class="btn action-btn btn-success btn-sm" href="{{:url}}">
            <i class="fa fa-edit action-icon"></i>
   </a>
   <a title="<?php echo __('messages.common.delete'); ?>" class="btn action-btn btn-danger btn-sm delete-btn" data-id="{{:id}}">
            <i class="fa fa-trash action-icon"></i>
   </a>



</script>
<script id="packageServiceTemplate" type="text/x-jsrender">
<tr>
    <td class="text-center item-number">1</td>
    <td class="table__item-desc">
        <select class="form-select serviceId form-select-solid" name="service_id[]" placeholder="<?php echo __('messages.package.select_service'); ?>" id="enquiry-medicine-id_{{:uniqueId}}" data-id="{{:uniqueId}}" required>
            <option selected="selected" value=0">Select Service</option>
            {{for services}}
                <option value="{{:key}}">{{:value}}</option>
            {{/for}}
        </select>
    </td>
    <td class="table__qty">
        <input class="form-control qty form-control-solid" required="" name="quantity[]" type="number">
    </td>
    <td>
        <input class="form-control price-input price form-control-solid" required="" name="rate[]" type="text">
    </td>
    <td class="amount text-right item-total">
    </td>
    <td class="text-center">
    <a href="#" title="<?php echo __('messages.common.delete') ?>"  class="delete-btn delete-service-package-item pointer btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" /></g></svg></span>
                    </a>
    </td>
</tr>



</script>
