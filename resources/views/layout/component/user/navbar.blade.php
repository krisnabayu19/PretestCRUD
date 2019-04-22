    <header class="header">
        <nav class="navbar bg-blue">
            <div class="navbar-current">
                <h3 class="current-page">@yield('current-page')</h3>
            </div>
            <div class="navbar-sign-out">
                <form action="/sign-out" method="POST">
                    @csrf

                    <button type="submit" class="btn-sign-out"><i class="fa fa-sign-out"></i>Sign Out</button>
                </form>
            </div>
        </nav>
    </header>