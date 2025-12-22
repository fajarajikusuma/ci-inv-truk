<?php
if (count($data) > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nopol</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Tahun</th>
                    <th>Sopir</th>
                    <th class="text-center">Pajak Tahunan</th>
                    <th class="text-center">Pajak 5 Tahunan</th>
                    <th class="text-center">Status</th>
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
                        <td><?= esc($row['nama_sopir']) ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal_stnk'])) ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal_tnkb'])) ?></td>
                        <td class="text-center">
                            <span class="badge bg-primary"><?= esc($row['status']) ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php else: ?>
    <p class="text-muted text-center">Tidak ada kendaraan pada bulan ini.</p>
<?php endif; ?>