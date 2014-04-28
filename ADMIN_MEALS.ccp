<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Manuscript" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="candat" dataSource="ADMIN_Meal_NMS" name="ADMIN_Meal_NMS" pageSizeLimit="100" wizardCaption="List of ADMIN Meal NMS " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records">
			<Components>
				<Link id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADMIN_Meal_NMS_Insert" hrefSource="Studies.ccp" removeParameters="ML_id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="ADMIN_MEALSADMIN_Meal_NMSADMIN_Meal_NMS_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="5" visible="True" name="Sorter_ML_id" column="ML_id" wizardCaption="ML Id" wizardSortingType="SimpleDir" wizardControl="ML_id" wizardAddNbsp="False" PathID="ADMIN_MEALSADMIN_Meal_NMSSorter_ML_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="6" visible="True" name="Sorter_ML_NME" column="ML_NME" wizardCaption="ML NME" wizardSortingType="SimpleDir" wizardControl="ML_NME" wizardAddNbsp="False" PathID="ADMIN_MEALSADMIN_Meal_NMSSorter_ML_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ML_id" fieldSource="ML_id" wizardCaption="ML Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="Studies.ccp" wizardThemeItem="GridA" PathID="ADMIN_MEALSADMIN_Meal_NMSML_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="8" sourceType="DataField" format="yyyy-mm-dd" name="ML_id" source="ML_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="False" name="ML_NME" fieldSource="ML_NME" wizardCaption="ML NME" wizardSize="25" wizardMaxLength="25" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="ADMIN_MEALSADMIN_Meal_NMSML_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="11" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="True" wizardImagesScheme="Manuscript">
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
				<Field id="3" tableName="ADMIN_Meal_NMS" fieldName="ML_id"/>
				<Field id="9" tableName="ADMIN_Meal_NMS" fieldName="ML_NME"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="12" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="candat" name="ADMIN_Meal_NMS1" dataSource="ADMIN_Meal_NMS" errorSummator="Error" wizardCaption="Add/Edit ADMIN Meal NMS " wizardFormMethod="post" PathID="ADMIN_MEALSADMIN_Meal_NMS1" removeParameters="ML_id">
			<Components>
				<Button id="13" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="ADMIN_MEALSADMIN_Meal_NMS1Button_Insert" returnPage="Studies.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="14" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="ADMIN_MEALSADMIN_Meal_NMS1Button_Update" returnPage="Studies.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="15" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="ADMIN_MEALSADMIN_Meal_NMS1Button_Delete" returnPage="Studies.ccp">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="16" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="17" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="ADMIN_MEALSADMIN_Meal_NMS1Button_Cancel" returnPage="Studies.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ML_NME" fieldSource="ML_NME" required="True" caption="ML NME" wizardCaption="ML NME" wizardSize="25" wizardMaxLength="25" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="ADMIN_MEALSADMIN_Meal_NMS1ML_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="ML_id" parameterSource="ML_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="ADMIN_MEALS.php" forShow="True" url="ADMIN_MEALS.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
