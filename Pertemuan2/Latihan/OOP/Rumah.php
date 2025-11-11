<?php
class Rumah {
  public $warna, $jumlahkamar, $jumlahJendela;
  public function __construct($warna, $jumlahkamar, $jumlahJendela) {
    $this->warna = $warna;
    $this->jumlahkamar = $jumlahkamar;
    $this->jumlahJendela = $jumlahJendela;
  }

  public function kunciPintu() {
    return "Pintu sudah dikunci!";
  }
}

$rumahSaya = new Rumah("Biru", 3, 5);
$rumahTetangga = new Rumah("Merah", 4, 6);

echo "Warna rumah saya: " . $rumahSaya->warna;
echo "<br>";
echo "Jumlah kamar di rumah saya: " . $rumahSaya->jumlahkamar;
echo "<br>";
echo "Jumlah jendela di rumah saya: " . $rumahSaya->jumlahJendela;
echo "<br>";
echo $rumahSaya->kunciPintu();