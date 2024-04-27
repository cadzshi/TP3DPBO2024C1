# TP3DPBO2024C1

## Janji

Saya Sabila Rosad NIM 2106000 mengerjakan Tugas Praktikum 3 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan Aamiin.

## Soal

Buatlah program menggunakan bahasa pemrograman PHP dengan spesifikasi sebagai berikut:

- Tema program bebas, Namun tidak boleh mengadaptasi tema program ormawa seperti pada modul ini
- Menggunakan minimal 3 buah tabel (kelas)
- Terdapat proses Create, Read, Update, dan Delete data pada setiap tabel
- Minimal Memiliki fungsi pencarian dan pengurutan data (kata kunci bebas) pada salah satu tabel
- Menggunakan template/skin form tambah data dan ubah data yang sama
- 1 tabel pada database ditampilkan dalam bentuk bukan tabel, 2 tabel atau lebih sisanya ditampilkan dalam bentuk tabel (seperti contoh saat praktikum)
  Menggunakan template/skin tabel yang sama untuk menampilkan tabel

## Desain Database
![Desain DB](https://github.com/cadzshi/TP3DPBO2024C1/assets/100210168/62b064ba-80eb-4243-a7d8-b129d4eb9f4c)

## Alur dan Dokumentasi

- Home

  - User dapat melihat daftar barang yang ada dalam bentuk card
  - User dapat melakukan sorting daftar barang berdasarkan nama secara Ascending ataupun Descending, dengan memilih list sorting lalu klik tombol Sort
  - User dapat mengklik salah satu daftar barang yang nantinya akan diarahkan ke halaman Detail Barang
  - User dapat melakukan Searching dengan mengisi field search "cari barang" yang ada di kanan atas

- Tambah Barang

  - Merupakan halaman untuk user menambahkan daftar barang
  - User akan diarahkan ke form Menambahkan Barang
  - User dapat mengisi data sesuai kebutuhan
  - Jika sudah, klik tombol "Add"
  - Maka user akan dikembalikan ke halaman Home dan data yang ditambahkan akan tampil
  - Jika user klik tombol "Cancel" maka akan dikembalikan ke halaman Home

- Daftar jenis

  - Merupakan halaman yang berisikan jenis-jenis keyboard atau mouse yang berbentuk table

- Daftar Merk

  - Merupakan halaman yang berisikan Merk dari keyboard atau mouse yang berbentuk table

- Detail Barang
  - Merupakan halaman yang menampilkan detail data dari suatu barang
  - User dapat mengupdate data yang telah ada:
    - User klik tombol "Ubah Data"
    - Maka user akan diarahkan ke form Update Barang
    - Ubah data sesuai dengan kebutuhan
    - Jika sudah maka klik tombol "Update"
    - User akan dikembalikan ke halaman Home, dan data akan terupdate
  - User dapat menghapus data yang telah ada:
    - User klik tombol "Hapus Data"
    - Maka user akan dikembalikan ke halaman Home dan data akan terhapus
