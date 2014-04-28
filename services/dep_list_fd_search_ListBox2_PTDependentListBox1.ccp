<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" name="UNIT_FACT" connection="candat" dataSource="UNIT_FACT" pageSizeLimit="100" wizardCaption="List of UNIT FACT "><Components><Label id="14" fieldSourceType="DBColumn" dataType="Integer" html="False" name="FCT_id" fieldSource="FCT_id"><Components/><Events/><Attributes/><Features/></Label><Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="CONV_FAC" fieldSource="CONV_FAC"><Components/><Events/><Attributes/><Features/></Label></Components><Events/><TableParameters><TableParameter id="13" conditionType="Parameter" useIsNull="True" field="FD_ID" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/></TableParameters><JoinTables/><JoinLinks/><Fields/><SPParameters/><SQLParameters/><SecurityGroups/><Attributes/><Features/></Grid></Components>
	<CodeFiles>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
