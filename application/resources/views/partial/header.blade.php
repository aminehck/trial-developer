<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
            <a class="nav-link {{(\Route::current()->getName() == 'home') ? 'active' : ''}}" href="{{route('home')}}">
                <span data-feather="bar-chart-2"></span>
                Dashboard 
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{(\Route::current()->getName() == 'transactions') ? 'active' : ''}}" href="{{route('transactions')}}">
                <span data-feather="shopping-cart"></span>
                Transactions
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{(\Route::current()->getName() == 'clients') ? 'active' : ''}}" href="{{route('clients')}}">
                <span data-feather="users"></span>
                Clients
            </a>
            </li>
            
            <li class="nav-item">
            <a class="nav-link {{(\Route::current()->getName() == 'deals') ? 'active' : ''}}" href="{{route('deals')}}">
                <span data-feather="layers"></span>
                Deals
            </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Import</span>
            <a class="d-flex align-items-center text-muted" href="{{route('import')}}">
            <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
            <a class="nav-link {{(\Route::current()->getName() == 'import') ? 'active' : ''}}" href="{{route('import')}}">
                <span data-feather="file-text"></span>
                CSV File
            </a>
        </ul>
    </div>
</nav>