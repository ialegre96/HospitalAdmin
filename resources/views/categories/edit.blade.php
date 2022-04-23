@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{{ route('categories.index') }}">Category</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('layouts.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Edit Category</strong>
                          </div>
                          <div class="card-body">
                              {{ Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'patch']) }}

                              @include('categories.fields')

                              {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection
