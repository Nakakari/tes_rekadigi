@include('landing.layouts.header')

{{-- Funntion to get the first sentence of longText --}}
<?php
function first_sentence($content)
{
    $post = strpos($content, '.');
    return substr($content, 0, $post + 1);
}

?>
<section class="page">
    <!-- ***** Page Top Start ***** -->
    <div class="cover" data-image="assets/images/photos/parallax.jpg">
        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Produk</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="active">Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Page Top End ***** -->

    <!-- ***** Page Content Start ***** -->
    <div class="page-bottom pbottom-70">
        <div class="container">
            <div class="row">
                <!-- ***** Aside Start ***** -->
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <aside class="default-aside">
                        <div class="sidebar">
                            <div class="search-widget">
                                <div class="search">
                                    <form method="GET" action="{{url('products/search')}}">
                                        <input type="text" name="search" id="search" value="{{ !empty($search) ? $search:'' }}" placeholder="Cari Produk">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <ul>
                                @foreach ($kategori as $category)
                                <li><a href="{{url('products/kategori/'.$category->nama)}}">{{ $category->nama }} <span>{{$count[$category->id]}}</span></a></li>

                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
                <!-- ***** Aside End ***** -->

                <!-- ***** Content of the news ***** -->
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-list">
                        <div class="row">
                            @foreach ($produk as $value)
                            <!-- berapa jumlah komentar ? -->
                            <?php
                            $jumlah_komentar = 0;
                            foreach ($komentar as $k) {
                                if ($k->id_produk == $value->id) {
                                    $jumlah_komentar += 1;
                                }
                            }
                            ?>

                            <!-- ***** Blog Post Standard Start ***** -->
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="{{ url('/products/' . base64_encode($value->id)) . '/' . $value->nama_produk }}">
                                    <div class="blog-post-thumb">
                                        {{-- Gambar --}}
                                        <div class="img mb-1">
                                            {{-- Get picture which has id_produk from dokumen table --}}
                                            @foreach ($value->get_dokumen as $data)
                                            <?php if ($value->thumbnail != null) {
                                                if ($value->thumbnail == $data->id) { ?>
                                                    <img src="{{ asset('/dokumen/produk/' . $data->nama) }}" alt="">
                                                <?php }
                                            } else { ?>
                                                <img src="{{ asset('/dokumen/produk/' . $data->nama) }}" alt="">
                                            <?php } ?>
                                            @endforeach
                                        </div>

                                        {{-- Nama Produk --}}
                                        <h3 class="text-center">
                                            <a href="{{ url('/products/' . base64_encode($value->id)) . '/' . $value->nama_produk }}">
                                                {{ $value->nama_produk }}
                                            </a>
                                        </h3>
                                        <div class="mb-1" style="font-weight: bold; color: black">
                                            {{ 'Rp ' . number_format($value->harga, 0, ',', '.') }}
                                        </div>
                                        <ul>
                                            <li>
                                                <i class="fa fa-user"></i>
                                                <a href="{{ url('/list-mitra/' . base64_encode($value->get_mitra->id)) . '/' . $value->get_mitra->nama_mitra }}">
                                                    <span style="color: #6F8BA4">
                                                        {{ $value->get_mitra->nama_mitra }}
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <i class="fa fa-map-marker"></i>
                                                {{ ucwords(strtolower($value->get_mitra->get_dis->nama)) }}
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <!-- ***** Blog Post Standard End ***** -->
                            @endforeach
                        </div>
                    </div>

                    <!-- ***** Pagination Start ***** -->
                    <nav>
                        <ul class="pagination justify-content-center">
                            {!! $produk->onEachSide(1)->links() !!}
                        </ul>
                    </nav>
                    <!-- ***** Pagination End ***** -->
                </div>
                <!-- ***** Content of the news ***** -->
            </div>
        </div>
    </div>
    <!-- ***** Page Content End ***** -->
</section>


@include('landing.layouts.footer')