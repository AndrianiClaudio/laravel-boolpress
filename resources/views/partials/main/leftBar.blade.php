
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          {{-- DASHBOARD --}}
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.home')}}">
                    <i class="bi bi-files"></i>
                      Dashboard
                </a>
            </li>
            {{-- POSTS --}}
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.posts.index')}}">
                    <i class="bi bi-files"></i>
                    Posts
                </a>
            </li>
            {{-- CATEGORIES --}}
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.categories.index')}}">
                    <i class="bi bi-files"></i>
                    Categories
                </a>
            </li>
        </ul>
    </div>
</nav>
