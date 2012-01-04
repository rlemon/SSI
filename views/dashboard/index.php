<form method="post">
<div class="iblock">
	<div class="ui-padded-bottom ui-heading">
		<?php echo Session::get('username'); ?>'s Dashboard
	</div>
	<div class="ui-widget ui-padded-bottom">
		<div class="ui-widget-header ui-padded-all">Information</div>
		<div class="ui-widget-content ui-padded-all">
			<table>
				<tr>
					<td>
						<span class="small">Last Login:</span>
					</td>
					<td>
						<span class="small">
						<?php
						echo strftime('%A, %B, %e. %Y. @ %l:%M:%S %p', strtotime(Session::get('last_login')));
						?>
						</span>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="ui-widget ui-padded-bottom">
		<div class="ui-widget-header ui-padded-all">Personal Options</div>
		<div class="ui-widget-content ui-padded-all">
			<div class="ui-padded-bottom">
				<table>
					<tr>
						<td>
							<span class="small">Theme Selection:</span>
						</td>
						<td>
							<select class="ui-state-default" name="theme">
								<?php
									for($i = 0, $l = count($this->themes); $i < $l; $i++) {
										$selected = '';
										if( Session::get('ui_theme') == $i ) {
											$selected .= 'selected="selected" ';
										}
										echo '<option ' . $selected . 'value="' . $i . '">' . $this->themes[$i] . '</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<span class="ui-padded-bottom">Change Password</span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="small">Old Password:</span>
						</td>
						<td>
							<input type="password" name="old_password" />
						</td>
					</tr>
					<tr>
						<td>
							<span class="small">New Password:</span>
						</td>
						<td>
							<input type="password" name="new_password" />
						</td>
					</tr>
					<tr>
						<td>
							<span class="small">Confirm New Password:</span>
						</td>
						<td>
							<input type="password" name="confirm_password" />
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<input type="submit" class="ui-btn" name="save" value="Save" />
</div>
</form>
