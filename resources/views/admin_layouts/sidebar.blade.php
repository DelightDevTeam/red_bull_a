<div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">

  <ul class="navbar-nav">
    {{-- kzt --}}
    <li class="nav-item active">
      <a class="nav-link text-white " href="{{ route('home') }}" style="font-szie:large;">
        <span class="sidenav-mini-icon"> <i class="material-icons-round opacity-10">dashboard</i> </span>
        @if(Auth::user()->hasRole('Admin'))
        <span class="sidenav-normal ms-2 ps-1">@lang('public.admin_dashboard')</span>
        @elseif(Auth::user()->hasRole('Agent'))
        <span class="sidenav-normal ms-2 ps-1">@lang('public.agent_dashboard')</span>
        @endif
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white " href="{{ route('admin.profile.index')}}">
        <span class="sidenav-mini-icon"> <i class="fa-solid fa-user"></i> </span>
        <span class="sidenav-normal  ms-2  ps-1"> @lang('public.profile') </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white " href="{{ route('admin.report.index')}}">
        <span class="sidenav-mini-icon"> <i class="fa-solid fa-chart-column"></i> </span>
        <span class="sidenav-normal  ms-2  ps-1"> @lang('public.win_lose_report') </span>
      </a>
    </li>
    @can('admin_access')
    <li class="nav-item">
      <a class="nav-link text-white " href="{{ route('admin.agent.index')}}">
        <span class="sidenav-mini-icon"> <i class="fa-solid fa-user"></i> </span>
        <span class="sidenav-normal  ms-2  ps-1"> @lang('public.agent_list') </span>
      </a>
    </li>
    @endcan
    @can('player_index')
    <li class="nav-item">
      <a class="nav-link text-white " href="{{ route('admin.player.index')}}">
        <span class="sidenav-mini-icon"> <i class="fa-solid fa-user"></i> </span>
        <span class="sidenav-normal  ms-2  ps-1">@lang('public.player_list')</span>
      </a>
    </li>
    @endcan

     {{-- @can('admin_access')
    <li class="nav-item">
      <a class="nav-link text-white " href="{{ url('admin/agent-to-player-deplogs')}}">
        <span class="sidenav-mini-icon"> <i class="fa-solid fa-user"></i> </span>
        <span class="sidenav-normal  ms-2  ps-1">AgentToPlayerDepLog</span>
      </a>
    </li>
    @endcan --}}

     @can('admin_access')
    <li class="nav-item">
      <a class="nav-link text-white " href="{{ url('admin/agent-win-lose-report')}}">
        <span class="sidenav-mini-icon"> <i class="fa-solid fa-user"></i> </span>
        <span class="sidenav-normal  ms-2  ps-1"> @lang('public.agent_win_lose') </span>
      </a>
    </li>
    @endcan

    @can('admin_access')
    <li class="nav-item">
      <a class="nav-link text-white " href="{{ url('admin/players-list')}}">
        <span class="sidenav-mini-icon"> <i class="fa-solid fa-user"></i> </span>
        <span class="sidenav-normal  ms-2  ps-1">@lang('public.player_list') </span>
      </a>
    </li>
    @endcan
     {{-- @can('admin_access')
    <li class="nav-item">
      <a class="nav-link text-white " href="{{ url('admin/bonu/countindex')}}">
        <span class="sidenav-mini-icon"> <i class="fa-solid fa-user"></i> </span>
        <span class="sidenav-normal  ms-2  ps-1">BonusList</span>
      </a>
    </li>
    @endcan --}}
    <li class="nav-item">
      <a class="nav-link text-white " href="{{ route('admin.transferLog')}}">
        <span class="sidenav-mini-icon"> <i class="fas fa-right-left"></i> </span>
        <span class="sidenav-normal  ms-2  ps-1"> @lang('public.transfer_log') </span>
      </a>
    </li>
      @can('bank')
          <li class="nav-item">
              <a class="nav-link text-white " href="{{ route('admin.bank.index')}}">
                  <span class="sidenav-mini-icon"> <i class="fas fa-right-left"></i> </span>
                  <span class="sidenav-normal  ms-2  ps-1">@lang('public.bank_account')</span>
              </a>
          </li>
      @endcan
    @can('deposit')
    <li class="nav-item">
      <a class="nav-link text-white " href="{{ route('admin.agent.deposit')}}">
        <span class="sidenav-mini-icon"> <i class="fas fa-right-left"></i> </span>
        <span class="sidenav-normal  ms-2  ps-1"> @lang('public.deposit_request')</span>
      </a>
    </li>
    @endcan
    @can('withdraw')
    <li class="nav-item">
      <a class="nav-link text-white " href="{{ route('admin.agent.withdraw')}}">
        <span class="sidenav-mini-icon"> <i class="fas fa-right-left"></i> </span>
        <span class="sidenav-normal  ms-2  ps-1"> @lang('public.withdraw_request')</span>
      </a>
    </li>
    @endcan

    <hr class="horizontal light mt-0">

    <li class="nav-item">
      <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link text-white " aria-controls="dashboardsExamples" role="button" aria-expanded="false">
        <i class="material-icons py-2">settings</i>
        <span class="nav-link-text ms-2 ps-1">@lang('public.general_setup')</span>
      </a>
      <div class="collapse " id="dashboardsExamples">
        <ul class="nav ">
            @can('bank')
            <li class="nav-item ">
                <a class="nav-link text-white " href="{{ route('admin.paymentTypes.index') }}">
                    <span class="sidenav-mini-icon"> <i class="fa-solid fa-panorama"></i> </span>
                    <span class="sidenav-normal  ms-2  ps-1"> @lang('public.bank_account') </span>
                </a>
            </li>
            @endcan
            @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('admin.banners.index') }}">
              <span class="sidenav-mini-icon"> <i class="fa-solid fa-panorama"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> @lang('public.banner') </span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('admin.adsbanners.index') }}">
              <span class="sidenav-mini-icon"> <i class="fa-solid fa-panorama"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> @lang('public.ads_banner') </span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('admin.text.index') }}">
              <span class="sidenav-mini-icon"> <i class="fa-solid fa-panorama"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> @lang('public.banner_text') </span>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('admin.promotions.index') }}">
              <span class="sidenav-mini-icon"> <i class="fas fa-gift"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> @lang('public.promotion') </span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('admin.gametypes.index') }}">
              <span class="sidenav-mini-icon">G</span>
              <span class="sidenav-normal  ms-2  ps-1"> @lang('public.game_type') </span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('admin.gameLists.index') }}">
              <span class="sidenav-mini-icon">G L</span>
              <span class="sidenav-normal  ms-2  ps-1"> @lang('public.game_list') </span>
            </a>
          </li>
          @endcan
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();" class="nav-link text-white">
        <span class="sidenav-mini-icon"> <i class="fas fa-right-from-bracket text-white"></i> </span>
        <span class="sidenav-normal ms-2 ps-1"> @lang('public.logout') </span>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>
  </ul>
