<?php
declare(strict_types=1);

/*
 * Mini Application Advanced OOP
 * Domain: Sistem Peminjaman Alat Laboratorium Kampus
 * Nama:BIMA PUTRA FARDIANSYAH 
 * Nim:20251020037
 */

interface BisaDipinjam
{
    public function pinjam(): bool;
}

abstract class Alat implements BisaDipinjam
{
    protected string $kode;
    protected string $nama;
    protected bool $tersedia = true;

    public function __construct(string $kode, string $nama)
    {
        $this->kode = $kode;
        $this->nama = $nama;
    }

    // Setiap jenis alat wajib menyediakan informasi spesifik.
    abstract public function info(): string;

    public function getNama(): string
    {
        return $this->nama;
    }

    public function pinjam(): bool
    {
        if (!$this->tersedia) {
            return false;
        }

        $this->tersedia = false;
        return true;
    }
}

class Laptop extends Alat
{
    public function info(): string
    {
        return "Laptop [{$this->kode}] - {$this->nama}; cocok untuk praktikum pemrograman.";
    }

    // Overriding: perilaku pinjam dibuat lebih spesifik untuk laptop.
    public function pinjam(): bool
    {
        if (!$this->tersedia) {
            return false;
        }

        $this->tersedia = false;
        echo "Pemeriksaan kondisi laptop dilakukan sebelum peminjaman.\n";
        return true;
    }
}

class Mikroskop extends Alat
{
    public function info(): string
    {
        return "Mikroskop [{$this->kode}] - {$this->nama}; digunakan untuk pengamatan sampel.";
    }
}

class Proyektor extends Alat
{
    public function info(): string
    {
        return "Proyektor [{$this->kode}] - {$this->nama}; digunakan untuk presentasi.";
    }
}

class Petugas
{
    private string $nama;

    public function __construct(string $nama)
    {
        $this->nama = $nama;
    }

    public function getNama(): string
    {
        return $this->nama;
    }
}

class Peminjaman
{
    /** @var Alat[] Composition: Peminjaman menyimpan objek-objek Alat. */
    private array $daftarAlat = [];
    private Petugas $petugas;

    public function __construct(Petugas $petugas)
    {
        $this->petugas = $petugas;
    }

    public function tambahAlat(Alat $alat): void
    {
        $this->daftarAlat[] = $alat;
    }

    public function prosesPeminjaman(): void
    {
        echo "\n=== PROSES PEMINJAMAN ===\n";
        echo "Petugas: " . $this->petugas->getNama() . "\n";

        foreach ($this->daftarAlat as $alat) {
            $berhasil = $alat->pinjam();
            echo $alat->getNama() . ": " .
                ($berhasil ? "peminjaman berhasil" : "alat tidak tersedia") . "\n";
        }

        echo "Jumlah alat dalam daftar: " . count($this->daftarAlat) . "\n";
    }
}

// Polymorphism: fungsi menerima tipe umum Alat,
// tetapi method info() yang dijalankan mengikuti objek konkretnya.
function tampilkanInfo(Alat $alat): void
{
    echo "- " . $alat->info() . "\n";
}

// Demo aplikasi
echo "SISTEM PEMINJAMAN ALAT LABORATORIUM\n";
echo "===================================\n";

$laptop = new Laptop("LT-001", "Laptop Lenovo");
$mikroskop = new Mikroskop("MK-001", "Mikroskop Binokuler");
$proyektor = new Proyektor("PJ-001", "Proyektor Epson");

echo "\n=== DAFTAR ALAT ===\n";
$daftarAlat = [$laptop, $mikroskop, $proyektor];
foreach ($daftarAlat as $alat) {
    tampilkanInfo($alat);
}

$petugas = new Petugas("Andi");
$peminjaman = new Peminjaman($petugas);
$peminjaman->tambahAlat($laptop);
$peminjaman->tambahAlat($mikroskop);
$peminjaman->tambahAlat($proyektor);
$peminjaman->prosesPeminjaman();
