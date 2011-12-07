 <div id="addFormWrapper">
<form id="addForm" action="<?php echo URL;?>inventory/xhrInsertSupplier/" method="post">
	<div class="title">Add New Supplier Form</div>
	<table>
		<tr><td>Name</td><td><input type="text" name="name" /></td><td>Telephone</td><td><input type="text" name="telephone" /></td></tr>
		<tr><td>Description</td><td><input type="text" name="description" /></td><td>Fax</td><td><input type="text" name="fax" /></td></tr>
		<tr><td>Email</td><td><input type="text" name="email" /></td><td>URL</td><td><input type="text" name="url" /></td></tr>
		<tr><td>Contact Name</td><td><input type="text" name="contact_name" /></td><td></td><td align="right"><input type="submit" /></td></tr>
	</table>
</form>
</div>
<a href="#" id="addFormToggleBtn">Toggle Add Supplier Form</a>
<hr />
<table id="tblListings" data-type="suppliers">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Fax</th>
            <th>URL</th>
            <th>Contact Name</th>
        </tr>
    </thead>
    <tbody>
		<tr>
			<td colspan="7">Loading supplier database...</td>
		</tr>
    </tbody>
</table> 
