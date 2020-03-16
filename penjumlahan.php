<?php

$koneksi = mysqli_connect("localhost","root","","nilai");

if (mysqli_connect_errno()){
echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title >Penjumlahan beruntun</title><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body class="container-sm shadow-lg p-3 mb-5 bg-white rounded bg-light"> 
	<div class="container">
		<h2>Penjumlahan Beruntun</h2> 
	</div>
	<br>
	<form class="container" name="form-1" method="POST">
		<table class="table">
			<tr>
				<td>Nilai 1</td>
				<td>:</td>
				<td><input type="number" name="a"></td>
			</tr>
			<tr>
				<td>Nilai 2</td>
				<td>:</td>
				<td><input type="number" name="b"></td>
			</tr>
			<tr align="right">
				<td colspan="3">
				<input class ="btn btn-success" type="submit" name="submit" value="Hitung">
				<input class ="btn btn-danger" type="submit" name="reset" value="Hapus">
				</td>
			</tr>
		<?php
		if(isset($_POST['submit'])){
			$a=$_POST['a'];
			$b=$_POST['b'];
			$c=$a+$b;

			if($c<=0){
					$keterangan='D';
				} elseif($c>>0&&$c<=10){
					$keterangan='A';
				}elseif($c>>10&&$c>=20) {
					$keterangan='B';

				} elseif($c>>20) {
					$keterangan='C';

				}
			$sql = mysqli_query($koneksi, "INSERT INTO tb_nilai (nilai_a, nilai_b, nilai_c,nilai_keterangan) VALUES('$a', '$b', '$c','$keterangan')") or die(mysqli_error($koneksi));
			for($i=0;$i<=9;$i++){
				$a=$b;
				$b=$c;
				$c=$a+$b;
				if($c<=0){
					$keterangan='D';
				} elseif($c>>0&&$c<=10){
					$keterangan='A';
				}elseif($c>>10&&$c>=20) {
					$keterangan='B';

				} elseif($c>>20) {
					$keterangan='C';

				}
				$sql = mysqli_query($koneksi, "INSERT INTO tb_nilai (nilai_a, nilai_b, nilai_c,nilai_keterangan) VALUES('$a', '$b', '$c','$keterangan')") or die(mysqli_error($koneksi));

			}
			/*$sql = mysqli_query($koneksi, "INSERT INTO tb_nilai (nilai_a, nilai_b, nilai_c,nilai_keterangan) VALUES('$a', '$b', '$c','$keterangan')") or die(mysqli_error($koneksi));*/
//			echo "<br><input type='text' value=$c>";
			echo "<script>alert('Hasil akhir adalah $c');</script>";
		}
		if (isset($_POST["reset"])) {
			$sql = mysqli_query($koneksi, "TRUNCATE tb_nilai") or die(mysqli_error($koneksi));
			echo "<script>alert('Berhasil dihapus!');</script>";
		}

		?>
		</table>
	</form>
	<br>
	<table class="table table-striped table-bordered" border="1px">

		<thead class="thead-dark">
		<tr>
			<td>ID</td>
			<td>Nilai 1</td>
			<td>Nilai 2</td>
			<td>Hasil Penjumlahan</td>
			<td>Keterangan</td>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = mysqli_query($koneksi, "Select * from tb_nilai");
		if(mysqli_num_rows($sql) > 0){
			$no = 1;
			while($data = mysqli_fetch_assoc($sql)){
				echo '
				<tr>
				<td>'.$no.'</td>
				<td>'.$data['nilai_a'].'</td>
				<td>'.$data['nilai_b'].'</td>
				<td>'.$data['nilai_c'].'</td>
				<td>'.$data['nilai_keterangan'].'</td>
				
				</tr>
				';

				$no++;
				}
				//jika query menghasilkan nilai 0
				}else{
				echo '
				<tr>
				<td colspan="5">Tidak ada data.</td>
				</tr>
				';
				}
			
		?>
	</tbody>
	</table>

</body>
</html>
