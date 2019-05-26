<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navber-header">
      <a class="navbar-brand" href="/">Forum</a>
    </div>

    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        @guest
        <li class="nav-item">
          <a href="{{ route('login') }}" class="nav-link">註冊</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('login') }}" class="nav-link">登入</a>
        </li>
        @else
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Hi!, {{ Auth::user()->name }}
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ route('account.groups.index') }}">My Groups</a>
            </li>
            <li>
              <a href="{{ route('account.posts.index') }}">My Posts</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                登出
              </a>
            </li>
          </ul>
        </li>
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
          @csrf
        </form>
        @endguest
      </ul>
    </div>
  </div>
</nav>