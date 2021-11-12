<!-- Modal Edit-->
<div class="modal fade" id="editModal<?php echo $data[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit № <?php echo $data[0]; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="?id=<?php echo $data[0]; ?>" method="post">
        	<div class="form-group">
        		<input type="text" class="form-control" name="editNameAlbum" value="<?php echo$data[1] ?>">
        	</div>
        	<div class="form-group">
        		<input type="date" class="form-control" name="editDateRelise" value="<?php echo$data[2] ?>">
        	</div>
        	<div class="modal-footer">
        		<button type="submit" name="editAlbum" class="btn btn-primary">Edit</button>
        	</div>
        </form>	
      </div>
    </div>
  </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal<?php echo $data[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Удалить запись № <?php echo $data[0]; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <form action="?id=<?php echo $data[0]; ?>" method="post">
        	<button type="submit" name="deleteAlbum" class="btn btn-danger">Удалить</button>
    	</form>
      </div>
    </div>
  </div>
</div>
