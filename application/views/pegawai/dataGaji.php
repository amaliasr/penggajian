<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <table class="table table-striped table-bordered">
        <tr>
            <th>Bulan/Tahun</th>
            <th>Gaji Pokok</th>
            <th>Tj. Transportasi</th>
            <th>Uang Makan</th>
            <th>Potongan Gaji</th>
            <th>Potongan Cuti</th>
            <th>Total Gaji</th>
            <th>Cetak Slip</th>
        </tr>

        <?php foreach ($potongan as $p) : ?>
            <?php $potongan = $p->jml_potongan; ?>
        <?php endforeach; ?>

        <?php foreach ($gaji as $g) : ?>
            <?php $pot_gaji = $g->alpha * $potongan + (($g->gaji_pokok + $g->transport + $g->uang_makan) * 0.04) ?>
            <tr>
                <td><?php echo $g->bulan ?></td>
                <td>Rp<?php echo number_format($g->gaji_pokok, 0, ',', '.') ?></td>
                <td>Rp<?php echo number_format($g->transport, 0, ',', '.') ?></td>
                <td>Rp<?php echo number_format($g->uang_makan, 0, ',', '.') ?></td>
                <td>Rp<?php echo number_format($pot_gaji, 0, ',', '.') ?></td>
                <td>Rp
                    <?php
                    $total_day_in_month = cal_days_in_month(CAL_GREGORIAN, substr($g->bulan, 0, 2), substr($g->bulan, 2));
                    $jumlah_potongan_cuti = 0;
                    foreach ($potongan_cuti as $key => $value) {
                        // cek
                        $ada = 'tidak';
                        if ($value->kode_mulai == $g->bulan || $value->kode_akhir == $g->bulan) {
                            $ada = 'ya';
                        }
                        if ($value->nip == $g->nip && $ada == 'ya') {
                            $jumlah_hari_cuti = 0;
                            if ($value->kode_mulai != $g->bulan || $value->kode_akhir != $g->bulan) {
                                $date = new DateTime($value->tgl_mulai_cuti);
                                $date->modify("last day of this month");
                                $endDate = $date->format("Y-m-d");
                                $tgl1 = date_create($value->tgl_mulai_cuti);
                                $tgl2 = date_create($endDate);
                                $diff = date_diff($tgl1, $tgl2);
                                $jumlah_hari_cuti = $diff->format("%d%") + 1;
                            } else {
                                $jumlah_hari_cuti = $value->jumlah_hari;
                            }
                            $pot =  (eval('return $value->' . $value->col_jabatan . ';') / $total_day_in_month) * $jumlah_hari_cuti;
                            $jumlah_potongan_cuti = $jumlah_potongan_cuti + $pot;
                        }
                    }
                    echo number_format($jumlah_potongan_cuti, 0, ',', '.');
                    ?>
                </td>
                <td>Rp<?php echo number_format($g->gaji_pokok + $g->transport + $g->uang_makan - $pot_gaji - $jumlah_potongan_cuti, 0, ',', '.') ?></td>
                <td>
                    <center>
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('pegawai/dataGaji/cetakSlip/' . $g->id_kehadiran) ?>"><i class="fas fa-print"></i></a>
                    </center>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>