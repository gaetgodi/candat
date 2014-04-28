<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Compact" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" name="UNIT_FACT" connection="candat" pageSizeLimit="100" wizardCaption="List of UNIT FACT " wizardGridType="Tabular" wizardAllowSorting="True" wizardSortingType="SimpleDir" wizardUsePageScroller="True" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" wizardAltRecordType="Controls" dataSource="UNIT_FACT">
			<Components>
				<Sorter id="4" visible="True" name="Sorter_FD_ID" column="FD_ID" wizardCaption="FD ID" wizardSortingType="SimpleDir" wizardControl="FD_ID" wizardAddNbsp="False" PathID="UNIT_FACTSorter_FD_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="5" visible="True" name="Sorter_MSR_ID" column="MSR_ID" wizardCaption="MSR ID" wizardSortingType="SimpleDir" wizardControl="MSR_ID" wizardAddNbsp="False" PathID="UNIT_FACTSorter_MSR_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="6" visible="True" name="Sorter_CONV_FAC" column="CONV_FAC" wizardCaption="CONV FAC" wizardSortingType="SimpleDir" wizardControl="CONV_FAC" wizardAddNbsp="False" PathID="UNIT_FACTSorter_CONV_FAC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="8" fieldSourceType="DBColumn" dataType="Integer" html="False" name="FD_ID" fieldSource="FD_ID" wizardCaption="FD ID" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="UNIT_FACT" rowNumber="1" PathID="UNIT_FACTFD_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="10" fieldSourceType="DBColumn" dataType="Integer" html="False" name="MSR_ID" fieldSource="MSR_ID" wizardCaption="MSR ID" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardAddNbsp="True" wizardAlign="right" parentName="UNIT_FACT" rowNumber="1" PathID="UNIT_FACTMSR_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" name="CONV_FAC" fieldSource="CONV_FAC" wizardCaption="CONV FAC" wizardSize="7" wizardMaxLength="7" wizardIsPassword="False" wizardAddNbsp="True" parentName="UNIT_FACT" rowNumber="1" PathID="UNIT_FACTCONV_FAC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="13" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardFirst="True" wizardPrev="True" wizardFirstText="|&lt;" wizardPrevText="&lt;&lt;" wizardNextText="&gt;&gt;" wizardLastText="&gt;|" wizardNext="True" wizardLast="True" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="of" wizardImagesScheme="Compact">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Hide-Show Component" actionCategory="General" id="14" action="Hide" conditionType="Parameter" dataType="Integer" condition="LessThan" name1="TotalPages" sourceType1="SpecialValue" name2="2" sourceType2="Expression"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="3" tableName="UNIT_FACT" posWidth="-1" posHeight="-1" posLeft="-1" posRight="-1"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="7" tableName="UNIT_FACT" fieldName="FD_ID"/>
				<Field id="9" tableName="UNIT_FACT" fieldName="MSR_ID"/>
				<Field id="11" tableName="UNIT_FACT" fieldName="CONV_FAC"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="15" name="Header" PathID="Header" parentType="Page" page="Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="16" name="Footer" PathID="Footer" parentType="Page" page="Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="UNIT_FACT_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="UNIT_FACT_list.php" forShow="True" url="UNIT_FACT_list.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
