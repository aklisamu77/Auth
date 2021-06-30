<?php
$categories = get_categories();
   foreach($categories as $key => $value){
    
        $categories[$key]['childs'] = get_categories(' = '.$value['ID']);
   }
   
?>
<style>
    .cat_actions{
        visibility: hidden;
    }
    table.categoreis tr:hover .cat_actions{
        visibility: visible;
    }
</style>
<h3>Categories</h3>

<table class="table table-striped categoreis">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($categories)
        foreach($categories as $parentcat){ ?>
            <tr>
                <th scope="row"><?=$parentcat['ID']?></th>
                <td><?=$parentcat['name']?></td>
                <td><?=$parentcat['description']?></td>
                <td>
                    <div class="cat_actions">
                        <a type="button" href="./profile?view=add_category&id=<?=$parentcat['ID']?>" class="btn btn-success btn-sm " style="color:#fff">Edit</a>
					<button type="button" class="btn btn-danger btn-sm remove-cat" data-class="<?=$parentcat['ID']?>">Delete</button>
				
                    </div>
                </td>
              </tr>
                <?php
    if ($parentcat['childs'])
        foreach($parentcat['childs'] as $childcat){ ?>
            <tr>
                <th scope="row"><?=$childcat['ID']?></th>
                <td> -- -- <?=$childcat['name']?></td>
                <td><?=$childcat['description']?></td>
                <td>
                    <div class="cat_actions">
                        <a type="button" href="./profile?view=add_category&id=<?=$childcat['ID']?>" class="btn btn-success btn-sm " style="color:#fff">Edit</a>
					<button type="button" class="btn btn-danger btn-sm remove-cat" data-class="<?=$childcat['ID']?>">Delete</button>
				
                    </div>
                </td>
              </tr>
            
        <?php } ?>
    <?php } ?>
    
    
  </tbody>
</table>