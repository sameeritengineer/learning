@extends('admin.layouts.admin')

@section('title', 'Categories')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Blog Categories</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Blog Categories</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">                
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                    <!-- @if(!empty($blogCategories)) -->
                                        <li class="nav-item">
                                            <a class="nav-link {{ (!empty($errors) and $errors->has('title')) ? '' : 'active' }}" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="true">Categories</a>
                                        </li>
                                    <!-- @endif -->

                                    <li class="nav-item">
                                        <a class="nav-link {{ ((!empty($errors) and $errors->has('title')) or !empty($editCategory)) ? 'active' : '' }}" id="newCategory-tab" data-toggle="tab" href="#newCategory" role="tab" aria-controls="newCategory" aria-selected="true">New Category</a>
                                    </li>
                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                    <!-- @if(!empty($blogCategories)) -->
                                        <div class="tab-pane mt-3 fade {{ (!empty($errors) and $errors->has('title')) ? '' : 'active show' }}" id="categories" role="tabpanel" aria-labelledby="categories-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped font-14">
                                                    <tr>
                                                        <th class="text-left">Title</th>
                                                        <th class="text-center">Posts</th>
                                                        <th>Action</th>
                                                    </tr>

                                                    @foreach($blogCategories as $category)
                                                        <tr>
                                                            <td class="text-left">{{ $category->title }}</td>
                                                            <td class="text-center">{{ $category->blog_count }}</td>
                                                            <td>
                                                                    <a href="/admin/blog/categories/{{ $category->id }}/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.edit') }}">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    <!-- @endif -->

                                    <div class="tab-pane mt-3 fade {{ ((!empty($errors) and $errors->has('title')) or !empty($editCategory)) ? 'active show' : '' }}" id="newCategory" role="tabpanel" aria-labelledby="newCategory-tab">
                                        <form action="/admin/blog/categories/{{ !empty($editCategory) ? $editCategory->id.'/update' : 'store' }}" method="post">    
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="title"
                                                            class="form-control  @error('title') is-invalid @enderror"
                                                            value="{{ !empty($editCategory) ? $editCategory->title : '' }}"/>
                                                        @error('title')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea id="summernote-blogcategory" name="description" class="form-control @error('description')  is-invalid @enderror">{!! !empty($editCategory) ? $editCategory->description : old('description')  !!}</textarea>
                                                        @error('description')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </form>
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection