<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Cuti</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="listData">
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="modalHeader">
            </div>
            <div class="modal-body" id="modalBody">
            </div>
            <div class="modal-footer" id="modalFooter">
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
    function currentDate() {
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var current_date = d.getFullYear() + '-' +
            (month < 10 ? '0' : '') + month + '-' +
            (day < 10 ? '0' : '') + day
        return current_date;
    }

    function datediff(first, second) {
        var day_start = new Date(first);
        var day_end = new Date(second);
        var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
        var d = Math.round(total_days);
        return d;
    }
    $(document).ready(function() {
        getData()
    })

    function getData() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/dataCuti/masterCuti',
            type: 'GET',
            beforeSend: function() {},
            success: function(response) {
                if (JSON.parse(response).length != 0) {
                    formData(JSON.parse(response))
                }
            }
        })
    }

    function formData(data) {
        var html = ""
        $.each(data, function(key, value) {
            html += '<tr>'
            html += '<td>' + (parseInt(key) + 1) + '</td>'
            html += '<td>' + value.nama_cuti + '</td>'
            html += '<td>'
            html += '<button class="btn btn-sm btn-primary mr-1" onclick="modalEdit(' + value.id + ',' + "'" + value.nama_cuti + "'" + ')"><i class="fa fa-pen"></i></button>'
            html += '<button class="btn btn-sm btn-dark" onclick="modalRelation(' + value.id + ')"><i class="fa fa-link"></i></button>'
            html += '</td>'
            html += '</tr>'
        })
        $('#listData').html(html)
    }

    function modalEdit(id, nama) {
        $('#modal').modal('show')
        var html_header = ""
        html_header += '<h5 class="modal-title" id="exampleModalLabel">Edit Master Cuti</h5>'
        html_header += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
        html_header += '<span aria-hidden="true">&times;</span>'
        html_header += '</button>'
        $('#modalHeader').html(html_header)
        var html_body = ""
        html_body += '<div class="row">'

        html_body += '<div class="col-12">'
        html_body += '<div class="form-group">'
        html_body += '<label for="inputNama" class="control-label">Nama Cuti</label>'
        html_body += '<input type="text" name="inputNama" id="inputNama" class="form-control" required="required" value="' + nama + '">'
        html_body += '</div>'
        html_body += '</div>'

        html_body += '</div>'
        $('#modalBody').html(html_body)
        var html_footer = ""
        html_footer += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
        html_footer += '<button type="button" class="btn btn-primary" onclick="ubahCuti(' + id + ')">Simpan</button>'
        $('#modalFooter').html(html_footer)
    }

    function ubahCuti(id) {
        var data = {
            id: id,
            nama: $('#inputNama').val(),
        }
        $.ajax({
            url: '<?php echo base_url(); ?>admin/dataCuti/ubahCuti',
            type: 'POST',
            data: data,
            beforeSend: function() {},
            success: function(response) {
                if (JSON.parse(response).status == 'success') {
                    alert('Berhasil Input')
                } else {
                    alert('Gagal Input')
                }
                $('#modal').modal('hide')
                getData()
            }
        })
    }
</script>