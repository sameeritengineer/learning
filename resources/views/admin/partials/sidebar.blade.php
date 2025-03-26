<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <!-- <a href="index.html">Stisla</a> -->
            <img src="{{ asset('admin/img/logo.png')}}" style="width: 100px" alt="" title="">
        </div>
        <!-- <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div> -->
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item dropdown {{ request()->is('admin/blog*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-rss-square"></i> <span>Blog</span>
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

            <li class="dropdown {{ request()->is('admin/section/home') ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}" class="nav-link">
                    <i class="fas fa-home"></i> <span>Home Page</span>
                </a>
            </li>

            <li class="nav-item dropdown {{ request()->is('admin/section/team*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-users"></i> <span>Team</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('admin/section/team') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('team.index') }}">All Members</a>
                    </li>
                    <li class="{{ request()->is('admin/section/team/create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('team.create') }}">Add New Member</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ request()->is('admin/section/tech-factor*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
        <i class="fas fa-video"></i>
        <span>Tech Factor</span>
    </a>
    <ul class="dropdown-menu">
        <li class="{{ request()->is('admin/section/tech-factor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tech-factor.index') }}">All Episode</a>
        </li>
        <li class="{{ request()->is('admin/section/tech-factor/create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tech-factor.create') }}">Add New Episode</a>
        </li>
    </ul>
</li>

<li class="nav-item dropdown {{ request()->is('admin/section/case-studies*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
        <i class="fas fa-book"></i>
        <span>Case Studies</span>
    </a>
    <ul class="dropdown-menu">
        <li class="{{ request()->is('admin/section/case-studies') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('case-studies.index') }}">All Case Studies</a>
        </li>
        <li class="{{ request()->is('admin/section/case-studies/create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('case-studies.create') }}">Add New Case Study</a>
        </li>
    </ul>
</li>
<li class="nav-item dropdown {{ request()->is('admin/section/industry-insights*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
        <i class="fas fa-file-pdf"></i>
        <span>Industry Insights</span>
    </a>
    <ul class="dropdown-menu">
        <li class="{{ request()->is('admin/section/industry-insights') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('industry-insights.index') }}">All Industry Insights</a>
        </li>
        <li class="{{ request()->is('admin/section/industry-insights/create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('industry-insights.create') }}">Add New Industry Insight</a>
        </li>
    </ul>
</li>
<li class="nav-item dropdown {{ request()->is('admin/section/news*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
        <i class="fas fa-newspaper"></i>
        <span>News</span>
    </a>
    <ul class="dropdown-menu">
        <li class="{{ request()->is('admin/section/news') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('news.index') }}">All News</a>
        </li>
        <li class="{{ request()->is('admin/section/news/create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('news.create') }}">Add New News</a>
        </li>
    </ul>
</li>

<!-- Press Release Section -->
        <li class="nav-item dropdown {{ request()->is('admin/section/press-release*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i> <span>Press Releases</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->is('admin/section/press-release') ? 'active' : '' }}">
                    <a href="{{ route('press-release.index') }}" class="nav-link">All Press Releases</a>
                </li>
                <li class="{{ request()->is('admin/section/press-release/create') ? 'active' : '' }}">
                    <a href="{{ route('press-release.create') }}" class="nav-link">Add New</a>
                </li>
            </ul>
        </li>


        </ul>
    </aside>
</div>
