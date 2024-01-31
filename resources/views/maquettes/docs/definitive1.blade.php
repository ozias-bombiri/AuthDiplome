<!DOCTYPE html>
<html>
<head>
    <title>Title From OnlineWebTutorBlog</title>

    
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
            top: 15px; 
            right: 10px;
            margin-left: 65%;
            
        }
    </style>

</head>
<body>

    <div class="contenu-haut-img">
        <img class="logo" src="{{ (public_path('images/logo-unz.jpeg')) }}" alt="">
    </div>

    
     <div class="contenu-haut-gauche">
        <!-- Votre contenu ici -->
        Dénomination du Ministère <br>
        ----------------<br>
        Dénomination de l’IESR<br>
        ----------------<br>
        Adresses (BP, téléphone, Email officielle,
        Site web)
    </div>

    <div class="contenu-haut-droite">
        <!-- Votre contenu ici -->
        BURKINA FASO<br>
        -----------<br>
        Unité - Progrès - Justice
    </div>

    

    <div class="contenu-haut-titre">
        DIPLOME DE LICENCE
    </div>


    <div class="contenu-visa">
        Vu la loi n° 013-2007/AN du 30 juillet 2007 portant loi d’orientation de l’éducation ;<br>
        Vu la loi n° 038-2013/AN du 26 novembre 2013 portant loi d'orientation de la recherche scientifique et de l’innovation ;<br>
        Vu le décret n°2018-1271/PRES/PM/MESRSI/MINEFID du 31 décembre 2018 portant organisation de l’Enseignement Supérieur ;<br>
        Vu le décret portant création de l’IESR ou l’arrêté d’ouverture pour les IPES ;<br>
        Vu le décret n°………. du …………. portant changement de dénomination de l’IESR ou l’arrêté portant changement de dénomination de l’IPES ;<br>
        Vu le décret 2021-0265/PRE/PM/MINEFID/MESRSI/MFPTS du 20 avril 2021 portant universitarisation d’offres de formation dans les Ecoles et
        Centres de Formation Professionnelle de l’Etat (ECFPE) ;<br>
        Vu la convention Cadre de partenariat entre l’Institution d’Enseignement Supérieur et de Recherche (IESR) et l’Ecole et Centre de Formation
        Professionnelle de l’Etat (ECFPE) ;<br>
        Vu l’arrrêté portant autorisation d’universitariser des offres de formation à (le nom de l’ECFPE) ;
        Vu l’arrêté portant extension de l’IESR ;<br>
        Vu l’arrêté nº2019-073/MESRSI/SG/DGESup du 25 février 2019 portant régime général des études du diplôme de Licence dans les institutions publiques
        et privées d’enseignement supérieur et de recherche ;<br>
        Vu le procès-verbal de délibération du jury d’examen en date du ……………………… …………………………………<br>
    </div>

    <div class="contenu-infos">
        Le diplôme de <strong>LICENCE</strong><br>
        Domaine …………………………………………………………<br>
        Mention…………………………………………………..<br>
        Spécialité………………………………………………………………………..<br>
        est délivré à ………………………………………………………………………………………………………...<br>
        né (e) le ………………………………à ……………………………………………………………………….Sexe …………………….<br>
        matricule ou INE…………..……………………………………………………<br>
        au titre de l’année académique ……………………avec la côte ..................................<br>
        pour en jouir avec les droits et prérogatives qui y sont attachés.<br>
    </div>

    
    <div class="contenu-qrcode">
        <strong>QR CODE</strong>
    </div>
    

    <div class="contenu-titulaire">
        <strong>Le Titulaire</strong>
    </div>

    <div class="contenu-signataire">
        <strong>Le Président/Recteur ou Directeur académique</strong>
    </div>
    

    <div class="contenu-numero-date">
        Enregistré sous le N°<strong>«num_enr»</strong> <br>
            Fait à ………., le ……….
    </div>


</body>
</html>
      