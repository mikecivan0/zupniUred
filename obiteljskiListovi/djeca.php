<div class="row">
	<div class="large-12 columns">
		<div class="large-12 columns text_desno">
			<a href="#" data-reveal-id="noviClan" id="novoDijete"> 
				<img class="pb5" src="../img/dodaj.png" alt="dodaj"> 
			</a>
		</div>
		<table class="large-12 columns" style="border: black 1px solid;">
			<thead>
				<tr style="border-bottom: black 1px solid;">
					<th>Ime djeteta</th>
					<th></th>
					<th>Rođenje</th>
					<th>Krštenje</th>
					<th>P. Pričest</th>
					<th>Potvrda</th>
					<th>Vjenčanje</th>
					<th>Smrt</th>
					<th class="center">Uredi/briši</th>
				</tr>

			</thead>
			<tbody id="tablicaDjece">
				<?php foreach ($djeca as $dijete) { ?>
					
				<tr id="tr1Clan<?= $dijete->id ?>">
					<td id="ime<?= $dijete->id ?>" rowspan="2" style="border-bottom: black 1px solid;"><?= $dijete->ime ?></td>
					<td><b>kada</b></td>
					<td id="datumRodjenja<?= $dijete->id ?>"><?= Alati::datum($dijete->datumRodjenja) ?></td>
					<td id="datumKrstenja<?= $dijete->id ?>"><?= Alati::datum($dijete->datumKrstenja) ?></td>
					<td id="datumPricesti<?= $dijete->id ?>"><?= Alati::datum($dijete->datumPricesti) ?></td>
					<td id="datumPotvrde<?= $dijete->id ?>"><?= Alati::datum($dijete->datumPotvrde) ?></td>
					<td id="datumVjencanja<?= $dijete->id ?>"><?= Alati::datum($dijete->datumVjencanja) ?></td>
					<td id="datumSmrti<?= $dijete->id ?>"><?= Alati::datum($dijete->datumSmrti) ?></td>
					<td rowspan="2" class="center" style="border-bottom: black 1px solid;">
						<a href="#" data-reveal-id="noviClan" class="bezDonjeCrte promijeni" id="<?= $dijete->id ?>">
							<img src="../img/admin/pen.png" class="pr10">
						</a>
						<a href="#" class="obrisi" id="<?= $dijete->id ?>">
							<img src="../img/admin/bin.png">
						</a>
					</td>				
				</tr>
				<tr id="tr2Clan<?= $dijete->id ?>" style="border-bottom: black 1px solid;">
					<td><b>gdje</b></td>
					<td id="mjestoRodjenja<?= $dijete->id ?>"><?= $dijete->mjestoRodjenja ?></td>
					<td id="mjestoKrstenja<?= $dijete->id ?>"><?= $dijete->mjestoKrstenja ?></td>
					<td id="mjestoPricesti<?= $dijete->id ?>"><?= $dijete->mjestoPricesti ?></td>
					<td id="mjestoPotvrde<?= $dijete->id ?>"><?= $dijete->mjestoPotvrde ?></td>
					<td id="mjestoVjencanja<?= $dijete->id ?>"><?= $dijete->mjestoVjencanja ?></td>
					<td id="mjestoSmrti<?= $dijete->id ?>"><?= $dijete->mjestoSmrti ?></td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>