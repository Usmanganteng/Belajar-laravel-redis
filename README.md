<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<b>Requirement/Persyaratan</b>
---
> #### Php versi 8
>> - Cara menginstal php dalam bahasa indonesia : <a href="https://youtu.be/Uw3ZGIMvIdA?si=mBVZ-lBnoCilASzo">install php
>> - Cara menginstal php dalam bahasa inggris : <a href="https://youtu.be/MPRLUd8Pmyo?si=FqN54nVr4duH4Keg"> install php
-----
> #### Laravel versi 10.2.9
>> - cara menginstal laravel yang versi yang sama : 
>>   ```
>>   composer create-project laravel/laravel=v10.2.9 belajar-laravel-eloquent
>>   ```
---
> #### redis versi terbaru
>> - Cara menginstal redis: <a href="https://youtu.be/188Fy-oCw4w?si=YI3pJ9IwGEuzuJXn">install php
>> - jika sudah menginstall redis kalian bisa langsung kembali ke project laravel-redis yang sudah di buat
>> - dan tambahkan predis/predis dengan cara menginstall di terminal seprti ini :
>> ```
>> composer require predis/predis
>> ```
---
<b>Materi/Pembahasan</b>
---
> #### Apa itu laravel redis
> - Laravel Redis adalah integrasi Redis dengan framework PHP populer bernama Laravel. Redis adalah database berkinerja tinggi yang disimpan di memori yang digunakan untuk menyimpan data dalam bentuk key-value. Laravel menyediakan dukungan bawaan untuk Redis, yang memungkinkan Anda menggunakan Redis sebagai sistem penyimpanan cache, sistem antrean (queue), atau bahkan sebagai database utama.
> - Dengan menggunakan Laravel Redis, Anda dapat memanfaatkan fitur-fitur Redis seperti caching, pub/sub (publish/subscribe), dan operasi-operasi berkinerja tinggi lainnya dalam aplikasi Laravel Anda. Ini memungkinkan aplikasi Anda menjadi lebih cepat dan efisien dalam mengelola data dan kinerja sistem secara keseluruhan.
---
> #### Predis
> - Predis adalah klien PHP untuk Redis yang memungkinkan aplikasi PHP untuk berinteraksi dengan server Redis. Ini adalah pustaka PHP yang memungkinkan Anda untuk melakukan operasi-operasi Redis melalui kode PHP dengan mudah.
> - Dengan menggunakan Predis, Anda dapat terhubung ke server Redis dari aplikasi PHP Anda, lalu melakukan operasi seperti menyimpan dan mengambil data, mengatur key-value, melakukan operasi pada tipe data khusus Redis seperti set dan daftar, serta melakukan operasi Redis lainnya.
> - Predis menyediakan antarmuka yang mudah digunakan dan dukungan yang kuat untuk berbagai fitur Redis. Ini adalah salah satu pilihan yang populer untuk integrasi Redis dengan aplikasi PHP, termasuk aplikasi yang dibangun dengan kerangka kerja PHP seperti Laravel.
---
> #### List
> - Dalam konteks Laravel Redis, "list" merujuk pada salah satu tipe data yang didukung oleh Redis, yaitu "lists" (daftar). List adalah kumpulan nilai yang diurutkan berdasarkan urutan penambahan. Ini mirip dengan array di banyak bahasa pemrograman, tetapi dengan fitur khusus yang dioptimalkan untuk kinerja dan fungsionalitas.
> - Dalam konteks Laravel, Anda dapat menggunakan list Redis untuk berbagai tujuan, seperti mengimplementasikan sistem antrean (queue), memperbarui log kejadian, atau menyimpan data yang memerlukan penanganan urutan tertentu.
> - Laravel menyediakan API yang nyaman untuk berinteraksi dengan list Redis. Anda dapat menambahkan nilai ke daftar, menghapus nilai dari daftar, mendapatkan nilai dari daftar berdasarkan indeks, dan melakukan operasi lainnya menggunakan fasilitas yang disediakan oleh Laravel Redis. Dengan memanfaatkan list Redis, Anda dapat membangun aplikasi yang efisien dan skalabel dengan mudah di dalam ekosistem Laravel.
> - contoh sintaks daari list :
> ```
>  public function testList()
>    {
>        Redis::del("names");
>
>        Redis::rpush("names", "Lulu");
>        Redis::rpush("names", "Aldizar");
>        Redis::rpush("names", "Ilham");
>
>        $response = Redis::lrange("names", 0, -1);
>        self::assertEquals(["Lulu", "Aldizar", "Ilham"], $response);
>
>        self::assertEquals("Lulu", Redis::lpop("names"));
>        self::assertEquals("Aldizar", Redis::lpop("names"));
>        self::assertEquals("Ilham", Redis::lpop("names"));
>
>    }
> ```
---
> #### set
> - Dalam konteks Redis, "set" merujuk pada salah satu tipe data yang tersedia di Redis yang disebut "Sets". Set adalah kumpulan nilai unik yang tidak diurutkan. Ini berarti setiap anggota dalam set harus unik, dan urutan di mana mereka disimpan tidak diperhatikan.
> - Set di Redis mendukung berbagai operasi seperti menambahkan anggota baru, menghapus anggota, memeriksa keanggotaan anggota tertentu, melakukan operasi himpunan (seperti gabungan, irisan, dan perbedaan antara dua set), dan banyak lagi.
> - Dalam konteks Laravel Redis, Anda dapat menggunakan set Redis sebagai cara untuk menyimpan dan mengelola koleksi data yang unik dalam aplikasi Laravel Anda. Laravel menyediakan API yang mudah digunakan untuk berinteraksi dengan set Redis, sehingga Anda dapat melakukan operasi-operasi seperti menambahkan anggota baru ke set, menghapus anggota dari set, atau melakukan operasi himpunan lainnya dengan mudah dalam kode Laravel Anda.
---
> #### sorted set
> - Sorted Set adalah tipe data lain yang didukung oleh Redis. Ini mirip dengan Set, tetapi setiap anggota dalam Sorted Set memiliki skor numerik yang terkait dengannya. Sorted Set diurutkan berdasarkan skor, bukan berdasarkan urutan alami.
> - Penerapan Sorted Set dalam Laravel menggunakan Redis mengikuti langkah-langkah yang mirip dengan penerapan Set. Berikut adalah contoh cara menggunakannya:
> - Menggunakan Sorted Set Redis: Berikut adalah contoh penggunaan Sorted Set Redis dalam kode Laravel:
> ```
>use Illuminate\Support\Facades\Redis;
>
>// Menambahkan anggota baru ke sorted set dengan skor
>Redis::zadd('leaderboard', 100, 'player1');
>Redis::zadd('leaderboard', 90, 'player2');
>Redis::zadd('leaderboard', 80, 'player3');
>
>// Menambahkan skor tambahan untuk anggota sorted set
>Redis::zincrby('leaderboard', 10, 'player1');
>
>// Mendapatkan skor dari anggota tertentu
>$score = Redis::zscore('leaderboard', 'player1');
>
>// Mendapatkan jumlah anggota dalam sorted set
>$count = Redis::zcard('leaderboard');
>
><// Mendapatkan leaderboard dengan 3 anggota teratas
>$leaderboard = Redis::zrevrange('leaderboard', 0, 2, 'WITHSCORES');
>
> ```
> - Dalam contoh di atas, kita menggunakan Sorted Set untuk mempertahankan leaderboard game dengan nama pemain sebagai anggota dan skor mereka sebagai skor terkait. Kemudian, kita dapat melakukan berbagai operasi seperti menambahkan anggota baru, menambahkan skor ke anggota yang ada, mendapatkan skor anggota tertentu, menghitung jumlah anggota dalam sorted set, dan mendapatkan leaderboard dengan jumlah tertentu dari anggota teratas, Dengan demikian, Anda dapat menggunakan Sorted Set Redis dalam aplikasi Laravel Anda untuk mempertahankan data yang diurutkan berdasarkan skor numerik terkait dengan setiap anggota.
---
> #### geo point
> - Geo Point adalah pasangan koordinat longitude dan latitude yang digunakan untuk merepresentasikan lokasi geografis dalam sistem koordinat geografis. Dalam konteks Redis, Geo Point merujuk pada tipe data yang disebut "Geospatial" yang diperkenalkan dalam Redis versi 3.2.
> - Redis Geo adalah tipe data yang memungkinkan Anda untuk menyimpan data geografis, seperti koordinat titik (longitude dan latitude), di dalam database Redis. Anda dapat menggunakan Geo untuk menyimpan informasi tentang lokasi fisik dan melakukan operasi berbasis lokasi seperti menghitung jarak antara dua titik, menemukan titik dalam jarak tertentu dari titik referensi, dan lain-lain.
> - Berikut adalah contoh penggunaan Geo Point dalam Redis:
> ```
>use Illuminate\Support\Facades\Redis;
>
>// Menambahkan Geo Point ke key 'locations'
>Redis::geoadd('locations', -122.4194, 37.7749, 'San Francisco');
>Redis::geoadd('locations', -74.0060, 40.7128, 'New York');
>
>// Mendapatkan jarak antara dua Geo Point
>$distance = Redis::geodist('locations', 'San Francisco', 'New York', 'km');
>
>// Mendapatkan titik dalam jarak tertentu dari titik referensi
>$nearbyLocations = Redis::georadiusbymember('locations', 'San Francisco', 200, 'km');
>
> ```
> - Dalam contoh di atas, kita menambahkan dua Geo Point yang mewakili lokasi San Francisco dan New York ke dalam key 'locations'. Kemudian, kita dapat menggunakan operasi Geo Redis seperti geodist untuk menghitung jarak antara dua Geo Point, atau georadiusbymember untuk menemukan Geo Point lain dalam jarak tertentu dari titik referensi.
> - Dengan menggunakan Geo Point dalam Redis, Anda dapat dengan mudah membangun fitur-fitur berbasis lokasi dalam aplikasi Laravel Anda, seperti pencarian lokasi terdekat, pemetaan lokasi, atau pelacakan pergerakan.
---
> #### hyper log log
> - HyperLogLog (HLL) adalah struktur data probabilitas yang digunakan untuk perkiraan kardinalitas (jumlah elemen yang unik) dalam sebuah set. Ini digunakan untuk menghitung perkiraan jumlah elemen unik dalam sebuah himpunan tanpa perlu menyimpan semua elemen individu.
> - Dalam konteks Redis, HyperLogLog adalah tipe data yang disediakan oleh Redis untuk menghitung perkiraan jumlah anggota unik dalam sebuah himpunan. Ini memungkinkan Anda untuk melakukan operasi tambah (add) dan menghitung (count) pada himpunan anggota unik.
> - Berikut adalah contoh penggunaan HyperLogLog dalam Redis:
> ```
> use Illuminate\Support\Facades\Redis;
>
>// Menambahkan anggota ke HyperLogLog dengan key 'unique_visitors'
>Redis::pfadd('unique_visitors', 'user1');
>Redis::pfadd('unique_visitors', 'user2');
>Redis::pfadd('unique_visitors', 'user3');
>
>// Mendapatkan perkiraan jumlah anggota unik
>$estimatedCount = Redis::pfcount('unique_visitors');
>
> ```
> - Dalam contoh di atas, kita menggunakan HyperLogLog untuk menghitung perkiraan jumlah pengunjung unik dalam suatu situs web. Setiap kali pengunjung baru datang, kita menambahkannya ke HyperLogLog menggunakan operasi pfadd. Kemudian, kita dapat menggunakan operasi pfcount untuk mendapatkan perkiraan jumlah pengunjung unik dalam suatu periode waktu tertentu.
> - Keuntungan utama dari penggunaan HyperLogLog adalah kemampuannya untuk memberikan perkiraan jumlah anggota unik dalam himpunan dengan penggunaan memori yang relatif kecil, bahkan untuk himpunan besar. Ini membuatnya sangat berguna untuk berbagai kasus penggunaan, seperti pemantauan lalu lintas web, analisis data, dan lain-lain.
---
> #### pipeline
> - Pipeline adalah salah satu fitur Redis yang memungkinkan Anda untuk mengirim sejumlah perintah Redis secara bersamaan ke server Redis, dan kemudian menerima sejumlah respon kembali dalam satu langkah. Ini membantu meningkatkan kinerja aplikasi dengan mengurangi latensi jaringan yang terjadi saat mengirim dan menerima perintah secara terpisah.
> - Dalam konteks Laravel Redis, Anda dapat menggunakan pipeline untuk meningkatkan kinerja aplikasi Anda ketika Anda perlu mengirim sejumlah perintah Redis secara berurutan.
> - Berikut adalah contoh penggunaan pipeline dalam Laravel Redis:
> ```
>use Illuminate\Support\Facades\Redis;
>
>// Inisialisasi pipeline
>$pipe = Redis::pipeline();
>
>// Tambahkan perintah ke dalam pipeline
>$pipe->set('key1', 'value1');
>$pipe->set('key2', 'value2');
>$pipe->set('key3', 'value3');
>
>// Jalankan pipeline untuk mengeksekusi semua perintah secara bersamaan
>$responses = $pipe->execute();
>
>// $responses berisi array respons dari setiap perintah
>
> ```
> - Dalam contoh di atas, kita membuat pipeline dengan memanggil `Redis::pipeline()`. Kemudian, kita menambahkan beberapa perintah ke dalam pipeline menggunakan metode seperti `set`. Setelah menambahkan semua perintah yang diinginkan ke dalam pipeline, kita menjalankan pipeline menggunakan metode `execute()`, yang akan mengeksekusi semua perintah secara bersamaan dan mengembalikan array respons dari setiap perintah.
> - Dengan menggunakan pipeline, Anda dapat meningkatkan kinerja aplikasi Anda dengan mengurangi latensi jaringan yang terjadi saat mengirim dan menerima perintah Redis secara terpisah. Ini sangat berguna ketika Anda perlu melakukan banyak operasi Redis dalam satu waktu, seperti ketika Anda memperbarui banyak data atau melakukan operasi transaksional.
---
> #### transaction
> - Transaksi dalam Redis memungkinkan Anda untuk mengeksekusi serangkaian perintah Redis sebagai satu kesatuan yang tidak terbagi, sehingga memastikan bahwa tidak ada perintah lain yang dapat dieksekusi di antara perintah-perintah dalam transaksi. Ini mirip dengan transaksi dalam basis data relasional, di mana serangkaian operasi dijalankan sebagai satu kesatuan yang konsisten.
> - Dalam konteks Laravel Redis, Anda dapat menggunakan transaksi untuk memastikan konsistensi data ketika Anda perlu menjalankan beberapa operasi Redis secara bersamaan dan memastikan bahwa semua operasi berhasil dieksekusi sebelum hasilnya dikembalikan.
> - Berikut adalah contoh penggunaan transaksi dalam Laravel Redis:
> ```
>use Illuminate\Support\Facades\Redis;
>
>// Mulai transaksi
>Redis::multi();
>
>// Tambahkan perintah-perintah ke dalam transaksi
>Redis::set('key1', 'value1');
>Redis::set('key2', 'value2');
>
>// Eksekusi transaksi
>$responses = Redis::exec();
>
>// $responses berisi respons dari setiap perintah dalam transaksi
>
> ```
> - Dalam contoh di atas, kita memulai transaksi dengan memanggil `Redis::multi()`. Kemudian, kita menambahkan serangkaian perintah ke dalam transaksi menggunakan metode seperti `set`. Setelah menambahkan semua perintah yang diinginkan ke dalam transaksi, kita menjalankan transaksi menggunakan metode `exec()`, yang akan mengeksekusi semua perintah dalam transaksi dan mengembalikan array respons dari setiap perintah.
> - Dengan menggunakan transaksi, Anda dapat memastikan konsistensi data dalam Redis, sehingga meminimalkan risiko terjadinya kegagalan dalam operasi-operasi yang dilakukan secara bersamaan. Ini sangat berguna ketika Anda perlu melakukan serangkaian operasi Redis sebagai satu kesatuan yang konsisten, seperti ketika Anda memperbarui beberapa nilai secara bersamaan.
---
<b>Terima Kasih</b>
---
