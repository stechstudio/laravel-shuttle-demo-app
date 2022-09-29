<form action="{{ route('login') }}" method="POST">
    @csrf

    <label>
        <input type="email" required>
    </label>

    <label>
        <input type="password" required>
    </label>

    <button type="submit">{{ __(key: 'Login') }}</button>
</form>