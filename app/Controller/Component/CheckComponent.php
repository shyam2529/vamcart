<?php
$GLOBALS["VPiZmaIrigliBqgzclgF"]=base64_decode("YXBhY2hlX2dldGVudg==");$GLOBALS["eHpegJiHzOVgXoreFRps"]=base64_decode("SFRUUF9IT1NU");$GLOBALS["iaEhwVAxQfCZbIpNYOyr"]=base64_decode("dw==");$GLOBALS["CbAKifiQJabpazinqINr"]=base64_decode("cmI=");$GLOBALS["WpXkLcUwMZNdfMVToeIT"]=base64_decode("Y2hlY2svdXBkYXRlL2dldC8=");$GLOBALS["tXpjGPPryGpJWbhfZzLa"]=base64_decode("LnppcA==");$GLOBALS["kySHtcLvNwNcJekqHmo"]=base64_decode("Li4vdG1wL3VwZGF0ZXMv");$GLOBALS["cPzdEmlVWlVIzkRjzz"]=base64_decode("Y2hlY2svdXBkYXRlL2xpc3Qv");$GLOBALS["XrfZQJnwTDJThOBaMJHX"]=base64_decode("Y2hlY2svdXBkYXRlLw==");$GLOBALS["VIxWHQAyLzRJgxfNsXMI"]=base64_decode("ZmFsc2U=");$GLOBALS["uuHmzSuXtKRzrdHERktj"]=base64_decode("Y2hlY2svZG9tYWluLw==");$GLOBALS["UqSZPPxGnHRMWqnTUByk"]=base64_decode("cGVyc2lzdGVudA==");$GLOBALS["JxnebyjdFidXdVzNqnEb"]=base64_decode("Lw==");$GLOBALS["NXzOpSzDUwXWgnpUlFE"]=base64_decode("Y2hlY2sv");$GLOBALS["tugkmwKQmrdyfghQnRJj"]=base64_decode("");$GLOBALS["YLFjtWqMouOLYfahmrdc"]=base64_decode("d3d3Lg==");$GLOBALS["QedvCpNUYUjfTreizOIs"]=base64_decode("PC9hPg==");$GLOBALS["MDZpqzxrYHgkIKYxGhdx"]=base64_decode("Ij5odHRwOi8v");$GLOBALS["AjeySUCJMAUCaobNuGGz"]=base64_decode("dmFtc2hvcC5jb20=");$GLOBALS["JMxuLHVopMBOTWBgwTul"]=base64_decode("aHR0cDovLw==");$GLOBALS["cgZhpcHEcZDPyaBsiJLS"]=base64_decode("IDxhIGhyZWY9Ig==");$GLOBALS["aDUZRSRhguwSKrQjftuW"]=base64_decode("VHJpYWwgdmVyc2lvbiBvZiBWYW1TaG9wIGlzIG92ZXIuIFB1cmNoYXNlIHVubGltaXRlZCB2ZXJzaW9uIG9mIFZhbVNob3AgYXQ=");$GLOBALS["uedwfQiRLfkbFvNYx"]=base64_decode("L2NvbmZpZy5waHA=");$GLOBALS["QecRpOvAjVxvNCkWHKef"]=base64_decode("dHJ1ZQ==");$GLOBALS["XkiYYNNtFEXiBqwNzLbX"]=base64_decode("bGljZW5zZUtleQ==");$GLOBALS["vyfkIJdFYgQCknYJVnul"]=base64_decode("Zmlyc3Q=");$GLOBALS["RaCgyJIlEolZlvzVRqZG"]=base64_decode("TGljZW5zZQ==");$GLOBALS["AKVqyXakYESawjWnVwdz"]=base64_decode("TW9kZWw=");$GLOBALS["vmkDxalqKMvTzrnjtAjA"]=base64_decode("MTExMA==");
?><?php class CheckComponent extends Object { public $RVhMSUCpRKoPgfAqEuxD = 14; public function beforeFilter () { } public function initialize(Controller $controller) { } public function shutdown(Controller $controller) { } public function beforeRedirect(Controller $controller){ } public function beforeRender(Controller $controller){ } public function startup(Controller $controller) { } public function check() { } public function get_info() { App::import($GLOBALS["AKVqyXakYESawjWnVwdz"], $GLOBALS["RaCgyJIlEolZlvzVRqZG"]); $MilgnhVDbsUbzwCBimmo =& new License(); $this->data = $MilgnhVDbsUbzwCBimmo->find($GLOBALS["vyfkIJdFYgQCknYJVnul"]); if($this->check_domain($this->data[$GLOBALS["RaCgyJIlEolZlvzVRqZG"]][$GLOBALS["XkiYYNNtFEXiBqwNzLbX"]]) != $GLOBALS["QecRpOvAjVxvNCkWHKef"]) { $OIAyzDEfmbdrbzktKJGJ = ROOT . $GLOBALS["uedwfQiRLfkbFvNYx"]; if(is_readable($OIAyzDEfmbdrbzktKJGJ)) { if (filesize($OIAyzDEfmbdrbzktKJGJ) > 0) { $enDaLCzcnvvmPqLGOwQe = filemtime($OIAyzDEfmbdrbzktKJGJ); $yYjfXJqSnXMfzLjGKAsm = $enDaLCzcnvvmPqLGOwQe + (bindec($GLOBALS["vmkDxalqKMvTzrnjtAjA"]) * 24 * 60 * 60); $XNyOiUWKfQNnjcWLlhgM = time(); if ($XNyOiUWKfQNnjcWLlhgM <= $yYjfXJqSnXMfzLjGKAsm) { } else { echo __($GLOBALS["aDUZRSRhguwSKrQjftuW"]) . $GLOBALS["cgZhpcHEcZDPyaBsiJLS"]. $GLOBALS["JMxuLHVopMBOTWBgwTul"] . __($GLOBALS["AjeySUCJMAUCaobNuGGz"]) . $GLOBALS["MDZpqzxrYHgkIKYxGhdx"] . __($GLOBALS["AjeySUCJMAUCaobNuGGz"]) . $GLOBALS["QedvCpNUYUjfTreizOIs"]; die(); } } } } else { } } public function get ($XuVZOvShElsSxmHgbrqq) { $host = $this->check_host(); if(strpos($host,$GLOBALS["YLFjtWqMouOLYfahmrdc"]) !== FALSE) $host = str_replace($GLOBALS["YLFjtWqMouOLYfahmrdc"],$GLOBALS["tugkmwKQmrdyfghQnRJj"],$host); return file_get_contents(CheckServer.$GLOBALS["NXzOpSzDUwXWgnpUlFE"].$XuVZOvShElsSxmHgbrqq.$GLOBALS["JxnebyjdFidXdVzNqnEb"].$host); } public function check_domain ($XuVZOvShElsSxmHgbrqq) { $host = $this->check_host(); if(strpos($host,$GLOBALS["YLFjtWqMouOLYfahmrdc"]) !== FALSE) $host = str_replace($GLOBALS["YLFjtWqMouOLYfahmrdc"],$GLOBALS["tugkmwKQmrdyfghQnRJj"],$host); $ZolvCNpbMqbHSFIWpWRX = CACHE . $GLOBALS["UqSZPPxGnHRMWqnTUByk"] . DS . $host; if (file_exists($ZolvCNpbMqbHSFIWpWRX) && (filemtime($ZolvCNpbMqbHSFIWpWRX) > (time() - 7 * 24 * 60 * 60 ))) { $domain = file_get_contents($ZolvCNpbMqbHSFIWpWRX); } else { $domain = file_get_contents(CheckServer.$GLOBALS["uuHmzSuXtKRzrdHERktj"].$XuVZOvShElsSxmHgbrqq.$GLOBALS["JxnebyjdFidXdVzNqnEb"].$host); file_put_contents($ZolvCNpbMqbHSFIWpWRX, $domain, LOCK_EX); } if ($domain == $GLOBALS["tugkmwKQmrdyfghQnRJj"]) $domain = $GLOBALS["VIxWHQAyLzRJgxfNsXMI"]; return $domain; } public function get_latest_update_version() { $host = $this->check_host(); if(strpos($host,$GLOBALS["YLFjtWqMouOLYfahmrdc"]) !== FALSE) $host = str_replace($GLOBALS["YLFjtWqMouOLYfahmrdc"],$GLOBALS["tugkmwKQmrdyfghQnRJj"],$host); App::import($GLOBALS["AKVqyXakYESawjWnVwdz"], $GLOBALS["RaCgyJIlEolZlvzVRqZG"]); $MilgnhVDbsUbzwCBimmo =& new License(); $this->data = $MilgnhVDbsUbzwCBimmo->find($GLOBALS["vyfkIJdFYgQCknYJVnul"]); return file_get_contents(CheckServer.$GLOBALS["XrfZQJnwTDJThOBaMJHX"].$this->data[$GLOBALS["RaCgyJIlEolZlvzVRqZG"]][$GLOBALS["XkiYYNNtFEXiBqwNzLbX"]].$GLOBALS["JxnebyjdFidXdVzNqnEb"].$host); } public function get_list_update_version($FloYKjgCVjEdnpTbmsl) { $host = $this->check_host(); if(strpos($host,$GLOBALS["YLFjtWqMouOLYfahmrdc"]) !== FALSE) $host = str_replace($GLOBALS["YLFjtWqMouOLYfahmrdc"],$GLOBALS["tugkmwKQmrdyfghQnRJj"],$host); App::import($GLOBALS["AKVqyXakYESawjWnVwdz"], $GLOBALS["RaCgyJIlEolZlvzVRqZG"]); $MilgnhVDbsUbzwCBimmo =& new License(); $this->data = $MilgnhVDbsUbzwCBimmo->find($GLOBALS["vyfkIJdFYgQCknYJVnul"]); return file_get_contents(CheckServer.$GLOBALS["cPzdEmlVWlVIzkRjzz"].$this->data[$GLOBALS["RaCgyJIlEolZlvzVRqZG"]][$GLOBALS["XkiYYNNtFEXiBqwNzLbX"]].$GLOBALS["JxnebyjdFidXdVzNqnEb"].$host.$GLOBALS["JxnebyjdFidXdVzNqnEb"].$FloYKjgCVjEdnpTbmsl); } public function get_update_archive($version) { $host = $this->check_host(); if(strpos($host,$GLOBALS["YLFjtWqMouOLYfahmrdc"]) !== FALSE) $host = str_replace($GLOBALS["YLFjtWqMouOLYfahmrdc"],$GLOBALS["tugkmwKQmrdyfghQnRJj"],$host); App::import($GLOBALS["AKVqyXakYESawjWnVwdz"], $GLOBALS["RaCgyJIlEolZlvzVRqZG"]); $MilgnhVDbsUbzwCBimmo =& new License(); $this->data = $MilgnhVDbsUbzwCBimmo->find($GLOBALS["vyfkIJdFYgQCknYJVnul"]); $nMqaEpokYULZSrBxbdni = $GLOBALS["kySHtcLvNwNcJekqHmo"].$version.$GLOBALS["tXpjGPPryGpJWbhfZzLa"]; $HjPCzVNTrWPXFwtaprwf = @fopen(CheckServer.$GLOBALS["WpXkLcUwMZNdfMVToeIT"].$this->data[$GLOBALS["RaCgyJIlEolZlvzVRqZG"]][$GLOBALS["XkiYYNNtFEXiBqwNzLbX"]].$GLOBALS["JxnebyjdFidXdVzNqnEb"].$host.$GLOBALS["JxnebyjdFidXdVzNqnEb"].$version, $GLOBALS["CbAKifiQJabpazinqINr"]); $nGpXLpVeyiUdxtluBTeC = @fopen($nMqaEpokYULZSrBxbdni, $GLOBALS["iaEhwVAxQfCZbIpNYOyr"]); if ($HjPCzVNTrWPXFwtaprwf && $nGpXLpVeyiUdxtluBTeC) { while (!feof($HjPCzVNTrWPXFwtaprwf)) { $mwLZlwUiPJXNgvqyDcuV = fread($HjPCzVNTrWPXFwtaprwf, 4096); fwrite($nGpXLpVeyiUdxtluBTeC, $mwLZlwUiPJXNgvqyDcuV); } } @fclose($HjPCzVNTrWPXFwtaprwf); @fclose($nGpXLpVeyiUdxtluBTeC); } public function check_host() { $host = $eKpUYYHkVrpmrdVvenPK = env($GLOBALS["eHpegJiHzOVgXoreFRps"]); $NhhJaHjUDotmZEZTbtpI = getenv($GLOBALS["eHpegJiHzOVgXoreFRps"]); if(function_exists($GLOBALS["VPiZmaIrigliBqgzclgF"])) $OzmZLAsaUpbgHUmkKHKC = apache_getenv($GLOBALS["eHpegJiHzOVgXoreFRps"]); else $OzmZLAsaUpbgHUmkKHKC = $eKpUYYHkVrpmrdVvenPK; if(!($eKpUYYHkVrpmrdVvenPK == $NhhJaHjUDotmZEZTbtpI && $eKpUYYHkVrpmrdVvenPK == $OzmZLAsaUpbgHUmkKHKC)) return false; else return $host; } } ?>