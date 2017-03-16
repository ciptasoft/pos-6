<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open('items/save/'.$item_info->item_id, array('id'=>'item_form', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal')); ?>
	<fieldset id="item_basic_info">
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_item_number'), 'item_number', array('class'=>'required control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<div class="input-group">
					<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-barcode"></span></span>
					<?php echo form_input(array(
							'name'=>'item_number',
							'id'=>'item_number',
							'class'=>'form-control input-sm',
							'value'=>$item_info->item_number)
							);?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_name'), 'name', array('class'=>'required control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_input(array(
						'name'=>'name',
						'id'=>'name',
						'class'=>'form-control input-sm',
						'value'=>$item_info->name)
						);?>
			</div>
		</div>
            
            
            <?php
		for ($i = 1; $i <= 10; ++$i)
		{
		?>
			<?php
			if($this->config->item('custom'.$i.'_name') != null && $i != 2 && $i != 3)
			{
				$item_arr = (array)$item_info;
			?>
				<div class="form-group form-group-sm">
					<?php echo form_label($this->config->item('custom'.$i.'_name'), 'custom'.$i, array('class'=>'control-label col-xs-3')); ?>
					<div class='col-xs-8'>
						<?php echo form_input(array(
								'name'=>'custom'.$i,
								'id'=>'custom'.$i,
								'class'=>'form-control input-sm',
								'value'=>$item_arr['custom'.$i])
								);?>
					</div>
				</div>
		<?php
			}
		}
		?>

		

		<?php if ($item_kits_enabled == '1'): ?>
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_stock_type'), 'stock_type', !empty($basic_version) ? array('class'=>'required control-label col-xs-3') : array('class'=>'control-label col-xs-3')); ?>
			<div class="col-xs-8">
				<label class="radio-inline">
					<?php echo form_radio(array(
							'name'=>'stock_type',
							'type'=>'radio',
							'id'=>'stock_type',
							'value'=>0,
							'checked'=>$item_info->stock_type === '0')
					); ?> <?php echo $this->lang->line('items_stock'); ?>
				</label>
				<label class="radio-inline">
					<?php echo form_radio(array(
							'name'=>'stock_type',
							'type'=>'radio',
							'id'=>'stock_type',
							'value'=>1,
							'checked'=>$item_info->stock_type === '1')
					); ?> <?php echo $this->lang->line('items_nonstock'); ?>
				</label>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_type'), 'item_type', !empty($basic_version) ? array('class'=>'required control-label col-xs-3') : array('class'=>'control-label col-xs-3')); ?>
			<div class="col-xs-8">
				<label class="radio-inline">
					<?php echo form_radio(array(
							'name'=>'item_type',
							'type'=>'radio',
							'id'=>'item_type',
							'value'=>0,
							'checked'=>$item_info->item_type === '0')
					); ?> <?php echo $this->lang->line('items_standard'); ?>
				</label>
				<label class="radio-inline">
					<?php echo form_radio(array(
							'name'=>'item_type',
							'type'=>'radio',
							'id'=>'item_type',
							'value'=>1,
							'checked'=>$item_info->item_type === '1')
					); ?> <?php echo $this->lang->line('items_kit'); ?>
				</label>
			</div>
		</div>
		<?php endif; ?>

        <div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_supplier'), 'supplier', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_dropdown('supplier_id', $suppliers, $selected_supplier, array('class'=>'form-control')); ?>
			</div>
		</div>
            <div class="form-group form-group-sm">
			<?php echo form_label('Category', 'category_id', array('class'=>'required control-label col-xs-3')); ?>
<!--			<div class='col-xs-8'>
				< ?php echo form_dropdown('category_id', $categories_list, $selected_category, array('id'=>'category_id', 'class'=>'form-control')); ?>
			</div>-->
                <div class='col-xs-8'>
		    <?php echo form_input(array('name'=>'category_name', 'id'=>'category_name', 'class'=>'form-control input-sm', 'value'=>$selected_category_name));?>
		</div>
	    </div>
            
<?php echo form_input(array('name'=>'category', 'id'=>'category', 'type'=>'hidden', 'value'=>'Unishop')); ?>
<?php echo form_input(array('name'=>'category_id', 'id'=>'category_id', 'type'=>'hidden', 'value'=>$selected_category)); ?>
            
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_cost_price'), 'cost_price', array('class'=>'required control-label col-xs-3')); ?>
			<div class="col-xs-4">
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'cost_price',
							'id'=>'cost_price',
							'class'=>'form-control input-sm',
							'value'=>to_currency_no_money($item_info->cost_price))
							);?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_unit_price'), 'unit_price', array('class'=>'required control-label col-xs-3')); ?>
			<div class='col-xs-4'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'unit_price',
							'id'=>'unit_price',
							'class'=>'form-control input-sm',
							'value'=>to_currency_no_money($item_info->unit_price))
							);?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_tax_1'), 'tax_percent_1', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-4'>
				<?php echo form_input(array(
						'name'=>'tax_names[]',
						'id'=>'tax_name_1',
						'class'=>'form-control input-sm',
						'value'=>isset($item_tax_info[0]['name']) ? $item_tax_info[0]['name'] : $this->config->item('default_tax_1_name'))
						);?>
			</div>
			<div class="col-xs-4">
				<div class="input-group input-group-sm">
					<?php echo form_input(array(
							'name'=>'tax_percents[]',
							'id'=>'tax_percent_name_1',
							'class'=>'form-control input-sm',
							'value'=>isset($item_tax_info[0]['percent']) ? to_tax_decimals($item_tax_info[0]['percent']) : to_tax_decimals($default_tax_1_rate))
							);?>
					<span class="input-group-addon input-sm"><b>%</b></span>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_tax_2'), 'tax_percent_2', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-4'>
				<?php echo form_input(array(
						'name'=>'tax_names[]',
						'id'=>'tax_name_2',
						'class'=>'form-control input-sm',
						'value'=>isset($item_tax_info[1]['name']) ? $item_tax_info[1]['name'] : $this->config->item('default_tax_2_name'))
						);?>
			</div>
			<div class="col-xs-4">
				<div class="input-group input-group-sm">
					<?php echo form_input(array(
							'name'=>'tax_percents[]',
							'class'=>'form-control input-sm',
							'id'=>'tax_percent_name_2',
							'value'=>isset($item_tax_info[1]['percent']) ? to_tax_decimals($item_tax_info[1]['percent']) : to_tax_decimals($default_tax_2_rate))
							);?>
					<span class="input-group-addon input-sm"><b>%</b></span>
				</div>
			</div>
		</div>
                
                <div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('measurement'), 'custom2', array('class'=>'required control-label col-xs-3')); ?>
			<div class='col-xs-4'>
				<?php echo form_input(array(
						'name'=>'custom2',
						'id'=>'custom2',
						'class'=>'required form-control input-sm',
						'value'=>isset($item_info->custom2) ? to_quantity_decimals($item_info->custom2) : to_quantity_decimals(0))
						);?>
			</div>
                    <?php if($this->config->item('custom3_name') != null){ ?>
			<div class='col-xs-4'>
				<?php echo form_dropdown('custom3', $this->lang->line('items_units'), isset($item_info->custom3) ? $item_info->custom3 : '', array('class'=>'form-control')); ?>
			</div>
                      <?php  } ?>
                    
		</div>

		<?php
		foreach($stock_locations as $key=>$location_detail)
		{ 
		?>
			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('items_quantity').' '.$location_detail['location_name'], 'quantity_' . $key, array('class'=>'required control-label col-xs-3')); ?>
				<div class='col-xs-4'>
					<?php echo form_input(array(
							'name'=>'quantity_' . $key,
							'id'=>'quantity_' . $key,
							'class'=>'required quantity form-control',
							'value'=>isset($item_info->item_id) ? to_quantity_decimals($location_detail['quantity']) : to_quantity_decimals(0))
							);?>
				</div>
			</div>
		<?php
		}
		?>
            
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_receiving_quantity'), 'receiving_quantity', array('class'=>'required control-label col-xs-3')); ?>
			<div class='col-xs-4'>
				<?php echo form_input(array(
						'name'=>'receiving_quantity',
						'id'=>'receiving_quantity',
						'class'=>'required form-control input-sm',
						'value'=>isset($item_info->item_id) ? to_quantity_decimals($item_info->receiving_quantity) : to_quantity_decimals(0))
						);?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_reorder_level'), 'reorder_level', array('class'=>'required control-label col-xs-3')); ?>
			<div class='col-xs-4'>
				<?php echo form_input(array(
						'name'=>'reorder_level',
						'id'=>'reorder_level',
						'class'=>'form-control input-sm',
						'value'=>isset($item_info->item_id) ? to_quantity_decimals($item_info->reorder_level) : to_quantity_decimals(0))
						);?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_description'), 'description', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_textarea(array(
						'name'=>'description',
						'id'=>'description',
						'class'=>'form-control input-sm',
						'value'=>$item_info->description)
						);?>
			</div>
		</div>
		
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_image'), 'items_image', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<div class="fileinput <?php echo $logo_exists ? 'fileinput-exists' : 'fileinput-new'; ?>" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;"></div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px; max-height: 100px;">
						<img data-src="holder.js/100%x100%" alt="<?php echo $this->lang->line('items_image'); ?>"
							 src="<?php echo $image_path; ?>"
							 style="max-height: 100%; max-width: 100%;">
					</div>
					<div>
						<span class="btn btn-default btn-sm btn-file">
							<span class="fileinput-new"><?php echo $this->lang->line("items_select_image"); ?></span>
							<span class="fileinput-exists"><?php echo $this->lang->line("items_change_image"); ?></span>
							<input type="file" name="item_image" accept="image/*">
						</span>
						<a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><?php echo $this->lang->line("items_remove_image"); ?></a>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_allow_alt_description'), 'allow_alt_description', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-1'>
				<?php echo form_checkbox(array(
						'name'=>'allow_alt_description',
						'id'=>'allow_alt_description',
						'value'=>1,
						'checked'=>($item_info->allow_alt_description) ? 1 : 0)
						);?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_is_serialized'), 'is_serialized', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-1'>
				<?php echo form_checkbox(array(
						'name'=>'is_serialized',
						'id'=>'is_serialized',
						'value'=>1,
						'checked'=>($item_info->is_serialized) ? 1 : 0)
						);?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_is_deleted'), 'is_deleted', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-1'>
				<?php echo form_checkbox(array(
						'name'=>'is_deleted',
						'id'=>'is_deleted',
						'value'=>1,
						'checked'=>($item_info->deleted) ? 1 : 0)
						);?>
			</div>
		</div>

		
	</fieldset>
<?php echo form_close(); ?>

<script type="text/javascript">
	//validation and submit handling
	$(document).ready(function()
	{
                $("input[name=name]").change(function () {
                    var name = $("input[name=name]").val();
                    var arr = name.split(' ');
                    var short = '';
                    if(arr[0] && arr[0] !=''){
                        short = arr[0];
                    }else{
                        return false;
                    }
                    var last = arr[arr.length-1];
                    if(arr.length != 1 && last && last !=''){
                        short = short + ' ' + last;
                    }
                    if(short !=''){
                        $("input[name=custom1]").val(short);
                    }
                });

		$("#new").click(function() {
			stay_open = true;
			$("#item_form").submit();
		});

		$("#submit").click(function() {
			stay_open = false;
		});

		var no_op = function(event, data, formatted){};
		$("#category_name").autocomplete({
                                source:function (request, response) {
					$.ajax({
						url: "<?php echo site_url('items/suggest_category');?>",
						dataType: "json",
                                                data: { term: $("#category_name").val() },
						success: function(data) {
							response($.map(data, function(item) {
								return {
									label: item.label,
									value: item.category_id,
								};
							}))
						}
					});
				},
                                
                                select: function (event, ui) {
                                    var v = ui.item.value;
                                     $('#category_id').val(v);
                                    // update what is displayed in the textbox
                                    this.value = ui.item.label; 
                                    return false;
                                },
                                
                                //source: "< ?php echo site_url('items/suggest_category');?>",
                                delay:10,
                                appendTo: '.modal-content'});

		<?php for ($i = 1; $i <= 10; ++$i)
		{
		?>
			$("#custom"+<?php echo $i; ?>).autocomplete({
				source:function (request, response) {
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('items/suggest_custom');?>",
						dataType: "json",
						data: $.extend(request, $extend(csrf_form_base(), {field_no: <?php echo $i; ?>})),
						success: function(data) {
							response($.map(data, function(item) {
								return {
									value: item.label
								};
							}))
						}
					});
				},
				delay:10,
				appendTo: '.modal-content'});
		<?php
		}
		?>

		$("a.fileinput-exists").click(function() {
			$.ajax({
				type: "GET",
				url: "<?php echo site_url("$controller_name/remove_logo/$item_info->item_id"); ?>",
				dataType: "json"
			})
		});

		$('#item_form').validate($.extend({
                        ignore: "", 
			submitHandler: function(form, event) {
				$(form).ajaxSubmit({
					success: function(response) {
						var stay_open = dialog_support.clicked_id() != 'submit';
						if (stay_open)
						{
							// set action of item_form to url without item id, so a new one can be created
							$("#item_form").attr("action", "<?php echo site_url("items/save/")?>");
							// use a whitelist of fields to minimize unintended side effects
							$(':text, :password, :file, #description, #item_form').not('.quantity, #reorder_level, #tax_name_1,' +
								'#tax_percent_name_1, #reference_number, #name, #cost_price, #unit_price, #taxed_cost_price, #taxed_unit_price').val('');
							// de-select any checkboxes, radios and drop-down menus
							$(':input', '#item_form').not('#item_category_id').removeAttr('checked').removeAttr('selected');
						}
						else
						{
							dialog_support.hide();
						}
						table_support.handle_submit('<?php echo site_url('items'); ?>', response, stay_open);
					},
					dataType: 'json'
				});
			},

			rules:
			{
				name:"required",
				category:"required",
				category_id:"required",
				item_number:
				{
					required: true,
					remote:
					{
						url: "<?php echo site_url($controller_name . '/check_item_number')?>",
						type: "post",
						data: $.extend(csrf_form_base(),
						{
							"item_id" : "<?php echo $item_info->item_id; ?>",
							"item_number" : function()
							{
								return $("#item_number").val();
							},
						})
					}
				},
				cost_price:
				{
					required: true,
					remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
				},
				unit_price:
				{
					required:true,
					remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
				},
				<?php
				foreach($stock_locations as $key=>$location_detail)
				{
				?>
					<?php echo 'quantity_' . $key ?>:
					{
						required:true,
						remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
					},
				<?php
				}
				?>
				receiving_quantity:
				{
					required:true,
					remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
				},
				reorder_level:
				{
					required:true,
					remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
				},
				tax_percent:
				{
					required:true,
					remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
				}
			},

			messages:
			{
				name:"<?php echo $this->lang->line('items_name_required'); ?>",
				item_number: {
                                    required : "<?php echo $this->lang->line('items_number_required'); ?>",
                                    remote : "<?php echo $this->lang->line('items_item_number_duplicate'); ?>",
                                },
				category:"<?php echo $this->lang->line('items_category_required'); ?>",
				category_id:"<?php echo $this->lang->line('items_category_id_required'); ?>",
				cost_price:
				{
					required:"<?php echo $this->lang->line('items_cost_price_required'); ?>",
					number:"<?php echo $this->lang->line('items_cost_price_number'); ?>"
				},
				unit_price:
				{
					required:"<?php echo $this->lang->line('items_unit_price_required'); ?>",
					number:"<?php echo $this->lang->line('items_unit_price_number'); ?>"
				},
				<?php
				foreach($stock_locations as $key=>$location_detail)
				{
				?>
					<?php echo 'quantity_' . $key ?>:
					{
						required:"<?php echo $this->lang->line('items_quantity_required'); ?>",
						number:"<?php echo $this->lang->line('items_quantity_number'); ?>"
					},
				<?php
				}
				?>
				receiving_quantity:
				{
					required:"<?php echo $this->lang->line('items_quantity_required'); ?>",
					number:"<?php echo $this->lang->line('items_quantity_number'); ?>"
				},
				reorder_level:
				{
					required:"<?php echo $this->lang->line('items_reorder_level_required'); ?>",
					number:"<?php echo $this->lang->line('items_reorder_level_number'); ?>"
				},
				tax_percent:
				{
					required:"<?php echo $this->lang->line('items_tax_percent_required'); ?>",
					number:"<?php echo $this->lang->line('items_tax_percent_number'); ?>"
				}
			}
		}, form_support.error));
	});
</script>

