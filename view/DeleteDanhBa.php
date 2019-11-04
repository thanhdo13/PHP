<?php
    header("SearchDanhBa.php");
    include_once("../model/entity/DanhBa.php");
    $line3= DanhBa::getListFromDB();
    if(isset($_GET["delete"])){
        $id=$_GET["delete"];
        $con = new mysqli("localhost","root","","qlsv");
         if($con -> connect_error )
             die("Kết nối thất bại".$con->connect_error);
         //Thao tác với DB 
         $query = "delete from contact where Name='$id'";
         $con->query($query);
         $con->set_charset("utf8");
         $con->close();
        //Xóa file
        // $lines = file("../resource/learninghistory.txt",FILE_IGNORE_NEW_LINES);
        // $fo = fopen("../resource/filephu.txt","w");    
        
        //  foreach ($lines as $key => $value) {
    //         $arr = explode("#",$value);
    //         if($arr[0]!=$id)
    //             fwrite($fo,$arr[0]."#".$arr[1]."#".$arr[2]."#".$arr[3]."#".$arr[4]."#101\n");  
    //     }
    //     fclose($fo); 
    //     $lines1 = file("../resource/filephu.txt",FILE_IGNORE_NEW_LINES);
    //     $fo2 = fopen("../resource/learninghistory.txt","w"); 
    // foreach ($lines1 as $key => $value) {
    //         $arr1 = explode("#",$value);
    //             fwrite($fo2,$arr1[0]."#".$arr1[1]."#".$arr1[2]."#".$arr1[3]."#".$arr1[4]."#101\n");  
    //     }
        
    //     fclose($fo2); 
    }
    header("location: SearchDanhBa.php");
?>