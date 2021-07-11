<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/tailwind.css') }}">
</head>

<body>
    <!-- main -->
    <div class="main m-auto h-screen p-4">
        <div id="myModal" class="modal">
            <div class="modal-content mx-auto">
                <span id="close">&times;</span>
                <p class="isi-modal">List Pesanan</p>
                <?php $total=0;
                ?>
                @foreach ($daftar_pesanan as $item)
                    <?php
                        $subtotal = $item->harga_menu * $item->jumlah_pesan;
                        $total=$total+$subtotal;
                    ?>
                    <div class="cart flex justify-evenly mb-3">
                        <div class='ml-4'>
                            <div class='text-white font-bold '>{{$item->nama_menu}}</div>
                            <div class='text-white text-sm mt-2'> Sub Jumlah : {{$item->jumlah_pesan}}</div>
                            <div class='text-white text-sm'> Sub Total: {{$subtotal}}</div>
                        </div>              
                        <div class=' flex flex-col justify-around' >
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ url('/Tamu/'.$a[0]->no_meja.'/Detail_Pesanan/Delete/'.$item->id_detail) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class='hapus text-white mt-1' type="submit">x</button>
                            </form>
                        </div>
                    </div>
                    
                @endforeach
                <div class="total text-sm"> Rp.{{$total}}</div>
            </div>

        </div>
        <div class="flex flex-col">
            <!-- header -->
            <div class="header flex justify-between">
                <div class="icon">
                    <img src="{{ asset('asset/img/coffee 2.png') }}" alt="">
                </div>
                <div class="keranjang flex" id="keranjang">
                    <img src="{{ asset('asset/img/cart-add 1.svg') }}" alt="" height="15" width="15" class="mr-1">
                    Keranjang
                </div>
            </div>
             <!-- item -->
             <div class="item-main flex justify-between">
                <div class="text mt-5">
                    <div class="text-1 font-bold">Hayyu Coffe</div>
                    <div class="text-2">Punclut Lembang</div>
                </div>
                <div class="img">
                    <img src="{{ asset('asset/img/97f91f634de04058a299 1.png')}}" alt="">
                </div>
            </div>
            <!-- kategori -->
            <div class="kategori ml-4 mt-1">
                Kategori
            </div>
            <!-- pilihan kategori -->
            <div class="item flex justify-between">
                <a href="{{ url('Tamu/'.$a[0]->no_meja.'/Order/Minuman') }}">
                    <div class="kategori-1 flex flex-col items-center">
                        <img src="{{asset('asset/img/coffee 1.svg')}}" alt="">
                            Minuman
                    </div>
                </a>
                <div class="kategori-1 flex flex-col items-center">
                <img src="{{asset('asset/img/restaurant.svg')}}" alt="" class="mt-4">
                    Makanan
                </div>
            </div>
            <div class="kategori ml-4 mt-1">
                Silahkan Pilih Menu
            </div>
            <!-- rekomendasi -->
            <div class="item justify-between overflow-auto h-96">
                <!-- item1 -->
                @foreach ($list_makanan as $item)
                <a href="{{ url('Tamu/'.$a[0]->no_meja.'/Order/detailMenu/'.$item->id_menu) }}">
                <div class="rekomend flex items-center w-full mt-2">
                    <div class="bag-1">
                        <img src="{{ asset('/asset/img/sensasi-ngopi-di-sinia-coffe 1.png') }}" alt="" class="gambar" width="100px">
                    </div>
                    <div class="bag-2 w-full">
                        <span class="font-bold text-white font-4xl">{{ $item->nama_menu }}</span><br>
                        <p class="deskripsi">{{$item->deskripsi}}</p>
                        <div class="flex ">
                            <span class="harga">{{$item->harga_menu}}</span>
                            <div class="waktu flex w-full ">{{$item->waktu_penyajian}} Menit</div>
                            <form action="{{ url('/Tamu/Order/Save')  }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$a[0]->no_meja}}" name="no_meja">
                                <input type="hidden" value="{{$a[0]->id_pemesanan}}" name="id_pemesanan">
                                <input type="hidden" value="{{$item->id_menu}}" name="id_menu">
                                <div class="beli text-sm mt-1 font-bold"> <button type="submit" class="beli">+</button></div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!--  -->
        </div>
    </div>
    
</body>
<script src="{{ asset('asset/js/main.js') }}"></script>

</html>