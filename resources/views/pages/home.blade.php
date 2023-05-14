@extends('layouts.layout')
@section('content')
    <h1 class="text-center w-full font-bold text-[40px] pt-[120px]">Müşteriler</h1>
    <div class="flex justify-center mt-10">
        <div class="border border-[#000] rounded-lg overflow-hidden shadow-md mb-10">
            <table>
                <thead>
                    <tr class="border-b border-[#000]">
                        <th class="py-3 px-4 text-center border-r border-[#000]">id</th>
                        <th class="py-3 px-4 text-center border-r border-[#000]">İsim Soy isim</th>
                        <th class="py-3 px-4 text-center border-r border-[#000]">E-mail</th>
                        <th class="py-3 px-4 text-center border-r border-[#000]">Ülke Kodu</th>
                        <th class="py-3 px-4 text-center border-r border-[#000]">Şehir Kodu</th>
                        <th class="py-3 px-4 text-center">Posta Kodu</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($users); $i++)
                        @if ($i % 2 == 0)
                            <tr class="border-b border-[#000] bg-[#b3b3b3]">
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $users[$i]->id }}</td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $users[$i]->isim_soyisim }}</td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $users[$i]->email }}</td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $users[$i]->ulke_kodu }}</td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $users[$i]->sehir_kodu }}</td>
                                <td class="py-3 px-4 text-center">{{ $users[$i]->posta_kodu }}</td>
                            </tr>
                        @else
                            <tr class="border-b border-[#000]">
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $users[$i]->id }}</td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $users[$i]->isim_soyisim }}</td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $users[$i]->email }}</td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $users[$i]->ulke_kodu }}</td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $users[$i]->sehir_kodu }}</td>
                                <td class="py-3 px-4 text-center">{{ $users[$i]->posta_kodu }}</td>
                            </tr>
                        @endif
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection
