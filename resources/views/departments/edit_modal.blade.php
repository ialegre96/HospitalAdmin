<div id="EditModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.role.edit_role') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger display-none" id="editValidationErrorsBox"></div>
                {{ Form::hidden('departmentId',null,['id'=>'departmentId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('name', __('messages.common.name').':') }}<span class="required">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control','required','id'=>'editName']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('is_active', __('messages.common.active').':') }}
                        <label class="switch switch-label switch-outline-primary-alt d-block">
                            <input name="is_active" class="switch-input" type="checkbox" value="1" id="editIsActive">
                            <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                        </label>
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnCancelEdit" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
