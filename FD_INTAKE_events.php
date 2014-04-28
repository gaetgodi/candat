<?php
//BindEvents Method @1-458A645B
function BindEvents()
{
    global $INTAKE;
    $INTAKE->INTAKE_TotalRecords->CCSEvents["BeforeShow"] = "INTAKE_INTAKE_TotalRecords_BeforeShow";
    $INTAKE->CCSEvents["BeforeShowRow"] = "INTAKE_BeforeShowRow";
}
//End BindEvents Method

//INTAKE_INTAKE_TotalRecords_BeforeShow @8-BA79ECBB
function INTAKE_INTAKE_TotalRecords_BeforeShow(& $sender)
{
    $INTAKE_INTAKE_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $INTAKE; //Compatibility
//End INTAKE_INTAKE_TotalRecords_BeforeShow

//Retrieve number of records @9-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close INTAKE_INTAKE_TotalRecords_BeforeShow @8-F02C2107
    return $INTAKE_INTAKE_TotalRecords_BeforeShow;
}
//End Close INTAKE_INTAKE_TotalRecords_BeforeShow

//INTAKE_BeforeShowRow @2-9AD607AE
function INTAKE_BeforeShowRow(& $sender)
{
    $INTAKE_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $INTAKE; //Compatibility
//End INTAKE_BeforeShowRow

//Set Row Style @19-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close INTAKE_BeforeShowRow @2-657CF734
    return $INTAKE_BeforeShowRow;
}
//End Close INTAKE_BeforeShowRow
?>
