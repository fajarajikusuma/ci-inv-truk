<?php

use App\Models\KendaraanModel;

function getNopolById($id_kendaraan)
{
    if (!$id_kendaraan) {
        return '-';
    }

    $model = new KendaraanModel();

    $data = $model->where('id_kendaraan', $id_kendaraan)->first();

    return $data ? $data['nopol'] : '-';
}
function cardStats($title, $value, $icon, $color = 'primary')
{
    return "
        <div class='col-12 col-md-3'>
            <div class='card shadow-sm'>
                <div class='card-body d-flex justify-content-between align-items-center'>
                    <div>
                        <h6 class='text-muted'>$title</h6>
                        <h3 class='fw-bold'>$value</h3>
                    </div>
                    <div class='avatar bg-$color'>
                        <i class='$icon text-white fs-4'></i>
                    </div>
                </div>
            </div>
        </div>
    ";
}

function namaBulan($bln)
{
    $bulan = [
        1 => 'Jan',
        2 => 'Feb',
        3 => 'Mar',
        4 => 'Apr',
        5 => 'Mei',
        6 => 'Jun',
        7 => 'Jul',
        8 => 'Agu',
        9 => 'Sep',
        10 => 'Okt',
        11 => 'Nov',
        12 => 'Des'
    ];
    return $bulan[$bln];
}
