<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VisaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('visas')->insert([
            'intitule' => 'loi n°013-2007/AN du 30 juillet 2007',
            'numero' => '013-2007/AN',
            'dateSignature' => '2007-7-30',
            'texte' => 'Vu la loi n° 013-2007/AN du 30 juillet 2007 portant loi d’orientation de l’éducation ;',

        ]);

        DB::table('visas')->insert([
            'intitule' => 'loi n° 038-2013/AN du 26 novembre 2013',
            'numero' => '038-2013/AN',
            'dateSignature' => '2013-11-26',
            'texte' => "Vu la loi n° 038-2013/AN du 26 novembre 2013 portant loi d'orientation de la recherche scientifique et de l'innovation ;",

        ]);

        DB::table('visas')->insert([
            'intitule' => 'décret n°2018-1271/PRES/PM/MESRSI/MINEFID du 31 décembre 2018',
            'numero' => '2018-1271/PRES/PM/MESRSI/MINEFID',
            'dateSignature' => '2018-12-31',
            'texte' => "Vu le décret n°2018-1271/PRES/PM/MESRSI/MINEFID du 31 décembre 2018 portant organisation de l’Enseignement Supérieur ;",

        ]);

        DB::table('visas')->insert([
            'intitule' => 'décret 2021-0265/PRE/PM/MINEFID/MESRSI/MFPTS du 20 avril 2021',
            'numero' => '2021-0265/PRE/PM/MINEFID/MESRSI/MFPTS',
            'dateSignature' => '2021-4-20',
            'texte' => "Vu le décret 2021-0265/PRE/PM/MINEFID/MESRSI/MFPTS du 20 avril 2021 portant universitarisation d’offres de formation dans les Ecoles et Centres de Formation Professionnelle de l’Etat (ECFPE) ;",

        ]);

        DB::table('visas')->insert([
            'intitule' => 'arrêté nº2019-073/MESRSI/SG/DGESup du 25 février 2019',
            'numero' => '2019-073/MESRSI/SG/DGESup',
            'dateSignature' => '2019-2-25',
            'texte' => "Vu l’arrêté nº2019-073/MESRSI/SG/DGESup du 25 février 2019 portant régime général des études du diplôme de Licence dans les institutions publiques et privées d’enseignement supérieur et de recherche ;",

        ]);
        
    }
}
