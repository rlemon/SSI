<h3>T.B.C</h3>
<ul>
	<li>
		View Suppliers -> Edit/Add/Delete 
	</li>
	<li>
		View Groups -> Edit/Add/Delete 
	</li>
	<li>
		Advanced filtering -> current UI needs some retouching if going to be used for the time being.
	</li>
	<li>
		Paging results. -> pass var to list page.
	</li>
</ul>
<h3>Known Issues</h3>
<ul>
	<li>
		No confirm on delete in older browsers. This is due to elm.dataset being called in the confirm. Possible solution is to use hidden form elements to store the item id
	</li>
	<li>
		Mappings are not cleaned up for removed items / groups / suppliers - this is most evident on the mapping table.
	</li>
</ul>
