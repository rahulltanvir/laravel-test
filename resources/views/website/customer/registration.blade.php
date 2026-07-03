<form method="POST" action="{{ route('customer.register') }}">
    @csrf

    <input type="text" name="name" placeholder="Name">

    <input type="text" name="phone" placeholder="Phone">

    <input type="email" name="email" placeholder="Email">

    <input type="password" name="password" placeholder="Password">

    <button type="submit">Register</button>
</form>