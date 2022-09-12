@extends('admin.layouts.base', ['title' => 'Edit Category - Administrator - Laravel 9'])

@push('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    @include('admin.pages.category.css')
@endpush

@section('content')
    @include('admin.layouts.partials.header', ['title' => 'Edit category', 'action' => 'Edit'])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.blogs.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Information</h3>
                                @include('admin.layouts.partials.card-tools')
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name: <span class="text-red">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ $category->name }}"
                                        onkeyup="GenerateSug();" class="form-control @error('name') is-invalid @enderror"
                                        id="name" placeholder="Enter category name">
                                    @error('name')
                                        <span class="error invalid-feedback"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug:</label>
                                    <input type="text" name="slug" id="slug" value="{{ $category->slug }}"
                                        class="form-control" placeholder="Enter category slug">
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Categories: <span class="text-red">*</span></label>
                                    <select class="form-control select2 @error('name') is-invalid @enderror"
                                        style="width: 100%;" name="parent_id" id="parent_id">
                                        {!! $options !!}
                                    </select>
                                    @error('parent_id')
                                        <span class="error invalid-feedback"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Attributes</h3>
                                @include('admin.layouts.partials.card-tools')
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">Image: <span class="text-red">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" value="{{ $category->image }}"
                                            class="custom-file-input @error('image') is-invalid @enderror" id="image"
                                            name="image" onchange="loadFile(event)">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                        @error('image')
                                            <span class="error invalid-feedback"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="preview-image">
                                    <img id="output" width="30%" height="auto"
                                        src="{{ asset('storage/category/' . $category->image) }}"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/404.webp') }}';" />
                                </div>
                                <div class="form-group">
                                    <label for="order_at">
                                        Order at: <span class="text-xs font-weight-normal">(Default order value 0)</span>
                                    </label>
                                    <input type="text" name="order_at" id="order_at"
                                        class="form-control @error('order_at') is-invalid @enderror" placeholder=""
                                        value="{{ $category->order_at }}">
                                    @error('order_at')
                                        <span class="error invalid-feedback"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="publish" name="publish" value="1"
                                            {{ $category->publish ? 'checked' : '' }}>
                                        <label for="publish"> Publish </label>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="feature" name="feature" value="1"
                                            {{ $category->feature ? 'checked' : '' }}>
                                        <label for="feature"> Feature </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    @include('admin.pages.category.js')
@endpush
