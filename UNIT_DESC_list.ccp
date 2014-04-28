<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Compact" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="UNIT_DESCSearch" returnPage="UNIT_DESC_list.ccp" wizardCaption="Search UNIT DESC " wizardOrientation="Vertical" wizardFormMethod="post" PathID="UNIT_DESCSearch">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" parentName="UNIT_DESCSearch" PathID="UNIT_DESCSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="45" wizardMaxLength="45" wizardIsPassword="False" parentName="UNIT_DESCSearch" PathID="UNIT_DESCSearchs_keyword">
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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="UNIT_DESC" connection="candat" pageSizeLimit="100" wizardCaption="List of UNIT DESC " wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="UNIT_DESC">
			<Components>
				<Sorter id="9" visible="True" name="Sorter_MSR_ID" column="MSR_ID" wizardCaption="MSR ID" wizardSortingType="SimpleDir" wizardControl="MSR_ID" wizardAddNbsp="False" PathID="UNIT_DESCSorter_MSR_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="10" visible="True" name="Sorter_MSR_NME" column="MSR_NME" wizardCaption="MSR NME" wizardSortingType="SimpleDir" wizardControl="MSR_NME" wizardAddNbsp="False" PathID="UNIT_DESCSorter_MSR_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="11" visible="True" name="Sorter_MSR_NMF" column="MSR_NMF" wizardCaption="MSR NMF" wizardSortingType="SimpleDir" wizardControl="MSR_NMF" wizardAddNbsp="False" PathID="UNIT_DESCSorter_MSR_NMF">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="13" fieldSourceType="DBColumn" dataType="Integer" html="False" name="MSR_ID" fieldSource="MSR_ID" wizardCaption="MSR ID" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="UNIT_DESC" rowNumber="1" PathID="UNIT_DESCMSR_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="MSR_NME" fieldSource="MSR_NME" wizardCaption="MSR NME" wizardSize="45" wizardMaxLength="45" wizardIsPassword="False" wizardAddNbsp="True" parentName="UNIT_DESC" rowNumber="1" PathID="UNIT_DESCMSR_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="MSR_NMF" fieldSource="MSR_NMF" wizardCaption="MSR NMF" wizardSize="50" wizardMaxLength="58" wizardIsPassword="False" wizardAddNbsp="True" parentName="UNIT_DESC" rowNumber="1" PathID="UNIT_DESCMSR_NMF">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="18" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="of" wizardImagesScheme="Compact">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="19" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="7" conditionType="Parameter" useIsNull="False" field="MSR_NME" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="MSR_NMF" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="6" tableName="UNIT_DESC" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="12" tableName="UNIT_DESC" fieldName="MSR_ID"/>
				<Field id="14" tableName="UNIT_DESC" fieldName="MSR_NME"/>
				<Field id="16" tableName="UNIT_DESC" fieldName="MSR_NMF"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="20" name="Header" PathID="Header" parentType="Page" page="Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="21" name="Footer" PathID="Footer" parentType="Page" page="Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="UNIT_DESC_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="UNIT_DESC_list.php" forShow="True" url="UNIT_DESC_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
