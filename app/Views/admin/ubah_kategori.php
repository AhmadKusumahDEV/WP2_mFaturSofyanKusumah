<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?php?>
                <form action="<?= base_url('kategori/ubah'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?= $kategori['id_kategori']; ?>">
                        <input type="text" class="form-control form-control-user" id="kategori" name="kategori" placeholder="Masukkan Kategori Buku" value="<?= $kategori['nama_kategori']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Kembali" onclick="window.history.go(-1)">
                        <input type="submit" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Update">
                    </div>
                </form>
            <?php  ?>
        </div>
    </div>
</div>