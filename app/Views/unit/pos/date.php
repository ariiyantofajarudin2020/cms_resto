<h5 class="card-title">Kasir : <?=session()->get('username')?> |
    <span id="clock">
        <?php
                            // Set timezone jika perlu
                            date_default_timezone_set('Asia/Jakarta'); 

                            // Mendapatkan hari, tanggal, dan bulan dengan format lengkap
                            $hari = date('l'); // Nama hari dalam bahasa Inggris
                            $tanggal = date('d'); // Tanggal
                            $bulan = date('F'); // Nama bulan dalam bahasa Inggris
                            $tahun = date('Y'); // Tahun

                            // Mengonversi nama hari dan bulan ke bahasa Indonesia
                            $hariIndo = array(
                                'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 
                                'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 
                                'Sunday' => 'Minggu'
                            );
                            $bulanIndo = array(
                                'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 
                                'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 
                                'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September', 
                                'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'
                            );

                            // Menampilkan tanggal dalam format Indonesia
                            $hari = $hariIndo[$hari];
                            $bulan = $bulanIndo[$bulan];
                            $tanggalFormat = "{$hari}, {$tanggal} {$bulan} {$tahun} - ";

                            // Tampilkan waktu saat ini (jam, menit, detik)
                            echo '<br><span>'.$tanggalFormat . "</span><span id='time'></span>";
                            ?>
    </span>
</h5>