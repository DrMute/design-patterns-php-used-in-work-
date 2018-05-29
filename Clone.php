<?php 
class CD
{
    public $band='';
    public $title='';
    public $stractList=array();

    public function __construct($id)
    {

        /*$handle=CD::where('id',$id)->first();*/
        $handle=(object)[];
        $handle->band='Sony';
        $handle->title='gloden song 1998';
        $this->band=$handle->band;
        $this->title=$handle->title;
    }
    public function  buy()
    {
        var_dump($this);
    }

}

class MixtapeCD extends CD
{
    public function __clone()
    {
        $this->title='Mixtape';
    }

}
$band_id=12;
$CD=new MixtapeCD($band_id);
$stractList1[]=array('brrr','goodbye');
$stractList1[]=array('what it mens','brrr');

foreach ($stractList1 as $mixed)
{
    $cd =clone $CD;
    $cd->stractList=$mixed;
    $cd->buy();
}
