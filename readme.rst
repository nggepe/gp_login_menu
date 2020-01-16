**V 1.1.0.0**


*******************
Apa ini?
*******************

Aplikasi ini dibuat untuk mempermudah pembuatan awal project, bagi para pengguna codeigniter.

**************************
Fitur
**************************

1. Login
2. Logout
3. Pencarian menu
4. Menu dinamis dengan koneksi database
5. Hak akses dinamis

*******************
Server Requirements
*******************
PHP versi 5.6 atau terbaru lebih baik.

************
Instalasi
************
1. Download code ini
2. Exctract di localhost anda.
3. Import database dengan nama "your_project_db" (file "your_project_db.sql" ada di folder utama).
4. Instalasi selesai.
5. Login -> username: direktur, password: direktur.

************
Dokumentasi
************

-  **Pembuatan Controller Baru**
Pembuatan controller seperti pembuatan controller codeigniter biasa. Untuk controller yang ingin diisi bedasarkan login session, hapus code *extend CI_Controller* dan ubah menjadi *extend User_auth*.

-  **Pembuatan Modul baru**
1. Buat data pada tabel modul
2. Jika modul tersebut memiliki 1 menu atau lebih, kosongkan kolom *url*
3. Jika modul tidak memiliki menu lain maka anda bisa mengisi *url*


-  **Pembuatan Menu baru**
1. Buat data pada tabel menu
2. Menu wajib memiliki id_modul, dan url

-  **Ketentuan penulisan url**
1. *Url* merujuk ke *Controller*.
2. *Url* pada **menu** atau **modul wajib** memiliki memiliki 3 *uri segment* (0,1,2).
3. *Segment 0* adalah ``base_url()`` anda, *Segment 1* adalah **folder** anda, dan *Segment 2* adalah **Controller** anda.
4. Jika anda tidak mengetahui *uri segment*, silakan klik `Disini <https://codeigniter.com/user_guide/libraries/uri.html>`_

- **Access Control / Hak Akses User**
1. Anda bisa mengetik **Hak akses** pada kolom pencarian menu.
2. Pada menu ini, anda dapat menentukan menu mana yang boleh diakses pada jabatan yang tersedia.

- **Lain-lain**
1. Jika ada bug atau kesalahan kode program, anda bisa melaporkan ini pada fitur `Issues <https://github.com/nggepe/gp_login_menu/issues>`_
2. `Donasi <https://wa.me/6281913900049?text=Halo%20Gilang,%20saya%20ingin%20berdonasi%20atas%20gp_login_menu>`_

*******
License
*******

Open source dan boleh digunakan untuk keperluan pribadi maupun bisnis.

*******
Framework
*******

1. PHP: Codeigniter 3.1.11
2. js : jquery-3.3.1
3. css: Bootstrap

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community Slack Channel <https://codeigniterchat.slack.com>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.
