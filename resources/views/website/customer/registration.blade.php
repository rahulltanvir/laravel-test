<form action="{{ route('customer.register.post') }}" method="POST">
    @csrf

    <h3>Customer Register</h3>

    <input type="text" name="name" placeholder="Name" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Register</button>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
</form>