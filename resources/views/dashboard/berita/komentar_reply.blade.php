@foreach($comments as $comment)
<div class="display-comment" style="margin-left: 1.5cm;">

    <div class="d-sm-flex mt-0 p-3 sub-review-section border br-bl-0 br-br-0">
        <div class="d-flex me-3">
            <a href="profile.html">
                <?php
                $image_user = '';
                foreach ($users as $u) {
                    if ($u->id == $comment->id_user) {
                        $image_user = $u->image;
                    }
                }
                ?>
                <img class="media-object brround avatar-md" alt="64x64" src="{{ asset('/imageprofil/' . $image_user) }}">
            </a>
        </div>
        <div class="media-body">
            <a>
                <h5 class="mt-0 mb-1 font-weight-semibold">{{ $comment->iduser->name }}
                    <div class="form-group float-sm-right mt-1">
                        <?php
                        if ($comment->is_aktif == 1) {
                            $color = '#4ec2f0';
                        } else {
                            $color = '#f74f75';
                        }
                        ?>
                        <label class="custom-switch form-switch ps-0">
                            <input data-id="{{ $comment->id }}" id="customSwitch-22{{ $comment->id }}" type="checkbox" name="custom-switch-radio" class="custom-switch-input" onclick="changeUserStatus(event.target, <?= $comment->id ?>);" {{ $comment->is_aktif == 1 ? 'checked' : '' }}>
                            <span class="custom-switch-indicator custom-switch-indicator-sm"></span>
                            <span class="custom-switch-description tx-14" style="color: <?= $color ?>;">{{ $comment->is_aktif == 1 ? 'Terverifikasi' : 'Belum Diverifikasi' }}</span>
                        </label>
                    </div>
                    @if ($comment->is_aktif == 1)
                    <span class="tx-14 ms-0" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="verified"><i class="fe fe-check-circle text-success tx-12"></i></span>
                    @endif
                    <small class="d-block text-muted tx-12">{{$comment->created_at}}</small>
                </h5>
            </a>
            <p class="font-13  mb-2 mt-2">
                {{ $comment->komentar }}
            </p>
            <a aria-controls="collapseExample" aria-expanded="false" class="me-2 mt-1" data-bs-toggle="collapse" href="#collapseExample{{ $comment->id }}" role="button"><span class="badge bg-success "><span class="me-1 fe fe-edit-2 tx-11"></span>Reply</span></i>
            </a>
        </div>
    </div>

    <a href="" id="reply"></a>
    <br />

    <form class="collapse ml-5" id="collapseExample{{ $comment->id }}" method="post" action="{{ route('reply.store') }}">
        @csrf
        <div class="form-group">
            <textarea class="form-control" name="komentar" rows="1" placeholder="Write Comment"></textarea>
            <input type="hidden" name="id_berita" value="{{ $comment->id_berita }}" />
            <input type="hidden" name="id_komen" value="{{ $comment->id }}" />
            <input type="hidden" name="id_user" value="{{ Auth()->user()->id }}" />
            <input type="hidden" name="id_parent" value="{{ $comment->id }}" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-sm" value="Reply" />
        </div>
    </form>
    @include('dashboard.berita.komentar_reply', ['comments' => $comment->replies])
    <!-- {{ $comment->replies}} -->
</div>
@endforeach
<script>
    // isaktif switch button
    function changeUserStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 1 : 0;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/komentar/isaktif',
            data: {
                'is_aktif': status,
                'id': id,
            },
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: "Berhasil",
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        window.location.reload();
    }
</script>