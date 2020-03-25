<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <br>
                    <h1>Data Buku</h1></br>

                    <form action="" method="get">
                        <div class="input-group mb-3">

                            <input type="text" class="form-control" placeholder="Masukan pencarian..." name="keyword">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="button-addon2"> Cari </button>
                            </div>
                    </form>
                </div>


                <br><a href="<?= base_url('Buku/tambah')?>" class="btn btn-primary"> Tambah Data </a></br>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <?php
                if($this->session->flashdata('sukses') == TRUE)
                { ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data buku <strong> Berhasil </strong> <?= $this->session->flashdata('sukses'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php }
                ?>
                <table class="table">
                    <tr>
                        <th>Judul Buku</th>
                        <th colspan="3">Aksi</th>
                    </tr>
                    
                    <?php foreach ($buku as $b) : ?>
                    <tr>
                        <td><?= $b->judul ?></td>
                        <td>
                            <a href="<?= base_url('Buku/edit/'). $b->id_buku ?>">
                                <button type="button" class="btn btn-outline-warning">Edit</button>
                            </a>
                        </td>
                        <td>
                            <a href="<?= base_url('Buku/detail/'). $b->id_buku ?>">
                                <button type="button" class="btn btn-outline-info">Detail</button>
                            </a>
                        </td>
                        <td>
                            <a href="<?= base_url('Buku/hapus/'). $b->id_buku ?>">
                                <button type="button" class="btn btn-outline-danger">Hapus</button>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div> 
    </div>
</div>