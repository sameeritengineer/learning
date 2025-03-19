  <div class="main-sidebar sidebar-style-2">
<aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ request()->is('admin/dashboard') ? 'active' : '' }}">
              <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item dropdown {{ request()->is('admin/blog*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-rss-square"></i>
                        <span>Blog</span>
                    </a>
                    <ul class="dropdown-menu">
                            <li class="{{ request()->is('admin/blog') ? 'active' : '' }}">
							    <a class="nav-link" href="{{ route('admin.blog.index') }}">Posts</a>
							</li>
                            <li class="{{ request()->is('admin/blog/create') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.blog.create') }}">New Post</a>
                            </li>
                            <li class="{{ request()->is('admin/blog/categories') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.blog.categories.index') }}">Categories</a>
                            </li>

                    </ul>
                </li>
          </ul>

</aside>
</div>