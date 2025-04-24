<div class="container mt-4">
    <h2 class="mb-4">Task Management</h2>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="taskTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active-tasks" type="button" role="tab">Active Project Tasks</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived-tasks" type="button" role="tab">Archived Project Tasks</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3">
        <!-- Active Tasks Tab -->
        <div class="tab-pane fade show active" id="active-tasks" role="tabpanel">
            <!-- Task Creation Form -->
            <form id="task-form">
                @csrf
                <div class="mb-3">
                    <label for="project" class="form-label">Project</label>
                    <select class="form-select" id="project" name="project_id" required>
                        <option value="">Select Project</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}"
                                    data-start="{{ $project->start_date }}"
                                    data-end="{{ $project->end_date }}">
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="task-name" class="form-label">Task Name</label>
                    <input type="text" class="form-control" id="task-name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="start-date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start-date" name="start_date" required>
                </div>
                <div class="mb-3">
                    <label for="due-date" class="form-label">Due Date</label>
                    <input type="date" class="form-control" id="due-date" name="due_date">
                </div>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>

            <hr>

            <!-- Active Tasks Table -->
            <h3 class="mt-4">Tasks</h3>
            <table class="table table-bordered mt-2" id="tasks-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project</th>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- Archived Tasks Tab -->
        <div class="tab-pane fade" id="archived-tasks" role="tabpanel">
            <h3 class="mt-4">Archived Tasks</h3>

            <!-- Project Selection Dropdown for Archived Tasks -->
            <div class="mb-3">
                <label for="archived-project-dropdown" class="form-label">Select Project</label>
                <select class="form-select" id="archived-project-dropdown">
                    <option value="">-- Select a Project --</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Archived Tasks Container -->
            <div id="archived-tasks-container" class="mt-3">
                <div class="alert alert-info">
                    Please select a project to view its archived tasks
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // DOM Element References
        const taskForm = $('#task-form');
        const tasksTable = $('#tasks-table tbody');
        const archivedProjectDropdown = $('#archived-project-dropdown');
        const archivedTasksContainer = $('#archived-tasks-container');
        const projectSelect = $('#project');
        const startDateInput = $('#start-date');
        const dueDateInput = $('#due-date');
        const taskNameInput = $('#task-name');
        let taskIndex = 1;
        
        // Store project date ranges for validation
        const projectData = {};

        // Initialize project data from select options
        $('#project option').each(function() {
            if ($(this).val()) {
                projectData[$(this).val()] = {
                    start_date: $(this).data('start'),
                    end_date: $(this).data('end')
                };
            }
        });

        /**
         * Loads active tasks from server and populates the table
         */
        function loadActiveTasks() {
            $.get("{{ route('tasks.index') }}", function(tasks) {
                tasksTable.empty();
                taskIndex = 1;
                
                if (tasks.length === 0) {
                    tasksTable.append('<tr><td colspan="7" class="text-center">No active tasks found</td></tr>');
                    return;
                }

                // Populate table with active tasks
                $.each(tasks, function(index, task) {
                    const project = task.projects && task.projects.length > 0 ? task.projects[0] : null;
                    const projectName = project ? project.name : 'N/A';

                    const row = $(`
                        <tr>
                            <td>${taskIndex++}</td>
                            <td>${projectName}</td>
                            <td>${task.name}</td>
                            <td>${task.description || 'N/A'}</td>
                            <td>${task.start_date}</td>
                            <td>${task.due_date || 'N/A'}</td>
                            <td>
                                <button class="btn btn-warning btn-sm archive-task" data-id="${task.id}">Archive</button>
                            </td>
                        </tr>
                    `);
                    tasksTable.append(row);
                });
            }).fail(function() {
                tasksTable.html('<tr><td colspan="7" class="text-center text-danger">Failed to load tasks</td></tr>');
            });
        }

        /**
         * Loads archived tasks for a specific project from server
         * @param {string} projectId - The ID of the project to load archived tasks for
         */
        function loadArchivedTasks(projectId) {
            if (!projectId) {
                archivedTasksContainer.html(`
                    <div class="alert alert-info">
                        Please select a project to view its archived tasks
                    </div>
                `);
                return;
            }

            archivedTasksContainer.html(`
                <div class="text-center my-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p>Loading archived tasks...</p>
                </div>
            `);

            $.get("{{ route('tasks.archived') }}", { original_project_id: projectId }, function(archivedTasks) {
                if (archivedTasks.length === 0) {
                    archivedTasksContainer.html(`
                        <div class="alert alert-warning">
                            No archived tasks found for this project
                        </div>
                    `);
                    return;
                }

                const table = $(`
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>Due Date</th>
                                <th>Archived At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                `);

                $.each(archivedTasks, function(index, task) {
                    const row = $(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${task.name}</td>
                            <td>${task.description || 'N/A'}</td>
                            <td>${task.start_date}</td>
                            <td>${task.due_date || 'N/A'}</td>
                            <td>${new Date(task.archived_at).toLocaleString()}</td>
                            <td>
                                <button class="btn btn-sm btn-success restore-task" data-id="${task.id}">
                                    <i class="fas fa-undo"></i> Restore
                                </button>
                            </td>
                        </tr>
                    `);
                    table.find('tbody').append(row);
                });

                archivedTasksContainer.empty().append(table);
            }).fail(function() {
                archivedTasksContainer.html(`
                    <div class="alert alert-danger">
                        Failed to load archived tasks. Please try again.
                    </div>
                `);
            });
        }

        // When archived project dropdown changes, load its tasks
        archivedProjectDropdown.on('change', function() {
            loadArchivedTasks($(this).val());
        });

        // Handle task restoration
        archivedTasksContainer.on('click', '.restore-task', function() {
            const taskId = $(this).data('id');
            const projectId = archivedProjectDropdown.val();

            if (confirm('Are you sure you want to restore this task?')) {
                $.ajax({
                    url: "{{ route('tasks.restore', '') }}/" + taskId,
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response.message);
                        loadArchivedTasks(projectId);
                        loadActiveTasks();
                    },
                    error: function(xhr) {
                        alert('Error restoring task: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                });
            }
        });

        // Handle new task form submission
        taskForm.on('submit', function(e) {
            e.preventDefault();

            const projectId = projectSelect.val();
            const taskName = taskNameInput.val();
            const description = $('#description').val();
            const startDate = startDateInput.val();
            const dueDate = dueDateInput.val();

            if (!projectId || !taskName || !startDate) {
                alert("Please fill all required fields.");
                return;
            }

            const projectStart = projectData[projectId].start_date;
            const projectEnd = projectData[projectId].end_date;

            if (startDate < projectStart || startDate > projectEnd) {
                alert(`Task start date must be between ${projectStart} and ${projectEnd}`);
                return;
            }

            if (dueDate && dueDate < startDate) {
                alert('Task due date must be after start date');
                return;
            }

            $.ajax({
                url: "{{ route('tasks.store') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    name: taskName,
                    description: description,
                    start_date: startDate,
                    due_date: dueDate || null,
                    project_id: projectId
                },
                success: function(response) {
                    taskForm.trigger('reset');
                    alert(response.message);
                    loadActiveTasks();
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMsg = 'Please fix the following errors:\n';
                    for (const field in errors) {
                        errorMsg += `- ${errors[field][0]}\n`;
                    }
                    alert(errorMsg);
                }
            });
        });

        // Handle task archiving
        tasksTable.on('click', '.archive-task', function() {
            const taskId = $(this).data('id');
            const currentProjectId = archivedProjectDropdown.val();

            if (confirm('Are you sure you want to archive this task?')) {
                $.ajax({
                    url: "{{ route('tasks.archive', '') }}/" + taskId,
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response.message);
                        loadActiveTasks();
                        loadArchivedTasks(currentProjectId);
                    },
                    error: function(xhr) {
                        alert('Error archiving task: ' + xhr.responseJSON.message);
                    }
                });
            }
        });

        loadActiveTasks(); // Load active tasks on page load
    });
</script>
