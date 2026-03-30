# CRUD Food - Panduan Penggunaan

## ✅ Status Implementasi

CRUD Food telah berhasil diimplementasikan dengan fitur lengkap.

## 📋 Fitur yang Tersedia

### 1. **READ (Tampilkan)**

- Menampilkan daftar semua makanan dalam bentuk card grid
- Setiap card menampilkan: nama, deskripsi, harga, dan gambar
- Responsive design (mobile, tablet, desktop)

### 2. **CREATE (Tambah)**

- Form untuk menambah makanan baru
- Input fields: nama, deskripsi, harga, gambar
- Validasi server-side untuk semua input
- Preview gambar sebelum disimpan
- Penyimpanan gambar otomatis di `public/images/food`

### 3. **UPDATE (Edit)**

- Form untuk mengedit data makanan yang sudah ada
- Menampilkan data lama dan preview gambar baru
- Dapat mengganti gambar atau membiarkannya tetap
- Gambar lama akan dihapus otomatis saat diganti

### 4. **DELETE (Hapus)**

- Tombol hapus di setiap card
- Konfirmasi sebelum menghapus
- Gambar akan dihapus otomatis dari server

---

## 🛤️ Routes yang Tersedia

```
GET    /food              - Tampilkan daftar food (index)
GET    /food/create       - Form tambah food
POST   /food              - Simpan food baru
GET    /food/{id}/edit    - Form edit food
PUT    /food/{id}         - Update food
DELETE /food/{id}         - Hapus food
```

---

## 📁 Struktur File

```
app/
├── Models/
│   └── food.php              ✅ Model sudah lengkap
└── Http/Controllers/
    └── foodController.php    ✅ Controller dengan CRUD methods

database/
└── migrations/
    └── 2026_03_29_132546_food.php  ✅ Migration sudah ada

resources/views/food/
├── index.blade.php   ✅ List semua food
├── create.blade.php  ✅ Form tambah food
└── edit.blade.php    ✅ Form edit food

public/images/
└── food/             ✅ Folder untuk menyimpan gambar

routes/
└── web.php           ✅ Routes sudah dikonfigurasi
```

---

## 🚀 Cara Menggunakan

### 1. Migration Database

```bash
php artisan migrate
```

### 2. Akses Food CRUD

- Buka: `http://localhost/Restoran/food`
- Atau klik menu "food" di sidebar

### 3. Tambah Food Baru

- Klik tombol "Tambah Makanan"
- Isi form: nama, deskripsi, harga, gambar
- Klik "Simpan"

### 4. Edit Food

- Klik tombol "Edit" pada card food
- Ubah data yang diperlukan
- Klik "Update"

### 5. Hapus Food

- Klik tombol "Hapus" pada card food
- Konfirmasi penghapusan
- Data dan gambar akan dihapus

---

## 📝 Validasi

Semua input divalidasi:

- **Name**: Required, string, max 255 karakter
- **Description**: Required, string (unlimited)
- **Price**: Required, numeric, min 0
- **Image**: Optional, format JPEG/PNG/JPG/GIF, max 2MB

---

## 🎨 Fitur Tambahan

✨ **UI/UX Features:**

- Responsive design (mobile-friendly)
- Card hover effect
- Image preview untuk upload
- Toast alert untuk success/error
- Konfirmasi sebelum delete
- Format harga dengan Rupiah (Rp.)
- Truncate deskripsi di list view

---

## 📦 Dependencies

Sudah included di Laravel:

- Blade templating
- Form validation
- File upload handling
- Bootstrap CSS framework

---

## ⚙️ Troubleshooting

### Gambar tidak tersimpan?

- Pastikan folder `public/images/food` ada dan writable
- Check permission: `chmod -R 777 public/images`

### Form tidak ter-submit?

- Pastikan CSRF token di form
- Check validation errors di view

### Sidebar menu tidak aktif?

- Sidebar sudah dikonfigurasi untuk show "food" menu
- Active state akan otomatis highlight saat di halaman food

---

## 📞 Info Lebih Lanjut

Untuk import Food_Category atau relasi model lebih lanjut:

- Edit `app/Models/food.php` untuk menambah relationships
- Setup middleware untuk authorization jika diperlukan

---

**Created:** 30 Maret 2026
**Status:** ✅ Ready to Use
