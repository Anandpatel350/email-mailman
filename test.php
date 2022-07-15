<?php
class ABC
{
    public function obj()
    {
        echo "Function OBJ called ";
    }
}
class BCD extends ABC
{
    public function pqr()
    {
       $this->obj();
       echo "Function OBJ called";
    }
}
class DEF extends BCD
{
    public function xyz()
    {
        $this->pqr();
    }
}
$object=new DEF();
$object->xyz();
?>