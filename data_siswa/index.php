<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Data Alumni</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Data Alumni Sekolah</h1>
    <a href="tambah.php">+ Tambah Data</a>
    
  <div class="search-form-container">
    <form method="GET" action="">
        <input type="text" name="cari" class="search-input" placeholder="Cari ID, Nama, NIK, NISN, atau Jurusan" 
                value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
        <button type="submit" class="search-button">Cari</button>
    </form>
    <?php if(isset($_GET['cari']) && $_GET['cari'] != ''): ?>
        <a href="index.php" class="reset-button">Reset</a>
    <?php endif; ?>
</div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>NISN</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Tahun Lulus</th>
            <th>Jurusan</th>
            <th>Ubah</th>
        </tr>
        <?php

        // Logika Pencarian
        if(isset($_GET['cari']) && $_GET['cari'] != '') {
            $cari = mysqli_real_escape_string($conn, $_GET['cari']);
            $query = "SELECT * FROM data_alumni WHERE 
                id LIKE '%$cari%' OR 
                nama LIKE '%$cari%' OR 
                nik LIKE '%$cari%' OR 
                nisn LIKE '%$cari%' OR 
                jurusan LIKE '%$cari%'";
        } else {
            $query = "SELECT * FROM data_alumni";
        }
        
        $result = mysqli_query($conn, $query);
        
        // --- Perbaikan dimulai di sini ---
        if ($result === false) {
            // Jika mysqli_query gagal (mengembalikan false)
            echo "<tr><td colspan='10' style='text-align: center; color: red;'>Error pada Query: " . mysqli_error($conn) . "</td></tr>";
        } elseif(mysqli_num_rows($result) > 0) {
        // --- Perbaikan berakhir di sini ---
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['Nama']}</td>
            <td>{$row['nik']}</td>
            <td>{$row['nisn']}</td>
            <td>{$row['tempat_lahir']}</td>
            <td>{$row['tanggal_lahir']}</td>
            <td>{$row['alamat']}</td>
            <td>{$row['tahun_lulus']}</td>
            <td>{$row['jurusan']}</td>
            <td>
              <a href='edit.php?id={$row['id']}'>Edit</a> |
              <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Yakin ingin hapus?')\">Hapus</a>
            </td>
          </tr>";
            }
        } else {
            echo "<tr><td colspan='10' style='text-align: center;'>Data tidak ditemukan</td></tr>";
        }
        ?>
    </table>
</body>

</html>