<div class="border-end bg-white px-3" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">AuthDiplome</div>
    <ul class="mb-5">
        @hasrole(['direction'])
        <li>
            <a  href="#gapSubmenu" >Gestion attestion provisoire</a>
            <!--@if(auth()->user()->institution_id)-->
            <ul id="gapSubmenu">
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light py-1 px-3" href="{{ route('metiers.etablissements.attestation-list', auth()->user()->institution_id)}}">Attestations provisoire</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('metiers.etablissements.parcours-list', auth()->user()->institution_id)}}">Parcours</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('metiers.etablissements.etudiant-list', auth()->user()->institution_id)}}">Etudiants</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light px-3 py-1" href="{{ route('metiers.etablissements.signataire-list', auth()->user()->institution_id)}}">Signataires</a>
                </li>
            </ul>
            <!--@endif-->
        </li>
        @endhasrole

        @hasrole(['daoi'])
        <li>
            <a href="#gadSubmenu" >Gestion attestation définitive</a>
            <ul id="gadSubmenu">
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
            <a href="#gdipSubmenu">Gestion diplome</a>
            
            <ul id="gadSubmenu">
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

        @hasrole(['authentification'])
        <li >
            <a href="#authSubmenu">Authentification</a>
            <ul id="authSubmenu">
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-light py-1 px-3" href="#!">Authentification</a>
                </li>
            </ul>
        </li>
        @endhasrole

        @hasrole(['admin'])
        <li >
            <a href="#adminSubmenu">Parametrage</a>
            <ul id="adminSubmenu">
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