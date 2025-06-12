<?php
session_start();
include "../../helper/connection.php";

// Cek apakah ada ID order
if (!isset($_GET['id_order'])) {
    echo "ID order tidak ditemukan.";
    exit();
}

$id_order = $_GET['id_order'];

// Ambil data order (tborder dan user)
$qry_order = mysqli_query($conn, "
    SELECT o.*, u.nama_user 
    FROM tborder o 
    JOIN tbuser u ON o.id_user = u.id_user 
    WHERE o.id_order = '$id_order'
");

if (mysqli_num_rows($qry_order) == 0) {
    echo "Data order tidak ditemukan.";
    exit();
}

$order = mysqli_fetch_assoc($qry_order);

// Ambil data detail_order
$qry_detail = mysqli_query($conn, "
    SELECT d.*, p.nama_produk, p.harga
    FROM detail_order d 
    JOIN tbproduk p ON d.id_produk = p.id_produk 
    WHERE d.id_order = '$id_order'
");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk Pembelian - Hijab Store</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #8e44ad;
            padding-bottom: 10px;
        }
        .header h2 {
            color: #8e44ad;
            margin-bottom: 5px;
        }
        .customer-info {
            margin-bottom: 20px;
        }
        .order-id {
            font-size: 18px;
            font-weight: bold;
            margin: 15px 0;
            color: #8e44ad;
        }
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .products-table th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .products-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .total-row {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-print {
            background-color: #8e44ad;
            color: white;
        }
        .btn-back {
            background-color: #f8f9fa;
            color: #333;
            border: 1px solid #ddd;
        }
        @media print {
            .no-print {
                display: none;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Hijab Store</h2>
        <p>Struk Pembelian</p>
    </div>

    <div class="customer-info">
        <p><strong>Nama Pelanggan:</strong> <?= htmlspecialchars($order['nama_user']) ?></p>
        <p><strong>Tanggal Order:</strong> <?= date('d/m/Y', strtotime($order['tgl_order'])) ?></p>
    </div>

    <div class="order-id">ID Order: <?= $order['id_order'] ?></div>

    <table class="products-table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($item = mysqli_fetch_assoc($qry_detail)) { ?>
                <tr>
                    <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                    <td>Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td>Rp<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php } ?>
            <tr class="total-row">
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>Rp<?= number_format($order['total_harga'], 0, ',', '.') ?></strong></td>
            </tr>
        </tbody>
    </table>

    <div class="actions no-print">
        <button onclick="window.print()" class="btn btn-print">🖨️ Cetak Struk</button>
        <a href="histori.php" class="btn btn-back">← Kembali ke Histori</a>
    </div>

    <script>
        // Auto print jika diperlukan
        // window.print();
    </script>
</body>
</html>