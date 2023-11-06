<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">

  

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

  

    <title>{{ config('app.name', 'Laravel') }}</title>
  

    <style type="text/css" media="screen">

        :root {
        --top-l1: 0em;
        --top-l2: 10em;
        --top-l3: 13em;
        --top-l4: 16em;
        --top-l5: 21em;
        --top-l6: 33em;
        --left-c1: 0em;
        --left-c2: 30em;
        --left-c3: 50em;
        --hl1: 8em;
        --wc1: 30em;
        --wc2: 10em;
        --wc3: 30em;
        --hl2: ;
        --hl3: ;
        --hl4: ;
        --hl5: ;
        --hl6: ;
        --hl7: ;
        }


        .wrapper {
            border: 1px solid black;
        }
        .zone{
            font-family: cursive;
            border: 0px solid black;
            position: fixed;
            padding: 0.1em;
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }
        #one {
            top: 0em;
            height: 7em;
            width: 30em;
            
        }
        #two {
            top: 0em;
            left: 30em;
            height: 7em;
            width: 7em;
            
        }
        #three {
            top: 0em;
            left: 50em;
            height: 7em;
            width: 15em;
        }
        #four {
            left: 0em;
            top: 8em;
            height: 2em;
            width: 90em;
        }
        #five {
            top: 11em;
            height: 2em;
            width: 90em;
        }
        /*-- ANNONE IMPETRANT --*/
        #six {
            top: 13em;
            height: 2em;
            width: 90em;
        }
        #seven {
            top: 15em;
            height: 4em;
            width: 90em;
        }
        #eight {
            top: 20em;
            height: 2em;
            width: 90em;
            left: 30em;
        }

        #nine {
            top: 22em;
            height: 4em;
            width: 90em;
        }

        #ten {
            top: 26em;
            height: 2em;
            width: 45em;
        }

        #eleven {
            left: 32em;
            top: 29em;
            height: 2em;
            width: 25em;
        }

        #twelve {
            left: 0em;
            top: 31em;
            height: 12em;
            width: 20em;
        }

        #threeteen {
            left: 40em;
            top: 31em;
            height: 10em;
            width: 30em;
        }

        #fourteen {
            left: 0em;
            top: 41em;
            height: 7em;
            width: 80em;
        }

        #logo {
            width: 90%;
            height: 90%;
            
            
        }
        #qrcode {
            width: 90%;
            height: 90%;
        }
        .enteteDeno{
            text-align: left;
            margin-left: 0px;
        }

        .enteteLic{
            text-align: left;
            
        }

    </style>

</head>

<body>

    <div class="wrapper">

        <!-- Timbre de l'institution -->
        <div id="one" class="zone text-center enteteDeno">
            <div> 
                Dénomitation du Ministère <br/>
                --------------- <br/>
                Dénomitation de l'IESR <br/>
                ---------<br/>
                Dénomitation de l'établissement (UFR, Institut) <br/>
                --------------- <br/>
                Adresses (BP, téléphone, Email officielle, Site web) <br/><br/>

                N°«Num_Enr» MESRSI/SG/IESR/P/VP-EIP/DAOI
            </div>
        </div>
        
        <!-- LOGO DE L'INSTITUTION -->
        <div id="two" class="zone text-center">
            <div> 
                
                <img id="logo" class="text-center" src="{{ $logo }}" alt="logo"> 
            </div>
        </div>

        <!-- TIMBRE DU BURKINA FASO -->

        <div id="three" class="zone text-center enteteBF">
            <div> 
                BURKINA FASO <br/>
                ------------- <br/>
                Unité-Progrès-Justice
            </div>

        </div>

        <!-- INTITULE DU DOCUMENT -->

        <div id="four" class="zone text-center">
            <div class ="text-center">  
                <h1> ATTESTATION DEFINITIVE</h1>
            </div>

        </div>
                
        <!-- ANNONE RESPONSABLE -->

        <div id="five" class="zone text-center">

            <div>
                    <p> Le Vice-Président chargé des Enseignements et des Innovations Pédagogiques ou le Directeur académique de l’IESR (ou équivalent), soussigné, atteste que : </p>
            </div>
        </div>

        <!-- ANNONE IMPETRANT -->

        <div id="six" class="zone text-center">
            <div class ="text-center"> 
                <h4> {{ $impetrant->nom }} {{ $impetrant->prenom }} </h4>
            </div>

        </div>

        <!-- INFORMATIONS DETAILLEES IMPETRANT-->

        <div id="seven" class="zone">
            <div>
                
                <p> 
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
                             à {{ $impetrant->lieuNaissance }} ({{ $impetrant->paysNaissance }}), sexe {{ $impetrant->sexe }}<br/>
                            type_Matricule ou INE: {{$impetrant->typeIdentifiant }} {{ $impetrant->identifiant }} <br/>
                            a acquis l'ensemble des crédits du parcours Licence {{ $parcours->intitule }} de l'établissement à l’issue de la session {{ $resultat->session}} 
                            de l’année académique {{ $resultat->annee_academique->intitule }}  et <br/>
                            a ainsi obtenu la : 
                </p>
            </div>
        </div>

        <!-- PARCOURS -->
        <div id="eight" class="zone enteteLic"> 
            <div> 
                <h2> LICENCE {{ strtoupper($parcours->intitule) }}</h2>
            </div>
        </div>

        <!-- INFORMATIONS DETAILLEES DIPLOME-->

        <div id="nine" class="zone">
            <div>
                <p>
                            Domaine : {{ $parcours->domaine }} <br/>
                            Mention : {{ $parcours->mention }} <br/>
                            Spécialité : {{ $parcours->specialite }} <br/>
                            Côte {{ $resultat->cote }}. 
                </p>
            </div> 

        </div>

        <!-- ANNONE JOUISSANCE -->

        <div id="ten" class="zone">

            <div class="row">
                <p>
                    En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de droit. <br/><br/>
                </p>
            </div>  
        </div>

        <!-- DATE DE CREATION -->

        <div id="eleven" class="zone">

            <div class="col-4">
                Fait le {{ \Carbon\Carbon::parse($attestation->dateSignature)->translatedFormat('d F Y') }} à {{ $attestation->lieuCreation}} <br/><br/><br/>
            </div>
        </div>

        <!-- ELEMENT DE SECURITE (QR CODE) -->

        <div id="twelve" class="zone text-center">

            <div class="col-6"> 
                    QR code <br/>
                    <!--{!! QrCode::size(300)->backgroundColor(255,90,0)->generate('RemoteStack') !!} -->
                    <img id="qrcode" src="{{ $qrcode }}" alt="qr code"> 
            </div>
        </div>

        <!-- SIGNATAIRE ET SIGNATURE -->

        <div id="threeteen" class="zone text-center">
            <div class="col-6"> 
                <p class="text-center"> <u>Pour le Responsable et par délégation le {{ $signataire->fonction }}</u> </p> <br/> <br/>

                <p class="text-center">
                        

                        <p class="text-center">
                            <br /><br />
                            @if($signataire->grade) {{ $signataire->grade }}@endif
                            {{ $signataire->prenom }} {{ $signataire->nom }}<br />
                            <em>{{ $signataire->titreAcademique }}<br /> {{ $signataire->titreHonorifique }}</em>
                        </p>
                </p>
            </div>

        </div>

        <!-- NOTA BENE -->

        <div id="fourteen" class="zone">
            <div class="col-12 offet-2"> 
                <b><u>Important : </u></b>
                <ul> 
                    <li> l’attestation provisoire est valable un (1) an à partir de sa date de signature ;</li>
                    <li> toute surcharge ou rature annule la présente attestation ; </li>
                    <li> il n’est délivré qu’un seul exemplaire de la présente attestation. Il appartient à l’intéressé (e) d’en faire des copies certifiées conformes.</li>
                </ul>
            </div>

        </div>

                
    </div>


</body>

</html>