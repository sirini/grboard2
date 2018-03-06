<?php if(!defined('GR_BOARD_2')) exit(); ?>

<form id="blogConfigForm" method="post" class="form-horizontal" role="form" action="/<?php echo $grboard; ?>/blog/admin">
<div class="card">
	<h5 class="card-header">Category management</h5>
	<div class="card-body">
		<div class="hiddenInputs">
			<input type="hidden" name="blogCategorySave" value="true" />
			<input type="hidden" name="blogCategoryAction" value="add" />
			<input type="hidden" name="categoryTarget" value="" />
			<input type="hidden" name="categoryIndex" value="" />
			<input type="hidden" name="categoryName" value="" />
		</div>
		
		<div class="row">
			<div class="col">
                <div class="form-group">
                	<label for="addIndex" class="control-label">Category Index</label>
                	<input type="text" class="form-control" name="addIndex" id="addIndex" maxlength="10" value="0" />
                	<small class="form-text text-muted"><?php echo $lang['category_add_index']; ?></small>
                </div>
			</div>
			<div class="col">
                <div class="form-group">
                	<label for="addName" class="control-label">Category Name</label>
                	<input type="text" class="form-control" name="addName" id="addName" maxlength="250" value="" />
                	<small class="form-text text-muted"><?php echo $lang['category_add_name']; ?></small>
                </div>
			</div>
		</div>
		
        <div class="form-group">
        	<input type="submit" value="Submit" class="btn btn-primary btn-lg btn-block" />
        </div>            
	</div>
</div>
		
<div id="categoryLists">
	<?php if(count($oldCategory) > 0): foreach($oldCategory as &$category): ?>		
	<div class="card bg-light">	
		<div class="card-body">

    		<div class="row">
    			<div class="col-5">
                    <div class="form-group">
                    	<label for="addIndex" class="control-label">Category Index</label>
                    	<input id="index_<?php echo $category['uid']; ?>" type="text" class="form-control" name="index_<?php echo $category['uid']; ?>" maxlength="10" value="<?php echo $category['id']; ?>" />
                    	<small class="form-text text-muted"><?php echo $lang['category_add_index']; ?></small>
                    </div>
    			</div>
    			<div class="col-5">
                    <div class="form-group">
                    	<label for="addName" class="control-label">Category Name</label>
                    	<input id="name_<?php echo $category['uid']; ?>" type="text" class="form-control" name="name_<?php echo $category['uid']; ?>" maxlength="250" value="<?php echo stripslashes($category['name']); ?>" />
                    	<small class="form-text text-muted"><?php echo $lang['category_add_name']; ?></small>
                    </div>
    			</div>
    			<div class="col-2">
                    <div class="form-group">
            			<button class="btn btn-md btn-primary btn-block update-category" rel="<?php echo $category['uid']; ?>">Update</button>
            			<button class="btn btn-md btn-danger btn-block delete-category" rel="<?php echo $category['uid']; ?>">Delete</button>
                    </div>  
    			</div>
    		</div>
		</div>	
	</div>
	<?php endforeach; endif; ?>
</div>

</form>