<div class="container mt-5">
    <!-- Main heading for the assignments section -->
    <h2>Project Assignments</h2>
  
    <!-- Check if current user is a supervisor -->
    @php
        $isSupervisor = $currentUser->roles->pluck('name')->contains('Supervisor');
    @endphp
  
    <!-- Tab Navigation -->
    <ul class="nav nav-tabs mb-4" id="assignmentTabs">
        <!-- Supervisor tab (hidden for supervisor users) -->
        @unless($isSupervisor)
        <li class="nav-item">
            <a class="nav-link {{ !$isSupervisor ? 'active' : '' }}" data-bs-toggle="tab" href="#supervisors-tab">Supervisors</a>
        </li>
        @endunless
        <!-- Intern tab (always visible, active for supervisors) -->
        <li class="nav-item">
            <a class="nav-link {{ $isSupervisor ? 'active' : '' }}" data-bs-toggle="tab" href="#interns-tab">Interns</a>
        </li>
    </ul>
  
    <!-- Tab Content Panels -->
    <div class="tab-content">
        <!-- Supervisors Tab Content -->
        @unless($isSupervisor)
        <div class="tab-pane fade show active" id="supervisors-tab">
            <!-- Supervisor Assignment Form -->
            <form id="supervisorAssignmentForm" class="mb-4">
                @csrf
                <input type="hidden" name="role" value="supervisor">
                <div class="row g-3 align-items-end">
                    <!-- Project Selection -->
                    <div class="col-md-5">
                        <label for="supervisorProject" class="form-label">Project</label>
                        <select class="form-select" id="supervisorProject" name="project_id" required>
                            <option value="">Select project</option>
                        </select>
                    </div>
                    <!-- Supervisor Selection -->
                    <div class="col-md-5">
                        <label for="supervisorUser" class="form-label">Supervisor</label>
                        <select class="form-select" id="supervisorUser" name="user_id" required>
                            <option value="">Select supervisor</option>
                        </select>
                    </div>
                    <!-- Submit Button -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Assign</button>
                    </div>
                </div>
            </form>
  
            <!-- Supervisors Assignment Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="45%">Project</th>
                            <th width="35%">Supervisor</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="supervisorsTableBody">
                        <!-- Dynamically populated via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
        @endunless
  
        <!-- Interns Tab Content -->
        <div class="tab-pane fade {{ $isSupervisor ? 'show active' : '' }}" id="interns-tab">
            <!-- Intern Assignment Form -->
            <form id="internAssignmentForm" class="mb-4">
                @csrf
                <input type="hidden" name="role" value="intern">
                <div class="row g-3 align-items-end">
                    <!-- Project Selection -->
                    <div class="col-md-5">
                        <label for="internProject" class="form-label">Project</label>
                        <select class="form-select" id="internProject" name="project_id" required>
                            <option value="">Select project</option>
                        </select>
                    </div>
                    <!-- Intern Selection -->
                    <div class="col-md-5">
                        <label for="internUser" class="form-label">Intern</label>
                        <select class="form-select" id="internUser" name="user_id" required>
                            <option value="">Select intern</option>
                        </select>
                    </div>
                    <!-- Submit Button -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Assign</button>
                    </div>
                </div>
                
                <!-- Task Assignment Section (Hidden by default) -->
                <div class="mt-3 task-checkboxes-container" style="display: none;">
                    <label class="form-label">Assign Tasks (Optional)</label>
                    <div class="task-checkboxes">
                        <!-- Dynamically populated with tasks when project is selected -->
                        <div class="alert alert-info">No tasks available for selected project</div>
                    </div>
                </div>
            </form>
  
            <!-- Interns Assignment Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Project</th>
                            <th width="25%">Intern</th>
                            <th width="25%">Assigned Tasks</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="internsTableBody">
                        <!-- Dynamically populated via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    // Set up CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize the active tab based on URL hash or user role
    let currentTab = window.location.hash || '{{ $isSupervisor ? "#interns-tab" : "#supervisors-tab" }}';
    $(`a[href="${currentTab}"]`).tab('show');

    // Load initial data
    loadDropdowns();
    loadAssignments();

    // Handle tab changes
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
        loadAssignments();
    });

    // When project selection changes in intern tab - UPDATED SECTION
    $('#internProject').on('change', function() {
        const projectId = $(this).val();
        const taskContainer = $('.task-checkboxes-container');
        const checkboxesArea = $('.task-checkboxes');
        
        // Reset task display
        taskContainer.hide();
        checkboxesArea.html('<div class="text-center py-2"><div class="spinner-border spinner-border-sm" role="status"></div> Loading tasks...</div>');
        
        if (!projectId) return;

        // Fetch tasks ONLY for the selected project with project relationship
        $.ajax({
            url: "{{ route('tasks.index') }}",
            method: 'GET',
            data: { 
                project_id: projectId,
                with_projects: true // Ensure we get project relationships
            },
            success: function(tasks) {
                if (tasks.length > 0) {
                    let checkboxes = '';
                    let hasTasksForProject = false;
                    
                    // Create checkbox only for tasks belonging to this project
                    tasks.forEach(task => {
                        // Verify task belongs to selected project
                        if (task.projects && task.projects.some(p => p.id == projectId)) {
                            checkboxes += `
                                <div class="form-check task-checkbox-item">
                                    <input class="form-check-input" type="checkbox" 
                                           value="${task.id}" id="task-${task.id}">
                                    <label class="form-check-label" for="task-${task.id}">
                                        ${task.name} (Due: ${task.due_date || 'No deadline'})
                                    </label>
                                </div>`;
                            hasTasksForProject = true;
                        }
                    });
                    
                    if (hasTasksForProject) {
                        checkboxesArea.html(checkboxes);
                    } else {
                        checkboxesArea.html('<div class="alert alert-info">No tasks available for this project</div>');
                    }
                } else {
                    checkboxesArea.html('<div class="alert alert-info">No tasks available for this project</div>');
                }
                taskContainer.show();
            },
            error: function() {
                checkboxesArea.html('<div class="alert alert-danger">Failed to load tasks</div>');
            }
        });
    });

    // Show alert message
    function showAlert(message, type = 'success') {
        const alertBox = $('#alertBox');
        alertBox.removeClass('d-none alert-success alert-danger alert-warning alert-info')
            .addClass(`alert alert-${type}`)
            .html(message);
        setTimeout(() => alertBox.addClass('d-none'), 5000);
    }

    // Load dropdown options for projects, supervisors, and interns
    function loadDropdowns() {
        // Load projects
        $.ajax({
            url: "{{ route('assignments.projects') }}",
            method: 'GET',
            success: function (projects) {
                let options = '<option value="">Select project</option>';
                projects.forEach(p => options += `<option value="${p.id}">${p.name}</option>`);
                $('#supervisorProject, #internProject').html(options);
            }
        });

        // Load supervisors
        $.ajax({
            url: "{{ route('assignments.supervisors') }}",
            method: 'GET',
            success: function (supers) {
                let options = '<option value="">Select supervisor</option>';
                supers.forEach(s => options += `<option value="${s.id}">${s.name}</option>`);
                $('#supervisorUser').html(options);
            }
        });

        // Load interns
        $.ajax({
            url: "{{ route('assignments.interns') }}",
            method: 'GET',
            success: function (interns) {
                let options = '<option value="">Select intern</option>';
                interns.forEach(i => options += `<option value="${i.id}">${i.name}</option>`);
                $('#internUser').html(options);
            }
        });
    }

    // Load current assignments from server
    function loadAssignments() {
        const isSupervisorTab = $('.nav-link.active').attr('href') === '#supervisors-tab';
        const loading = isSupervisorTab ?
            '<tr><td colspan="4" class="text-center">Loading supervisors...</td></tr>' :
            '<tr><td colspan="5" class="text-center">Loading interns...</td></tr>';

        // Show loading state
        if (isSupervisorTab) $('#supervisorsTableBody').html(loading);
        else $('#internsTableBody').html(loading);

        // Fetch assignments
        $.ajax({
            url: "{{ route('assignments.assignments') }}",
            method: 'GET',
            success: function(assignments) {
                $('#supervisorsTableBody, #internsTableBody').empty();
                let sc = 1, ic = 1;

                // Process each project's assignments
                assignments.forEach(project => {
                    // Add supervisor assignments
                    project.supervisors.forEach(s => {
                        $('#supervisorsTableBody').append(`
                            <tr data-project-id="${project.id}" data-user-id="${s.id}">
                                <td>${sc++}</td>
                                <td>${project.project_name}</td>
                                <td>${s.name}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger remove-assignment"
                                        data-project-id="${project.id}"
                                        data-user-id="${s.id}"
                                        data-role="supervisor">
                                        Remove
                                    </button>
                                </td>
                            </tr>`);
                    });

                    // Add intern assignments with tasks
                    project.interns.forEach(i => {
                        let taskBadges = 'None';
                        if (i.tasks && i.tasks.length > 0) {
                            // Create badges for assigned tasks
                            taskBadges = i.tasks.map(t => 
                                `<span class="badge bg-primary me-1">${t.name}</span>`
                            ).join('');
                        }
                        
                        $('#internsTableBody').append(`
                            <tr data-project-id="${project.id}" data-user-id="${i.id}">
                                <td>${ic++}</td>
                                <td>${project.project_name}</td>
                                <td>${i.name}</td>
                                <td>${taskBadges}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger remove-assignment"
                                        data-project-id="${project.id}"
                                        data-user-id="${i.id}"
                                        data-role="intern">
                                        Remove
                                    </button>
                                </td>
                            </tr>`);
                    });
                });

                // Handle empty states
                if ($('#supervisorsTableBody').is(':empty')) {
                    $('#supervisorsTableBody').html('<tr><td colspan="4" class="text-center text-muted">No supervisor assignments found</td></tr>');
                }
                if ($('#internsTableBody').is(':empty')) {
                    $('#internsTableBody').html('<tr><td colspan="5" class="text-center text-muted">No intern assignments found</td></tr>');
                }
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'Failed to load assignments';
                const err = isSupervisorTab 
                    ? '<tr><td colspan="4" class="text-center text-danger">' + msg + '</td></tr>'
                    : '<tr><td colspan="5" class="text-center text-danger">' + msg + '</td></tr>';
                isSupervisorTab ? $('#supervisorsTableBody').html(err) : $('#internsTableBody').html(err);
                showAlert(msg, 'danger');
            }
        });
    }

    // Handle form submission for assigning supervisors/interns
    $('#supervisorAssignmentForm, #internAssignmentForm').on('submit', function (e) {
        e.preventDefault();
        const form = $(this);
        const btn = form.find('button[type="submit"]');
        const original = btn.html();

        // Show loading state
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Processing...');

        // Get selected task IDs
        const taskIds = [];
        $('.task-checkboxes input[type="checkbox"]:checked').each(function() {
            taskIds.push($(this).val());
        });

        // Prepare form data
        const formData = new FormData(form[0]);
        if (taskIds.length > 0) {
            formData.append('task_ids', taskIds.join(','));
        }

        // Submit assignment
        $.ajax({
            url: "{{ route('assignments.store') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.success) {
                    form.trigger('reset');
                    $('.task-checkboxes-container').hide();
                    loadAssignments();
                    showAlert(res.message, 'success');
                } else {
                    showAlert(res.message || 'Error creating assignment', 'danger');
                }
            },
            error: function(xhr) {
                const errors = xhr.responseJSON?.errors;
                if (errors) {
                    Object.values(errors).forEach(e => showAlert(e[0], 'danger'));
                } else {
                    showAlert(xhr.responseJSON?.message || 'Error processing request', 'danger');
                }
            },
            complete: function() {
                btn.prop('disabled', false).html(original);
            }
        });
    });

    // Handle removal of assignments
    $(document).on('click', '.remove-assignment', function () {
        const btn = $(this);
        const projectId = btn.data('project-id');
        const userId = btn.data('user-id');
        const role = btn.data('role');

        if (!confirm(`Are you sure you want to remove this ${role} assignment?`)) return;

        // Show loading state
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span>');

        // Send removal request
        $.ajax({
            url: `{{ route('assignments.destroy', '') }}/${projectId}`,
            method: 'DELETE',
            data: { user_id: userId, role },
            success: function(res) {
                if (res.success) {
                    loadAssignments();
                    showAlert(res.message, 'success');
                } else {
                    showAlert(res.message || 'Error removing assignment', 'danger');
                    btn.prop('disabled', false).html('Remove');
                }
            },
            error: function(xhr) {
                showAlert(xhr.responseJSON?.message || 'Error processing request', 'danger');
                btn.prop('disabled', false).html('Remove');
            }
        });
    });
});
</script>

<style>
    /* Tab styling */
    .nav-tabs .nav-link {
        font-weight: 500;
    }
    
    /* Table header styling */
    .table th {
        white-space: nowrap;
    }
    
    /* Remove button styling */
    .remove-assignment {
        min-width: 80px;
    }
    
    /* Responsive tables */
    .table-responsive {
        overflow-x: auto;
    }
    
    /* Task checkboxes container */
    .task-checkboxes {
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #dee2e6;
        padding: 10px;
        border-radius: 5px;
        background: #f8f9fa;
    }
    
    /* Individual task checkbox item */
    .task-checkbox-item {
        margin-bottom: 8px;
    }
    
    /* Task badge styling */
    .badge {
        font-weight: 500;
        padding: 5px 8px;
        margin-bottom: 3px;
        display: inline-flex;
        align-items: center;
    }
</style>