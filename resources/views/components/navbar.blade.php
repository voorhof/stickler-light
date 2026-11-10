<nav class="c-navbar navbar">
    <div class="container-xl">
        <a class="navbar-brand js-home-link" href="{{ route('welcome.index') }}">
            <x-logo />
        </a>

        <div class="d-flex align-items-center">
            {{-- User dashboard --}}
            <a
                href="{{ route('account.dashboard') }}"
                @class([
                    'nav-link position-relative me-4',
                    'active' => request()->routeIs('account.*'),
                ])
                aria-label="{{ __('Dashboard') }}"
            >
                <span class="fs-4">
                    <x-icons.person-circle />
                </span>
            </a>

            {{-- Offcanvas toggler --}}
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="offcanvas"
                data-target="#offcanvasNav"
                aria-controls="offcanvasNav"
                aria-label="Toggle offcanvas navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</nav>
