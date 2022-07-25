@extends('Layout-custom.main')


@section('content')

    @include('includes.alerts.success')
    <div class="card mt-4 shadow">
        <div class="card-title p-2 d-flex justify-content-between align-items-center">
            <h3>Categories<span class="h2 badge bg-primary">{{ $categories->count() }}</span></h3>

            <form class="position-relative col-3" method="get" action="{{ route('category.index') }}">
                <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                </div>
                <input class="form-control" type="search" name="search" value="{{ request()->query('search') }}"
                    placeholder="search bu category name" />
            </form>

            <div>
                @include('includes.category.create')
            </div>
        </div>
        <div class="card-body px-0 pb-0">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Parts</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @isset($categories)
                        @foreach ($categories as $category)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $category->name }} <span class="mx-4 badge bg-white text-dark fw-light">{{ $category->parts_count }} parts</span></td>
                                <td>
                                    @foreach ($category->parts as $part)
                                        <span class="mx-1 badge bg-primary fw-light">{{ $part->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @include('includes.category.update')
                                    @include('includes.category.delete')
                                </td>
                            </tr>
                        @endforeach
                    @endisset

                </tbody>
            </table>
        </div>
    </div>
@endsection
