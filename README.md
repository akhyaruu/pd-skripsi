# Sistem Pendampingan Skripsi
Merupakan sistem informasi yang berguna untuk memantau progres skripsi dari mahasiswa yang bersangkutan. Dimana mahasiswa dapat mengetahui serta memantau sejauh mana progres skripsi yang ia lakukan kepada dosen pembimbing yang telah ditunjuk sebelumnya.

## Fitur

Adapun beberapa fitur dalam "Sistem Pendampingan Skripsi" ini yaitu:

- Login
- Register
- Penambahan dan pemantauan data tugas akhir
- Penjadwalan dan pemantauan progres bimbingan
- Chat konsultasi

## Cara Install
Clone repositori

    git clone https://github.com/akhyaruu/pd-skripsi.git

Pindah kedalam repositori folder

    cd pd-skripsi

Install semua dependency menggunakan composer

    composer install

Salin contoh file .env dan buat perubahan konfigurasi yang diperlukan di file .env tersebut

    cp .env.example .env

Generate application key yang baru

    php artisan key:generate


Jalankan migrasi database (**Setel koneksi database di .env sebelum dimigrasi**)

    php artisan migrate

Jalankan server lokal

    php artisan serve

Anda sekarang dapat mengakses server di http://127.0.0.1:8000/