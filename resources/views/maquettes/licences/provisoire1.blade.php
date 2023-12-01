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
            /*827 X 1170 en 100 dpi */
            margin: 5px 5px;
            /*border: 2px solid red;*/
            padding: 2em;
           
        }

        .wrapper{
            /*596 X 842 en 100 dpi */
            height: 1100px;
            /*border: 2px solid red;*/
            width: 780px;
           
        }

        .zone {
            font-family: Times;
            /*border: 1px solid black;*/
            position: absolute;
            padding: 0.1em;
        }
        .w-full {
            width: 690px;
        }

        .w-1_2 {
            width: 340px;
        }

        .w-1_3 {
            width: 225px;
        }

        .w-2_3 {
            width: 450px;
        }

        .w-1_4 {
            width: 170px;
        }

        .h-1{
            height: 150px;
        }

        .w-1_5 {
            width: 135px;
        }
        .w-2_5 {
            width: 270px;
        }

        .w-3_5 {
            width: 405px;
        }

        .text-center {
            text-align: center;
        }
        .px-0 {
            left: 50px;
        }

        .px-3_4 {
            left: 565px;
        }

        .py-0 {
            top: 50px;
        }
        .py-1 {
            border-color: blue;
            top: 220px;
        }
        .py-2 {
            top: 50px;
        }

        /* Timbre */
        #one {
            /*left: 0px;
            height: 10em;
            /* width: 20em; */
        }

        /* Logo */
        #two {
            left: 350px;
           /* height: 10em;
            /* width: 7em; */

        }

        /* Timbre burkina */
        #three {
            /*left: 520px;
            height: 10em;
            /* width: 15em; */
        }

        /* Intitule document */
        #four {
            
            height: 3em;
            
        }

        /* Le responsable */
        #five {
            top: 18em;
            height: 2em;
            
        }

        /* Atteste que */
        #six {
            top: 19em;
            height: 5em;
            
        }

        /* Paragraphe informations detaillé */
        #seven {
            top: 24em;
            height: 13em;
            
        }

        /* En foi de quoi */
        #eight {
            top: 37em;
            height: 1em;
        }

        /* Fait à le */
        #nine {
            left: 20em;
            top: 39em;
            height: 1em;
            width: 26em;
        }

        /* Qr code */
        #ten {
            top: 43em;
            height: 10em;
            /*width: 20em;*/
        }

        /* Signataire */
        #eleven {
            left: 23em;
            top: 41em;
            height: 14em;
            width: 23em;
        }

        /* Nota BENE */
        #twelve {
            top: 60em;
            height: 7em;
            
        }

        #logo {
            width: 90%;
            height: 80%;

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
        <div id="one" class="zone w-1_2 h-1 px-0 py-0">
            <div>
                {{ $timbre->ministere->denomination }} <br />
                --------------- <br />
                @if($institution->parent)
                {{ $institution->parent->denomination }} <br />
                ---------<br />
                @endif
                {{ $institution->denomination }} <br />
                --------------- <br />
                {{ $institution->adresse.'  '.$institution->telephone }} <br />
                {{ $institution->email.'  '.$institution->siteWeb}}

            </div>
        </div>

        <!-- LOGO DE L'INSTITUTION -->
        <div id="two" class="zone text-center w-1_4 h-1 py-0">            

            <img id="logo" src="{{ $logo }}" alt="logo">
            
        </div>

        <!-- TIMBRE DU BURKINA FASO -->

        <div id="three" class="zone text-center w-1_4 h-1 px-3_4 py-0">
            
            BURKINA FASO <br />
            ------------- <br />
            Unité-Progrès-Justice        

        </div>

        <!-- INTITULE DU DOCUMENT -->

        <div id="four" class="zone text-center w-full px-0 py-1"> 

            <h2> ATTESTATION PROVISOIRE DE LICENCE</h2>
            
        </div>

        <!-- ANNONE RESPONSABLE -->

        <div id="five" class="zone text-center w-full px-0">

            Le Responsable de l'établissement (Directeur académique ou équivalement de l'UFR), soussigné,
           
        </div>

        <!-- ANNONE IMPETRANT -->

        <div id="six" class="zone text-center w-full px-0">
            
            <h4> ATTESTE QUE </h4>
            <h5> {{ $impetrant->nom }} {{ $impetrant->prenom }} </h5>
        </div>

        <!-- INFORMATIONS DETAILLEES -->

        <div id="seven" class="zone w-full px-0">
            
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
                a acquis les {{ $parcours->niveau_etude->credit }} crédits du parcours {{ $parcours->intitule }} à l’issue
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

        <!-- ANNONE JOUISSANCE -->

        <div id="eight" class="zone w-full px-0">        
            
            En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de droit. <br /><br />
            
            
        </div>

        <!-- DATE DE CREATION -->

        <div id="nine" class="zone">

            Fait le {{ \Carbon\Carbon::parse($document->dateSignature)->translatedFormat('d F Y') }} à {{ $document->lieuCreation}} <br /><br /><br />
        
        </div>

        <!-- ELEMENT DE SECURITE (QR CODE) -->

        <div id="ten" class="zone text-center w-1_3 px-0">
        
            <br />
            <!--{!! QrCode::size(300)->backgroundColor(255,90,0)->generate('RemoteStack') !!} -->
            <img id="qrcode" src="{{ $qrcode }}" alt="qr code">
        
        </div>

        <!-- SIGNATAIRE ET SIGNATURE -->

        <div id="eleven" class="zone text-center">
            
            <p class="text-center"> <u>Pour le Responsable et par délégation le {{ $signataire->fonction }}</u> </p> <br /> <br />

            <p class="text-center">
                <br /><br />
                @if($signataire->grade) {{ $signataire->grade }}@endif
                {{ $signataire->prenom }} {{ $signataire->nom }}<br />
                <em>{{ $signataire->titreAcademique }}<br /> {{ $signataire->titreHonorifique }}</em>
            </p>
            
        </div>

        <!-- NOTA BENE -->

        <div id="twelve" class="zone w-full px-0">
            
            <b><u>Important : </u></b>
            <ul class="text-it">
                <li> l’attestation provisoire est valable un (1) an à partir de sa date de signature ;</li>
                <li> toute surcharge ou rature annule la présente attestation ; </li>
                <li> il n’est délivré qu’un seul exemplaire de la présente attestation. Il appartient à l’intéressé (e) d’en faire des copies certifiées conformes.</li>
            </ul>            

        </div>

    </div>

</body>

</html>