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
                        <h1>Berita</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="active">Berita</li>
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
                                    <form method="GET" action="{{url('news/search')}}">
                                        <input type="text" name="search" id="search" value="{{ !empty($search) ? $search:'' }}" placeholder="Cari Berita">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <ul>
                                @foreach ($kategori as $category)
                                <li><a href="{{url('news/kategori/'.$category->nama)}}">{{ $category->nama }} <span>
                                            {{$count[$category->id]}}
                                        </span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
                <!-- ***** Aside End ***** -->

                <!-- ***** Content of the news ***** -->
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-list">
                        <div class="row" id="listberita">
                            @foreach ($berita as $news)
                            <!-- berapa jumlah komentar ? -->
                            <?php
                            $jumlah_komentar = 0;
                            foreach ($komentar as $k) {
                                if ($k->id_berita == $news->id) {
                                    $jumlah_komentar += 1;
                                }
                            }
                            ?>

                            <!-- ***** Blog Post Standard Start ***** -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="blog-post-thumb">
                                    <div class="img">
                                        {{-- Get picture which has id_berita from dokumen table --}}
                                        @foreach ($news->get_dokumen as $data)
                                        <img src="{{ asset('/dokumen/berita/' . $data->nama) }}" alt="" style="opacity: 1;">
                                        @endforeach

                                        <div class="date">
                                            <strong>{{ date('M', strtotime($news->created_at)) }}</strong>
                                            <span>{{ date('d', strtotime($news->created_at)) }}</span>
                                        </div>
                                    </div>
                                    <ul class="post-meta">
                                        {{-- Get name user who created the data from users table --}}
                                        <li>
                                            <a href="#"><span class="icon fa fa-user"></span>by
                                                {{ $news->get_user->name }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="icon fa fa-comment-o"></span>{{$jumlah_komentar}}
                                                Comments
                                            </a>
                                        </li>
                                    </ul>
                                    <h3>
                                        <a href="{{ url('/news/' . base64_encode($news->id)) . '/' . $news->judul }}">{{ $news->judul }}</a>
                                    </h3>
                                    {{-- How to get the first sentence from paragraph --}}

                                    <div class="text">
                                        {{ strip_tags(first_sentence($news->deskripsi)) }}
                                        </li>
                                    </div>
                                    <a href="{{ url('/news/' . base64_encode($news->id)) . '/' . $news->judul }}" class="btn-primary-line">Read More</a>
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
                        {!! $berita->onEachSide(1)->links() !!}
                    </ul>
                    <!-- <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                    </ul> -->
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