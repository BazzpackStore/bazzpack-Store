<?php

$get_kode_barang = $_GET['kode_barang']?? '';


// handler edit | add
if (isset($_POST['btn_add']) || isset($_POST['btn_update'])) {
    echo 'tombol ADD atau UPDATE di klik<hr>';

// handler untuk fiile
if (isset($_FILES['gambar'])) {
    $kode_barang = $_POST['kode_barang'];
    $file_baru = strtolower($kode_barang) . '.jpg';
    echo "handler untuk gambar: $file_baru<hr>";
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';

    // save file_baru
    echo "Save file_baru: $file_baru<hr>";
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $lokasi_file_baru = "img/$file_baru";
    if (move_uploaded_file($tmp_name, $lokasi_file_baru)) {

    $upload_sukses = true;
} else {
    $upload_sukses = false;
 echo 'Gagal upload file_baru<hr>';
    }
}

if (isset($_POST['btn_add'])) {
    $s = "INSERT INTO tb_barang (
    kode_barang,
    nama_barang,
    gambar,
    harga_jual,
    harga_beli,
    satuan,
    kategori,
    stok
    ) VALUES (
    '$_POST[kode_barang]',
    '$_POST[nama_barang]',
    '$file_baru',
    '$_POST[harga_jual]',
    '$_POST[harga_beli]',
    '$_POST[satuan]',
    '$_POST[kategori]',
    '$_POST[stok]'
    )";
     echo 'tombol ADD di klik: <hr><pre>' . $s . '</pre><hr>';
 } elseif (isset($_POST['btn_update'])) {
    $sql_file_baru = $upload_sukses ? "gambar = '$file_baru', " : '';

     $s = "UPDATE tb_barang SET 
        nama_barang = '$_POST[nama_barang]',
        $sql_file_baru
        harga_jual = '$_POST[harga_jual]',
        harga_beli = '$_POST[harga_beli]',
        satuan = '$_POST[satuan]',
        kategori = '$_POST[kategori]',
        stok = '$_POST[stok]'


     WHERE kode_barang = '$get_kode_barang'
     ";
     echo 'tombol UPDATE di klik: <hr>' . $s . '<hr>';
     }
 
     // execute query ADD | UPDATE
     $q = mysqli_query($cn, $s) or die(mysqli_error($cn));
     echo 'query berhasil dijalankan<hr>';
     echo "<a href='index.php'>Kembali</a>";
     exit;
    }


if ($get_kode_barang) {
    // MODE UPDATE
    $required_file = '';
    $judul = 'Edit Barang | <a href="index.php">Tambah Barang</a>';
    $kode_barang_readonly = 'readonly';
    $btn_caption = 'Update';;

    $s = "SELECT * FROM tb_barang WHERE kode_barang='$get_kode_barang'";
    $q = mysqli_query($cn, $s) or die(mysqli_error($cn));
    $d = mysqli_fetch_assoc($q);

    $btn_name = 'btn_update';
} else {
    // MODE TAMBAH
    $required_file = 'required';
    $judul = 'Tambah Barang';
    $kode_barang_readonly = '';
    $btn_caption = 'Add';
    $img = '';
    $btn_name = 'btn_add';
}

$nama_barang = $d['nama_barang'] ?? '';
    $gambar = $d['gambar'] ?? '';
    $harga_jual = $d['harga_jual'] ?? '';
    $harga_beli = $d['harga_beli'] ?? '';
    $satuan = $d['satuan'] ?? '';
    $kategori = $d['kategori'] ?? '';
    $stok = $d['stok'] ?? '';

    $img =  !$gambar ? '' : "<img src='img/$gambar' class=gambar />";


$form_add = "
    <form method=post enctype='multipart/form-data' class='card form-add'>
    <h3>$judul</h3>
    <input required type=text name=kode_barang value='$get_kode_barang' $kode_barang_readonly placeholder='Kode Barang'>
    <input required type=text name=nama_barang placeholder='Nama Barang' value='$nama_barang'>
    $img
    <input $required_file type=file name=gambar accept='.jpg,.png' value='$gambar'>
    <input required type=number name=harga_jual placeholder='Harga Jual' value='$harga_jual'>
    <input required type=number name=harga_beli placeholder='Harga Beli' value='$harga_beli'>
    <input required type=number name=satuan placeholder='Satuan' value='$satuan'>
    <input required type=number name=kategori placeholder='Kategori'value='$kategori'>
    <input required type=number name=stok placeholder='Stok' value='$stok'>
      
    <button name=$btn_name>$btn_caption</button>
    </form>
    ";