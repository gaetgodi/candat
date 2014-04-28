<?php
//BindEvents Method @1-7AF24E4B
function BindEvents()
{
    global $STUDIES1;
    global $ST_VARS;
    global $ST_MEALS;
    $STUDIES1->ds->CCSEvents["AfterExecuteInsert"] = "STUDIES1_ds_AfterExecuteInsert";
    $STUDIES1->CCSEvents["BeforeDelete"] = "STUDIES1_BeforeDelete";
    $STUDIES1->CCSEvents["AfterDelete"] = "STUDIES1_AfterDelete";
    $ST_VARS->ST_VARS_TotalRecords->CCSEvents["BeforeShow"] = "ST_VARS_ST_VARS_TotalRecords_BeforeShow";
    $ST_VARS->CCSEvents["BeforeShowRow"] = "ST_VARS_BeforeShowRow";
    $ST_MEALS->ST_MEALS_TotalRecords->CCSEvents["BeforeShow"] = "ST_MEALS_ST_MEALS_TotalRecords_BeforeShow";
    $ST_MEALS->CCSEvents["BeforeShowRow"] = "ST_MEALS_BeforeShowRow";
}
//End BindEvents Method

//STUDIES1_ds_AfterExecuteInsert @15-4BB78575
function STUDIES1_ds_AfterExecuteInsert(& $sender)
{
    $STUDIES1_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $STUDIES1; //Compatibility
//End STUDIES1_ds_AfterExecuteInsert

//Declare Variable @41-5638C5E2
    global $id;
    $id = mysql_insert_id();
//End Declare Variable

//Custom Code @42-2A29BDB7
// -------------------------
    // Write your own code here.
  $db = new clsDBcandat();
  $SQL = "update ADMIN_VAR_NMS set ST_id=$id";
  //echo $SQL;
  $db->query($SQL);
  $SQL = "INSERT INTO ST_VARS (VAR_id,ST_id,VR_NME) select VAR_id,ST_id,VR_NME from ADMIN_VAR_NMS";
  $db->query($SQL);
  $SQL = "update ADMIN_Meal_NMS set ST_id=$id";
  //echo $SQL;
  $db->query($SQL);
  $SQL = "INSERT INTO ST_MEALS (ML_id,ST_id,ML_NME) select ML_id,ST_id,ML_NME from ADMIN_Meal_NMS";
  $db->query($SQL);
  $db->close();
// -------------------------
//End Custom Code

//Close STUDIES1_ds_AfterExecuteInsert @15-E365A373
    return $STUDIES1_ds_AfterExecuteInsert;
}
//End Close STUDIES1_ds_AfterExecuteInsert

//STUDIES1_BeforeDelete @15-0F7E6A0A
function STUDIES1_BeforeDelete(& $sender)
{
    $STUDIES1_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $STUDIES1; //Compatibility
//End STUDIES1_BeforeDelete

//Save Control Value @44-95B05CFD
    global $id;
    $id = $Container->ST_id->GetValue();
//End Save Control Value

//Close STUDIES1_BeforeDelete @15-A7FB6616
    return $STUDIES1_BeforeDelete;
}
//End Close STUDIES1_BeforeDelete

//STUDIES1_AfterDelete @15-585B5560
function STUDIES1_AfterDelete(& $sender)
{
    $STUDIES1_AfterDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $STUDIES1; //Compatibility
//End STUDIES1_AfterDelete

//Custom Code @45-2A29BDB7
// -------------------------
    // Write your own code here.
	global $id;
   // $id = $Container->ST_id->GetValue();
	$db = new clsDBcandat();
	$SQL ="DELETE FROM ST_VARS WHERE ST_id =$id";
//	echo $SQL;
	$db->query($SQL);
	$SQL ="DELETE FROM ST_MEALS WHERE ST_id =$id";
//	echo $SQL;
	$db->query($SQL);
	$db->close();
// -------------------------
//End Custom Code

//Close STUDIES1_AfterDelete @15-80095AD9
    return $STUDIES1_AfterDelete;
}
//End Close STUDIES1_AfterDelete

//ST_VARS_ST_VARS_TotalRecords_BeforeShow @49-05723D39
function ST_VARS_ST_VARS_TotalRecords_BeforeShow(& $sender)
{
    $ST_VARS_ST_VARS_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ST_VARS; //Compatibility
//End ST_VARS_ST_VARS_TotalRecords_BeforeShow

//Retrieve number of records @50-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close ST_VARS_ST_VARS_TotalRecords_BeforeShow @49-1FD9EFD8
    return $ST_VARS_ST_VARS_TotalRecords_BeforeShow;
}
//End Close ST_VARS_ST_VARS_TotalRecords_BeforeShow

//ST_VARS_BeforeShowRow @46-F0A09054
function ST_VARS_BeforeShowRow(& $sender)
{
    $ST_VARS_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ST_VARS; //Compatibility
//End ST_VARS_BeforeShowRow

//Set Row Style @55-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close ST_VARS_BeforeShowRow @46-B6B45979
    return $ST_VARS_BeforeShowRow;
}
//End Close ST_VARS_BeforeShowRow

//ST_MEALS_ST_MEALS_TotalRecords_BeforeShow @80-6655547A
function ST_MEALS_ST_MEALS_TotalRecords_BeforeShow(& $sender)
{
    $ST_MEALS_ST_MEALS_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ST_MEALS; //Compatibility
//End ST_MEALS_ST_MEALS_TotalRecords_BeforeShow

//Retrieve number of records @81-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close ST_MEALS_ST_MEALS_TotalRecords_BeforeShow @80-74F0FAEF
    return $ST_MEALS_ST_MEALS_TotalRecords_BeforeShow;
}
//End Close ST_MEALS_ST_MEALS_TotalRecords_BeforeShow

//ST_MEALS_BeforeShowRow @77-74A25B73
function ST_MEALS_BeforeShowRow(& $sender)
{
    $ST_MEALS_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ST_MEALS; //Compatibility
//End ST_MEALS_BeforeShowRow

//Set Row Style @86-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close ST_MEALS_BeforeShowRow @77-B268E360
    return $ST_MEALS_BeforeShowRow;
}
//End Close ST_MEALS_BeforeShowRow

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	$Component>SetValue($STid);
//DEL  // -------------------------


?>
