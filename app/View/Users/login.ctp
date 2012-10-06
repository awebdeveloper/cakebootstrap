<?php $this->layout = 'admin_blank'; ?>
<style type="text/css">
	
</style>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">Admin</a>
			<ul class="nav pull-right">
				<li class="">
					<a href="#"><i class="icon-chevron-left"></i> Main Site</a>
				</li>
			</ul>	
		</div> 	
	</div> 	
</div> 
<div class="container">
	<div class="login-container">
		<div class="header">
			<h3>Login</h3>
		</div>
		<div class="content clearfix">
				<?php   echo $this -> Form -> create('User', array( 'inputDefaults' => $inputDefaults));	?>
				<fieldset>
					<p>
						<?php echo $this->Session->flash('auth'); ?>
					</p>
					<div class="control-group">
						<label class="control-label" for="username">Username <span class="red">*</span> </label>
						<?php   echo $this -> Form -> input('User.username', array('required' 	=> 'required'));	?>
					</div>
					<div class="control-group">
						<label class="control-label" for="password">Password <span class="red">*</span></label>
						<?php   echo $this -> Form -> input('User.password', array('required' 	=> 'required'));	?>
					</div>
				</fieldset>
				
				<div class="pull-left">
					<?php   echo $this -> Html -> link(__('Forgot Your Password'), array('action' => 'forgotpassword'));?>
				</div>
				
				<div class="pull-right">
					<button type="submit" class="btn btn-warning btn-large">
						Login
					</button>
				</div>
			<?php echo $this -> Form -> end();?>
		</div>
	</div>

</div>

