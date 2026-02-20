<div class="container mt-5">
    <h2>Manage Projects</h2>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="projectTabs">
        <li class="nav-item">
            <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active-projects">Active Projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="archived-tab" data-bs-toggle="tab" href="#archived-projects">Archived Projects</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Active Projects Tab -->
        <div class="tab-pane fade show active" id="active-projects">
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

            <!-- Active Projects Table -->
            <h4>Active Projects</h4>
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
                    <!-- Active projects will be dynamically inserted here -->
                </tbody>
            </table>
        </div>

        <!-- Archived Projects Tab -->
        <div class="tab-pane fade" id="archived-projects">
            <div class="alert alert-info mb-4">
                <i class="fas fa-info-circle"></i> These projects have been archived and are no longer active.
            </div>
            
            <!-- Archived Projects Table -->
            <h4>Archived Projects</h4>
            <table class="table table-bordered" id="archivedProjectsTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Archived At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Archived projects will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Project Details -->
    <div class="modal fade" id="viewArchiveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="archiveModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Description:</strong> <span id="archiveModalDescription"></span></p>
                    <p><strong>Duration:</strong> <span id="archiveModalDuration"></span></p>
                    <p><strong>Archived By:</strong> <span id="archiveModalArchivedBy"></span></p>
                    <p><strong>Role:</strong> <span id="archiveModalRole"></span></p>
                    <p><strong>Archived On:</strong> <span id="archiveModalDate"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-tabs .nav-link {
        font-weight: 500;
        color: #495057;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        background-color: #fff;
        border-color: #dee2e6 #dee2e6 #fff;
    }
    #archivedProjectsTable th, #archivedProjectsTable td {
        vertical-align: middle;
    }
    #viewArchiveModal .modal-body p {
        margin-bottom: 1rem;
    }
    #viewArchiveModal .modal-body strong {
        display: inline-block;
        width: 120px;
    }
</style>

<script>
    $(document).ready(function() {
        // Load active projects
        function loadActiveProjects() {
            $.ajax({
                url: "{{ route('projects.index') }}",
                method: 'GET',
                beforeSend: function() {
                    $('#projectsTable tbody').html(`
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </td>
                        </tr>
                    `);
                },
                success: function(projects) {
                    $('#projectsTable tbody').empty();
                    if (projects.length === 0) {
                        $('#projectsTable tbody').append(`
                            <tr>
                                <td colspan="6" class="text-center text-muted">No active projects found</td>
                            </tr>
                        `);
                    } else {
                        projects.forEach((project, index) => {
                            $('#projectsTable tbody').append(`
                                <tr data-id="${project.id}">
                                    <td>${index + 1}</td>
                                    <td>${project.name}</td>
                                    <td>${project.description}</td>
                                    <td>${project.start_date}</td>
                                    <td>${project.end_date || 'N/A'}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning editBtn me-1">Edit</button>
                                        <button class="btn btn-sm btn-danger archiveBtn">Archive</button>
                                    </td>
                                </tr>
                            `);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading active projects:', error);
                    $('#projectsTable tbody').html(`
                        <tr>
                            <td colspan="6" class="text-center text-danger">
                                Failed to load projects. <br>
                                <small>${xhr.status} ${xhr.statusText}</small>
                            </td>
                        </tr>
                    `);
                }
            });
        }

        // Load archived projects
        function loadArchivedProjects() {
            $.ajax({
                url: "{{ route('projects.archived') }}",
                method: 'GET',
                beforeSend: function() {
                    $('#archivedProjectsTable tbody').html(`
                        <tr>
                            <td colspan="7" class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </td>
                        </tr>
                    `);
                },
                success: function(projects) {
                    $('#archivedProjectsTable tbody').empty();
                    
                    if (!projects || projects.length === 0) {
                        $('#archivedProjectsTable tbody').append(`
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No archived projects found
                                </td>
                            </tr>
                        `);
                        return;
                    }

                    projects.forEach((project, index) => {
                        $('#archivedProjectsTable tbody').append(`
                            <tr data-id="${project.id}">
                                <td>${index + 1}</td>
                                <td>${project.name}</td>
                                <td>${project.description.substring(0, 50)}...</td>
                                <td>${project.start_date}</td>
                                <td>${project.end_date || 'N/A'}</td>
                                <td>${new Date(project.archived_at).toLocaleString()}</td>
                                <td>
                                    <button class="btn btn-sm btn-info viewBtn me-1">View</button>
                                    <button class="btn btn-sm btn-success restoreBtn">Restore</button>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function(xhr) {
                    console.error('Error loading archived projects:', xhr);
                    let errorMsg = 'Error loading archived projects';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMsg += ': ' + xhr.responseJSON.error;
                    }
                    $('#archivedProjectsTable tbody').html(`
                        <tr>
                            <td colspan="7" class="text-center text-danger">
                                ${errorMsg}
                                ${xhr.status ? `<br><small>Status: ${xhr.status}</small>` : ''}
                            </td>
                        </tr>
                    `);
                }
            });
        }

        // Form submission (Create/Update)
        $('#projectForm').submit(function(e) {
            e.preventDefault();
            const formData = {
                id: $('#projectId').val(),
                name: $('#projectName').val(),
                description: $('#projectDescription').val(),
                start_date: $('#startDate').val(),
                end_date: $('#endDate').val()
            };

            $.ajax({
                url: "{{ route('projects.store') }}",
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#saveProjectBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Processing...');
                },
                
                success: function(response) {
                    if (response.success) {
                        $('#saveProjectBtn').prop('disabled', false).text('Save Project');

                        loadActiveProjects();
                        $('#projectForm')[0].reset();
                        $('#projectId').val('');
                        $('#saveProjectBtn').text('Save Project');
                        $('#cancelEditBtn').hide();
                        toastr.success(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error(xhr.responseJSON.message || 'Error saving project');
                    }
                }
            });
        });

        // Archive project
        $(document).on('click', '.archiveBtn', function() {
            const projectId = $(this).closest('tr').data('id');
            if (confirm('Are you sure you want to archive this project?')) {
                $.ajax({
                    url: `/projects/archive/${projectId}`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span>');
                    },
                    success: function(response) {
                        if (response.success) {
                            loadActiveProjects();
                            loadArchivedProjects();
                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message || 'Error archiving project');
                    },
                    complete: function() {
                        $(this).prop('disabled', false).text('Archive');
                    }
                });
            }
        });

        // Restore project
        $(document).on('click', '.restoreBtn', function() {
            const projectId = $(this).closest('tr').data('id');
            if (confirm('Are you sure you want to restore this project?')) {
                $.ajax({
                    url: `/projects/restore/${projectId}`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span>');
                    },
                    success: function(response) {
                        if (response.success) {
                            loadActiveProjects();
                            loadArchivedProjects();
                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message || 'Error restoring project');
                    },
                    complete: function() {
                        $(this).prop('disabled', false).text('Restore');
                    }
                });
            }
        });

        // View button handler
        $(document).on('click', '.viewBtn', function() {
            const projectId = $(this).closest('tr').data('id');
            
            $.ajax({
                url: `/projects_archive/${projectId}`,
                method: 'GET',
                success: function(response) {
                    $('#archiveModalTitle').text(response.name);
                    $('#archiveModalDescription').text(response.description);
                    $('#archiveModalDuration').text(response.duration);
                    $('#archiveModalArchivedBy').text(response.archived_by.name);
                    $('#archiveModalRole').text(response.archived_by.role);
                    $('#archiveModalDate').text(new Date(response.archived_at).toLocaleString());
                    
                    new bootstrap.Modal(document.getElementById('viewArchiveModal')).show();
                },
                error: function(xhr) {
                    toastr.error('Error loading project details: ' + (xhr.responseJSON?.message || ''));
                }
            });
        });

        // Edit project
        $('#projectsTable').on('click', '.editBtn', function() {
            const projectId = $(this).closest('tr').data('id');
            $.ajax({
                url: `/projects/${projectId}`,
                method: 'GET',
                beforeSend: function() {
                    $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span>');
                },
                success: function(project) {
                    $('#projectId').val(project.id);
                    $('#projectName').val(project.name);
                    $('#projectDescription').val(project.description);
                    $('#startDate').val(project.start_date);
                    $('#endDate').val(project.end_date);
                    $('#saveProjectBtn').text('Update Project');
                    $('#cancelEditBtn').show();
                },
                error: function() {
                    toastr.error('Error loading project details');
                },
                complete: function() {
                    $(this).prop('disabled', false).text('Edit');
                }
            });
        });

        // Cancel edit
        $('#cancelEditBtn').click(function() {
            $('#projectForm')[0].reset();
            $('#projectId').val('');
            $('#saveProjectBtn').text('Save Project');
            $(this).hide();
        });

        // Tab change event
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            if (e.target.getAttribute('href') === '#archived-projects') {
                loadArchivedProjects();
            } else {
                loadActiveProjects();
            }
        });

        // Initial load
        loadActiveProjects();
    });
</script>
