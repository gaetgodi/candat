<?php
//Include Common Files @1-5EED8AA7
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "Subjects.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



//Include Page implementation @62-E89C636C
include_once(RelativePath . "/Header_live.php");
//End Include Page implementation

class clsGridSTUDIES { //STUDIES class @63-CAB68BD4

//Variables @63-6E51DF5A

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
//End Variables

//Class_Initialize Event @63-ECFC740D
    function clsGridSTUDIES($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "STUDIES";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid STUDIES";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsSTUDIESDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->long_desc = new clsControl(ccsLink, "long_desc", "long_desc", ccsText, "", CCGetRequestParam("long_desc", ccsGet, NULL), $this);
        $this->long_desc->Page = ServerURL . "Subjects.php";
    }
//End Class_Initialize Event

//Initialize Method @63-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @63-6C171D23
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlST_id"] = CCGetFromGet("ST_id", NULL);

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
            $this->ControlsVisible["long_desc"] = $this->long_desc->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->long_desc->SetValue($this->DataSource->long_desc->GetValue());
                $this->long_desc->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->long_desc->Parameters = CCAddParam($this->long_desc->Parameters, "ST_id", $this->DataSource->f("ST_id"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->long_desc->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @63-8B27DDAD
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->long_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End STUDIES Class @63-FCB6E20C

class clsSTUDIESDataSource extends clsDBcandat {  //STUDIESDataSource Class @63-AE6E84D7

//DataSource Variables @63-54689347
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $long_desc;
//End DataSource Variables

//DataSourceClass_Initialize Event @63-D1F2B770
    function clsSTUDIESDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid STUDIES";
        $this->Initialize();
        $this->long_desc = new clsField("long_desc", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @63-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @63-4438899F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlST_id", ccsInteger, "", "", $this->Parameters["urlST_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ST_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @63-D6F37B67
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM STUDIES";
        $this->SQL = "SELECT * \n\n" .
        "FROM STUDIES {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @63-80BAB893
    function SetValues()
    {
        $this->long_desc->SetDBValue($this->f("long_desc"));
    }
//End SetValues Method

} //End STUDIESDataSource Class @63-FCB6E20C

class clsGridSUBJECTS { //SUBJECTS class @150-78F12E23

//Variables @150-4318626F

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
    public $Sorter_SB_id;
    public $Sorter_ST_id;
    public $Sorter_SB_CODE;
    public $Sorter_SB_short_desc;
    public $Sorter_SB_long_desc;
//End Variables

//Class_Initialize Event @150-3F455B29
    function clsGridSUBJECTS($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "SUBJECTS";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid SUBJECTS";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsSUBJECTSDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("SUBJECTSOrder", "");
        $this->SorterDirection = CCGetParam("SUBJECTSDir", "");

        $this->SB_id = new clsControl(ccsLink, "SB_id", "SB_id", ccsInteger, "", CCGetRequestParam("SB_id", ccsGet, NULL), $this);
        $this->SB_id->Page = "Subjects.php";
        $this->ST_id = new clsControl(ccsLabel, "ST_id", "ST_id", ccsInteger, "", CCGetRequestParam("ST_id", ccsGet, NULL), $this);
        $this->SB_CODE = new clsControl(ccsLabel, "SB_CODE", "SB_CODE", ccsText, "", CCGetRequestParam("SB_CODE", ccsGet, NULL), $this);
        $this->SB_short_desc = new clsControl(ccsLabel, "SB_short_desc", "SB_short_desc", ccsText, "", CCGetRequestParam("SB_short_desc", ccsGet, NULL), $this);
        $this->SB_long_desc = new clsControl(ccsLabel, "SB_long_desc", "SB_long_desc", ccsText, "", CCGetRequestParam("SB_long_desc", ccsGet, NULL), $this);
        $this->SUBJECTS_Insert = new clsControl(ccsLink, "SUBJECTS_Insert", "SUBJECTS_Insert", ccsText, "", CCGetRequestParam("SUBJECTS_Insert", ccsGet, NULL), $this);
        $this->SUBJECTS_Insert->Parameters = CCGetQueryString("QueryString", array("SB_id", "ccsForm"));
        $this->SUBJECTS_Insert->Page = "Subjects.php";
        $this->Sorter_SB_id = new clsSorter($this->ComponentName, "Sorter_SB_id", $FileName, $this);
        $this->Sorter_ST_id = new clsSorter($this->ComponentName, "Sorter_ST_id", $FileName, $this);
        $this->Sorter_SB_CODE = new clsSorter($this->ComponentName, "Sorter_SB_CODE", $FileName, $this);
        $this->Sorter_SB_short_desc = new clsSorter($this->ComponentName, "Sorter_SB_short_desc", $FileName, $this);
        $this->Sorter_SB_long_desc = new clsSorter($this->ComponentName, "Sorter_SB_long_desc", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @150-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @150-0918C69C
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlST_id"] = CCGetFromGet("ST_id", NULL);

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
            $this->ControlsVisible["SB_id"] = $this->SB_id->Visible;
            $this->ControlsVisible["ST_id"] = $this->ST_id->Visible;
            $this->ControlsVisible["SB_CODE"] = $this->SB_CODE->Visible;
            $this->ControlsVisible["SB_short_desc"] = $this->SB_short_desc->Visible;
            $this->ControlsVisible["SB_long_desc"] = $this->SB_long_desc->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->SB_id->SetValue($this->DataSource->SB_id->GetValue());
                $this->SB_id->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->SB_id->Parameters = CCAddParam($this->SB_id->Parameters, "SB_id", $this->DataSource->f("SB_id"));
                $this->ST_id->SetValue($this->DataSource->ST_id->GetValue());
                $this->SB_CODE->SetValue($this->DataSource->SB_CODE->GetValue());
                $this->SB_short_desc->SetValue($this->DataSource->SB_short_desc->GetValue());
                $this->SB_long_desc->SetValue($this->DataSource->SB_long_desc->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->SB_id->Show();
                $this->ST_id->Show();
                $this->SB_CODE->Show();
                $this->SB_short_desc->Show();
                $this->SB_long_desc->Show();
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
        $this->SUBJECTS_Insert->Show();
        $this->Sorter_SB_id->Show();
        $this->Sorter_ST_id->Show();
        $this->Sorter_SB_CODE->Show();
        $this->Sorter_SB_short_desc->Show();
        $this->Sorter_SB_long_desc->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @150-5593BCA1
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->SB_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ST_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SB_CODE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SB_short_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SB_long_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End SUBJECTS Class @150-FCB6E20C

class clsSUBJECTSDataSource extends clsDBcandat {  //SUBJECTSDataSource Class @150-2E5B553E

//DataSource Variables @150-810670E9
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $SB_id;
    public $ST_id;
    public $SB_CODE;
    public $SB_short_desc;
    public $SB_long_desc;
//End DataSource Variables

//DataSourceClass_Initialize Event @150-4E9B4A57
    function clsSUBJECTSDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid SUBJECTS";
        $this->Initialize();
        $this->SB_id = new clsField("SB_id", ccsInteger, "");
        
        $this->ST_id = new clsField("ST_id", ccsInteger, "");
        
        $this->SB_CODE = new clsField("SB_CODE", ccsText, "");
        
        $this->SB_short_desc = new clsField("SB_short_desc", ccsText, "");
        
        $this->SB_long_desc = new clsField("SB_long_desc", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @150-6597DCC7
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_SB_id" => array("SB_id", ""), 
            "Sorter_ST_id" => array("ST_id", ""), 
            "Sorter_SB_CODE" => array("SB_CODE", ""), 
            "Sorter_SB_short_desc" => array("SB_short_desc", ""), 
            "Sorter_SB_long_desc" => array("SB_long_desc", "")));
    }
//End SetOrder Method

//Prepare Method @150-73D75E43
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlST_id", ccsInteger, "", "", $this->Parameters["urlST_id"], -999, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "SUBJECTS.ST_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @150-732FD011
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM SUBJECTS INNER JOIN STUDIES ON\n\n" .
        "SUBJECTS.ST_id = STUDIES.ST_id";
        $this->SQL = "SELECT * \n\n" .
        "FROM SUBJECTS INNER JOIN STUDIES ON\n\n" .
        "SUBJECTS.ST_id = STUDIES.ST_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @150-097D8886
    function SetValues()
    {
        $this->SB_id->SetDBValue(trim($this->f("SB_id")));
        $this->ST_id->SetDBValue(trim($this->f("ST_id")));
        $this->SB_CODE->SetDBValue($this->f("SB_CODE"));
        $this->SB_short_desc->SetDBValue($this->f("SB_short_desc"));
        $this->SB_long_desc->SetDBValue($this->f("SB_long_desc"));
    }
//End SetValues Method

} //End SUBJECTSDataSource Class @150-FCB6E20C

class clsRecordSUBJECTS1 { //SUBJECTS1 Class @169-0367125C

//Variables @169-9E315808

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

//Class_Initialize Event @169-D7958139
    function clsRecordSUBJECTS1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SUBJECTS1/Error";
        $this->DataSource = new clsSUBJECTS1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SUBJECTS1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            $this->ST_id = new clsControl(ccsTextBox, "ST_id", "ST Id", ccsInteger, "", CCGetRequestParam("ST_id", $Method, NULL), $this);
            $this->ST_id->Required = true;
            $this->SB_CODE = new clsControl(ccsTextBox, "SB_CODE", "SB CODE", ccsText, "", CCGetRequestParam("SB_CODE", $Method, NULL), $this);
            $this->SB_short_desc = new clsControl(ccsTextBox, "SB_short_desc", "SB Short Desc", ccsText, "", CCGetRequestParam("SB_short_desc", $Method, NULL), $this);
            $this->SB_long_desc = new clsControl(ccsTextBox, "SB_long_desc", "SB Long Desc", ccsText, "", CCGetRequestParam("SB_long_desc", $Method, NULL), $this);
            $this->Button_Cancel1 = new clsButton("Button_Cancel1", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @169-87B96B8B
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlSB_id"] = CCGetFromGet("SB_id", NULL);
    }
//End Initialize Method

//Validate Method @169-5CB83AF0
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ST_id->Validate() && $Validation);
        $Validation = ($this->SB_CODE->Validate() && $Validation);
        $Validation = ($this->SB_short_desc->Validate() && $Validation);
        $Validation = ($this->SB_long_desc->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ST_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SB_CODE->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SB_short_desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SB_long_desc->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @169-5F29E45D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ST_id->Errors->Count());
        $errors = ($errors || $this->SB_CODE->Errors->Count());
        $errors = ($errors || $this->SB_short_desc->Errors->Count());
        $errors = ($errors || $this->SB_long_desc->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @169-ED598703
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

//Operation Method @169-4FB92B06
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            } else if($this->Button_Cancel1->Pressed) {
                $this->PressedButton = "Button_Cancel1";
            }
        }
        $Redirect = "Subjects.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "Subjects.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "SB_id"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel1") {
            $Redirect = "Subjects.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "SB_id", "ST_id", "SBD_id"));
            if(!CCGetEvent($this->Button_Cancel1->CCSEvents, "OnClick", $this->Button_Cancel1)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @169-FE516005
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ST_id->SetValue($this->ST_id->GetValue(true));
        $this->DataSource->SB_CODE->SetValue($this->SB_CODE->GetValue(true));
        $this->DataSource->SB_short_desc->SetValue($this->SB_short_desc->GetValue(true));
        $this->DataSource->SB_long_desc->SetValue($this->SB_long_desc->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @169-5933035D
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ST_id->SetValue($this->ST_id->GetValue(true));
        $this->DataSource->SB_CODE->SetValue($this->SB_CODE->GetValue(true));
        $this->DataSource->SB_short_desc->SetValue($this->SB_short_desc->GetValue(true));
        $this->DataSource->SB_long_desc->SetValue($this->SB_long_desc->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @169-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @169-7B07646E
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->ST_id->SetValue($this->DataSource->ST_id->GetValue());
                    $this->SB_CODE->SetValue($this->DataSource->SB_CODE->GetValue());
                    $this->SB_short_desc->SetValue($this->DataSource->SB_short_desc->GetValue());
                    $this->SB_long_desc->SetValue($this->DataSource->SB_long_desc->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ST_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SB_CODE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SB_short_desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SB_long_desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $this->ST_id->Show();
        $this->SB_CODE->Show();
        $this->SB_short_desc->Show();
        $this->SB_long_desc->Show();
        $this->Button_Cancel1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End SUBJECTS1 Class @169-FCB6E20C

class clsSUBJECTS1DataSource extends clsDBcandat {  //SUBJECTS1DataSource Class @169-5DAFA953

//DataSource Variables @169-5C7FA857
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $ST_id;
    public $SB_CODE;
    public $SB_short_desc;
    public $SB_long_desc;
//End DataSource Variables

//DataSourceClass_Initialize Event @169-080D3622
    function clsSUBJECTS1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record SUBJECTS1/Error";
        $this->Initialize();
        $this->ST_id = new clsField("ST_id", ccsInteger, "");
        
        $this->SB_CODE = new clsField("SB_CODE", ccsText, "");
        
        $this->SB_short_desc = new clsField("SB_short_desc", ccsText, "");
        
        $this->SB_long_desc = new clsField("SB_long_desc", ccsText, "");
        

        $this->InsertFields["ST_id"] = array("Name" => "ST_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["SB_CODE"] = array("Name" => "SB_CODE", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["SB_short_desc"] = array("Name" => "SB_short_desc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["SB_long_desc"] = array("Name" => "SB_long_desc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ST_id"] = array("Name" => "ST_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["SB_CODE"] = array("Name" => "SB_CODE", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SB_short_desc"] = array("Name" => "SB_short_desc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SB_long_desc"] = array("Name" => "SB_long_desc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @169-805BD8D3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlSB_id", ccsInteger, "", "", $this->Parameters["urlSB_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "SB_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @169-F1EAA979
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM SUBJECTS {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @169-F7FD7A1D
    function SetValues()
    {
        $this->ST_id->SetDBValue(trim($this->f("ST_id")));
        $this->SB_CODE->SetDBValue($this->f("SB_CODE"));
        $this->SB_short_desc->SetDBValue($this->f("SB_short_desc"));
        $this->SB_long_desc->SetDBValue($this->f("SB_long_desc"));
    }
//End SetValues Method

//Insert Method @169-60F0D709
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ST_id"]["Value"] = $this->ST_id->GetDBValue(true);
        $this->InsertFields["SB_CODE"]["Value"] = $this->SB_CODE->GetDBValue(true);
        $this->InsertFields["SB_short_desc"]["Value"] = $this->SB_short_desc->GetDBValue(true);
        $this->InsertFields["SB_long_desc"]["Value"] = $this->SB_long_desc->GetDBValue(true);
        $this->SQL = CCBuildInsert("SUBJECTS", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @169-B7C5D982
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ST_id"]["Value"] = $this->ST_id->GetDBValue(true);
        $this->UpdateFields["SB_CODE"]["Value"] = $this->SB_CODE->GetDBValue(true);
        $this->UpdateFields["SB_short_desc"]["Value"] = $this->SB_short_desc->GetDBValue(true);
        $this->UpdateFields["SB_long_desc"]["Value"] = $this->SB_long_desc->GetDBValue(true);
        $this->SQL = CCBuildUpdate("SUBJECTS", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @169-575B31F5
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM SUBJECTS";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End SUBJECTS1DataSource Class @169-FCB6E20C

class clsEditableGridSB_VARIABLES { //SB_VARIABLES Class @189-BFFFA3BD

//Variables @189-E2E6BE43

    // Public variables
    public $ComponentType = "EditableGrid";
    public $ComponentName;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormParameters;
    public $FormState;
    public $FormEnctype;
    public $CachedColumns;
    public $TotalRows;
    public $UpdatedRows;
    public $EmptyRows;
    public $Visible;
    public $RowsErrors;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode;
    public $ValidatingControls;
    public $Controls;
    public $ControlsErrors;
    public $RowNumber;
    public $Attributes;
    public $PrimaryKeys;

    // Class variables
    public $Sorter_SBV_id;
    public $Sorter_SB_id;
    public $Sorter_VAR_id;
    public $Sorter_SB_VALUE;
//End Variables

//Class_Initialize Event @189-C9F4F950
    function clsEditableGridSB_VARIABLES($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid SB_VARIABLES/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "SB_VARIABLES";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["SBV_id"][0] = "SBV_id";
        $this->DataSource = new clsSB_VARIABLESDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 3;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->SorterName = CCGetParam("SB_VARIABLESOrder", "");
        $this->SorterDirection = CCGetParam("SB_VARIABLESDir", "");

        $this->SB_VARIABLES_TotalRecords = new clsControl(ccsLabel, "SB_VARIABLES_TotalRecords", "SB_VARIABLES_TotalRecords", ccsText, "", NULL, $this);
        $this->Sorter_SBV_id = new clsSorter($this->ComponentName, "Sorter_SBV_id", $FileName, $this);
        $this->Sorter_SB_id = new clsSorter($this->ComponentName, "Sorter_SB_id", $FileName, $this);
        $this->Sorter_VAR_id = new clsSorter($this->ComponentName, "Sorter_VAR_id", $FileName, $this);
        $this->Sorter_SB_VALUE = new clsSorter($this->ComponentName, "Sorter_SB_VALUE", $FileName, $this);
        $this->SBV_id = new clsControl(ccsLabel, "SBV_id", "SBV Id", ccsInteger, "", NULL, $this);
        $this->SB_id = new clsControl(ccsTextBox, "SB_id", "SB Id", ccsInteger, "", NULL, $this);
        $this->VAR_id = new clsControl(ccsListBox, "VAR_id", "VAR Id", ccsInteger, "", NULL, $this);
        $this->VAR_id->DSType = dsTable;
        $this->VAR_id->DataSource = new clsDBcandat();
        $this->VAR_id->ds = & $this->VAR_id->DataSource;
        $this->VAR_id->DataSource->SQL = "SELECT * \n" .
"FROM ST_VARS {SQL_Where} {SQL_OrderBy}";
        list($this->VAR_id->BoundColumn, $this->VAR_id->TextColumn, $this->VAR_id->DBFormat) = array("VAR_id", "VR_NME", "");
        $this->VAR_id->DataSource->Parameters["urlST_id"] = CCGetFromGet("ST_id", NULL);
        $this->VAR_id->DataSource->wp = new clsSQLParameters();
        $this->VAR_id->DataSource->wp->AddParameter("1", "urlST_id", ccsInteger, "", "", $this->VAR_id->DataSource->Parameters["urlST_id"], "", false);
        $this->VAR_id->DataSource->wp->Criterion[1] = $this->VAR_id->DataSource->wp->Operation(opEqual, "ST_id", $this->VAR_id->DataSource->wp->GetDBValue("1"), $this->VAR_id->DataSource->ToSQL($this->VAR_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
        $this->VAR_id->DataSource->Where = 
             $this->VAR_id->DataSource->wp->Criterion[1];
        $this->SB_VALUE = new clsControl(ccsTextBox, "SB_VALUE", "SB VALUE", ccsText, "", NULL, $this);
        $this->CheckBox_Delete_Panel = new clsPanel("CheckBox_Delete_Panel", $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
        $this->CheckBox_Delete_Panel->AddComponent("CheckBox_Delete", $this->CheckBox_Delete);
    }
//End Class_Initialize Event

//Initialize Method @189-C35273FB
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlSB_id"] = CCGetFromGet("SB_id", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @189-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @189-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @189-AFC14BB8
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["SB_id"][$RowNumber] = CCGetFromPost("SB_id_" . $RowNumber, NULL);
            $this->FormParameters["VAR_id"][$RowNumber] = CCGetFromPost("VAR_id_" . $RowNumber, NULL);
            $this->FormParameters["SB_VALUE"][$RowNumber] = CCGetFromPost("SB_VALUE_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @189-BE82E204
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["SBV_id"] = $this->CachedColumns["SBV_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->SB_id->SetText($this->FormParameters["SB_id"][$this->RowNumber], $this->RowNumber);
            $this->VAR_id->SetText($this->FormParameters["VAR_id"][$this->RowNumber], $this->RowNumber);
            $this->SB_VALUE->SetText($this->FormParameters["SB_VALUE"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @189-D7121587
    function ValidateRow()
    {
        global $CCSLocales;
        $this->SB_id->Validate();
        $this->VAR_id->Validate();
        $this->SB_VALUE->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->SB_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->VAR_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SB_VALUE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->SB_id->Errors->Clear();
        $this->VAR_id->Errors->Clear();
        $this->SB_VALUE->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @189-3F0D0D4E
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["SB_id"][$this->RowNumber]) && count($this->FormParameters["SB_id"][$this->RowNumber])) || strlen($this->FormParameters["SB_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["VAR_id"][$this->RowNumber]) && count($this->FormParameters["VAR_id"][$this->RowNumber])) || strlen($this->FormParameters["VAR_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["SB_VALUE"][$this->RowNumber]) && count($this->FormParameters["SB_VALUE"][$this->RowNumber])) || strlen($this->FormParameters["SB_VALUE"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @189-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @189-6B923CC2
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->Cancel->Pressed) {
            $this->PressedButton = "Cancel";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @189-70DE4695
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["SBV_id"] = $this->CachedColumns["SBV_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->SB_id->SetText($this->FormParameters["SB_id"][$this->RowNumber], $this->RowNumber);
            $this->VAR_id->SetText($this->FormParameters["VAR_id"][$this->RowNumber], $this->RowNumber);
            $this->SB_VALUE->SetText($this->FormParameters["SB_VALUE"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @189-43A800DA
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->VAR_id->SetValue($this->VAR_id->GetValue(true));
        $this->DataSource->SB_VALUE->SetValue($this->SB_VALUE->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @189-46E3512F
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->SBV_id->SetValue($this->SBV_id->GetValue(true));
        $this->DataSource->SB_id->SetValue($this->SB_id->GetValue(true));
        $this->DataSource->VAR_id->SetValue($this->VAR_id->GetValue(true));
        $this->DataSource->SB_VALUE->SetValue($this->SB_VALUE->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @189-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @189-59800DB5
    function FormScript($TotalRows)
    {
        $script = "";
        return $script;
    }
//End FormScript Method

//SetFormState Method @189-C1CB3C08
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["SBV_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["SBV_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @189-284D36CD
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["SBV_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @189-36C1369F
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->VAR_id->Prepare();

        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["SBV_id"] = $this->SBV_id->Visible;
        $this->ControlsVisible["SB_id"] = $this->SB_id->Visible;
        $this->ControlsVisible["VAR_id"] = $this->VAR_id->Visible;
        $this->ControlsVisible["SB_VALUE"] = $this->SB_VALUE->Visible;
        $this->ControlsVisible["CheckBox_Delete_Panel"] = $this->CheckBox_Delete_Panel->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                // Parse Separator
                if($this->RowNumber) {
                    $Tpl->block_path = $EditableGridPath;
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                    $Tpl->block_path = $EditableGridRowPath;
                }
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                    $this->CheckBox_Delete_Panel->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["SBV_id"][$this->RowNumber] = $this->DataSource->CachedColumns["SBV_id"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->SBV_id->SetValue($this->DataSource->SBV_id->GetValue());
                    $this->SB_id->SetValue($this->DataSource->SB_id->GetValue());
                    $this->VAR_id->SetValue($this->DataSource->VAR_id->GetValue());
                    $this->SB_VALUE->SetValue($this->DataSource->SB_VALUE->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->SBV_id->SetText("");
                    $this->SBV_id->SetValue($this->DataSource->SBV_id->GetValue());
                    $this->SB_id->SetText($this->FormParameters["SB_id"][$this->RowNumber], $this->RowNumber);
                    $this->VAR_id->SetText($this->FormParameters["VAR_id"][$this->RowNumber], $this->RowNumber);
                    $this->SB_VALUE->SetText($this->FormParameters["SB_VALUE"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["SBV_id"][$this->RowNumber] = "";
                    $this->SBV_id->SetText("");
                    $this->SB_id->SetText("");
                    $this->VAR_id->SetText("");
                    $this->SB_VALUE->SetText("");
                } else {
                    $this->SBV_id->SetText("");
                    $this->SB_id->SetText($this->FormParameters["SB_id"][$this->RowNumber], $this->RowNumber);
                    $this->VAR_id->SetText($this->FormParameters["VAR_id"][$this->RowNumber], $this->RowNumber);
                    $this->SB_VALUE->SetText($this->FormParameters["SB_VALUE"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->SBV_id->Show($this->RowNumber);
                $this->SB_id->Show($this->RowNumber);
                $this->VAR_id->Show($this->RowNumber);
                $this->SB_VALUE->Show($this->RowNumber);
                $this->CheckBox_Delete_Panel->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["SBV_id"] == $this->CachedColumns["SBV_id"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->SB_VARIABLES_TotalRecords->Show();
        $this->Sorter_SBV_id->Show();
        $this->Sorter_SB_id->Show();
        $this->Sorter_VAR_id->Show();
        $this->Sorter_SB_VALUE->Show();
        $this->Navigator->Show();
        $this->Button_Submit->Show();
        $this->Cancel->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End SB_VARIABLES Class @189-FCB6E20C

class clsSB_VARIABLESDataSource extends clsDBcandat {  //SB_VARIABLESDataSource Class @189-78A0ADAB

//DataSource Variables @189-982C34AF
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $SBV_id;
    public $SB_id;
    public $VAR_id;
    public $SB_VALUE;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @189-10782737
    function clsSB_VARIABLESDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid SB_VARIABLES/Error";
        $this->Initialize();
        $this->SBV_id = new clsField("SBV_id", ccsInteger, "");
        
        $this->SB_id = new clsField("SB_id", ccsInteger, "");
        
        $this->VAR_id = new clsField("VAR_id", ccsInteger, "");
        
        $this->SB_VALUE = new clsField("SB_VALUE", ccsText, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["SB_id"] = array("Name" => "SB_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["VAR_id"] = array("Name" => "VAR_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["SB_VALUE"] = array("Name" => "SB_VALUE", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["SB_id"] = array("Name" => "SB_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["VAR_id"] = array("Name" => "VAR_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["SB_VALUE"] = array("Name" => "SB_VALUE", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @189-FAB6A1B8
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_SBV_id" => array("SBV_id", ""), 
            "Sorter_SB_id" => array("SB_id", ""), 
            "Sorter_VAR_id" => array("VAR_id", ""), 
            "Sorter_SB_VALUE" => array("SB_VALUE", "")));
    }
//End SetOrder Method

//Prepare Method @189-FB13E293
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlSB_id", ccsInteger, "", "", $this->Parameters["urlSB_id"], -999, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "SB_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @189-5E17B4C2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM SB_VARIABLES";
        $this->SQL = "SELECT * \n\n" .
        "FROM SB_VARIABLES {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @189-D8DA8F6A
    function SetValues()
    {
        $this->CachedColumns["SBV_id"] = $this->f("SBV_id");
        $this->SBV_id->SetDBValue(trim($this->f("SBV_id")));
        $this->SB_id->SetDBValue(trim($this->f("SB_id")));
        $this->VAR_id->SetDBValue(trim($this->f("VAR_id")));
        $this->SB_VALUE->SetDBValue($this->f("SB_VALUE"));
    }
//End SetValues Method

//Insert Method @189-C5CA4C1C
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["SB_id"] = new clsSQLParameter("urlSB_id", ccsInteger, "", "", CCGetFromGet("SB_id", NULL), NULL, false, $this->ErrorBlock);
        $this->cp["VAR_id"] = new clsSQLParameter("ctrlVAR_id", ccsInteger, "", "", $this->VAR_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["SB_VALUE"] = new clsSQLParameter("ctrlSB_VALUE", ccsText, "", "", $this->SB_VALUE->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["SB_id"]->GetValue()) and !strlen($this->cp["SB_id"]->GetText()) and !is_bool($this->cp["SB_id"]->GetValue())) 
            $this->cp["SB_id"]->SetText(CCGetFromGet("SB_id", NULL));
        if (!is_null($this->cp["VAR_id"]->GetValue()) and !strlen($this->cp["VAR_id"]->GetText()) and !is_bool($this->cp["VAR_id"]->GetValue())) 
            $this->cp["VAR_id"]->SetValue($this->VAR_id->GetValue(true));
        if (!is_null($this->cp["SB_VALUE"]->GetValue()) and !strlen($this->cp["SB_VALUE"]->GetText()) and !is_bool($this->cp["SB_VALUE"]->GetValue())) 
            $this->cp["SB_VALUE"]->SetValue($this->SB_VALUE->GetValue(true));
        $this->InsertFields["SB_id"]["Value"] = $this->cp["SB_id"]->GetDBValue(true);
        $this->InsertFields["VAR_id"]["Value"] = $this->cp["VAR_id"]->GetDBValue(true);
        $this->InsertFields["SB_VALUE"]["Value"] = $this->cp["SB_VALUE"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("SB_VARIABLES", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @189-0B2B2135
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "SBV_id=" . $this->ToSQL($this->CachedColumns["SBV_id"], ccsInteger);
        $this->UpdateFields["SB_id"]["Value"] = $this->SB_id->GetDBValue(true);
        $this->UpdateFields["VAR_id"]["Value"] = $this->VAR_id->GetDBValue(true);
        $this->UpdateFields["SB_VALUE"]["Value"] = $this->SB_VALUE->GetDBValue(true);
        $this->SQL = CCBuildUpdate("SB_VARIABLES", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @189-A1B740E9
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "SBV_id=" . $this->ToSQL($this->CachedColumns["SBV_id"], ccsInteger);
        $this->SQL = "DELETE FROM SB_VARIABLES";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End SB_VARIABLESDataSource Class @189-FCB6E20C

class clsGridSB_DAYS { //SB_DAYS class @245-BFAB73BD

//Variables @245-15B06D52

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
    public $Sorter_SBD_id;
    public $Sorter_SB_id;
    public $Sorter_DY_id;
    public $Sorter_DY_NME;
    public $Sorter_DY_DATE;
//End Variables

//Class_Initialize Event @245-F4D38819
    function clsGridSB_DAYS($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "SB_DAYS";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid SB_DAYS";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsSB_DAYSDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("SB_DAYSOrder", "");
        $this->SorterDirection = CCGetParam("SB_DAYSDir", "");

        $this->SBD_id = new clsControl(ccsLink, "SBD_id", "SBD_id", ccsInteger, "", CCGetRequestParam("SBD_id", ccsGet, NULL), $this);
        $this->SBD_id->Page = "Subjects.php";
        $this->SB_id = new clsControl(ccsLabel, "SB_id", "SB_id", ccsInteger, "", CCGetRequestParam("SB_id", ccsGet, NULL), $this);
        $this->DY_id = new clsControl(ccsLabel, "DY_id", "DY_id", ccsInteger, "", CCGetRequestParam("DY_id", ccsGet, NULL), $this);
        $this->DY_NME = new clsControl(ccsLabel, "DY_NME", "DY_NME", ccsText, "", CCGetRequestParam("DY_NME", ccsGet, NULL), $this);
        $this->DY_DATE = new clsControl(ccsLabel, "DY_DATE", "DY_DATE", ccsDate, array("yyyy", "-", "mm", "-", "dd"), CCGetRequestParam("DY_DATE", ccsGet, NULL), $this);
        $this->SB_DAYS_Insert = new clsControl(ccsLink, "SB_DAYS_Insert", "SB_DAYS_Insert", ccsText, "", CCGetRequestParam("SB_DAYS_Insert", ccsGet, NULL), $this);
        $this->SB_DAYS_Insert->Parameters = CCGetQueryString("QueryString", array("SBD_id", "ccsForm"));
        $this->SB_DAYS_Insert->Page = "Subjects.php";
        $this->Sorter_SBD_id = new clsSorter($this->ComponentName, "Sorter_SBD_id", $FileName, $this);
        $this->Sorter_SB_id = new clsSorter($this->ComponentName, "Sorter_SB_id", $FileName, $this);
        $this->Sorter_DY_id = new clsSorter($this->ComponentName, "Sorter_DY_id", $FileName, $this);
        $this->Sorter_DY_NME = new clsSorter($this->ComponentName, "Sorter_DY_NME", $FileName, $this);
        $this->Sorter_DY_DATE = new clsSorter($this->ComponentName, "Sorter_DY_DATE", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @245-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @245-A6959E05
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlSB_id"] = CCGetFromGet("SB_id", NULL);

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
            $this->ControlsVisible["SBD_id"] = $this->SBD_id->Visible;
            $this->ControlsVisible["SB_id"] = $this->SB_id->Visible;
            $this->ControlsVisible["DY_id"] = $this->DY_id->Visible;
            $this->ControlsVisible["DY_NME"] = $this->DY_NME->Visible;
            $this->ControlsVisible["DY_DATE"] = $this->DY_DATE->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->SBD_id->SetValue($this->DataSource->SBD_id->GetValue());
                $this->SBD_id->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->SBD_id->Parameters = CCAddParam($this->SBD_id->Parameters, "SBD_id", $this->DataSource->f("SBD_id"));
                $this->SB_id->SetValue($this->DataSource->SB_id->GetValue());
                $this->DY_id->SetValue($this->DataSource->DY_id->GetValue());
                $this->DY_NME->SetValue($this->DataSource->DY_NME->GetValue());
                $this->DY_DATE->SetValue($this->DataSource->DY_DATE->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->SBD_id->Show();
                $this->SB_id->Show();
                $this->DY_id->Show();
                $this->DY_NME->Show();
                $this->DY_DATE->Show();
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
        $this->SB_DAYS_Insert->Show();
        $this->Sorter_SBD_id->Show();
        $this->Sorter_SB_id->Show();
        $this->Sorter_DY_id->Show();
        $this->Sorter_DY_NME->Show();
        $this->Sorter_DY_DATE->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @245-2DB4834E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->SBD_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SB_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DY_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DY_NME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DY_DATE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End SB_DAYS Class @245-FCB6E20C

class clsSB_DAYSDataSource extends clsDBcandat {  //SB_DAYSDataSource Class @245-DAEECBFA

//DataSource Variables @245-8B41F952
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $SBD_id;
    public $SB_id;
    public $DY_id;
    public $DY_NME;
    public $DY_DATE;
//End DataSource Variables

//DataSourceClass_Initialize Event @245-D74F935C
    function clsSB_DAYSDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid SB_DAYS";
        $this->Initialize();
        $this->SBD_id = new clsField("SBD_id", ccsInteger, "");
        
        $this->SB_id = new clsField("SB_id", ccsInteger, "");
        
        $this->DY_id = new clsField("DY_id", ccsInteger, "");
        
        $this->DY_NME = new clsField("DY_NME", ccsText, "");
        
        $this->DY_DATE = new clsField("DY_DATE", ccsDate, $this->DateFormat);
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @245-B99F5DE4
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_SBD_id" => array("SBD_id", ""), 
            "Sorter_SB_id" => array("SB_id", ""), 
            "Sorter_DY_id" => array("DY_id", ""), 
            "Sorter_DY_NME" => array("DY_NME", ""), 
            "Sorter_DY_DATE" => array("DY_DATE", "")));
    }
//End SetOrder Method

//Prepare Method @245-82D1620B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlSB_id", ccsInteger, "", "", $this->Parameters["urlSB_id"], -999, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "SB_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @245-826078EC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM SB_DAYS";
        $this->SQL = "SELECT SBD_id, SB_id, DY_id, DY_NME, DY_DATE \n\n" .
        "FROM SB_DAYS {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @245-EF7AE737
    function SetValues()
    {
        $this->SBD_id->SetDBValue(trim($this->f("SBD_id")));
        $this->SB_id->SetDBValue(trim($this->f("SB_id")));
        $this->DY_id->SetDBValue(trim($this->f("DY_id")));
        $this->DY_NME->SetDBValue($this->f("DY_NME"));
        $this->DY_DATE->SetDBValue(trim($this->f("DY_DATE")));
    }
//End SetValues Method

} //End SB_DAYSDataSource Class @245-FCB6E20C

class clsRecordSB_DAYS1 { //SB_DAYS1 Class @264-9A4E2286

//Variables @264-9E315808

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

//Class_Initialize Event @264-17E911B0
    function clsRecordSB_DAYS1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record SB_DAYS1/Error";
        $this->DataSource = new clsSB_DAYS1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "SB_DAYS1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            $this->SB_id = new clsControl(ccsTextBox, "SB_id", "SB Id", ccsInteger, "", CCGetRequestParam("SB_id", $Method, NULL), $this);
            $this->SB_id->Required = true;
            $this->DY_id = new clsControl(ccsTextBox, "DY_id", "DY Id", ccsInteger, "", CCGetRequestParam("DY_id", $Method, NULL), $this);
            $this->DY_id->Required = true;
            $this->DY_NME = new clsControl(ccsTextBox, "DY_NME", "DY NME", ccsText, "", CCGetRequestParam("DY_NME", $Method, NULL), $this);
            $this->DY_NME->Required = true;
            $this->DY_DATE = new clsControl(ccsTextBox, "DY_DATE", "DY DATE", ccsDate, array("yyyy", "mm", "dd"), CCGetRequestParam("DY_DATE", $Method, NULL), $this);
            $this->DY_DATE->Required = true;
            $this->DatePicker_DY_DATE = new clsDatePicker("DatePicker_DY_DATE", "SB_DAYS1", "DY_DATE", $this);
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @264-9B5ED4D6
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlSBD_id"] = CCGetFromGet("SBD_id", NULL);
    }
//End Initialize Method

//Validate Method @264-E0FD92E0
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->SB_id->Validate() && $Validation);
        $Validation = ($this->DY_id->Validate() && $Validation);
        $Validation = ($this->DY_NME->Validate() && $Validation);
        $Validation = ($this->DY_DATE->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->SB_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DY_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DY_NME->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DY_DATE->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @264-22774071
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->SB_id->Errors->Count());
        $errors = ($errors || $this->DY_id->Errors->Count());
        $errors = ($errors || $this->DY_NME->Errors->Count());
        $errors = ($errors || $this->DY_DATE->Errors->Count());
        $errors = ($errors || $this->DatePicker_DY_DATE->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @264-ED598703
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

//Operation Method @264-6CB0279E
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            } else if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "SBD_id"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @264-F94A3882
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->DY_id->SetValue($this->DY_id->GetValue(true));
        $this->DataSource->DY_NME->SetValue($this->DY_NME->GetValue(true));
        $this->DataSource->DY_DATE->SetValue($this->DY_DATE->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @264-269ACB80
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->SB_id->SetValue($this->SB_id->GetValue(true));
        $this->DataSource->DY_id->SetValue($this->DY_id->GetValue(true));
        $this->DataSource->DY_NME->SetValue($this->DY_NME->GetValue(true));
        $this->DataSource->DY_DATE->SetValue($this->DY_DATE->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @264-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @264-5F57D8AE
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->SB_id->SetValue($this->DataSource->SB_id->GetValue());
                    $this->DY_id->SetValue($this->DataSource->DY_id->GetValue());
                    $this->DY_NME->SetValue($this->DataSource->DY_NME->GetValue());
                    $this->DY_DATE->SetValue($this->DataSource->DY_DATE->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->SB_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DY_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DY_NME->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DY_DATE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_DY_DATE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $this->SB_id->Show();
        $this->DY_id->Show();
        $this->DY_NME->Show();
        $this->DY_DATE->Show();
        $this->DatePicker_DY_DATE->Show();
        $this->Button_Insert->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End SB_DAYS1 Class @264-FCB6E20C

class clsSB_DAYS1DataSource extends clsDBcandat {  //SB_DAYS1DataSource Class @264-C1521A64

//DataSource Variables @264-EF9EEE8F
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $SB_id;
    public $DY_id;
    public $DY_NME;
    public $DY_DATE;
//End DataSource Variables

//DataSourceClass_Initialize Event @264-8352E404
    function clsSB_DAYS1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record SB_DAYS1/Error";
        $this->Initialize();
        $this->SB_id = new clsField("SB_id", ccsInteger, "");
        
        $this->DY_id = new clsField("DY_id", ccsInteger, "");
        
        $this->DY_NME = new clsField("DY_NME", ccsText, "");
        
        $this->DY_DATE = new clsField("DY_DATE", ccsDate, $this->DateFormat);
        

        $this->InsertFields["SB_id"] = array("Name" => "SB_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DY_id"] = array("Name" => "DY_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DY_NME"] = array("Name" => "DY_NME", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["DY_DATE"] = array("Name" => "DY_DATE", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["SB_id"] = array("Name" => "SB_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DY_id"] = array("Name" => "DY_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DY_NME"] = array("Name" => "DY_NME", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DY_DATE"] = array("Name" => "DY_DATE", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @264-60202786
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlSBD_id", ccsInteger, "", "", $this->Parameters["urlSBD_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "SBD_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @264-42297D5A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM SB_DAYS {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @264-1507C013
    function SetValues()
    {
        $this->SB_id->SetDBValue(trim($this->f("SB_id")));
        $this->DY_id->SetDBValue(trim($this->f("DY_id")));
        $this->DY_NME->SetDBValue($this->f("DY_NME"));
        $this->DY_DATE->SetDBValue(trim($this->f("DY_DATE")));
    }
//End SetValues Method

//Insert Method @264-3C17C847
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["SB_id"] = new clsSQLParameter("urlSB_id", ccsInteger, "", "", CCGetFromGet("SB_id", NULL), NULL, false, $this->ErrorBlock);
        $this->cp["DY_id"] = new clsSQLParameter("ctrlDY_id", ccsInteger, "", "", $this->DY_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DY_NME"] = new clsSQLParameter("ctrlDY_NME", ccsText, "", "", $this->DY_NME->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DY_DATE"] = new clsSQLParameter("ctrlDY_DATE", ccsDate, array("yyyy", "mm", "dd"), $this->DateFormat, $this->DY_DATE->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["SB_id"]->GetValue()) and !strlen($this->cp["SB_id"]->GetText()) and !is_bool($this->cp["SB_id"]->GetValue())) 
            $this->cp["SB_id"]->SetText(CCGetFromGet("SB_id", NULL));
        if (!is_null($this->cp["DY_id"]->GetValue()) and !strlen($this->cp["DY_id"]->GetText()) and !is_bool($this->cp["DY_id"]->GetValue())) 
            $this->cp["DY_id"]->SetValue($this->DY_id->GetValue(true));
        if (!is_null($this->cp["DY_NME"]->GetValue()) and !strlen($this->cp["DY_NME"]->GetText()) and !is_bool($this->cp["DY_NME"]->GetValue())) 
            $this->cp["DY_NME"]->SetValue($this->DY_NME->GetValue(true));
        if (!is_null($this->cp["DY_DATE"]->GetValue()) and !strlen($this->cp["DY_DATE"]->GetText()) and !is_bool($this->cp["DY_DATE"]->GetValue())) 
            $this->cp["DY_DATE"]->SetValue($this->DY_DATE->GetValue(true));
        $this->InsertFields["SB_id"]["Value"] = $this->cp["SB_id"]->GetDBValue(true);
        $this->InsertFields["DY_id"]["Value"] = $this->cp["DY_id"]->GetDBValue(true);
        $this->InsertFields["DY_NME"]["Value"] = $this->cp["DY_NME"]->GetDBValue(true);
        $this->InsertFields["DY_DATE"]["Value"] = $this->cp["DY_DATE"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("SB_DAYS", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @264-95A8C309
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["SB_id"]["Value"] = $this->SB_id->GetDBValue(true);
        $this->UpdateFields["DY_id"]["Value"] = $this->DY_id->GetDBValue(true);
        $this->UpdateFields["DY_NME"]["Value"] = $this->DY_NME->GetDBValue(true);
        $this->UpdateFields["DY_DATE"]["Value"] = $this->DY_DATE->GetDBValue(true);
        $this->SQL = CCBuildUpdate("SB_DAYS", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @264-4530DD02
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM SB_DAYS";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End SB_DAYS1DataSource Class @264-FCB6E20C





//Initialize Page @1-F189DC36
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
$TemplateFileName = "Subjects.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-AE1FF412
include_once("./Subjects_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A285CA9B
$DBcandat = new clsDBcandat();
$MainPage->Connections["candat"] = & $DBcandat;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header_live = new clsHeader_live("", "Header_live", $MainPage);
$Header_live->Initialize();
$STUDIES = new clsGridSTUDIES("", $MainPage);
$SUBJECTS = new clsGridSUBJECTS("", $MainPage);
$SUBJECTS1 = new clsRecordSUBJECTS1("", $MainPage);
$SB_VARIABLES = new clsEditableGridSB_VARIABLES("", $MainPage);
$SB_DAYS = new clsGridSB_DAYS("", $MainPage);
$SB_DAYS1 = new clsRecordSB_DAYS1("", $MainPage);
$MainPage->Header_live = & $Header_live;
$MainPage->STUDIES = & $STUDIES;
$MainPage->SUBJECTS = & $SUBJECTS;
$MainPage->SUBJECTS1 = & $SUBJECTS1;
$MainPage->SB_VARIABLES = & $SB_VARIABLES;
$MainPage->SB_DAYS = & $SB_DAYS;
$MainPage->SB_DAYS1 = & $SB_DAYS1;
$STUDIES->Initialize();
$SUBJECTS->Initialize();
$SUBJECTS1->Initialize();
$SB_VARIABLES->Initialize();
$SB_DAYS->Initialize();
$SB_DAYS1->Initialize();

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

//Execute Components @1-C77F2AC2
$Header_live->Operations();
$SUBJECTS1->Operation();
$SB_VARIABLES->Operation();
$SB_DAYS1->Operation();
//End Execute Components

//Go to destination page @1-3141484B
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcandat->close();
    header("Location: " . $Redirect);
    $Header_live->Class_Terminate();
    unset($Header_live);
    unset($STUDIES);
    unset($SUBJECTS);
    unset($SUBJECTS1);
    unset($SB_VARIABLES);
    unset($SB_DAYS);
    unset($SB_DAYS1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-87D3EAAB
$Header_live->Show();
$STUDIES->Show();
$SUBJECTS->Show();
$SUBJECTS1->Show();
$SB_VARIABLES->Show();
$SB_DAYS->Show();
$SB_DAYS1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-DBB3181A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcandat->close();
$Header_live->Class_Terminate();
unset($Header_live);
unset($STUDIES);
unset($SUBJECTS);
unset($SUBJECTS1);
unset($SB_VARIABLES);
unset($SB_DAYS);
unset($SB_DAYS1);
unset($Tpl);
//End Unload Page


?>
