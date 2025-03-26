<div class="container mt-5">
    <h2>Manage Projects<h2>

    <!-- Project Form -->
    <form id="projectForm">
    <input type="hidden" id="projectId">

    <div class="mb-3">
        <label for="projectName" class="form-label">Project Name</label>
        <input type="text" class="form-control" id="projectName" placeholder="Enter project name" required>
    </div>

    <div class="mb-3">
        <label for="projectDescription" class="form-label">Project Description</label>
        <textarea class="form-control" id="projectDescription" rows="3" placeholder="Enter project description" required></textarea>
    </div>

    <div class="mb-3">
        <label for="startDate" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="startDate" required>
    </div>

    <div class="mb-3">
        <label for="endDate" class="form-label">End Date</label>
        <input type="date" class="form-control" id="endDate">
    </div>

    <button type="submit" class="btn btn-primary" id="saveProjectBtn">Save Project</button>
    <button type="reset" class="btn btn-secondary" id="cancelEditBtn" style="display:none;">Cancel Edit</button>
    </form>

    <hr class="my-5">

    <!-- Projects Table -->
    <h4>Existing Projects</h4>
    <table class="table table-bordered" id="projectsTable">
        <thead class="table-light">
            <tr>
            <th>#</th>
            <th>Project Name</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Projects will be dynamically inserted here -->
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {

        let projectCount = 0;

        function resetForm() {
            $('#projectId').val('');
            $('#projectForm')[0].reset();
            $('#saveProjectBtn').text('Save Project');
            $('#cancelEditBtn').hide();
        }

        function appendProjectToTable(project) {
            projectCount++;
            $('#projectsTable tbody').append(`
                <tr data-id="${project.id}">
                    <td>${projectCount}</td>
                    <td>${project.name}</td>
                    <td>${project.description}</td>
                    <td>${project.start_date}</td>
                    <td>${project.end_date}</td>
                    <td>
                        <button class="btn btn-sm btn-warning editBtn">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
                    </td>
                </tr>
            `);
        }

        // Load existing projects from backend or use dummy data for testing
        function loadProjects() {
            // Dummy project data (comment/uncomment this block for testing)
            const dummyProjects = [
                {
                    id: 1,
                    name: 'Project Alpha',
                    description: 'Description for Project Alpha',
                    start_date: '2025-04-01',
                    end_date: '2025-06-30'
                },
                {
                    id: 2,
                    name: 'Project Beta',
                    description: 'Description for Project Beta',
                    start_date: '2025-05-15',
                    end_date: '2025-08-15'
                },
                {
                    id: 3,
                    name: 'Project Gamma',
                    description: 'Description for Project Gamma',
                    start_date: '2025-06-01',
                    end_date: '2025-09-01'
                }
            ];

            // Comment out the following AJAX call for using dummy data
            // $.ajax({
            //     url: 'ajax.project.php',
            //     method: 'GET',
            //     dataType: 'json',
            //     success: function(projects) {
            //         $('#projectsTable tbody').empty();
            //         projectCount = 0;
            //         $.each(projects, function(_, project) {
            //             appendProjectToTable(project);
            //         });
            //     }
            // });

            // Use the dummy data if needed
            $('#projectsTable tbody').empty();
            projectCount = 0;
            $.each(dummyProjects, function(_, project) {
                appendProjectToTable(project);
            });
        }

        loadProjects();

        // Save (Create/Update) project
        $('#projectForm').submit(function(e) {
            e.preventDefault();

            const id = $('#projectId').val();
            const projectData = {
                id: id,
                name: $('#projectName').val(),
                description: $('#projectDescription').val(),
                start_date: $('#startDate').val(),
                end_date: $('#endDate').val()
            };

            const ajaxUrl = id ? 'ajax.project.php?action=update' : 'ajax.project.php?action=create';

            $.ajax({
                url: ajaxUrl,
                method: 'POST',
                data: projectData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        loadProjects();
                        resetForm();
                    } else {
                        alert('Error: ' + response.message);
                    }
                }
            });
        });

        // Edit button
        $('#projectsTable').on('click', '.editBtn', function() {
            const row = $(this).closest('tr');
            const id = row.data('id');

            $.ajax({
                url: 'ajax.project.php',
                method: 'GET',
                data: { id: id },
                dataType: 'json',
                success: function(project) {
                    $('#projectId').val(project.id);
                    $('#projectName').val(project.name);
                    $('#projectDescription').val(project.description);
                    $('#startDate').val(project.start_date);
                    $('#endDate').val(project.end_date);
                    $('#saveProjectBtn').text('Update Project');
                    $('#cancelEditBtn').show();
                }
            });
        });

        // Delete button
        $('#projectsTable').on('click', '.deleteBtn', function() {
            const row = $(this).closest('tr');
            const id = row.data('id');

            if (confirm('Are you sure you want to delete this project?')) {
                $.ajax({
                    url: 'ajax.project.php?action=delete',
                    method: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            row.remove();
                            loadProjects();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    }
                });
            }
        });

        $('#cancelEditBtn').click(function() {
            resetForm();
        });

    });
</script>
