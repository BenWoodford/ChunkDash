<h1>Metrics</h1>
<form class="form-horizontal">
	<div class="row-fluid">
		<div class="span7">
			<select class="span12" id="selectMetrics" multiple data-rel="chosen">
				<option selected value="all_users">All - Users</option>
				<option value="all_entities">All - Entities</option>
				<option value="all_chunks">All - Chunks</option>
				<option selected value="aragorn_users">Aragorn - Users</option>
				<option value="aragorn_entites">Aragorn - Entites</option>
				<option value="aragorn_chunks">Aragorn - Chunks</option>
			</select>
		</div>

		<div class="span3">
			<div class="daterange-prepick" id="graph-range">
				<i class="icon-calendar icon-large"></i>
				<span><?=$yesterday;?> - <?=$today;?></span>
				<input type="hidden" class="start" name="start" />
				<input type="hidden" class="end" name="end" />
			</div>
		</div>

		<div class="span2"><button id="graph-it" class="btn btn-large btn-info">Graph It!</button></div>
	</div>
</form>

<div class="row-fluid">
	<div class="span11">
		Chart.
	</div>

	<div class="span1">
		Legend?
	</div>
</div>