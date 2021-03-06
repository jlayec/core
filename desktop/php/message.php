<?php
if (!isConnect()) {
	throw new Exception('{{401 - Accès non autorisé}}');
}

$selectPlugin = init('plugin');
if ($selectPlugin != '') {
	$listMessage = message::byPlugin($selectPlugin);
} else {
	$listMessage = message::all();
}
?>
<div class="input-group pull-right" style="display:inline-flex">
	<select id="sel_plugin" class="form-control input-sm roundedLeft" style="width: 200px;">
		<option value="" selected>{{Tout}}</option>
		<?php
		foreach (message::listPlugin() as $plugin) {
			if ($selectPlugin == $plugin['plugin']) {
				echo '<option value="' . $plugin['plugin'] . '" selected>' . $plugin['plugin'] . '</option>';
			} else {
				echo '<option value="' . $plugin['plugin'] . '">' . $plugin['plugin'] . '</option>';
			}
		}
		?>
	</select>
	<span class="input-group-btn">
		<a class="btn btn-default btn-sm" id="bt_refreshMessage"><i class="fas fa-sync icon-white"></i> {{Rafraichir}}</a><a class="btn btn-danger roundedRight btn-sm" id="bt_clearMessage"><i class="far fa-trash-alt icon-white"></i> {{Vider}}</a>
	</span>
</div>

<table class="table table-condensed table-bordered tablesorter" id="table_message" style="margin-top: 5px;">
	<thead>
		<tr>
			<th data-sorter="false" data-filter="false"></th>
			<th style="width:150px;">{{Date et heure}}</th>
			<th>{{Source}}</th>
			<th>{{Description}}</th>
			<th data-sorter="false" data-filter="false">{{Action}}</th>
			<th>{{Occurrences}}</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($listMessage as $message) {
			echo '<tr data-message_id="' . $message->getId() . '">';
			echo '<td><center><i class="far fa-trash-alt cursor removeMessage"></i></center></td>';
			echo '<td class="datetime">' . $message->getDate() . '</td>';
			echo '<td class="plugin">' . $message->getPlugin() . '</td>';
			echo '<td class="message">' . html_entity_decode($message->getMessage()) . '</td>';
			echo '<td class="message_action">' . $message->getAction() . '</td>';
			echo '<td class="occurrences">' . $message->getOccurrences() . '</td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>

<?php include_file('desktop', 'message', 'js');?>
