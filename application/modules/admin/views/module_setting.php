<?php foreach($css_files as $file): ?>
   <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
   <?php endforeach; ?>

<?php foreach($js_files as $file): ?>
   <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?> 

<style>
	#bonus{

		width:120px;
	}
</style>

<div class="row-fluid">
	<div class="span12">
                     			<?php echo $output; ?>
                     		
					</div>
</div>