<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Manuscript" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<IncludePage id="62" name="Header_live" PathID="Header_live" page="Header_live.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Grid id="63" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="candat" dataSource="STUDIES" name="STUDIES" pageSizeLimit="100" wizardCaption="List of STUDIES " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Link id="65" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Absolute" preserveParameters="GET" name="long_desc" fieldSource="long_desc" wizardCaption="Long Desc" wizardSize="50" wizardMaxLength="120" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" hrefSource="Subjects.ccp" wizardThemeItem="GridA" PathID="STUDIESlong_desc">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="66" sourceType="DataField" format="yyyy-mm-dd" name="ST_id" source="ST_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="86" conditionType="Parameter" useIsNull="False" field="ST_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="ST_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="84" tableName="STUDIES" posLeft="10" posTop="10" posWidth="95" posHeight="104"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="85" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="150" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="100" connection="candat" dataSource="SUBJECTS, STUDIES" name="SUBJECTS" pageSizeLimit="100" wizardCaption="List of SUBJECTS " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" activeCollection="TableParameters">
			<Components>
				<Link id="152" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="SUBJECTS_Insert" hrefSource="Subjects.ccp" removeParameters="SB_id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="SUBJECTSSUBJECTS_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="153" visible="True" name="Sorter_SB_id" column="SB_id" wizardCaption="SB Id" wizardSortingType="SimpleDir" wizardControl="SB_id" wizardAddNbsp="False" PathID="SUBJECTSSorter_SB_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="154" visible="True" name="Sorter_ST_id" column="ST_id" wizardCaption="ST Id" wizardSortingType="SimpleDir" wizardControl="ST_id" wizardAddNbsp="False" PathID="SUBJECTSSorter_ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="155" visible="True" name="Sorter_SB_CODE" column="SB_CODE" wizardCaption="SB CODE" wizardSortingType="SimpleDir" wizardControl="SB_CODE" wizardAddNbsp="False" PathID="SUBJECTSSorter_SB_CODE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="156" visible="True" name="Sorter_SB_short_desc" column="SB_short_desc" wizardCaption="SB Short Desc" wizardSortingType="SimpleDir" wizardControl="SB_short_desc" wizardAddNbsp="False" PathID="SUBJECTSSorter_SB_short_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="157" visible="True" name="Sorter_SB_long_desc" column="SB_long_desc" wizardCaption="SB Long Desc" wizardSortingType="SimpleDir" wizardControl="SB_long_desc" wizardAddNbsp="False" PathID="SUBJECTSSorter_SB_long_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="158" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="SB_id" fieldSource="SB_id" wizardCaption="SB Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="Subjects.ccp" wizardThemeItem="GridA" PathID="SUBJECTSSB_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="159" sourceType="DataField" format="yyyy-mm-dd" name="SB_id" source="SB_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="161" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ST_id" fieldSource="ST_id" wizardCaption="ST Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="SUBJECTSST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="163" fieldSourceType="DBColumn" dataType="Text" html="False" name="SB_CODE" fieldSource="SB_CODE" wizardCaption="SB CODE" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="SUBJECTSSB_CODE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="165" fieldSourceType="DBColumn" dataType="Text" html="False" name="SB_short_desc" fieldSource="SB_short_desc" wizardCaption="SB Short Desc" wizardSize="40" wizardMaxLength="40" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="SUBJECTSSB_short_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="167" fieldSourceType="DBColumn" dataType="Text" html="False" name="SB_long_desc" fieldSource="SB_long_desc" wizardCaption="SB Long Desc" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="SUBJECTSSB_long_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="168" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="True" wizardImagesScheme="Manuscript">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="188" conditionType="Parameter" useIsNull="False" field="SUBJECTS.ST_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="-999" parameterSource="ST_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="181" tableName="SUBJECTS" posLeft="211" posTop="34" posWidth="99" posHeight="136"/>
				<JoinTable id="182" tableName="STUDIES" posLeft="21" posTop="10" posWidth="95" posHeight="104"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="183" tableLeft="SUBJECTS" tableRight="STUDIES" fieldLeft="SUBJECTS.ST_id" fieldRight="STUDIES.ST_id" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="187" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="169" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="candat" name="SUBJECTS1" dataSource="SUBJECTS" errorSummator="Error" wizardCaption="Add/Edit SUBJECTS " wizardFormMethod="post" PathID="SUBJECTS1" returnPage="Subjects.ccp" pasteActions="pasteActions">
			<Components>
				<Button id="170" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="SUBJECTS1Button_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="171" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="SUBJECTS1Button_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="172" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="SUBJECTS1Button_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="173" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="174" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="SUBJECTS1Button_Cancel" removeParameters="SB_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="176" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ST_id" fieldSource="ST_id" required="True" caption="ST Id" wizardCaption="ST Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SUBJECTS1ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="177" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SB_CODE" fieldSource="SB_CODE" required="False" caption="SB CODE" wizardCaption="SB CODE" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SUBJECTS1SB_CODE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="178" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SB_short_desc" fieldSource="SB_short_desc" required="False" caption="SB Short Desc" wizardCaption="SB Short Desc" wizardSize="40" wizardMaxLength="40" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SUBJECTS1SB_short_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="179" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SB_long_desc" fieldSource="SB_long_desc" required="False" caption="SB Long Desc" wizardCaption="SB Long Desc" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SUBJECTS1SB_long_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="180" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel1" operation="Cancel" wizardCaption="Cancel" PathID="SUBJECTS1Button_Cancel1" removeParameters="SB_id;ST_id;SBD_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Declare Variable" actionCategory="General" id="243" name="id" initialValue="mysql_insert_id()"/>
						<Action actionName="Custom Code" actionCategory="General" id="244"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="175" conditionType="Parameter" useIsNull="False" field="SB_id" parameterSource="SB_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<EditableGrid id="189" urlType="Relative" secured="False" emptyRows="3" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="100" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="candat" dataSource="SB_VARIABLES" name="SB_VARIABLES" pageSizeLimit="100" wizardCaption="List of SB VARIABLES " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="True" wizardNoRecords="No records" PathID="SB_VARIABLES" deleteControl="CheckBox_Delete" activeCollection="IFormElements" customInsertType="Table" activeTableType="SB_VARIABLES" customInsert="SB_VARIABLES">
			<Components>
				<Label id="191" fieldSourceType="DBColumn" dataType="Text" html="False" name="SB_VARIABLES_TotalRecords" wizardUseTemplateBlock="False" PathID="SB_VARIABLESSB_VARIABLES_TotalRecords">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="192"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="193" visible="True" name="Sorter_SBV_id" column="SBV_id" wizardCaption="SBV Id" wizardSortingType="SimpleDir" wizardControl="SBV_id" PathID="SB_VARIABLESSorter_SBV_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="195" visible="True" name="Sorter_SB_id" column="SB_id" wizardCaption="SB Id" wizardSortingType="SimpleDir" wizardControl="SB_id" PathID="SB_VARIABLESSorter_SB_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="196" visible="True" name="Sorter_VAR_id" column="VAR_id" wizardCaption="VAR Id" wizardSortingType="SimpleDir" wizardControl="VAR_id" PathID="SB_VARIABLESSorter_VAR_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="197" visible="True" name="Sorter_SB_VALUE" column="SB_VALUE" wizardCaption="SB VALUE" wizardSortingType="SimpleDir" wizardControl="SB_VALUE" PathID="SB_VARIABLESSorter_SB_VALUE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="198" fieldSourceType="DBColumn" dataType="Integer" html="False" name="SBV_id" fieldSource="SBV_id" required="False" caption="SBV Id" wizardCaption="SBV Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="SB_VARIABLESSBV_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="200" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="SB_id" fieldSource="SB_id" required="False" caption="SB Id" wizardCaption="SB Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SB_VARIABLESSB_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="201" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="VAR_id" fieldSource="VAR_id" required="False" caption="VAR Id" wizardCaption="VAR Id" wizardSize="4" wizardMaxLength="4" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SB_VARIABLESVAR_id" sourceType="Table" connection="candat" dataSource="ST_VARS" boundColumn="VAR_id" textColumn="VR_NME" activeCollection="TableParameters">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="242" conditionType="Parameter" useIsNull="False" field="ST_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="ST_id"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="241" tableName="ST_VARS" posLeft="10" posTop="10" posWidth="95" posHeight="120"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="202" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="SB_VALUE" fieldSource="SB_VALUE" required="False" caption="SB VALUE" wizardCaption="SB VALUE" wizardSize="25" wizardMaxLength="25" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SB_VARIABLESSB_VALUE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Panel id="203" visible="True" name="CheckBox_Delete_Panel">
					<Components>
						<CheckBox id="204" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Delete" wizardAddNbsp="True" PathID="SB_VARIABLESCheckBox_Delete_PanelCheckBox_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</CheckBox>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<Navigator id="205" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardPageSize="True" wizardImagesScheme="Manuscript">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="206" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" PathID="SB_VARIABLESButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="207" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancel" PathID="SB_VARIABLESCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="210" conditionType="Parameter" useIsNull="False" field="SB_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="-999" parameterSource="SB_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="208" tableName="SB_VARIABLES" posLeft="10" posTop="10" posWidth="95" posHeight="136"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="190" tableName="SB_VARIABLES" fieldName="SBV_id" dataType="Integer"/>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="212" field="SB_id" dataType="Integer" parameterType="URL" parameterSource="SB_id" omitIfEmpty="True"/>
				<CustomParameter id="213" field="VAR_id" dataType="Integer" parameterType="Control" parameterSource="VAR_id"/>
				<CustomParameter id="214" field="SB_VALUE" dataType="Text" parameterType="Control" parameterSource="SB_VALUE"/>
			</IFormElements>
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
		</EditableGrid>
		<Grid id="245" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="candat" dataSource="SB_DAYS" name="SB_DAYS" pageSizeLimit="100" wizardCaption="List of SB DAYS " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" activeCollection="TableParameters">
			<Components>
				<Link id="247" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="SB_DAYS_Insert" hrefSource="Subjects.ccp" removeParameters="SBD_id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="SB_DAYSSB_DAYS_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="248" visible="True" name="Sorter_SBD_id" column="SBD_id" wizardCaption="SBD Id" wizardSortingType="SimpleDir" wizardControl="SBD_id" wizardAddNbsp="False" PathID="SB_DAYSSorter_SBD_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="249" visible="True" name="Sorter_SB_id" column="SB_id" wizardCaption="SB Id" wizardSortingType="SimpleDir" wizardControl="SB_id" wizardAddNbsp="False" PathID="SB_DAYSSorter_SB_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="250" visible="True" name="Sorter_DY_id" column="DY_id" wizardCaption="DY Id" wizardSortingType="SimpleDir" wizardControl="DY_id" wizardAddNbsp="False" PathID="SB_DAYSSorter_DY_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="251" visible="True" name="Sorter_DY_NME" column="DY_NME" wizardCaption="DY NME" wizardSortingType="SimpleDir" wizardControl="DY_NME" wizardAddNbsp="False" PathID="SB_DAYSSorter_DY_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="252" visible="True" name="Sorter_DY_DATE" column="DY_DATE" wizardCaption="DY DATE" wizardSortingType="SimpleDir" wizardControl="DY_DATE" wizardAddNbsp="False" PathID="SB_DAYSSorter_DY_DATE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="253" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="SBD_id" fieldSource="SBD_id" wizardCaption="SBD Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="Subjects.ccp" wizardThemeItem="GridA" PathID="SB_DAYSSBD_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="254" sourceType="DataField" format="yyyy-mm-dd" name="SBD_id" source="SBD_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="256" fieldSourceType="DBColumn" dataType="Integer" html="False" name="SB_id" fieldSource="SB_id" wizardCaption="SB Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="SB_DAYSSB_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="258" fieldSourceType="DBColumn" dataType="Integer" html="False" name="DY_id" fieldSource="DY_id" wizardCaption="DY Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="SB_DAYSDY_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="260" fieldSourceType="DBColumn" dataType="Text" html="False" name="DY_NME" fieldSource="DY_NME" wizardCaption="DY NME" wizardSize="25" wizardMaxLength="25" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="SB_DAYSDY_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="262" fieldSourceType="DBColumn" dataType="Date" html="False" name="DY_DATE" fieldSource="DY_DATE" wizardCaption="DY DATE" wizardSize="19" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="SB_DAYSDY_DATE" format="yyyy-mm-dd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="263" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="True" wizardImagesScheme="Manuscript">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="280" conditionType="Parameter" useIsNull="False" field="SB_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="-999" parameterSource="SB_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="279" tableName="SB_DAYS" posLeft="10" posTop="10" posWidth="95" posHeight="136"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="246" tableName="SB_DAYS" fieldName="SBD_id"/>
				<Field id="255" tableName="SB_DAYS" fieldName="SB_id"/>
				<Field id="257" tableName="SB_DAYS" fieldName="DY_id"/>
				<Field id="259" tableName="SB_DAYS" fieldName="DY_NME"/>
				<Field id="261" tableName="SB_DAYS" fieldName="DY_DATE"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="264" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="candat" name="SB_DAYS1" dataSource="SB_DAYS" errorSummator="Error" wizardCaption="Add/Edit SB DAYS " wizardFormMethod="post" PathID="SB_DAYS1" customInsertType="Table" activeCollection="IFormElements" activeTableType="SB_DAYS" customInsert="SB_DAYS" removeParameters="SBD_id">
			<Components>
				<Button id="265" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="SB_DAYS1Button_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="266" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="SB_DAYS1Button_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="267" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="268" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="SB_DAYS1Button_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="270" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="SB_id" fieldSource="SB_id" required="True" caption="SB Id" wizardCaption="SB Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SB_DAYS1SB_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="271" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="DY_id" fieldSource="DY_id" required="True" caption="DY Id" wizardCaption="DY Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SB_DAYS1DY_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="272" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="DY_NME" fieldSource="DY_NME" required="True" caption="DY NME" wizardCaption="DY NME" wizardSize="25" wizardMaxLength="25" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SB_DAYS1DY_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="273" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="DY_DATE" fieldSource="DY_DATE" required="True" caption="DY DATE" wizardCaption="DY DATE" wizardSize="19" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="SB_DAYS1DY_DATE" format="yyyymmdd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="274" name="DatePicker_DY_DATE" control="DY_DATE" wizardSatellite="True" wizardControl="DY_DATE" wizardDatePickerType="Image" wizardPicture="Styles/Manuscript/Images/DatePicker.gif" style="Styles/Manuscript/Style.css" PathID="SB_DAYS1DatePicker_DY_DATE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Button id="281" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="SB_DAYS1Button_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="269" conditionType="Parameter" useIsNull="False" field="SBD_id" parameterSource="SBD_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="275" field="SB_id" dataType="Integer" parameterType="URL" parameterSource="SB_id" omitIfEmpty="True"/>
				<CustomParameter id="276" field="DY_id" dataType="Integer" parameterType="Control" parameterSource="DY_id" omitIfEmpty="True"/>
				<CustomParameter id="277" field="DY_NME" dataType="Text" parameterType="Control" parameterSource="DY_NME" omitIfEmpty="True"/>
				<CustomParameter id="278" field="DY_DATE" dataType="Date" parameterType="Control" parameterSource="DY_DATE" format="yyyymmdd" omitIfEmpty="True"/>
			</IFormElements>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="Subjects.php" forShow="True" url="Subjects.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="Subjects_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
