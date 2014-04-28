<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Manuscript" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<IncludePage id="24" name="Header_live" PathID="Header_live" page="Header_live.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="25" name="Footer" PathID="Footer" page="Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Grid id="28" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="candat" dataSource="STUDIES" name="STUDIES2" pageSizeLimit="100" wizardCaption="List of STUDIES " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records">
			<Components>
				<Link id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="STUDIES_Insert" hrefSource="Studies.ccp" removeParameters="ST_id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="STUDIES2STUDIES_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="30" visible="True" name="Sorter_ST_id" column="ST_id" wizardCaption="ST Id" wizardSortingType="SimpleDir" wizardControl="ST_id" wizardAddNbsp="False" PathID="STUDIES2Sorter_ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="31" visible="True" name="Sorter_short_desc" column="short_desc" wizardCaption="Short Desc" wizardSortingType="SimpleDir" wizardControl="short_desc" wizardAddNbsp="False" PathID="STUDIES2Sorter_short_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="32" visible="True" name="Sorter_long_desc" column="long_desc" wizardCaption="Long Desc" wizardSortingType="SimpleDir" wizardControl="long_desc" wizardAddNbsp="False" PathID="STUDIES2Sorter_long_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ST_id" fieldSource="ST_id" wizardCaption="ST Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="Studies.ccp" wizardThemeItem="GridA" PathID="STUDIES2ST_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="34" sourceType="DataField" format="yyyy-mm-dd" name="ST_id" source="ST_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" name="short_desc" fieldSource="short_desc" wizardCaption="Short Desc" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="STUDIES2short_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" name="long_desc" fieldSource="long_desc" wizardCaption="Long Desc" wizardSize="50" wizardMaxLength="120" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="STUDIES2long_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="37" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="True" wizardImagesScheme="Manuscript">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields>
				<Field id="38" tableName="STUDIES" fieldName="ST_id"/>
				<Field id="39" tableName="STUDIES" fieldName="short_desc"/>
				<Field id="40" tableName="STUDIES" fieldName="long_desc"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="26" name="ADMIN_VARS" PathID="ADMIN_VARS" page="ADMIN_VARS.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="27" name="ADMIN_MEALS" PathID="ADMIN_MEALS" page="ADMIN_MEALS.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="15" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="candat" name="STUDIES1" dataSource="STUDIES" errorSummator="Error" wizardCaption="Add/Edit STUDIES " wizardFormMethod="post" PathID="STUDIES1" returnPage="Studies.ccp">
			<Components>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="STUDIES1Button_Insert" removeParameters="ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="17" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="STUDIES1Button_Update" removeParameters="ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="18" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="STUDIES1Button_Delete" removeParameters="ST_id">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="19" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="20" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="STUDIES1Button_Cancel" removeParameters="ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="22" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="short_desc" fieldSource="short_desc" required="True" caption="Short Desc" wizardCaption="Short Desc" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="STUDIES1short_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="23" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="long_desc" fieldSource="long_desc" required="False" caption="Long Desc" wizardCaption="Long Desc" wizardSize="50" wizardMaxLength="120" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="STUDIES1long_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="43" fieldSourceType="DBColumn" dataType="Integer" name="ST_id" PathID="STUDIES1ST_id" fieldSource="ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Declare Variable" actionCategory="General" id="41" name="id" initialValue="mysql_insert_id()"/>
						<Action actionName="Custom Code" actionCategory="General" id="42"/>
					</Actions>
				</Event>
				<Event name="BeforeDelete" type="Server">
					<Actions>
						<Action actionName="Save Control Value" actionCategory="General" id="44" name="ST_id" sourceType="Variable" sourceName="id"/>
					</Actions>
				</Event>
				<Event name="AfterDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="45"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="ST_id" parameterSource="ST_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="46" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="100" connection="candat" dataSource="ST_VARS" name="ST_VARS" pageSizeLimit="100" wizardCaption="List of ST VARS " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" activeCollection="TableParameters">
			<Components>
				<Link id="48" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ST_VARS_Insert" hrefSource="Studies.ccp" removeParameters="STV_id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="ST_VARSST_VARS_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="49" fieldSourceType="DBColumn" dataType="Text" html="False" name="ST_VARS_TotalRecords" wizardUseTemplateBlock="False" PathID="ST_VARSST_VARS_TotalRecords">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="50"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="51" visible="True" name="Sorter_STV_id" column="STV_id" wizardCaption="STV Id" wizardSortingType="SimpleDir" wizardControl="STV_id" wizardAddNbsp="False" PathID="ST_VARSSorter_STV_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="52" visible="True" name="Sorter_ST_id" column="ST_id" wizardCaption="ST Id" wizardSortingType="SimpleDir" wizardControl="ST_id" wizardAddNbsp="False" PathID="ST_VARSSorter_ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="53" visible="True" name="Sorter_VAR_id" column="VAR_id" wizardCaption="VAR Id" wizardSortingType="SimpleDir" wizardControl="VAR_id" wizardAddNbsp="False" PathID="ST_VARSSorter_VAR_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="54" visible="True" name="Sorter_VR_NME" column="VR_NME" wizardCaption="VR NME" wizardSortingType="SimpleDir" wizardControl="VR_NME" wizardAddNbsp="False" PathID="ST_VARSSorter_VR_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="56" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="STV_id" fieldSource="STV_id" wizardCaption="STV Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="Studies.ccp" wizardThemeItem="GridA" PathID="ST_VARSSTV_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="57" sourceType="DataField" format="yyyy-mm-dd" name="STV_id" source="STV_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="59" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ST_id" fieldSource="ST_id" wizardCaption="ST Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="ST_VARSST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="61" fieldSourceType="DBColumn" dataType="Integer" html="False" name="VAR_id" fieldSource="VAR_id" wizardCaption="VAR Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="ST_VARSVAR_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="63" fieldSourceType="DBColumn" dataType="Text" html="False" name="VR_NME" fieldSource="VR_NME" wizardCaption="VR NME" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="ST_VARSVR_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="64" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="True" wizardImagesScheme="Manuscript">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="55" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="108" conditionType="Parameter" useIsNull="False" field="ST_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="-999" parameterSource="ST_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="75" tableName="ST_VARS" posLeft="10" posTop="10" posWidth="95" posHeight="120"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="47" tableName="ST_VARS" fieldName="STV_id"/>
				<Field id="58" tableName="ST_VARS" fieldName="ST_id"/>
				<Field id="60" tableName="ST_VARS" fieldName="VAR_id"/>
				<Field id="62" tableName="ST_VARS" fieldName="VR_NME"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="65" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="candat" name="ST_VARS1" dataSource="ST_VARS" errorSummator="Error" wizardCaption="Add/Edit ST VARS " wizardFormMethod="post" PathID="ST_VARS1">
			<Components>
				<Button id="66" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="ST_VARS1Button_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="67" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="ST_VARS1Button_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="68" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="ST_VARS1Button_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="69" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="70" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="ST_VARS1Button_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="72" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ST_id" fieldSource="ST_id" required="True" caption="ST Id" wizardCaption="ST Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="ST_VARS1ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="73" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="VAR_id" fieldSource="VAR_id" required="True" caption="VAR Id" wizardCaption="VAR Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="ST_VARS1VAR_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="74" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="VR_NME" fieldSource="VR_NME" required="True" caption="VR NME" wizardCaption="VR NME" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="ST_VARS1VR_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="71" conditionType="Parameter" useIsNull="False" field="STV_id" parameterSource="STV_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="77" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="candat" dataSource="ST_MEALS" name="ST_MEALS" pageSizeLimit="100" wizardCaption="List of ST MEALS " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" activeCollection="TableParameters">
			<Components>
				<Link id="79" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ST_MEALS_Insert" hrefSource="Studies.ccp" removeParameters="MLS_id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="ST_MEALSST_MEALS_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="80" fieldSourceType="DBColumn" dataType="Text" html="False" name="ST_MEALS_TotalRecords" wizardUseTemplateBlock="False" PathID="ST_MEALSST_MEALS_TotalRecords">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="81"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="82" visible="True" name="Sorter_MLS_id" column="MLS_id" wizardCaption="MLS Id" wizardSortingType="SimpleDir" wizardControl="MLS_id" wizardAddNbsp="False" PathID="ST_MEALSSorter_MLS_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="83" visible="True" name="Sorter_ML_id" column="ML_id" wizardCaption="ML Id" wizardSortingType="SimpleDir" wizardControl="ML_id" wizardAddNbsp="False" PathID="ST_MEALSSorter_ML_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="84" visible="True" name="Sorter_ST_id" column="ST_id" wizardCaption="ST Id" wizardSortingType="SimpleDir" wizardControl="ST_id" wizardAddNbsp="False" PathID="ST_MEALSSorter_ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="85" visible="True" name="Sorter_ML_NME" column="ML_NME" wizardCaption="ML NME" wizardSortingType="SimpleDir" wizardControl="ML_NME" wizardAddNbsp="False" PathID="ST_MEALSSorter_ML_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="87" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="MLS_id" fieldSource="MLS_id" wizardCaption="MLS Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="Studies.ccp" wizardThemeItem="GridA" PathID="ST_MEALSMLS_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="88" sourceType="DataField" format="yyyy-mm-dd" name="MLS_id" source="MLS_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="90" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ML_id" fieldSource="ML_id" wizardCaption="ML Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="ST_MEALSML_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="92" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ST_id" fieldSource="ST_id" wizardCaption="ST Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="ST_MEALSST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="94" fieldSourceType="DBColumn" dataType="Text" html="False" name="ML_NME" fieldSource="ML_NME" wizardCaption="ML NME" wizardSize="25" wizardMaxLength="25" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="ST_MEALSML_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="95" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="True" wizardImagesScheme="Manuscript">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="86" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="107" conditionType="Parameter" useIsNull="False" field="ST_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="-999" parameterSource="ST_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="106" tableName="ST_MEALS" posLeft="10" posTop="10" posWidth="95" posHeight="120"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="78" tableName="ST_MEALS" fieldName="MLS_id"/>
				<Field id="89" tableName="ST_MEALS" fieldName="ML_id"/>
				<Field id="91" tableName="ST_MEALS" fieldName="ST_id"/>
				<Field id="93" tableName="ST_MEALS" fieldName="ML_NME"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="96" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="candat" name="ST_MEALS1" dataSource="ST_MEALS" errorSummator="Error" wizardCaption="Add/Edit ST MEALS " wizardFormMethod="post" PathID="ST_MEALS1">
			<Components>
				<Button id="97" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="ST_MEALS1Button_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="98" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="ST_MEALS1Button_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="ST_MEALS1Button_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="100" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="101" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="ST_MEALS1Button_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="103" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ML_id" fieldSource="ML_id" required="True" caption="ML Id" wizardCaption="ML Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="ST_MEALS1ML_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="104" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ST_id" fieldSource="ST_id" required="True" caption="ST Id" wizardCaption="ST Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="ST_MEALS1ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="105" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ML_NME" fieldSource="ML_NME" required="False" caption="ML NME" wizardCaption="ML NME" wizardSize="25" wizardMaxLength="25" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="ST_MEALS1ML_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="102" conditionType="Parameter" useIsNull="False" field="MLS_id" parameterSource="MLS_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<IncludePage id="111" name="ADMIN_DAYS" PathID="ADMIN_DAYS" page="ADMIN_DAYS.ccp">
<Components/>
<Events/>
<Features/>
</IncludePage>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="Studies.php" forShow="True" url="Studies.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="Studies_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
