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
        </tbody>
    </table>
</div>
<br />