<nav class="navbar-vertical navbar">
    <div class="nav-scroller">

        <ul class="navbar-nav flex-column" id="sideNavbar">

            {{-- <li class="nav-item">
                <a class="nav-link py-3" href="#">
                    <h2 class="text-white m-0">Mapet Hospital Pos </h2>
                </a>
            </li> --}}

            <li class="nav-item mb-3">
                <a class="nav-link bg-info p-3 text-white" href="/pos?trno={{ rand(111111, 3444444445409) }}">
                    <i class="nav-icon fe fe-home me-2"></i> Point Of Sales
                </a>
            </li>



            <li class="nav-item mb-3">
                <a class="nav-link bg-info p-3 text-white" href="/item/add">
                    <i class="nav-icon fe fe-book me-2"></i> Add New Item
                </a>
            </li>


            <li class="nav-item mb-3">
                <a class="nav-link bg-info p-3 text-white" href="/today_sales/{{ auth()->user()->id }}">
                    <i class="nav-icon fe fe-book me-2"></i>Today's Sales
                </a>
            </li>

            <li class="nav-item mb-3">
                <a class="nav-link bg-info p-3 text-white" href="#">
                    <i class="nav-icon fe fe-book me-2"></i>Account Overview
                </a>
            </li>




            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link bg-info p-3 text-white" href="/admin/dashboard">
                        <i class="nav-icon fe fe-arrow-right me-2"></i>Move To Admin
                    </a>
                </li>
            @endif

        </ul>

    </div>
</nav>
