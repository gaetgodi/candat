<?php
//Include Common Files @1-75A28E56
define("RelativePath", "../../../../CodeChargeStudio4/Examples/CCSExamplePack2");
define("PathToCurrentPage", "../../../Program Files/CodeChargeStudio4/Projects/candat/");
define("FileName", "DependentListBox_desc.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-076323D4
include_once(RelativePath . "/../../../Program Files/CodeChargeStudio4/Projects/Header.php");
//End Include Page implementation

//Initialize Page @1-816D7925
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "DependentListBox_desc.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../../../../CodeChargeStudio4/Examples/CCSExamplePack2/";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-86F61FA8
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $MainPage);
$Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Link1->Page = "DependentListBox.php";
$MainPage->Header = & $Header;
$MainPage->Link1 = & $Link1;

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-A62E3C4C
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate();
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../../../../CodeChargeStudio4/Examples/CCSExamplePack2/");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-47111282
$Header->Operations();
//End Execute Components

//Go to destination page @1-7CD336F6
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-BA8E3129
$Header->Show();
$Link1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-DB5C2DEA
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
