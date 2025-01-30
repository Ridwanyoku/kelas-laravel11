<?php
session_start();
require_once 'db_config.php';

// Proses login
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk cek username dan password
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = MD5(?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        // Login gagal
        $error = "Username atau password salah.";
    }
}
?>
<!DOCTYPE html><html lang="id"><head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login - Sistem Keuangan Kas Kelas</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://ai-public.creatie.ai/gen_page/tailwind-custom.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com/3.4.5?plugins=forms@0.5.7,typography@0.5.13,aspect-ratio@0.4.2,container-queries@0.1.1"></script>
    <script src="https://ai-public.creatie.ai/gen_page/tailwind-config.min.js" data-color="#000000" data-border-radius="small"></script>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-lg shadow-lg">
        <div class="text-center">
            <img class="mx-auto h-12 w-auto" src="img/logo.jpg" alt="Logo"/>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">
                Sistem Keuangan Kas Kelas
            </h2>
            <p class="mt-2 text-sm text-gray-600">Masuk ke akun untuk mengelola keuangan kelas</p>
        </div>
        
        <form class="mt-8 space-y-6" action="dashboard.php" method="POST">
    <div class="rounded-md shadow-sm space-y-4">
        <div>
            <label for="email" class="sr-only">Username</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-gray-400"></i>
                </div>
                <input id="email" name="email" type="text" required="" class="appearance-none !rounded-button relative block w-full pl-10 pr-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-custom focus:border-custom sm:text-sm" placeholder="Username"/>
            </div>
        </div>
        
        <div>
            <label for="password" class="sr-only">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input id="password" name="password" type="password" required="" class="appearance-none !rounded-button relative block w-full pl-10 pr-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-custom focus:border-custom sm:text-sm" placeholder="Password"/>
            </div>
        </div>
    </div>
    <div>
        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium !rounded-button text-white bg-custom hover:bg-custom focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-sign-in-alt text-custom-lighter group-hover:text-custom-lightest"></i>
            </span>
            Masuk
        </button>
    </div>
</form>

<?php if (isset($error)): ?>
    <div class="mt-4 text-center text-red-500 text-sm">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>
    </div>
    <footer class="mt-8 text-center text-sm text-gray-600">
    </footer>