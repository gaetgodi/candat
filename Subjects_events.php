<?php
//BindEvents Method @1-C8C25372
function BindEvents()
{
    global $SUBJECTS1;
    global $SB_VARIABLES;
    $SUBJECTS1->ds->CCSEvents["AfterExecuteInsert"] = "SUBJECTS1_ds_AfterExecuteInsert";
    $SB_VARIABLES->SB_VARIABLES_TotalRecords->CCSEvents["BeforeShow"] = "SB_VARIABLES_SB_VARIABLES_TotalRecords_BeforeShow";
}
//End BindEvents Method

//SUBJECTS1_ds_AfterExecuteInsert @169-4B164C36
function SUBJECTS1_ds_AfterExecuteInsert(& $sender)
{
    $SUBJECTS1_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SUBJECTS1; //Compatibility
//End SUBJECTS1_ds_AfterExecuteInsert

//Declare Variable @243-5638C5E2
    global $id;
    $id = mysql_insert_id();
//End Declare Variable

//Custom Code @244-2A29BDB7
// -------------------------
    // Write your own code here.
	  $db = new clsDBcandat();
      $SQL = "INSERT INTO SB_DAYS (DY_id,SB_id,DY_NME) select DY_id,$id,DY_NME from ADMIN_DAY_NMS";

  //echo $SQL;
      $db->query($SQL);
      $db->close();
// -------------------------
//End Custom Code

//Close SUBJECTS1_ds_AfterExecuteInsert @169-A5E0FF0C
    return $SUBJECTS1_ds_AfterExecuteInsert;
}
//End Close SUBJECTS1_ds_AfterExecuteInsert

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	$db = new clsDBcandat();
//DEL    $SQL = "INSERT INTO ST_VARS select * from ADMIN_VAR_NMS";
//DEL    $db->query($SQL);
//DEL    $SQL = "update ST_VARS set ST_id=$id where ST_id=0";
//DEL    // echo $SQL;
//DEL    $db->query($SQL);
//DEL    $db->close();
//DEL  // -------------------------

//SB_VARIABLES_SB_VARIABLES_TotalRecords_BeforeShow @191-220BB671
function SB_VARIABLES_SB_VARIABLES_TotalRecords_BeforeShow(& $sender)
{
    $SB_VARIABLES_SB_VARIABLES_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SB_VARIABLES; //Compatibility
//End SB_VARIABLES_SB_VARIABLES_TotalRecords_BeforeShow

//Retrieve number of records @192-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close SB_VARIABLES_SB_VARIABLES_TotalRecords_BeforeShow @191-1E05CB4B
    return $SB_VARIABLES_SB_VARIABLES_TotalRecords_BeforeShow;
}
//End Close SB_VARIABLES_SB_VARIABLES_TotalRecords_BeforeShow
?>
