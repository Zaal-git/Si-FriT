@include('login.header')

<div class="container" style="max-width: 500px; margin: auto; padding-top: 80px;">

    <div class="card" style="padding: 30px; border: 1px solid #ccc; border-radius: 10px;">
        <div class="text-center mb-4">
            <div class="d-flex align-items-center justify-content-center gap-2">
                <img src="../assets/images/logos/Si-FRiT-logo.png" alt="Logo SiFrIT" style="height: 150px;">
            </div>
            <p class="text-muted mt-2">Silakan login untuk masuk ke dashboard</p>
        </div>


        @if (session('success'))
        <div style="color: green; font-weight: bold;">{{ session('success') }}</div>
        @endif
        @if (session('loginError'))
        <div style="color: red; font-weight: bold;">{{ session('loginError') }}</div>
        @endif


        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text"
                    name="email"
                    id="username"
                    class="form-control @error('username') is-invalid @enderror"
                    placeholder="Masukkan username"
                    value="{{ old('username') }}"
                    required autofocus>
                @error('username')
                <div style="color: red; font-size: small;">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password"
                    name="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukkan password"
                    required>
                @error('password')
                <div style="color: red; font-size: small;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>



@include('login.footer')