

<?php

	include_once('../includes/connection.php');
	include_once('../includes/user.php');
	include_once('../header.php');


	if(isset($_SESSION['logged_in']) && isset($_SESSION['id_role'])) {
	if($_SESSION['id_role'] == 1) {


	$user = new User();
	$users= $user->fetch_all();

	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		$user_data = $user->fetch_one($id);
	}

	if(isset($_POST['edit'])){
		$user_data = $user->fetch_one($_POST['user_id']);
		$id = htmlspecialchars($_POST['user_id']);
		$name = htmlspecialchars($_POST['user_name']);
		$email = htmlspecialchars($_POST['user_email']);
		if($_POST['user_password'] == ''){
			$password = $user_data['password_user'];
		}else{
			$password = md5($_POST['user_password']);
		}
		if($_POST['user_role'] == 0){
			$role = $user_data['id_role'];
		}else{
			$role = $_POST['user_role'];
		}
		$date = date('Y-m-d H:i:s');
		$query = $pdo->prepare("UPDATE users SET id_user  = ? , name_user = ? , password_user = ?, email_user = ?, id_role = ?, created_data = ?  WHERE id_user= ?");

		$query->bindValue(1, $id);
		$query->bindValue(2, $name);
		$query->bindValue(3, $password);
		$query->bindValue(4, $email);
		$query->bindValue(5, $role);
		$query->bindValue(6, $date);
		$query->bindValue(7, $id);

		$query->execute();
		header('Location: /admin/users.php');
	}
	if(isset($_GET['mod'])){
		$mod =  $_GET['mod'];
		if(isset($_POST['add']) && $mod=='add'){
			$name = htmlspecialchars($_POST['user_name']);
			$email = htmlspecialchars($_POST['user_email']);
			$password = md5(htmlspecialchars($_POST['user_password']));
			$role = $_POST['user_role'];
			$date = date('Y-m-d H:i:s');
			$query = $pdo->prepare("INSERT INTO users (name_user, password_user, email_user, id_role, created_data) VALUES  (:name, :password , :email, :role, :data)");

			$query->execute(['name' => $name, 'password' =>  $password, 'email' =>  $email, 'role' => $role, 'data' => $date]);
			header('Location: /admin/users.php');

		}
	}


?>

	<div class="container">
		<div class="row row-margin">
			<aside class="lg100 add_film">
				<h2>Users:</h2>
				<table class="table_users">
				  <tr>
				    <th>Id</th>
				    <th>Name</th>
				    <th>Email</th>
				    <th>Role</th>
				    <th>Delete</th>
				    <th>Edit</th>
				  </tr>
				  <?php foreach ($users as $user1) { ?>
				  <tr>
				    <td><?php echo $user1['id_user']; ?></td>
				    <td><?php echo $user1['name_user']; ?></td>
				    <td><?php echo $user1['email_user']; ?></td>
				    <td><?php echo $user1['name_role']; ?></td>
				    <td><form action='deleteUser.php' method="post">
				       		<input type="hidden" name="deleteId" value="<?php echo $user1['id_user']; ?>">
				       		<input class="delete_input_user" type="submit" name="submit" value="Delete">
				     	</form>
				    </td>
				    <td><form action='users.php' method="get">
				       		<input type="hidden" name="edit" value="<?php echo $user1['id_user']; ?>">
				       		<input class="edit_input_user" type="submit" value="Edit">
				     	</form>
				    </td>
				  </tr>
				  <?php } ?>
				</table>
			</aside>
		</div>
	</div>

	<?php if(isset($id)) {?>
	<div class="container">
		<div class="row row-margin">
			<aside class="lg100 edit_user add_film">
				<h2>Edit user:</h2>
				<form action='?mod=edit' method='post' enctype='multipart/form-data'>
					<div class="lg50 xs100 padding-15">
						<label>User name: </label>
						<input type='text' name='user_name' value="<?php echo $user_data['name_user']; ?>">
						<input type='hidden' name='user_id' value="<?php echo $user_data['id_user']; ?>">
					</div>
					<div class="lg50 xs100 padding-15">
						<label>User password: </label>
						<input type='text' name='user_password'>
					</div>
					<div class="lg50 xs100 padding-15">
						<label>User Email</label>
						<input type='email' name='user_email' value="<?php echo $user_data['email_user']; ?>">
					</div>
					<div class="lg50 xs100 padding-15">
						<label>Role</label>
						<select name='user_role'>
							  <option value='0'>Role</option>
							  <option value='1'>Admin</option>
							  <option value='2'>User</option>
							  <option value='3'>Moderator</option>
						 </select>
					</div>
					<input class="submit" type='submit' name='edit' value='Add'>
				</form>
			</aside>
		</div>
	</div>

	<?php } ?>
	<div class="container">
		<div class="row row-margin">
			<aside class="lg100 add_user add_film">
				<h2 class="buttonLink" onclick="showAddForm()">Add user &Xi;</h2>
				<form action='?mod=add' method='post' enctype='multipart/form-data' id="addForm">
					<div class="lg50 xs100 padding-15">
						<label>User name: </label>
						<input type='text' name='user_name' >
						<input type='hidden' name='user_id' >
					</div>
					<div class="lg50 xs100 padding-15">
						<label>User password: </label>
						<input type='text' name='user_password'>
					</div>
					<div class="lg50 xs100 padding-15">
						<label>User Email</label>
						<input type='email' name='user_email' >
					</div>
					<div class="lg50 xs100 padding-15">
						<label>Role</label>
						<select name='user_role'>
							  <option value='1'>Admin</option>
							  <option value='2'>User</option>
							  <option value='3'>Moderator</option>
						 </select>
					</div>
					<input class="submit" type='submit' name='add' value='Add'>
				</form>
			</aside>
		</div>
	</div>

	<script type="text/javascript">
		function showAddForm() {
	    	var form = document.getElementById("addForm");
	    	if(form.style.display === "block"){
	    		form.style.display = "none";
	    	}else{
	    		form.style.display = "block";
	    	}
	    }
	</script>


<?php }} ?>
