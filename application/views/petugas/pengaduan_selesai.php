<!-- Content -->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pengaduan Selesai</h5>
                        <form action="<?= base_url('sistem/cetak_xls') ?>">
                            <button class="btn btn-primary tmbl-excel" style="float: right;">Export Excel</button>
                        </form>
                        <form action="<?= base_url('sistem/cetak_pdf') ?>">
                            <button class="btn btn-primary tmbl-pdf" style="float: right; margin-right:10px; margin-bottom:20px">Export PDF</button>
                        </form>
                        <div class="table-responsive">
                            <?= $this->session->flashdata('message'); ?>
                            <table class="table table-bordered" id="tabelPengaduan" width="100%" cellspacing="0">
                                <thead style="font-weight: bold;">
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Judul Laporan</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Tanggal Pengaduan</th>
                                        <th width="130px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pengaduan as $p) : ?>
                                        <tr>
                                            <td><?= $p['id_pengaduan'] ?></td>
                                            <td><?= $p['judul_laporan'] ?></td>
                                            <td><?= $p['kategori'] ?></td>
                                            <td><?= $p['status'] ?></td>
                                            <td><?= date('d F Y', $p['tgl_pengaduan']) ?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <a href="#" class="btn btn-success tmbl-lihat" data-id="<?= $p['id_pengaduan']; ?>" data-kategori="<?= $p['kategori']; ?>" data-judul="<?= $p['judul_laporan']; ?>" data-isi="<?= $p['isi_laporan']; ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Of Content -->

<!-- Modal -->
<!-- lihat pengaduan -->
<div class="modal fade" id="lihatPengaduan" tabindex="-1" aria-labelledby="judulUbah" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulUbah">Lihat Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kategori</label>
                        <select class="form-control" name="kategori" id="kategori" disabled>
                            <option><?= $p['kategori'] ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Judul Laporan</label>
                        <input type="text" class="form-control judul_laporan" name="judul_laporan" id="exampleFormControlInput1" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Isi Laporan</label>
                        <textarea class="form-control isi_laporan" name="isi_laporan" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Gambar</label> <br>
                        <img src="<?= base_url('assets/img/pengaduan/') . $p['image'] ?>" alt="" width="200px">
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <input type="hidden" name="id" class="id">
                            <button type="button" class="btn btn-secondary">Tutup</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end lihat pengaduan -->