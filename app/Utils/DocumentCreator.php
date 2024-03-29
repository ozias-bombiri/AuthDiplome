<?php

namespace App\Utils ;

use App\Repositories\DocumentRepository;
use App\Repositories\NumeroteurRepository;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use File;
use Illuminate\Support\Facades\Auth;

class DocumentCreator 
{
    private $documentRepository;
    private $numeroteurRepository;

    public function __construct(DocumentRepository $documentRepo, NumeroteurRepository $numeroteurRepo)
    {
        $this->documentRepository = $documentRepo;
        $this->numeroteurRepository = $numeroteurRepo;
    }

    public function CreateQrcode($qr_infos, $file_name){
        
        $path = config('custom.qrcode_url') ;

        if(!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path));
        }
        $file_path = $path.'/'.$file_name.'.png' ;
        QrCode::generate($qr_infos, public_path($file_path) );
        $type = pathinfo($file_path, PATHINFO_EXTENSION);
        $image = file_get_contents($file_path);
        $qrcode = 'data:image/' . $type . ';base64,' . base64_encode($image);
        return $qrcode;
    }

    public function getLogoBase64($institution){
        $path = config('custom.logo_url') ;

        $file_path = $path.'.'.$institution->logo;

        if(!File::exists(public_path($file_path))) {
            $file_path = 'img/logo_unz.jpg';
        }
        $type = pathinfo($file_path, PATHINFO_EXTENSION);
        $data = file_get_contents($file_path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);        

        return $logo;
    }

    public function genererDocument($institution, $timbre, $parcours, $impetrant, $signataireActe, $acte, $resultat) {
        $user_id = 1;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        }
        
        $categorie = $acte->categorieActe->intitule;
        
        $logo = $this->getLogoBase64($institution);
        $lien = config('app.url').'/authentification/details/'.$categorie."/".$acte->id;
        $qr_infos = "Ref :".$acte->reference."\n\n".$acte->intitule."\n ".strtoupper($impetrant->nom. ' '.$impetrant->prenom)."\n \n ".$lien ;
        $qrcode = $this->createQrcode($qr_infos, $acte->reference);
       
        $maquette = "";
        $orientation = 'portrait';
        if($categorie === "PROVISOIRE"){
            $maquette = "maquettes.provisoire";
            $orientation = 'portrait';        
        }
        else if($categorie === "DEFINITIVE"){
            $maquette = "maquettes.defintive";
            $orientation = 'landscape';
        }
        else if($categorie === "DIPLOME"){
            $maquette = "maquettes.diplome";
            $orientation = 'landscape';
        }
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadView($maquette, 
                        compact('institution', 'timbre', 'parcours', 'impetrant', 'signataireActe', 'acte', 'resultat', 'logo', 'qrcode'));
        
        $pdf->setPaper('A4', $orientation);
        $pdf->output();

        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $canvas->set_opacity(.2,"Multiply");
        $canvas->set_opacity(.2);
        $canvas->page_text($width/5, $height/2, $categorie, null, 30, array(0,0,0),2,2,-30);
        $filename = config("custom.url_document").'/'.$acte->reference.'.pdf';
        file_put_contents(public_path($filename), $pdf->output());
        $document_data = [];
        $document_data['acteAcademique_id'] = $acte->id;
        $document_data['user_id'] = $user_id;
        $document_data['reference'] = $acte->reference;
        $document_data['numero'] = $acte->numero;
        $document_data['nombreGeneration'] =1;
        $document_data['dateGeneration'] = date('Y-m-d');
        $document = $this->documentRepository->create($document_data);
        return $filename;
        
    }


    public function createAttestationProvisoire($institution, $timbre, $parcours, $impetrant, $signataireActe, $acte, $resultat) {
        $user_id = 1;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        }
        
        $categorie = $acte->categorieActe->intitule;
        
        $logo = $this->getLogoBase64($institution);
        $lien = config('app.url').'/authentification/details/'.$categorie."/".$acte->id;
        $qr_infos = "Ref :".$acte->reference."\n\n".$acte->intitule."\n ".strtoupper($impetrant->nom. ' '.$impetrant->prenom)."\n \n ".$lien ;
        $qrcode = $this->createQrcode($qr_infos, $acte->reference);
       
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadView('maquettes.provisoire1', 
                        compact('institution', 'timbre', 'parcours', 'impetrant', 'signataireActe', 'acte', 'resultat', 'logo', 'qrcode'));
        
        // set the PDF rendering options
        //$customPaper = array(0,0,600.00,310.80);
        $pdf->setPaper('A4', 'portrait');
        $pdf->output();

        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $canvas->set_opacity(.2,"Multiply");
        $canvas->set_opacity(.2);
        $canvas->page_text($width/5, $height/2, $categorie, null, 30, array(0,0,0),2,2,-30);
        $filename = config("custom.url_document").'/'.$acte->reference.'.pdf';
        file_put_contents(public_path($filename), $pdf->output());
        $document_data = [];
        $document_data['acteAcademique_id'] = $acte->id;
        $document_data['user_id'] = $user_id;
        $document_data['reference'] = $acte->reference;
        $document_data['numero'] = $acte->numero;
        $document_data['nombreGeneration'] =1;
        $document_data['dateGeneration'] = date('Y-m-d');
        $document = $this->documentRepository->create($document_data);
        return $filename;
        
    }

    public function createAttestationDefinitive($institution, $timbre, $parcours, $impetrant, $signataireActe, $acte, $resultat) {

        $user_id = 1;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        }
        
        $categorie = $acte->categorieActe->intitule;
        $numeroteur = $this->numeroteurRepository->findByInstitutionAndCategorie($institution->id, $acte->categorieActe->id);
        
        $logo = $this->getLogoBase64($institution);
        $lien = "http://192.168.135.81:8081/authentification/details/".$categorie."/".$acte->id;
        $qr_infos = "Ref :".$acte->reference."\n\n".$acte->intitule."\n ".strtoupper($impetrant->nom. ' '.$impetrant->prenom)."\n \n ".$lien ;
        $qrcode = $this->createQrcode($qr_infos, $acte->reference);
       
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadView('maquettes.definitive1', 
                        compact('institution', 'timbre', 'numeroteur', 'parcours', 'impetrant', 'signataireActe', 'acte', 'resultat', 'logo', 'qrcode'));
        
        // set the PDF rendering options
        //$customPaper = array(0,0,600.00,310.80);
        $pdf->setPaper('A4', 'landscape');
        $pdf->output();

        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $canvas->set_opacity(.2,"Multiply");
        $canvas->set_opacity(.2);
        $canvas->page_text($width/5, $height/2, $categorie, null, 30, array(0,0,0),2,2,-30);
        $filename = config("custom.url_document").'/'.$acte->reference.'.pdf';
        file_put_contents(public_path($filename), $pdf->output());
        $document_data = [];
        $document_data['acteAcademique_id'] = $acte->id;
        $document_data['user_id'] = $user_id;
        $document_data['reference'] = $acte->reference;
        $document_data['numero'] = $acte->numero;
        $document_data['nombreGeneration'] =1;
        $document_data['dateGeneration'] = date('Y-m-d');
        $document = $this->documentRepository->create($document_data);
        return $filename;      
        
        
    }

    public function createDiplome($institution, $timbre, $parcours, $impetrant, $signataireActe, $acte, $resultat) {

        $user_id = Auth::user()->id;        
        
        $categorie = $acte->categorieActe->intitule;
        
        $logo = $this->getLogoBase64($institution);
        $lien = "http://192.168.135.81:8081/authentification/details/".$categorie."/".$acte->id;
        $qr_infos = "Ref :".$acte->reference."\n\n".$acte->intitule."\n ".strtoupper($impetrant->nom. ' '.$impetrant->prenom)."\n \n ".$lien ;
        $qrcode = $this->createQrcode($qr_infos, $acte->reference);

        $visas = $institution->visaInstitutions[0]->visaDiplomes;
       
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadView('maquettes.diplome', 
                        compact('institution', 'timbre', 'parcours', 'impetrant', 'signataireActe', 'acte', 'resultat', 'logo', 'qrcode', 'visas'));
        
        // set the PDF rendering options
        //$customPaper = array(0,0,600.00,310.80);
        $pdf->setPaper('A4', 'landscape');
        $pdf->output();

        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $canvas->set_opacity(.2,"Multiply");
        $canvas->set_opacity(.2);
        $canvas->page_text($width/5, $height/2, $categorie, null, 30, array(0,0,0),2,2,-30);
        $filename = config("custom.url_document").'/'.$acte->reference.'.pdf';
        file_put_contents(public_path($filename), $pdf->output());
        $document_data = [];
        $document_data['acteAcademique_id'] = $acte->id;
        $document_data['user_id'] = $user_id;
        $document_data['reference'] = $acte->reference;
        $document_data['numero'] = $acte->numero;
        $document_data['nombreGeneration'] =1;
        $document_data['dateGeneration'] = date('Y-m-d');
        $document = $this->documentRepository->create($document_data);
        return $filename;      
        
        
    }


}