<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  d-flex justify-content-center align-items-center">
            <a class="text-center" href="{{ route('home') }}">
                @if (setting('company_logo'))
                    <img alt="{{ setting('company_name') }}"
                         class="navbar-brand-img"
                         src="{{ asset(setting('company_logo')) }}">
                @else
                    {{setting('company_name') }}
                @endif
            </a>

        </div>
        <hr class="my-0">
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('home*')) ? 'active' : '' }}" href="{{route('home')}}">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">الرئيسية</span>
                        </a>
                    </li>

                    @canany(['view-category', 'create-category'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('category*')) ? 'active' : '' }}"
                               href="#navbar-category" data-toggle="collapse" role="button" aria-expanded="true"
                               aria-controls="navbar-category">
                                <i class="fas text-primary fa-list-alt"></i>
                                <span class="nav-link-text">ادارة التصنيفات</span>
                            </a>
                            <div class="collapse" id="navbar-category">
                                <ul class="nav nav-sm flex-column">
                                    @can('view-category')
                                        <li class="nav-item">
                                            <a href="{{route('category.index')}}" class="nav-link"><span
                                                    class="sidenav-mini-icon">D </span><span class="sidenav-normal">جميع التصنيفات</span></a>
                                        </li>
                                    @endcan
                                    @can( 'create-category')
                                        <li class="nav-item">
                                            <a href="{{route('category.create')}}" class="nav-link"><span
                                                    class="sidenav-mini-icon">D </span><span class="sidenav-normal">اضافة تصنيف جديد</span></a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>

                    @endcan

                    @canany(['view-post', 'create-post'])

                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('post*')) ? 'active' : '' }}" href="#navbar-post"
                               data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-post">
                                <i class="fas text-primary fa-tasks"></i>
                                <span class="nav-link-text">ادارة المشاركات</span>
                            </a>
                            <div class="collapse" id="navbar-post">
                                <ul class="nav nav-sm flex-column">
                                    @can('view-post')
                                        <li class="nav-item">
                                            <a href="{{route('post.index')}}" class="nav-link"><span
                                                    class="sidenav-mini-icon">D </span><span class="sidenav-normal">جميع المشاركات</span></a>
                                        </li>
                                    @endcan
                                    @can( 'create-post')
                                        <li class="nav-item">
                                            <a href="{{route('post.create')}}" class="nav-link"><span
                                                    class="sidenav-mini-icon">D </span><span class="sidenav-normal">اضافة مشاركة جديدة</span></a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('users*')) ? 'active' : '' }}" href="#navbar-users"
                           data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-users">
                            <i class="fas text-primary fa-tasks"></i>
                            <span class="nav-link-text">ادارة المستخدمين</span>
                        </a>
                        <div class="collapse" id="navbar-users">
                            <ul class="nav nav-sm flex-column">
                                @can('view-user')
                                    <li class="nav-item">
                                        <a href="{{route('users.index')}}" class="nav-link"><span
                                                class="sidenav-mini-icon">D </span><span class="sidenav-normal">جميع المستخدمين</span></a>
                                    </li>
                                @endcan
                                @can( 'create-user')
                                    <li class="nav-item">
                                        <a href="{{route('users.create')}}" class="nav-link">
                                            <span class="sidenav-mini-icon">D </span>
                                            <span class="sidenav-normal">اضافة مستخدم جديد</span></a>
                                    </li>
                                @endcan

                                @canany(['view-role', 'create-role'])

                                    <li class="nav-item">
                                        <a class="nav-link {{ (request()->is('roles*')) ? 'active' : '' }}"
                                           href="{{route('roles.index')}}">
                                            <span class="sidenav-mini-icon">D </span>
                                            <span class="sidenav-normal"> ادارة الادوار</span></a>
                                    </li>
                                @endcan

                                @canany(['view-permission', 'create-permission'])
                                    <li class="nav-item">
                                        <a class="nav-link {{ (request()->is('permissions*')) ? 'active' : '' }}"
                                           href="{{route('permissions.index')}}">
                                            <span class="sidenav-mini-icon">D </span>
                                            <span class="sidenav-normal"> ادارة الصلاحيات</span></a>
                                    </li>
                                @endcan


                            </ul>
                        </div>
                    </li>


                    @canany(['media'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('media*')) ? 'active' : '' }}"
                               href="{{route('media.index')}}">
                                <i class="fas fa-images text-primary"></i>
                                <span class="nav-link-text">إدارة الوسائط</span>
                            </a>
                        </li>
                    @endcan

                    @canany(['view-activity-log'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('activity-log*')) ? 'active' : '' }}"
                               href="{{route('activity-log.index')}}">
                                <i class="fas fa-history text-primary"></i>
                                <span class="nav-link-text">سجل النشاطات</span>
                            </a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <hr class="my-3">
                    </li>

                    @can('update-settings')
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('settings*')) ? 'active' : '' }}"
                               href="{{route('settings.index')}}">
                                <i class="ni ni-settings-gear-65 text-primary"></i>
                                <span class="nav-link-text">اعدادات الموقع</span>
                            </a>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('components')}}">
                            <i class="ni ni-send text-primary"></i>
                            <span class="nav-link-text">النعاصر</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
