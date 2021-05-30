<?php if(!defined('ROOT_PATH')) { exit('can not access'); } ?>

<div class="container-fluid">
 	<!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        <?= $title; ?>
      </h1>
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
            <th> Logo </th>
            <th> Description </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($brands as $key => $item): ?>
            <tr>
              <td><?= $item['id']; ?></td>
              <td><?= $item['name']; ?></td>
              <td><?= $item['address']; ?></td>
              <td>
                <img src="<?= PATH_UPLOAD_FILE. $item['logo']; ?>" class="img-responsive" />
              </td>
              <td>
                <p><?= $item['description']; ?></p>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
   	</div>
  </div>
</div>