<!-- multiple row -->
<?php
foreach ($tabelRole as $tR) {
    if ($tR->name == 'Unit') {
        $idRoleUnit = $tR->id;
    }
    if ($tR->name == 'Mitra') {
        $idRoleMitra = $tR->id; // berapa id role untuk mitra
    }
}
$idRoleAsUnit = 0;
$idRoleAsMitra = 0;

for ($y = 0; $y < 1; $y++) {
    foreach ($roleAssignment as $roleAs) {
        if ($myArray[0] == $roleAs->id_role) {
            if ($roleAs->id_user == $user->id) {
                if ($roleAs->id_role == $idRoleUnit) {
                    $idRoleAsUnit =  $roleAs->id_unit . "<br />"; //berapa id untuk role unit di tabel role assignment
                }
                if ($roleAs->id_role == $idRoleMitra) {
                    $idRoleAsMitra =  $roleAs->id_mitra . "<br />"; //berapa id untuk role mitra di tabel role assignment
                }
            }
        }
    } ?>
    <div class="col-sm-3">
        <div class="form-group">
            <br>
            <button class="btn btn-success btn-sm mb-1" type="button">
                <i class="fe fe-plus"></i>
                Tambah Role
            </button>
        </div>
    </div>
<?php } ?>

<?php
$idRoleAsUnit2 = 0;
$idRoleAsMitra2 = 0;
for ($i = 0; $i < $countArray; $i++) {
    foreach ($roleAssignment as $roleAs) {
        if ($myArray[$i] == $roleAs->id_role) {
            if ($roleAs->id_user == $user->id) {
                if ($roleAs->id_role == $idRoleUnit) {
                    $idRoleAsUnit2 =  $roleAs->id_unit . "<br />"; //berapa id untuk role unit di tabel role assignment
                }
                if ($roleAs->id_role == $idRoleMitra) {
                    $idRoleAsMitra2 =  $roleAs->id_mitra . "<br />"; //berapa id untuk role mitra di tabel role assignment
                }
            }
        }
    } ?>
    <div class="clone hide">
        <div class="hdtuto form-group" style="margin-top:10px">
            <div class="row">
                <div class="col-sm-3">
                    <label class="main-content-label tx-11 tx-medium tx-gray-600">Role</label>
                    <select onchange="ShowHideDiv2()" id="tambahselect2" class="js-example-basic-multiple" name="role[]" id="role[]" style="width: 100%;height: 100%;color:#a09e9e;background:#00000000;border:1px solid #f1f1f1">
                        @foreach ($tabelRole as $role)
                        <option value="{{ $role->id }}" {{ $role->id == $myArray[$i] ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <br>
                        <button class="btn btn-danger btn-sm mb-1" type="button">
                            <i class="fe fe-trash"></i>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>