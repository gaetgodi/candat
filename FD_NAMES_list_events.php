<?php
//BindEvents Method @1-8E464AA2
function BindEvents()
{
    global $FD_NAMES;
    $FD_NAMES->Navigator->CCSEvents["BeforeShow"] = "FD_NAMES_Navigator_BeforeShow";
    $FD_NAMES->ds->CCSEvents["BeforeBuildSelect"] = "FD_NAMES_ds_BeforeBuildSelect";
}
//End BindEvents Method

//FD_NAMES_Navigator_BeforeShow @21-94161181
function FD_NAMES_Navigator_BeforeShow(& $sender)
{
    $FD_NAMES_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $FD_NAMES; //Compatibility
//End FD_NAMES_Navigator_BeforeShow

//Hide-Show Component @22-0DB41530
    $Parameter1 = $Container->DataSource->PageCount();
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close FD_NAMES_Navigator_BeforeShow @21-D6B73EC2
    return $FD_NAMES_Navigator_BeforeShow;
}
//End Close FD_NAMES_Navigator_BeforeShow

//FD_NAMES_ds_BeforeBuildSelect @5-5D5FFB58
function FD_NAMES_ds_BeforeBuildSelect(& $sender)
{
    $FD_NAMES_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $FD_NAMES; //Compatibility
//End FD_NAMES_ds_BeforeBuildSelect

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
//Advanced Search
//    $show = true;
    $show = false;
    global $FD_NAMESSearch;
    $s_keyword = CCGetParam("s_keyword", "");
    $searchConditions = CCGetParam("searchConditions", "");
    if (!in_array($searchConditions, array("1", "2", "3", "4"))) $searchConditions = 1;
    $keywords = preg_split("/[\s,]+/", trim($s_keyword));
    if (strlen($s_keyword)) {
        $f_FD_NME = "";
        $f_FD_NMF = "";
        // Any of words
        if ($searchConditions == "1") {
            foreach ($keywords as $keyword) {
                $keyword = str_replace("'", "''", trim($keyword));
                if (strlen($f_FD_NME)) $f_FD_NME .= " OR ";
                if (strlen($f_FD_NMF)) $f_FD_NMF .= " OR ";
                $f_FD_NME .= "FD_NME LIKE '%" . $keyword . "%'";
                $f_FD_NMF .= "FD_NMF LIKE '%" . $keyword . "%'";
				 }
//						echo $searchConditions.' Got here'."<BR>";
        // All words
        } else if ($searchConditions == "2") {
            foreach ($keywords as $keyword) {
                $keyword = str_replace("'", "''", trim($keyword));
                if (strlen($f_FD_NME)) $f_FD_NME .= " AND ";
                if (strlen($f_FD_NMF)) $f_FD_NMF .= " AND ";
                $f_FD_NME .= "FD_NME LIKE '%" . $keyword . "%'";
                $f_FD_NMF .= "FD_NMF LIKE '%" . $keyword . "%'";
            }
		// All words in either field
        } else if ($searchConditions == "4") {
            foreach ($keywords as $keyword) {
                $keyword = str_replace("'", "''", trim($keyword));
                if (strlen($f_FD_NME)) $f_FD_NME .= " AND ";
                if (strlen($f_FD_NMF)) $f_FD_NMF .= " AND ";
                $f_FD_NME .= "(FD_NME LIKE '%" . $keyword . "%'";
                $f_FD_NME .= "OR FD_NMF LIKE '%" . $keyword . "%')";
                $f_FD_NMF .= "(FD_NME LIKE '%" . $keyword . "%'";
                $f_FD_NMF .= "OR FD_NMF LIKE '%" . $keyword . "%')";    
								}				
        // Exact Phrase
        } else if ($searchConditions == "3") {
            $keyword = str_replace("'", "''", $s_keyword);
            $f_FD_NME = "FD_NME LIKE '%" . $keyword . "%'";
            $f_FD_NMF = "FD_NMF LIKE '%" . $keyword . "%'";
        }
        if (strlen($Container->DataSource->Where) > 0 ) $Container->DataSource->Where .= " AND ";
        $Container->DataSource->Where .= "((" . $f_FD_NME . ")";
        if (strlen($f_FD_NMF) && ($searchConditions != "4"))
            $Container->DataSource->Where .= "  OR (". $f_FD_NMF .")";
				else {
				//		$Container->DataSource->Where .= " AND (". $f_FD_NMF .")";
				}
        $Container->DataSource->Where .= " ) ";
		if ($show) {echo $Container->DataSource->Where ;}
    } else {
        $FD_NAMESSearch->s_keyword->SetValue("");
    }
//End Advanced Search
// -------------------------
//End Custom Code

//Close FD_NAMES_ds_BeforeBuildSelect @5-5686EECF
    return $FD_NAMES_ds_BeforeBuildSelect;
}
//End Close FD_NAMES_ds_BeforeBuildSelect


?>
