<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>{{ config('app.name', 'Laravel') }}</title>


    <style type="text/css" media="screen">
        @page {
            /*827 X 1170 en 100 dpi */
            margin: 5px 5px;
            border: 2px solid red;
            padding: 2em;

        }

        .wrapper {
            /*596 X 842 en 100 dpi */
            height: 700px;
            border: 0px solid red;
            width: 1032px;
            padding: 3em 3em;
            font-size: 12px;
        }

        .zone {
            font-family: Times;
            border: 0px solid black;
            position: absolute;

        }

        .w-full {
            width: 1036px;
            
        }

        .w-1_2 {
            width: 450px;
        }

        .w-1_3 {
            width: 345px;
        }

        .w-2_3 {
            width: 690px;
        }

        .w-1_4 {
            width: 245px;
        }

        .w-1_5 {
            width: 220px;
        }

        .w-2_5 {
            width: 440px;
        }

        .w-3_5 {
            width: 660px;
        }

        .text-center {
            text-align: center;
        }

        .px-0 {
            left: 2em;
        }

        .px-2_4 {
            left: 450px;
        }

        .px-3_4 {
            left: 825px;
        }

        .py-0 {
            top: 2em;
        }

        .py-1 {
            border-color: blue;
            top: 9em;
        }

        .py-2 {
            top: 13em;
        }

        .py-3 {
            top: 13em;
        }

        #entete {
            height: 10em;
            top: 1.5em;
        }


        /* Timbre */
        #one {
            top: inherit;
            height: inherit;
        }

        /* Logo */
        #two {
            top: inherit;
            height: inherit;
            text-align: center;
        }

        /* Timbre burkina */
        #three {
            top: inherit;
            height: inherit;
            text-align: center;
        }

        #main1 {
            top: 12em;
            width: 1036px;
            left: 2em;
        }

        /* Intitule document */
        #four {
            top: inherit;
            height: 2em;
            left: inherit;
            width: inherit;

        }

        /* Le responsable */
        #five {
            left: inherit;
            width: inherit;
            top: 12.5em;
            height: 1em;
            font-size: 16px;
        }

        /* Nom prénom impetrant */
        #six {
            left: inherit;
            width: inherit;
            top: 13em;
            height: 1.5em;
            border-color: yellowgreen;
            font-size: 16px;

        }

        /* Paragraphe informations detaillé */
        #seven {
            left: inherit;
            width: inherit;
            top: 16em;
            height: 5em;
            border-color: green;
            font-size: 16px;

        }

        /* Parcours */
        #eight {
            left: inherit;
            width: inherit;
            top: 21em;
            height: 2em;
            border-color: cyan;
            font-size: 25px;
            font-weight: bold;
        }

        /* INFORMATIONS DETAILLEES DIPLOME */
        #nine {
            left: inherit;
            width: inherit;
            top: 23em;
            height: 5em;
            font-size: 16px;

        }

        /* ANNONE JOUISSANCE */
        #ten {
            left: inherit;
            width: inherit;
            top: 28em;
            height: 1.5em;
            font-size: 16px;
            /*width: 20em;*/
        }

        #date {
            left: inherit;
            width: inherit;
            top: 31em;
            height: 1.5em;
            font-size: 16px;
        }

        /* DATE DE CREATION */
        #eleven {
            left: inherit;
            width: inherit;
            left: 80em;
            top: 30em;
            height: 1em;

        }

        #main2 {
            top: 32em;
            width: 1036px;
            left: 2em;
        }
        /* Qr code */
        #twelve {
            top: 35em;
            height: 8em;
            width: 12em;

        }

        /* Signataire */
        #threeteen {
            left: 40em;
            top: 32em;
            height: 11em;
            font-size: 15px;
        }

        /* Nota BENE */
        #fourteen {
            left: 2em;
            top: 44em;
            height: 7em;
            width: 1036px;
            font-size: 10px;
        }

        #logo {
            width: 55%;
            height: 100%;

        }

        #qrcode {
            width: 80%;
            height: 90%;

        }

        .text-it {
            font-size: 12px;
        }

        .paragraphe {
            line-height: 1.4;
        }

        .t1 {
            font-size: 1em;
            font-weight: bold;
        }

        .titre {
            top: 50%;
            font-size: 25px;
            font-weight: bold;
        }
    </style>

</head>

<body>

    <div class="wrapper">

        <!-- Timbre de l'institution -->
        <div id="entete">
            <div id="one" class="zone w-1_2 h-1 px-0 py-0">
            {{ $timbre->ministere->denomination }} <br />
            --------------- <br />
            
            {{ $signataireActe->institution->denomination }} <br />
            --------------- <br />
            {{ $signataireActe->institution->adresse.'  '.$signataireActe->institution->telephone }} <br />
            {{ $signataireActe->institution->email.'  '.$signataireActe->institution->siteWeb}}
            </div>


            <!-- LOGO DE L'INSTITUTION -->
            <div id="two" class="zone w-1_4 px-2_4 py-0">


                <img id="logo" class="text-center" src="{{ $logo }}" alt="logo">

            </div>

            <!-- TIMBRE DU BURKINA FASO -->

            <div id="three" class="zone w-1_4 h-1 px-3_4 py-0">

                BURKINA FASO <br />
                ------------- <br />
                Unité-Progrès-Justice

            </div>
        </div>
        <div>
            <div>
                N° {{ $acte->numero. ' '. $numeroteur->chaine}}
            </div>
        </div>
        <div id="main1">
            <!-- INTITULE DU DOCUMENT -->
 
            <div id="four" class="titre text-center">

                {{ $acte->intitule }}

            </div>

            <!-- ANNONE RESPONSABLE -->

            <div id="five" class="zone text-center">

                Le {{ $signataireActe->fonction }} de {{ $signataireActe->institution->denomination.' ('.$signataireActe->institution->sigle.')' }} , soussigné, atteste que : </p>

            </div>

            <!-- ANNONE IMPETRANT -->

            <div id="six" class="zone text-center w-full">

                <h4> {{ $impetrant->nom }} {{ $impetrant->prenom }} </h4>


            </div>

            <!-- INFORMATIONS DETAILLEES IMPETRANT-->

            <div id="seven" class="zone w-full">


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
                à {{ $impetrant->lieuNaissance }} ({{ $impetrant->paysNaissance }}), sexe {{ $impetrant->sexe }}<br />
                {{$impetrant->typeIdentifiant }} : {{ $impetrant->identifiant }} <br />
                a acquis l'ensemble des crédits du parcours {{ $parcours->intitule }} de {{ $institution->denomination. '('.$institution->sigle.')'}} à l’issue de la
                @if($parcours->soutenance) 
                    soutenance en date du {{ \Carbon\Carbon::parse($resultat->dateSouteance)->translatedFormat('d F Y') }}
                @else 
                    session {{ $resultat->session}}
                    de l’année académique {{ $resultat->procesVerbal->anneeAcademique->intitule }} 
                @endif 
                 <br />
                et a ainsi obtenu la :

            </div>

            <!-- PARCOURS -->
            <div id="eight" class="zone text-center w-full t1">
                 {{ strtoupper($parcours->intitule) }}
            </div>

            <!-- INFORMATIONS DETAILLEES DIPLOME-->

            <div id="nine" class="zone w-full px-0">
                Domaine : <b>{{ $parcours->domaine }}</b> <br/>
                Mention : <b>{{ $parcours->mention }} </b><br/>
                Spécialité : <b>{{ $parcours->specialite }}</b> <br/>
                Côte <b>@if($resultat->moyenne >= 16 ) A @elseif($resultat->moyenne < 16 && $resultat->moyenne >=14) B @elseif($resultat->moyenne < 14 && $resultat->moyenne >=12) C @elseif($resultat->moyenne < 12 && $resultat->moyenne >=10) @endif</b>.

            </div>

            <!-- ANNONE JOUISSANCE -->

            <div id="ten" class="zone">

                <div class="row">
                    En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de droit.
                </div>
            </div>

            



            <!-- DATE DE CREATION -->

            <div id="eleven" class="zone">

                Fait le <b>{{ \Carbon\Carbon::parse($acte->dateSignature)->translatedFormat('d F Y') }}</b> à <b>{{ $acte->lieu}}</b> 

            </div>
        </div>
        <div id="main2" >
            <!-- ELEMENT DE SECURITE (QR CODE) -->

            <div id="twelve" class="zone text-center w-1_3">

                 <img id="qrcode" src="{{ $qrcode }}" alt="qr code">

            </div>

            <!-- DATE -->
            <div id="date" class="zone">

                <div class="row">
                    Fait à <b>{{ $acte->lieu}}</b>, le <b>{{ \Carbon\Carbon::parse($acte->dateSignature)->translatedFormat('d F Y') }}</b>
                </div>
            </div>

            

            <div id="threeteen" class="zone text-center w-1_3 px-1_3">

                <p class="text-center"> <u> {{ $signataireActe->mention }} {{ $signataireActe->fonction }}</u> </p> <br />

                <p class="text-center">
                    <br /><br /> <br /> <br />
                    @if($signataireActe->signataire->grade) {{ $signataireActe->signataire->grade }}@endif
                    <b>{{ $signataireActe->signataire->prenom.' '.$signataireActe->signataire->nom }}<br />
                    <em>{{ $signataireActe->signataire->titreAcademique }}<br /> {{ $signataireActe->signataire->titreHonorifique }}</em>
                </p>

            </div>
        </div>
        <!-- NOTA BENE -->

        <div id="fourteen" class="zone">
            <div class="cw-full px-0">
                <b><u>Important : </u></b>
                <ul>
                    <li> toute surcharge ou rature annule la présente attestation ; </li>
                    <li> il n’est délivré qu’un seul exemplaire de la présente attestation.</li>
                </ul>
                Il appartient à l’intéressé (e) d’en faire des copies certifiées conformes.
            </div>

        </div>


    </div>


</body>

</html>