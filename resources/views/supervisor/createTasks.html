<div class="container mt-4">
  <h3>Create Tasks Under Projects</h3>

  <!-- Task Creation Form -->
  <form id="createTaskForm" class="mt-4">

    <div class="mb-3">
      <label for="projectSelect" class="form-label">Select Project</label>
      <select class="form-select" id="projectSelect" required>
        <option value="">Loading projects...</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="taskTitle" class="form-label">Task Title</label>
      <input type="text" class="form-control" id="taskTitle" placeholder="Enter task title" required>
    </div>

    <div class="mb-3">
      <label for="taskDescription" class="form-label">Task Description</label>
      <textarea class="form-control" id="taskDescription" placeholder="Enter task description" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label for="dueDate" class="form-label">Due Date</label>
      <input type="date" class="form-control" id="dueDate" required>
    </div>

    <button type="submit" class="btn btn-primary">Create Task</button>
  </form>

  <!-- Task List -->
  <div class="mt-5">
    <h4>Created Tasks</h4>
    <table class="table table-bordered" id="tasksTable">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Project</th>
          <th>Task Title</th>
          <th>Description</th>
          <th>Due Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Tasks will appear here -->
      </tbody>
    </table>
  </div>
</div>

<script>
$(document).ready(function() {

  let useMockData = true; // Set to false when ready to switch to backend

  const tasks = [];
  let taskCount = 0;

  // Mocked projects (comment this block out when using backend)
  const mockProjects = [
    { id: 1, name: "Website Redesign" },
    { id: 2, name: "Mobile App Development" },
    { id: 3, name: "Marketing Campaign" },
    { id: 4, name: "Server Infrastructure Upgrade" }
  ];

  function loadProjects() {
    $('#projectSelect').empty().append('<option value="">Select a project</option>');

    if (useMockData) {
      $.each(mockProjects, function(_, project) {
        $('#projectSelect').append(`<option value="${project.id}">${project.name}</option>`);
      });
    } else {
      // Uncomment when ready for backend:
      /*
      $.ajax({
        url: '../api/projects.php',
        method: 'GET',
        dataType: 'json',
        success: function(projects) {
          $.each(projects, function(_, project) {
            $('#projectSelect').append(`<option value="${project.id}">${project.name}</option>`);
          });
        },
        error: function() {
          $('#projectSelect').append('<option value="">Failed to load projects</option>');
        }
      });
      */
    }
  }

  loadProjects();

  function addTaskToTable(task, index) {
    $('#tasksTable tbody').append(`
      <tr data-index="${index}">
        <td>${index + 1}</td>
        <td>${task.projectName}</td>
        <td>${task.title}</td>
        <td>${task.description}</td>
        <td>${task.due_date}</td>
        <td>
          <button class="btn btn-sm btn-warning editBtn">Edit</button>
          <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
        </td>
      </tr>
    `);
  }

  function refreshTasksTable() {
    $('#tasksTable tbody').empty();
    $.each(tasks, function(index, task) {
      addTaskToTable(task, index);
    });
  }

  $('#createTaskForm').submit(function(e) {
    e.preventDefault();

    const projectId = $('#projectSelect').val();
    const projectName = $('#projectSelect option:selected').text();
    const title = $('#taskTitle').val();
    const description = $('#taskDescription').val();
    const dueDate = $('#dueDate').val();

    if (!projectId) {
      alert('Please select a project.');
      return;
    }

    const newTask = {
      project_id: projectId,
      projectName: projectName,
      title: title,
      description: description,
      due_date: dueDate
    };

    tasks.push(newTask);
    refreshTasksTable();
    alert('Task created successfully!');
    $('#createTaskForm')[0].reset();
  });

  $('#tasksTable').on('click', '.deleteBtn', function() {
    const rowIndex = $(this).closest('tr').data('index');
    if (confirm('Are you sure you want to delete this task?')) {
      tasks.splice(rowIndex, 1);
      refreshTasksTable();
    }
  });

  $('#tasksTable').on('click', '.editBtn', function() {
    const rowIndex = $(this).closest('tr').data('index');
    const task = tasks[rowIndex];

    $('#projectSelect').val(task.project_id);
    $('#taskTitle').val(task.title);
    $('#taskDescription').val(task.description);
    $('#dueDate').val(task.due_date);

    tasks.splice(rowIndex, 1);
    refreshTasksTable();
    alert('You can now edit the task and submit again.');
  });

});
</script>
