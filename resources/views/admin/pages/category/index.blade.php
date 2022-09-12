@extends('admin.layouts.base',['title'=>'Categories List- Administrator - Laravel 9'])

@push('css')
    @include('admin.pages.category.tree-css')
@endpush

@section('content')
    @include('admin.layouts.partials.header', ['title' => 'Categories List', 'action' => 'List'])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <a href="{{ route('admin.blogs.categories.create') }}" class="btn btn-primary float-left">
                                <i class="fa fa-plus-circle mr-2"></i> Add new
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="menu">
                                @if ($categories->count() > 0)
                                    <ul class="tree">
                                        @foreach ($categories as $category)
                                            <li class="w-full">
                                                <span
                                                    class="{{ $category->children_categories_count ? 'branch' : 'Leaf' }}">
                                                    <i
                                                        class="fas {{ $category->children_categories_count ? 'fa-folder' : 'fa-file' }}"></i>
                                                    {{ $category->name }}
                                                    ({{ $category->categories_count }} sub categories)
                                                    <div class="float-right">
                                                        {{ $category->created_at->diffForHumans() }}
                                                        <i class="fa {{ $category->getFeature() }} pl-3"></i>
                                                        <i class="fa {{ $category->getPublish() }} pl-3"></i>
                                                        <a href="{{ route('admin.blogs.categories.edit', $category) }}"
                                                            class="pl-3">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form id="delete-item-{{ $category->id }}"
                                                            action="{{ route('admin.blogs.categories.destroy', $category) }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a class="pl-3"
                                                            href="{{ route('admin.blogs.categories.destroy', $category) }}"
                                                            onclick="event.preventDefault();
                                                            if(confirm('Do you want to delete this item {{ $category->id }}?')){
                                                                document.getElementById('delete-item-{{ $category->id }}').submit();}">
                                                            <i class="fa fa-trash-alt text-red"></i>
                                                        </a>
                                                    </div>
                                                </span>
                                                @if ($category->childrenCategories)
                                                    <ul class="tree">
                                                        @foreach ($category->childrenCategories as $childCategory)
                                                            @include('admin.pages.category.child_category',
                                                                [
                                                                    'child_category' => $childCategory,
                                                                ])
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="m-5">No data</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.branch').next().slideToggle();
            $('.branch').click(function() {
                $(this).closest('.branch').find('.branch:first').toggleClass('fa-folder-open');
                $(this).next().slideToggle();
            });
        });
    </script>
@endpush
