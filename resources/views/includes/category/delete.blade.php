<!-- Button trigger modal -->
<button type="button" class="btn" data-bs-toggle="modal"
    data-bs-target="#deleteCategory{{ $category->id }}">
    <i class="fa-solid fa-trash text-danger"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="deleteCategory{{ $category->id }}" tabindex="-1"
    aria-labelledby="deleteCategory{{ $category->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="p-2 modal-body text-danger">
                Delete {{ $category->name }} Category ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('category.destroy', $category->id) }}"
                    class="btn btn-danger">Delete</a>
            </div>
            </form>
        </div>
    </div>
</div>
