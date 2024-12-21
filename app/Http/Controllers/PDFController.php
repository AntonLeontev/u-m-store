<?php

namespace App\Http\Controllers;

use App\Models\Directions;
use App\Models\Partners;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {


        $partner_id = Auth::user()->partner_id;
        if ($partner_id) {
            // Проверка всех данных перед генерацией PDF
            $partner = Partners::find($partner_id);
            if ($partner)
                if ($direction = Directions::find($partner->direction_id)) $direction_partner = $direction->name;
                if ($city = Store::find($partner->store_id)) $city = $city->real_name;
                $contract_number =$direction->last_contract_number+1;
                $contract_number_abbreviation = $direction->abbreviation.date('-d.m-'.$contract_number.'/Y');
                $data = [
                    'contract_number' => $contract_number_abbreviation,
                    'date' => $partner->created_at->format('d.m.Y'),
                    'direction' => $direction_partner,
                    'city' => $city,
                    'org_full_name' => $partner->org_full_name,
                    'org_short_name' => $partner->partner_name,
                    'legal_address' => $partner->legal_address,
                    'inn' => $partner->inn,
                    'ogrn' => $partner->ogrn,
                    'ogrn_ip' => $partner->ogrn_ip,
                    'bank_name' => $partner->bank_name,
                    'bank_account' => $partner->bank_account,
                    'kor_account' => $partner->kor_account,
                    'bik' => $partner->bik,
                    'email' => $partner->email,
                    'mobile_tel_owner' => $partner->mobile_tel_owner,
                    'telephone' => $partner->telephone,
                    'markup' => $partner->markup,
                ];

//            $data = [
//                'city_name' => 'Москва',
//                'date' => date('d.m.Y'),
//
//            ];


            if ($partner_type = $partner->partner_type) {
                switch ($partner_type) {
                    case 'ООО':
                        $pdf = PDF::loadView('livewire.contract-templates.o-o-o-contract-component2', $data);
                        break;
                    case 'ИП':
                        $pdf = PDF::loadView('livewire.contract-templates.ip-contract-component', $data);
                        break;
                    case 'Самозанятый':

                        break;
                    default:
                        return;
                }
                return $pdf->download('Договор_партнерство_' . $partner_type . '.pdf');
            }

        }


//


    }
}
