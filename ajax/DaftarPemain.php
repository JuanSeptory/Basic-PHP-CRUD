<?php 
require '../Functions.php';

//simulasi loading
usleep(50000);

$keyword = $_GET["keyword"];

$query =  "SELECT * FROM daftar_pemain WHERE
			Nama LIKE '%$keyword%' OR 
			Age LIKE '%$keyword%' OR
			Club LIKE '%$keyword%'

	";

$daftar_pemain  = query($query);




?>
<table border="1" cellpadding="10" cellspacing="0">

	<tr>
		<th>Aksi</th>
		<th>No.</th>	
		<th>Name</th>
		<th>Age</th>
		<th>Club</th>
		<th>Image</th>
	</tr>


	<?php $i= 1; ?>
	<?php foreach ($daftar_pemain as $row) : ?>
		
	
			<tr>
				
					<td>
						<a href="update.php?Id= <?php echo $row ["Id"]; ?>">ubah</a>
						<a href="hapus data.php?Id= <?php echo $row["Id"]; ?>" onclick = "return confirm ('yakin?'); ">hapus</a>
					</td>

					<td><?php echo $row["Id"]; ?></td>
					<td><?php echo $row["Nama"]; ?></td>
					<td><?php echo $row["Age"]; ?></td>
					<td><?php echo $row["Club"]; ?></td>
					<td><img src ="image/<?php echo $row["Gambar"]; ?>" width = "50"></td>


			</tr>

	<?php $i++; ?>
	<?php endforeach; ?>



</table>