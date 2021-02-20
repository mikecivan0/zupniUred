<div class="row">
	<div class="large-12 columns">
		<div class="large-12 columns text_desno">
			<a href="#" data-reveal-id="noviClan" id="noviUkucanin"> 
				<img class="pb5" src="../img/dodaj.png" alt="dodaj"> 
			</a>
		</div>
		<table class="large-12 columns" style="border: black 1px solid;">
			<thead>
				<tr style="border-bottom: black 1px solid;">
					<th>Ime</th>
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
			<tbody id="tablicaUkucana">
				<?php foreach ($ukucani as $ukucan) { ?>
					
				<tr id="tr1Clan<?= $ukucan->id ?>">
					<td id="ime<?= $ukucan->id ?>" rowspan="2" style="border-bottom: black 1px solid;"><?= $ukucan->ime ?></td>
					<td><b>kada</b></td>
					<td id="datumRodjenja<?= $ukucan->id ?>"><?= Alati::datum($ukucan->datumRodjenja) ?></td>
					<td id="datumKrstenja<?= $ukucan->id ?>"><?= Alati::datum($ukucan->datumKrstenja) ?></td>
					<td id="datumPricesti<?= $ukucan->id ?>"><?= Alati::datum($ukucan->datumPricesti) ?></td>
					<td id="datumPotvrde<?= $ukucan->id ?>"><?= Alati::datum($ukucan->datumPotvrde) ?></td>
					<td id="datumVjencanja<?= $ukucan->id ?>"><?= Alati::datum($ukucan->datumVjencanja) ?></td>
					<td id="datumSmrti<?= $ukucan->id ?>"><?= Alati::datum($ukucan->datumSmrti) ?></td>
					<td rowspan="2" class="center" style="border-bottom: black 1px solid;">
						<a href="#" data-reveal-id="noviClan" class="bezDonjeCrte promijeni" id="<?= $ukucan->id ?>">
							<img src="../img/admin/pen.png" class="pr10">
						</a>
						<a href="#" class="obrisi" id="<?= $ukucan->id ?>">
							<img src="../img/admin/bin.png">
						</a>
					</td>		
				</tr>
				<tr id="tr2Clan<?= $ukucan->id ?>" style="border-bottom: black 1px solid;">
					<td><b>gdje</b></td>
					<td id="mjestoRodjenja<?= $ukucan->id ?>"><?= $ukucan->mjestoRodjenja ?></td>
					<td id="mjestoKrstenja<?= $ukucan->id ?>"><?= $ukucan->mjestoKrstenja ?></td>
					<td id="mjestoPricesti<?= $ukucan->id ?>"><?= $ukucan->mjestoPricesti ?></td>
					<td id="mjestoPotvrde<?= $ukucan->id ?>"><?= $ukucan->mjestoPotvrde ?></td>
					<td id="mjestoVjencanja<?= $ukucan->id ?>"><?= $ukucan->mjestoVjencanja ?></td>
					<td id="mjestoSmrti<?= $ukucan->id ?>"><?= $ukucan->mjestoSmrti ?></td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>