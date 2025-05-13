<h2>Sign Up</h2>
<form method="POST" action="/signup">
    @csrf
    <input type="text" name="first_name" placeholder="First Name" required><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Sign Up</button>
</form>
<a href="/signin">Already have an account? Sign In</a>