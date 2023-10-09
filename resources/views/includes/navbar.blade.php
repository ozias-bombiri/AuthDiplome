<div class="border-end bg-white px-3" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">AuthDiplome</div>
    <ul class="mb-5">
        @hasrole(['direction', 'admin'])
        <li class="dropdown">
            <a class="nav-link" data-toggle="collapse" data-bs-toggle="dropdown"  href="#gapSubmenu" role="button" aria-expanded="false" aria-controls="gapSubmenu">Gestion attestion provisoire</a>
            
            <ul class="dropdown-menu" id="gapSubmenu">
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light py-1 px-3" href="{{ route('metiers.etablissements.attestations-list')}}">Attestations provisoire</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('metiers.etablissements.parcours-list')}}">Parcours</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('metiers.etablissements.parcours-list')}}">Parcours</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('metiers.etablissements.signataire-list')}}">Signataires</a>
                </li>
            </ul>
        </li>
        @endhasrole

        @hasrole(['daoi', 'admin'])
        <li class="btn-group dropdown">
            <a href="#gadSubmenu" data-toggle="collapse" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">Gestion attestation définitive</a>
            <ul class="dropdown-menu" id="gadSubmenu">
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="#!">Attestations définitives</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="#!">Impétrants</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="#!">Niveau d'étude</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#gdipSubmenu" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">Gestion diplome</a>
            
            <ul class="dropdown-menu" id="gadSubmenu">
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="#!">Diplômes</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="#!">Impétrants</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="#!">Niveau d'étude</a>
                </li>
            </ul>
        </li>
        @endhasrole

        @hasrole(['authentification', 'admin'])
        <li class="dropdown">
            <a href="#authSubmenu" data-bs-toggle="dropdown" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Authentification</a>
            <ul class="dropdown-menu" id="authSubmenu">
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light py-1 px-3" href="#!">Authentification</a>
                </li>
            </ul>
        </li>
        @endhasrole

        @hasrole(['daoi', 'admin'])
        <li class="dropdown">
            <a href="#adminSubmenu" data-bs-toggle="dropdown" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Parametrage</a>
            <ul class="dropdown-menu" id="adminSubmenu">
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('institutions.index') }}" active>Institutions</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('annee_academiques.index') }}">Année accademiques</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('niveau_etudes.index') }}">Niveau détudes</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('parcours.index') }}">Parcours</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('signataires.index') }}">Signataires</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('timbres.index') }}">Timbres</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('visas.index') }}">Visas</a>

                </li>
                <li><a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('users.index') }}">Utilisateurs</a>

                </li>
            </ul>
        </li>
        @endhasrole
    </ul>


</div>