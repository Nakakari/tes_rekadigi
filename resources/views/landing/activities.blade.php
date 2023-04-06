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
                        <h1>Kegiatan</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="active">Kegiatan</li>
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
                                    <form method="GET" action="{{url('activities/search')}}">
                                        <input type="text" name="search" id="search" value="{{ !empty($search) ? $search:'' }}" placeholder="Cari Kegiatan">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <ul>
                                @foreach ($kategori as $category)
                                <li><a href="{{url('activities/kategori/'.$category->nama)}}">{{ $category->nama }} <span>{{$count[$category->id]}}</span></a></li>
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
                            @foreach ($kegiatan as $data)
                            <!-- berapa jumlah komentar ? -->
                            <?php
                            $jumlah_komentar = 0;
                            foreach ($komentar as $k) {
                                if ($k->id_kegiatan == $data->id) {
                                    $jumlah_komentar += 1;
                                }
                            }
                            ?>

                            <!-- ***** Blog Post Standard Start ***** -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="blog-post-thumb">
                                    <div class="img">
                                        {{-- Get picture which has id_kegiatan from dokumen table --}}
                                        @foreach ($data->get_dokumen as $dok)
                                        <img src="{{ asset('/dokumen/kegiatan/' . $dok->nama) }}" alt="">
                                        @endforeach
                                        <div class="date">
                                            <strong>{{ date('M', strtotime($data->created_at)) }}</strong>
                                            <span>{{ date('d', strtotime($data->created_at)) }}</span>
                                        </div>
                                    </div>
                                    <ul class="post-meta">
                                        {{-- Get name user who created the data from users table --}}
                                        <li>
                                            <a href="#"><span class="icon fa fa-user"></span>by
                                                {{ $data->get_user->name }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="icon fa fa-comment-o"></span>{{$jumlah_komentar}}
                                                Comments
                                            </a>
                                        </li>
                                    </ul>

                                    <h3>
                                        <a href="{{ url('/activities/' . base64_encode($data->id)) . '/' . $data->judul }}">
                                            {{ $data->judul }}
                                        </a>
                                    </h3>

                                    <div class="text">
                                        {{ strip_tags(first_sentence($data->deskripsi)) }}
                                    </div>
                                    <a href="{{ url('/activities/' . base64_encode($data->id)) . '/' . $data->judul }}" class="btn-primary-line">Read More</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- ***** Blog Post Standard End ***** -->
                    </div>
                </div>

                <!-- ***** Pagination Start ***** -->
                <nav>
                    <ul class="pagination justify-content-center">
                        {!! $kegiatan->onEachSide(1)->links() !!}
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