# Backend E-Commerce
## Install
Untuk memasang project ini maka dibutuhkan package-package yang ada di dalamnya. Ketik kode berikut di dalam cmd
```
composer install
```
Selanjutnya adalah membuat key. Ketik kode berikut di dalam cmd
```
php artisan key:generate
```
### Import Database
Untuk database-nya sudah ada di project-nya (e_commerce.sql)
### Migration
Untuk menggunakan migration, ketik kode berikut di dalam cmd
```
php artisan migrate --seed
```
## Start Project
Ketik kode berikut di dalam cmd
```
php artisan serve
```
## Data-data
1. User: 
- Username: ethan48
- Password: user
2. Admin:
- Username: admin
- Password: admin
## Cara Transaksi
1. Sebelum bertransaksi harus ada produk terlebih dahulu.
2. Setelah itu masukan produk ke dalam keranjang.
3. Lakukan transaksi dengan memilih produk yang ingin dibeli.