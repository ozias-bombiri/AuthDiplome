<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>{{ $document->reference }}</title>


    <style type="text/css" media="screen">
        @page {
            /*596 X 842 en 100 dpi */
            width: 596px;
            height: 842px;
            margin: 70px 95px; /* 2300 x 3318 pour le contenu de la page */
           
        }

        .zone {
            font-family: Times;
            border: 0px solid black;
            position: fixed;
            padding: 0.1em;
        }
        .w-full {
            width: 456px;
        }

        .w-1_2 {
            width: 298px;
        }

        .w-1_3 {
            width: 165px;
        }

        .w-2_3 {
            width: 330px;
        }

        .w-1_4 {
            width: 149px;
        }

        .w-1_5 {
            width: 120px;
        }
        .w-2_5 {
            width: 240px;
        }

        .w-3_5 {
            width: 360px;
        }

        .text-center {
            text-align: center;
        }

        /* Timbre */
        #one {
            left: 0px;
            height: 10em;
            /* width: 20em; */
        }

        /* Logo */
        #two {
            left: 298px;
            height: 10em;
            /* width: 7em; */

        }

        /* Timbre burkina */
        #three {
            right: 0px;
            height: 10em;
            /* width: 15em; */
        }

        /* Intitule document */
        #four {
            left: 0em;
            top: 11em;
            height: 5em;
            width: 45em;
        }

        /* Le responsable */
        #five {
            top: 16em;
            height: 3em;
            width: 45em;
        }

        /* Atteste que */
        #six {
            top: 20em;
            height: 5em;
            width: 45em;
        }

        /* Paragraphe informations detaillé */
        #seven {
            top: 25em;
            height: 12em;
            width: 45em;
        }

        /* En foi de quoi */
        #eight {
            top: 38em;
            height: 3em;
            width: 45em;
        }

        /* Fait à le */
        #nine {
            left: 20em;
            top: 41em;
            height: 2em;
            width: 25em;
        }

        /* Qr code */
        #ten {
            left: 0em;
            top: 43em;
            height: 12em;
            width: 20em;
        }

        /* Signataire */
        #eleven {
            left: 23em;
            top: 43em;
            height: 12em;
            width: 20em;
        }

        /* Nota BENE */
        #twelve {
            left: 0em;
            top: 58em;
            height: 7em;
            width: 45em;
        }

        #logo {
            width: 90%;
            height: 60%;

        }

        #qrcode {
            width: 60%;
            height: 80%;

        }

        .text-it {
            font-size: 12px;
        }

        .paragraphe {
            line-height: 1.5;
        }
    </style>

</head>

<body>

    <div class="wrapper">

        <!-- Timbre de l'institution -->
        <div id="one" class="zone w-1_2">
            <div>
                {{ $timbre->denomMinistere }} <br />
                --------------- <br />
                @if($institution->parent)
                {{ $institution->parent->denomination }} <br />
                ---------<br />
                @endif
                {{ $institution->denomination }} <br />
                --------------- <br />
                {{ $institution->adresse }} {{ $institution->telephone }} <br />
                {{ $institution->email }} {{ $institution->siteWeb}}

            </div>
        </div>

        <!-- LOGO DE L'INSTITUTION -->
        <div id="two" class="zone text-center w-1_4">
            <div>

                <img id="logo" src="{{ $logo }}" alt="logo">
            </div>
        </div>

        <!-- TIMBRE DU BURKINA FASO -->

        <div id="three" class="zone text-center w-1_4">
            <div>
                BURKINA FASO <br />
                ------------- <br />
                Unité-Progrès-Justice
            </div>

        </div>

        <!-- INTITULE DU DOCUMENT -->

        <div id="four" class="zone text-center w-full">
            <div class="text-center">
                <h2> ATTESTATION PROVISOIRE DE LICENCE</h2>
            </div>

        </div>

        <!-- ANNONE RESPONSABLE -->

        <div id="five" class="zone text-center w-full">

            <div class="row">
                <p> Le Responsable de l'établissement (Directeur académique ou équivalement de l'UFR), soussigné, </p>
            </div>
        </div>

        <!-- ANNONE IMPETRANT -->

        <div id="six" class="zone text-center w-full">
            <div class="text-center">
                <h4> ATTESTE QUE </h4>
                <h5> {{ $impetrant->nom }} {{ $impetrant->prenom }} </h5>
                <hr/>
            </div>

        </div>

        <!-- INFORMATIONS DETAILLEES -->

        <div id="seven" class="zone w-full">
            <div class="row">
                <p class="paragraphe">
                    @if(! $impetrant->nevers) 
                        @if($impetrant->sexe == "Masculin") né le 
                        @else née le 
                        @endif
                        {{ \Carbon\Carbon::parse($impetrant->dateNaissance)->translatedFormat('d F Y') }}
                    @else
                        @if($impetrant->sexe == "Masculin") né en 
                        @else née en 
                        @endif
                        {{ \Carbon\Carbon::parse($impetrant->dateNaissance)->translatedFormat('Y') }}
                    @endif

                      à {{ $impetrant->lieuNaissance }} ({{ $impetrant->paysNaissance }}) <br />
                    {{$impetrant->typeIdentifiant }} : {{ $impetrant->identifiant }} Sexe : {{ $impetrant->sexe }} <br />
                    a acquis les {{ $parcours->credit }} crédits du parcours {{ $parcours->intitule }} à l’issue
                    @if($parcours->soutenance) 
                     de la soutenance en date du {{ \Carbon\Carbon::parse($resultat->dateSouteance)->translatedFormat('d F Y') }}
                    @else 
                    de la session {{ $resultat->session}}
                    de l’année académique {{ $resultat->annee_academique->intitule }} 
                    @endif                    
                    <br />
                    Domaine : {{ $parcours->domaine }} <br />
                    Mention : {{ $parcours->mention }} <br />
                    Spécialité : {{ $parcours->specialite }} <br />
                    et a obtenu la moyenne générale de {{ $resultat->moyenne}} sur 20, côte {{ $resultat->cote}}.
                </p>
            </div>

        </div>

        <!-- ANNONE JOUISSANCE -->

        <div id="eight" class="zone">

            <div class="row w-full">
                <p>
                    En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de droit. <br /><br />
                </p>
            </div>
        </div>

        <!-- DATE DE CREATION -->

        <div id="nine" class="zone">

            <div class="col-4">
                Fait le {{ \Carbon\Carbon::parse($document->dateSignature)->translatedFormat('d F Y') }} à {{ $document->lieuCreation}} <br /><br /><br />
            </div>
        </div>

        <!-- ELEMENT DE SECURITE (QR CODE) -->

        <div id="ten" class="zone text-center">

            <div class="col-6">
                <br />
                <!--{!! QrCode::size(300)->backgroundColor(255,90,0)->generate('RemoteStack') !!} -->
                <img id="qrcode" src="{{ $qrcode }}" alt="qr code">
            </div>
        </div>

        <!-- SIGNATAIRE ET SIGNATURE -->

        <div id="eleven" class="zone text-center">
            <div class="col-6">
                <p class="text-center"> <u>Pour le Responsable et par délégation le {{ $signataire->fonction }}</u> </p> <br /> <br />

                <p class="text-center">
                    <br /><br />
                    @if($signataire->grade) {{ $signataire->grade }}@endif
                    {{ $signataire->prenom }} {{ $signataire->nom }}<br />
                    <em>{{ $signataire->titreAcademique }}<br /> {{ $signataire->titreHonorifique }}</em>
                </p>
            </div>

        </div>

        <!-- NOTA BENE -->

        <div id="twelve" class="zone w-full">
            <div>
                <b><u>Important : </u></b>
                <ul class="text-it">
                    <li> l’attestation provisoire est valable un (1) an à partir de sa date de signature ;</li>
                    <li> toute surcharge ou rature annule la présente attestation ; </li>
                    <li> il n’est délivré qu’un seul exemplaire de la présente attestation. Il appartient à l’intéressé (e) d’en faire des copies certifiées conformes.</li>
                </ul>
            </div>

        </div>


    </div>


</body>

</html>