
<?php 


 interface IDataAccess{

     function Gets();
     function Insert(array $obj);
     function Update(array $obj);
     function Delete();
     function GetById($id);


}

 ?>