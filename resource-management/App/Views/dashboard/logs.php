<div class="container mt-5">
        <h2>Logs d'activité</h2>
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
        </div>
        <table id="logsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Message</th>
                    <th>Email de l'utilisateur</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logsData as $log): ?>
                    <tr>
                        <td><?php echo $log['id']; ?></td>
                        <td><?php echo $log['date']; ?></td>
                        <td><?php echo $log['action']; ?></td>
                        <td><?php echo $log['message']; ?></td>
                        <td><?php echo $log['user_email']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#logsTable').DataTable();

            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
