<?php

require_once('database.php');

function statusPembayaran($nim)
{
    global $db;
    $query = "SELECT status FROM pembayaran WHERE mhsId = (SELECT id FROM mahasiswa WHERE nim = '" . $nim . "')";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['status'];
    } else {
        return null;
    }
}

function getAllMahasiswaWithStatus()
{
    global $db;
    $query = "SELECT m.id, m.nim, m.nama, m.kelas, p.tagihan, p.terbayar, p.status FROM mahasiswa as m INNER JOIN `pembayaran` as p ON m.id = p.mhsId";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_all($result);
        return json_encode($data);
    } else {
        return null;
    }
}
