<?php
if (isset($_POST['btn_order'])) {
    echo 'Processing Order...';
    // echo 'Anda Mengetik Tombol Order';

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    // echo "<br>kode_barang: $kode_barang "; 

    $s = "INSERT INTO tb_order (
    kode_barang,
    nama_pembeli,
    nomor_whatsapp,
    jumlah_pesanan
    ) VALUES (
    '$kode_barang',
    '$_POST[nama_pembeli]',
    '$_POST[nomor_whatsapp]',
    '$_POST[jumlah_pesanan]'
    )";

    // echo $s;

 $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

echo '<hr>Data Baru Berhasil Disimpan.<hr>';

// cari data barang
$s = "SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang'";
$q =mysqli_query($cn, $s) or die(mysqli_error($cn));

$d = mysqli_fetch_assoc($q);

$date_system = date('d-F-Y H:i:s');

 // diteruskan ke whatsapp
$no_penjual = '628987435915';
$text_wa = "Hai, saya $_POST[nama_pembeli], %0a%0asaya ingin membeli *$d[nama_barang]*, dengan jumlah pesanan *$_POST[jumlah_pesanan] $d[satuan]*. %0a%0aMohon segera di follow-up, terimakasih. _[$date_system]_";
  

$link_wa = "https://api.whatsapp.com/send?phone=$no_penjual&text=$text_wa";

echo $link_wa;

echo "
 <script>location.replace('$link_wa')</script>
";

exit;
} else {
    echo 'Tampilan Awal Form';
}