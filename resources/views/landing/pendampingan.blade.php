@include('landing.layouts.header')
@include('layouts.header')

<section class="page">
    <!-- ***** Page Top Start ***** -->
    <div class="cover" data-image="assets/images/photos/parallax.jpg">
        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Pendampingan</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="active">Pendampingan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Page Top End ***** -->

    <!-- ***** Page Content Start ***** -->
    <div class="main-container container-fluid">
        <div class="row" style="margin-left: 2cm;margin-right:2cm;margin-bottom: 2cm;margin-top: 2cm;">
            <h4 class="section-title" style="text-align: center;">Data Pendampingan Mitra</h4>
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap mb-0" id="responsive-datatable" role="grid" aria-describedby="example2_info">
                    <thead>
                        <tr role="row">
                            <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Purchase Date: activate to sort column descending" style="width: 5.6094px;">No.</th>
                            <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Purchase Date: activate to sort column descending" style="width: 84.6094px;">Mitra</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Client Name: activate to sort column ascending" style="width: 87.1094px;">Judul Pendampingan</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Client Name: activate to sort column ascending" style="width: 87.1094px;">Nama Pendamping</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Product ID: activate to sort column ascending" style="width: 66.7969px;">Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @if(!empty($pendampingan))
                        @foreach($pendampingan as $p)
                        <tr class="odd">
                            <td class="text-center sorting_1">{{$no}}</td>
                            <td>{{$p->mitra}}</td>
                            <td>{{$p->judul}}</td>
                            <td>{{$p->nama_pendamping}}</td>
                            <td>{{$p->tahun}}</td>
                        </tr>
                        <?php $no += 1; ?>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ***** Page Content End ***** -->
</section>

@include('landing.layouts.footer')
@include('layouts.script')