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
        <h2>Daftar THR Pegawai</h2>
    </center>

    <table style="width: 50%">
        <tr>
            <td width="20%">Tanggal</td>
            <td width="2%">:</td>
            <td><?php echo $masaKaryawan[0]->tgl_thr ?></td>
        </tr>
    </table>

    <table class="table table-bordered table-striped">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">NIP</th>
            <th class="text-center">Nama Pegawai</th>
            <th class="text-center">Tanggal Masuk</th>
            <th class="text-center">Tanggal THR</th>
            <th class="text-center">Masa Kerja</th>
            <th class="text-center">Gaji Pokok</th>
            <th class="text-center">Nominal THR</th>
        </tr>

        <?php $no = 1;
        foreach ($masaKaryawan as $value) { ?>
            <td><?php echo $no++ ?></td>
            <td><?php echo $value->nip ?></td>
            <td><?php echo $value->nama_pegawai ?></td>
            <td><?php echo $value->tgl_masuk ?></td>
            <td><?php echo $value->tgl_thr ?></td>
            <td><?php echo $value->masa_kerja ?></td>
            <td>Rp. <?php echo number_format($value->gaji_pokok, 0, ',', '.') ?></td>
            <?php
            if ($value->masa_kerja_bulan >= 12) {
                $thr = $value->gaji_pokok;
            } else {
                $thr = round(($value->masa_kerja_bulan / 12) * $value->gaji_pokok);
            }
            ?>
            <td>Rp. <?php echo number_format($thr, 0, ',', '.') ?></td>
            </tr>
        <?php } ?>
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