<h2>Sign In</h2>
@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif
<form method="POST" action="/signin">
    @csrf
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Sign In</button>
</form>
<a href="/signup">Don't have an account? Sign Up</a>
