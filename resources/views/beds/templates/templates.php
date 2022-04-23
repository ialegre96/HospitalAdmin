<script id="bedActionTemplate" type="text/x-jsrender">
   <a title="<?php echo __('messages.common.edit'); ?>" class="btn action-btn btn-success btn-sm edit-btn" data-id="{{:id}}">
            <i class="fa fa-edit action-icon"></i>
   </a>
   <a title="<?php echo __('messages.common.delete'); ?>" class="btn action-btn btn-danger btn-sm delete-btn" data-id="{{:id}}">
            <i class="fa fa-trash action-icon"></i>
   </a>

</script>
<script id="bulkBedActionTemplate" type="text/x-jsrender">
    <tr>
        <td class="text-center item-number">1</td>
        <td>
            <input name="name[]" type="text" class="form-control bedName form-control-solid" required>
        </td>
        <td>
            <select class="form-select bedType form-select-solid fw-bold" name="bed_type[]" placeholder="Select Bed Type" id="bulk-bed-id_{{:uniqueId}}" data-id="{{:uniqueId}}" required>
                <option selected="selected" value >Select Bed Type</option>
                {{for bedTypes}}
                    <option value="{{:key}}">{{:value}}</option>
                {{/for}}
            </select>
        </td>
        <td>
            <input name="charge[]" type="text" class="form-control charge price-input form-control-solid" required>
        </td>
        <td>
            <textarea name="description[]" type="text" class="form-control description form-control-solid" rows="1"></textarea>
        </td>
        <td class="text-center">
         <a href="#" title="<?php echo __('messages.common.delete') ?>"  class="delete-btn delete-invoice-item pointer btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
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
