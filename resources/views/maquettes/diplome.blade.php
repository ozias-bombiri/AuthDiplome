<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <style>

        body {
                margin: 0; 
            }
        .mon-conteneur {
            position: absolute;
            top: 50px;
            left: 100px;
        }

        .contenu-haut-droite {
            position: absolute;
            top: 10px; 
            right: 10px; 
        }

        .logo {
            width: 100px; 
            height: auto;
        }

        .contenu-haut-img {
            position: absolute;
            left: 50%; 
            transform: translateX(-50%); 
            
        }

        .contenu-haut-titre {
            position: absolute;
            top: 50px; 
            left: 50%; 
            transform: translateX(-50%);
            text-align: center; 
            margin-top: 70px;
            font-size: 25px;
            font-weight: bold;
        }

        .contenu-visa {    
            left: 100px;
            margin-top: 60px;
            font-size: 13px;
        }

        .contenu-infos {    
            left: 100px;
            margin-top: 15px;
            font-size: 13px;
        }

        .contenu-qrcode {    
            margin-left: 40px;
            margin-top: 80px;
        }

        .contenu-titulaire {
            position: absolute;
            bottom: 10px; 
            left: 10px;
        }

        .contenu-signataire {
            position: absolute;
            bottom: 10px; 
            right: 10px; 
        }

        .contenu-numero-date {    
            margin-top: 10px;
            margin-right: 10px;
            bottom : 50px; 
            right: 10px;
            margin-left: 65%;
            
        }
    </style>

</head>
<body>

    <div class="contenu-haut-img">
        <img class="logo" src="{{ $logo }}" alt="logo">
    </div>

    
     <div class="contenu-haut-gauche">
        <!-- Votre contenu ici -->
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

    <div class="contenu-haut-droite">
        <!-- Votre contenu ici -->
        BURKINA FASO <br />
        ------------- <br />
        Unité-Progrès-Justice
    </div>

    

    <div class="contenu-haut-titre">
        {{ strtoupper($acte->intitule) }}
    </div>


    <div class="contenu-visa">
        @foreach($visas as $visa)
            {{ $visa->visa->texte }} <br/>
        @endforeach
    </div>

    <div class="contenu-infos">
        Le <strong>{{ strtoupper($acte->intitule) }}</strong><br>
        Domaine : <b>{{ $parcours->domaine }}</b> <br />
        Mention : <b>{{ $parcours->mention }} </b><br />
        Spécialité : <b>{{ $parcours->specialite }}</b> <br />
        est délivré à {{ strtoupper($impetrant->nom).' '.$impetrant->prenom }}<br>
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
        à {{ $impetrant->lieuNaissance }} ({{ $impetrant->paysNaissance }}) Sexe {{ $impetrant->sexe }}.<br>
        {{$impetrant->typeIdentifiant }} : <b>{{ $impetrant->identifiant }}</b><br/>
        au titre de l’année académique {{ $resultat->procesVerbal->anneeAcademique->intitule }} avec la côte @if($resultat->moyenne >= 16 ) A @elseif($resultat->moyenne < 16 && $resultat->moyenne >=14) B @elseif($resultat->moyenne < 14 && $resultat->moyenne >=12) C @elseif($resultat->moyenne < 12 && $resultat->moyenne >=10) @endif<br>
        pour en jouir avec les droits et prérogatives qui y sont attachés.<br>
    </div>

    
    <div class="contenu-qrcode">
        <img id="qrcode" src="{{ $qrcode }}" alt="qr code">
    </div>
    

    <div class="contenu-titulaire">
        <strong>Le Titulaire</strong>
    </div>

    <div class="contenu-numero-date">
        Enregistré sous le N°<strong>«num_enr»</strong> <br>
            Fait à {{ $acte->lieu}}, le {{ \Carbon\Carbon::parse($acte->dateSignature)->translatedFormat('d F Y') }}
    </div>

    <div class="contenu-signataire">
        <p class="text-center"> <u> @if($signataireActe->mention) {{$signataireActe->mention}} @endif {{ $signataireActe->fonction }}</u> </p> <br /> <br />

            <p class="text-center">
                <br /><br />
                @if($signataireActe->signataire->grade) {{ $signataireActe->signataire->grade }}@endif
                <b>{{ $signataireActe->signataire->prenom }} {{ $signataireActe->signataire->nom }} </b><br />
                <em>{{ $signataireActe->signataire->titreAcademique }}<br /> {{ $signataireActe->signataire->titreHonorifique }}</em>
            </p>
    </div>

</body>
</html>
      