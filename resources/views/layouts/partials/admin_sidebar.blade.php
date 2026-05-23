<aside class="sidebar">
    <div class="brand">NAMI LONTAR</div>
    <nav>
        <a href="{{ url('/admin/dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-border-all"></i> Dashboard
        </a>
        <a href="{{ route('admin.products.index') }}" class="{{ Request::is('admin/products*') ? 'active' : '' }}">
            <i class="fa-solid fa-cookie-bite"></i> Products
        </a>
        <a href="{{ url('/admin/orders') }}" class="{{ Request::is('admin/orders') ? 'active' : '' }}">
            <i class="fa-solid fa-receipt"></i> Orders
        </a>
        <a href="{{ route('admin.categories.index') }}" class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
            <i class="fa-solid fa-layer-group"></i> Categories
        </a>
        <a href="{{ url('/admin/customers') }}" class="{{ Request::is('admin/customers') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i> Customers
        </a>
        <a href="{{ route('admin.discounts.index') }}" class="{{ Request::is('admin/discounts*') ? 'active' : '' }}">
            <i class="fa-solid fa-tag"></i> Discounts
        </a>
        <a href="{{ url('/admin/settings') }}" class="{{ Request::is('admin/settings') ? 'active' : '' }}">
            <i class="fa-solid fa-gear"></i> Settings
        </a>
        <div style="margin-top: 2rem; padding: 0 1.5rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.5rem;">
            <a href="{{ url('/profile') }}" style="color: var(--primary-color); opacity: 0.8;">
                <i class="fa-solid fa-arrow-left"></i> Exit to Site
            </a>
        </div>
    </nav>
</aside>
