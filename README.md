# Mini Application Advanced OOP
## Sistem Peminjaman Alat Laboratorium Kampus

### 1. Masalah
Laboratorium kampus memiliki berbagai alat yang dapat dipinjam mahasiswa. Setiap alat memiliki informasi berbeda, tetapi semua alat perlu mendukung proses peminjaman. Program ini memodelkan kebutuhan tersebut menggunakan konsep Advanced OOP PHP.

### 2. Kandidat class dan desain
- `Alat` — abstract parent class yang menyimpan kode, nama, dan status ketersediaan.
- `Laptop` — subclass `Alat` untuk perangkat laptop.
- `Mikroskop` — subclass `Alat` untuk alat pengamatan.
- `Proyektor` — subclass `Alat` untuk perangkat presentasi.
- `Petugas` — menyimpan nama petugas laboratorium.
- `Peminjaman` — mengelola daftar alat yang akan dipinjam dan petugas yang melayani.

### 3. Penerapan konsep Advanced OOP
1. **Inheritance:** `Laptop`, `Mikroskop`, dan `Proyektor` menggunakan `extends Alat`.
2. **Overriding:** setiap subclass menyediakan implementasi `info()` yang berbeda. `Laptop` juga mengubah implementasi `pinjam()`.
3. **Polymorphism:** fungsi `tampilkanInfo(Alat $alat)` dapat menerima berbagai objek turunan `Alat`; hasil `info()` mengikuti jenis objeknya.
4. **Abstraction:** `Alat` adalah abstract class dan mewajibkan subclass menyediakan method `info()`.
5. **Interface:** interface `BisaDipinjam` menetapkan kontrak method `pinjam(): bool`. `Alat` mengimplementasikan interface ini.
6. **Composition:** objek `Peminjaman` memiliki objek `Petugas` dan menyimpan beberapa objek `Alat` dalam daftar.

### 4. Cara menjalankan
1. Pastikan PHP CLI sudah terpasang.
2. Buka terminal di folder yang berisi `index.php`.
3. Jalankan perintah: `php index.php`
4. Bandingkan hasil terminal dengan file `demo_output.txt` dan `screenshot_output.png`.

Tidak memerlukan database, Laravel, atau paket tambahan.

### 5. Refleksi
Konsep Advanced OOP membantu memisahkan tanggung jawab program. Abstract class menyatukan struktur umum alat, sedangkan subclass memberi detail sesuai jenis alat. Polymorphism membuat daftar alat dapat ditampilkan dengan satu fungsi tanpa `if/else` berdasarkan nama class. Interface memisahkan kontrak kemampuan meminjam dari detail objek. Composition membuat pengelolaan peminjaman dapat menggunakan objek alat dan petugas sebagai komponen. Desain ini masih sederhana dan dapat dikembangkan, misalnya dengan validasi peminjam atau pencatatan tanggal pinjam, tanpa harus memakai database untuk tugas ini.
