<div class="left-side-menu">
    <div class="media user-profile mt-2 mb-2">
        <img src="{{ URL::asset('assets//images/users/avatar-7.jpg') }}" class="avatar-sm rounded-circle mr-2" alt="Shreyu" />
        <img src="{{ URL::asset('assets//images/users/avatar-7.jpg') }}" class="avatar-xs rounded-circle mr-2" alt="Shreyu" />

        <div class="media-body">
            <h6 class="pro-user-name mt-0 mb-0">{{ Auth::user()->first_name }}</h6>
            <span class="pro-user-desc">{{ Auth::user()->categories->first()->contents->first()->title }}</span>                    
        </div>
        <div class="dropdown align-self-center profile-dropdown-menu">
            <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span data-feather="chevron-down"></span>
            </a>
            <div class="dropdown-menu profile-dropdown">
                <a href="{{ route('users.form', ['id' =>  Auth::user()->id, 'category_id' =>  Auth::user()->categories->first()->id]) }}" class="dropdown-item notify-item">
                    <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                    <span>Minha Conta</span>
                </a>                

                <div class="dropdown-divider"></div>

                <a href="{{ route('login.logout') }}" class="dropdown-item notify-item">
                    <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-content">        
        <div id="sidebar-menu" class="slimscroll-menu">
            @include('layouts.shared.app-menu')
        </div>
        <div class="clearfix"></div>
    </div>
</div>