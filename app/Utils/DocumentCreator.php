<?php

namespace App\Utils ;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use File;


class DocumentCreator 
{

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

    public function createAttestationProvisoire($institution, $timbre, $parcours, $impetrant, $signataire, $document, $resultat) {

        $categorie = "provisoire";
        
        $logo = $this->getLogoBase64($institution);
        $lien = config('app.url').'/authentification/details/'.$categorie."/".$document->id;
        $qr_infos = $document->intitule."\nRef :".$document->reference."\n \n ".$lien ;
        $qrcode = $this->createQrcode($qr_infos, $document->reference);
       
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadView('maquettes.licences.provisoire1', 
                        compact('institution', 'timbre', 'parcours', 'impetrant', 'signataire', 'document', 'resultat', 'logo', 'qrcode'));
        
        // set the PDF rendering options
        //$customPaper = array(0,0,600.00,310.80);
        $pdf->setPaper('A4', 'portrait');
        $pdf->output();

        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $canvas->set_opacity(.2,"Multiply");
        $canvas->set_opacity(.2);
        $canvas->page_text($width/5, $height/2, 'ATTESTATION PROVISOIRE', null, 30, array(0,0,0),2,2,-30);
        $filename = config("custom.url_document").'/'.$document->reference.'.pdf';
        file_put_contents(public_path($filename), $pdf->output());
        $document->nombreGeneration ++;
        $document->update();
        return $filename;
        
    }

    public function createAttestationDefinitive($institution, $timbre, $parcours, $impetrant, $signataire, $document, $resultat) {

        $categorie = "provisoire";
        
        $logo = $this->getLogoBase64($institution);
        $lien = "http://192.168.135.81:8081/authentification/details/".$categorie."/".$document->id;
        $qr_infos = $document->intitule."\nRef :".$document->reference."\n \n ".$lien ;
        $qrcode = $this->createQrcode($qr_infos, $document->reference);
       
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadView('maquettes.licences.definitive1', 
                        compact('institution', 'timbre', 'parcours', 'impetrant', 'signataire', 'document', 'resultat', 'logo', 'qrcode'));
        
        // set the PDF rendering options
        //$customPaper = array(0,0,600.00,310.80);
        $pdf->setPaper('A4', 'landscape');
        $pdf->output();

        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $canvas->set_opacity(.2,"Multiply");
        $canvas->set_opacity(.2);
        $canvas->page_text($width/3, $height/2, 'ATTESTATION DEFINITIVE', null, 20, array(0,0,0),2,2,-30);
        $filename = config("custom.url_document").'/'.$document->reference.'.pdf';
        file_put_contents(public_path($filename), $pdf->output());
        $document->nombreGeneration ++;
        $document->update();
        return $filename;
        
    }


}