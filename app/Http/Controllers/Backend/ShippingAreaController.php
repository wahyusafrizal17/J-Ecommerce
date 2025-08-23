<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\ShippingArea;
use Carbon\Carbon;
use GuzzleHttp\Client;

class ShippingAreaController extends Controller
{
    public function viewShipping()
    {
        $provinces = Province::all();
        $area = ShippingArea::with(['province', 'regency', 'district', 'village'])->latest()->get();

        return view('admin.shipping.view_shipping', compact('provinces', 'area'));
    }

    public function getRegency(Request $request)
    {
        $id_province = $request->id_province;
        $regencies = Regency::where('province_id', $id_province)->get();

        $option = '<option value="" disabled selected>Pilih Kota/Kabupaten</option>';
        foreach ($regencies as $regency) {
            $option .= "<option value='{$regency->id}'>{$regency->name}</option>";
        }
        return response()->json($option);
    }

    public function getDistrict(Request $request)
    {
        $id_regency = $request->id_regency;
        $districts = District::where('regency_id', $id_regency)->get();

        $option = '<option value="" disabled selected>Pilih Kecamatan</option>';
        foreach ($districts as $district) {
            $option .= "<option value='{$district->id}'>{$district->name}</option>";
        }
        return response()->json($option);
    }

    public function getVillage(Request $request)
    {
        $id_district = $request->id_district;
        $villages = Village::where('district_id', $id_district)->get();

        $option = '<option value="" disabled selected>Pilih Kelurahan/Desa</option>';
        foreach ($villages as $village) {
            $option .= "<option value='{$village->id}'>{$village->name}</option>";
        }
        return response()->json($option);
    }

   public function cekOngkir(Request $request)
    {
        $client = new Client();
        try {
            $response = $client->post('https://api.rajaongkir.com/starter/cost', [
                'headers' => [
                    'key' => env('RAJAONGKIR_API_KEY'),
                    'content-type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'origin' => $request->origin,
                    'destination' => $request->destination,
                    'weight' => $request->weight,
                    'courier' => $request->courier,
                ],
            ]);
            $result = json_decode($response->getBody(), true);
            return response()->json([
                'status' => true,
                'data' => $result['rajaongkir']['results'][0]['costs'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
