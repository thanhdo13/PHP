<?php
class NguoiDung{
    var $Name;
    var $user;
    var $password;
    function __construct($Name,$user,$password)
    {
        $this->Name=$Name;
        $this->user=$user;
        $this->password=$password;
    }
    static function getListFromDB(){

        //Kết nối với DB
        $con = new mysqli("localhost","root","","qlsv");
        if($con -> connect_error )
            die("Kết nối thất bại".$con->connect_error);
        //Thao tác với DB 
        $query = "select * from dangnhap";
        $result= $con->query($query);
        $rs=array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
            array_push($rs,new NguoiDung($row["Name"],$row["User"],$row["Password"]));
            }
        }
        // Đóng kết nối với DB
        $con->close();
        return $rs;
    }
}
?>