<?php

namespace App\Http\Controllers\Metiers\Authentification;

use App\Http\Controllers\Controller;
use App\Repositories\AttestationDefinitiveRepository;
//use App\Repositories\AttestationProvisoireRepository;
use App\Repositories\DiplomeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use File;


class VerificationController extends Controller
{
    //private $attestationProvisoireRepository ;
    private $attestationDefinitiveRepository ;
    private $diplomeRepository ;

    public function __construct(
        //AttestationProvisoireRepository $attestationProRepo, 
        AttestationDefinitiveRepository $attestationDefRepo, 
        DiplomeRepository $diplomeRepo
        )
    {
        //$this->attestationProvisoireRepository = $attestationProRepo;
        $this->attestationDefinitiveRepository = $attestationDefRepo;
        $this->diplomeRepository = $diplomeRepo;
        
    }

    /**
     * Affichage page de recherche et résultat de recherche
     */

    public function index(){

        return view('metiers.authentification.recherche');
    }

    public function rechercher(Request $request){
        $input = $request->all();
        $reference = $input['reference'];
        $categorie = $input['categorie'];
        $document =null;
        if ($categorie === "provisoire") {
            $document  = $this->attestationProvisoireRepository->findByReference($reference);
        }
        else if($categorie === "definitive"){
            $document = $this->attestationDefinitiveRepository->findByReference($reference);
        }
        else if($categorie === "diplome"){
            $document = $this->diplomeRepository->findByReference($reference);
        }
        else {

        }
        if(empty($document)){
            $message = "Aucun document trouvé !";
            return view('metiers.authentification.recherche', compact('message'));
        }

        return view('metiers.authentification.recherche', compact('categorie', 'document'));
    }
    /**
     * Visualiser après la recherche
     */

    public function visualiser(Request $request, $categorie, $id){
        $document =null;
        if( $categorie ==="provisoire"){
            $document = $this->attestationProvisoireRepository->find($id);
        }
        elseif( $categorie ==="definitive" ){
            $document = $this->attestationDefinitiveRepository->find($id);
        }
        elseif( $categorie ==="diplome" ){
            $document = $this->diplomeRepository->find($id);
        }        
        //$document = $this->attestationProvisoireRepository->find($id);
        
        if ($request->ajax()) {
            $data = [];
            if(empty($document)){
                $data = "Nothing";
                //return response()->json(['result' =>$data]);
            }
            else {
                $data = [
                    'reference' => $document->reference,
                    'intitule' => $document->intitule,
                    'impetrant' => $document->resultat_academique->impetrant->identifiant."\n ".$document->resultat_academique->impetrant->nom. " ".$document->resultat_academique->impetrant->prenom,
                    'parcours' => $document->resultat_academique->parcours->intitule. " (".$document->resultat_academique->parcours->institution->sigle .")",
                    'niveau' => $document->resultat_academique->parcours->niveau_etude->intitule,
                    'institution' => $document->resultat_academique->parcours->institution->denomination,
                    'sessionr' => "Année académique : ". $document->resultat_academique->annee_academique->intitule
                        ."\n Session : ".$document->resultat_academique->session. 
                        "\n Moyenne : ".$document->resultat_academique->moyenne.
                        "\n Côte :".$document->resultat_academique->cote, 
                    'id' => $document->id,
                ];
            
        }
        return response()->json(['result' =>$data]);
            
        }
        
        else{
            return view('metiers.authentification.show', compact('document', 'categorie')) ;
        }
    }

    /**
     * Afficher les informations détaillées d'une attestation provisoire
     **/
    public function detailsDocument($categorie, $id)
    {
        $document =null;
        if( $categorie ==="provisoire"){
            $document = $this->attestationProvisoireRepository->find($id);
        }
        elseif( $categorie ==="definitive" ){
            $document = $this->attestationDefinitiveRepository->find($id);
        }
        elseif( $categorie ==="diplome" ){
            $document = $this->diplomeRepository->find($id);
        }      
        //$attestation = $this->attestationRepository->find($id);
        
        $institution = $document->signataire->institution;
        $timbre = $institution->timbre ;
        $impetrant = $document->resultat_academique->impetrant;
        $parcours = $document->resultat_academique->parcours;
        $resultat = $document->resultat_academique ;
        $signataire = $document->signataire;
        $path = 'img/logo_unz.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
        

        $path = 'img/qrcode/' ;


        if(!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path));
        }

        $file_path = $path . $document->reference. '.png';
        $lien = "http://192.168.135.81:8081/authentification/view/provisoire/".$id;
        
        $qr_infos = $document->intitule."\nRef :".$document->reference."\n \n ".$lien ;
        QrCode::generate($qr_infos, public_path($file_path) );
        $type = pathinfo($file_path, PATHINFO_EXTENSION);
        $image = file_get_contents($file_path);

        $qrcode = 'data:image/' . $type . ';base64,' . base64_encode($image);  
        
        return view('maquettes.licences.provisoire', compact('institution', 'timbre', 'parcours', 'impetrant', 'signataire', 'document', 'resultat', 'logo', 'qrcode'));
    }




    public function viewpdf($reference){
        $document_path = config("custom.url_document").'/'.$reference.'.pdf';

        return Response::make(file_get_contents(public_path($document_path)), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$reference.'"'
            ]);


    }

    public function pdfDocument($categorie, $id)
    {
        $document =null;
        if( $categorie ==="provisoire"){
            $document = $this->attestationProvisoireRepository->find($id);
        }
        elseif( $categorie ==="definitive" ){
            $document = $this->attestationDefinitiveRepository->find($id);
        }
        elseif( $categorie ==="diplome" ){
            $document = $this->diplomeRepository->find($id);
        }  

        $document = $this->attestationProvisoireRepository->find($id);
        $attestation= $document;
        $institution = $document->signataire->institution;
        $timbre = $institution->timbre ;
        $impetrant = $document->resultat_academique->impetrant;
        $parcours = $document->resultat_academique->parcours;
        $resultat = $document->resultat_academique ;
        $signataire = $document->signataire;
        $path = 'img/logo_unz.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
        

        $path = 'img/qrcode/' ;


        if(!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path));
        }

        $file_path = $path . $document->reference. '.png';
        $lien = "http://192.168.135.81:8081/authentification/view/".$categorie."/".$id;
        $qr_infos = $document->intitule."\nRef :".$document->reference."\n \n ".$lien ;
        QrCode::generate($qr_infos, public_path($file_path) );
        $type = pathinfo($file_path, PATHINFO_EXTENSION);
        $image = file_get_contents($file_path);

        $qrcode = 'data:image/' . $type . ';base64,' . base64_encode($image);
       
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadView('maquettes.licences.provisoire1', compact('institution', 'timbre', 'parcours', 'impetrant', 'signataire', 'attestation', 'resultat', 'logo', 'qrcode'));
        
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
        //$filename = config("custom.document_url").'/'.$document->reference.'.pdf';
        //file_put_contents('filename.pdf', $filename);
        return $pdf->stream(); 
        
        
        //return view('maquettes.licences.provisoire1', compact('institution', 'timbre', 'parcours', 'impetrant', 'signataire', 'attestation', 'resultat', 'logo', 'qrcode'));
    }
}
