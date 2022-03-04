
<nav class='navbar' id="sidebarMenu" class="d-block bg-light sidebar">
    <ul class="nav flex-column">
        {{-- DASHBOARD --}}
        <li class="nav-item">
            <a class="d-flex nav-link align-item-center" href="{{route('admin.home')}}">
                <i class="bi bi-info-square d-block mr-2"></i>
                {{Auth::user()->name}}
            </a>
        </li>
        {{-- POSTS --}}
        <li class="nav-item ">
            <a class="d-flex nav-link align-items-center" href="{{route('admin.posts.index')}}">
                <i class="bi bi-stickies d-block mr-2"></i>
                Posts
            </a>
            <ul class="nav flex-column align-items-center">
                <li class="nav-item">
                    <a class="d-flex nav-link align-items-center" href="{{route('admin.posts.create')}}">
                        Add Post
                    </a>
                    
                </li>
            </ul>
        </li>
        {{-- CATEGORIES --}}
        <li class="nav-item">
            <a class="d-flex nav-link align-items-center" href="{{route('admin.categories.index')}}">
                <i class="bi bi-bookmark d-block mr-2"></i>
                Categories
            </a>
            <ul class="nav flex-column align-items-center">
                <li class="nav-item">
                    <a class="d-flex nav-link align-items-center" href="{{route('admin.categories.create')}}">
                        Add Category
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
