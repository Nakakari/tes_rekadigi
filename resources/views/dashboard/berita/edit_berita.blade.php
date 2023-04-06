{{-- header --}}
@include('layouts.header')
{{-- /header --}}

<body class="ltr main-body app sidebar-mini">

    <!-- Loader -->
    {{-- <div id="global-loader">
        <img src="{{ asset('nowa/assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div> --}}
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
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Edit Berita</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                                    <h5 class="card-title mg-b-20">Edit Berita</h5>
                                </div>
                                <form action="{{ url('/berita/edit/process/' . base64_encode($id)) }}" id="formData" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">Judul
                                            Berita</label>
                                        <input class="form-control" type="text" name="judul" id="judul" value="{{ $berita->judul }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">Create News as
                                            :</label>
                                        <div class="row mg-t-10">
                                            <div class="col-lg-2" id="admin">
                                                <label class="rdiobox"><input name="rdio" value="admin" type="radio" checked>
                                                    <span>ADMIN</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-2" id="mitra">
                                                <label class="rdiobox"><input name="rdio" value="mitra" type="radio">
                                                    <span>MITRA</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">Kategori
                                            Berita</label>
                                        <select id="id_kategori" class="form-control form-select" name="id_kategori" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1">
                                            @foreach ($kategori as $m)
                                            @if ($berita->id_kategori == $m->id)
                                            <option value="{{ $m->id }}" selected>{{ $m->nama }}
                                            </option>
                                            @else
                                            <option value="{{ $m->id }}">{{ $m->nama }}
                                            </option>
                                            @endif
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
                                        <textarea class="summernote form-control" type="text" name="deskripsi" id="deskripsi">
                                        {{ strip_tags($berita->deskripsi) }}
                                        </textarea>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-600">Add Image</label>
                                        <input type="file" class="form-control" id="fotoberita" name="files[]" accept="image/jpeg, image/png" multiple />
                                    </div> -->
                                    <br />
                                    <div class="form-group">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th colspan="2" style="color: rgb(22, 177, 92)">
                                                        File yang sudah diupload :
                                                    </th>
                                                </tr>
                                            </thead>
                                            @foreach ($berita->get_dokumen as $news)
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a class="text-primary" href="{{ asset('/dokumen/berita/' . $news->nama) }}" target="_blank">{{ $news->nama }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/berita/delete_pic/' . base64_encode($news->id)) }}" class="btn btn-sm btn-danger" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Delete" onclick="return confirm('Apakah anda yakin ingin menghapus gambar ?')">
                                                            <i class="fe fe-trash-2"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>

                                    <!-- MULTIPLE IMAGE -->
                                    <div class="input-group control-group increment">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="main-content-label tx-11 tx-medium tx-gray-600">Edit
                                                        Gambar</label>
                                                    <input type="file" class="form-control" name="files[]" accept="image/jpeg, image/png" multiple />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Input hidden is_active or news status --}}
                                    <input type="hidden" name="is_aktif" class="form-control" value="0">

                                    {{-- Input hidden timestamp create by, create at and update at --}}
                                    <input type="hidden" name="created_by" class="form-control" value="{{ Auth()->user()->id }}">
                                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                    <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d H:i:s') ?>">
                                    <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">

                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit">Perbarui</button>
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
</body>

</html>