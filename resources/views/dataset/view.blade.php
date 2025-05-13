<div class="container">
    <h3>Upload Training Data for: {{ $dataset->set_name }}</h3>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Upload Form --}}
    <form method="POST" action="{{ route('datasets.uploadTrainingData', $dataset->set_id) }}">
        @csrf
        <div class="mb-3">
            <label>DataSet Name *</label>
            <input type="text" name="data_set" class="form-control" required />
        </div>

        <div class="mb-3">
            <label>DataSet Description *</label>
            <textarea name="dataset_descrption" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Create</button>
    </form>

    <hr>

    {{-- Show Existing Training Data --}}
    <h4>Training Data</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Label</th>
                <th>Data</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trainingData as $data)
                <tr>
                    <td>{{ $data->training_id }}</td>
                    <td>{{ $data->label }}</td>
                    <td>{{ $data->data }}</td>
                    <td>{{ $data->created_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No training data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
