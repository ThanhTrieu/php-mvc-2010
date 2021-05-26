<?php if(!defined('ROOT_PATH')) { exit('can not access'); } ?>

<div class="container-fluid">
 	<!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        <?= $title; ?>
      </h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      	<i class="fas fa-download fa-sm text-white-50"></i> 
      	 Add brand
      </a>
  </div>
   <div class="row">
   	<div class="col-xl-3 col-md-6 mb-4">
   		<table class="table">
        <thead>
          <tr>
            <th> Name </th>
            <th> Address </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($brands as $key => $item): ?>
            <tr>
              <td><?= $item['name']; ?></td>
              <td><?= $item['address']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
   	</div>
  </div>
</div>