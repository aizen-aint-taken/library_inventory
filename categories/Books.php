<?php
include("../config/conn.php");
$books = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ely Gian Ga">
    <meta name="description" content="System">
    <title>Book Inventory</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-container {
            display: none;
        }

        @media (max-width: 768px) {
            table {
                display: none;
            }

            .card-container {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Add Book Button -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success" data-toggle="modal" data-target="#addBookModal">Add Book</button>
        </div>

        <!-- Search Bar -->
        <div class="d-flex justify-content-center my-3">
            <div class="input-group w-50">
                <input type="search" data-name="books" id="Search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <button type="button" class="btn btn-outline-primary">Search</button>
            </div>
        </div>

        <!-- Table POV dako na screeen -->
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Genre</th>
                    <th>Published Date</th>
                    <th>Language</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= htmlspecialchars($book['BookID']) ?></td>
                        <td><?= htmlspecialchars($book['Title']) ?></td>
                        <td><?= htmlspecialchars($book['Author']) ?></td>
                        <td><?= htmlspecialchars($book['Publisher']) ?></td>
                        <td><?= htmlspecialchars($book['Genre']) ?></td>
                        <td><?= htmlspecialchars($book['PublishedDate']) ?></td>
                        <td><?= htmlspecialchars($book['Language']) ?></td>
                        <td><?= htmlspecialchars($book['Stock']) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editBookModal"
                                data-id="<?= htmlspecialchars($book['BookID']) ?>"
                                data-title="<?= htmlspecialchars($book['Title']) ?>"
                                data-author="<?= htmlspecialchars($book['Author']) ?>"
                                data-publisher="<?= htmlspecialchars($book['Publisher']) ?>"
                                data-genre="<?= htmlspecialchars($book['Genre']) ?>"
                                data-published="<?= htmlspecialchars($book['PublishedDate']) ?>"
                                data-language="<?= htmlspecialchars($book['Language']) ?>"
                                data-stock="<?= htmlspecialchars($book['Stock']) ?>">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?= htmlspecialchars($book['BookID']) ?>"
                                data-toggle="modal" data-target="#deleteBookModal">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Card View Cellphone gamay na screen -->
        <div class="card-container text-center">
            <?php foreach ($books as $book): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= htmlspecialchars($book['Title']) ?></h5>
                        <p class="card-text">
                            <strong>Author:</strong> <?= htmlspecialchars($book['Author']) ?><br>
                            <strong>Publisher:</strong> <?= htmlspecialchars($book['Publisher']) ?><br>
                            <strong>Genre:</strong> <?= htmlspecialchars($book['Genre']) ?><br>
                            <strong>Published Date:</strong> <?= htmlspecialchars($book['PublishedDate']) ?><br>
                            <strong>Language:</strong> <?= htmlspecialchars($book['Language']) ?><br>
                            <strong>Stock:</strong> <?= htmlspecialchars($book['Stock']) ?>
                        </p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editBookModal"
                                data-id="<?= htmlspecialchars($book['BookID']) ?>"
                                data-title="<?= htmlspecialchars($book['Title']) ?>"
                                data-author="<?= htmlspecialchars($book['Author']) ?>"
                                data-publisher="<?= htmlspecialchars($book['Publisher']) ?>"
                                data-genre="<?= htmlspecialchars($book['Genre']) ?>"
                                data-published="<?= htmlspecialchars($book['PublishedDate']) ?>"
                                data-language="<?= htmlspecialchars($book['Language']) ?>"
                                data-stock="<?= htmlspecialchars($book['Stock']) ?>">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?= htmlspecialchars($book['BookID']) ?>"
                                data-toggle="modal" data-target="#deleteBookModal">Delete</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modals -->
    <!-- Add Book Modal -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../BooksCrud/Add.php" method="POST">
                        <div class="form-group">
                            <label for="addBookTitle">Title</label>
                            <input type="text" class="form-control" name="title" id="addBookTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="addBookAuthor">Author</label>
                            <input type="text" class="form-control" name="author" id="addBookAuthor" required>
                        </div>
                        <div class="form-group">
                            <label for="addBookPublisher">Publisher</label>
                            <input type="text" class="form-control" name="publisher" id="addBookPublisher" required>
                        </div>
                        <div class="form-group">
                            <label for="addBookGenre">Genre</label>
                            <input type="text" class="form-control" name="genre" id="addBookGenre" required>
                        </div>
                        <div class="form-group">
                            <label for="addBookPublishedDate">Published Date</label>
                            <input type="date" class="form-control" name="published_date" id="addBookPublishedDate" required>
                        </div>
                        <div class="form-group">
                            <label for="addBookLanguage">Language</label>
                            <input type="text" class="form-control" name="language" id="addBookLanguage" required>
                        </div>
                        <div class="form-group">
                            <label for="addBookStock">Stock</label>
                            <input type="number" class="form-control" name="stock" id="addBookStock" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Book Modal -->
    <div class="modal fade" id="deleteBookModal" tabindex="-1" aria-labelledby="deleteBookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBookModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this book?
                </div>
                <div class="modal-footer">
                    <form action="../BooksCrud/Delete.php" method="POST">
                        <input type="hidden" name="deleteBook" id="deleteBookId" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Edit Book Modal -->
    <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../BooksCrud/Edit.php" method="POST">
                        <input type="hidden" name="editBook" value="1">
                        <input type="hidden" name="id" id="editBookId">
                        <div class="form-group">
                            <label for="editBookTitle">Title</label>
                            <input type="text" class="form-control" name="title" id="editBookTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="editBookAuthor">Author</label>
                            <input type="text" class="form-control" name="author" id="editBookAuthor" required>
                        </div>
                        <div class="form-group">
                            <label for="editBookPublisher">Publisher</label>
                            <input type="text" class="form-control" name="publisher" id="editBookPublisher" required>
                        </div>
                        <div class="form-group">
                            <label for="editBookGenre">Genre</label>
                            <input type="text" class="form-control" name="genre" id="editBookGenre" required>
                        </div>
                        <div class="form-group">
                            <label for="editBookPublishedDate">Published Date</label>
                            <input type="date" class="form-control" name="published_date" id="editBookPublishedDate" required>
                        </div>
                        <div class="form-group">
                            <label for="editBookLanguage">Language</label>
                            <input type="text" class="form-control" name="language" id="editBookLanguage" required>
                        </div>
                        <div class="form-group">
                            <label for="editBookStock">Stock</label>
                            <input type="number" class="form-control" name="stock" id="editBookStock" required>
                        </div>
                        <button type="submit" name="addBook" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/assets/js/Books.js"></script>
</body>

</html>