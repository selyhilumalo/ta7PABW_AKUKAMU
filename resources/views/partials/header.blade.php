<header>
    <div class="container bar">
        <a href="{{ route('home') }}" class="brand">Aku &amp; Kamu</a>
        <nav>
            <a href="{{ route('campaigns.index') }}" class="{{ request()->routeIs('campaigns.*') ? 'active' : '' }}">Campaign</a>
            <a href="{{ route('donations.index') }}" class="{{ request()->routeIs('donations.*') ? 'active' : '' }}">Daftar donasi</a>

            @auth
                <a href="{{ route('manage.campaigns.index') }}" class="{{ request()->routeIs('manage.*') ? 'active' : '' }}">Kelola campaign</a>
            @endauth
        </nav>

        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm">Keluar ({{ auth()->user()->name }})</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-sm">Masuk</a>
        @endauth
    </div>
</header>