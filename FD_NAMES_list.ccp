<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Manuscript" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="FD_NAMESSearch" wizardCaption="Search FD NAMES " wizardOrientation="Vertical" wizardFormMethod="post" PathID="FD_NAMESSearch">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="FD_NAMESSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="50" wizardMaxLength="123" wizardIsPassword="False" PathID="FD_NAMESSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="25" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="searchConditions" wizardEmptyCaption="Select Value" PathID="FD_NAMESSearchsearchConditions" dataSource="1;Any of words;2;All words;3;Exact Phrase;4;All words in either field">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="29" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="SB_id" wizardEmptyCaption="Select Value" PathID="FD_NAMESSearchSB_id" connection="candat" dataSource="SUBJECTS" boundColumn="SB_id" textColumn="SB_CODE" activeCollection="TableParameters">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="33" conditionType="Parameter" useIsNull="False" field="ST_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="ST_id"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="30" tableName="SUBJECTS" posLeft="10" posTop="10" posWidth="99" posHeight="136"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="31" tableName="SUBJECTS" fieldName="SB_CODE"/>
						<Field id="32" tableName="SUBJECTS" fieldName="ST_id"/>
						<Field id="42" tableName="SUBJECTS" fieldName="SB_id"/>
					</Fields>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="34" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="MLS_id" wizardEmptyCaption="Select Value" PathID="FD_NAMESSearchMLS_id" connection="candat" dataSource="ST_MEALS" boundColumn="MLS_id" textColumn="ML_NME" activeCollection="TableParameters">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="39" conditionType="Parameter" useIsNull="False" field="ST_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="ST_id"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="35" tableName="ST_MEALS" posLeft="10" posTop="10" posWidth="95" posHeight="120"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="36" tableName="ST_MEALS" fieldName="MLS_id"/>
						<Field id="37" tableName="ST_MEALS" fieldName="ML_id"/>
						<Field id="38" tableName="ST_MEALS" fieldName="ML_NME"/>
					</Fields>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="DY_id" PathID="FD_NAMESSearchDY_id" sourceType="Table" connection="candat" dataSource="SB_DAYS" boundColumn="DY_id" textColumn="DY_DATE">
<Components/>
<Events/>
<Attributes/>
<Features/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
</ListBox>
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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="FD_NAMES" connection="candat" pageSizeLimit="100" wizardCaption="List of FD NAMES " wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="FD_NAMES">
			<Components>
				<Sorter id="9" visible="True" name="Sorter_FD_CODE" column="FD_CODE" wizardCaption="FD CODE" wizardSortingType="SimpleDir" wizardControl="FD_CODE" wizardAddNbsp="False" PathID="FD_NAMESSorter_FD_CODE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="10" visible="True" name="Sorter_FD_GRP_ID" column="FD_GRP_ID" wizardCaption="FD GRP ID" wizardSortingType="SimpleDir" wizardControl="FD_GRP_ID" wizardAddNbsp="False" PathID="FD_NAMESSorter_FD_GRP_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="11" visible="True" name="Sorter_FD_NME" column="FD_NME" wizardCaption="FD NME" wizardSortingType="SimpleDir" wizardControl="FD_NME" wizardAddNbsp="False" PathID="FD_NAMESSorter_FD_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="12" visible="True" name="Sorter_FD_NMF" column="FD_NMF" wizardCaption="FD NMF" wizardSortingType="SimpleDir" wizardControl="FD_NMF" wizardAddNbsp="False" PathID="FD_NAMESSorter_FD_NMF">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="14" fieldSourceType="DBColumn" dataType="Integer" html="False" name="FD_CODE" fieldSource="FD_CODE" wizardCaption="FD CODE" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="FD_NAMESFD_CODE" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="FD_INTAKE.ccp" wizardUseTemplateBlock="False" removeParameters="s_keyword;searchConditions">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="27" sourceType="DataField" format="yyyy-mm-dd" name="FD_id" source="FD_CODE"/>
					</LinkParameters>
				</Link>
				<Label id="16" fieldSourceType="DBColumn" dataType="Integer" html="False" name="FD_GRP_ID" fieldSource="FD_GRP_ID" wizardCaption="FD GRP ID" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" PathID="FD_NAMESFD_GRP_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="FD_NME" fieldSource="FD_NME" wizardCaption="FD NME" wizardSize="50" wizardMaxLength="123" wizardIsPassword="False" wizardAddNbsp="True" PathID="FD_NAMESFD_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" name="FD_NMF" fieldSource="FD_NMF" wizardCaption="FD NMF" wizardSize="50" wizardMaxLength="134" wizardIsPassword="False" wizardAddNbsp="True" PathID="FD_NAMESFD_NMF">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="21" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="of" wizardImagesScheme="Compact">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="22" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="26"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
				<JoinTable id="6" tableName="FD_NAMES" posWidth="95" posHeight="120" posLeft="10" posRight="-1" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="13" tableName="FD_NAMES" fieldName="FD_CODE"/>
				<Field id="15" tableName="FD_NAMES" fieldName="FD_GRP_ID"/>
				<Field id="17" tableName="FD_NAMES" fieldName="FD_NME"/>
				<Field id="19" tableName="FD_NAMES" fieldName="FD_NMF"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="23" name="Header" PathID="Header" page="Header_live.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="24" name="Footer" PathID="Footer" page="Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="FD_NAMES_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="FD_NAMES_list.php" forShow="True" url="FD_NAMES_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
