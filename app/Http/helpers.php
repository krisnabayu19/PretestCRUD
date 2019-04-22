<?php
    if (!function_exists("format_rupiah")) {
        function format_rupiah($uang) {
            if(floor(strlen($uang) / 3) > 0){
                for ($i=3; $i < strlen($uang); $i = $i + 4) { 
                    $uang = substr_replace($uang, ".", -$i, 0);
                }
            }
            return "Rp".$uang.",00";
        }
    }