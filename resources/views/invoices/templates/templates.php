<script id="invoiceActionTemplate" type="text/x-jsrender">
   <a title="<?php echo __('messages.common.edit'); ?>" class="btn action-btn btn-success btn-sm" href="{{:url}}">
            <i class="fa fa-edit action-icon"></i>
   </a>
   <a title="<?php echo __('messages.common.delete'); ?>" class="btn action-btn btn-danger btn-sm delete-btn" data-id="{{:id}}">
            <i class="fa fa-trash action-icon"></i>
   </a>



</script>

<script id="invoiceItemTemplate" type="text/x-jsrender">
<tr class="border-bottom border-bottom-dashed">
    <td class="text-center item-number">1</td>
    <td class="table__item-desc">
        <select class="form-select accountId form-select-solid fw-bold" name="account_id[]" placeholder="Select Account" id="enquiry-account-id_{{:uniqueId}}" data-id="{{:uniqueId}}" required>
            <option selected="selected" value=0">Select Account</option>
            {{for accounts}}
                <option value="{{:key}}">{{:value}}</option>
            {{/for}}
        </select>
    </td>
    <td>
        <input class="form-control form-control-solid" name="description[]" type="text">
    </td>
    <td class="table__qty">
        <input class="form-control qty form-control-solid" required="" name="quantity[]" type="number" min="1">
    </td>
    <td>
        <input class="form-control price-input price form-control-solid" required="" name="price[]" type="text">
    </td>
    <td class="amount text-end item-total pt-8 text-nowrap">

    </td>
    <td class="text-end">
        <button type="button" class="btn btn-sm btn-icon btn-active-color-danger delete-invoice-item">
                <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                    </svg>
                </span>
        </button>
    </td>
</tr>


</script>
