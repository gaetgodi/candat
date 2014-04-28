<?php
//Include Common Files @1-1F88C160
define("RelativePath", "../../../../CodeChargeStudio4/Examples/CCSExamplePack2");
define("PathToCurrentPage", "../../../Program Files/CodeChargeStudio4/Projects/candat/");
define("FileName", "DependentListBox.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridstore_products1 { //store_products1 class @276-5A51F1DF

//Variables @276-AC1EDBB9

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
//End Variables

//Class_Initialize Event @276-09C2D51F
    function clsGridstore_products1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "store_products1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid store_products1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsstore_products1DataSource($this);
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

        $this->product_id = & new clsControl(ccsLabel, "product_id", "product_id", ccsInteger, "", CCGetRequestParam("product_id", ccsGet, NULL), $this);
        $this->category_id = & new clsControl(ccsLabel, "category_id", "category_id", ccsInteger, "", CCGetRequestParam("category_id", ccsGet, NULL), $this);
        $this->product_name = & new clsControl(ccsLabel, "product_name", "product_name", ccsText, "", CCGetRequestParam("product_name", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @276-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @276-412BF78B
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
            $this->ControlsVisible["product_id"] = $this->product_id->Visible;
            $this->ControlsVisible["category_id"] = $this->category_id->Visible;
            $this->ControlsVisible["product_name"] = $this->product_name->Visible;
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
                $this->product_id->SetValue($this->DataSource->product_id->GetValue());
                $this->category_id->SetValue($this->DataSource->category_id->GetValue());
                $this->product_name->SetValue($this->DataSource->product_name->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->product_id->Show();
                $this->category_id->Show();
                $this->product_name->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
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

//GetErrors Method @276-67E238D0
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->product_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->category_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->product_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End store_products1 Class @276-FCB6E20C

class clsstore_products1DataSource extends clsDBInternetDB {  //store_products1DataSource Class @276-B6FB6D05

//DataSource Variables @276-54A3D596
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $product_id;
    var $category_id;
    var $product_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @276-C1308930
    function clsstore_products1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid store_products1";
        $this->Initialize();
        $this->product_id = new clsField("product_id", ccsInteger, "");
        
        $this->category_id = new clsField("category_id", ccsInteger, "");
        
        $this->product_name = new clsField("product_name", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @276-ADB6DCD8
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "product_name";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @276-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @276-3FA74D64
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM store_products";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} * \n\n" .
        "FROM store_products {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @276-1F7D56C3
    function SetValues()
    {
        $this->product_id->SetDBValue(trim($this->f("product_id")));
        $this->category_id->SetDBValue(trim($this->f("category_id")));
        $this->product_name->SetDBValue($this->f("product_name"));
    }
//End SetValues Method

} //End store_products1DataSource Class @276-FCB6E20C

//Include Page implementation @280-076323D4
include_once(RelativePath . "/../../../Program Files/CodeChargeStudio4/Projects/Header.php");
//End Include Page implementation

class clsRecordstore_productsSearch { //store_productsSearch Class @259-941ED05E

//Variables @259-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @259-4781BB77
    function clsRecordstore_productsSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record store_productsSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "store_productsSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_category_id = & new clsControl(ccsListBox, "s_category_id", "s_category_id", ccsInteger, "", CCGetRequestParam("s_category_id", $Method, NULL), $this);
            $this->s_category_id->DSType = dsTable;
            $this->s_category_id->DataSource = new clsDBInternetDB();
            $this->s_category_id->ds = & $this->s_category_id->DataSource;
            $this->s_category_id->DataSource->SQL = "SELECT * \n" .
"FROM store_categories {SQL_Where} {SQL_OrderBy}";
            $this->s_category_id->DataSource->Order = "category_name";
            list($this->s_category_id->BoundColumn, $this->s_category_id->TextColumn, $this->s_category_id->DBFormat) = array("category_id", "category_name", "");
            $this->s_category_id->DataSource->Order = "category_name";
            $this->s_product_id = & new clsControl(ccsListBox, "s_product_id", "s_product_id", ccsInteger, "", CCGetRequestParam("s_product_id", $Method, NULL), $this);
            $this->s_product_id->DSType = dsTable;
            $this->s_product_id->DataSource = new clsDBInternetDB();
            $this->s_product_id->ds = & $this->s_product_id->DataSource;
            $this->s_product_id->DataSource->SQL = "SELECT * \n" .
"FROM store_products {SQL_Where} {SQL_OrderBy}";
            $this->s_product_id->DataSource->Order = "product_name";
            list($this->s_product_id->BoundColumn, $this->s_product_id->TextColumn, $this->s_product_id->DBFormat) = array("product_id", "product_name", "");
            $this->s_product_id->DataSource->Parameters["urls_category_id"] = CCGetFromGet("s_category_id", NULL);
            $this->s_product_id->DataSource->wp = new clsSQLParameters();
            $this->s_product_id->DataSource->wp->AddParameter("1", "urls_category_id", ccsInteger, "", "", $this->s_product_id->DataSource->Parameters["urls_category_id"], "", false);
            $this->s_product_id->DataSource->wp->Criterion[1] = $this->s_product_id->DataSource->wp->Operation(opEqual, "category_id", $this->s_product_id->DataSource->wp->GetDBValue("1"), $this->s_product_id->DataSource->ToSQL($this->s_product_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->s_product_id->DataSource->Where = 
                 $this->s_product_id->DataSource->wp->Criterion[1];
            $this->s_product_id->DataSource->Order = "product_name";
        }
    }
//End Class_Initialize Event

//Validate Method @259-4E5CBD39
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_category_id->Validate() && $Validation);
        $Validation = ($this->s_product_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_category_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_product_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @259-B68B7150
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_category_id->Errors->Count());
        $errors = ($errors || $this->s_product_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @259-ED598703
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

//Operation Method @259-CC3A3305
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        $Redirect = "DependentListBox.php";
    }
//End Operation Method

//Show Method @259-6CA4C27D
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

        $this->s_category_id->Prepare();
        $this->s_product_id->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_category_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_product_id->Errors->ToString());
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

        $this->s_category_id->Show();
        $this->s_product_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End store_productsSearch Class @259-FCB6E20C

class clsGridstore_products { //store_products class @258-CD4D1C2D

//Variables @258-AC1EDBB9

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
//End Variables

//Class_Initialize Event @258-C2F0D2B8
    function clsGridstore_products($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "store_products";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid store_products";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsstore_productsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 1;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->product_name = & new clsControl(ccsLabel, "product_name", "product_name", ccsText, "", CCGetRequestParam("product_name", ccsGet, NULL), $this);
        $this->price = & new clsControl(ccsLabel, "price", "price", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("price", ccsGet, NULL), $this);
        $this->image_url = & new clsControl(ccsImage, "image_url", "image_url", ccsText, "", CCGetRequestParam("image_url", ccsGet, NULL), $this);
        $this->description1 = & new clsControl(ccsLabel, "description1", "description1", ccsMemo, "", CCGetRequestParam("description1", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @258-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @258-2941E2B6
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_category_id"] = CCGetFromGet("s_category_id", NULL);
        $this->DataSource->Parameters["urls_product_id"] = CCGetFromGet("s_product_id", NULL);

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
            $this->ControlsVisible["product_name"] = $this->product_name->Visible;
            $this->ControlsVisible["price"] = $this->price->Visible;
            $this->ControlsVisible["image_url"] = $this->image_url->Visible;
            $this->ControlsVisible["description1"] = $this->description1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->product_name->SetValue($this->DataSource->product_name->GetValue());
                $this->price->SetValue($this->DataSource->price->GetValue());
                $this->image_url->SetValue($this->DataSource->image_url->GetValue());
                $this->description1->SetValue($this->DataSource->description1->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->product_name->Show();
                $this->price->Show();
                $this->image_url->Show();
                $this->description1->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
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

//GetErrors Method @258-31838E25
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->product_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->price->Errors->ToString());
        $errors = ComposeStrings($errors, $this->image_url->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End store_products Class @258-FCB6E20C

class clsstore_productsDataSource extends clsDBInternetDB {  //store_productsDataSource Class @258-B5C31F8A

//DataSource Variables @258-5D2AFE04
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $product_name;
    var $price;
    var $image_url;
    var $description1;
//End DataSource Variables

//DataSourceClass_Initialize Event @258-8B81F7A0
    function clsstore_productsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid store_products";
        $this->Initialize();
        $this->product_name = new clsField("product_name", ccsText, "");
        
        $this->price = new clsField("price", ccsFloat, "");
        
        $this->image_url = new clsField("image_url", ccsText, "");
        
        $this->description1 = new clsField("description1", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @258-FABB2E4B
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "product_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @258-8D8FEA70
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_category_id", ccsInteger, "", "", $this->Parameters["urls_category_id"], "", false);
        $this->wp->AddParameter("2", "urls_product_id", ccsInteger, "", "", $this->Parameters["urls_product_id"], -1, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "category_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "product_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @258-3FA74D64
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM store_products";
        $this->SQL = "SELECT TOP {SqlParam_endRecord} * \n\n" .
        "FROM store_products {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @258-F847E5AF
    function SetValues()
    {
        $this->product_name->SetDBValue($this->f("product_name"));
        $this->price->SetDBValue(trim($this->f("price")));
        $this->image_url->SetDBValue($this->f("image_url"));
        $this->description1->SetDBValue($this->f("description"));
    }
//End SetValues Method

} //End store_productsDataSource Class @258-FCB6E20C

//Include Page implementation @281-626A6DEB
include_once(RelativePath . "/../../../Program Files/CodeChargeStudio4/Projects/Footer.php");
//End Include Page implementation

//Initialize Page @1-D1687846
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
$TemplateFileName = "DependentListBox.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../../../../CodeChargeStudio4/Examples/CCSExamplePack2/";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D8F10708
$DBInternetDB = new clsDBInternetDB();
$MainPage->Connections["InternetDB"] = & $DBInternetDB;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$store_products1 = & new clsGridstore_products1("", $MainPage);
$Header = & new clsHeader("../", "Header", $MainPage);
$Header->Initialize();
$Link1 = & new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $MainPage);
$Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$Link1->Page = "DependentListBox_desc.php";
$store_productsSearch = & new clsRecordstore_productsSearch("", $MainPage);
$store_products = & new clsGridstore_products("", $MainPage);
$Footer = & new clsFooter("../", "Footer", $MainPage);
$Footer->Initialize();
$MainPage->store_products1 = & $store_products1;
$MainPage->Header = & $Header;
$MainPage->Link1 = & $Link1;
$MainPage->store_productsSearch = & $store_productsSearch;
$MainPage->store_products = & $store_products;
$MainPage->Footer = & $Footer;
$store_products1->Initialize();
$store_products->Initialize();

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

//Execute Components @1-8BD2D826
$Header->Operations();
$store_productsSearch->Operation();
$Footer->Operations();
//End Execute Components

//Go to destination page @1-D898F84D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBInternetDB->close();
    header("Location: " . $Redirect);
    unset($store_products1);
    $Header->Class_Terminate();
    unset($Header);
    unset($store_productsSearch);
    unset($store_products);
    $Footer->Class_Terminate();
    unset($Footer);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-FF41FC6E
$store_products1->Show();
$Header->Show();
$store_productsSearch->Show();
$store_products->Show();
$Footer->Show();
$Link1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1F449B10
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBInternetDB->close();
unset($store_products1);
$Header->Class_Terminate();
unset($Header);
unset($store_productsSearch);
unset($store_products);
$Footer->Class_Terminate();
unset($Footer);
unset($Tpl);
//End Unload Page


?>
