<div class="container">
    <h3>Edit Dataset</h3>

    <form method="POST" action="{{ route('datasets.update', $dataset->set_id) }}">
        @csrf
        <div class="mb-3">
            <label for="set_name" class="form-label">Dataset Name</label>
            <input type="text" name="set_name" class="form-control" value="{{ $dataset->set_name }}" required>
        </div>
        <div class="mb-3">
            <label for="set_description" class="form-label">Description</label>
            <textarea name="set_description" class="form-control">{{ $dataset->set_description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Dataset</button>
    </form>
</div>
