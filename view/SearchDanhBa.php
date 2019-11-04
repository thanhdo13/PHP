<?php
session_start();
include_once("../model/entity/DanhBa.php");
$rsFromDB= DanhBa::getListFromDB();
$Namec= unserialize($_SESSION["Name"]);;
// if(isset($_GET["user"])){ 
//   $Namec=$_GET["user"];
// }
 ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styes for this template-->
<link href="../css/sb-admin.css" rel="stylesheet">
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
</head>
<h2 ><font color="#f40404" >Contacts</font></h2>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search" title="Type in a name">
<table id="myTable">
  <tr class="header">
    <th style="width:5%;"></th>
    <th style="width:40%;">Name</th>
    <th style="width:20%;">Phone</th>
    <th style="width:20%;">Email</th>
    <th style="width:15%;"></th>
  </tr>
  <tr><form action="SearchDanhBa.php" method="post">
    <th scope='row'></th>
    <td><input type="text" name="txt1" value=""></td>
    <td><input type="text" name="txt2" value=""></td>
    <td><input type="text" name="txt3" value=""></td>
    <input type="submit" name="submit" value="Add">
  </form></tr>
<?php
    foreach ($rsFromDB as $key => $value) {
      if($Namec!=$value->Name){
       $Ten=substr($value->Name,0,1);
        echo "<tr>";
        echo "<th scope='row'>$Ten</th>";
        echo "<td>$value->Name</td>";
        echo "<td>$value->Phone</td>";
        echo "<td>$value->Email</td>";
        echo "<td><a href='SearchDanhBa.php?edit=$value->Name'";
        echo  "class='btn btn-info'><i class='fas fa-edit'></i>Edit</a>";
        echo  "<a href='DeleteDanhBa.php?delete=$value->Name'";
        echo  "class='btn btn-danger'><i class='fas fa-trash-alt'></i>Delete</a></td></tr>";
      }
    }
      //Thêm
    if(isset($_POST["submit"])){
        $num1 = $_POST["txt1"];
        $num2 = $_POST["txt2"];
        $num3 = $_POST["txt3"];
        $con = new mysqli("localhost","root","","qlsv");
           if($con -> connect_error )
               die("Kết nối thất bại".$con->connect_error);
           //Thao tác với DB 
           $query = "insert into contact(Name,Phone,Email) values('$num1','$num2','$num3')";
           $con->query($query);
           $con->set_charset("utf8");
           $con->close();
           header("location:SearchDanhBa.php");
    }
    //Sửa
    if(isset($_GET["edit"])){
        $edit=$_GET["edit"];
        $con = new mysqli("localhost","root","","qlsv");
         if($con -> connect_error )
             die("Kết nối thất bại".$con->connect_error);
         //Thao tác với DB 
         $query = "select * from contact where Name='$edit'";
         $result= $con->query($query);
         if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
        $num5=$row['Name'];
        $num6=$row['Phone'];
        $num7 =$row['Email'];
         echo"<form action='EditDanhBa.php?edit=$edit' method='post'>";
         echo" <table>";
        echo" <tr><td>Name  :</td> <td> <input type='text' name='txt5' value='".$row['Name']."' placeholder='từ năm'> </td></tr><br>";
        echo"<tr><td>Phone :</td> <td> <input type='text' name='txt6' value='".$row["Phone"]."' placeholder='đến năm'> </td></tr><br>";
         echo"<tr><td>Email     :</td> <td> <input type='text' name='txt7' value='".$row["Email"]."' placeholder='lớp'> </td></tr><br>";
         echo"</table>";
         echo" <button type='submit2' value='submit2' name='submit2' > Save  </button>";
        echo" </form>";
        
        }
      }
         $con->set_charset("utf8");
         $con->close();
    }
?>
</table>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("th")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>