<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon/favicon.ico">


    <link href="{{ asset('assets/fonts/feather/feather.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/emoji.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/toast.min.css') }}">

    <title> @yield('page_title') </title>

    <style>
        .al_bg {
            background: linear-gradient(to right, #b04300, #ff0000) !important;
        }
    </style>

</head>



<body>
    <div id="db-wrapper">



        <nav class="navbar-vertical navbar">
            <div class="nav-scroller">

                <ul class="navbar-nav flex-column" id="sideNavbar">

                    <li class="nav-item bg-info mb-3">
                        <a class="nav-link text-white p-3 " href="#!">
                            <i class="nav-icon fe fe-home me-2"></i> Account Overview
                        </a>
                    </li>


                    <li class="nav-item bg-info mb-3 " style="color: white !important">
                        <a class="nav-link  collapsed text-white bg-info p-3 " href="#!" data-bs-toggle="collapse"
                            data-bs-target="#navAuthentication" aria-expanded="false" aria-controls="navAuthentication">
                            <i class="nav-icon fe fe-lock me-2"></i> Stock Management
                        </a>
                        <div id="navAuthentication" class="collapse " data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column text-white">
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="#">Stock Profiler</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white"
                                        href="/admin/stock/restock?trno={{ rand(111111, 3444444445409) }}">Restock Items</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link text-white"
                                        href="/admin/stock/history">History</a>
                                </li>
                                
                                
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item bg-info mb-3">
                        <a class="nav-link text-white p-3 ">
                            <i class="nav-icon fe fe-arrow-left me-2"></i> Manage Permissions
                        </a>
                    </li>




                    <li class="nav-item mb-3 bg-info ">
                        <a class="nav-link  collapsed text-white p-3 " href="#!" data-bs-toggle="collapse"
                            data-bs-target="#users_man" aria-expanded="false" aria-controls="users_man">
                            <i class="nav-icon fe fe-users me-2"></i> Manage Users
                        </a>
                        <div id="users_man" class="collapse " data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link text-white " href="#">Add Employee</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-white" href="#">Employee list</a>
                                </li>


                            </ul>
                        </div>
                    </li>




                    <li class="nav-item mb-3 bg-info ">
                        <a class="nav-link  collapsed text-white p-3 " href="#!" data-bs-toggle="collapse"
                            data-bs-target="#expsn" aria-expanded="false" aria-controls="expsn">
                            <i class="nav-icon fe fe-users me-2"></i> Expenses Management
                        </a>
                        <div id="expsn" class="collapse " data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="#">Expenses Title</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-white" href="#">Add Expenses</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item bg-info mb-3">
                        <a class="nav-link text-white p-3 " href="/pos?trno={{ rand(111111, 3444444445409) }}">
                            <i class="nav-icon fe fe-arrow-left me-2"></i> Back To POS
                        </a>
                    </li>




                </ul>

            </div>
        </nav>





        <div id="page-content">
            @include('layout.inc.header')
            <div class="container-fluid p-4">

                @if ($errors->any())
                    <div id="refresh" class="alert al_bg"
                        style="position:fixed; top:10px; right:10px; z-index:10000; width: auto;">
                        <i class="text-white">
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br />
                            @endforeach
                        </i>
                    </div>
                @endif

                @yield('page_content')

            </div>

        </div>
    </div>



    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/toast.js') }}"></script>


    <script>
        $(function() {


            $("#search").on('keyup', function(e) {
                e.preventDefault()
                param = $('#search');

                str = param.val().trim()

                if (!str) {
                    return;
                }

                $.ajax({
                    method: 'get',
                    url: '/search',
                    data: {
                        's': str
                    },
                    beforeSend: () => {
                        body = $('.sbox');
                        body.show();
                        body.html(`
                            <a class=" mt-3 py-2 bt" href="javscript:;" >
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Fetch Items ...
                            </a>
                        `)
                    }
                }).done((res) => {
                    console.log(res);
                    body.html(``);

                    if (res.length == 0) {
                        body.html(`
                            <div class="bg-danger mt-2  text-white p-2 rounded" >
                                No item found
                            </div>
                        `)
                    }

                    res.map((item, index) => {
                        body.append(`
                            <a href="javascript:;" class="text-dark search_item" data-data='${JSON.stringify(item)}' >
                                <div class="d-flex justify-content-between  py-1">
                                    <div class="w-10">
                                        <span> # ${item.id}</span>
                                    </div>
                                    <div class="w-50">
                                        <span class="fw-bold"> ${item.name} </span>
                                    </div>
                                    <div class="w-20">
                                        <span>${item.price}</span>
                                    </div>
                                    <div class="">
                                        <span>6</span>
                                    </div>
                                </div>
                            </a>
                        `)
                    })
                }).fail((res) => {
                    console.log(res);
                })
            })
        })
    </script>

    @if (session('error'))
        <script>
            Toastify({
                text: "<?= session('error') ?>",
                duration: 5000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #b04300, #ff0000)",
                },
            }).showToast();
        </script>
    @endif

    @if (session('success'))
        <script>
            Toastify({
                text: "<?= session('success') ?>",
                duration: 5000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #01ff01)",
                },
            }).showToast();
        </script>
    @endif


    <script>
        $(function() {
            setTimeout(function() {
                $(".refresh").fadeOut(3000);
            }, 3000);

        })
    </script>



    @stack('scripts')

</body>

</html>
