<?php
class DanhBa{
    var $Name;
    var $Phone;
    var $Email;
    function __construct($Name,$Phone,$Email)
    {
        $this->Name=$Name;
        $this->Phone=$Phone;
        $this->Email=$Email;
    }
    static function getListFromDB(){

        //Kết nối với DB
        $con = new mysqli("localhost","root","","qlsv");
        if($con -> connect_error )
            die("Kết nối thất bại".$con->connect_error);
        //Thao tác với DB 
        $query = "select * from contact";
        $result= $con->query($query);
        $rs=array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
            array_push($rs,new DanhBa($row["Name"],$row["Phone"],$row["Email"]));
            }
        }
        // Đóng kết nối với DB
        $con->close();
        return $rs;
    }
}
?>