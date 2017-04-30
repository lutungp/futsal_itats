

<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="index.html">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">Tables</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span>Datatables</span>
			</li>
		</ul>
		<div class="page-toolbar">
			<div class="btn-group pull-right">
				<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li>
						<a href="#">
							<i class="icon-bell"></i> Action</a>
					</li>
					<li>
						<a href="#">
							<i class="icon-shield"></i> Another action</a>
					</li>
					<li>
						<a href="#">
							<i class="icon-user"></i> Something else here</a>
					</li>
					<li class="divider"> </li>
					<li>
						<a href="#">
							<i class="icon-bag"></i> Separated link</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	  <div class="row">
			<div class="col-md-12">
				<div class="portlet light bordered">
						<div class="portlet-body">
							<table id="datatable_1" class="table table-striped table-bordered table-hover dt-responsive" width="100%">
									<thead>
										<tr>
										  <th class="text-center" style="width:5%;">No.</th>
										  <th class="text-center">Item Name</th>
										  <th class="text-center">Item Price</th>
										  <th class="text-center">Item Qty</th>
										  <th class="text-center">Config.</th>
										</tr>
										</thead>
										<tbody>
										  <?php
										  $no = 1;
										  foreach ($items->result() as $row) {?>
											<tr>
											  <td><?php echo $no?></td>
											  <td><?php echo $row->item_name?></td>
											  <td class="text-center"></td>
											  <td class="text-center"></td>
											  <td class="text-center">
												<a href="<?php echo base_url('Item_c/edit_item/'.$row->item_id)?>" class="btn btn-success">
												  <i class="fa fa-edit"></i> Edit
												</a>
												<a href="javascript:void(0)" class="btn btn-danger"
												onclick="confirm_delete(<?php echo $row->item_id?>, 'Item_c/delete_item/')">
												  <i class="fa fa-trash-o"></i> Delete
												</a>
											  </td>
											</tr>
										  <?$no++;}?>
									  </tbody>
									  <tfoot>
										<tr>
										  <td colspan="5">
											<a href="<?php echo base_url($action)?>" class="btn btn-primary">
											  Tambah Item
											</a>
										  </td>
										</tr>
									  </tfoot>
							</table>
						</div>
					</div>
		</div>
	  </div>
