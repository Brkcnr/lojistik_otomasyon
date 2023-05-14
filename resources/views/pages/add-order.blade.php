@extends('layouts.layout')
@section('content')
    <form action="{{ route('form.add-order') }}" method="POST">
        @csrf
        <div class="flex flex-col justify-center items-center min-h-screen">
            <h1 class="font-bold text-[40px]">Sipariş Ekle</h1>
            <div class="border py-10 px-20 rounded-lg mt-5 bg-[#F1F1F1] shadow-md">
                <div class="flex gap-10">
                    <div>
                        <p class="font-semibold">Müşteri İsmi</p>
                        <select name="customerCode" id="customerCode"
                            class="mb-4 border focus:outline-none rounded-lg mt-2 px-2 py-1">
                            <option>Müşteri seçiniz</option>
                            @foreach ($data['users'] as $item)
                                <option value="{{ $item->id }}">{{ $item->isim_soyisim }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <p class="font-semibold">Ürün İsmi</p>
                        <select name="itemCode" id="itemCode"
                            class="mb-4 border focus:outline-none rounded-lg mt-2 px-2 py-1">
                            <option>Ürün seçiniz</option>
                            @foreach ($data['items'] as $item)
                                <option value="{{ $item->urun_kodu }}">{{ $item->urun_adi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="w-full flex justify-center">
                    <button type="submit" class="px-8 py-2 border rounded-xl bg-[#ffd617] mt-6">Ekle</button>
                </div>
            </div>
        </div>
    </form>
@endsection
