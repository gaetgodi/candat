<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" validateRequest="True" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Manuscript" wizardThemeVersion="3.0" isService="False">
	<Components>
		<Grid id="276" secured="False" sourceType="Table" returnValueType="Number" name="store_products1" connection="candat" dataSource="UNIT_FACT" orderBy="product_name" pageSizeLimit="100" wizardCaption="List of Store Products " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" PathID="store_products1">
			<Components>
				<Label id="277" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="product_id" fieldSource="FCT_id" wizardCaption="Product Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="278" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="category_id" fieldSource="FD_ID" wizardCaption="Category Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="279" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="product_name" fieldSource="CONV_FAC" wizardCaption="Product Name" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="280" hasOperation="True" name="Header" page="Header_live.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Link id="85" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="Link1" hrefSource="DependentListBox_desc.ccp" visible="Yes" PathID="Link1">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</Link>
		<Record id="259" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="store_productsSearch" wizardCaption="Search Store Products " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="deplist.ccp" PathID="store_productsSearch">
			<Components>
				<ListBox id="261" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_category_id" wizardCaption="Category Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" connection="candat" dataSource="FD_NAMES" orderBy="FD_CODE" boundColumn="FD_CODE" textColumn="FD_NME" visible="Yes" PathID="store_productsSearchs_category_id">
					<Components/>
					<Events>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
<JoinTable id="283" tableName="FD_NAMES" posLeft="10" posTop="10" posWidth="95" posHeight="120"/>
</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="262" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_product_id" wizardCaption="Product Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" connection="candat" dataSource="UNIT_FACT" activeCollection="TableParameters" activeTableType="dataSource" orderBy="MSR_ID" boundColumn="FCT_id" textColumn="CONV_FAC" visible="Yes" PathID="store_productsSearchs_product_id">
					<Components/>
					<Events>
					</Events>
					<TableParameters>
						<TableParameter id="275" conditionType="Parameter" useIsNull="False" field="FD_ID" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" orderNumber="1" parameterSource="s_category_id"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
<JoinTable id="284" tableName="UNIT_FACT" posLeft="10" posTop="10" posWidth="95" posHeight="120"/>
</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
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
		<Grid id="258" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="1" name="store_products" connection="candat" dataSource="UNIT_FACT" orderBy="FCT_id" pageSizeLimit="100" wizardCaption="List of Store Products " wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="store_products">
			<Components>
				<Label id="267" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="product_name" fieldSource="FCT_id" wizardCaption="Product Name" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="268" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="price" fieldSource="MSR_ID" wizardCaption="Price" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" format="0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="270" fieldSourceType="DBColumn" dataType="Float" html="False" editable="False" name="description1" fieldSource="CONV_FAC" wizardCaption="Description" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
			</Events>
			<TableParameters>
				<TableParameter id="263" conditionType="Parameter" useIsNull="False" field="FD_ID" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="s_category_id"/>
				<TableParameter id="264" conditionType="Parameter" useIsNull="False" field="FCT_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2" defaultValue="-1" parameterSource="s_product_id"/>
			</TableParameters>
			<JoinTables>
<JoinTable id="282" tableName="UNIT_FACT" posLeft="10" posTop="10" posWidth="95" posHeight="120"/>
</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="281" name="Footer" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" page="Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="deplist.php" forShow="True" url="deplist.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
