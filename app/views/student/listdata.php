<div class="container">
    <br>
    <div class="row justify-content-between">
        <div class="col-4">
            <div><h1>Students Registered:</h1></div>
        </div>
        <div class="col-4">
            <div> <button class="btn btn-secondary" type="button" onclick="location.href='/controller=student'">Back</button></div>
        </div>
    </div>
    <br>
</div>
<div class="container">
    <br>
    <table class="table table-hover table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">StudentID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Father Name</th>
            <th scope="col">Department</th>
            <th scope="col">Email Address</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Contact Number</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                foreach($data as $count=>$record):
                $num++; ?>  
            <tr>
                <td scope='row'><?= $num ?></td>
                    <?php foreach($record as $key=>$value): ?>
                <td><?= $record[$key]?></td>
                    <?php endforeach; ?>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <form method="post" action="/controller=student&action=delete">
                            <input type="hidden" name="id" class="form-control" value="<?= $record['id']?>">
                            <button type="submit" class="btn btn-danger">Delete</button>          
                        </form>
                        <form method="post" action="/controller=student&action=update">
                            <input type="hidden" name="id" class="form-control" value="<?= $record['id'] ?>">
                            <input type="hidden" name="first_name" class="form-control" value="<?= $record['first_name'] ?>">
                            <input type="hidden" name="last_name" class="form-control" value="<?= $record['last_name'] ?>">
                            <input type="hidden" name="father_name" class="form-control" value="<?= $record['father_name'] ?>">
                            <input type="hidden" name="dept" class="form-control" value="<?= $record['dept'] ?>">
                            <input type="hidden" name="email" class="form-control" value="<?= $record['email'] ?>">
                            <input type="hidden" name="dob" class="form-control" value="<?= $record['dob'] ?>">
                            <input type="hidden" name="pnumber" class="form-control" value="<?= $record['pnumber'] ?>">
                            <button type="submit" class="btn btn-primary">Update</button> 
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
