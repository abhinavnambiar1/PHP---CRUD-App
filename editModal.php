<?php 

include './db.php';

if(isset($_POST["hidden"])){
    $title = $_POST["edittitle"];
    $desc = $_POST["editdesc"];
    $id = $_POST['hidden'];
    $sql = "UPDATE `notes` SET `sno`='$id',`title`='$title',`description`='$desc' WHERE `sno`='$id'";
    $res = mysqli_query($con, $sql);
}

echo '<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST">
            <input type="hidden" name="hidden" id="hidden">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edittitle" placeholder="Enter Title..." name="edittitle">
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea class="form-control" id="editdesc" rows="3" placeholder="Enter Description..." name="editdesc"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Update Note</button>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>';

?>