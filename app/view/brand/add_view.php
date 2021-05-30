<?php if(!defined('ROOT_PATH')) { exit('can not access'); } ?>

<div class="container-fluid">
 	<!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
      <?= $title; ?>
    </h1>
    <a href="?c=brand" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    	Lits brands 
    </a>
  </div>

  <?php if($error !== null): ?>
    <div class="row">
      <div class="col">
        <?php foreach($error as $item): ?>
          <p class="text-danger"><?= $item; ?></p>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <?php if($exist_name !== null): ?>
    <div class="row">
      <div class="col">
          <h5 class="text-danger"><?= $exist_name; ?></h5>
      </div>
    </div>
  <?php endif; ?>

  <div class="row my-3">
  	<div class="col-sm-12 col-lg-12 col-md-12">
  		<form action="?c=brand&m=handle" method="post" enctype="multipart/form-data">
  			<div class="form-group">
  				<label> Name </label>
  				<input type="text" name="nameBrand" class="form-control" />
  			</div>
  			<div class="form-group">
  				<label> Address </label>
  				<input type="text" name="addBrand" class="form-control" />
  			</div>
  			<div class="form-group">
  				<label> Logo </label>
  				<input type="file" name="logoBrand" class="form-control" />
  			</div>
  			<div class="form-group">
  				<label> Description </label>
  				<textarea rows="8" name="descriptionBrand" class="form-control"></textarea>
  			</div>
  			<button type="submit" name="btnAddBrand" class="btn btn-primary"> Add </button>
  		</form>
  	</div>
  </div>
</div>