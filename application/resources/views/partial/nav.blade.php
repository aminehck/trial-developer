<nav class="navbar navbar-dark sticky-top bg-info flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="./">ActualSales</a>
    {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
    <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
        <a  class="nav-link text-white" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <b>{{Auth::User()->name}}</b> - Sign out
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
    </ul>
</nav>