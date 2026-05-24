<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Project - Project Management</title>
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
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Daftar Project</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <?php if (!empty($projects)): ?>
                <?php foreach ($projects as $p): ?>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border border-slate-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-xl font-bold text-slate-800"><?= htmlspecialchars($p->getNamaProject()) ?></h3>
                                <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-semibold">ID: <?= $p->getIdProject() ?></span>
                            </div>
                            <div class="space-y-1 mb-4">
                                <p class="text-sm text-slate-600"><span class="font-medium text-slate-500">Lokasi:</span> <?= htmlspecialchars($p->getLokasi()) ?></p>
                                <p class="text-sm text-slate-600"><span class="font-medium text-slate-500">No Client:</span> <?= htmlspecialchars($p->getNoClient()) ?></p>
                            </div>
                        </div>
                        
                        <a href="index.php?action=detailProject&id=<?= $p->getIdProject() ?>" 
                           class="text-center w-full bg-slate-50 hover:bg-blue-50 text-blue-600 border border-blue-200 font-semibold py-2 rounded-xl transition mt-4">
                            Buka Detail Hardware & IP
                        </a>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                
                <div class="col-span-full bg-white p-8 rounded-2xl shadow-sm text-center border border-slate-200">
                    <p class="text-slate-500">Belum ada project yang ditambahkan di database.</p>
                </div>
                
            <?php endif; ?>
            
        </div>
    </div>

</body>
</html>