<!-- aside -->
<aside id="aside" class="app-aside hidden-xs bg-dark">
    <div class="aside-wrap">
        <div class="navi-wrap">
            <!-- nav -->
            <nav ui-nav class="navi clearfix">
                <ul class="nav">
                    <li class="padder menu-header">
                        <span>{!! trans('general.dinners') !!}</span>
                    </li>
                    <li>
                        <a href="{!! route('app.dinners.unmatched') !!}">
                            <i class="fa fa-exclamation"></i>
                            <span>{!! trans('general.unmatched') !!}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('app.dinners.matched') !!}">
                            <i class="fa fa-check"></i>
                            <span>{!! trans('general.matched') !!}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('app.dinners.calendar') !!}">
                            <i class="fa fa-calendar"></i>
                            <span>{!! trans('general.calendar') !!}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('app.dinners.create') !!}">
                            <i class="fa fa-plus"></i>
                            <span>{!! trans('general.create_dinner') !!}</span>
                        </a>
                    </li>

                    @if(Auth::user()->hasRoles(['Administrator', 'Ambassador']))
                        <li class="line dk"></li>

                        <li class="padder menu-header">
                            <span>{!! trans('general.participants') !!}</span>
                        </li>
                        <li>
                            <a href="{!! route('app.users.index') !!}" class="auto">
                                <i class="fa fa-users"></i>
                                <span>{!! trans('general.participants') !!}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{!! route('app.schools.index') !!}" class="auto">
                                <!--<b class="badge bg-info pull-right">3</b>-->
                                <i class="fa fa-building"></i>
                                <span>{!! trans('general.schools') !!}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{!! route('app.users.create') !!}">
                                <i class="fa fa-plus"></i>
                                <span>{!! trans('general.create_user') !!}</span>
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->hasRoles(['Administrator']))
                        <li class="line dk"></li>
                        <li class="padder menu-header">
                            <span>{!! trans('general.stats') !!}</span>
                        </li>

                        <li>
                            <a href="{!! route('app.lists.not_booked_yet') !!}" class="auto">
                                <i class="fa fa-list"></i>
                                <span>{!! trans('lists.not_booked_yet') !!}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{!! route('app.lists.christmas') !!}" class="auto">
                                <i class="fa fa-list"></i>
                                <span>{!! trans('lists.christmas') !!}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{!! route('app.stats.index') !!}" class="auto">
                                <i class="fa fa-pie-chart"></i>
                                <span>{!! trans('lists.charts') !!}</span>
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->hasRoles(['Administrator', 'Ambassador']))

                        <li class="line dk"></li>
                        <li class="padder menu-header">
                            <span>{!! trans('general.settings') !!}</span>
                        </li>

                        @if(Auth::user()->hasRole('Administrator'))
                            <li>
                                <a href="{!! route('app.users.index') . '?role=Ambassador' !!}" class="auto">
                                    <i class="fa fa-heart"></i>
                                    <span>{!! trans('general.ambassadors') !!}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{!! route('app.preferences.index') !!}">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    <span>{!! trans('general.preferences') !!}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{!! route('app.referrers.index') !!}">
                                    <i class="glyphicon glyphicon-share-alt"></i>
                                    <span>{!! trans('general.referrers') !!}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{!! route('app.regions.index') !!}">
                                    <i class="fa fa-map-marker"></i>
                                    <span>{!! trans('general.regions') !!}</span>
                                </a>
                            </li>

                        @endif

                        <li>
                            <a href="{!! route('app.emailtemplates.index') !!}">
                                <i class="fa fa-envelope"></i>
                                <span>Emailmallar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{!! route('app.date_constraints.index') !!}">
                                <i class="fa fa-calendar"></i>
                                <span>{!! trans('general.date_constraints') !!}</span>
                            </a>
                        </li>

                        <li class="line dk"></li>
                    @endif

                    @if(Auth::user()->hasRole('SuperAdministrator'))

                        <li class="padder menu-header">
                            <span>{!! trans('admin.menu_item') !!}</span>
                        </li>
                        <li>
                            <a href="{!! route('app.emails.index') !!}">
                                <i class="fa fa-envelope"></i>
                                <span>{!! trans('admin.emails') !!}</span>
                            </a>
                        </li>
                        <li class="line dk"></li>
                    @endif

                </ul>
            </nav>
            <!-- nav -->

            <!-- aside footer
            <div class="aside-footer wrapper m-t">
                <div class="text-center-folded">
                        <a href="/">
                        <i class="fa fa-fw fa-external-link text"></i>
                        <span class="hidden-folded center"> trans('general.to_homepage') </span>
                    </a>
                </div>
            </div>
            <!-- / aside footer -->
        </div>
    </div>
</aside>
<!-- / aside -->