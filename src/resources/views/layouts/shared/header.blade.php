<div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
    <div class="container-fluid">

        <a href="/" class="navbar-brand mr-0 mr-md-2 logo">
            <span class="logo-lg">
                <img src="{{ URL::asset('console-service/assets/images/logo.png') }}" alt="" height="24" />
                <span class="d-inline h5 ml-1 text-logo">Seventh</span>
            </span>
            <span class="logo-sm">
                <img src="{{ URL::asset('console-service/assets/images/logo.png') }}" alt="" height="24">
            </span>
        </a>

        <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
            <li class="">
                <button class="button-menu-mobile open-left disable-btn">
                    <i data-feather="menu" class="menu-icon"></i>
                    <i data-feather="x" class="close-icon"></i>
                </button>
            </li>
        </ul>

        <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">            

            <li class="dropdown d-none d-lg-block" data-toggle="tooltip" data-placement="left" title="Change language">
                <a class="nav-link dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i data-feather="globe"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('console-service/assets/images/flags/germany.jpg') }}" alt="user-image" class="mr-2" height="12"> <span
                            class="align-middle">German</span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('console-service/assets/images/flags/spain.jpg') }}" alt="user-image" class="mr-2" height="12"> <span
                            class="align-middle">Spanish</span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('console-service/assets/images/flags/russia.jpg') }}" alt="user-image" class="mr-2" height="12"> <span
                            class="align-middle">Russian</span>
                    </a>
                </div>
            </li>

        </ul>
    </div>
</div>