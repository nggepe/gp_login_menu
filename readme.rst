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
4. Instalasi selesai. (username: admin, password: admin).

************
Dokumentasi
************

-  `Pembuatan Controller Baru`_
Pembuatan controller seperti pembuatan controller codeigniter biasa. Untuk controller yang ingin diisi bedasarkan login session, hapus code *extend CI_Controller* dan ubah menjadi *extend User_auth*.

-  `Pembuatan Modul baru`_
1. Buat data pada tabel modul
2. Jika modul tersebut memiliki banyak fitur, kosongkan kolom *url*. Jika modul tidak memiliki menu lain maka anda bisa mengisi *url*

-  `Pembuatan Menu baru`_
1. Buat data pada tabel menu
2. Menu wajib memiliki id_modul

-  `Url pada menu atau modul`_
Url ini merujuk ke controller, jika anda memiliki controller yang berada didalam folder maka: nama_folder/nama_controler.


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
