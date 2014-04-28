<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Manuscript" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="candat" dataSource="ADMIN_DAY_NMS" name="ADMIN_DAY_NMS" pageSizeLimit="100" wizardCaption="List of ADMIN DAY NMS " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records">
			<Components>
				<Link id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADMIN_DAY_NMS_Insert" hrefSource="Studies.ccp" removeParameters="DY_id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="ADMIN_DAYSADMIN_DAY_NMSADMIN_DAY_NMS_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="5" visible="True" name="Sorter_DY_id" column="DY_id" wizardCaption="DY Id" wizardSortingType="SimpleDir" wizardControl="DY_id" wizardAddNbsp="False" PathID="ADMIN_DAYSADMIN_DAY_NMSSorter_DY_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="6" visible="True" name="Sorter_DY_NME" column="DY_NME" wizardCaption="DY NME" wizardSortingType="SimpleDir" wizardControl="DY_NME" wizardAddNbsp="False" PathID="ADMIN_DAYSADMIN_DAY_NMSSorter_DY_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DY_id" fieldSource="DY_id" wizardCaption="DY Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="Studies.ccp" wizardThemeItem="GridA" PathID="ADMIN_DAYSADMIN_DAY_NMSDY_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="8" sourceType="DataField" format="yyyy-mm-dd" name="DY_id" source="DY_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="False" name="DY_NME" fieldSource="DY_NME" wizardCaption="DY NME" wizardSize="25" wizardMaxLength="25" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="ADMIN_DAYSADMIN_DAY_NMSDY_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="11" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="True" wizardImagesScheme="Compact">
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
				<Field id="3" tableName="ADMIN_DAY_NMS" fieldName="DY_id"/>
				<Field id="9" tableName="ADMIN_DAY_NMS" fieldName="DY_NME"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="12" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="candat" name="ADMIN_DAY_NMS1" dataSource="ADMIN_DAY_NMS" errorSummator="Error" wizardCaption="Add/Edit ADMIN DAY NMS " wizardFormMethod="post" PathID="ADMIN_DAYSADMIN_DAY_NMS1" removeParameters="DY_id">
			<Components>
				<Button id="13" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="ADMIN_DAYSADMIN_DAY_NMS1Button_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="14" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="ADMIN_DAYSADMIN_DAY_NMS1Button_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="15" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="ADMIN_DAYSADMIN_DAY_NMS1Button_Delete">
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
				<Button id="17" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="ADMIN_DAYSADMIN_DAY_NMS1Button_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="DY_NME" fieldSource="DY_NME" required="True" caption="DY NME" wizardCaption="DY NME" wizardSize="25" wizardMaxLength="25" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="ADMIN_DAYSADMIN_DAY_NMS1DY_NME">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="DY_id" parameterSource="DY_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="ADMIN_DAYS.php" forShow="True" url="ADMIN_DAYS.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
