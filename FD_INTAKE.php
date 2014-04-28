<?php
//Include Common Files @1-19658C47
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "FD_INTAKE.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridINTAKE { //INTAKE class @2-5E4F69C7

//Variables @2-556F357A

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
    public $Sorter_SF_id;
    public $Sorter_ST_id;
    public $Sorter_SB_id;
    public $Sorter_DY_id;
    public $Sorter_ML_id;
    public $Sorter_FD_id;
    public $Sorter_UN_id;
    public $Sorter_QTY;
//End Variables

//Class_Initialize Event @2-C0CCE3EB
    function clsGridINTAKE($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "INTAKE";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid INTAKE";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsINTAKEDataSource($this);
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
        $this->SorterName = CCGetParam("INTAKEOrder", "");
        $this->SorterDirection = CCGetParam("INTAKEDir", "");

        $this->SF_id = new clsControl(ccsLink, "SF_id", "SF_id", ccsInteger, "", CCGetRequestParam("SF_id", ccsGet, NULL), $this);
        $this->SF_id->Page = "FD_INTAKE.php";
        $this->ST_id = new clsControl(ccsLabel, "ST_id", "ST_id", ccsInteger, "", CCGetRequestParam("ST_id", ccsGet, NULL), $this);
        $this->SB_id = new clsControl(ccsLabel, "SB_id", "SB_id", ccsInteger, "", CCGetRequestParam("SB_id", ccsGet, NULL), $this);
        $this->DY_id = new clsControl(ccsLabel, "DY_id", "DY_id", ccsDate, array("yyyy", "mm", "dd"), CCGetRequestParam("DY_id", ccsGet, NULL), $this);
        $this->ML_id = new clsControl(ccsLabel, "ML_id", "ML_id", ccsInteger, "", CCGetRequestParam("ML_id", ccsGet, NULL), $this);
        $this->FD_id = new clsControl(ccsLabel, "FD_id", "FD_id", ccsInteger, "", CCGetRequestParam("FD_id", ccsGet, NULL), $this);
        $this->UN_id = new clsControl(ccsLabel, "UN_id", "UN_id", ccsInteger, "", CCGetRequestParam("UN_id", ccsGet, NULL), $this);
        $this->QTY = new clsControl(ccsLabel, "QTY", "QTY", ccsInteger, "", CCGetRequestParam("QTY", ccsGet, NULL), $this);
        $this->INTAKE_Insert = new clsControl(ccsLink, "INTAKE_Insert", "INTAKE_Insert", ccsText, "", CCGetRequestParam("INTAKE_Insert", ccsGet, NULL), $this);
        $this->INTAKE_Insert->Parameters = CCGetQueryString("QueryString", array("SF_id", "ccsForm"));
        $this->INTAKE_Insert->Page = "FD_INTAKE.php";
        $this->INTAKE_TotalRecords = new clsControl(ccsLabel, "INTAKE_TotalRecords", "INTAKE_TotalRecords", ccsText, "", CCGetRequestParam("INTAKE_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_SF_id = new clsSorter($this->ComponentName, "Sorter_SF_id", $FileName, $this);
        $this->Sorter_ST_id = new clsSorter($this->ComponentName, "Sorter_ST_id", $FileName, $this);
        $this->Sorter_SB_id = new clsSorter($this->ComponentName, "Sorter_SB_id", $FileName, $this);
        $this->Sorter_DY_id = new clsSorter($this->ComponentName, "Sorter_DY_id", $FileName, $this);
        $this->Sorter_ML_id = new clsSorter($this->ComponentName, "Sorter_ML_id", $FileName, $this);
        $this->Sorter_FD_id = new clsSorter($this->ComponentName, "Sorter_FD_id", $FileName, $this);
        $this->Sorter_UN_id = new clsSorter($this->ComponentName, "Sorter_UN_id", $FileName, $this);
        $this->Sorter_QTY = new clsSorter($this->ComponentName, "Sorter_QTY", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
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

//Show Method @2-D6D56C00
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_FD_id"] = CCGetFromGet("s_FD_id", NULL);

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
            $this->ControlsVisible["SF_id"] = $this->SF_id->Visible;
            $this->ControlsVisible["ST_id"] = $this->ST_id->Visible;
            $this->ControlsVisible["SB_id"] = $this->SB_id->Visible;
            $this->ControlsVisible["DY_id"] = $this->DY_id->Visible;
            $this->ControlsVisible["ML_id"] = $this->ML_id->Visible;
            $this->ControlsVisible["FD_id"] = $this->FD_id->Visible;
            $this->ControlsVisible["UN_id"] = $this->UN_id->Visible;
            $this->ControlsVisible["QTY"] = $this->QTY->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                // Parse Separator
                if($this->RowNumber) {
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                }
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->SF_id->SetValue($this->DataSource->SF_id->GetValue());
                $this->SF_id->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->SF_id->Parameters = CCAddParam($this->SF_id->Parameters, "SF_id", $this->DataSource->f("SF_id"));
                $this->ST_id->SetValue($this->DataSource->ST_id->GetValue());
                $this->SB_id->SetValue($this->DataSource->SB_id->GetValue());
                $this->DY_id->SetValue($this->DataSource->DY_id->GetValue());
                $this->ML_id->SetValue($this->DataSource->ML_id->GetValue());
                $this->FD_id->SetValue($this->DataSource->FD_id->GetValue());
                $this->UN_id->SetValue($this->DataSource->UN_id->GetValue());
                $this->QTY->SetValue($this->DataSource->QTY->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->SF_id->Show();
                $this->ST_id->Show();
                $this->SB_id->Show();
                $this->DY_id->Show();
                $this->ML_id->Show();
                $this->FD_id->Show();
                $this->UN_id->Show();
                $this->QTY->Show();
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
        $this->INTAKE_Insert->Show();
        $this->INTAKE_TotalRecords->Show();
        $this->Sorter_SF_id->Show();
        $this->Sorter_ST_id->Show();
        $this->Sorter_SB_id->Show();
        $this->Sorter_DY_id->Show();
        $this->Sorter_ML_id->Show();
        $this->Sorter_FD_id->Show();
        $this->Sorter_UN_id->Show();
        $this->Sorter_QTY->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-4E94DAA9
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->SF_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ST_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SB_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DY_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ML_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FD_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UN_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QTY->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End INTAKE Class @2-FCB6E20C

class clsINTAKEDataSource extends clsDBcandat {  //INTAKEDataSource Class @2-C917AF88

//DataSource Variables @2-69E35C10
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $SF_id;
    public $ST_id;
    public $SB_id;
    public $DY_id;
    public $ML_id;
    public $FD_id;
    public $UN_id;
    public $QTY;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-36A6C29D
    function clsINTAKEDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid INTAKE";
        $this->Initialize();
        $this->SF_id = new clsField("SF_id", ccsInteger, "");
        
        $this->ST_id = new clsField("ST_id", ccsInteger, "");
        
        $this->SB_id = new clsField("SB_id", ccsInteger, "");
        
        $this->DY_id = new clsField("DY_id", ccsDate, $this->DateFormat);
        
        $this->ML_id = new clsField("ML_id", ccsInteger, "");
        
        $this->FD_id = new clsField("FD_id", ccsInteger, "");
        
        $this->UN_id = new clsField("UN_id", ccsInteger, "");
        
        $this->QTY = new clsField("QTY", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-0B4BC1AD
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_SF_id" => array("SF_id", ""), 
            "Sorter_ST_id" => array("ST_id", ""), 
            "Sorter_SB_id" => array("SB_id", ""), 
            "Sorter_DY_id" => array("DY_id", ""), 
            "Sorter_ML_id" => array("ML_id", ""), 
            "Sorter_FD_id" => array("FD_id", ""), 
            "Sorter_UN_id" => array("UN_id", ""), 
            "Sorter_QTY" => array("QTY", "")));
    }
//End SetOrder Method

//Prepare Method @2-05ACCEA5
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_FD_id", ccsInteger, "", "", $this->Parameters["urls_FD_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "FD_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-E68FA4DB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM INTAKE";
        $this->SQL = "SELECT SF_id, ST_id, SB_id, DY_id, ML_id, FD_id, UN_id, QTY \n\n" .
        "FROM INTAKE {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-EFAA7DA8
    function SetValues()
    {
        $this->SF_id->SetDBValue(trim($this->f("SF_id")));
        $this->ST_id->SetDBValue(trim($this->f("ST_id")));
        $this->SB_id->SetDBValue(trim($this->f("SB_id")));
        $this->DY_id->SetDBValue(trim($this->f("DY_id")));
        $this->ML_id->SetDBValue(trim($this->f("ML_id")));
        $this->FD_id->SetDBValue(trim($this->f("FD_id")));
        $this->UN_id->SetDBValue(trim($this->f("UN_id")));
        $this->QTY->SetDBValue(trim($this->f("QTY")));
    }
//End SetValues Method

} //End INTAKEDataSource Class @2-FCB6E20C

class clsRecordINTAKESearch { //INTAKESearch Class @3-00E44294

//Variables @3-9E315808

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

//Class_Initialize Event @3-1988B8A5
    function clsRecordINTAKESearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record INTAKESearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "INTAKESearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_FD_id = new clsControl(ccsTextBox, "s_FD_id", "s_FD_id", ccsInteger, "", CCGetRequestParam("s_FD_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-35884782
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_FD_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_FD_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-68CE1388
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_FD_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
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

//Operation Method @3-D61C682F
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
        $Redirect = "FD_INTAKE.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "FD_INTAKE.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-DF92579C
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
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_FD_id->Errors->ToString());
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
        $this->s_FD_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End INTAKESearch Class @3-FCB6E20C

class clsRecordINTAKE1 { //INTAKE1 Class @37-CD446323

//Variables @37-9E315808

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

//Class_Initialize Event @37-3B1EAD1F
    function clsRecordINTAKE1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record INTAKE1/Error";
        $this->DataSource = new clsINTAKE1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "INTAKE1";
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
            $this->SB_id = new clsControl(ccsTextBox, "SB_id", "SB Id", ccsInteger, "", CCGetRequestParam("SB_id", $Method, NULL), $this);
            $this->SB_id->Required = true;
            $this->DY_id = new clsControl(ccsTextBox, "DY_id", "DY Id", ccsDate, array("yyyy", "mm", "dd"), CCGetRequestParam("DY_id", $Method, NULL), $this);
            $this->DY_id->Required = true;
            $this->DatePicker_DY_id = new clsDatePicker("DatePicker_DY_id", "INTAKE1", "DY_id", $this);
            $this->MLS_id = new clsControl(ccsTextBox, "MLS_id", "ML Id", ccsInteger, "", CCGetRequestParam("MLS_id", $Method, NULL), $this);
            $this->MLS_id->Required = true;
            $this->FD_id = new clsControl(ccsTextBox, "FD_id", "FD Id", ccsInteger, "", CCGetRequestParam("FD_id", $Method, NULL), $this);
            $this->FD_id->Required = true;
            $this->QTY = new clsControl(ccsTextBox, "QTY", "QTY", ccsInteger, "", CCGetRequestParam("QTY", $Method, NULL), $this);
            $this->QTY->Required = true;
            $this->Meal = new clsControl(ccsLabel, "Meal", "Meal", ccsText, "", CCGetRequestParam("Meal", $Method, NULL), $this);
            $this->FD_NME = new clsControl(ccsTextBox, "FD_NME", "Food", ccsText, "", CCGetRequestParam("FD_NME", $Method, NULL), $this);
            $this->Study = new clsControl(ccsLabel, "Study", "Study", ccsText, "", CCGetRequestParam("Study", $Method, NULL), $this);
            $this->UN_id = new clsControl(ccsListBox, "UN_id", "UN Id", ccsInteger, "", CCGetRequestParam("UN_id", $Method, NULL), $this);
            $this->UN_id->DSType = dsTable;
            $this->UN_id->DataSource = new clsDBcandat();
            $this->UN_id->ds = & $this->UN_id->DataSource;
            $this->UN_id->DataSource->SQL = "SELECT concat(MSR_NME,' ',CONV_FAC) AS conv, MSR_NME, FCT_id, FD_ID, CONV_FAC, FD_CODE, FD_NME, conv AS FD_FACT_conv \n" .
"FROM FD_FACT {SQL_Where} {SQL_OrderBy}";
            list($this->UN_id->BoundColumn, $this->UN_id->TextColumn, $this->UN_id->DBFormat) = array("FCT_id", "FD_FACT_conv", "");
            $this->UN_id->DataSource->Parameters["urlFD_id"] = CCGetFromGet("FD_id", NULL);
            $this->UN_id->DataSource->wp = new clsSQLParameters();
            $this->UN_id->DataSource->wp->AddParameter("1", "urlFD_id", ccsInteger, "", "", $this->UN_id->DataSource->Parameters["urlFD_id"], "", false);
            $this->UN_id->DataSource->wp->Criterion[1] = $this->UN_id->DataSource->wp->Operation(opEqual, "FD_CODE", $this->UN_id->DataSource->wp->GetDBValue("1"), $this->UN_id->DataSource->ToSQL($this->UN_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->UN_id->DataSource->Where = 
                 $this->UN_id->DataSource->wp->Criterion[1];
            $this->UN_id->Required = true;
            $this->Grams = new clsControl(ccsTextBox, "Grams", "Grams", ccsSingle, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Grams", $Method, NULL), $this);
            $this->Unit = new clsControl(ccsTextBox, "Unit", "Unit", ccsFloat, array(False, 4, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Unit", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->DY_id->Value) && !strlen($this->DY_id->Value) && $this->DY_id->Value !== false)
                    $this->DY_id->SetValue(time());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @37-CF9A52BF
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlSF_id"] = CCGetFromGet("SF_id", NULL);
    }
//End Initialize Method

//Validate Method @37-11139536
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ST_id->Validate() && $Validation);
        $Validation = ($this->SB_id->Validate() && $Validation);
        $Validation = ($this->DY_id->Validate() && $Validation);
        $Validation = ($this->MLS_id->Validate() && $Validation);
        $Validation = ($this->FD_id->Validate() && $Validation);
        $Validation = ($this->QTY->Validate() && $Validation);
        $Validation = ($this->FD_NME->Validate() && $Validation);
        $Validation = ($this->UN_id->Validate() && $Validation);
        $Validation = ($this->Grams->Validate() && $Validation);
        $Validation = ($this->Unit->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ST_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SB_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DY_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->MLS_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FD_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->QTY->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FD_NME->Errors->Count() == 0);
        $Validation =  $Validation && ($this->UN_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Grams->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Unit->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @37-1CF88A8A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ST_id->Errors->Count());
        $errors = ($errors || $this->SB_id->Errors->Count());
        $errors = ($errors || $this->DY_id->Errors->Count());
        $errors = ($errors || $this->DatePicker_DY_id->Errors->Count());
        $errors = ($errors || $this->MLS_id->Errors->Count());
        $errors = ($errors || $this->FD_id->Errors->Count());
        $errors = ($errors || $this->QTY->Errors->Count());
        $errors = ($errors || $this->Meal->Errors->Count());
        $errors = ($errors || $this->FD_NME->Errors->Count());
        $errors = ($errors || $this->Study->Errors->Count());
        $errors = ($errors || $this->UN_id->Errors->Count());
        $errors = ($errors || $this->Grams->Errors->Count());
        $errors = ($errors || $this->Unit->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @37-ED598703
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

//Operation Method @37-288F0419
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
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
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

//InsertRow Method @37-A68754ED
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ST_id->SetValue($this->ST_id->GetValue(true));
        $this->DataSource->SB_id->SetValue($this->SB_id->GetValue(true));
        $this->DataSource->DY_id->SetValue($this->DY_id->GetValue(true));
        $this->DataSource->MLS_id->SetValue($this->MLS_id->GetValue(true));
        $this->DataSource->FD_id->SetValue($this->FD_id->GetValue(true));
        $this->DataSource->UN_id->SetValue($this->UN_id->GetValue(true));
        $this->DataSource->QTY->SetValue($this->QTY->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @37-4BECAC6B
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->DY_id->SetValue($this->DY_id->GetValue(true));
        $this->DataSource->FD_id->SetValue($this->FD_id->GetValue(true));
        $this->DataSource->UN_id->SetValue($this->UN_id->GetValue(true));
        $this->DataSource->QTY->SetValue($this->QTY->GetValue(true));
        $this->DataSource->ST_id->SetValue($this->ST_id->GetValue(true));
        $this->DataSource->SB_id->SetValue($this->SB_id->GetValue(true));
        $this->DataSource->MLS_id->SetValue($this->MLS_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @37-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @37-F11ED887
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

        $this->UN_id->Prepare();

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
                $this->Meal->SetValue($this->DataSource->Meal->GetValue());
                $this->Study->SetValue($this->DataSource->Study->GetValue());
                if(!$this->FormSubmitted){
                    $this->ST_id->SetValue($this->DataSource->ST_id->GetValue());
                    $this->SB_id->SetValue($this->DataSource->SB_id->GetValue());
                    $this->DY_id->SetValue($this->DataSource->DY_id->GetValue());
                    $this->MLS_id->SetValue($this->DataSource->MLS_id->GetValue());
                    $this->FD_id->SetValue($this->DataSource->FD_id->GetValue());
                    $this->QTY->SetValue($this->DataSource->QTY->GetValue());
                    $this->FD_NME->SetValue($this->DataSource->FD_NME->GetValue());
                    $this->UN_id->SetValue($this->DataSource->UN_id->GetValue());
                    $this->Unit->SetValue($this->DataSource->Unit->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }
        if ($this->FD_id->GetValue() < 0 )
             $this->FD_id->Text = CCFormatNumber($this->FD_id->GetValue(), array(False, 0, Null, "", True, "(", ")", 1, True, ""));
        else
             $this->FD_id->Text = CCFormatNumber($this->FD_id->GetValue(), array(False, 0, Null, "", False, "", "", 1, True, ""));

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ST_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SB_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DY_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_DY_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->MLS_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FD_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->QTY->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Meal->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FD_NME->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Study->Errors->ToString());
            $Error = ComposeStrings($Error, $this->UN_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Grams->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Unit->Errors->ToString());
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
        $this->SB_id->Show();
        $this->DY_id->Show();
        $this->DatePicker_DY_id->Show();
        $this->MLS_id->Show();
        $this->FD_id->Show();
        $this->QTY->Show();
        $this->Meal->Show();
        $this->FD_NME->Show();
        $this->Study->Show();
        $this->UN_id->Show();
        $this->Grams->Show();
        $this->Unit->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End INTAKE1 Class @37-FCB6E20C

class clsINTAKE1DataSource extends clsDBcandat {  //INTAKE1DataSource Class @37-7F4AF310

//DataSource Variables @37-2A770737
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
    public $SB_id;
    public $DY_id;
    public $MLS_id;
    public $FD_id;
    public $QTY;
    public $Meal;
    public $FD_NME;
    public $Study;
    public $UN_id;
    public $Grams;
    public $Unit;
//End DataSource Variables

//DataSourceClass_Initialize Event @37-F37DE1B8
    function clsINTAKE1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record INTAKE1/Error";
        $this->Initialize();
        $this->ST_id = new clsField("ST_id", ccsInteger, "");
        
        $this->SB_id = new clsField("SB_id", ccsInteger, "");
        
        $this->DY_id = new clsField("DY_id", ccsDate, $this->DateFormat);
        
        $this->MLS_id = new clsField("MLS_id", ccsInteger, "");
        
        $this->FD_id = new clsField("FD_id", ccsInteger, "");
        
        $this->QTY = new clsField("QTY", ccsInteger, "");
        
        $this->Meal = new clsField("Meal", ccsText, "");
        
        $this->FD_NME = new clsField("FD_NME", ccsText, "");
        
        $this->Study = new clsField("Study", ccsText, "");
        
        $this->UN_id = new clsField("UN_id", ccsInteger, "");
        
        $this->Grams = new clsField("Grams", ccsSingle, "");
        
        $this->Unit = new clsField("Unit", ccsFloat, "");
        

        $this->InsertFields["ST_id"] = array("Name" => "ST_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["SB_id"] = array("Name" => "SB_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DY_id"] = array("Name" => "DY_id", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["ML_id"] = array("Name" => "ML_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["FD_id"] = array("Name" => "FD_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["UN_id"] = array("Name" => "UN_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["QTY"] = array("Name" => "QTY", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DY_id"] = array("Name" => "DY_id", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["FD_id"] = array("Name" => "FD_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["UN_id"] = array("Name" => "UN_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["QTY"] = array("Name" => "QTY", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ST_id"] = array("Name" => "ST_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["SB_id"] = array("Name" => "SB_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ML_id"] = array("Name" => "ML_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @37-FA49A186
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlSF_id", ccsInteger, "", "", $this->Parameters["urlSF_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "SF_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @37-0974A7E9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM INTAKE_DESC {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @37-8CBF6759
    function SetValues()
    {
        $this->ST_id->SetDBValue(trim($this->f("ST_id")));
        $this->SB_id->SetDBValue(trim($this->f("SB_id")));
        $this->DY_id->SetDBValue(trim($this->f("DY_id")));
        $this->MLS_id->SetDBValue(trim($this->f("MLS_id")));
        $this->FD_id->SetDBValue(trim($this->f("FD_id")));
        $this->QTY->SetDBValue(trim($this->f("QTY")));
        $this->Meal->SetDBValue($this->f("ML_NME"));
        $this->FD_NME->SetDBValue($this->f("FD_NME"));
        $this->Study->SetDBValue($this->f("short_desc"));
        $this->UN_id->SetDBValue(trim($this->f("UN_id")));
        $this->Unit->SetDBValue(trim($this->f("CONV_FAC")));
    }
//End SetValues Method

//Insert Method @37-8F06D6A5
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["ST_id"] = new clsSQLParameter("ctrlST_id", ccsInteger, "", "", $this->ST_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["SB_id"] = new clsSQLParameter("ctrlSB_id", ccsInteger, "", "", $this->SB_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DY_id"] = new clsSQLParameter("ctrlDY_id", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->DY_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["ML_id"] = new clsSQLParameter("ctrlMLS_id", ccsInteger, "", "", $this->MLS_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["FD_id"] = new clsSQLParameter("ctrlFD_id", ccsInteger, "", "", $this->FD_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["UN_id"] = new clsSQLParameter("ctrlUN_id", ccsInteger, "", "", $this->UN_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["QTY"] = new clsSQLParameter("ctrlQTY", ccsInteger, "", "", $this->QTY->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["ST_id"]->GetValue()) and !strlen($this->cp["ST_id"]->GetText()) and !is_bool($this->cp["ST_id"]->GetValue())) 
            $this->cp["ST_id"]->SetValue($this->ST_id->GetValue(true));
        if (!is_null($this->cp["SB_id"]->GetValue()) and !strlen($this->cp["SB_id"]->GetText()) and !is_bool($this->cp["SB_id"]->GetValue())) 
            $this->cp["SB_id"]->SetValue($this->SB_id->GetValue(true));
        if (!is_null($this->cp["DY_id"]->GetValue()) and !strlen($this->cp["DY_id"]->GetText()) and !is_bool($this->cp["DY_id"]->GetValue())) 
            $this->cp["DY_id"]->SetValue($this->DY_id->GetValue(true));
        if (!is_null($this->cp["ML_id"]->GetValue()) and !strlen($this->cp["ML_id"]->GetText()) and !is_bool($this->cp["ML_id"]->GetValue())) 
            $this->cp["ML_id"]->SetValue($this->MLS_id->GetValue(true));
        if (!is_null($this->cp["FD_id"]->GetValue()) and !strlen($this->cp["FD_id"]->GetText()) and !is_bool($this->cp["FD_id"]->GetValue())) 
            $this->cp["FD_id"]->SetValue($this->FD_id->GetValue(true));
        if (!is_null($this->cp["UN_id"]->GetValue()) and !strlen($this->cp["UN_id"]->GetText()) and !is_bool($this->cp["UN_id"]->GetValue())) 
            $this->cp["UN_id"]->SetValue($this->UN_id->GetValue(true));
        if (!is_null($this->cp["QTY"]->GetValue()) and !strlen($this->cp["QTY"]->GetText()) and !is_bool($this->cp["QTY"]->GetValue())) 
            $this->cp["QTY"]->SetValue($this->QTY->GetValue(true));
        $this->InsertFields["ST_id"]["Value"] = $this->cp["ST_id"]->GetDBValue(true);
        $this->InsertFields["SB_id"]["Value"] = $this->cp["SB_id"]->GetDBValue(true);
        $this->InsertFields["DY_id"]["Value"] = $this->cp["DY_id"]->GetDBValue(true);
        $this->InsertFields["ML_id"]["Value"] = $this->cp["ML_id"]->GetDBValue(true);
        $this->InsertFields["FD_id"]["Value"] = $this->cp["FD_id"]->GetDBValue(true);
        $this->InsertFields["UN_id"]["Value"] = $this->cp["UN_id"]->GetDBValue(true);
        $this->InsertFields["QTY"]["Value"] = $this->cp["QTY"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("INTAKE", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @37-B0402899
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["DY_id"] = new clsSQLParameter("ctrlDY_id", ccsDate, array("yyyy", "mm", "dd"), $this->DateFormat, $this->DY_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["FD_id"] = new clsSQLParameter("ctrlFD_id", ccsInteger, "", "", $this->FD_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["UN_id"] = new clsSQLParameter("ctrlUN_id", ccsInteger, "", "", $this->UN_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["QTY"] = new clsSQLParameter("ctrlQTY", ccsInteger, "", "", $this->QTY->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["ST_id"] = new clsSQLParameter("ctrlST_id", ccsInteger, "", "", $this->ST_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["SB_id"] = new clsSQLParameter("ctrlSB_id", ccsInteger, "", "", $this->SB_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["ML_id"] = new clsSQLParameter("ctrlMLS_id", ccsInteger, "", "", $this->MLS_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "urlSF_id", ccsInteger, "", "", CCGetFromGet("SF_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["DY_id"]->GetValue()) and !strlen($this->cp["DY_id"]->GetText()) and !is_bool($this->cp["DY_id"]->GetValue())) 
            $this->cp["DY_id"]->SetValue($this->DY_id->GetValue(true));
        if (!is_null($this->cp["FD_id"]->GetValue()) and !strlen($this->cp["FD_id"]->GetText()) and !is_bool($this->cp["FD_id"]->GetValue())) 
            $this->cp["FD_id"]->SetValue($this->FD_id->GetValue(true));
        if (!is_null($this->cp["UN_id"]->GetValue()) and !strlen($this->cp["UN_id"]->GetText()) and !is_bool($this->cp["UN_id"]->GetValue())) 
            $this->cp["UN_id"]->SetValue($this->UN_id->GetValue(true));
        if (!is_null($this->cp["QTY"]->GetValue()) and !strlen($this->cp["QTY"]->GetText()) and !is_bool($this->cp["QTY"]->GetValue())) 
            $this->cp["QTY"]->SetValue($this->QTY->GetValue(true));
        if (!is_null($this->cp["ST_id"]->GetValue()) and !strlen($this->cp["ST_id"]->GetText()) and !is_bool($this->cp["ST_id"]->GetValue())) 
            $this->cp["ST_id"]->SetValue($this->ST_id->GetValue(true));
        if (!is_null($this->cp["SB_id"]->GetValue()) and !strlen($this->cp["SB_id"]->GetText()) and !is_bool($this->cp["SB_id"]->GetValue())) 
            $this->cp["SB_id"]->SetValue($this->SB_id->GetValue(true));
        if (!is_null($this->cp["ML_id"]->GetValue()) and !strlen($this->cp["ML_id"]->GetText()) and !is_bool($this->cp["ML_id"]->GetValue())) 
            $this->cp["ML_id"]->SetValue($this->MLS_id->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "SF_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["DY_id"]["Value"] = $this->cp["DY_id"]->GetDBValue(true);
        $this->UpdateFields["FD_id"]["Value"] = $this->cp["FD_id"]->GetDBValue(true);
        $this->UpdateFields["UN_id"]["Value"] = $this->cp["UN_id"]->GetDBValue(true);
        $this->UpdateFields["QTY"]["Value"] = $this->cp["QTY"]->GetDBValue(true);
        $this->UpdateFields["ST_id"]["Value"] = $this->cp["ST_id"]->GetDBValue(true);
        $this->UpdateFields["SB_id"]["Value"] = $this->cp["SB_id"]->GetDBValue(true);
        $this->UpdateFields["ML_id"]["Value"] = $this->cp["ML_id"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("INTAKE", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @37-F42CAE79
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "urlSF_id", ccsInteger, "", "", CCGetFromGet("SF_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $wp->Criterion[1] = $wp->Operation(opEqual, "SF_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->SQL = "DELETE FROM INTAKE";
        $this->SQL = CCBuildSQL($this->SQL, $Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End INTAKE1DataSource Class @37-FCB6E20C

//Initialize Page @1-6DEADAC3
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
$TemplateFileName = "FD_INTAKE.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-E43621B8
include_once("./FD_INTAKE_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-CB6600D1
$DBcandat = new clsDBcandat();
$MainPage->Connections["candat"] = & $DBcandat;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$INTAKE = new clsGridINTAKE("", $MainPage);
$INTAKESearch = new clsRecordINTAKESearch("", $MainPage);
$INTAKE1 = new clsRecordINTAKE1("", $MainPage);
$MainPage->INTAKE = & $INTAKE;
$MainPage->INTAKESearch = & $INTAKESearch;
$MainPage->INTAKE1 = & $INTAKE1;
$INTAKE->Initialize();
$INTAKE1->Initialize();

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

//Execute Components @1-E99FDCC3
$INTAKESearch->Operation();
$INTAKE1->Operation();
//End Execute Components

//Go to destination page @1-1B8FCDC9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcandat->close();
    header("Location: " . $Redirect);
    unset($INTAKE);
    unset($INTAKESearch);
    unset($INTAKE1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7079F0A4
$INTAKE->Show();
$INTAKESearch->Show();
$INTAKE1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-CF55FD9D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcandat->close();
unset($INTAKE);
unset($INTAKESearch);
unset($INTAKE1);
unset($Tpl);
//End Unload Page


?>
