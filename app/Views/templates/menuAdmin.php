<table>
		<tr>
			<td valign="top">
				<h2 class="text-center"><?= $nombre ?></h2>
				<table>
					<tr>
						<th>
							Administracion
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/bbdd') ?>">BBDD</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/municipios') ?>">Insertar Municipio</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/encuentros') ?>">Insertar Encuentro</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/contactos') ?>">Insertar Contactos</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="gestionar_carteles.php">Insertar Carteles</a>
						</td>
					</tr>
					
					<tr>
						<th>
							Consultas
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/visitas') ?>">Comprobar visitas</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/paginas') ?>">Comprobar p&aacute;ginas vistas</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/correo') ?>">Comprobar correo</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/info') ?>">PHP Info</a>
						</td>
					</tr>
					
					<tr>
						<th>
							Privado
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/cambio') ?>">Cambio contrase&ntilde;a</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="salir.php">Salir</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	Contador: <?= $contador['Contador'] ?>