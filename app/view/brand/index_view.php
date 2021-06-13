<?php if(!defined('ROOT_PATH')) { exit('can not access'); } ?>

<div class="container-fluid">
 	<!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        <?= $title; ?>
      </h1>

      <!-- Topbar Search -->
      <form class="d-none d-sm-inline-block form-inline ml-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
          <input
            type="text"
            class="form-control bg-light border-0 small"
            placeholder="Search for..."
            aria-label="Search"
            aria-describedby="basic-addon2"
            id="nameBrand"
            value="<?= htmlentities($keyword); ?>"
          />
          <div class="input-group-append">
            <button onClick="searchBrand();" class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>

      <a href="?c=brand&m=add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      	<i class="fas fa-download fa-sm text-white-50"></i> 
      	 Add brand
      </a>
  </div>
   <div class="row">
   	<div class="col-sm-12 col-xl-12 col-md-12 col-lg-12 mb-4">
   		<table class="table">
        <thead>
          <tr>
            <th> ID </th>
            <th> Name </th>
            <th> Address </th>
            <th width="20%"> Logo </th>
            <th> Description </th>
            <th colspan="2" width="10%" class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($brands as $key => $item): ?>
            <tr id="brand_<?= $item['id']; ?>">
              <td><?= $item['id']; ?></td>
              <td><?= $item['name']; ?></td>
              <td><?= $item['address']; ?></td>
              <td>
                <img src="<?= PATH_UPLOAD_FILE. $item['logo']; ?>" class="img-fluid img-thumbnail" />
              </td>
              <td>
                <p><?= $item['description']; ?></p>
              </td>
              <td>
                <a class="btn btn-info" href="?c=brand&m=edit&id=<?= $item['id']; ?>"> Edit</a>
              </td>
              <td>
                <button id="del_<?= $item['id']; ?>" onClick="deleteBrand(<?= $item['id']; ?>);" type="button" class="btn btn-danger"> Delete</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
   	</div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-xl-12 col-md-12 col-lg-12 mb-4">
      <?= $pagination; ?>
    </div>
  </div>
</div>