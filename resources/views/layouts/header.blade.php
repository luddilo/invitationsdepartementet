<!-- header -->
<header id="header" class="app-header navbar" role="menu">
    <!-- navbar header -->
    <div class="navbar-header bg-dark">
        <button class="pull-right visible-xs dk" ui-toggle-class="show" target=".navbar-collapse">
            <i class="glyphicon glyphicon-cog"></i>
        </button>
        <button class="pull-right visible-xs" ui-toggle-class="off-screen" target=".app-aside" ui-scroll="app">
            <i class="glyphicon glyphicon-align-justify"></i>
        </button>
        <!-- brand -->
        <a href="/" class="navbar-brand text-lt">
            <!--<i class="fa fa-btc"></i>
            <!--<img src="img/logo.png" alt="." class="hide">-->
            <span class="hidden-folded m-l-xs">Invitationsdepartementet</span>
        </a>
        <!-- / brand -->
    </div>
    <!-- / navbar header -->

    <!-- navbar collapse -->
    <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
        <!-- buttons -->
        <div class="nav navbar-nav hidden-xs" style="color: gray">
            <?php
                $path = Request::path();
                $reconstructed_path = '/app';
                $previous = 'app';
            ?>
            <a href="/app" class="btn no-shadow navbar-btn">Hem</a>
            @foreach(explode("/", $path) as $part)
                @if($part != 'app')
                    >
                    <?php
                        $reconstructed_path = $reconstructed_path . '/' . $part
                        ?>
                    <a href="{{ $reconstructed_path }}" class="btn no-shadow navbar-btn">
                        @if($previous == 'users' && is_numeric($part))
                            <?php $part = App\Models\User::find($part)->getFullName() ?>
                        @endif
                        {!! Lang::has('general.' . $part) ? trans('general.' . $part) : $part !!}
                    </a>
                    <?php
                        $previous = $part;
                    ?>
                @endif
            @endforeach
        </div>
        <!-- / buttons -->

        <!-- link and dropdown
        <ul class="nav navbar-nav hidden-sm">

            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                    <i class="fa fa-fw fa-plus visible-xs-inline-block"></i>
                    <span translate="header.navbar.new.NEW">New</span> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" translate="header.navbar.new.PROJECT">Projects</a></li>
                    <li>
                        <a href>
                            <span class="badge bg-info pull-right">5</span>
                            <span translate="header.navbar.new.TASK">Task</span>
                        </a>
                    </li>
                    <li><a href translate="header.navbar.new.USER">User</a></li>
                    <li class="divider"></li>
                    <li>
                        <a href>
                            <span class="badge bg-danger pull-right">4</span>
                            <span translate="header.navbar.new.EMAIL">Email</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- / link and dropdown -->

        <!-- search form
        <form class="navbar-form navbar-form-sm navbar-left shift" ui-shift="prependTo" data-target=".navbar-collapse" role="search" ng-controller="TypeaheadDemoCtrl">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" ng-model="selected" typeahead="state for state in states | filter:$viewValue | limitTo:8" class="form-control input-sm bg-light no-border rounded padder" placeholder="Search projects...">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </div>
        </form>
        <!-- / search form -->

        <!-- nabar right NOTIFICATIONS-->
        <ul class="nav navbar-nav navbar-right">
            <!--<li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                    <i class="icon-bell fa-fw"></i>
                    <span class="visible-xs-inline">Notifications</span>
                    <span class="badge badge-sm up bg-danger pull-right-xs">2</span>
                </a>
                <!-- dropdown
                <div class="dropdown-menu w-xl animated fadeInUp">
                    <div class="panel bg-white">
                        <div class="panel-heading b-light bg-light">
                            <strong>You have <span>2</span> notifications</strong>
                        </div>
                        <div class="list-group">
                            <a href class="list-group-item">
                                <span class="pull-left m-r thumb-sm">
                                    <img src="/assets/img/a0.jpg" alt="..." class="img-circle">
                                </span>
                                <span class="clear block m-b-none">
                                    Use awesome animate.css<br>
                                    <small class="text-muted">10 minutes ago</small>
                                </span>
                            </a>
                            <a href class="list-group-item">
                                <span class="clear block m-b-none">
                                    1.0 initial released<br>
                                    <small class="text-muted">1 hour ago</small>
                                </span>
                            </a>
                        </div>
                        <div class="panel-footer text-sm">
                            <a href class="pull-right"><i class="fa fa-cog"></i></a>
                            <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
                        </div>
                    </div>
                </div>
                <!-- / dropdown
            </li>-->
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">

                    <!-- AVATAR
                    <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                        <img src="#" alt="...">
                        <i class="on md b-white bottom"></i>
                    </span>
                    -->
                    <span class="hidden-sm hidden-md">
                         {!! Auth::user()->region->name !!}
                    </span>
                    @if (Auth::user()->hasRole('Administrator'))
                        <b class="caret"></b>
                    @endif
                </a>
                <!-- dropdown -->
                <ul class="dropdown-menu scrollable animated">
                    @foreach (Auth::user()->myRegions() as $region)
                        <li>
                            <a href="{!! route('app.user.region.edit', [Auth::user()->id, $region->id]) !!}">{!! $region->name !!}</a>
                        </li>
                    @endforeach
                </ul>
                <!-- / dropdown -->
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">

                    <!-- AVATAR
                    <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                        <img src="#" alt="...">
                        <i class="on md b-white bottom"></i>
                    </span>
                    -->
                    <span class="hidden-sm hidden-md">
                         {!! Auth::user()->getFullName() !!}
                    </span> <b class="caret"></b>
                </a>
                <!-- dropdown -->
                <ul class="dropdown-menu animated w">
                    <li>
                        <a href="{{ route('app.profile') }}">{{ trans('general.profile') }}</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}">{{ trans('general.logout') }}</a>
                    </li>
                </ul>
                <!-- / dropdown -->
            </li>
        </ul>
        <!-- / navbar right -->
    </div>
    <!-- / navbar collapse -->
</header>
<!-- / header -->