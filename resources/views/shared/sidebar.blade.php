<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="sliders"></i> <span
                        class="align-middle">Dashboard</span>
                </a>
            </li>
            @can('view-investor')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('investor.index')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Investors</span>
                </a>
            </li>
            @endcan

            @can('view-permission')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('permission.index')}}">
                    <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Permissions</span>
                </a>
            </li>
            @endcan
            @can('view-role')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('roles')}}">
                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Roles</span>
                </a>
            </li>
            @endcan
                                          
        </ul>
    </div>
</nav>