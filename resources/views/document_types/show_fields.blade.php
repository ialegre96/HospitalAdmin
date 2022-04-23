<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__('messages.document.document_type_details')}}</h3>
                    </div>
                    <div class="d-flex align-items-center py-1">
                        <a class="btn btn-sm btn-primary me-2 edit-btn"
                           data-id="{{ $documentType->id }}">{{ __('messages.common.edit') }}</a>
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-light btn-active-light-primary pull-right">{{ __('messages.common.back') }}</a>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.document.document_type').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800">{{ $documentType->name}}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label
                                    class="fw-bold text-muted py-3">{{ __('messages.common.created_at').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($documentType->created_at)) }}">{{ $documentType->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-3 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.last_updated').(':')  }}</label>
                                <span class="fw-bolder fs-6 text-gray-800" data-toggle="tooltip" data-placement="right" title="{{ date('jS M, Y', strtotime($documentType->updated_at)) }}">{{ $documentType->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('messages.document.documents') }}</h3>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive viewList">
                        @include('layouts.search-component')
                        <table id="userDocuments" class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable no-footer w-100">
                            <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th>{{ __('messages.document.attachment') }}</th>
                                <th>{{ __('messages.document.title') }}</th>
                                <th>{{ __('messages.document.patient') }}</th>
                                <th>{{ __('messages.document.uploaded_by') }}</th>
                            </tr>
                            </thead>
                            <tbody class="fw-bold">
                            @foreach($documents as $document)
                                <tr>
                                    <td><a href="{{ url('document-download'.'/'.$document->id) }}">Download</a></td>
                                    <td>{{ $document->title }}</td>
                                    <td>{{ $document->patient->user->full_name }}</td>
                                    <td>{{ $document->user->full_name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
