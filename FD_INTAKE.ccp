<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Manuscript" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="100" connection="candat" dataSource="INTAKE" name="INTAKE" pageSizeLimit="100" wizardCaption="List of INTAKE " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="INTAKE_Insert" hrefSource="FD_INTAKE.ccp" removeParameters="SF_id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="INTAKEINTAKE_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="8" fieldSourceType="DBColumn" dataType="Text" html="False" name="INTAKE_TotalRecords" wizardUseTemplateBlock="False" PathID="INTAKEINTAKE_TotalRecords">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="9"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="11" visible="True" name="Sorter_SF_id" column="SF_id" wizardCaption="SF Id" wizardSortingType="SimpleDir" wizardControl="SF_id" wizardAddNbsp="False" PathID="INTAKESorter_SF_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_ST_id" column="ST_id" wizardCaption="ST Id" wizardSortingType="SimpleDir" wizardControl="ST_id" wizardAddNbsp="False" PathID="INTAKESorter_ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_SB_id" column="SB_id" wizardCaption="SB Id" wizardSortingType="SimpleDir" wizardControl="SB_id" wizardAddNbsp="False" PathID="INTAKESorter_SB_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_DY_id" column="DY_id" wizardCaption="DY Id" wizardSortingType="SimpleDir" wizardControl="DY_id" wizardAddNbsp="False" PathID="INTAKESorter_DY_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="15" visible="True" name="Sorter_ML_id" column="ML_id" wizardCaption="ML Id" wizardSortingType="SimpleDir" wizardControl="ML_id" wizardAddNbsp="False" PathID="INTAKESorter_ML_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="16" visible="True" name="Sorter_FD_id" column="FD_id" wizardCaption="FD Id" wizardSortingType="SimpleDir" wizardControl="FD_id" wizardAddNbsp="False" PathID="INTAKESorter_FD_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="17" visible="True" name="Sorter_UN_id" column="UN_id" wizardCaption="UN Id" wizardSortingType="SimpleDir" wizardControl="UN_id" wizardAddNbsp="False" PathID="INTAKESorter_UN_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="18" visible="True" name="Sorter_QTY" column="QTY" wizardCaption="QTY" wizardSortingType="SimpleDir" wizardControl="QTY" wizardAddNbsp="False" PathID="INTAKESorter_QTY">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="20" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="SF_id" fieldSource="SF_id" wizardCaption="SF Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="FD_INTAKE.ccp" wizardThemeItem="GridA" PathID="INTAKESF_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="21" sourceType="DataField" format="yyyy-mm-dd" name="SF_id" source="SF_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="23" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ST_id" fieldSource="ST_id" wizardCaption="ST Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="INTAKEST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Integer" html="False" name="SB_id" fieldSource="SB_id" wizardCaption="SB Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="INTAKESB_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Date" html="False" name="DY_id" fieldSource="DY_id" wizardCaption="DY Id" wizardSize="19" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="INTAKEDY_id" format="yyyymmdd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ML_id" fieldSource="ML_id" wizardCaption="ML Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="INTAKEML_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="31" fieldSourceType="DBColumn" dataType="Integer" html="False" name="FD_id" fieldSource="FD_id" wizardCaption="FD Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="INTAKEFD_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Integer" html="False" name="UN_id" fieldSource="UN_id" wizardCaption="UN Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="INTAKEUN_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Integer" html="False" name="QTY" fieldSource="QTY" wizardCaption="QTY" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="INTAKEQTY">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="36" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="True" wizardImagesScheme="Manuscript">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="19" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="10" conditionType="Parameter" useIsNull="False" field="FD_id" parameterSource="s_FD_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="92" tableName="INTAKE" posLeft="10" posTop="10" posWidth="115" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="6" tableName="INTAKE" fieldName="SF_id"/>
				<Field id="22" tableName="INTAKE" fieldName="ST_id"/>
				<Field id="24" tableName="INTAKE" fieldName="SB_id"/>
				<Field id="26" tableName="INTAKE" fieldName="DY_id"/>
				<Field id="28" tableName="INTAKE" fieldName="ML_id"/>
				<Field id="30" tableName="INTAKE" fieldName="FD_id"/>
				<Field id="32" tableName="INTAKE" fieldName="UN_id"/>
				<Field id="34" tableName="INTAKE" fieldName="QTY"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="INTAKESearch" wizardCaption="Search INTAKE " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="FD_INTAKE.ccp" PathID="INTAKESearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="INTAKESearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_FD_id" wizardCaption="FD Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="INTAKESearchs_FD_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters/>
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
		<Record id="37" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="candat" name="INTAKE1" dataSource="INTAKE_DESC" errorSummator="Error" wizardCaption="Add/Edit INTAKE " wizardFormMethod="post" PathID="INTAKE1" customInsertType="Table" activeCollection="UFormElements" activeTableType="INTAKE" customInsert="INTAKE" customUpdateType="Table" customUpdate="INTAKE" customDeleteType="Table" customDelete="INTAKE">
			<Components>
				<Button id="38" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="INTAKE1Button_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="39" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="INTAKE1Button_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="40" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="INTAKE1Button_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="41" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="42" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="INTAKE1Button_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="44" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ST_id" fieldSource="ST_id" required="True" caption="ST Id" wizardCaption="ST Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="INTAKE1ST_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="45" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="SB_id" fieldSource="SB_id" required="True" caption="SB Id" wizardCaption="SB Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="INTAKE1SB_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="46" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="DY_id" fieldSource="DY_id" required="True" caption="DY Id" wizardCaption="DY Id" wizardSize="19" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="INTAKE1DY_id" defaultValue="CurrentDate" format="yyyymmdd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="47" name="DatePicker_DY_id" control="DY_id" wizardSatellite="True" wizardControl="DY_id" wizardDatePickerType="Image" wizardPicture="Styles/Manuscript/Images/DatePicker.gif" style="Styles/Manuscript/Style.css" PathID="INTAKE1DatePicker_DY_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="48" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="MLS_id" fieldSource="MLS_id" required="True" caption="ML Id" wizardCaption="ML Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="INTAKE1MLS_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="49" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="FD_id" fieldSource="FD_id" required="True" caption="FD Id" wizardCaption="FD Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="INTAKE1FD_id" format="0;(0)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="51" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="QTY" fieldSource="QTY" required="True" caption="QTY" wizardCaption="QTY" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="INTAKE1QTY">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="61" fieldSourceType="DBColumn" dataType="Text" html="False" name="Meal" PathID="INTAKE1Meal" fieldSource="ML_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="62" fieldSourceType="DBColumn" dataType="Text" html="False" name="FD_NME" PathID="INTAKE1FD_NME" fieldSource="FD_NME" visible="Yes" caption="Food">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="64" fieldSourceType="DBColumn" dataType="Text" html="False" name="Study" PathID="INTAKE1Study" fieldSource="short_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="50" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" returnValueType="Number" name="UN_id" caption="UN Id" fieldSource="UN_id" connection="candat" dataSource="FD_FACT" boundColumn="FCT_id" textColumn="FD_FACT_conv" required="True" PathID="INTAKE1UN_id" activeCollection="TableParameters">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="90"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="53" conditionType="Parameter" useIsNull="False" field="FD_CODE" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="FD_id"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="66" tableName="FD_FACT" posWidth="158" posHeight="191" posLeft="10" posTop="10"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="67" fieldName="concat(MSR_NME,' ',CONV_FAC)" alias="conv" isExpression="True"/>
						<Field id="68" tableName="FD_FACT" fieldName="MSR_NME"/>
						<Field id="69" tableName="FD_FACT" fieldName="FCT_id"/>
						<Field id="70" tableName="FD_FACT" fieldName="FD_ID"/>
						<Field id="71" tableName="FD_FACT" fieldName="CONV_FAC"/>
						<Field id="72" tableName="FD_FACT" fieldName="FD_CODE"/>
						<Field id="73" tableName="FD_FACT" fieldName="FD_NME"/>
						<Field id="74" tableName="FD_FACT" fieldName="conv" alias="FD_FACT_conv"/>
					</Fields>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="91" fieldSourceType="DBColumn" dataType="Single" html="False" name="Grams" PathID="INTAKE1Grams" visible="Yes" format="0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="93" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="Unit" PathID="INTAKE1Unit" format="0.0000" fieldSource="CONV_FAC">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
</Components>
			<Events>
			</Events>
			<TableParameters>
				<TableParameter id="43" conditionType="Parameter" useIsNull="False" field="SF_id" parameterSource="SF_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="76" tableName="INTAKE_DESC" posLeft="150" posTop="16" posWidth="223" posHeight="380"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="54" field="ST_id" dataType="Integer" parameterType="Control" parameterSource="ST_id" omitIfEmpty="True"/>
				<CustomParameter id="55" field="SB_id" dataType="Integer" parameterType="Control" parameterSource="SB_id" omitIfEmpty="True"/>
				<CustomParameter id="56" field="DY_id" dataType="Date" parameterType="Control" parameterSource="DY_id" omitIfEmpty="True"/>
				<CustomParameter id="57" field="ML_id" dataType="Integer" parameterType="Control" parameterSource="MLS_id" omitIfEmpty="True"/>
				<CustomParameter id="58" field="FD_id" dataType="Integer" parameterType="Control" parameterSource="FD_id" omitIfEmpty="True"/>
				<CustomParameter id="59" field="UN_id" dataType="Integer" parameterType="Control" parameterSource="UN_id" omitIfEmpty="True"/>
				<CustomParameter id="60" field="QTY" dataType="Integer" parameterType="Control" parameterSource="QTY" omitIfEmpty="True"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="77" conditionType="Parameter" useIsNull="False" field="SF_id" dataType="Integer" parameterType="URL" parameterSource="SF_id" searchConditionType="Equal" logicOperator="And" orderNumber="1"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="80" field="DY_id" dataType="Date" parameterType="Control" parameterSource="DY_id" format="yyyymmdd" omitIfEmpty="True"/>
				<CustomParameter id="82" field="FD_id" dataType="Integer" parameterType="Control" parameterSource="FD_id" omitIfEmpty="True"/>
				<CustomParameter id="83" field="UN_id" dataType="Integer" parameterType="Control" parameterSource="UN_id" omitIfEmpty="True"/>
				<CustomParameter id="84" field="QTY" dataType="Integer" parameterType="Control" parameterSource="QTY" omitIfEmpty="True"/>
				<CustomParameter id="86" field="ST_id" dataType="Integer" parameterType="Control" omitIfEmpty="True" parameterSource="ST_id"/>
				<CustomParameter id="87" field="SB_id" dataType="Integer" parameterType="Control" omitIfEmpty="True" parameterSource="SB_id"/>
				<CustomParameter id="88" field="ML_id" dataType="Integer" parameterType="Control" omitIfEmpty="True" parameterSource="MLS_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions>
				<TableParameter id="89" conditionType="Parameter" useIsNull="False" field="SF_id" dataType="Integer" parameterType="URL" parameterSource="SF_id" searchConditionType="Equal" logicOperator="And" orderNumber="1"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="FD_INTAKE_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="FD_INTAKE.php" forShow="True" url="FD_INTAKE.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
