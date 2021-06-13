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

  <?php if(empty($infoBrand)): ?>
    <div class="row my-3">
      <div class="col-sm-12 col-lg-12 col-md-12">
        <h3> Not found data </h3>
      </div>
    </div>
  <?php else: ?>

    <!-- loi khi co tinh ko nhap du lieu ma doi update -->
    <?php if(!empty($messErrors)): ?>
      <div class="row my-3">
        <div class="col-sm-12 col-lg-12 col-md-12">
          <ul>
            <?php foreach($messErrors as $err): ?>
              <li class="text-danger"><?= $err; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endif; ?>

    <!-- loi khi update trung ten thuong hieu -->
    <?php if($status === 'exist'): ?>
      <div class="row my-3">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <h4 class="text-danger">Ten thuong hieu da ton tai</h4>
        </div>
      </div>
    <?php endif; ?>

    <!-- loi khi update khong thanh cong/ he thong code co van de -->
    <?php if($status === 'fail'): ?>
      <div class="row my-3">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <h4 class="text-danger">Co loi xay ra, vui long thu lai sau</h4>
        </div>
      </div>
    <?php endif; ?>

    <div class="row my-3">
      <div class="col-sm-12 col-lg-12 col-md-12">
        <form action="?c=brand&m=handleEdit&id=<?= $infoBrand['id']; ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label> Name </label>
            <input value="<?= $infoBrand['name']; ?>" type="text" name="nameBrand" class="form-control" />
          </div>
          <div class="form-group">
            <label> Address </label>
            <input value="<?= $infoBrand['address']; ?>" type="text" name="addBrand" class="form-control" />
          </div>

          <div class="form-group">
            <div class="mt-3">
              <img class="img-fluid img-thumbnail" src="<?= PATH_UPLOAD_FILE. $infoBrand['logo'] ?>" width="30%" height="30%" />
            </div>
            <label> Logo </label>
            <input type="file" name="logoBrand" class="form-control" />
          </div>

          <div class="form-group">
            <label> Description </label>
            <textarea rows="8" name="descriptionBrand" class="form-control"><?= $infoBrand['description']; ?></textarea>
          </div>
          <button type="submit" name="btnEditBrand" class="btn btn-primary"> Update </button>
        </form>
      </div>
    </div>
  <?php endif; ?>
</div>