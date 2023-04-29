<html>

    <head>
            <title>projekt</title>
            <link rel="stylesheet" href="assets/css/Lumen.css">
            <script src="assets/js/bootstrap.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
            <!-- nalozi blockly-->
            <script src="https://unpkg.com/blockly/blockly.min.js"></script>
            <!--neka knjižnjica, ki naj bi omogočala več nadzora nad izvajanjem blokov-->
            <script src="assets\JS-Interpreter\acorn_interpreter.js"></script>
            <!--moji bloki-->
            <script src="assets\blockly\blocks\customblocks.js"></script>
            <!--monaco editor-->
            <link data-name="vs/editor/editor.main" rel="stylesheet" href="assets\package\min\vs\editor\editor.main.css">
            <script type="text/javascript" src="assets/package/min/vs/loader.js"></script>
            <script src="assets/package/min/vs/editor/editor.main.nls.js"></script>
	        <script src="assets/package/min/vs/editor/editor.main.js"></script>
            <script src="assets\package\min\vs\basic-languages\python\python.js"></script>
            <script src="assets\package\min\vs\basic-languages\javascript\javascript.js"></script>

            
            
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Spletna stran</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="">Domov</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/naloge">Naloge</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/prijava">Prijava</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/odjava">Odjava</a>
                    </li>
                    <?php
                    if (isset($_SESSION["admin"]) and $_SESSION["admin"]==1){
                        echo '<li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>';
                    }
                    if (isset($_SESSION["sestavljalec"]) and $_SESSION["sestavljalec"]==1){
                        echo '<li class="nav-item"><a class="nav-link" href="/sestavljalci">Sestavljalec</a></li>';
                    }
                    ?>
                    
                </ul>
            </div>
        </div>
    </nav>

        <!--<h1 class = "text-center" ><?php echo $title; ?></h1>-->