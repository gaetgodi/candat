<?php
//BindEvents Method @1-642C2CAB
function BindEvents()
{
    global $UNIT_DESC;
    $UNIT_DESC->Navigator->CCSEvents["BeforeShow"] = "UNIT_DESC_Navigator_BeforeShow";
}
//End BindEvents Method

//UNIT_DESC_Navigator_BeforeShow @18-DAFDECC6
function UNIT_DESC_Navigator_BeforeShow(& $sender)
{
    $UNIT_DESC_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $UNIT_DESC; //Compatibility
//End UNIT_DESC_Navigator_BeforeShow

//Hide-Show Component @19-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close UNIT_DESC_Navigator_BeforeShow @18-A0215689
    return $UNIT_DESC_Navigator_BeforeShow;
}
//End Close UNIT_DESC_Navigator_BeforeShow


?>
