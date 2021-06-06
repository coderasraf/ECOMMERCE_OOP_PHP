<?php include 'inc/header.php';?>
<?php include 'classes/Cart.php'; ?>
<?php include 'helpers/Format.php'; ?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID.</th>
							<th>Date</th>
							<th>Product Name</th>
							<th>Image</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php 

							$cart = new Cart();
							$fm  = new Format();
							$getOrder = $cart->getAllOrder();
							if ($getOrder) {
								while ($result = $getOrder->fetch_assoc()){ ?>
							<tr class="even gradeC">
								<td><?= $result['cmrId']; ?></td>
								<td><?= $fm->formatDate($result['date']); ?> </td>
								<td><?= $result['productName']; ?> </td>
								<td>
									<img width="50px;" width="50px" src="<?= $result['image']; ?>" alt="">
								</td>
								<td><?= $result['quantity']; ?> </td>
								<td><?= $result['price']; ?> </td>
								<td><?= $result['address']; ?></td>
								<td>
								<?php
									if ($result['status'] == '0') {?>
									<a href="">Pending</a>
								<?php }else{?>
									<a href="">Shifted</a>
								<?php } ?>
								</td>
							</tr>
						<?php }} ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
