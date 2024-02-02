<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="sidebar-item pt-2">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                <i class="bi bi-house-fill" aria-hidden="true"></i>
                <span class="hide-menu">Accueil</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('filieres.index', ['etablissement_id' =>auth()->user()->institution_id]) }}" aria-expanded="false">
                <i class="fbi bi-folder-fill" aria-hidden="true"></i>
                <span class="hide-menu">Filières</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('parcours.index', ['etablissement_id' =>auth()->user()->institution_id]) }}" aria-expanded="false">
                <i class="bi bi-signpost-split-fill" aria-hidden="true"></i>
                <span class="hide-menu">Parcours</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('proces_verbals.index', ['etablissement_id' =>auth()->user()->institution_id]) }}" aria-expanded="false">
                <i class="bi bi-files" aria-hidden="true"></i>
                <span class="hide-menu">Procès verbaux</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('actes.provisoires.index', ['etablissement_id' =>auth()->user()->institution_id, 'categorieActe_id' =>  \App\Models\CategorieActe::findByIntitule('PROVISOIRE')]) }}" aria-expanded="false">
                <i class="bi bi-mortarboard-fill" aria-hidden="true"></i>
                <span class="hide-menu">Attestations provisoires</span>
            </a>
        </li>  
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('actes.provisoires.retrait') }}" aria-expanded="false">
                <i class="bi bi-mortarboard-fill" aria-hidden="true"></i>
                <span class="hide-menu">Remise d'attestations</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('authentification.provisoires.index') }}" aria-expanded="false">
                <i class="bi bi-file-check" aria-hidden="true"></i>
                <span class="hide-menu">Authentification</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('etudiants.index', ['etablissement_id' =>auth()->user()->institution_id]) }}" aria-expanded="false">
                <i class="bi bi-person-lines-fill" aria-hidden="true"></i>
                <span class="hide-menu">Etudiants</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('metiers.config.index', ['institution' =>auth()->user()->institution_id]) }}" aria-expanded="false">
                <i class="bi bi-gear-fill" aria-hidden="true"></i>
                <span class="hide-menu">Configurations</span>
            </a>
        </li>
            
    </ul>

</nav>
