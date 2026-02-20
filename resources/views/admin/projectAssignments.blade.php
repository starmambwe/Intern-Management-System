@if(isset($viewType) && $viewType === 'Intern')
    <div class="d-flex justify-content-center align-items-start" style="min-height: 60vh;">
        <div style="width:100%; max-width: 500px;">
            <h3 class="text-center">Your Assigned Projects & Tasks</h3>
            @php
                $projectOptions = collect($internProjects)->map(function($item) { return $item['project']; });
            @endphp
            <div class="mb-3" style="max-width: 400px; margin-left:auto; margin-right:auto;">
                <label for="projectSelect" class="form-label">Select Project:</label>
                <select id="projectSelect" class="form-select custom-dropdown">
                    <option value="" selected disabled>-- Choose Project --</option>
                    @foreach($projectOptions as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3" style="max-width: 400px; margin-left:auto; margin-right:auto;">
                <label for="taskSelect" class="form-label">Select Task:</label>
                <select id="taskSelect" class="form-select custom-dropdown" disabled>
                    <option value="" selected disabled>-- Choose Task --</option>
                </select>
            </div>
            <div id="detailsArea"></div>
            <div id="logArea" style="margin-top: 2rem;"></div>
        </div>
    </div>
    <style>
        .custom-dropdown {
            min-width: 200px;
            max-width: 100%;
            width: 100%;
            border-radius: 0.5rem;
            border-color: #b5c2d6;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            font-size: 1rem;
            padding: 0.5rem 1.5rem 0.5rem 0.75rem;
            background-color: #f8fafc;
            transition: border-color 0.2s;
        }
        .custom-dropdown:focus {
            border-color: #2563eb;
            outline: none;
            box-shadow: 0 0 0 2px #c7d7fa;
        }
        #detailsArea .card {
            max-width: 600px;
            margin-top: 1rem;
            border-radius: 0.75rem;
            border: 1px solid #e0e7ef;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
        }
        #detailsArea .card-header {
            background: linear-gradient(90deg, #e0e7ff 0%, #f8fafc 100%);
            font-size: 1.1rem;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e0e7ef;
        }
        #detailsArea .card-body {
            background: #fafdff;
            color: #334155;
        }
        #logArea {
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .log-card {
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            background: #fff;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }
        .log-header {
            padding: 0.5rem 1rem;
            background: #f1f5f9;
            border-bottom: 1px solid #e5e7eb;
            font-weight: 500;
            font-size: 0.98rem;
        }
        .log-body {
            padding: 0.75rem 1rem;
            font-size: 0.97rem;
            color: #374151;
        }
        .log-role-intern { color: #2563eb; }
        .log-role-supervisor { color: #059669; }
        .log-role-admin { color: #d97706; }
        .log-self { font-weight: bold; }
        .log-timestamp { font-size: 0.9em; color: #64748b; }
    </style>
    <script>
        function initInternProjectTaskDropdowns() {
            const internProjects = window.internProjectsData || @json($internProjects);
            const projectSelect = document.getElementById('projectSelect');
            const taskSelect = document.getElementById('taskSelect');
            const detailsArea = document.getElementById('detailsArea');
            const logArea = document.getElementById('logArea');
            if (!projectSelect || !taskSelect) return;

            projectSelect.onchange = function() {
                const projectId = this.value;
                taskSelect.innerHTML = '<option value="" selected disabled>-- Choose Task --</option>';
                detailsArea.innerHTML = '';
                logArea.innerHTML = '';
                if (!internProjects[projectId]) {
                    taskSelect.disabled = true;
                    return;
                }
                const tasks = internProjects[projectId]['tasks'];
                if (tasks.length === 0) {
                    taskSelect.disabled = true;
                    detailsArea.innerHTML = '<div class="alert alert-info">No tasks assigned for this project.</div>';
                    showProjectDetails(projectId, null);
                    return;
                }
                tasks.forEach(task => {
                    const opt = document.createElement('option');
                    opt.value = task.id;
                    opt.textContent = task.name; 
                    taskSelect.appendChild(opt);
                });
                taskSelect.disabled = false;
            };

            taskSelect.onchange = function() {
                const projectId = projectSelect.value;
                const taskId = this.value;
                showProjectDetails(projectId, taskId);
                showLogFormAndLogs(projectId, taskId);
            };

            function showProjectDetails(projectId, taskId) {
                const data = internProjects[projectId];
                let html = `<div class='card mb-3'><div class='card-header'><strong>Project:</strong> ${data.project.name}</div><div class='card-body'>`;
                html += `<p><strong>Description:</strong> ${data.project.description}</p>`;
                html += `<p><strong>Supervisors:</strong> `;
                if (data.supervisors.length) {
                    html += data.supervisors.map(s => s.name).join(', ');
                } else {
                    html += '<em>None assigned</em>';
                }
                html += `</p>`;
                if (taskId) {
                    const task = data.tasks.find(t => t.id == taskId);
                    if (task) {
                        html += `<hr><h5>Task Details:</h5><strong>${task.name}</strong><br><small>${task.description}</small>`;
                    }
                }
                html += `</div></div>`;
                detailsArea.innerHTML = html;
            }

            function showLogFormAndLogs(projectId, taskId) {
                if (!projectId || !taskId) { logArea.innerHTML = ''; return; }
                // Log form
                let formHtml = `<form id='logSubmitForm' class='mb-4'>
                    <div class='mb-2'><label for='log_text' class='form-label'>Submit Log for this Task:</label>
                    <textarea class='form-control' id='log_text' name='log_text' rows='3' required placeholder='Describe your work, progress, or notes...'></textarea></div>
                    <button type='submit' class='btn btn-primary'>Submit Log</button>
                    <div id='logFormMsg' class='mt-2'></div>
                </form>`;
                formHtml += `<div id='logsList'></div>`;
                logArea.innerHTML = formHtml;
                // Fetch and show logs
                fetchLogs(projectId, taskId);
                // Attach submit handler
                document.getElementById('logSubmitForm').onsubmit = function(e) {
                    e.preventDefault();
                    submitLog(projectId, taskId);
                };
            }

            function fetchLogs(projectId, taskId) {
                const logsList = document.getElementById('logsList');
                logsList.innerHTML = '<div class="text-center text-secondary">Loading logs...</div>';
                fetch(`/intern/task-logs/${taskId}?project_id=${projectId}`)
                    .then(resp => resp.json())
                    .then(logs => {
                        if (!logs.length) {
                            logsList.innerHTML = '<div class="alert alert-info">No logs for this task yet.</div>';
                            return;
                        }
                        let html = '';
                        logs.forEach(log => {
                            const isSelf = log.user_id == window.currentUserId;
                            let roleClass = 'log-role-intern';
                            let roleLabel = 'Intern';
                            if (log.user && log.user.roles && log.user.roles.length) {
                                const r = log.user.roles[0].name.toLowerCase();
                                if (r.includes('supervisor')) { roleClass = 'log-role-supervisor'; roleLabel = 'Supervisor'; }
                                else if (r.includes('admin')) { roleClass = 'log-role-admin'; roleLabel = 'Admin'; }
                            }
                            html += `<div class='log-card'>
                                <div class='log-header ${roleClass}${isSelf ? ' log-self' : ''}'>
                                    <span>${log.user ? log.user.name : 'Unknown User'}</span>
                                    <span class='log-timestamp float-end'>${(new Date(log.created_at)).toLocaleString()}</span><br>
                                    <span class='badge ${roleClass}'>${roleLabel}${isSelf ? ' (You)' : ''}</span>
                                </div>
                                <div class='log-body'>${log.log_text.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</div>
                            </div>`;
                        });
                        logsList.innerHTML = html;
                    });
            }

            function submitLog(projectId, taskId) {
                const logText = document.getElementById('log_text').value.trim();
                const logFormMsg = document.getElementById('logFormMsg');
                if (!logText) {
                    logFormMsg.innerHTML = '<span class="text-danger">Log cannot be empty.</span>';
                    return;
                }
                fetch('/intern/task-log', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        task_id: taskId,
                        project_id: projectId,
                        log_text: logText
                    })
                })
                .then(resp => resp.json())
                .then(data => {
                    if (data.log) {
                        logFormMsg.innerHTML = '<span class="text-success">Log submitted!</span>';
                        document.getElementById('log_text').value = '';
                        fetchLogs(projectId, taskId);
                    } else {
                        logFormMsg.innerHTML = '<span class="text-danger">Failed to submit log.</span>';
                    }
                })
                .catch(() => {
                    logFormMsg.innerHTML = '<span class="text-danger">Error submitting log.</span>';
                });
            }
        }

        // Expose current user ID for log highlighting
        window.currentUserId = {{ $currentUser->id ?? 'null' }};
        // Try to initialize immediately (for first page load)
        initInternProjectTaskDropdowns();
        // For AJAX: expose for re-init
        window.initInternProjectTaskDropdowns = initInternProjectTaskDropdowns;
        // If your AJAX loader supports a callback, call window.initInternProjectTaskDropdowns() after HTML is injected.
    </script>
@else
<div id="assignSupervisorsMarker" style="display:none"></div>
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

    // --- WRAP TAB INITIALIZATION IN FUNCTION ---
    window.initAssignSupervisorsTabs = function(retryCount = 0) {
        let currentTab = window.location.hash || '{{ $isSupervisor ? "#interns-tab" : "#supervisors-tab" }}';
        let $tab = $(`a[href="${currentTab}"]`);
        if ($tab.length === 0) {
            if (retryCount < 5) {
                setTimeout(function() {
                    window.initAssignSupervisorsTabs(retryCount + 1);
                }, 100); // Retry after 100ms
            }
            return;
        }
        // Bootstrap 5 tab activation
        var tabEl = $tab[0];
        var tab = new bootstrap.Tab(tabEl);
        tab.show();

        // Load initial data
        loadDropdowns();
        loadAssignments();

        // Handle tab changes
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            window.location.hash = e.target.hash;
            loadAssignments();
        });
    };
    // --- CALL INIT ON FIRST LOAD ---
    if ($('#assignmentTabs').length) {
        window.initAssignSupervisorsTabs();
    }

    // When project selection changes in intern tab - UPDATED SECTION
    $('#internProject').on('change', function() {
        const projectId = $(this).val();
        const taskContainer = $('.task-checkboxes-container');
        const checkboxesArea = $('.task-checkboxes');
        
        // Reset task display
        taskContainer.hide();
        checkboxesArea.empty().append('<div class="alert alert-info">No tasks available for selected project</div>');
        if (!projectId) return;

        // Fetch tasks ONLY for the selected project with project relationship
        $.ajax({
            url: "{{ route('tasks.index') }}",
            method: 'GET',
            data: { 
                project_id: projectId,
                with_projects: true // Ensure we get project relationships
            },
            success: function(res) {
                if (res.length > 0) {
                    let checkboxes = '';
                    let hasTasksForProject = false;
                    
                    // Create checkbox only for tasks belonging to this project
                    res.forEach(task => {
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
        const loading = isSupervisorTab 
            ? '<tr><td colspan="4" class="text-center">Loading supervisors...</td></tr>'
            : '<tr><td colspan="5" class="text-center">Loading interns...</td></tr>';

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
@endif