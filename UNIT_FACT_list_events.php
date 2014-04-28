<?php
//BindEvents Method @1-46060F4A
function BindEvents()
{
    global $UNIT_FACT;
    $UNIT_FACT->Navigator->CCSEvents["BeforeShow"] = "UNIT_FACT_Navigator_BeforeShow";
}
//End BindEvents Method

//UNIT_FACT_Navigator_BeforeShow @13-9737A706
function UNIT_FACT_Navigator_BeforeShow(& $sender)
{
    $UNIT_FACT_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $UNIT_FACT; //Compatibility
//End UNIT_FACT_Navigator_BeforeShow

//Hide-Show Component @14-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close UNIT_FACT_Navigator_BeforeShow @13-41C999F1
    return $UNIT_FACT_Navigator_BeforeShow;
}
//End Close UNIT_FACT_Navigator_BeforeShow


?>
