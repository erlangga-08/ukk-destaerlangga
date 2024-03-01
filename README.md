# kasir-codeigniter4
Aplikasi ini merupakan contoh project uji kompetensi program keahlian Rekayasa Perangkat Lunak tahun 2023/2024

# Fitur
1. Halaman Login 
2. Dashboard Admin
3. Kelola data satuan, kategori, produk, pengguna
4. Halaman Transaksi Penjualan
5. Laporan stok dan pendapatan

# Download dan Instalasi
1. Jalankan CMD / Terminal
2. Jalankan perintah : 
    <code>
    git clone https://github.com/destaerlangga/ukk-destaerlangga.git
    </code>
3. Lakukan update dengan perintah 
   composer update
4. Ganti file env menjadi .env
5. Seting :
   <code> 
   CI_ENVIRONMENT = development atau production
   app.baseURL = 'http://localhost:8080'
   
   database.default.hostname = localhost
   database.default.database = db_kasir
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
    </code>
# Menjalankan aplikasi
1. Buka terminal
2. Jalankan perintah
   php spark serve
3. Buka browser, akeses URL
   http://localhost:8080
