
# Reimbursement Claim App





## Description
Ini adalah aplikasi yang digunakan untuk melakukan claim penggantian atau reimbursement oleh pegawai pada perusahaan PT IT Indonesia (Boongan), pegawai melakukan pengajuan reimbursement dengan mengisi formulir pada website, Kemudian pihak HR akan melakukan pemeriksaan dan memberikan keputusan apakah reimbursementnya diterima atau ditolak. User dapat melihat status pengajuannya pada aplikasi.
## Role

- **Pegawai:** Dapat melakukan pengajuan, dan dapat memeriksa status claim
- **HR:** Dapat memeriksa dan menyetujui / menolak pengajuan
- **Finance:** Hanya Melihat data pengajuan yang sudah disetujui, kemudian menandai reimbursement yang sudah diterima


## User Example

- **Pegawai :**
```bash
Email : budi@it.com
Password : password
```
- **HR :**
```bash
Email : dewi@hr.com
Password : password
```
- **Finance :**
```bash
Email : rizky@finance.com
Password : password
```
## Tech Stack

**Client:** HTML, CSS, JS \
**Server:** PHP \
**Framework:** Laravel


## Installation

Untuk dapat menggunakannya lakukan langkah langkah berikut :

- Clone project dari github
```bash
  git clone https://github.com/aryadilas/reim.git
```
- Buat .env, copy dari .env-example    
- Buat database baru
- Edit config database pada file .env
- Lakukan Composer Install
```bash
  composer install
```
- Generate key
```bash
  php artisan key:generate
```
- Lakukan migrasi dan seeding
```bash
  php artisan migrate --seed
```
- Buat Symbolic Link
```bash
  php artisan storage:link
```
- Run Aplikasi
```bash
  php artisan serve
```
