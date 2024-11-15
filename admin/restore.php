<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Student Assistants</h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Bin</li>
    </ol>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Deleted Student Assistant</h4>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Program</th>
                                <th>Year</th>
                                <th>Work In</th>
                                <th>Restore</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM student_assistant WHERE status = 2 ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                            ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['last_name']; ?></td>
                                        <td><?= $row['first_name']; ?></td>
                                        <td><?= $row['program']; ?></td>
                                        <td><?= $row['year']; ?></td>
                                        <td><?= $row['work']; ?></td>
                                        <td>
                                            <button type="button" name="restore_btn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#restoreModal" data-id="<?= $row['id']; ?>" data-name="<?= htmlspecialchars($row['last_name'] . ' ' . $row['first_name']); ?>">Restore</button>
                                        </td>



                                    <?php

                                }
                            } else {

                                    ?>
                                    <tr>
                                        <td colspan="6">No Record Found</td>
                                    </tr>
                                <?php
                            }
                                ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreModalLabel">Confirm Restore</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"><span id="studentName"></span>?
            </div>
            <div class="modal-footer">
                <form action="code.php" method="POST" id="restoreForm">
                    <input type="hidden" name="restore_user" id="restoreUserId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Restore</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let restoreModal = document.getElementById('restoreModal');
    restoreModal.addEventListener('show.bs.modal', function(event) {
        let button = event.relatedTarget;
        let userId = button.getAttribute('data-id');
        let userName = button.getAttribute('data-name');
        let modalTitle = restoreModal.querySelector('.modal-title');
        let modalBody = restoreModal.querySelector('.modal-body #studentName');
        let restoreForm = document.getElementById('restoreForm');
        let restoreUserId = document.getElementById('restoreUserId');
        
        modalTitle.textContent = 'Confirm Restore';
        modalBody.textContent = 'Are you sure you want to restore ' + userName + '?';
        restoreUserId.value = userId;
    });
});
</script>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>