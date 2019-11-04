<?php
session_start();
include_once("../model/entity/NguoiDung.php");
$rsFromDB= NguoiDung::getListFromDB();
$in4="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $userName=$_REQUEST["user"];
    $pw=$_REQUEST["password"];
    foreach ($rsFromDB as $key => $value) {
        if($userName==$value->user && $pw==$value->password){
            header("location:SearchDanhBa.php");
            $_SESSION["Name"]= serialize($value->Name);
        }     
    }
    $in4="Tên đăng nhập hoặc mật khẩu không đúng!";  
}
 ?>
 <div id="content-wrapper">
    <div class="container-fluid">
<form action="DangNhap.php" method="post">
    <table>
        <tr>
            <td>user : </td>
            <td><input type="text" name="user" value=""></td>
        </tr>
        <tr>
            <td>password : </td>
            <td><input type="password" name="password" value=""></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="checkbox" name="ck1"> Nhớ
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Đăng Nhập">
                <?php if(strlen($in4) !=0){?>
                    <div class="alert alert-danger">
                        <?php echo $in4;?>
                    </div>
                <?php }?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <a href="DangNhap.php">Quên mật khẩu</a>
            </td>
        </tr>
    </table>
</form>
    </div>
</div>