<?php
//Include Common Files @1-633F97D7
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "Studies.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @24-E89C636C
include_once(RelativePath . "/Header_live.php");
//End Include Page implementation

//Include Page implementation @25-58DBA1E3
include_once(RelativePath . "/Footer.php");
//End Include Page implementation

class clsGridSTUDIES2 { //STUDIES2 class @28-B51A1333

//Variables @28-46643DD1

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
    public $Sorter_ST_id;
    public $Sorter_short_desc;
    public $Sorter_long_desc;
//End Variables

//Class_Initialize Event @28-9F45F5B4
    function clsGridSTUDIES2($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "STUDIES2";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid STUDIES2";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsSTUDIES2DataSource($this);
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
        $this->SorterName = CCGetParam("STUDIES2Order", "");
        $this->SorterDirection = CCGetParam("STUDIES2Dir", "");

        $this->ST_id = new clsControl(ccsLink, "ST_id", "ST_id", ccsInteger, "", CCGetRequestParam("ST_id", ccsGet, NULL), $this);
        $this->ST_id->Page = "Studies.php";
        $this->short_desc = new clsControl(ccsLabel, "short_desc", "short_desc", ccsText, "", CCGetRequestParam("short_desc", ccsGet, NULL), $this);
        $this->long_desc = new clsControl(ccsLabel, "long_desc", "long_desc", ccsText, "", CCGetRequestParam("long_desc", ccsGet, NULL), $this);
        $this->STUDIES_Insert = new clsControl(ccsLink, "STUDIES_Insert", "STUDIES_Insert", ccsText, "", CCGetRequestParam("STUDIES_Insert", ccsGet, NULL), $this);
        $this->STUDIES_Insert->Parameters = CCGetQueryString("QueryString", array("ST_id", "ccsForm"));
        $this->STUDIES_Insert->Page = "Studies.php";
        $this->Sorter_ST_id = new clsSorter($this->ComponentName, "Sorter_ST_id", $FileName, $this);
        $this->Sorter_short_desc = new clsSorter($this->ComponentName, "Sorter_short_desc", $FileName, $this);
        $this->Sorter_long_desc = new clsSorter($this->ComponentName, "Sorter_long_desc", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @28-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @28-392F62BC
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
            $this->ControlsVisible["ST_id"] = $this->ST_id->Visible;
            $this->ControlsVisible["short_desc"] = $this->short_desc->Visible;
            $this->ControlsVisible["long_desc"] = $this->long_desc->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ST_id->SetValue($this->DataSource->ST_id->GetValue());
                $this->ST_id->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ST_id->Parameters = CCAddParam($this->ST_id->Parameters, "ST_id", $this->DataSource->f("ST_id"));
                $this->short_desc->SetValue($this->DataSource->short_desc->GetValue());
                $this->long_desc->SetValue($this->DataSource->long_desc->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ST_id->Show();
                $this->short_desc->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->STUDIES_Insert->Show();
        $this->Sorter_ST_id->Show();
        $this->Sorter_short_desc->Show();
        $this->Sorter_long_desc->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @28-C905AD63
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ST_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->short_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->long_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End STUDIES2 Class @28-FCB6E20C

class clsSTUDIES2DataSource extends clsDBcandat {  //STUDIES2DataSource Class @28-C058E346

//DataSource Variables @28-6F5CE830
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $ST_id;
    public $short_desc;
    public $long_desc;
//End DataSource Variables

//DataSourceClass_Initialize Event @28-331EAFD3
    function clsSTUDIES2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid STUDIES2";
        $this->Initialize();
        $this->ST_id = new clsField("ST_id", ccsInteger, "");
        
        $this->short_desc = new clsField("short_desc", ccsText, "");
        
        $this->long_desc = new clsField("long_desc", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @28-07B5DD11
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_ST_id" => array("ST_id", ""), 
            "Sorter_short_desc" => array("short_desc", ""), 
            "Sorter_long_desc" => array("long_desc", "")));
    }
//End SetOrder Method

//Prepare Method @28-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @28-1A411D8C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM STUDIES";
        $this->SQL = "SELECT ST_id, short_desc, long_desc \n\n" .
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

//SetValues Method @28-9BB6519B
    function SetValues()
    {
        $this->ST_id->SetDBValue(trim($this->f("ST_id")));
        $this->short_desc->SetDBValue($this->f("short_desc"));
        $this->long_desc->SetDBValue($this->f("long_desc"));
    }
//End SetValues Method

} //End STUDIES2DataSource Class @28-FCB6E20C

//Include Page implementation @26-8067CD60
include_once(RelativePath . "/ADMIN_VARS.php");
//End Include Page implementation

//Include Page implementation @27-B2879F02
include_once(RelativePath . "/ADMIN_MEALS.php");
//End Include Page implementation

class clsRecordSTUDIES1 { //STUDIES1 Class @15-AE55E682

//Variables @15-9E315808

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

//Class_Initialize Event @15-85DFD1A5
    function clsRecordSTUDIES1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record STUDIES1/Error";
        $this->DataSource = new clsSTUDIES1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "STUDIES1";
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
            $this->short_desc = new clsControl(ccsTextBox, "short_desc", "Short Desc", ccsText, "", CCGetRequestParam("short_desc", $Method, NULL), $this);
            $this->short_desc->Required = true;
            $this->long_desc = new clsControl(ccsTextBox, "long_desc", "Long Desc", ccsText, "", CCGetRequestParam("long_desc", $Method, NULL), $this);
            $this->ST_id = new clsControl(ccsHidden, "ST_id", "ST_id", ccsInteger, "", CCGetRequestParam("ST_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @15-10762CB4
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlST_id"] = CCGetFromGet("ST_id", NULL);
    }
//End Initialize Method

//Validate Method @15-1E72638F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->short_desc->Validate() && $Validation);
        $Validation = ($this->long_desc->Validate() && $Validation);
        $Validation = ($this->ST_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->short_desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->long_desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ST_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @15-49D988D6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->short_desc->Errors->Count());
        $errors = ($errors || $this->long_desc->Errors->Count());
        $errors = ($errors || $this->ST_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @15-ED598703
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

//Operation Method @15-9DF661CA
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
        $Redirect = "Studies.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = "Studies.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ST_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "Studies.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ST_id"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "Studies.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ST_id"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "Studies.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ST_id"));
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

//InsertRow Method @15-8C486FCD
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->short_desc->SetValue($this->short_desc->GetValue(true));
        $this->DataSource->long_desc->SetValue($this->long_desc->GetValue(true));
        $this->DataSource->ST_id->SetValue($this->ST_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @15-7584B252
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->short_desc->SetValue($this->short_desc->GetValue(true));
        $this->DataSource->long_desc->SetValue($this->long_desc->GetValue(true));
        $this->DataSource->ST_id->SetValue($this->ST_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @15-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @15-9E8E3961
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
                    $this->short_desc->SetValue($this->DataSource->short_desc->GetValue());
                    $this->long_desc->SetValue($this->DataSource->long_desc->GetValue());
                    $this->ST_id->SetValue($this->DataSource->ST_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->short_desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->long_desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ST_id->Errors->ToString());
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
        $this->short_desc->Show();
        $this->long_desc->Show();
        $this->ST_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End STUDIES1 Class @15-FCB6E20C

class clsSTUDIES1DataSource extends clsDBcandat {  //STUDIES1DataSource Class @15-84F9C65E

//DataSource Variables @15-D9D3C95C
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
    public $short_desc;
    public $long_desc;
    public $ST_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @15-A5214205
    function clsSTUDIES1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record STUDIES1/Error";
        $this->Initialize();
        $this->short_desc = new clsField("short_desc", ccsText, "");
        
        $this->long_desc = new clsField("long_desc", ccsText, "");
        
        $this->ST_id = new clsField("ST_id", ccsInteger, "");
        

        $this->InsertFields["short_desc"] = array("Name" => "short_desc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["long_desc"] = array("Name" => "long_desc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ST_id"] = array("Name" => "ST_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["short_desc"] = array("Name" => "short_desc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["long_desc"] = array("Name" => "long_desc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ST_id"] = array("Name" => "ST_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @15-19C0FD19
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlST_id", ccsInteger, "", "", $this->Parameters["urlST_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ST_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @15-159E6C08
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM STUDIES {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @15-3411C10C
    function SetValues()
    {
        $this->short_desc->SetDBValue($this->f("short_desc"));
        $this->long_desc->SetDBValue($this->f("long_desc"));
        $this->ST_id->SetDBValue(trim($this->f("ST_id")));
    }
//End SetValues Method

//Insert Method @15-8B24ACB9
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["short_desc"]["Value"] = $this->short_desc->GetDBValue(true);
        $this->InsertFields["long_desc"]["Value"] = $this->long_desc->GetDBValue(true);
        $this->InsertFields["ST_id"]["Value"] = $this->ST_id->GetDBValue(true);
        $this->SQL = CCBuildInsert("STUDIES", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @15-665DA0E3
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["short_desc"]["Value"] = $this->short_desc->GetDBValue(true);
        $this->UpdateFields["long_desc"]["Value"] = $this->long_desc->GetDBValue(true);
        $this->UpdateFields["ST_id"]["Value"] = $this->ST_id->GetDBValue(true);
        $this->SQL = CCBuildUpdate("STUDIES", $this->UpdateFields, $this);
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

//Delete Method @15-7BE6FFA1
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM STUDIES";
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

} //End STUDIES1DataSource Class @15-FCB6E20C

class clsGridST_VARS { //ST_VARS class @46-ADD0F14A

//Variables @46-4458AE68

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
    public $Sorter_STV_id;
    public $Sorter_ST_id;
    public $Sorter_VAR_id;
    public $Sorter_VR_NME;
//End Variables

//Class_Initialize Event @46-D419D74A
    function clsGridST_VARS($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "ST_VARS";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid ST_VARS";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsST_VARSDataSource($this);
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
        $this->SorterName = CCGetParam("ST_VARSOrder", "");
        $this->SorterDirection = CCGetParam("ST_VARSDir", "");

        $this->STV_id = new clsControl(ccsLink, "STV_id", "STV_id", ccsInteger, "", CCGetRequestParam("STV_id", ccsGet, NULL), $this);
        $this->STV_id->Page = "Studies.php";
        $this->ST_id = new clsControl(ccsLabel, "ST_id", "ST_id", ccsInteger, "", CCGetRequestParam("ST_id", ccsGet, NULL), $this);
        $this->VAR_id = new clsControl(ccsLabel, "VAR_id", "VAR_id", ccsInteger, "", CCGetRequestParam("VAR_id", ccsGet, NULL), $this);
        $this->VR_NME = new clsControl(ccsLabel, "VR_NME", "VR_NME", ccsText, "", CCGetRequestParam("VR_NME", ccsGet, NULL), $this);
        $this->ST_VARS_Insert = new clsControl(ccsLink, "ST_VARS_Insert", "ST_VARS_Insert", ccsText, "", CCGetRequestParam("ST_VARS_Insert", ccsGet, NULL), $this);
        $this->ST_VARS_Insert->Parameters = CCGetQueryString("QueryString", array("STV_id", "ccsForm"));
        $this->ST_VARS_Insert->Page = "Studies.php";
        $this->ST_VARS_TotalRecords = new clsControl(ccsLabel, "ST_VARS_TotalRecords", "ST_VARS_TotalRecords", ccsText, "", CCGetRequestParam("ST_VARS_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_STV_id = new clsSorter($this->ComponentName, "Sorter_STV_id", $FileName, $this);
        $this->Sorter_ST_id = new clsSorter($this->ComponentName, "Sorter_ST_id", $FileName, $this);
        $this->Sorter_VAR_id = new clsSorter($this->ComponentName, "Sorter_VAR_id", $FileName, $this);
        $this->Sorter_VR_NME = new clsSorter($this->ComponentName, "Sorter_VR_NME", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @46-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @46-484D96E5
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
            $this->ControlsVisible["STV_id"] = $this->STV_id->Visible;
            $this->ControlsVisible["ST_id"] = $this->ST_id->Visible;
            $this->ControlsVisible["VAR_id"] = $this->VAR_id->Visible;
            $this->ControlsVisible["VR_NME"] = $this->VR_NME->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->STV_id->SetValue($this->DataSource->STV_id->GetValue());
                $this->STV_id->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->STV_id->Parameters = CCAddParam($this->STV_id->Parameters, "STV_id", $this->DataSource->f("STV_id"));
                $this->ST_id->SetValue($this->DataSource->ST_id->GetValue());
                $this->VAR_id->SetValue($this->DataSource->VAR_id->GetValue());
                $this->VR_NME->SetValue($this->DataSource->VR_NME->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->STV_id->Show();
                $this->ST_id->Show();
                $this->VAR_id->Show();
                $this->VR_NME->Show();
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
        $this->ST_VARS_Insert->Show();
        $this->ST_VARS_TotalRecords->Show();
        $this->Sorter_STV_id->Show();
        $this->Sorter_ST_id->Show();
        $this->Sorter_VAR_id->Show();
        $this->Sorter_VR_NME->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @46-B6133A81
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->STV_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ST_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->VAR_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->VR_NME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End ST_VARS Class @46-FCB6E20C

class clsST_VARSDataSource extends clsDBcandat {  //ST_VARSDataSource Class @46-89FAA86D

//DataSource Variables @46-1C8D436F
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $STV_id;
    public $ST_id;
    public $VAR_id;
    public $VR_NME;
//End DataSource Variables

//DataSourceClass_Initialize Event @46-D9A9A3EE
    function clsST_VARSDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid ST_VARS";
        $this->Initialize();
        $this->STV_id = new clsField("STV_id", ccsInteger, "");
        
        $this->ST_id = new clsField("ST_id", ccsInteger, "");
        
        $this->VAR_id = new clsField("VAR_id", ccsInteger, "");
        
        $this->VR_NME = new clsField("VR_NME", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @46-0A21F787
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_STV_id" => array("STV_id", ""), 
            "Sorter_ST_id" => array("ST_id", ""), 
            "Sorter_VAR_id" => array("VAR_id", ""), 
            "Sorter_VR_NME" => array("VR_NME", "")));
    }
//End SetOrder Method

//Prepare Method @46-311B7A2D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlST_id", ccsInteger, "", "", $this->Parameters["urlST_id"], -999, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ST_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @46-8611A295
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ST_VARS";
        $this->SQL = "SELECT STV_id, ST_id, VAR_id, VR_NME \n\n" .
        "FROM ST_VARS {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @46-37B3A3C7
    function SetValues()
    {
        $this->STV_id->SetDBValue(trim($this->f("STV_id")));
        $this->ST_id->SetDBValue(trim($this->f("ST_id")));
        $this->VAR_id->SetDBValue(trim($this->f("VAR_id")));
        $this->VR_NME->SetDBValue($this->f("VR_NME"));
    }
//End SetValues Method

} //End ST_VARSDataSource Class @46-FCB6E20C

class clsRecordST_VARS1 { //ST_VARS1 Class @65-B9853EBB

//Variables @65-9E315808

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

//Class_Initialize Event @65-49F93A4B
    function clsRecordST_VARS1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record ST_VARS1/Error";
        $this->DataSource = new clsST_VARS1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "ST_VARS1";
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
            $this->VAR_id = new clsControl(ccsTextBox, "VAR_id", "VAR Id", ccsInteger, "", CCGetRequestParam("VAR_id", $Method, NULL), $this);
            $this->VAR_id->Required = true;
            $this->VR_NME = new clsControl(ccsTextBox, "VR_NME", "VR NME", ccsText, "", CCGetRequestParam("VR_NME", $Method, NULL), $this);
            $this->VR_NME->Required = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @65-175A5FD7
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlSTV_id"] = CCGetFromGet("STV_id", NULL);
    }
//End Initialize Method

//Validate Method @65-E2600CF8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ST_id->Validate() && $Validation);
        $Validation = ($this->VAR_id->Validate() && $Validation);
        $Validation = ($this->VR_NME->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ST_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->VAR_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->VR_NME->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @65-DDDEE0DE
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ST_id->Errors->Count());
        $errors = ($errors || $this->VAR_id->Errors->Count());
        $errors = ($errors || $this->VR_NME->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @65-ED598703
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

//Operation Method @65-288F0419
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

//InsertRow Method @65-1CA22475
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ST_id->SetValue($this->ST_id->GetValue(true));
        $this->DataSource->VAR_id->SetValue($this->VAR_id->GetValue(true));
        $this->DataSource->VR_NME->SetValue($this->VR_NME->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @65-59F7EA82
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ST_id->SetValue($this->ST_id->GetValue(true));
        $this->DataSource->VAR_id->SetValue($this->VAR_id->GetValue(true));
        $this->DataSource->VR_NME->SetValue($this->VR_NME->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @65-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @65-2B3C6F58
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
                    $this->VAR_id->SetValue($this->DataSource->VAR_id->GetValue());
                    $this->VR_NME->SetValue($this->DataSource->VR_NME->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ST_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->VAR_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->VR_NME->Errors->ToString());
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
        $this->VAR_id->Show();
        $this->VR_NME->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End ST_VARS1 Class @65-FCB6E20C

class clsST_VARS1DataSource extends clsDBcandat {  //ST_VARS1DataSource Class @65-AF6A08E0

//DataSource Variables @65-E3F63D2B
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
    public $VAR_id;
    public $VR_NME;
//End DataSource Variables

//DataSourceClass_Initialize Event @65-D3CAE272
    function clsST_VARS1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record ST_VARS1/Error";
        $this->Initialize();
        $this->ST_id = new clsField("ST_id", ccsInteger, "");
        
        $this->VAR_id = new clsField("VAR_id", ccsInteger, "");
        
        $this->VR_NME = new clsField("VR_NME", ccsText, "");
        

        $this->InsertFields["ST_id"] = array("Name" => "ST_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["VAR_id"] = array("Name" => "VAR_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["VR_NME"] = array("Name" => "VR_NME", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ST_id"] = array("Name" => "ST_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["VAR_id"] = array("Name" => "VAR_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["VR_NME"] = array("Name" => "VR_NME", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @65-B75B1419
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlSTV_id", ccsInteger, "", "", $this->Parameters["urlSTV_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "STV_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @65-10DDC59E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM ST_VARS {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @65-588D01A7
    function SetValues()
    {
        $this->ST_id->SetDBValue(trim($this->f("ST_id")));
        $this->VAR_id->SetDBValue(trim($this->f("VAR_id")));
        $this->VR_NME->SetDBValue($this->f("VR_NME"));
    }
//End SetValues Method

//Insert Method @65-741DB3DC
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ST_id"]["Value"] = $this->ST_id->GetDBValue(true);
        $this->InsertFields["VAR_id"]["Value"] = $this->VAR_id->GetDBValue(true);
        $this->InsertFields["VR_NME"]["Value"] = $this->VR_NME->GetDBValue(true);
        $this->SQL = CCBuildInsert("ST_VARS", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @65-8427EE4F
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ST_id"]["Value"] = $this->ST_id->GetDBValue(true);
        $this->UpdateFields["VAR_id"]["Value"] = $this->VAR_id->GetDBValue(true);
        $this->UpdateFields["VR_NME"]["Value"] = $this->VR_NME->GetDBValue(true);
        $this->SQL = CCBuildUpdate("ST_VARS", $this->UpdateFields, $this);
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

//Delete Method @65-0F3B7B3A
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM ST_VARS";
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

} //End ST_VARS1DataSource Class @65-FCB6E20C

class clsGridST_MEALS { //ST_MEALS class @77-176BD948

//Variables @77-1231194D

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
    public $Sorter_MLS_id;
    public $Sorter_ML_id;
    public $Sorter_ST_id;
    public $Sorter_ML_NME;
//End Variables

//Class_Initialize Event @77-58D81342
    function clsGridST_MEALS($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "ST_MEALS";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid ST_MEALS";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsST_MEALSDataSource($this);
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
        $this->SorterName = CCGetParam("ST_MEALSOrder", "");
        $this->SorterDirection = CCGetParam("ST_MEALSDir", "");

        $this->MLS_id = new clsControl(ccsLink, "MLS_id", "MLS_id", ccsInteger, "", CCGetRequestParam("MLS_id", ccsGet, NULL), $this);
        $this->MLS_id->Page = "Studies.php";
        $this->ML_id = new clsControl(ccsLabel, "ML_id", "ML_id", ccsInteger, "", CCGetRequestParam("ML_id", ccsGet, NULL), $this);
        $this->ST_id = new clsControl(ccsLabel, "ST_id", "ST_id", ccsInteger, "", CCGetRequestParam("ST_id", ccsGet, NULL), $this);
        $this->ML_NME = new clsControl(ccsLabel, "ML_NME", "ML_NME", ccsText, "", CCGetRequestParam("ML_NME", ccsGet, NULL), $this);
        $this->ST_MEALS_Insert = new clsControl(ccsLink, "ST_MEALS_Insert", "ST_MEALS_Insert", ccsText, "", CCGetRequestParam("ST_MEALS_Insert", ccsGet, NULL), $this);
        $this->ST_MEALS_Insert->Parameters = CCGetQueryString("QueryString", array("MLS_id", "ccsForm"));
        $this->ST_MEALS_Insert->Page = "Studies.php";
        $this->ST_MEALS_TotalRecords = new clsControl(ccsLabel, "ST_MEALS_TotalRecords", "ST_MEALS_TotalRecords", ccsText, "", CCGetRequestParam("ST_MEALS_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_MLS_id = new clsSorter($this->ComponentName, "Sorter_MLS_id", $FileName, $this);
        $this->Sorter_ML_id = new clsSorter($this->ComponentName, "Sorter_ML_id", $FileName, $this);
        $this->Sorter_ST_id = new clsSorter($this->ComponentName, "Sorter_ST_id", $FileName, $this);
        $this->Sorter_ML_NME = new clsSorter($this->ComponentName, "Sorter_ML_NME", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @77-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @77-288B13C1
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
            $this->ControlsVisible["MLS_id"] = $this->MLS_id->Visible;
            $this->ControlsVisible["ML_id"] = $this->ML_id->Visible;
            $this->ControlsVisible["ST_id"] = $this->ST_id->Visible;
            $this->ControlsVisible["ML_NME"] = $this->ML_NME->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->MLS_id->SetValue($this->DataSource->MLS_id->GetValue());
                $this->MLS_id->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->MLS_id->Parameters = CCAddParam($this->MLS_id->Parameters, "MLS_id", $this->DataSource->f("MLS_id"));
                $this->ML_id->SetValue($this->DataSource->ML_id->GetValue());
                $this->ST_id->SetValue($this->DataSource->ST_id->GetValue());
                $this->ML_NME->SetValue($this->DataSource->ML_NME->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->MLS_id->Show();
                $this->ML_id->Show();
                $this->ST_id->Show();
                $this->ML_NME->Show();
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
        $this->ST_MEALS_Insert->Show();
        $this->ST_MEALS_TotalRecords->Show();
        $this->Sorter_MLS_id->Show();
        $this->Sorter_ML_id->Show();
        $this->Sorter_ST_id->Show();
        $this->Sorter_ML_NME->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @77-EDE89FCE
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->MLS_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ML_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ST_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ML_NME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End ST_MEALS Class @77-FCB6E20C

class clsST_MEALSDataSource extends clsDBcandat {  //ST_MEALSDataSource Class @77-279B5180

//DataSource Variables @77-FAC54902
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $MLS_id;
    public $ML_id;
    public $ST_id;
    public $ML_NME;
//End DataSource Variables

//DataSourceClass_Initialize Event @77-986AE573
    function clsST_MEALSDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid ST_MEALS";
        $this->Initialize();
        $this->MLS_id = new clsField("MLS_id", ccsInteger, "");
        
        $this->ML_id = new clsField("ML_id", ccsInteger, "");
        
        $this->ST_id = new clsField("ST_id", ccsInteger, "");
        
        $this->ML_NME = new clsField("ML_NME", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @77-E472B881
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_MLS_id" => array("MLS_id", ""), 
            "Sorter_ML_id" => array("ML_id", ""), 
            "Sorter_ST_id" => array("ST_id", ""), 
            "Sorter_ML_NME" => array("ML_NME", "")));
    }
//End SetOrder Method

//Prepare Method @77-311B7A2D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlST_id", ccsInteger, "", "", $this->Parameters["urlST_id"], -999, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ST_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @77-E791D788
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ST_MEALS";
        $this->SQL = "SELECT MLS_id, ML_id, ST_id, ML_NME \n\n" .
        "FROM ST_MEALS {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @77-D29D8976
    function SetValues()
    {
        $this->MLS_id->SetDBValue(trim($this->f("MLS_id")));
        $this->ML_id->SetDBValue(trim($this->f("ML_id")));
        $this->ST_id->SetDBValue(trim($this->f("ST_id")));
        $this->ML_NME->SetDBValue($this->f("ML_NME"));
    }
//End SetValues Method

} //End ST_MEALSDataSource Class @77-FCB6E20C

class clsRecordST_MEALS1 { //ST_MEALS1 Class @96-D968307B

//Variables @96-9E315808

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

//Class_Initialize Event @96-49E8B3B3
    function clsRecordST_MEALS1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record ST_MEALS1/Error";
        $this->DataSource = new clsST_MEALS1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "ST_MEALS1";
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
            $this->ML_id = new clsControl(ccsTextBox, "ML_id", "ML Id", ccsInteger, "", CCGetRequestParam("ML_id", $Method, NULL), $this);
            $this->ML_id->Required = true;
            $this->ST_id = new clsControl(ccsTextBox, "ST_id", "ST Id", ccsInteger, "", CCGetRequestParam("ST_id", $Method, NULL), $this);
            $this->ST_id->Required = true;
            $this->ML_NME = new clsControl(ccsTextBox, "ML_NME", "ML NME", ccsText, "", CCGetRequestParam("ML_NME", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @96-7C363D50
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlMLS_id"] = CCGetFromGet("MLS_id", NULL);
    }
//End Initialize Method

//Validate Method @96-F9DA6AA9
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ML_id->Validate() && $Validation);
        $Validation = ($this->ST_id->Validate() && $Validation);
        $Validation = ($this->ML_NME->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ML_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ST_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ML_NME->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @96-DBCA74EA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ML_id->Errors->Count());
        $errors = ($errors || $this->ST_id->Errors->Count());
        $errors = ($errors || $this->ML_NME->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @96-ED598703
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

//Operation Method @96-288F0419
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

//InsertRow Method @96-91ED9D32
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ML_id->SetValue($this->ML_id->GetValue(true));
        $this->DataSource->ST_id->SetValue($this->ST_id->GetValue(true));
        $this->DataSource->ML_NME->SetValue($this->ML_NME->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @96-7AAC5D01
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ML_id->SetValue($this->ML_id->GetValue(true));
        $this->DataSource->ST_id->SetValue($this->ST_id->GetValue(true));
        $this->DataSource->ML_NME->SetValue($this->ML_NME->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @96-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @96-150FEE69
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
                    $this->ML_id->SetValue($this->DataSource->ML_id->GetValue());
                    $this->ST_id->SetValue($this->DataSource->ST_id->GetValue());
                    $this->ML_NME->SetValue($this->DataSource->ML_NME->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ML_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ST_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ML_NME->Errors->ToString());
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
        $this->ML_id->Show();
        $this->ST_id->Show();
        $this->ML_NME->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End ST_MEALS1 Class @96-FCB6E20C

class clsST_MEALS1DataSource extends clsDBcandat {  //ST_MEALS1DataSource Class @96-717FF7DC

//DataSource Variables @96-67174DEA
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
    public $ML_id;
    public $ST_id;
    public $ML_NME;
//End DataSource Variables

//DataSourceClass_Initialize Event @96-226AF727
    function clsST_MEALS1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record ST_MEALS1/Error";
        $this->Initialize();
        $this->ML_id = new clsField("ML_id", ccsInteger, "");
        
        $this->ST_id = new clsField("ST_id", ccsInteger, "");
        
        $this->ML_NME = new clsField("ML_NME", ccsText, "");
        

        $this->InsertFields["ML_id"] = array("Name" => "ML_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["ST_id"] = array("Name" => "ST_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["ML_NME"] = array("Name" => "ML_NME", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ML_id"] = array("Name" => "ML_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ST_id"] = array("Name" => "ST_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ML_NME"] = array("Name" => "ML_NME", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @96-295D1DAF
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlMLS_id", ccsInteger, "", "", $this->Parameters["urlMLS_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "MLS_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @96-5D02EDB6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM ST_MEALS {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @96-38BD4606
    function SetValues()
    {
        $this->ML_id->SetDBValue(trim($this->f("ML_id")));
        $this->ST_id->SetDBValue(trim($this->f("ST_id")));
        $this->ML_NME->SetDBValue($this->f("ML_NME"));
    }
//End SetValues Method

//Insert Method @96-89E055BB
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ML_id"]["Value"] = $this->ML_id->GetDBValue(true);
        $this->InsertFields["ST_id"]["Value"] = $this->ST_id->GetDBValue(true);
        $this->InsertFields["ML_NME"]["Value"] = $this->ML_NME->GetDBValue(true);
        $this->SQL = CCBuildInsert("ST_MEALS", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @96-71FA5E15
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ML_id"]["Value"] = $this->ML_id->GetDBValue(true);
        $this->UpdateFields["ST_id"]["Value"] = $this->ST_id->GetDBValue(true);
        $this->UpdateFields["ML_NME"]["Value"] = $this->ML_NME->GetDBValue(true);
        $this->SQL = CCBuildUpdate("ST_MEALS", $this->UpdateFields, $this);
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

//Delete Method @96-6B598322
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM ST_MEALS";
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

} //End ST_MEALS1DataSource Class @96-FCB6E20C

//Include Page implementation @111-F4A82EB7
include_once(RelativePath . "/ADMIN_DAYS.php");
//End Include Page implementation

//Initialize Page @1-203BAD7D
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
$TemplateFileName = "Studies.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2A6A6A71
include_once("./Studies_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E99453DC
$DBcandat = new clsDBcandat();
$MainPage->Connections["candat"] = & $DBcandat;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header_live = new clsHeader_live("", "Header_live", $MainPage);
$Header_live->Initialize();
$Footer = new clsFooter("", "Footer", $MainPage);
$Footer->Initialize();
$STUDIES2 = new clsGridSTUDIES2("", $MainPage);
$ADMIN_VARS = new clsADMIN_VARS("", "ADMIN_VARS", $MainPage);
$ADMIN_VARS->Initialize();
$ADMIN_MEALS = new clsADMIN_MEALS("", "ADMIN_MEALS", $MainPage);
$ADMIN_MEALS->Initialize();
$STUDIES1 = new clsRecordSTUDIES1("", $MainPage);
$ST_VARS = new clsGridST_VARS("", $MainPage);
$ST_VARS1 = new clsRecordST_VARS1("", $MainPage);
$ST_MEALS = new clsGridST_MEALS("", $MainPage);
$ST_MEALS1 = new clsRecordST_MEALS1("", $MainPage);
$ADMIN_DAYS = new clsADMIN_DAYS("", "ADMIN_DAYS", $MainPage);
$ADMIN_DAYS->Initialize();
$MainPage->Header_live = & $Header_live;
$MainPage->Footer = & $Footer;
$MainPage->STUDIES2 = & $STUDIES2;
$MainPage->ADMIN_VARS = & $ADMIN_VARS;
$MainPage->ADMIN_MEALS = & $ADMIN_MEALS;
$MainPage->STUDIES1 = & $STUDIES1;
$MainPage->ST_VARS = & $ST_VARS;
$MainPage->ST_VARS1 = & $ST_VARS1;
$MainPage->ST_MEALS = & $ST_MEALS;
$MainPage->ST_MEALS1 = & $ST_MEALS1;
$MainPage->ADMIN_DAYS = & $ADMIN_DAYS;
$STUDIES2->Initialize();
$STUDIES1->Initialize();
$ST_VARS->Initialize();
$ST_VARS1->Initialize();
$ST_MEALS->Initialize();
$ST_MEALS1->Initialize();

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

//Execute Components @1-2F3A5491
$Header_live->Operations();
$Footer->Operations();
$ADMIN_VARS->Operations();
$ADMIN_MEALS->Operations();
$STUDIES1->Operation();
$ST_VARS1->Operation();
$ST_MEALS1->Operation();
$ADMIN_DAYS->Operations();
//End Execute Components

//Go to destination page @1-E608AF96
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBcandat->close();
    header("Location: " . $Redirect);
    $Header_live->Class_Terminate();
    unset($Header_live);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($STUDIES2);
    $ADMIN_VARS->Class_Terminate();
    unset($ADMIN_VARS);
    $ADMIN_MEALS->Class_Terminate();
    unset($ADMIN_MEALS);
    unset($STUDIES1);
    unset($ST_VARS);
    unset($ST_VARS1);
    unset($ST_MEALS);
    unset($ST_MEALS1);
    $ADMIN_DAYS->Class_Terminate();
    unset($ADMIN_DAYS);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-5B51270C
$Header_live->Show();
$Footer->Show();
$STUDIES2->Show();
$ADMIN_VARS->Show();
$ADMIN_MEALS->Show();
$STUDIES1->Show();
$ST_VARS->Show();
$ST_VARS1->Show();
$ST_MEALS->Show();
$ST_MEALS1->Show();
$ADMIN_DAYS->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-0D80C9F4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBcandat->close();
$Header_live->Class_Terminate();
unset($Header_live);
$Footer->Class_Terminate();
unset($Footer);
unset($STUDIES2);
$ADMIN_VARS->Class_Terminate();
unset($ADMIN_VARS);
$ADMIN_MEALS->Class_Terminate();
unset($ADMIN_MEALS);
unset($STUDIES1);
unset($ST_VARS);
unset($ST_VARS1);
unset($ST_MEALS);
unset($ST_MEALS1);
$ADMIN_DAYS->Class_Terminate();
unset($ADMIN_DAYS);
unset($Tpl);
//End Unload Page


?>
