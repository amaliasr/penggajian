<div class="container-fluid" style="margin-bottom: 100px">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Filter Data Presensi Pegawai
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
                    <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i>Tampilkan Data</button>
                    <a class="mb-2 ml-2 btn btn-success" href="<?php echo base_url('admin/dataPresensi/inputPresensi') ?>"><i class="fas fa-plus"></i> Input Kehadiran</a>
                </form>
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

    </div>

    <div class="alert alert-info">Menampilkan Data Kehadiran Pegawai Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span> Tahun: <span class="font-weight-bold"><?php echo $tahun ?></span></div>

    <?php

    $jml_data = count($presensi);
    if ($jml_data > 0) { ?>


        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <td class="text-center">No</td>
                    <td class="text-center">NIP</td>
                    <td class="text-center">Nama Pegawai</td>
                    <td class="text-center">Hadir</td>
                    <td class="text-center">Izin</td>
                    <td class="text-center">Sakit</td>
                    <td class="text-center">Alpha</td>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($presensi as $a) : ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $a->nip ?></td>
                        <td><?php echo $a->nama_pegawai ?></td>
                        <td><?php echo $a->hadir ?></td>
                        <td><?php echo $a->izin ?></td>
                        <td><?php echo $a->sakit ?></td>
                        <td><?php echo $a->alpha ?></td>
                    <?php endforeach; ?>
                    </thead>
            </tbody>
        </table>
    <?php } else { ?>
        <span class="badge badge-danger"><i class="fas fa-info circle"></i> Data Masih Kosong, Silahkan Input Data Kehadiran Pada Bulan dan Tahun yang Anda pilih.</span>
    <?php } ?>
</div>