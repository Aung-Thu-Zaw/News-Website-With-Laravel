<div id="mySidenav" class="sidenav d-flex flex-column justify-content-between">
    <div class="border-3 border-bottom py-3 px-3">
        <h5 class="text-center text-white">
            World News
            </h4>
    </div>
    <div class="h-100">
        <div class="my-2">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge-high me-2"></i>
                <span class="dashboard-nav-item">
                    Dashboard
                </span>
            </a>
        </div>

        <div class="my-2">
            <div class="">
                <a data-bs-toggle="collapse" data-bs-target=".collapseOne" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample" onclick="toggleDownArrowOne()"
                    class="d-flex align-items-center justify-content-between">
                    <div>
                        <i class="fa-solid fa-rectangle-ad me-2"></i>
                        <span class="me-5 dashboard-nav-item">Advertisements</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-caret-down left-icon-1" id="down-icon-1"></i>
                    </div>
                </a>
            </div>
            <div class="collapse collapseOne" id="collapseExample" style="background: rgb(32, 33, 33)">
                <a href="{{ route('admin.home-advertisement') }}" class="">
                    <span class="ms-5 dashboard-nav-item">Home Advertisement</span>
                </a>
                <a href="{{ route('admin.sidebar-advertisement') }}" class="">
                    <span class="ms-5 dashboard-nav-item">Sidebar Advertisement</span>
                </a>
            </div>
        </div>


        <div class="my-2">
            <div class="">
                <a data-bs-toggle="collapse" data-bs-target=".collapseTwo" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample" onclick="toggleDownArrowTwo()"
                    class="d-flex align-items-center justify-content-between">
                    <div>
                        <i class="fa-solid fa-laptop me-2"></i>
                        <span class="me-5 dashboard-nav-item">Categories</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-caret-down left-icon-2" id="down-icon-2"></i>
                    </div>
                </a>
            </div>
            <div class="collapse collapseTwo" id="collapseExample" style="background: rgb(32, 33, 33)">
                <a href="{{ route('admin.category.index') }}" class="">
                    <span class="ms-5 dashboard-nav-item">Category</span>
                </a>
                <a href="{{ route('admin.sub-category.index') }}" class="">
                    <span class="ms-5 dashboard-nav-item">SubCategory</span>
                </a>
            </div>
        </div>



        <div class="my-2">
            <a href="{{ route('admin.post.index') }}">
                <i class="fa-solid fa-newspaper me-2"></i>
                <span class="dashboard-nav-item">
                    Posts
                </span>
            </a>
        </div>


        <div class="my-2">
            <div class="">
                <a data-bs-toggle="collapse" data-bs-target=".collapseThree" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample" onclick="toggleDownArrowThree()"
                    class="d-flex align-items-center justify-content-between">
                    <div>
                        <i class="fa-solid fa-photo-film me-2"></i>
                        <span class="me-5 dashboard-nav-item">Gallery</span>
                    </div>
                    <div>
                        <i class="fa-solid fa-caret-down left-icon-3" id="down-icon-3"></i>
                    </div>
                </a>
            </div>
            <div class="collapse collapseThree" id="collapseExample" style="background: rgb(32, 33, 33)">
                <a href="{{ route('admin.photo-gallery.index') }}" class="">
                    <span class="ms-5 dashboard-nav-item">Photo Gallery</span>
                </a>
                <a href="{{ route('admin.video-gallery.index') }}" class="">
                    <span class="ms-5 dashboard-nav-item">Video Gallery</span>
                </a>
            </div>
        </div>


    </div>


    <div class="border-3 border-top py-2 px-3 d-flex align-items-center justify-content-center">
        <div class="me-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/640px-Image_created_with_a_mobile_phone.png"
                alt="" class="border rounded-circle" style="width: 50px; height: 50px;">
        </div>

        <div class="btn-group dropup">
            <div type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="text-white">
                    Aung Thu Zaw
                </span>
            </div>
            <ul class="dropdown-menu bg-dark text-white-50">
                <li><a class="dropdown-item" href="{{ route('news.home') }}">Home</a></li>
                <li>
                    <hr class="dropdown-divider text-white">
                </li>
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                <li>
                    <hr class="dropdown-divider text-white">
                </li>
                <li style="cursor: pointer;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn text-white">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
