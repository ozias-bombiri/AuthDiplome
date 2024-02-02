<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <!-- User Profile-->
        <li class="sidebar-item pt-2">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                <i class="bi bi-house-fill" aria-hidden="true"></i>
                <span class="hide-menu">Accueil</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('metiers.auth.index')}}" aria-expanded="false">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="hide-menu">Vérification</span>
            </a>
        </li>
    </ul>

</nav>