@extends('layouts.layout')
@section('content')
    <form action="{{ route('form.add-customer') }}" method="POST">
        @csrf
        <div class="flex flex-col justify-center items-center min-h-screen">
            <h1 class="font-bold text-[40px]">Müşteri Ekle</h1>
            <div class="flex border py-10 px-20 rounded-lg gap-10 mt-5 bg-[#F1F1F1] shadow-md">
                <div>
                    <p class="font-semibold">İsim Soy İsim</p>
                    <input name="name" type="text" class="mb-4 border focus:outline-none rounded-lg mt-2 px-2 py-1"
                        placeholder="İsim Soy İsim">
                    <p class="font-semibold">E-mail</p>
                    <input name="mail" type="text" class="mb-4 border focus:outline-none rounded-lg mt-2 px-2 py-1"
                        placeholder="E-mail">
                    <div>
                        <p class="font-semibold">Ülke Kodu</p>
                        <select name="countryCode" id="countryCode"
                            class="mb-4 border focus:outline-none rounded-lg mt-2 px-2 py-1">
                            <option>Ülke Kodunu seçiniz</option>
                            @foreach ($data['ulke_kodu'] as $item)
                                <option value="{{ $item->ulke_kodu }}">{{ $item->ulke_kodu }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <div>
                        <p class="font-semibold">Şehir Kodu</p>
                        <select name="cityCode" id="cityCode" class="mb-4 border focus:outline-none rounded-lg mt-2 px-2 py-1">
                            <option>Şehir Kodunu seçiniz</option>
                        </select>
                    </div>
                    <div>
                        <p class="font-semibold">Posta Kodu</p>
                        <select name="zipCode" id="zipCode" class="mb-4 border focus:outline-none rounded-lg mt-2 px-2 py-1">
                            <option>Posta Kodunu seçiniz</option>
                        </select>
                    </div>
                    <div class="w-full flex justify-center">
                        <button type="submit" class="px-8 py-2 border rounded-xl bg-[#ffd617] mt-6">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('javascript')
    <script>
        let countryCode = $('#countryCode')
        let zipCode = $('#zipCode')
        $(document).ready(function() {
            $("#countryCode").change(function() {
                $('#cityCode').html(`<option>Şehir Kodunu seçiniz</option>`)
                $('#zipCode').html(`<option>Posta Kodunu seçiniz</option>`)
                let countryCodeValue = $(this).val()
                $.ajax({
                    url: `http://localhost:8000/api/sehirler/${countryCodeValue}`,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        res.data.forEach(element => {
                            $('#cityCode').append(
                                `<option value="${element.sehir_kodu}">${element.sehir_kodu}</option>`
                            );
                        });
                    }
                });
            });
        });
        $(document).ready(function() {
            $("#cityCode").change(function() {
                $('#zipCode').html(`<option>Posta Kodunu seçiniz</option>`)
                let cityCodeValue = $(this).val()
                $.ajax({
                    url: `http://localhost:8000/api/posta-kodlari/${cityCodeValue}`,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        res.data.forEach(element => {
                            console.log(res.data);
                            $('#zipCode').append(
                                `<option value="${element.posta_kodu}">${element.posta_kodu}</option>`
                            );
                        });
                    }
                });
            });
        });
    </script>
@endsection
