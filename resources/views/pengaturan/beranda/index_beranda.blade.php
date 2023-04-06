{{-- header --}}
@include('layouts.header')
{{-- /header --}}

<body class="ltr main-body app sidebar-mini">

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('nowa/assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- Page -->
    <div class="page">

        <div>
            <!-- main-header -->
            @include('layouts.main-header')
            <!-- /main-header -->

            <!-- main-sidebar -->
            @include('layouts.main-sidebar')
            <!-- main-sidebar -->
        </div>

        <!-- main-content -->
        <div class="main-content app-content">

            <!-- container -->
            <div class="main-container container-fluid">

                <!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Halaman Beranda</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">ADMIN</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Halaman Beranda</li>
                        </ol>
                    </div>
                </div>
                <!-- /breadcrumb -->
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    @foreach ($beranda as $isi)
                    <div class="">
                        <div class="main-content-body main-content-body-contacts card custom-card">
                            {{-- Beranda --}}
                            <div class="main-contact-info-header pt-3 row col-sm-12 mx-0">
                                <div class="media col-sm-11">
                                    <div class="media-body mx-0">
                                        @if (!empty($isi->judul_beranda || $isi->about_beranda))
                                        <h5 class="mt-3">{!! $isi->judul_beranda !!}</h5>
                                        <p class="mb-0">{!! $isi->about_beranda !!}</p>
                                        @else
                                        <h5 class="mt-3" style="color: red">Tidak ada konten dalam Judul
                                            Beranda</h5>
                                        <p class="mb-0" style="color: red">Tidak ada konten dalam About
                                            Beranda</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="main-contact-action btn-list col-sm-1 justify-content-end">
                                    <button class="btn ripple btn-warning text-white btn-icon" data-placement="top" data-bs-toggle="modal" data-bs-target="#contoh_beranda" title="Contoh">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                    <button class="btn ripple btn-info text-white btn-icon" data-placement="top" data-bs-toggle="modal" data-bs-target="#modal_beranda" title="Edit Modul">
                                        <i class="fe fe-edit"></i>
                                    </button>
                                    {{-- Modal Edit Beranda --}}
                                    @include('pengaturan.beranda.modal.modal_beranda')
                                </div>
                            </div>
                            {{-- Kegiatan --}}
                            <div class="main-contact-info-header pt-3 row col-sm-12 mx-0">
                                <div class="media col-sm-11">
                                    <div class="media-body mx-0">
                                        @if (!empty($isi->judul_kegiatan || $isi->about_kegiatan))
                                        <h5 class="mt-3">{{ strip_tags($isi->judul_kegiatan) }}</h5>
                                        <p class="mb-0">{{ strip_tags($isi->about_kegiatan) }}</p>
                                        @else
                                        <h5 class="mt-3" style="color: red">Tidak ada konten dalam Judul
                                            Kegiatan</h5>
                                        <p class="mb-0" style="color: red">Tidak ada konten dalam About
                                            Kegiatan</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="main-contact-action btn-list col-sm-1 justify-content-end">
                                    <button class="btn ripple btn-warning text-white btn-icon" data-placement="top" data-bs-toggle="modal" data-bs-target="#contoh_kegiatan" title="Contoh">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                    <button class="btn ripple btn-info text-white btn-icon" data-placement="top" data-bs-toggle="modal" data-bs-target="#modal_kegiatan" title="Edit Modul">
                                        <i class="fe fe-edit"></i>
                                    </button>
                                    {{-- Modal Edit Kegiatan --}}
                                    @include('pengaturan.beranda.modal.modal_kegiatan')
                                </div>
                            </div>
                            {{-- Mitra --}}
                            <div class="main-contact-info-header pt-3 row col-sm-12 mx-0">
                                <div class="media col-sm-11">
                                    <div class="media-body mx-0">
                                        @if (!empty($isi->judul_mitra || $isi->about_mitra))
                                        <h5 class="mt-3">{{ strip_tags($isi->judul_mitra) }}</h5>
                                        <p class="mb-0">{{ strip_tags($isi->about_mitra) }}</p>
                                        @else
                                        <h5 class="mt-3" style="color: red">Tidak ada konten dalam Judul Mitra
                                        </h5>
                                        <p class="mb-0" style="color: red">Tidak ada konten dalam About Mitra
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="main-contact-action btn-list col-sm-1 justify-content-end">
                                    <button class="btn ripple btn-warning text-white btn-icon" data-placement="top" data-bs-toggle="modal" data-bs-target="#contoh_mitra" title="Contoh">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                    <button class="btn ripple btn-info text-white btn-icon" data-placement="top" data-bs-toggle="modal" data-bs-target="#modal_mitra" title="Edit Modul">
                                        <i class="fe fe-edit"></i>
                                    </button>
                                    {{-- Modal Edit Mitra --}}
                                    @include('pengaturan.beranda.modal.modal_mitra')
                                </div>
                            </div>
                            {{-- Berita --}}
                            <div class="main-contact-info-header pt-3 row col-sm-12 mx-0">
                                <div class="media col-sm-11">
                                    <div class="media-body mx-0">
                                        @if (!empty($isi->judul_berita || $isi->about_berita))
                                        <h5 class="mt-3">{{ strip_tags($isi->judul_berita) }}</h5>
                                        <p class="mb-0">{{ strip_tags($isi->about_berita) }}</p>
                                        @else
                                        <h5 class="mt-3" style="color: red">Tidak ada konten dalam Judul
                                            Beranda</h5>
                                        <p class="mb-0" style="color: red">Tidak ada konten dalam About
                                            Beranda</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="main-contact-action btn-list col-sm-1 justify-content-end">
                                    <button class="btn ripple btn-warning text-white btn-icon" data-placement="top" data-bs-toggle="modal" data-bs-target="#contoh_berita" title="Contoh">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                    <button class="btn ripple btn-info text-white btn-icon" data-placement="top" data-bs-toggle="modal" data-bs-target="#modal_berita" title="Edit Modul">
                                        <i class="fe fe-edit"></i>
                                    </button>
                                    {{-- Modal Edit Beranda --}}
                                    @include('pengaturan.beranda.modal.modal_berita')
                                </div>
                            </div>
                            {{-- Footer --}}

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- /Container -->
        </div>
        <!-- /main-content -->

        <!-- Footer opened -->
        @include('layouts.footer')
        <!-- Footer closed -->
    </div>
    <!-- End Page -->

    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="las la-arrow-up"></i></a>

    {{-- script --}}
    @include('layouts.script')
    {{-- /script --}}

    <!-- Add alert -->
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
    @endif
    <!-- /Alert -->

    <script>
        $(document).ready(function() {
            $('#judul_beranda').summernote();
        });
        $(document).ready(function() {
            $('#about_beranda').summernote();
        });
        $(document).ready(function() {
            $('#judul_kegiatan').summernote();
        });
        $(document).ready(function() {
            $('#about_kegiatan').summernote();
        });
        $(document).ready(function() {
            $('#judul_mitra').summernote();
        });
        $(document).ready(function() {
            $('#about_mitra').summernote();
        });
        $(document).ready(function() {
            $('#judul_berita').summernote();
        });
        $(document).ready(function() {
            $('#about_berita').summernote();
        });
    </script>
</body>

</html>