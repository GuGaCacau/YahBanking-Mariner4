<header>
    <div class="container mb-3" id="nav-container">
        <nav class="navbar navbar-dark navbar-expand-md">
            <a href="/" class="navbar-brand">
                <small class="logo_title">YahBanking</small>
                <small class="logo_link">Mariner4</small>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links" aria-controls="navbar-links" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-end mx-2" id="navbar-links">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="/" class="nav-link
                    @hasSection('navbar-clients')
                        @yield('navbar-clients')
                    @endif
                        ">Clientes</a></li>
                    <li class="nav-item"><a href="/investments" class="nav-link
                    @hasSection('navbar-investments')
                        @yield('navbar-investments')
                    @endif    
                        ">Investimentos</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>