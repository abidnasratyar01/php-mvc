<div class="container">
    <br>
    <div class="row justify-content-between">
        <div class="col-4">
            <div><h1>Update Course Record</h1></div>
        </div>
        <div class="col-4">
            <div> <button class="btn btn-secondary" type="button" onclick="location.href='/controller=course&action=listdata'">Back</button></div>
        </div>
    </div>
    <br>
</div>
<div class="container">
    <form action="" method="post" >
        <input type="hidden" name="id" class="form-control" value="<?= $data['id'] ?>">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?= $data['name'] ?>">
        </div>
        <div class="mb-3">
            <label>Dept</label>
            <input type="text" name="dept" class="form-control" value="<?= $data['dept'] ?>">
        </div>
        <input type="hidden" name="update" class="form-control" value="Update">
        <button class="btn btn-secondary" type="button" onclick="location.href='/controller=course&action=listdata'">Cancel</button>
        <button type="submit" class="btn btn-primary" onclick="location.href='/controller=course&action=update'">Update</button>
    </form>
</div>
