@extends('layouts.layout')
@section('content')
    <div class="flex justify-center pt-[120px]">
        <div class="border rounded-lg py-5 px-8 mt-10">
            <p class="text-center">Müşteri Id'si girin</p>
            <input type="text" class="border focus:outline-none mt-4 py-2 px-3 rounded-lg" placeholder="..."
                id="customerIdInput">
        </div>
    </div>
    <div class="flex justify-center mt-10">
        <div class="border border-[#000] rounded-lg overflow-hidden shadow-md mb-10">
            <table>
                <thead>
                    <tr class="border-b border-[#000]">
                        <th class="py-3 px-4 text-center border-r border-[#000]">Müşteri Id</th>
                        <th class="py-3 px-4 text-center border-r border-[#000]">Müşteri Adı</th>
                        <th class="py-3 px-4 text-center border-r border-[#000]">Ürün Kodu</th>
                        <th class="py-3 px-4 text-center border-r border-[#000]">Ürün Adı</th>
                        <th class="py-3 px-4 text-center">Teslim Tarihi</th>
                    </tr>
                </thead>
                <tbody id="ordersTable">
                    @for ($i = 0; $i < count($orders); $i++)
                        @if ($i % 2 == 0)
                            <tr class="border-b border-[#000] bg-[#b3b3b3]">
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->musteri_id }}
                                </td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->musteri_adi }}
                                </td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->urun_kodu }}
                                </td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->urun_adi }}
                                </td>
                                <td class="py-3 px-4 text-center">{{ $orders[$i]->tarih }}</td>
                            </tr>
                        @else
                            <tr class="border-b border-[#000]">
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->musteri_id }}
                                </td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->musteri_adi }}
                                </td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->urun_kodu }}
                                </td>
                                <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->urun_adi }}
                                </td>
                                <td class="py-3 px-4 text-center">{{ $orders[$i]->tarih }}</td>
                            </tr>
                        @endif
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $('#customerIdInput').on('keyup', () => {
            let inputVal = $('#customerIdInput').val()
            if (inputVal != '') {
                let orders = {!! json_encode($orders) !!}
                let i = 0;
                $('#ordersTable').html(``)
                orders.forEach(element => {
                    if (inputVal == element.musteri_id) {
                        if (i % 2 == 0) {
                            $('#ordersTable').append(`
                                <tr class="border-b border-[#000] bg-[#b3b3b3]">
                                    <td class="py-3 px-4 text-center border-r border-[#000]">${element.musteri_id}
                                    </td>
                                    <td class="py-3 px-4 text-center border-r border-[#000]">${element.musteri_adi}
                                    </td>
                                    <td class="py-3 px-4 text-center border-r border-[#000]">${element.urun_kodu}
                                    </td>
                                    <td class="py-3 px-4 text-center border-r border-[#000]">${element.urun_adi}
                                    </td>
                                    <td class="py-3 px-4 text-center">${element.tarih}</td>
                                </tr>
                            `)
                        } else {
                            $('#ordersTable').append(`
                                <tr class="border-b border-[#000] bg-[#fff]">
                                    <td class="py-3 px-4 text-center border-r border-[#000]">${element.musteri_id}
                                    </td>
                                    <td class="py-3 px-4 text-center border-r border-[#000]">${element.musteri_adi}
                                    </td>
                                    <td class="py-3 px-4 text-center border-r border-[#000]">${element.urun_kodu}
                                    </td>
                                    <td class="py-3 px-4 text-center border-r border-[#000]">${element.urun_adi}
                                    </td>
                                    <td class="py-3 px-4 text-center">${element.tarih}</td>
                                </tr>
                            `)
                        }
                    }
                    i += 1;
                });
            } else {
                $('#ordersTable').html(`
                @for ($i = 0; $i < count($orders); $i++)
                    @if ($i % 2 == 0)
                        <tr class="border-b border-[#000] bg-[#b3b3b3]">
                            <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->musteri_id }}
                            </td>
                            <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->musteri_adi }}
                            </td>
                            <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->urun_kodu }}
                            </td>
                            <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->urun_adi }}
                            </td>
                            <td class="py-3 px-4 text-center">{{ $orders[$i]->tarih }}</td>
                        </tr>
                    @else
                        <tr class="border-b border-[#000]">
                            <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->musteri_id }}
                            </td>
                            <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->musteri_adi }}
                            </td>
                            <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->urun_kodu }}
                            </td>
                            <td class="py-3 px-4 text-center border-r border-[#000]">{{ $orders[$i]->urun_adi }}
                            </td>
                            <td class="py-3 px-4 text-center">{{ $orders[$i]->tarih }}</td>
                        </tr>
                    @endif
                @endfor
            `)
            }
        })
    </script>
@endsection
