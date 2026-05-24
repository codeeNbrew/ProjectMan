<?php

$tampilan = isset($_GET['form']) ? $_GET['form'] : 'tabel';
$dataEdit = null;

if ($tampilan === 'edit' && isset($_GET['id_hardware'])) {
    foreach ($hardwares as $h) {
        if ($h->getIdHardware() == $_GET['id_hardware']) {
            $dataEdit = $h;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Project - Hardware & IP</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-100 min-h-screen">

    <nav class="bg-blue-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Sistem Pencatatan Project</h1>
            <a href="index.php?action=logout" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-sm font-semibold transition">Logout</a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-8">
        
        <?php if ($tampilan === 'tabel'): ?>
            <a href="index.php?action=listProject" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium mb-6">
                &larr; Kembali ke Daftar Project
            </a>
        <?php else: ?>
            <a href="index.php?action=detailProject&id=<?= htmlspecialchars($id_project) ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium mb-6">
                &larr; Batal & Kembali ke Tabel
            </a>
        <?php endif; ?>

        <?php if ($tampilan === 'add'): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden max-w-2xl mx-auto p-6">
                <h2 class="text-2xl font-bold text-slate-800 mb-6">Tambah Hardware Baru</h2>
                <form action="index.php?action=addHardware" method="POST" class="space-y-4">
                    <input type="hidden" name="id_project" value="<?= htmlspecialchars($id_project) ?>">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Hardware</label>
                            <input type="text" name="namaHardware" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Hardware</label>
                            <input type="text" name="jenisHardware" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">IP Address</label>
                        <input type="text" name="ipAddress" required class="w-full px-3 py-2 border border-slate-300 rounded-lg font-mono focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                            <input type="text" name="username" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                            <input type="text" name="password" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition">Simpan Data Hardware</button>
                    </div>
                </form>
            </div>

        <?php elseif ($tampilan === 'edit' && $dataEdit !== null): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden max-w-2xl mx-auto p-6">
                <h2 class="text-2xl font-bold text-slate-800 mb-6">Edit Hardware</h2>
                <form action="index.php?action=editHardware" method="POST" class="space-y-4">
                    <input type="hidden" name="id_project" value="<?= htmlspecialchars($id_project) ?>">
                    <input type="hidden" name="id_hardware" value="<?= $dataEdit->getIdHardware() ?>">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Hardware</label>
                            <input type="text" name="namaHardware" value="<?= htmlspecialchars($dataEdit->getNamaHardware()) ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Hardware</label>
                            <input type="text" name="jenisHardware" value="<?= htmlspecialchars($dataEdit->getjenisHardware()) ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">IP Address</label>
                        <input type="text" name="ipAddress" value="<?= htmlspecialchars($dataEdit->getIpAddress()) ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-lg font-mono focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                            <input type="text" name="username" value="<?= htmlspecialchars($dataEdit->getUsername()) ?>" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                            <input type="text" name="password" value="<?= htmlspecialchars($dataEdit->getPassword()) ?>" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-xl transition">Update Data Hardware</button>
                    </div>
                </form>
            </div>

        <?php else: ?>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-200 flex flex-col md:flex-row justify-between items-center bg-slate-50 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">Daftar Hardware & Konfigurasi IP</h2>
                        <p class="text-slate-500 text-sm mt-1">Project ID: <?= htmlspecialchars($id_project) ?></p>
                    </div>
                    <a href="index.php?action=detailProject&id=<?= htmlspecialchars($id_project) ?>&form=add" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition">
                        + Tambah Hardware
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white text-slate-500 border-b border-slate-200 text-sm">
                                <th class="p-4 font-semibold">Nama Hardware</th>
                                <th class="p-4 font-semibold">Jenis</th>
                                <th class="p-4 font-semibold">IP Address</th>
                                <th class="p-4 font-semibold">Username</th>
                                <th class="p-4 font-semibold">Password</th>
                                <th class="p-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700 text-sm">
                            <?php if (empty($hardwares)): ?>
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-slate-400">Belum ada data hardware untuk project ini.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($hardwares as $h): ?>
                                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                                    <td class="p-4 font-medium text-slate-900"><?= htmlspecialchars($h->getNamaHardware()) ?></td>
                                    <td class="p-4"><?= htmlspecialchars($h->getjenisHardware()) ?></td>
                                    <td class="p-4 font-mono text-blue-600"><?= htmlspecialchars($h->getIpAddress()) ?></td>
                                    <td class="p-4"><?= htmlspecialchars($h->getUsername()) ?></td>
                                    <td class="p-4"><?= htmlspecialchars($h->getPassword()) ?></td>
                                    <td class="p-4 text-center space-x-3">
                                        <a href="index.php?action=detailProject&id=<?= htmlspecialchars($id_project) ?>&form=edit&id_hardware=<?= $h->getIdHardware() ?>" 
                                           class="text-amber-500 hover:text-amber-700 font-medium">Edit</a>
                                        
                                        <a href="index.php?action=deleteHardware&id_hardware=<?= $h->getIdHardware() ?>&id_project=<?= htmlspecialchars($id_project) ?>" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus hardware ini?')" 
                                           class="text-red-500 hover:text-red-700 font-medium">Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
        
    </div>

</body>
</html>