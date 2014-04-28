<Page id="1" templateExtension="html" relativePath="..\..\..\..\CodeChargeStudio4\Examples\CCSExamplePack2" fullRelativePath="..\..\..\Program Files\CodeChargeStudio4\Projects\candat" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" validateRequest="True" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="EXPack" wizardThemeVersion="3.0" isService="False">
	<Components>
		<Grid id="276" secured="False" sourceType="Table" returnValueType="Number" name="store_products1" connection="InternetDB" dataSource="store_products" orderBy="product_name" pageSizeLimit="100" wizardCaption="List of Store Products " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" PathID="store_products1">
			<Components>
				<Label id="277" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="product_id" fieldSource="product_id" wizardCaption="Product Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="278" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="category_id" fieldSource="category_id" wizardCaption="Category Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="279" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="product_name" fieldSource="product_name" wizardCaption="Product Name" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
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
		<IncludePage id="280" hasOperation="True" name="Header" page="../Header.ccp">
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
		<Record id="259" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="store_productsSearch" wizardCaption="Search Store Products " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="DependentListBox.ccp" PathID="store_productsSearch">
			<Components>
				<ListBox id="261" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_category_id" wizardCaption="Category Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" connection="InternetDB" dataSource="store_categories" orderBy="category_name" boundColumn="category_id" textColumn="category_name" visible="Yes" PathID="store_productsSearchs_category_id">
					<Components/>
					<Events>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="262" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="s_product_id" wizardCaption="Product Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" connection="InternetDB" dataSource="store_products" activeCollection="TableParameters" activeTableType="dataSource" orderBy="product_name" boundColumn="product_id" textColumn="product_name" visible="Yes" PathID="store_productsSearchs_product_id">
					<Components/>
					<Events>
					</Events>
					<TableParameters>
						<TableParameter id="275" conditionType="Parameter" useIsNull="False" field="category_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_category_id" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
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
		<Grid id="258" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="1" name="store_products" connection="InternetDB" dataSource="store_products" orderBy="product_id" pageSizeLimit="100" wizardCaption="List of Store Products " wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="store_products">
			<Components>
				<Label id="267" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="product_name" fieldSource="product_name" wizardCaption="Product Name" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="268" fieldSourceType="DBColumn" dataType="Float" html="False" editable="False" name="price" fieldSource="price" wizardCaption="Price" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" format="0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Image id="269" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="image_url" fieldSource="image_url" wizardCaption="Image Url" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="store_productsimage_url">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Image>
				<Label id="270" fieldSourceType="DBColumn" dataType="Memo" html="False" editable="False" name="description1" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
			</Events>
			<TableParameters>
				<TableParameter id="263" conditionType="Parameter" useIsNull="False" field="category_id" parameterSource="s_category_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="264" conditionType="Parameter" useIsNull="False" field="product_id" parameterSource="s_product_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2" defaultValue="-1"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="281" name="Footer" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" page="../Footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="DependentListBox.php" forShow="True" url="DependentListBox.php" comment="//"/>
</CodeFiles>
	<SecurityGroups/>
	<Events>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
