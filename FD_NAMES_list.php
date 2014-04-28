<?php
//Include Common Files @1-B195CBC7
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "FD_NAMES_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordFD_NAMESSearch { //FD_NAMESSearch Class @2-AE49E40C

//Variables @2-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @2-BCF73FA0
    function clsRecordFD_NAMESSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record FD_NAMESSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "FD_NAMESSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_keyword = new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->searchConditions = new clsControl(ccsListBox, "searchConditions", "searchConditions", ccsText, "", CCGetRequestParam("searchConditions", $Method, NULL), $this);
            $this->searchConditions->DSType = dsListOfValues;
            $this->searchConditions->Values = array(array("1", "Any of words"), array("2", "All words"), array("3", "Exact Phrase"), array("4", "All words in either field"));
            $this->SB_id = new clsControl(ccsListBox, "SB_id", "SB_id", ccsText, "", CCGetRequestParam("SB_id", $Method, NULL), $this);
            $this->SB_id->DSType = dsTable;
            $this->SB_id->DataSource = new clsDBcandat();
            $this->SB_id->ds = & $this->SB_id->DataSource;
            $this->SB_id->DataSource->SQL = "SELECT SB_CODE, ST_id, SB_id \n" .
"FROM SUBJECTS {SQL_Where} {SQL_OrderBy}";
            list($this->SB_id->BoundColumn, $this->SB_id->TextColumn, $this->SB_id->DBFormat) = array("SB_id", "SB_CODE", "");
            $this->SB_id->DataSource->Parameters["urlST_id"] = CCGetFromGet("ST_id", NULL);
            $this->SB_id->DataSource->wp = new clsSQLParameters();
            $this->SB_id->DataSource->wp->AddParameter("1", "urlST_id", ccsInteger, "", "", $this->SB_id->DataSource->Parameters["urlST_id"], "", false);
            $this->SB_id->DataSource->wp->Criterion[1] = $this->SB_id->DataSource->wp->Operation(opEqual, "ST_id", $this->SB_id->DataSource->wp->GetDBValue("1"), $this->SB_id->DataSource->ToSQL($this->SB_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->SB_id->DataSource->Where = 
                 $this->SB_id->DataSource->wp->Criterion[1];
            $this->MLS_id = new clsControl(ccsListBox, "MLS_id", "MLS_id", ccsText, "", CCGetRequestParam("MLS_id", $Method, NULL), $this);
            $this->MLS_id->DSType = dsTable;
            $this->MLS_id->DataSource = new clsDBcandat();
            $this->MLS_id->ds = & $this->MLS_id->DataSource;
            $this->MLS_id->DataSource->SQL = "SELECT MLS_id, ML_id, ML_NME \n" .
"FROM ST_MEALS {SQL_Where} {SQL_OrderBy}";
            list($this->MLS_id->BoundColumn, $this->MLS_id->TextColumn, $this->MLS_id->DBFormat) = array("MLS_id", "ML_NME", "");
            $this->MLS_id->DataSource->Parameters["urlST_id"] = CCGetFromGet("ST_id", NULL);
            $this->MLS_id->DataSource->wp = new clsSQLParameters();
            $this->MLS_id->DataSource->wp->AddParameter("1", "urlST_id", ccsInteger, "", "", $this->MLS_id->DataSource->Parameters["urlST_id"], "", false);
            $this->MLS_id->DataSource->wp->Criterion[1] = $this->MLS_id->DataSource->wp->Operation(opEqual, "ST_id", $this->MLS_id->DataSource->wp->GetDBValue("1"), $this->MLS_id->DataSource->ToSQL($this->MLS_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->MLS_id->DataSource->Where = 
                 $this->MLS_id->DataSource->wp->Criterion[1];
            $this->DY_id = new clsControl(ccsListBox, "DY_id", "DY_id", ccsInteger, "", CCGetRequestParam("DY_id", $Method, NULL), $this);
            $this->DY_id->DSType = dsTable;
            $this->DY_id->DataSource = new clsDBcandat();
            $this->DY_id->ds = & $this->DY_id->DataSource;
            $this->DY_id->DataSource->SQL = "SELECT * \n" .
"FROM SB_DAYS {SQL_Where} {SQL_OrderBy}";
            list($this->DY_id->BoundColumn, $this->DY_id->TextColumn, $this->DY_id->DBFormat) = array("DY_id", "DY_DATE", "");
        }
    }
//End Class_Initialize Event

//Validate Method @2-F8EB8AD1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->searchConditions->Validate() && $Validation);
        $Validation = ($this->SB_id->Validate() && $Validation);
        $Validation = ($this->MLS_id->Validate() && $Validation);
        $Validation = ($this->DY_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->searchConditions->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SB_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->MLS_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DY_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-7B46A0BC
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->searchConditions->Errors->Count());
        $errors = ($errors || $this->SB_id->Errors->Count());
        $errors = ($errors || $this->MLS_id->Errors->Count());
        $errors = ($errors || $this->DY_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @2-18AD643C
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = $FileName . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_keyword", "searchConditions", "SB_id", "MLS_id", "DY_id", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-8C51A2DB
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->searchConditions->Prepare();
        $this->SB_id->Prepare();
        $this->MLS_id->Prepare();
        $this->DY_id->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->searchConditions->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SB_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->MLS_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DY_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_DoSearch->Show();
        $this->s_keyword->Show();
        $this->searchConditions->Show();
        $this->SB_id->Show();
        $this->MLS_id->Show();
        $this->DY_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End FD_NAMESSearch Class @2-FCB6E20C

class clsGridFD_NAMES { //FD_NAMES class @5-BB94BF04

//Variables @5-A58D39BA

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
    public $Sorter_FD_CODE;
    public $Sorter_FD_GRP_ID;
    public $Sorter_FD_NME;
    public $Sorter_FD_NMF;
//End Variables

//Class_Initialize Event @5-FA18FCBA
    function clsGridFD_NAMES($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "FD_NAMES";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid FD_NAMES";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsFD_NAMESDataSource($this);
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
        $this->SorterName = CCGetParam("FD_NAMESOrder", "");
        $this->SorterDirection = CCGetParam("FD_NAMESDir", "");

        $this->FD_CODE = new clsControl(ccsLink, "FD_CODE", "FD_CODE", ccsInteger, "", CCGetRequestParam("FD_CODE", ccsGet, NULL), $this);
        $this->FD_CODE->Page = "FD_INTAKE.php";
        $this->FD_GRP_ID = new clsControl(ccsLabel, "FD_GRP_ID", "FD_GRP_ID", ccsInteger, "", CCGetRequestParam("FD_GRP_ID", ccsGet, NULL), $this);
        $this->FD_NME = new clsControl(ccsLabel, "FD_NME", "FD_NME", ccsText, "", CCGetRequestParam("FD_NME", ccsGet, NULL), $this);
        $this->FD_NMF = new clsControl(ccsLabel, "FD_NMF", "FD_NMF", ccsText, "", CCGetRequestParam("FD_NMF", ccsGet, NULL), $this);
        $this->Sorter_FD_CODE = new clsSorter($this->ComponentName, "Sorter_FD_CODE", $FileName, $this);
        $this->Sorter_FD_GRP_ID = new clsSorter($this->ComponentName, "Sorter_FD_GRP_ID", $FileName, $this);
        $this->Sorter_FD_NME = new clsSorter($this->ComponentName, "Sorter_FD_NME", $FileName, $this);
        $this->Sorter_FD_NMF = new clsSorter($this->ComponentName, "Sorter_FD_NMF", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @5-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @5-1311156F
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
            $this->ControlsVisible["FD_CODE"] = $this->FD_CODE->Visible;
            $this->ControlsVisible["FD_GRP_ID"] = $this->FD_GRP_ID->Visible;
            $this->ControlsVisible["FD_NME"] = $this->FD_NME->Visible;
            $this->ControlsVisible["FD_NMF"] = $this->FD_NMF->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->FD_CODE->SetValue($this->DataSource->FD_CODE->GetValue());
                $this->FD_CODE->Parameters = CCGetQueryString("QueryString", array("s_keyword", "searchConditions", "ccsForm"));
                $this->FD_CODE->Parameters = CCAddParam($this->FD_CODE->Parameters, "FD_id", $this->DataSource->f("FD_CODE"));
                $this->FD_GRP_ID->SetValue($this->DataSource->FD_GRP_ID->GetValue());
                $this->FD_NME->SetValue($this->DataSource->FD_NME->GetValue());
                $this->FD_NMF->SetValue($this->DataSource->FD_NMF->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->FD_CODE->Show();
                $this->FD_GRP_ID->Show();
                $this->FD_NME->Show();
                $this->FD_NMF->Show();
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
        $this->Sorter_FD_CODE->Show();
        $this->Sorter_FD_GRP_ID->Show();
        $this->Sorter_FD_NME->Show();
        $this->Sorter_FD_NMF->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @5-3154B190
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->FD_CODE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FD_GRP_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FD_NME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FD_NMF->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End FD_NAMES Class @5-FCB6E20C

class clsFD_NAMESDataSource extends clsDBcandat {  //FD_NAMESDataSource Class @5-174F1E70

//DataSource Variables @5-3430307B
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $FD_CODE;
    public $FD_GRP_ID;
    public $FD_NME;
    public $FD_NMF;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-220D11F4
    function clsFD_NAMESDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid FD_NAMES";
        $this->Initialize();
        $this->FD_CODE = new clsField("FD_CODE", ccsInteger, "");
        
        $this->FD_GRP_ID = new clsField("FD_GRP_ID", ccsInteger, "");
        
        $this->FD_NME = new clsField("FD_NME", ccsText, "");
        
        $this->FD_NMF = new clsField("FD_NMF", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-C65CD69C
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_FD_CODE" => array("FD_CODE", ""), 
            "Sorter_FD_GRP_ID" => array("FD_GRP_ID", ""), 
            "Sorter_FD_NME" => array("FD_NME", ""), 
            "Sorter_FD_NMF" => array("FD_NMF", "")));
    }
//End SetOrder Method

//Prepare Method @5-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @5-1CFC9FB7
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM FD_NAMES";
        $this->SQL = "SELECT FD_CODE, FD_GRP_ID, FD_NME, FD_NMF \n\n" .
        "FROM FD_NAMES {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-BEBCB06A
    function SetValues()
    {
        $this->FD_CODE->SetDBValue(trim($this->f("FD_CODE")));
        $this->FD_GRP_ID->SetDBValue(trim($this->f("FD_GRP_ID")));
        $this->FD_NME->SetDBValue($this->f("FD_NME"));
        $this->FD_NMF->SetDBValue($this->f("FD_NMF"));
    }
//End SetValues Method

} //End FD_NAMESDataSource Class @5-FCB6E20C

//Include Page implementation @23-E89C636C
include_once(RelativePath . "/Header_live.php");
//End Include Page implementation

//Include Page implementation @24-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

//Initialize Page @1-4B31B230
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
$TemplateFileName = "FD_NAMES_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-DD4DA15A
include_once("./FD_NAMES_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A8F82A5D
$DBcandat = new clsDBcandat();
$MainPage->Connections["candat"] = & $DBcandat;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$FD_NAMESSearch = new clsRecordFD_NAMESSearch("", $MainPage);
$FD_NAMES = new clsGridFD_NAMES("", $MainPage);
$Header = new clsHeader_live("", "Header", $MainPage);
$Header->Initialize();
$Footer = new clsFooter("", "Footer", $MainPage);
$Footer->Initialize();
$MainPage->FD_NAMESSearch = & $FD_NAMESSearch;
$MainPage->FD_NAMES = & $FD_NAMES;
$MainPage->Header = & $Header;
$MainPage->Footer = & $Footer;
$FD_NAMES->Initialize();

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

//Execute Components @1-6C217EC9
$FD_NAMESSearch->Operation();
$Header->Operations();
$Footer->Operations();
//End Execute Components

//Go to destination page @1-0958CE99
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcandat->close();
    header("Location: " . $Redirect);
    unset($FD_NAMESSearch);
    unset($FD_NAMES);
    $Header->Class_Terminate();
    unset($Header);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-922941CB
$FD_NAMESSearch->Show();
$FD_NAMES->Show();
$Header->Show();
$Footer->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1E2A7CA7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcandat->close();
unset($FD_NAMESSearch);
unset($FD_NAMES);
$Header->Class_Terminate();
unset($Header);
$Footer->Class_Terminate();
unset($Footer);
unset($Tpl);
//End Unload Page


?>
