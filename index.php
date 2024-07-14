<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Notes Making App</title>
    <style>
        .form {
            border: 2px solid #ced4da;
            padding: 1rem;
            border-radius: 8px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php include './navBar.php'; ?>
    <?php include './db.php'; ?>
    <?php include './editModal.php'; ?>

    <?php
    if (isset($_POST["submit"])) {
        if (!isset($_POST["hidden"])) {
            $title = $_POST["title"];
            $desc = $_POST["desc"];
            $sql = "INSERT INTO `notes`(`title`, `description`) VALUES ('$title','$desc')";
            $res = mysqli_query($con, $sql);
        }
    }
    ?>

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form class="form" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title..." name="title">
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea class="form-control" id="desc" rows="3" placeholder="Enter Description..." name="desc"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Add Note</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1>Your Notes</h1>
                <?php
                $sql = "SELECT * FROM `notes`";
                $res = mysqli_query($con, $sql);
                $noNotes = true;

                while ($fetch = mysqli_fetch_assoc($res)) {
                    $noNotes = false;
                    echo '<div class="card my-3">
                            <div class="card-body">
                              <h5 class="card-title">' . $fetch['title'] . '</h5>
                              <p class="card-text">' . $fetch['description'] . '</p>
                              <button type="button" class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#exampleModal" id="' . $fetch['sno'] . '">Edit</button>

                              <a href="./delete.php?id=' . $fetch['sno'] . '" class="btn btn-danger">Delete</a>
                            </div>
                            </div>';
                }

                if ($noNotes) {
                    echo '<div class="card my-3">
                            <div class="card-body">
                              <h5 class="card-title">Message: </h5>
                              <p class="card-text">No Notes are available for reading</p>
                            </div>
                            </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<script>
    const edit = document.querySelectorAll('.edit');
    const editTitle = document.getElementById('edittitle');
    const editDesc = document.getElementById('editdesc');
    const hiddenInput = document.getElementById("hidden");
    const cardBody = document.querySelectorAll('.card-body');

    edit.forEach(element => {
        element.addEventListener("click", () => {
            const titleText = element.parentElement.children[0].innerText;
            const descText = element.parentElement.children[1].innerText;
            editTitle.value = titleText;
            editDesc.value = descText;
            hiddenInput.value = element.id;
        });
    });

    const search =document.getElementById('search');
    search.addEventListener("input", () => {
        const value = search.value.toLowerCase();
        cardBody.forEach(element => {
            const titleText = element.children[0].innerText.toLowerCase();
            const descText = element.children[1].innerText.toLowerCase();
            if(titleText.includes(value) || descText.includes(value)){
                element.parentElement.style.display = 'block';
            }else{
                element.parentElement.style.display = 'none';
            }
        });
    });
</script>

</html>