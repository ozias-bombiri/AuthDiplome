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
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('parcours.index') }}" aria-expanded="false">
                <i class="bi bi-signpost-split-fill" aria-hidden="true"></i>
                <span class="hide-menu">Parcours</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('proces_verbals.index') }}" aria-expanded="false">
                <i class="bi bi-files" aria-hidden="true"></i>
                <span class="hide-menu">Procès verbaux</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('retrait_actes.index') }}" aria-expanded="false">
                <i class="bi bi-mortardbord-fill" aria-hidden="true"></i>
                <span class="hide-menu">Remise d'actes</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('institutions.index') }}" aria-expanded="false">
                <i class="bi bi-diagram-3-fill" aria-hidden="true"></i>
                <span class="hide-menu">Etablissements</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('etudiants.index') }}" aria-expanded="false">
                <i class="bi bi-person-lines-fill" aria-hidden="true"></i>
                <span class="hide-menu">Etudiants</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('signataires.index') }}" aria-expanded="false">
                <i class="bi bi-joystick" aria-hidden="true"></i>
                <span class="hide-menu">Signataires</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('annee_academiques.index') }}" aria-expanded="false">
                <i class="bi bi-layers-half" aria-hidden="true"></i>
                <span class="hide-menu">Années academiques</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('niveau_etudes.index') }}" aria-expanded="false">
                <i class="bi bi-stack" aria-hidden="true"></i>
                <span class="hide-menu">Niveaux d'études</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('categorie_actes.index') }}" aria-expanded="false">
                <i class="bi bi-tags-fill" aria-hidden="true"></i>
                <span class="hide-menu">Categorie d'actes</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('numeroteurs.index') }}" aria-expanded="false">
                <i class="bi bi-123" aria-hidden="true"></i>
                <span class="hide-menu">Numeroteurs</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('timbres.index') }}" aria-expanded="false">
                <i class="bi bi-bookmarks-fill" aria-hidden="true"></i>
                <span class="hide-menu">Timbres</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('visa_institutions.index') }}" aria-expanded="false">
                <i class="bi bi-list-task" aria-hidden="true"></i>
                <span class="hide-menu">Visas</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('users.index') }}" aria-expanded="false">
                <i class="bi bi-people-fill" aria-hidden="true"></i>
                <span class="hide-menu">Utilisateurs</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('actes.provisoires.index') }}" aria-expanded="false">
                <i class="bi bi-mortarboard-fill" aria-hidden="true"></i>
                <span class="hide-menu">Attestations provisoires</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('actes.definitives.index', ['categorieActe_id' =>  \App\Models\CategorieActe::findByIntitule('DEFINITIVE')]) }}" aria-expanded="false">
                <i class="bi bi-mortarboard-fill" aria-hidden="true"></i>
                <span class="hide-menu">Attestations définitives</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('actes.diplomes.index', ['categorieActe_id' =>  \App\Models\CategorieActe::findByIntitule('DIPLOME')]) }}" aria-expanded="false">
                <i class="bi bi-mortarboard-fill" aria-hidden="true"></i>
                <span class="hide-menu">Diplômes</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('authentification.provisoires.index') }}" aria-expanded="false">
                <i class="bi bi-file-check-fill" aria-hidden="true"></i>
                <span class="hide-menu">Authentification</span>
            </a>
        </li>
    </ul>

</nav>