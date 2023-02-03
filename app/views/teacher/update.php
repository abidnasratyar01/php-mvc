<div class="container">
    <br>
        <div class="row justify-content-between">
            <div class="col-4">
                <div><h1>Update Teacher Record:</h1></div>
            </div>
            <div class="col-4">
                <div> <button class="btn btn-secondary" type="button" onclick="location.href='/controller=teacher&action=listdata'">Back</button></div>
            </div>
        </div>
    <br>
</div>
<div class="container">
    <form action="" method="post" >
        <input type="hidden" name="id" class="form-control" value="<?= $data['id'] ?>">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?= $data['first_name'] ?>" >
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?= $data['last_name'] ?>">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label>Father Name</label>
            <input type="text" name="father_name" class="form-control" value="<?= $data['father_name'] ?>">
        </div>
        <div class="mb-3">
            <label>Dept.:</label>
            <input type="text" name="dept" class="form-control" value="<?= $data['dept'] ?>">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>">
        </div>
        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="<?= $data['dob'] ?>">
        </div>
        <div class="mb-3">
            <label>Phone Number</label>
            <input type="tel" name="pnumber" class="form-control" value="<?= $data['pnumber'] ?>">
        </div>
        <input type="hidden" name="update" class="form-control" value="Update">
        <button type="submit" class="btn btn-primary" onclick="location.href='/controller=teacher&action=listdata'">Cancel</button>
        <button type="submit" class="btn btn-primary" onclick="location.href='/controller=teacher&action=update'">Submit</button>
    </form>
</div>
