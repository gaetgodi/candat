<?php
//Include Common Files @1-8FD2DC37
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "UNIT_FACT_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridUNIT_FACT { //UNIT_FACT class @2-FD9A0276

//Variables @2-F742D2D4

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
    public $Sorter_FD_ID;
    public $Sorter_MSR_ID;
    public $Sorter_CONV_FAC;
//End Variables

//Class_Initialize Event @2-0ACBD464
    function clsGridUNIT_FACT($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "UNIT_FACT";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid UNIT_FACT";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsUNIT_FACTDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("UNIT_FACTOrder", "");
        $this->SorterDirection = CCGetParam("UNIT_FACTDir", "");

        $this->FD_ID = new clsControl(ccsLabel, "FD_ID", "FD_ID", ccsInteger, "", CCGetRequestParam("FD_ID", ccsGet, NULL), $this);
        $this->MSR_ID = new clsControl(ccsLabel, "MSR_ID", "MSR_ID", ccsInteger, "", CCGetRequestParam("MSR_ID", ccsGet, NULL), $this);
        $this->CONV_FAC = new clsControl(ccsLabel, "CONV_FAC", "CONV_FAC", ccsText, "", CCGetRequestParam("CONV_FAC", ccsGet, NULL), $this);
        $this->Sorter_FD_ID = new clsSorter($this->ComponentName, "Sorter_FD_ID", $FileName, $this);
        $this->Sorter_MSR_ID = new clsSorter($this->ComponentName, "Sorter_MSR_ID", $FileName, $this);
        $this->Sorter_CONV_FAC = new clsSorter($this->ComponentName, "Sorter_CONV_FAC", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-C4DC6779
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;


        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["FD_ID"] = $this->FD_ID->Visible;
            $this->ControlsVisible["MSR_ID"] = $this->MSR_ID->Visible;
            $this->ControlsVisible["CONV_FAC"] = $this->CONV_FAC->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->FD_ID->SetValue($this->DataSource->FD_ID->GetValue());
                $this->MSR_ID->SetValue($this->DataSource->MSR_ID->GetValue());
                $this->CONV_FAC->SetValue($this->DataSource->CONV_FAC->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->FD_ID->Show();
                $this->MSR_ID->Show();
                $this->CONV_FAC->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Sorter_FD_ID->Show();
        $this->Sorter_MSR_ID->Show();
        $this->Sorter_CONV_FAC->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-084F9881
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->FD_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MSR_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CONV_FAC->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End UNIT_FACT Class @2-FCB6E20C

class clsUNIT_FACTDataSource extends clsDBcandat {  //UNIT_FACTDataSource Class @2-46C8C8CE

//DataSource Variables @2-6EDF2EA4
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $FD_ID;
    public $MSR_ID;
    public $CONV_FAC;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-F73C8155
    function clsUNIT_FACTDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid UNIT_FACT";
        $this->Initialize();
        $this->FD_ID = new clsField("FD_ID", ccsInteger, "");
        
        $this->MSR_ID = new clsField("MSR_ID", ccsInteger, "");
        
        $this->CONV_FAC = new clsField("CONV_FAC", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-FD47F04E
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_FD_ID" => array("FD_ID", ""), 
            "Sorter_MSR_ID" => array("MSR_ID", ""), 
            "Sorter_CONV_FAC" => array("CONV_FAC", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-1B84697C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM UNIT_FACT";
        $this->SQL = "SELECT FD_ID, MSR_ID, CONV_FAC \n\n" .
        "FROM UNIT_FACT {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-5BAE974C
    function SetValues()
    {
        $this->FD_ID->SetDBValue(trim($this->f("FD_ID")));
        $this->MSR_ID->SetDBValue(trim($this->f("MSR_ID")));
        $this->CONV_FAC->SetDBValue($this->f("CONV_FAC"));
    }
//End SetValues Method

} //End UNIT_FACTDataSource Class @2-FCB6E20C

//Include Page implementation @15-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation

//Include Page implementation @16-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

//Initialize Page @1-CB1DF0BE
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
$TemplateFileName = "UNIT_FACT_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-4677CCA5
include_once("./UNIT_FACT_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D881D484
$DBcandat = new clsDBcandat();
$MainPage->Connections["candat"] = & $DBcandat;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$UNIT_FACT = new clsGridUNIT_FACT("", $MainPage);
$Header = new clsHeader("", "Header", $MainPage);
$Header->Initialize();
$Footer = new clsFooter("", "Footer", $MainPage);
$Footer->Initialize();
$MainPage->UNIT_FACT = & $UNIT_FACT;
$MainPage->Header = & $Header;
$MainPage->Footer = & $Footer;
$UNIT_FACT->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-E710DB26
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-351F985C
$Header->Operations();
$Footer->Operations();
//End Execute Components

//Go to destination page @1-363A7EF4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcandat->close();
    header("Location: " . $Redirect);
    unset($UNIT_FACT);
    $Header->Class_Terminate();
    unset($Header);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CE1540D9
$UNIT_FACT->Show();
$Header->Show();
$Footer->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-57DA88B3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcandat->close();
unset($UNIT_FACT);
$Header->Class_Terminate();
unset($Header);
$Footer->Class_Terminate();
unset($Footer);
unset($Tpl);
//End Unload Page


?>
