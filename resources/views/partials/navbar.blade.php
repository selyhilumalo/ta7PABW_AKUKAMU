@php
    $menu = [
        ['route' => 'beranda',      'label' => 'Beranda',   'pola' => 'home'],
        ['route' => 'donasi.index', 'label' => 'Donasi',    'pola' => 'donasi.*'],
        ['route' => 'volunteer',    'label' => 'Volunteer', 'pola' => 'volunteer'],
        ['route' => 'edukasi',      'label' => 'Edukasi',   'pola' => 'edukasi'],
        ['route' => 'forum',        'label' => 'Forum',     'pola' => 'forum'],
        ['route' => 'peta',         'label' => 'Peta',      'pola' => 'peta'],
        ['route' => 'kalender',     'label' => 'Kalender',  'pola' => 'kalender'],
        ['route' => 'cerita',       'label' => 'Cerita',    'pola' => 'cerita'],
    ];
@endphp

<header class="navbar">
    <a href="{{ route('home') }}" class="brand">
        <span class="brand-logo">AK</span>
        <span class="brand-text"><strong>Aku &amp; Kamu</strong><small>Social Platform</small></span>
    </a>

    <nav class="nav-links" aria-label="Menu utama">
        @foreach ($menu as $item)
            <a href="{{ route($item['route']) }}"
               class="{{ request()->routeIs($item['pola']) ? 'active' : '' }}">
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="nav-actions">
        @auth
            <a href="{{ route('profil') }}" class="user-pill" title="{{ auth()->user()->email }}">{{ auth()->user()->name }}</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Login</a>
            <a href="{{ route('daftar') }}" class="btn btn-primary btn-sm">Daftar</a>
        @endauth
    </div>
</header>