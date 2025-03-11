<aside id="sidebar" class="js-sidebar">
    <div class="h-100">
        <div class="sidebar-logo mb-2">
            <a href="#">
                <img src="{{ asset('images/handbag.png') }}" class="me-1 pb-1" alt="Icon Handbag">
                Product Management
            </a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('categories.index') ? 'active' : '' }}">
                <a href="{{ route('categories.index') }}" class="sidebar-link">
                    <img src="{{ asset('images/package.png') }}" class="pe-2" alt="Package">
                    Kategori
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('units.index') ? 'active' : '' }}">
                <a href="{{ route('units.index') }}" class="sidebar-link">
                    <img src="{{ asset('images/package.png') }}" class="pe-2" alt="Package">
                    Satuan
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('discounts.index') ? 'active' : '' }}">
                <a href="{{ route('discounts.index') }}" class="sidebar-link">
                    <img src="{{ asset('images/package.png') }}" class="pe-2" alt="Package">
                    Diskon
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('products.index') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}" class="sidebar-link">
                    <img src="{{ asset('images/package.png') }}" class="pe-2" alt="Package">
                    Produk
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('transactions.index') ? 'active' : '' }}">
                <a href="{{ route('transactions.index') }}" class="sidebar-link">
                    <img src="{{ asset('images/package.png') }}" class="pe-2" alt="Package">
                    Transaksi
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('character.match') ? 'active' : '' }}">
                <a href="{{ route('character.match') }}" class="sidebar-link">
                    <img src="{{ asset('images/package.png') }}" class="pe-2" alt="Package">
                    Character Match
                </a>
            </li>
            <li class="sidebar-item">
                <form action="{{ route('logout') }}" method="POST" class="d-inline-block ps-2">
                    @csrf
                    <button type="submit" class="btn sidebar-link text-white"
                        style="font-size: 14px; font-weight: 500">
                        <img src="{{ asset('images/logout.png') }}" class="pe-2" alt="Logout">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
