<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dagupan Transit Tracker - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="../src/output.css" rel="stylesheet" />
    <script type="module" src="../src/index.js"></script>
    <style>
        .material-symbols-outlined {
            font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24
        }
        
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-menu.open {
            transform: translateX(0);
        }
        
        .menu-overlay {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out;
        }
        
        .menu-overlay.open {
            opacity: 1;
            visibility: visible;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .transparent-card {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="w-screen min-h-screen font-serif text-sm select-none overflow-x-hidden ">

    <header class="lg:hidden  bg-center bg-no-repeat bg-cover shadow-sm p-4 flex items-center justify-between sticky top-0 z-30"
            style="background-image: url('../asset/sb.png'); background-attachment: fixed; background-position: center; background-size: cover;">
        <div class="flex items-center gap-3">
            <img src="../asset/logo.png" alt="Kommute Logo" class="w-8 h-8 rounded-full">
            <h2 class="text-xl font-bold text-white">B-DAG.PH</h2>
        </div>
        <button id="mobileMenuButton" class="p-2 rounded-lg bg-gray-100">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </header>

    <div class="flex min-h-screen">

        <aside class="w-64 flex-col pt-6 shadow h-screen sticky top-0 hidden lg:flex bg-center bg-no-repeat bg-cover"
             style="background-image: url('../asset/sb.png'); background-attachment: fixed; background-position: center; background-size: cover;">
            <div class="flex items-center gap-3 mb-8 px-6">
                <img src="../asset/logo.png" alt="Kommute Logo" class="w-10 h-10 rounded-full">
                <h2 class="text-2xl font-bold text-white">B-DAG.PH</h2>
            </div>
            <nav class="flex flex-col gap-1">
                <a href="../src/commuter.php" class="flex items-center gap-4 px-8 h-12 text-white bg-black bg-opacity-20 text-white rounded-lg">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-bold text-lg">Dashboard</span>
                </a>
                <a href="../src/lines.php" class="flex items-center gap-4 px-8 h-12 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300 ease-in-out">
                    <span class="material-symbols-outlined">transportation</span>
                    <span class="font-bold text-lg">Lines</span>
                </a>
                <a href="../src/map.php" class="flex items-center gap-4 px-8 h-12 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300 ease-in-out">
                    <span class="material-symbols-outlined">map</span>
                    <span class="font-bold text-lg">Map</span>
                </a>
                <a href="../src/commuter_acc.php" class="flex items-center gap-4 px-8 h-12 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300 ease-in-out">
                    <span class="material-symbols-outlined">person</span>
                    <span class="font-bold text-lg">Account</span>
                </a>
                <a href="../src/feedback.php" class="flex items-center gap-4 px-8 h-12 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300 ease-in-out">
                    <span class="material-symbols-outlined">message</span>
                    <span class="font-bold text-lg">Feedback</span>
                </a>
                <a href="../auth/logout.php" class="flex items-center gap-4 px-8 h-12 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300 ease-in-out">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-bold text-lg">Logout</span>
                </a>
            </nav>
        </aside>

        <div id="menuOverlay" class="menu-overlay fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"></div>
        
        <aside id="mobileMenu" class="mobile-menu fixed top-0 left-0 h-full w-64 z-50 flex flex-col pt-6 shadow-lg lg:hidden bg-center bg-no-repeat bg-cover"
            style="background-image: url('../asset/sb.png'); background-attachment: fixed; background-position: center; background-size: cover;">
            <div class="flex items-center justify-between mb-8 px-6">
                <div class="flex items-center gap-3">
                    <img src="../asset/logo.png" alt="Kommute Logo" class="w-10 h-10 rounded-full">
                    <h2 class="text-xl font-bold text-white">B-DAG.PH</h2>
                </div>
                <button id="closeMobileMenu" class="p-2 rounded-lg bg- black bg-opacity-20">
                    <span class="material-symbols-outlined text-white">close</span>
                </button>
            </div>
            <nav class="flex flex-col gap-1 flex-1">
                <a href="../src/commuter.php" class="flex items-center gap-4 px-8 h-12 bg-black bg-opacity-20 text-white rounded-lg">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="../src/lines.php" class="flex items-center gap-4 px-8 h-12 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300">
                    <span class="material-symbols-outlined">transportation</span>
                    <span class="font-medium">Lines</span>
                </a>
                <a href="../src/map.php" class="flex items-center gap-4 px-8 h-12 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300">
                    <span class="material-symbols-outlined">map</span>
                    <span class="font-medium">Map</span>
                </a>
                <a href="../src/commuter_acc.php" class="flex items-center gap-4 px-8 h-12 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300">
                    <span class="material-symbols-outlined">person</span>
                    <span class="font-medium">Account</span>
                </a>
                <a href="../src/feedback.php" class="flex items-center gap-4 px-8 h-12 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300">
                    <span class="material-symbols-outlined">message</span>
                    <span class="font-medium">Feedback</span>
                </a>
                <a href="../auth/logout.php" class="flex items-center gap-4 px-8 h-12 text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-300 mt-auto mb-4">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-medium">Logout</span>
                </a>    
            </nav>
        </aside>
  
        <main class="flex-1 p-4 lg:p-8 w-full bg-center bg-no-repeat bg-cover"
         style="background-image: url('../asset/bg_com.png'); background-attachment: fixed; background-position: center; background-size: cover;">
         
            <div class="mb-6 lg:mb-8">
                <h1 class="text-2xl lg:text-3xl font-bold text-white">Dashboard</h1>
                <p class="text-white text-m  font-bold">Welcome back, Commuter: <?php echo isset($_SESSION['CommuterFullname']) ? $_SESSION['CommuterFullname'] : 'Commuter'; ?>!</p>
            </div>
            
          
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8 ">
            
                <div class="bg-white rounded-lg p-4 lg:p-6" >
                    <div class="flex items-center " >
                        <div class="p-2 lg:p-3 rounded-full bg-blue-500 bg-opacity-20 text-blue-300 mr-3 lg:mr-4">
                            <span class="material-symbols-outlined text-lg lg:text-xl">directions_bus</span>
                        </div>
                        <div>
                            <p class="text-xs lg:text-sm text-gray-500 font-bold">Registered Driver</p>
                            <h3 class="text-xl lg:text-2xl font-bold text-black"><?php echo $activeVehicles; ?></h3>
                        </div>
                    </div>
                </div>
       
                <div class="bg-white rounded-lg p-4 lg:p-6">
                    <div class="flex items-center">
                        <div class="p-2 lg:p-3 rounded-full bg-green-500 bg-opacity-20 text-green-300 mr-3 lg:mr-4">
                            <span class="material-symbols-outlined text-lg lg:text-xl">route</span>
                        </div>
                        <div>
                            <p class="text-xs lg:text-sm text-gray-500 ">Active Routes</p>
                            <h3 class="text-xl lg:text-2xl font-bold text-black"><?php echo $activeRoutes; ?></h3>
                        </div>
                    </div>
                </div>
                
         
                <div class="bg-white  rounded-lg p-4 lg:p-6">
                    <div class="flex items-center">
                        <div class="p-2 lg:p-3 rounded-full bg-purple-500 bg-opacity-20 text-purple-300 mr-3 lg:mr-4">
                            <span class="material-symbols-outlined text-lg lg:text-xl ">schedule</span>
                        </div>
                        <div>
                            <p class="text-xs lg:text-sm text-gray-500 ">Avg. Wait Time</p>
                            <h3 class="text-xl lg:text-2xl font-bold text-black">30 min</h3>
                        </div>
                    </div>
                </div>
           
              
            </div>
            
         
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 lg:gap-8">
             
                <div class="xl:col-span-2 bg-white  rounded-lg p-4 lg:p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                        <h2 class="text-lg lg:text-xl font-bold text-black">Live Transit Map</h2>
                    </div>
                    <div class="bg-transparent h-60 lg:h-80 rounded-lg flex items-center justify-center overflow-hidden">
                        <div class="w-full h-full relative" id="map">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61345.39230049257!2d120.30582017980664!3d16.06097356182847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33915d56ad32b305%3A0x1b74411960f5054a!2sDagupan%20City%2C%20Pangasinan!5e0!3m2!1sen!2sph!4v1759422492451!5m2!1sen!2sph" 
                                class="w-full h-full border-0 rounded-lg"
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-50 text-white px-4 py-2 rounded-lg">
                                <p class="text-sm font-medium">Dagupan City, Pangasinan</p>
                            </div>
                        </div>
                    </div>
                </div>

               
                <div class="bg-white  rounded-lg p-4 lg:p-6">
                    <h2 class="text-lg lg:text-xl font-bold text-black mb-4">Active Routes</h2>
                    <div class="space-y-3 lg:space-y-4">
                        <?php
                        $routes = [
                            ['name' => 'Bonuan Binloc Route', 'color' => '', 'link' => 'binloc_map.php'],
                            ['name' => 'Bonuan Boquig Route', 'color' => '', 'link' => 'boquig_map.php'],
                            ['name' => 'Bonuan Gueset / Tondaligan Route', 'color' => 'yellow', 'link' => 'gueset_map.php'],
                            ['name' => 'Bolosan / Salisay / Tambac Route', 'color' => '', 'link' => 'bolosan_map.php'],
                            ['name' => 'Downtown Loop Route', 'color' => 'pink', 'link' => 'downtown_map.php'],
                            ['name' => 'CSI Lucao Route', 'color' => 'indigo', 'link' => 'lucao_map.php']
                        ];
                        
                        foreach ($routes as $route) {
                            echo '
                            <div class="flex items-start hover:bg-white hover:bg-opacity-10 rounded-lg p-2 transition-all duration-300">
                                <div class="bg-'.$route['color'].'-500 bg-opacity-20 p-1.5 lg:p-2 rounded-full mr-2 lg:mr-3">
                                    <span class="material-symbols-outlined text-'.$route['color'].'-300 text-xs lg:text-sm">directions_bus</span>
                                </div>
                                <div class="flex-1">
                                    <a href="'.$route['link'].'" class="text-black hover:text-'.$route['color'].'-300 transition-colors">'.$route['name'].'</a>
                                </div>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuOverlay = document.getElementById('menuOverlay');
        
        function openMobileMenu() {
            mobileMenu.classList.add('open');
            menuOverlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMobileMenuFunc() {
            mobileMenu.classList.remove('open');
            menuOverlay.classList.remove('open');
            document.body.style.overflow = 'auto';
        }
        
        mobileMenuButton.addEventListener('click', openMobileMenu);
        closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
        menuOverlay.addEventListener('click', closeMobileMenuFunc);
        
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeMobileMenuFunc();
            }
        });
    </script>
</body>
</html>