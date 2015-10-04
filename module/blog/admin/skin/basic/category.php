<?php if(!defined('GR_BOARD_2')) exit(); ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><strong>Category management</strong></h3>
	</div>
	<div class="panel-body">
		
		<form id="blogConfigForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/blog/admin">
			<div class="hiddenInputs">
				<input type="hidden" name="blogCategorySave" value="true" />
				<input type="hidden" name="blogCategoryAction" value="add" />
				<input type="hidden" name="categoryTarget" value="" />
				<input type="hidden" name="categoryIndex" value="" />
				<input type="hidden" name="categoryName" value="" />
			</div>
			
			<div class="form-group">
				<div class="col-md-2">
					<input type="text" name="addIndex" class="form-control" maxlength="10" placeholder="Order index" title="<?php echo $lang['category_add_index']; ?>" value="0" />
				</div>
				<div class="col-md-8">
					<input type="text" name="addName" class="form-control" maxlength="250" placeholder="Category name" title="<?php echo $lang['category_add_name']; ?>" />
				</div>	
				<div class="col-md-2 text-center">
					<button class="btn btn-primary add-category">Add</button>
				</div>
			</div>
		
			<?php if(count($oldCategory) > 0): foreach($oldCategory as &$category): ?>
			
			<div class="form-group">
				<div class="col-md-2">
					<input type="text" id="index_<?php echo $category['uid']; ?>" required="true" class="form-control" maxlength="10" 
						value="<?php echo $category['id']; ?>" placeholder="Order index" title="<?php echo $lang['category_add_index']; ?>"  /> 
				</div>
				<div class="col-md-7">
					<input type="text" id="name_<?php echo $category['uid']; ?>" required="true" class="form-control" maxlength="250" 
						value="<?php echo stripslashes($category['name']); ?>" placeholder="Category name" title="<?php echo $lang['category_add_name']; ?>" />
				</div>
				<div class="col-md-3 text-center">
					<button class="btn btn-sm btn-primary update-category" rel="<?php echo $category['uid']; ?>">Update</button>
					<button class="btn btn-sm btn-danger delete-category" rel="<?php echo $category['uid']; ?>">Delete</button>
				</div>	
			</div>	
			
			<?php endforeach; endif; ?>
		
		</form>

	</div>
</div>