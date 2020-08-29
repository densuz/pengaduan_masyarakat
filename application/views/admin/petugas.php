<!-- BREADCRUMB-->
<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">Kamu sedang berada di :</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Petugas</li>
                            </ul>
                        </div>
                        <button class="au-btn au-btn-icon au-btn--green" data-toggle="modal" data-target="#mediumModal">
                            <i class="zmdi zmdi-plus"></i>Tambah Petugas</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<!-- STATISTIC-->
<section class="statistic">

</section>
<!-- END STATISTIC-->

<!-- Content -->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pengaduan</h5>
                        <div class="table-responsive">
                            <?= $this->session->flashdata('message'); ?>
                            <table class="table table-bordered" id="tabelPengaduan" width="100%" cellspacing="0">
                                <thead style="font-weight: bold;">
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Judul Laporan</th>
                                        <th>Kategori</th>
                                        <th>Foto</th>
                                        <th>Tanggal Pengaduan</th>
                                        <th width="120px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pengaduan as $p) : ?>
                                        <tr>
                                            <td><?= $p->id_pengaduan ?></td>
                                            <td><?= $p->judul_laporan ?></td>
                                            <td><?= $p->kategori ?></td>
                                            <td><img src="<?= base_url('assets/img/pengaduan/') . $p->image ?>"' width=' 100' height='100'></td>
                                            <td><?= date('d F Y', $p->tgl_pengaduan) ?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <a href="#" class="btn btn-success tmbl-lihat" data-id="<?= $p->id_pengaduan; ?>" data-judul="<?= $p->kategori; ?>" data-judul="<?= $p->judul_laporan; ?>" data-isi="<?= $p->isi_laporan; ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-warning tmbl-edit" data-id="<?= $p->id_pengaduan; ?>" data-judul="<?= $p->kategori; ?>" data-judul="<?= $p->judul_laporan; ?>" data-isi="<?= $p->isi_laporan; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger tmbl-hapus" data-id="<?= $p->id_pengaduan; ?>">
                                                    <i class="fas fa-trash-alt"></i>
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
<!-- tambah pengaduan -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulTambah">Buat Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <?= form_open_multipart('masyarakat/tambah') ?>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Kategori</label>
                    <select class="form-control" name="kategori" id="kategori">
                        <?php
                        foreach ($kategori as $k) : ?>
                            <option><?= $k->nama_kategori ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Judul Laporan</label>
                    <input type="text" class="form-control" name="judul_laporan" id="exampleFormControlInput1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Isi Laporan</label>
                    <textarea class="form-control" name="isi_laporan" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Masukkan Gambar</label>
                    <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                </div>
                <div class="form-group">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Pengaduan</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- end tambah pengaduan -->

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
                <form method="POST" action="<?= base_url('masyarakat/update'); ?>">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kategori</label>
                        <select class="form-control" name="kategori" id="kategori" disabled>
                            <option><?= $p->kategori ?></option>
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
                        <img src="<?= base_url('assets/img/pengaduan/') . $p->image ?>" alt="" width="200px">
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <input type="hidden" name="id" class="id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end lihat pengaduan -->

<!-- edit pengaduan -->
<div class="modal fade" id="ubahPengaduan" tabindex="-1" aria-labelledby="judulUbah" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulUbah">Ubah Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form method="POST" action="<?= base_url('masyarakat/update'); ?>">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kategori</label>
                        <select class="form-control kategori" name="kategori" id="kategori">
                            <?php
                            foreach ($kategori as $k) : ?>
                                <option><?= $k->nama_kategori ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Judul Laporan</label>
                        <input type="text" class="form-control judul_laporan" name="judul_laporan" id="exampleFormControlInput1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Isi Laporan</label>
                        <textarea class="form-control isi_laporan" name="isi_laporan" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Masukkan Gambar</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <div class="modal-footer">
                            <input type="hidden" name="id" class="id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end edit pengaduan -->

<!-- Delete Pengaduan-->
<form action="<?= base_url('masyarakat/hapus'); ?>" method="post">
    <div class="modal fade" id="deletePengaduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pengaduan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="exampleFormControlInput1">Apa anda yakin ingin menghapus pengaduan ini?</label>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Delete Pengaduan-->