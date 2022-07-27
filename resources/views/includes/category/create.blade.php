<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategory">
    New Category <i class="fa-solid fa-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder=".">
                        <label for="name">category name</label>
                    </div>
                </div>
                {{-- <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="file" name="image" class="form-control" id="image" placeholder=".">
                        <label for="image">category image</label>
                    </div>
                </div> --}}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
