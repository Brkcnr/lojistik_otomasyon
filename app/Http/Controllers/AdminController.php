<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function home()
    {
        $users = DB::table('musteriler')->get()->toArray();
        $pageTitle = 'Ana sayfa';

        return view('pages.home')->with(['users' => $users, 'pageTitle' => $pageTitle]);
    }
    public function orders()
    {
        $orders = DB::table('siparisler')->get()->toArray();
        usort($orders, function ($a, $b) {
            return $a->musteri_id - $b->musteri_id;
        });
        foreach ($orders as $element) {
            $customer = DB::table('musteriler')->where('id', $element->musteri_id)->get();
            $order = DB::table('urunler')->where('urun_kodu', $element->urun_kodu)->get();
            $element->musteri_adi = $customer[0]->isim_soyisim;
            $element->urun_adi = $order[0]->urun_adi;
        }
        $pageTitle = 'Siparişler';

        return view('pages.orders')->with(['orders' => $orders, 'pageTitle' => $pageTitle]);
    }
    public function addCustomer()
    {
        $data['ulke_kodu'] = DB::table('ulkeler')->get()->toArray();
        $data['sehir_kodu'] = DB::table('sehirler')->get()->toArray();
        $data['posta_kodu'] = DB::table('posta')->get()->toArray();
        $pageTitle = 'Müşteri Ekle';

        return view('pages.add-customer')->with(['data' => $data, 'pageTitle' => $pageTitle]);
    }
    public function addCustomerForm(Request $request)
    {
        $name = $request->name;
        $mail = $request->mail;
        $countryCode = $request->countryCode;
        $cityCode = $request->cityCode;
        $zipCode = strval($request->zipCode);

        DB::table('musteriler')->insert([
            'isim_soyisim' => $name,
            'email' => $mail,
            'ulke_kodu' => $countryCode,
            'sehir_kodu' => $cityCode,
            'posta_kodu' => $zipCode
        ]);

        return redirect('/musteri-ekle');
    }
    public function addOrder()
    {
        $pageTitle = 'Sipariş Ekle';

        $data['users'] = DB::table('musteriler')->get()->toArray();
        $data['items'] = DB::table('urunler')->get()->toArray();

        return view('pages.add-order')->with(['data' => $data, 'pageTitle' => $pageTitle]);
    }
    public function addOrderForm(Request $request)
    {
        $customerCode = $request->customerCode;
        $itemCode = $request->itemCode;
        $date = date('Y-m-d');
        $day = intval(substr($date, -2)) + 5;
        $date = substr_replace($date, $day, -2);

        DB::table('siparisler')->insert([
            'musteri_id' => $customerCode,
            'urun_kodu' => $itemCode,
            'tarih' => $date,
        ]);

        return redirect('/siparis-ekle');
    }
    public function getCities(Request $request)
    {
        $ulke_kodu = strval($request->ulkeKodu);

        $cities = DB::table('sehirler')->where('ulke_kodu', $ulke_kodu)->get()->toArray();

        return response()->json([
            "data" => $cities
        ], 200);
    }
    public function getZips(Request $request)
    {
        $sehir_kodu = strval($request->sehirKodu);

        $zips = DB::table('posta')->where('sehir_kodu', $sehir_kodu)->get()->toArray();

        return response()->json([
            "data" => $zips
        ], 200);
    }
    public function orderDelete()
    {
        $orders = DB::table('siparisler')->get()->toArray();
        foreach ($orders as $element) {
            $customer = DB::table('musteriler')->where('id', $element->musteri_id)->get();
            $order = DB::table('urunler')->where('urun_kodu', $element->urun_kodu)->get();
            $element->musteri_adi = $customer[0]->isim_soyisim;
            $element->urun_adi = $order[0]->urun_adi;
        }
        $pageTitle = 'Kargo İptal';

        return view('pages.order-delete')->with(['orders' => $orders, 'pageTitle' => $pageTitle]);
    }
    public function orderDeleteForm(Request $request)
    {
        $customerId = $request->customerId;
        $itemId = $request->itemId;

        DB::table('siparisler')->where('musteri_id', $customerId)->where('urun_kodu', $itemId)->delete();

        return redirect('/kargo-iptal');
    }
}