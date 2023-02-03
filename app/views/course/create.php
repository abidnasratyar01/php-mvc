<div class="container">
    <br>
    <div class="row justify-content-between">
        <div class="col-4">
            <div><h1>Add New Course</h1></div>
        </div>
        <div class="col-4">
            <div> <button class="btn btn-secondary" type="button" onclick="location.href='/controller=course'">Back</button></div>
        </div>
    </div>
    <br>
</div>
<div class="container">
    <form action="" method="post" >
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" >
        </div>
        <div class="mb-3">
            <label>Dept</label>
            <input type="text" name="dept" class="form-control" >
        </div>
        <button type="submit" class="btn btn-primary" onclick="location.href='/controller=course&action=add'">Submit</button>
    </form>
</div>


