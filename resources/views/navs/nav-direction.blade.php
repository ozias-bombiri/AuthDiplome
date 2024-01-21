<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="sidebar-item pt-2">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                <i class="far fa-clock" aria-hidden="true"></i>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('filieres.index', ['etablissement_id' =>auth()->user()->institution_id]) }}" aria-expanded="false">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="hide-menu">Filières</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('parcours.index', ['etablissement_id' =>auth()->user()->institution_id]) }}" aria-expanded="false">
                <i class="fa fa-table" aria-hidden="true"></i>
                <span class="hide-menu">Parcours</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('proces_verbals.index', ['etablissement_id' =>auth()->user()->institution_id]) }}" aria-expanded="false">
                <i class="fa fa-font" aria-hidden="true"></i>
                <span class="hide-menu">Procès verbaux</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('actes.provisoires.index', ['etablissement_id' =>auth()->user()->institution_id, 'categorieActe_id' =>  \App\Models\CategorieActe::findByIntitule('PROVISOIRE')]) }}" aria-expanded="false">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span class="hide-menu">Attestations provisoires</span>
            </a>
        </li>  
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('actes.provisoires.retrait') }}" aria-expanded="false">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span class="hide-menu">Remise d'attestations</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('authentification.provisoires.index') }}" aria-expanded="false">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span class="hide-menu">Authentification</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('etudiants.index', ['etablissement_id' =>auth()->user()->institution_id]) }}" aria-expanded="false">
                <i class="fa fa-globe" aria-hidden="true"></i>
                <span class="hide-menu">Etudiants</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('metiers.config.index', ['institution' =>auth()->user()->institution_id]) }}" aria-expanded="false">
                <i class="fa fa-columns" aria-hidden="true"></i>
                <span class="hide-menu">Configurations</span>
            </a>
        </li>
            
    </ul>

</nav>
