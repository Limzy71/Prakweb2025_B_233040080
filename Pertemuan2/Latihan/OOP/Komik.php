<?php

require_once __DIR__ . '/Produk.php';

class Komik extends Produk
{
  public $jumlahHalaman;

  public function __construct($judul, $penulis, $penerbit, $harga, $jumlahHalaman)
  {
    parent::__construct($judul, $penulis, $penerbit, $harga);
    $this->jumlahHalaman = $jumlahHalaman;
  }

  public function getInfoProduk()
  {
    $str = "Komik: " . parent::getLabel() . " | (Rp. " . $this->harga . ") - ($this->jumlahHalaman) Halaman";
    return $str;
  }
}
