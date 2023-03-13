<!DOCTYPE html>
<html>

<head>

    <title><?php echo $title ?></title>
    <style type="text/css">
        body {
            font-family: Arial;
            color: black;
        }
    </style>
</head>

<body>

    <center>
        <h1>PT. GLORY OFFSET PRESS</h1>
        <h2>Daftar Gaji Pegawai</h2>
    </center>

    <?php
    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan . $tahun;
    } else {
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan . $tahun;
    }
    ?>

    <table>
        <tr>
            <td>Bulan</td>
            <td>:</td>
            <td><?php echo $bulan ?></td>
        <tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td><?php echo $tahun ?></td>
        <tr>
    </table>

    <table class="table table-bordered table-striped">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">NIP</th>
            <th class="text-center">Nama Pegawai</th>
            <th class="text-center">Jenis Kelamin</th>
            <th class="text-center">Jabatan</th>
            <th class="text-center">Gaji Pokok</th>
            <th class="text-center">Tj. Transport</th>
            <th class="text-center">Uang Makan</th>
            <th class="text-center">Potongan</th>
            <th class="text-center">Potongan Cuti</th>
            <th class="text-center bg-warning">PPH21<br><small>(Ditanggung perusahaan)</small></th>
            <th class="text-center">Total Gaji</th>
        </tr>

        <?php foreach ($potongan as $p) {
            $alpha = $p->jml_potongan;
        } ?>
        <?php $no = 1;
        foreach ($cetakGaji as $g) : ?>
            <?php $potongan = $g->alpha * $alpha + (($g->gaji_pokok + $g->transport + $g->uang_makan) * 0.04); ?>
            <tr>
                <td> <?php echo $no++ ?></td>
                <td> <?php echo $g->nip ?></td>
                <td> <?php echo $g->nama_pegawai ?></td>
                <td> <?php echo $g->jenis_kelamin ?></td>
                <td> <?php echo $g->nama_jabatan ?></td>
                <td>Rp <?php echo number_format($g->gaji_pokok, 0, ',', '.') ?></td>
                <td>Rp <?php echo number_format($g->transport, 0, ',', '.') ?></td>
                <td>Rp <?php echo number_format($g->uang_makan, 0, ',', '.') ?></td>
                <td>Rp <?php echo number_format($potongan, 0, ',', '.') ?></td>
                <td>Rp
                    <?php
                    $total_day_in_month = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    $jumlah_potongan_cuti = 0;
                    foreach ($potongan_cuti as $key => $value) {
                        if ($value->nip == $g->nip) {
                            $jumlah_hari_cuti = 0;
                            if ($value->kode_mulai != $bulantahun || $value->kode_akhir != $bulantahun) {
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
                <td class="bg-warning">
                    <?php
                    $totalSatuTahun = 12 * $g->gaji_pokok;
                    if ($g->gaji_pokok >= 4500000) {
                        foreach ($pph21 as $key => $value) {
                            if ($value->batas_atas < $totalSatuTahun && $value->batas_bawah >= $totalSatuTahun) {
                                $nettSebulan = $g->gaji_pokok - ($g->gaji_pokok * $value->persen / 100);
                                $nettSetahun = 12 * $nettSebulan;
                                if ($nettSetahun > 54000000) {
                                    $penghasilanPKP = $nettSetahun - 54000000;
                                    $pajakProgresif = $penghasilanPKP - ($penghasilanPKP * $value->persen / 100);
                                    $pph21sebulan = $pajakProgresif / 12;
                                    echo number_format($pph21sebulan, 0, ',', '.');
                                } else {
                                    echo '-';
                                }
                            }
                        }
                    } else {
                        echo '-';
                    }
                    ?>
                </td>
                <td>Rp <?php echo number_format($g->gaji_pokok + $g->transport + $g->uang_makan - $potongan - $jumlah_potongan_cuti, 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <table width="100%">
        <tr>
            <td></td>
            <td width="200px">
                <p>Tangerang, <?php echo date("d M Y") ?> <br> Finance</p>
                <br>
                <br>
                <p>_________________</p>
            </td>
        </tr>
    </table>
</body>

</html>
<script type="text/javascript">
    window.print();
</script>