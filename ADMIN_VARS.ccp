<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Manuscript" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="25" connection="candat" dataSource="ADMIN_VAR_NMS" name="ADMIN_VAR_NMS" pageSizeLimit="100" wizardCaption="List of ADMIN VAR NMS " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records">
			<Components>
				<Link id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADMIN_VAR_NMS_Insert" hrefSource="Studies.ccp" removeParameters="VAR_id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="ADMIN_VARSADMIN_VAR_NMSADMIN_VAR_NMS_Insert" fieldSource="VAR_id">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="5" visible="True" name="Sorter_VAR_id" column="VAR_id" wizardCaption="VAR Id" wizardSortingType="SimpleDir" wizardControl="VAR_id" wizardAddNbsp="False" PathID="ADMIN_VARSADMIN_VAR_NMSSorter_VAR_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="7" visible="True" name="Sorter_VR_NME" column="VR_NME" wizardCaption="VR NME" wizardSortingType="SimpleDir" wizardControl="VR_NME" wizardAddNbsp="False" PathID="ADMIN_VARSADMIN_VAR_NMSSorter_VR_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="VAR_id" wizardCaption="VAR Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="Studies.ccp" wizardThemeItem="GridA" PathID="ADMIN_VARSADMIN_VAR_NMSVAR_id" fieldSource="VAR_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="9" sourceType="DataField" format="yyyy-mm-dd" name="VAR_id" source="VAR_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="False" name="VR_NME" fieldSource="VR_NME" wizardCaption="VR NME" wizardSize="25" wizardMaxLength="25" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="ADMIN_VARSADMIN_VAR_NMSVR_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="14" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="True" wizardImagesScheme="Manuscript">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="27" tableName="ADMIN_VAR_NMS" posLeft="10" posTop="10" posWidth="95" posHeight="104"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="28" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="15" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="candat" name="ADMIN_VAR_NMS1" dataSource="ADMIN_VAR_NMS" errorSummator="Error" wizardCaption="Add/Edit ADMIN VAR NMS " wizardFormMethod="post" PathID="ADMIN_VARSADMIN_VAR_NMS1">
			<Components>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="ADMIN_VARSADMIN_VAR_NMS1Button_Insert" removeParameters="VAR_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="17" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="ADMIN_VARSADMIN_VAR_NMS1Button_Update" removeParameters="VAR_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="18" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="ADMIN_VARSADMIN_VAR_NMS1Button_Delete" removeParameters="VAR_id">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="19" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="20" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="ADMIN_VARSADMIN_VAR_NMS1Button_Cancel" removeParameters="VAR_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="23" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="VR_NME" fieldSource="VR_NME" required="False" caption="VR NME" wizardCaption="VR NME" wizardSize="25" wizardMaxLength="25" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="ADMIN_VARSADMIN_VAR_NMS1VR_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="VAR_id" parameterSource="VAR_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="25" field="VR_NME" dataType="Text" parameterType="Control" parameterSource="VR_NME" omitIfEmpty="True"/>
				<CustomParameter id="26" field="ST_id" dataType="Text" parameterType="Control" parameterSource="ST_id" omitIfEmpty="True"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="ADMIN_VARS.php" forShow="True" url="ADMIN_VARS.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
