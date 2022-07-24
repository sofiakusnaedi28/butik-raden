<!--sidebar end-->

    <!-- **************************************************************************************************************************************
    MAIN CONTENT
    ******************************************************************************************************************************************* -->
    <!--main content start-->
    <?php
                $id = $_SESSION['admin']['id_member'];
                $hasil = $lihat -> member_edit($id);
    ?>
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12 main-chart">
                    <h3>Keranjang Penjualan</h3>
                    <br>
                    <?php if (isset($_GET['success'])){?>
                    <div class="alert alert-success">
                        <p>Edit Data Berhasil !</p>
                    </div>
                    <?php }?>
                    <?php if (isset($_GET['remove'])){?>
                    <div class="alert alert-danger">
                        <p>Hapus Data Berhasil !</p>
                    </div>
                    <?php }?>
                    <div class="col-sm--4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4><i class="fa fa-search"> Cari Barang</i></h4>
                            </div>
                            <div class="panel-body">
                                <input type="text" id="cari" class="form-control" name="cari" plceholder="Masukan : Kode / Nama Barang  [ENTER]">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4><i class="fa fa-list"> Hasil Pencarian</i></h4>
                            </div>
                            <div class="panel-body">
                                <div id="hasil_cari"></div>
                                <div id="tunggu"></div>

                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="panel pamel-primary">
                            <div class="panel-heading">
                                <h4><i class="fa fa-shopping-cart"></i> Kasir 
                                <a href="fungsi/hapus/hapus.php?penjualan=jual" class="btn btn-danger pull-right">
                                    <b>RESET KERANJANG</b></a>
                                 </h4>
                            </div>
                            <div class="panel-body">
                                <div id="keranjang">
                                    <table class="table tanle-bordered">
                                        <tr>
                                            <td><b>Tanggal</b></td>
                                            <td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <td> NO</td>
                                                <td> Nama Barang</td>
                                                <td style="width:10%;"> Jumlah</td>
                                                <td style="width:20%;"> Total</td>
                                                <td> Kasir</td>
                                                <td> Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total_bayar=0; $no=1; $hasil_penjualan = $lihat -> penjualan();?>
                                            <?php foreach(@hasil_penjualan as $isi){;?>
                                            <tr>
                                                <td><?php echo $no;?></td>
                                                <td><?php echo $isi['nama_barang'];?></td>
                                                <td>
                                            <!-- aksi ke table penjualan -->
                                            <form method="POST" action="fungsi/editedit.php?jual=jual">
                                                    <input type="number" name="jumlah" value="<?php echo $isi['jumlah'];?>" class="form-control">
                                                    <input type="hidden" name="id" value="<?php echo $isi['id_penjualan'];?>" class="form-control">
                                                    <input type="hidden" name="id_barang" value="<?php echo $isi['id_barang'];?>" class="form-control">
                                                </td>
                                                <td>Rp.<?php echo number_format($isi['total']);?>,</td>
                                                <td><?php echo $isi['nm_member'];?></td>
                                                <td>
                                                    <button type="submibt" class="btn btn-warning">Update</button>
                                            </form>
                                            <!-- aksi ke table penjualan -->
                                                    <a href="fungsi/hapus/hapus.php?jual;=jual&id=<?php echo $isi['id_penjualan'];?>&brg=<?php echo $isi['id_barang'];?>
                                                    &jml=<?php echo $isi['jumlah']; ?>" class="btn btn-danger"><i class="fa fa-times"></i> 
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $hasil = $lihat -> jumlah(); ?>
                                            <div id="kasirnya">
                                                <table class="table table-stripped">
                                                    <?php
                                                    // proses bayar dan ke nota
                                                    if(!empty($_GET['nota'] == 'yes')) {
                                                        $total = $_POST['total'];
                                                        $bayar = $_POST['bayar'];
                                                        if(!empty($bayar))
                                                        {
                                                            $id_barang = $_POST['id_barang'];
                                                            $id_member = $_POST['id_member'];
                                                            $jumlah = $_POST['jumlah'];
                                                            $total = $_POST['total1'];
                                                            $tgl_input = $_POST['tgl_input'];
                                                            $periode = $_POST['periode'];
                                                            $jumlah_dipilih = count ($id_barang);

                                                            for($x=0;$x<$jumlah_dipilih;$x++){

                                                                $d = array($id_barang[$x],$id_member[$x],$jumlah[$x],$total[$x],$tgl_input[$x],$periode[$x]);
                                                                $sql = "INSERT INTO nota (id_barang,id_member,jumlah,total,tanggal_input,periode) VALUES(?,?,?,?,?,?";
                                                                $row = $config->prepare($sql);
                                                                $row->execute($d);

                                                                $stok = $hsl['stok'];
                                                                $idb = $hsl['id_barang'];

                                                                
                                                            }
                                                        }
                                                    }
                                                </table>
                                            </div>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>