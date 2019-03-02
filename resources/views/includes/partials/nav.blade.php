
<!-- HEADER DESKTOP-->
<header class="header-desktop2">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap2">
                <div class="logo d-block d-lg-none">
                    <a href="#">
                        <!--<img src="{{ asset('images/icon/logo-top.png') }}" alt="Logo" />-->
                    </a>
                </div>
                <div class="header-button2">
                    <!--<div class="header-button-item has-noti js-item-menu">
                        <i class="zmdi zmdi-notifications"></i>
                        <div class="notifi-dropdown js-dropdown">
                            <div class="notifi__title">
                                <p>You have 0 new notifications</p>
                            </div>
                            <div class="notifi__footer">
                                <a href="{{ route('home') }}">Mark as read</a>
                            </div>
                        </div>
                    </div>-->
                    <div class="header-button-item mr-0 js-sidebar-btn">
                        <i class="zmdi zmdi-menu"></i>
                    </div>
                    <div class="setting-menu js-right-sidebar d-none d-lg-block">
                        <div class="account-dropdown__body">
                            <div class="account-dropdown__item">
                                <a href="{{ route('profile') }}">
                                    <i class="zmdi zmdi-account"></i>Account</a>
                                <div class="account-dropdown__item">
                                    <a href="{{ route('settings') }}">
                                        <i class="zmdi zmdi-settings"></i>Settings</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
               <div class="logo">
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    @include('includes.partials.sidebar')
                </div>
            </aside>
<!-- END HEADER DESKTOP--> 