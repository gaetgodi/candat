<?php
//BindEvents Method @1-FA3AC75D
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  
//DEL  //Advanced Search @30-2E9D3DED
//DEL       global $FD_NAMES1;
//DEL      $s_keyword = CCGetParam("s_keyword", "");
//DEL      $searchConditions = CCGetParam("searchConditions", "");
//DEL      if (!in_array($searchConditions, array("1", "2", "3", "4"))) $searchConditions = 1;
//DEL      $keywords = split(" ", trim($s_keyword));
//DEL      if (strlen($s_keyword)) {
//DEL          $f_FD_NME = "";
//DEL          $f_FD_NMF = "";
//DEL          // Any of words
//DEL          if ($searchConditions == "1") {
//DEL              foreach ($keywords as $keyword) {
//DEL                  $keyword = str_replace("'", "''", trim($keyword));
//DEL                  if (strlen($f_FD_NME)) $f_FD_NME .= " OR ";
//DEL                  if (strlen($f_FD_NMF)) $f_FD_NMF .= " OR ";
//DEL                  $f_FD_NME .= "FD_NME LIKE '%" . $keyword . "%'";
//DEL                  $f_FD_NMF .= "FD_NMF LIKE '%" . $keyword . "%'";
//DEL              }
//DEL  //						echo $searchConditions.' Got here'."<BR>";
//DEL          // All words
//DEL          } else if ($searchConditions == "2") {
//DEL              foreach ($keywords as $keyword) {
//DEL                  $keyword = str_replace("'", "''", trim($keyword));
//DEL                  if (strlen($f_FD_NME)) $f_FD_NME .= " AND ";
//DEL                  if (strlen($f_FD_NMF)) $f_FD_NMF .= " AND ";
//DEL                  $f_FD_NME .= "FD_NME LIKE '%" . $keyword . "%'";
//DEL                  $f_FD_NMF .= "FD_NMF LIKE '%" . $keyword . "%'";
//DEL              }
//DEL  						// All words in either field
//DEL          } else if ($searchConditions == "4") {
//DEL              foreach ($keywords as $keyword) {
//DEL                  $keyword = str_replace("'", "''", trim($keyword));
//DEL                  if (strlen($f_FD_NME)) $f_FD_NME .= " AND ";
//DEL                  if (strlen($f_FD_NMF)) $f_FD_NMF .= " AND ";
//DEL                  $f_FD_NME .= "(FD_NME LIKE '%" . $keyword . "%'";
//DEL                  $f_FD_NME .= "OR FD_NMF LIKE '%" . $keyword . "%')";
//DEL                  $f_FD_NMF .= "(FD_NME LIKE '%" . $keyword . "%'";
//DEL                  $f_FD_NMF .= "OR FD_NMF LIKE '%" . $keyword . "%')";    
//DEL  								}
//DEL  //								echo $f_FD_NME."<br>";
//DEL  //								echo $f_FD_NFE."<br>";	
//DEL  								
//DEL          // Exact Phrase
//DEL          } else if ($searchConditions == "3") {
//DEL              $keyword = str_replace("'", "''", $s_keyword);
//DEL              $f_FD_NME = "FD_NME LIKE '%" . $keyword . "%'";
//DEL              $f_FD_NMF = "FD_NMF LIKE '%" . $keyword . "%'";
//DEL          }
//DEL          if (strlen($Container->DataSource->Where) > 0 ) $Container->DataSource->Where .= " AND ";
//DEL          $Container->DataSource->Where .= "((" . $f_FD_NME . ")";
//DEL          if (strlen($f_FD_NMF) && ($searchConditions != "4"))
//DEL              $Container->DataSource->Where .= "  OR (". $f_FD_NMF .")";
//DEL  				else {
//DEL  				//		$Container->DataSource->Where .= " AND (". $f_FD_NMF .")";
//DEL  				}
//DEL          $Container->DataSource->Where .= " ) ";
//DEL  //						echo $Container->DataSource->Where ;
//DEL      } else {
//DEL          $FD_NAMES1->s_keyword->SetValue("");
//DEL      }
//DEL  //End Advanced Search
//DEL  // -------------------------

//Page_OnInitializeView @1-789FEB92
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $index_old; //Compatibility
//End Page_OnInitializeView

//Custom Code @2-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView
?>