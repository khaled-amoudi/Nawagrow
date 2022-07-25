<!-- Button trigger modal -->
<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#updateCategory{{ $category->id }}">
    <i class="fa-solid fa-pen-to-square text-warning"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="updateCategory{{ $category->id }}" tabindex="-1" aria-labelledby="updateCategory{{ $category->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('category.update', $category->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" value="{{ $category->name }}" class="form-control" id="name" placeholder=".">
                        <label for="name">category name</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
