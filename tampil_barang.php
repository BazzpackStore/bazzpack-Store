<h2>Produk Bazzpack</h2>
<?php
if(isset($_POST['btn_delete'])) {
    echo 'Processing Delete...<hr>';

    // delete file
    // select gambar dari tb_barang
    $s = "SELECT gambar FROM tb_barang WHERE kode_barang = '$_POST[btn_delete]'";
    $q = mysqli_query($cn, $s) or die(mysqli_error($cn));
    $d = mysqli_fetch_assoc($q);
    $filename = 'img/' . $d['gambar'];
    if (unlink($filename)) {
    // delete data dari database
    $s = "DELETE FROM tb_barang WHERE kode_barang = '$_POST[btn_delete]'";
    echo "$s<hr>";
    $q = mysqli_query($cn, $s) or die(mysqli_error($cn));
    echo 'Data berhasil dihapus.<hr>';
    echo "<a href='index.php'>Kembali</a>";
    } else {
        echo 'Data gagal dihapus.<hr>';
    }


    exit;
}

$s = "SELECT a.*,
 (
    SELECT COUNT(1) FROM tb_order WHERE kode_barang=a.kode_barang) jumlah_order 
    FROM tb_barang a



";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));

$jumlah_barang = mysqli_num_rows($q);

if(mysqli_num_rows($q)) {
    echo 'barang ada sebanyak ' . $jumlah_barang;

    // looping dg while
    $divs = '';
    while ($d = mysqli_fetch_assoc($q)) {

        // teknik debugging
        // echo '<pre>';
        // print_r($d);
        // echo '</pre>';
        // exit;


       // echo '<br>barang zzz';

       // tampilkan form delete jika tidak ada order
       $form_delete = $d['jumlah_order'] ? "jumlah_order: $d[jumlah_order]" : "
       <form method=post>
        <button name=btn_delete value=$d[kode_barang]>Delete</button>
       </form>
       ";

       $btn_edit = $username ? "<a href='?kode_barang=$d[kode_barang]'><button>Edit</button></a>" : '';
        $btn_delete = $username ? $form_delete : '';
       
        // tampil sebagai card
        $divs .= "
        <div class=card>
        <div>$d[nama_barang]</div>
        <img src = 'img/$d[gambar]' class='gambar' />
        <div>$d[harga_jual]</div>
        <a href='order.php?kode_barang=$d[kode_barang]'>
        <button>Beli</button>
         </a>

         $btn_edit
         $btn_delete
        </div>
        ";
    }
    echo "<div style='display: flex; gap: 15px; flex-wrap:wrap'>$divs</div>";


    include 'form-add.php';
  
    // tambah barang
    echo !$username ? '' : $form_add;
} else {
    echo 'barang kosong';
}