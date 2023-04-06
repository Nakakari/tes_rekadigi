@include('landing.layouts.header')

@foreach ($beranda as $isi)
<!-- ***** Wellcome Area Start ***** -->
<section class="welcome-area">
    <!-- ***** Wellcome Area Background Start ***** -->
    <div class="welcome-bg" data-bg="{{ asset('nowa/assets/img/office.jpg') }}">
        <img src="{{ asset('landing/assets/images/office.jpg') }}" alt="">
        <img src="{{ asset('landing/assets/images/bg-bottom.svg') }}" alt="">
    </div>
    <!-- ***** Wellcome Area Background End ***** -->

    <!-- ***** Wellcome Area Content Start ***** -->
    <div class="welcome-content mt-5 pt-5">
        <div class="container mt-5 pt-5">
            <div class="row mt-3 pt-3">
                <div class="col-lg-6 col-md-12 align-self-center mt-5">
                    <h1>{!! $isi->judul_beranda !!}</h1>
                    <p>{{ strip_tags($isi->about_beranda) }}</p>
                </div>
                <div class="offset-lg-1 col-lg-5 col-md-12 align-self-center">
                    <div class="apps">
                        <div class="container-fluid">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Wellcome Area Content End ***** -->
</section>
<!-- ***** Wellcome Area End ***** -->

<!-- ***** Home About - Services Start ***** -->
<section class="section services-section pbottom-70">
    <div class="container">
        <div class="row">
            <!-- ***** Home About Start ***** -->
            <div class="col-lg-4 col-md-12 col-sm-12 align-self-center">
                <div class="left-heading">
                    <h2 class="section-title">{{ strip_tags($isi->judul_kegiatan) }}</h2>
                </div>
                <div class="left-text">
                    <p class="dark">{{ strip_tags($isi->about_kegiatan) }}</p>
                </div>
            </div>
            <!-- ***** Home About End ***** -->

            <!-- ***** Home Services Start ***** -->
            <div class="offset-lg-1 col-lg-7 col-md-12 col-sm-12 align-self-bottom">
                <div class="row text-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <a href="" class="home-services-item mtop-70 " data-scroll-reveal="enter bottom move 30px over 0.6s after 0.2s">
                            <i class="fa fa-clone"></i>
                            <h5 class="services-title">Penelitian</h5>
                            <!-- <p>Memberikan dan membekali para peneliti pada berbagai kompetensi yang dapat memenuhi
                                kebutuhan dan standar dunia industri, masyarakat, dunia kerja baik internal dan
                                eksternal</p> -->
                        </a>
                        <a href="" class="home-services-item" data-scroll-reveal="enter bottom move 30px over 0.6s after 0.2s">
                            <i class="fa fa-connectdevelop"></i>
                            <h5 class="services-title">Pengabdian</h5>
                            <!-- <p>Memberikan arah pelaksanaan kegiatan pengabdian yang berbasis riset yang dilaksanakan
                                oleh para pengabdi di lingkungan Universitas Sebelas Maret</p> -->
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <a href="" class="home-services-item active" data-scroll-reveal="enter bottom move 30px over 0.6s after 0.3s">
                            <i class="fa fa-object-ungroup"></i>
                            <h5 class="services-title">Kerjasama</h5>
                            <!-- <p>Memperluas kemitraan dan kolaborasi yang efektif di bidang penelitian dan pengabdian,
                                pengembangan revenue generating unit terpadu dan penerapan hasil penelitian</p> -->
                        </a>
                        <a href="" class="home-services-item" data-scroll-reveal="enter bottom move 30px over 0.6s after 0.3s">
                            <i class="fa fa-line-chart"></i>
                            <h5 class="services-title">Hilirisasi</h5>
                            <!-- <p>Pengembangan tingkat kesiapan atau kematangan luaran penelitian yang dihasilkan
                                dengan mengacu pada Tingkat Kesiapterapan Teknologi dan Tingkat Kesiapan Inovasi</p> -->
                        </a>
                    </div>
                </div>
            </div>
            <!-- ***** Home Services End ***** -->
        </div>
    </div>
</section>
<!-- ***** Home About - Services Start ***** -->

<!-- ***** Our Team Start ***** -->
<section class="section pbottom-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">{{ strip_tags($isi->judul_mitra) }}</h2>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-6">
                <div class="center-text">
                    <p>{{ strip_tags($isi->about_mitra) }}</p>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</section>
<!-- ***** Our Team End ***** -->

<!-- ***** Counter Parallax Start ***** -->
<section class="parallax">
    <div class="parallax-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="count-item">

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="count-item">
                        <strong>{{ $total_kegiatan }}</strong>
                        <span>Total Kegiatan</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="count-item">
                        <strong>{{ $total_berita }}</strong>
                        <span>Total Berita</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="count-item">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Counter Parallax End ***** -->

<!-- ***** Blog Start ***** -->
<section class="section pbottom-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">{{ strip_tags($isi->judul_berita) }}</h2>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-6">
                <div class="center-text">
                    <p>{{ strip_tags($isi->about_berita) }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- Funntion to get the first sentence of longText --}}
            <?php
            function first_sentence($content)
            {
                $post = strpos($content, '.');
                return substr($content, 0, $post + 1);
            }
            ?>
            @foreach ($berita as $news)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="blog-post-thumb">
                    <div class="img">
                        @foreach ($news->get_dokumen as $data)
                        <img src="{{ asset('/dokumen/berita/' . $data->nama) }}" alt="">
                        @endforeach
                    </div>
                    <h3>
                        <a href="blog-single.html">{{ $news->judul }}</a>
                    </h3>
                    <div class="text"> {{ strip_tags(first_sentence($news->deskripsi)) }}
                    </div>
                    <a href="{{ url('/news/' . base64_encode($news->id)) . '/' . $news->judul }}" class="btn-primary-line">Read More</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ***** Blog End ***** -->
@endforeach

@include('landing.layouts.footer')