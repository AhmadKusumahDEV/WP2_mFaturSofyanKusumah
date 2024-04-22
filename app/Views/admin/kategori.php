<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <a href="" class="btn btn-primary mb-3" datatoggle="modal" data-target="#kategoriBaruModal"><i class="fas fafile-alt"></i> Tambah Kategori</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    foreach ($kategori as $k) { ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $k['nama_kategori']; ?></td>
                            <td>
                                <a href="<?=
                                            base_url('buku/ubahBuku/') . $k['id_kategori']; ?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                                <a href="<?=
                                            base_url('buku/hapusbuku/') . $k['id_kategori']; ?>" onclick="return
confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $k['nama_kategori']; ?>
);" class="badge badge-danger"><i class="fas fa-trash"></i>
                                    Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Modal Tambah kategori baru-->
<!-- End of Modal Tambah Mneu -->