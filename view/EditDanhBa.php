<?php
    include_once("../model/entity/DanhBa.php");
    $line3= DanhBa::getListFromDB();
    if(isset($_GET["edit"])&&isset($_POST["submit2"])){ 
        $id=$_GET["edit"];
        // $lines2 = file("../resource/learninghistory.txt",FILE_IGNORE_NEW_LINES);
        // $fo = fopen("../resource/filephu.txt","w");  
        $num5 = $_POST["txt5"];
        $num6 = $_POST["txt6"];
        $num7 = $_POST["txt7"]; 
         //Kết nối với DB
         $con = new mysqli("localhost","root","","qlsv");
         if($con -> connect_error )
             die("Kết nối thất bại".$con->connect_error);
         //Thao tác với DB 
         $query = "UPDATE contact SET Name='$num5',Phone='$num6',Email='$num7' WHERE Name='$id'";
         $con->query($query);
         $con->set_charset("utf8");
        $con->close();

  } 
  header("location:SearchDanhBa.php");
    ?>