<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
                <form action="<?= base_url('buku/ubah'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?php echo $buku['id']; ?>">
                        <input type="text" class="form-control form-control-user" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku" value="<?= $buku['judul_buku']; ?>">
                    </div>
                    <div class="form-group">
                        <select name="id_kategori" class="form-control form-control-user">
                        <option value="<?= $buku['id_kategori'] ?>"><?= $kategori_convert['nama_kategori'] ?></option>
                            <?php
                            foreach ($kategori as $k) { ?>
                                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="pengarang" name="pengarang" placeholder="Masukkan nama pengarang" value="<?= $buku['pengarang']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit" value="<?= $buku['penerbit']; ?>">
                    </div>
                    <div class="form-group">
                        <select name="tahun" class="form-control form-control-user">
                            <option value="<?= $buku['tahun_terbit']; ?>"><?= $buku['tahun_terbit']; ?></option>
                            <?php
                            for ($i = date('Y'); $i > 1500; $i--) { ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="isbn" name="isbn" placeholder="Masukkan ISBN" value="<?= $buku['isbn']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok" value="<?= $buku['stok']; ?>">
                    </div>
                    <div class="form-group">
                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?php echo 'http://localhost:8080/' . $buku['image']; ?>" class="rounded mx-auto mb-3 d-blok" alt="...">
                            </picture>
                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Kembali" onclick="window.history.go(-1)">
                        <input type="submit" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Update">
                    </div>
                </form>
        </div>
    </div>
</div>