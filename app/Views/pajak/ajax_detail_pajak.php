<?php
function statusPajak($tanggal)
{
    $hari_ini = new DateTime(date('Y-m-d'));
    $jatuh_tempo = new DateTime($tanggal);
    $diff = $hari_ini->diff($jatuh_tempo);

    $tahun = $diff->y;
    $bulan = $diff->m;
    $hari  = $diff->d;

    // Susun teks waktu (biar rapi, yang 0 tidak ditampilkan)
    $waktu = [];
    if ($tahun > 0) $waktu[] = $tahun . ' tahun';
    if ($bulan > 0) $waktu[] = $bulan . ' bulan';
    if ($hari > 0 || empty($waktu)) $waktu[] = $hari . ' hari';

    $teksWaktu = implode(' ', $waktu);

    // Jika sudah lewat jatuh tempo
    if ($diff->invert == 1) {
        return '<span class="badge bg-danger">Terlambat ' . $teksWaktu . '</span>';
    }

    // Jika <= 30 hari lagi (peringatan)
    $totalHari = (int)$hari_ini->diff($jatuh_tempo)->format('%a');
    if ($totalHari <= 30) {
        return '<span class="badge bg-warning text-dark">' . $teksWaktu . ' lagi</span>';
    }

    // Aman
    return '<span class="badge bg-success">' . $teksWaktu . ' lagi</span>';
}
?>

<?php
if (count($data) > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="#table-pajak">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nopol</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Tahun</th>
                    <th class="text-center">Pajak Tahunan</th>
                    <th class="text-center">Pajak 5 Tahunan</th>
                    <th class="text-center">Status Pajak Tahunan</th>
                    <th class="text-center">Status Pajak 5 Tahunan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($data as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($row['nopol']) ?></td>
                        <td><?= esc($row['jenis_kendaraan']) ?></td>
                        <td><?= esc($row['merk']) ?></td>
                        <td><?= esc($row['tipe']) ?></td>
                        <td><?= esc($row['tahun_pembuatan']) ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal_stnk'])) ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal_tnkb'])) ?></td>
                        <td class="text-center">
                            <?= statusPajak($row['tanggal_stnk']); ?>
                        </td>
                        <td class="text-center">
                            <?= statusPajak($row['tanggal_tnkb']); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php else: ?>
    <p class="text-muted text-center">Tidak ada kendaraan pada bulan ini.</p>
<?php endif; ?>