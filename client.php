<?php

require 'vendor/autoload.php';

use nguyenanhung\MyFixNuSOAP\nusoap_client;

$client = new nusoap_client("http://localhost/wssoa-study-case/server.php?wsdl");

$client->soap_defencoding = 'utf-8';

$err = $client->getError();

if ($err) {
    echo "Error: " . $err;
} else {
    $res3 = $client->call("getAllMahasiswaWithStatus");
    $data = json_decode($res3);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SOAP Web Service Client Side Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h2>Daftar Mahasiswa</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Tagihan</th>
                                <th scope="col">Terbayar</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $d) : ?>
                                <tr>
                                    <td><?= $d[1]; ?></td>
                                    <td><?= $d[2]; ?></td>
                                    <td><?= $d[3]; ?></td>
                                    <td><?= $d[4]; ?></td>
                                    <td><?= $d[5]; ?></td>
                                    <td><?= $d[6]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form class="form-inline" action="" method="POST">
                        <h2>Cek Status Pembayaran</h2>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required />
                        </div>
                        <button type="submit" name="submit" class="btn btn-default">Submit</button>
                    </form>
                    <p>&nbsp;</p>
                </div>
            </div>
            <h3>
                <?php
                if (isset($_POST['submit'])) {
                    $nim = $_POST['nim'];

                    $response = $client->call('statusPembayaran', array("nim" => $nim));

                    if (empty($response))
                        echo "Mahasiswa tidak ditemukan";
                    else
                        echo "Status Pembayaran: " . $response;
                }
                ?>
            </h3>
        </div>
    </div>
</body>

</html>