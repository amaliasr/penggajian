<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
</div>

<div class="alert alert-success font-weight-bold mb-4" style="width: 50%">Selamat Datang, Anda Login Sebagai Pegawai.</div>


<div class="card" style="margin-bottom: 120px; width: 50%">
<div class="card-header font-weight-bold bg-primary text-white">
    Data Pegawai

</div>

<?php foreach($pegawai as $p) : ?>

    <div class="card body">

    <div class="row">

        <div class="col-md-5">
        <img style="width:250px" src="<?php echo base_url('assets/photo/'.$p->photo)?>" >
        </div>

        <div class="col-md-6">
        <table class="table">

            <tr>
                <td>NIP</td>
                <td>:</td>
                <td><?php echo $p->nip?></td>
            </tr>

            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><?php echo $p->nik?></td>
            </tr>

            <tr>
                <td>Nama Pegawai</td>
                <td>:</td>
                <td><?php echo $p->nama_pegawai?></td>
            </tr>

            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>GOP0<?php echo $p->id_jabatan?></td>
            </tr>

            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?php echo $p->jenis_kelamin?></td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $p->alamat?></td>
            </tr>

            <tr>
                <td>No Telepon</td>
                <td>:</td>
                <td>+62<?php echo $p->no_telp?></td>
            </tr>

            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $p->email?></td>
            </tr>

            <tr>
                <td>Tanggal Masuk</td>
                <td>:</td>
                <td><?php echo $p->tgl_masuk?></td>
            </tr>

            <tr>
                <td>Status</td>
                <td>:</td>
                <td><?php echo $p->status?></td>
            </tr>
        </table>
        </div>
</div>
    </div>

<?php endforeach;?>

</div>

</div>




