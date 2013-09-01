<h1>Metrics</h1>
<form class="form-horizontal" id="filterForm">
	<div class="row-fluid">
		<div class="span6">
			<select class="span12" name="metrics[]" id="selectMetrics" multiple data-rel="chosen">
				<option selected value="all_players_max">All - Peak Players</option>
				<option selected value="all_players_avg">All - Avg Players</option>
				<option value="all_players_min">All - Min Players</option>
				<option value="all_entities_max">All - Peak Entities</option>
				<option value="all_entities_avg">All - Avg Entities</option>
				<option value="all_entities_min">All - Min Entities</option>
				<option value="all_chunks_max">All - Peak Chunks</option>
				<option value="all_chunks_avg">All - Avg Chunks</option>
				<option value="all_chunks_min">All - Min Chunks</option>

				<option value="aragorn_players_max">Aragorn (All) - Peak Players</option>
				<option value="aragorn_players_avg">Aragorn (All) - Avg Players</option>
				<option value="aragorn_players_min">Aragorn (All) - Min Players</option>
				<option value="aragorn_entites_max">Aragorn (All) - Peak Entites</option>
				<option value="aragorn_entites_avg">Aragorn (All) - Avg Entites</option>
				<option value="aragorn_entites_min">Aragorn (All) - Min Entites</option>
				<option value="aragorn_chunks_max">Aragorn (All) - Peak Chunks</option>
				<option value="aragorn_chunks_avg">Aragorn (All) - Avg Chunks</option>
				<option value="aragorn_chunks_min">Aragorn (All) - Min Chunks</option>

				<option value="aragorn_players_themuseum_max">Aragorn (Museum) - Peak Players</option>
				<option value="aragorn_players_themuseum_avg">Aragorn (Museum) - Avg Players</option>
				<option value="aragorn_players_themuseum_min">Aragorn (Museum) - Min Players</option>
				<option value="aragorn_entites_themuseum_max">Aragorn (Museum) - Peak Entites</option>
				<option value="aragorn_entites_themuseum_avg">Aragorn (Museum) - Avg Entites</option>
				<option value="aragorn_entites_themuseum_min">Aragorn (Museum) - Min Entites</option>
				<option value="aragorn_chunks_themuseum_max">Aragorn (Museum) - Peak Chunks</option>
				<option value="aragorn_chunks_themuseum_avg">Aragorn (Museum) - Avg Chunks</option>
				<option value="aragorn_chunks_themuseum_min">Aragorn (Museum) - Min Chunks</option>
			</select>
		</div>

		<div class="span1">
			<select class="span12" name="x_unit" id="xUnit">
				<option selected value="hour">Hours</option>
				<option value="day">Days</option>
				<option value="week">Weeks</option>
				<option value="month">Months</option>
			</select>
		</div>

		<div class="span3">
			<div class="daterange-prepick" id="graph-range">
				<i class="icon-calendar icon-large"></i>
				<span><?=$yesterday;?> - <?=$today;?></span>
				<input type="hidden" class="start" name="start" value="<?=$yesterday;?>" />
				<input type="hidden" class="end" name="end" value="<?=$today;?>" />
			</div>
		</div>

		<div class="span2"><button id="graph-it" class="btn btn-large btn-info">Graph It!</button></div>
	</div>
</form>

<div class="row-fluid">
	<div class="span11">
		<div id="graph" class="center" style="height:500px;"></div>
	</div>

	<div class="span1">
		<h2>Legend</h2>
		<div id="graphLegend"></div>
	</div>
</div>