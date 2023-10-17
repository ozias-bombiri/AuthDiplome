<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">

  

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

  

    <title>{{ config('app.name', 'Laravel') }}</title>


    <style type="text/css" media="screen">

        .wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            grid-auto-rows: minmax(80px, auto);
        }
        .zone{
            font-family: cursive;
            border: 0px solid black;
            position: fixed;
            padding: 0.1em;
        }

        .text-center {
            text-align: center;
        }
        #one {
            
            height: 10em;
            width: 20em;
        }
        #two {
            left: 21em;
            height: 10em;
            width: 7em;
            
        }
        #three {
            left: 29em;
            height: 10em;
            width: 15em;
        }
        #four {
            left: 0em;
            top: 13em;
            height: 5em;
            width: 45em;
        }
        #five {
            top: 19em;
            height: 3em;
            width: 45em;
        }

        #six {
            top: 22em;
            height: 5em;
            width: 45em;
        }
        #seven {
            top: 27em;
            height: 12em;
            width: 45em;
        }
        #eight {
            top: 39em;
            height: 3em;
            width: 45em;
        }

        #nine {
            left: 20em;
            top: 43em;
            height: 2em;
            width: 25em;
        }

        #ten {
            left: 0em;
            top: 46em;
            height: 12em;
            width: 20em;
        }

        #eleven {
            left: 25em;
            top: 46em;
            height: 12em;
            width: 20em;
        }

        #twelve {
            left: 0em;
            top: 61em;
            height: 7em;
            width: 45em;
        }

        #logo {
            width: 80%;
            height: 60%;
            
        }

    </style>

</head>

<body>

    <div class="wrapper">

        <!-- Timbre de l'institution -->
        <div id="one" class="zone text-center">
            <div> 
                Dénomitation du Ministère <br/>
                --------------- <br/>
                Dénomitation de l'IESR <br/>
                ---------<br/>
                Dénomitation de l'établissement (UFR, Institut) <br/>
                --------------- <br/>
                Adresses (BP, téléphone, Email officielle, Site web)
            </div>
        </div>
        
        <!-- LOGO DE L'INSTITUTION -->
        <div id="two" class="zone text-center">
            <div> 
                
                <img id="logo" src="{{ $logo }}" alt="logo"> 
            </div>
        </div>

        <!-- TIMBRE DU BURKINA FASO -->

        <div id="three" class="zone text-center">
            <div> 
                BURKINA FASO <br/>
                ------------- <br/>
                Unité-Progrès-Justice
            </div>

        </div>

        <!-- INTITULE DU DOCUMENT -->

        <div id="four" class="zone text-center">
            <div class ="text-center">  
                <h1> ATTESTATION PROVISOIRE DE LICENCE</h1>
            </div>

        </div>
                
        <!-- ANNONE RESPONSABLE -->

        <div id="five" class="zone text-center">

            <div class="row">
                    <p> Le responsable de l'établissement (Directeur académqie ou équivalement de l'UFR), soussigné, </p>
            </div>
        </div>

        <!-- ANNONE IMPETRANT -->

        <div id="six" class="zone text-center">
            <div class ="text-center"> 
                <h3> ATTESTE QUE </h3>
                <h4> Nom (s) et Prénom (s) </h4>
            </div>

        </div>

        <!-- INFORMATIONS DETAILLEES -->

        <div id="seven" class="zone">
            <div class="row">
                <p> 
                            «ne_e» «le_en» «date_naiss» à «lieu_naiss» («pays_naiss») <br/>
                            Matricule ou INE:……………… Sexe : …………………………………………a <br/>
                            acquis les 180 crédits du parcours Licence ……… à l’issue de la session………..… <br/>
                            de l’année académique….. <br/>
                            Domaine : «domaine» <br/>
                            Mention : «mention» <br/>
                            Spécialité : «spécialité» <br/>
                            et a obtenu la moyenne générale de «moyenne_gle» sur 20, côte «côte». 
                </p>
            </div> 

        </div>

        <!-- ANNONE JOUISSANCE -->

        <div id="eight" class="zone">

            <div class="row">
                <p>
                    En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de droit. <br/><br/>
                </p>
            </div>  
        </div>

        <!-- DATE DE CREATION -->

        <div id="nine" class="zone">

            <div class="col-4">
                Fait le .... à ............. <br/><br/><br/>
            </div>
        </div>

        <!-- ELEMENT DE SECURITE (QR CODE) -->

        <div id="ten" class="zone text-center">

            <div class="col-6"> 
                    QR code <br/>
                    <!--{!! QrCode::size(300)->backgroundColor(255,90,0)->generate('RemoteStack') !!} -->
                    <img id="qrcode" src="{{ $qrcode }}" alt="qr code"> 
            </div>
        </div>

        <!-- SIGNATAIRE ET SIGNATURE -->

        <div id="eleven" class="zone text-center">
            <div class="col-6"> 
                <p class="text-center"> <u>Pour le Responsable et par délégation le Directeur académique</u> </p> <br/> <br/>

                <p class="text-center">
                        Signataire et cachet <br/><br/>
                        Prénom(s) et Nom <br/>
                        <u>titre académique et titre honorifique</u> 
                </p>
            </div>

        </div>

        <!-- NOTA BENE -->

        <div id="twelve" class="zone">
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