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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Tambah Berita Baru</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">MITRA</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                        </ol>
                    </div>
                </div>
                <!-- /breadcrumb -->

                <!-- row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">
                                    <h5 class="card-title mg-b-20">Buat Berita</h5>
                                </div>
                                <form action="{{ url('/berita/addNew/create') }}" id="formData" method="POST"
                                    enctype="multipart/form-data" class="needs-validation" novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">
                                            Judul Berita
                                        </label>
                                        <br>
                                        <small style="color: rgb(7, 128, 165)">Maksimal 200 huruf.</small>
                                        <input class="form-control" type="text" name="judul" id="judul"
                                            required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please add the contain.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">Buat Berita
                                            sebagai
                                            :</label>
                                        <div class="row mg-t-10">
                                            <div class="col-lg-2" id="admin">
                                                <label class="rdiobox"><input name="rdio" type="radio">
                                                    <span>ADMIN</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-2" id="mitra">
                                                <label class="rdiobox"><input name="rdio" type="radio">
                                                    <span>MITRA</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="list" class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">Mitra</label>
                                        <select id="id_mitra" class="form-control form-select" name="id_mitra"
                                            style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1">
                                            <option selected="" disabled="">Pilih Mitra</option>
                                            @foreach ($mitra as $m)
                                                <option value="{{ $m->id }}">{{ $m->nama_mitra }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please add the contain.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">Kategori
                                            Berita</label>
                                        <select id="id_kategori" class="form-control form-select" name="id_kategori"
                                            style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1">
                                            <option selected="" disabled="">Pilih Kategori</option>
                                            @foreach ($kategori as $m)
                                                <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please add the contain.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">Isi Berita</label>
                                        <textarea class="summernote form-control" type="text" name="deskripsi" id="deskripsi" required></textarea>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please write the content.
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">Add Image</label>
                                        <input type="file" class="form-control" id="demo" name="files[]"
                                            accept="image/jpeg, image/png" multiple />
                                    </div> --}}
                                    <br />

                                    <!-- MULTIPLE IMAGE -->
                                    <div class="input-group control-group increment">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label
                                                        class="main-content-label tx-11 tx-medium tx-gray-600">Tambahkan
                                                        Gambar</label>
                                                    <input type="file" class="form-control" name="files[]"
                                                        accept="image/jpeg, image/png" multiple />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Input hidden is_active or news status --}}
                                    <input type="hidden" name="is_aktif" class="form-control" value="0">

                                    {{-- Input hidden timestamp create by, create at and update at --}}
                                    <input type="hidden" name="created_by" class="form-control"
                                        value="{{ Auth()->user()->id }}">
                                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                    <input name="created_at" id="created_at" type="hidden"
                                        value="<?= date('Y-m-d H:i:s') ?>">
                                    <input name="updated_at" id="updated_at" type="hidden"
                                        value="<?= date('Y-m-d') ?>">

                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /row -->

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
    <script>
        $(document).ready(function() {
            $('#deskripsi').summernote();
        });
    </script>

    <script>
        const admin = document.getElementById("admin");
        const mitra = document.getElementById("mitra");
        const list = document.getElementById("list");
        list.style.display = "none";
        admin.addEventListener("click", (event) => {
            list.style.display = "none";
        })
        mitra.addEventListener("click", (event) => {
            if (list.style.display = "none") {
                list.style.display = "block";
            } else {
                list.style.display = "none";
            }
        })
    </script>
