<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Manuscript" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="candat" dataSource="STUDIES" name="STUDIES" pageSizeLimit="100" wizardCaption="List of STUDIES " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records">
			<Components>
				<Sorter id="5" visible="True" name="Sorter_long_desc" column="long_desc" wizardCaption="Long Desc" wizardSortingType="SimpleDir" wizardControl="long_desc" wizardAddNbsp="False" PathID="STUDIESSorter_long_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Absolute" preserveParameters="GET" name="long_desc" fieldSource="long_desc" wizardCaption="Long Desc" wizardSize="50" wizardMaxLength="120" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" hrefSource="FD_NAMES_list.ccp" wizardThemeItem="GridA" PathID="STUDIESlong_desc">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="8" sourceType="DataField" format="yyyy-mm-dd" name="ST_id" source="ST_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields>
				<Field id="3" tableName="STUDIES" fieldName="ST_id"/>
				<Field id="6" tableName="STUDIES" fieldName="long_desc"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="9" name="Header_live" PathID="Header_live" page="Header_live.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="10" name="Footer" PathID="Footer" page="Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="index.php" forShow="True" url="index.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
