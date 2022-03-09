<nav class="navbar sticky-top navbar-expand-lg ">
    <div class="container " >
        <a class="navbar-brand" href="#">TELE<span>GAMING</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span >
                <i class="fas fa-bars" style="color:#d4af37; font-size:25px;"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse " id="main_nav">
            <ul class="navbar-nav ms-auto">
                @each('layouts.submenu', App\Models\Menu::tree(), 'menu')
            </ul>
        </div>
    </div>

</nav>
