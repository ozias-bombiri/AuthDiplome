<?php

namespace App\Http\Controllers\Daoi;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstitutionRequest;
use App\Models\Numeroteur;
use App\Repositories\InstitutionRepository;
use App\Repositories\NumeroteurRepository;
use Illuminate\Http\Request;

class EtablissementController extends Controller
{
    protected $institutionRepository ;
    protected $numeroteurRepository;

    public function __construct(InstitutionRepository $institutionRepo, NumeroteurRepository $numeroteurRepo)
    {
        $this->institutionRepository = $institutionRepo;
        $this->numeroteurRepository = $numeroteurRepo;
    }

    /**
     * Lister les etablissements  de l'IESR
     **/
    public function listEtablissement($institution_id)
    {
        //$institution = Auth ::user()->institution;
        $institution = $this->institutionRepository->find($institution_id);
        $etablissements = $this->institutionRepository->findByIesr($institution->id);
        return view('metiers.daoi.list_etablissements', compact('etablissements'));
    }


    /**
     * Enregistrer les information renseignées dans le formularie de création d'établisement  de l'IESR
     **/
    public function storeEtablissement(StoreInstitutionRequest $request)
    {
        $type = 'provisoire';
        $validated = $request->validated();
        $input = $request->all();
        if($request->file()) {
            $file = $request->file('logo');
            $fileName = 'logo_'.str_replace(array('/', '%', '@', '\'', ';', '<', '>' ), '-', $input['sigle']).'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/logos'), $fileName);
            $input['logo'] = $fileName;
        }
        if($input['type'] === 'IESR' || $input['parent_id'] === 'Aucun'){
            $input['parent_id'] = null;
        }
        $etablissement = $this->institutionRepository->create($input);
        $input_numeroteur = [];
        $input_numeroteur['institution_id']= $etablissement->id;
        $input_numeroteur['categorie'] = 'provisoire';
        $input_numeroteur['chaine'] = $etablissement->parent->sigle.'/'.$etablissement->sigle.'/provisoire' ;
        $numeroteur = $this->numeroteurRepository->create($input_numeroteur);
        return redirect(route('metiers.daoi.etablissement-list', $etablissement->parent_id));
    }

    public function viewEtablissement(Request $request, $id)
    {
        $institution = $this->institutionRepository->find($id);
        if ($request->ajax()) {
            $data = [];
            if(empty($institution)){
                $data = "Nothing";
            }
            else {
            $data = [
                'id' => $institution->id,
                'sigle' => $institution->sigle,
                'denomination' => $institution->denomination,
                'type' => $institution->type,
                'contact' => $institution->telephone,
                'adresse' => $institution->adresse,
                'email' => $institution->email,
                'description' => $institution->description,
                'logo' => $institution->logo,
                'siteweb' => $institution->siteWeb,
                
            ];
        }
            return response()->json(['result' =>$data]);
        }
    }

}
