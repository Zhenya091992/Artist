<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin data table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="adminAlbums.php">Albums <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Photo <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="index.php">
            <button class="btn btn-outline-success my-2 my-sm-0" name="exit" type="submit" >Sign out</button>
        </form>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col mt-1">
            <button class="btn btn-success mb-1" data-toggle="modal" data-target="#Modal"><i class="fa fa-plus"></i></button>
            <table class="table shadow ">
                <thead class="thead-dark">
                <tr>
                    <th>№</th>
                    <th>Name photo</th>
                    <th>Name file</th>
                    <th>action</th>
                </tr>
                <?php
                foreach ($this->data['admin'] as $data) {
                    echo '<tr>';
                    foreach ($data as $cell) {
                        echo '<td>' . $cell . '</td>';
                    }
                    ?>
                    <td>
                        <a href="?edit= <?php echo $data[0]; ?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal<?php echo $data[0]; ?>"><i class="fa fa-edit"></i></a>
                        <a href="?delete= <?php echo $data[0]; ?>" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $data[0]; ?>"><i class="fa fa-trash"></i></a>
                        <?php require 'modalPhoto.php'; ?>
                    </td>
                    </tr>
                    <?php
                }
                ?>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="Modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="adminPhoto.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control" name="namePhoto" value="" placeholder="namePhoto">
                        <input type="file" name="file" multiple accept=".jpg,.jpeg,.png,.gif">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
</body>
</html>
