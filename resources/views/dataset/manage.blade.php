<div class="container">
    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add New Dataset Form --}}
    <h3>Add New Dataset</h3>
    <form method="POST" action="{{ route('datasets.index') }}">
        @csrf
        <div class="mb-3">
            <label for="set_name" class="form-label">Dataset Name</label>
            <input type="text" name="set_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="set_description" class="form-label">Description</label>
            <textarea name="set_description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Dataset</button>
    </form>

    <hr>

    {{-- List of Existing Datasets --}}
    <h3>My Datasets</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Dataset Name</th>
                <th>Description</th>
                <th>Actions</th>
                <th>Access</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datasets as $dataset)
                <tr>
                    <td>{{ $dataset->set_name }}</td>
                    <td>{{ $dataset->set_description }}</td>
                    <td>
                        @if($dataset->created_by == session('user_id'))
                            <a href="{{ route('datasets.edit', $dataset->set_id) }}" class="btn btn-sm btn-warning">Update</a>
                            <a href="{{ route('datasets.delete', $dataset->set_id) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                        @else
                            <span class="text-muted">Shared with you</span>
                        @endif
                    </td>
                    <td>
                        @if($dataset->created_by == session('user_id'))
                            <a href="{{ route('datasets.access', $dataset->set_id) }}" class="btn btn-sm btn-info">Manage Access</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
