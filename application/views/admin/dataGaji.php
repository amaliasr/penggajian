<div class="container-fluid" style="margin-bottom: 100px">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Filter Data Gaji Pegawai
        </div>

        <div class="card-body">
            <form class="form-inline">
                <div class="form-group mb-2">
                    <label for="statisticEmail2">Bulan: </label>
                    <select class="form-control ml-3" name="bulan">
                        <option value="">--Pilih Bulan--</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>

                <form class="form-inline">
                    <div class="form-group mb-2 ml-5">
                        <label for="statisticEmail2">Tahun: </label>
                        <select class="form-control ml-3" name="tahun">
                            <option value="">--Pilih Tahun--</option>
                            <?php $tahun = date('Y');
                            for ($i = 2022; $i < $tahun + 5; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                    </div>

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
                    <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i>Tampilkan Data</button>

                    <?php if (count($gaji) > 0) { ?>
                        <a href="<?php echo base_url('admin/dataPenggajian/cetakGaji?bulan=' . $bulan), '&tahun=' . $tahun ?>" class="mb-2 ml-2 btn btn-success">
                            <i class="fas fa-print mr-1 "></i> Cetak Daftar Gaji</a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-success mb-2 ml-3" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-print mr-1"></i>Cetak Daftar Gaji</button>
                    <?php } ?>
                </form>
        </div>
    </div>

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

    <div class="alert alert-info">Menampilkan Data Gaji Pegawai Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span> Tahun:
        <span class="font-weight-bold"><?php echo $tahun ?></span>
    </div>

    <?php
    $jml_data = count($gaji);
    if ($jml_data > 0) { ?>

        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
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
                </thead>
                <tbody>
                    <?php foreach ($potongan as $p) {
                        $alpha = $p->jml_potongan;
                    } ?>
                    <?php $no = 1;
                    foreach ($gaji as $g) : ?>
                        <?php $potongan = $g->alpha * $alpha + (($g->gaji_pokok + $g->transport + $g->uang_makan) * 0.04) ?>
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
                                        // echo $jumlah_hari_cuti;
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
                    </thead>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <span class="badge badge-danger "><i class="fas fa-info circle"></i> Data Presensi Masih Kosong, Silahkan Input Data Kehadiran Pada Bulan dan Tahun yang Anda pilih.</span>
    <?php } ?>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Data gaji masih kosong, silahkan input presensi terlebih dahulu pada bulan dan tahun yang Anda pilih.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>