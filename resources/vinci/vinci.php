<?php include_once 'methods.php'; ?>
<?php include_once 'header.php'; ?>

<section>
    <h1 style="font-size: 50px;">Vinci: Development Mode</h1>
    <div>
        <a href="#" id="bInfo" onclick="showInfo();" class="btn-info">Show info</a>
        <span id="info"></span>
    

        <?php
            if ($_SERVER['SERVER_NAME'] != "localhost" || $_SERVER['REMOTE_ADDR'] != "127.0.0.1") {
                echo "<p style='color: #CD0000; font-weight: bold; font-size: 20px;'>Warning: you are using vinci in an environment that is not localhost</p>";
            }

            if ($variable == true) {
                echo "<p style='color: #008B45; font-weight: bold;'>Created component</p>";
            } else if ($variable == false){
                echo "<p style='color: #B8860B; font-weight: bold;'>Component not created</p>";
            }
        ?>
    </div>
        
    <div class="content">
        <div>
            <form method="get">
                <div class="label">
                    <label for="controller">Create a new Controller</label>
                </div>

                <input type="text" name="controller" id="controller" placeholder="Ex: UserController" required>
                <button type="submit" name="btnController">Create Controller</button>
            </form>
        </div>

        <div>
            <form method="get">
                <div class="label">
                    <label for="view">Create a new View</label>
                </div>

                <input type="text" name="view" id="view" placeholder="Ex: home" required>
                <button type="submit" name="btnView">Create View</button>
            </form>
        </div>
        
        <div>
            <form method="get">
                <div class="label">
                    <label for="view">Create a new Model</label>
                </div>

                <input type="text" name="model" id="model" placeholder="Ex: User" required>
                <button type="submit" name="btnModel">Create Model</button>
            </form>
        </div>
    </div>
    
    <div class="content">
        <div>
            <form method="get">
                <div class="label">
                    <label for="view">Dump database (For Linux users)</label>
                </div>

                <input type="text" name="dump" id="dump" placeholder="Database name" required><br>
                <input type="text" name="dump-local" id="dump-local" placeholder="/home/dump" required><br>
                <button type="submit" name="btnDump">Dump database</button>
            </form>
        </div>
    </div>
</section>

<?php include_once 'footer.php'; ?>