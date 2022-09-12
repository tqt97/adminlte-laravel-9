@extends('admin.layouts.base', ['title' => 'Archive Categories - Administrator - Laravel 9'])

@push('css')
    <!-- DataTables  & Plugins -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('content')
    @include('admin.layouts.partials.header', [
        'title' => 'Categories Archive',
        'action' => 'List Archive',
    ])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Restore and Force delete') }} </h3>
                        </div>
                        <div class="card-body">
                            @if ($categories->count())
                                <table id="table-data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox"></th>
                                            <td class="text-center"><input type="checkbox"></th>
                                            <th class="text-center">No</th>
                                            <th>Name</th>
                                            <th class="text-center">Sub Categories</th>
                                            <th>Created at</th>
                                            <th>Delete at</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $index => $category)
                                            <tr>
                                                <td class="text-center"><input type="checkbox"></th>
                                                </td>
                                                <td class="text-center"><input type="checkbox"></th>
                                                <td class="text-center">{{ $index + $categories->firstItem() }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td class="text-center">
                                                    @forelse ($category->childrenCategories as $item)
                                                        <span class="badge badge-info p-1">{{ $item->name }}</span>
                                                    @empty
                                                        <span class="badge badge-warning p-1">No sub</span>
                                                    @endforelse
                                                </td>
                                                <td>{{ $category->created_at }}</td>
                                                <td>{{ $category->deleted_at }}</td>
                                                <td class="text-center">
                                                    <form id="restore-item-{{ $category->id }}"
                                                        action="{{ route('admin.blogs.categories.restore', $category->id) }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                    <a class="pl-3" href="javascript:void(0)"
                                                        onclick="event.preventDefault();
                                                            if(confirm('Do you want to restore this item {{ $category->id }}?')){
                                                                document.getElementById('restore-item-{{ $category->id }}').submit();}">
                                                        <i class="fa fa-undo text-primary"></i>
                                                    </a>
                                                    <form id="force-delete-item-{{ $category->id }}"
                                                        action="{{ route('admin.blogs.categories.force_delete', $category->id) }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="pl-3" href="javascript:void(0)"
                                                        onclick="event.preventDefault();
                                                            if(confirm('Do you want to delete forever this item {{ $category->id }}?')){
                                                                document.getElementById('force-delete-item-{{ $category->id }}').submit();}">
                                                        <i class="fa fa-archive text-red"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center"><input type="checkbox"></th>
                                            <td class="text-center"><input type="checkbox"></th>
                                            <th class="text-center">No</th>
                                            <th>Name</th>
                                            <th class="text-center">Sub Categories</th>
                                            <th>Created at</th>
                                            <th>Delete at</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            @else
                                <h5 class="text-center">No data here</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $("#table-data").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
            });
        });
    </script>
@endpush
