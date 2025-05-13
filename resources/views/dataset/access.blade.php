
<div class="container">
    <h3>Access Rights for Dataset: {{ $dataset->set_name }}</h3>
    <p>{{ $dataset->set_description }}</p>

    <hr>

    <h5>Users with Access:</h5>
    <table class="table">
        <thead>
            <tr>
                <th>User Email</th>
                <th>Granted On</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($grantedUsers as $access)
                <tr>
                    <td>{{ $access->user->email }}</td>
                    <td>{{ $access->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            @empty
                <tr><td colspan="2">No access granted yet.</td></tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('datasets.index') }}" class="btn btn-secondary">Back</a>
</div>
