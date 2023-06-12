<!DOCTYPE html>
<html>
    <head>
        <title>Home Page </title>
        <!-- Add the following lines to link to Bootstrap CSS and JavaScript files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
                integrity="sha384-3zDLo8QJy+qX9Pb7OQ6q6KJZqY6C+LiO8q8M1HJqyFs6Q6IUNx5b98yvruB2d6E7"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>


<body>

@if (isset($dailySummary) or isset($weeklySummary) or isset($monthlySummary))

    <div class="container">
        <div class="row">
            <div class="col-md-6 border-right">
                <h2>Summary</h2>
                <ul class="list-unstyled">
                    <li>Number of Tasks: {{ $Count }}</li>
                    <li>Annual Time: {{ $All }} minutes</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h2>Daily Summary</h2>
                @foreach($dailySummary as $id => $summary)
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">{{ $id }}</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Total Time: {{ $summary['total_time'] }} minutes</p>
                            <ul class="list-group list-group-flush">
                                @foreach($summary['tasks'] as $task)
                                    <li class="list-group-item">{{ $task->id }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-6">
                <h2>Weekly Summary</h2>
                @foreach($weeklySummary as $id => $summary)
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">{{ $id }}</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Total Time: {{ $summary['total_time'] }} minutes</p>
                            <ul class="list-group list-group-flush">
                                @foreach($summary['tasks'] as $task)
                                    <li class="list-group-item">{{ $task->id }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-6">
                <h2>Monthly Summary</h2>
                @foreach($monthlySummary as $id => $summary)
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">{{ $id }}</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Total Time: {{ $summary['total_time'] }} minutes</p>
                            <ul class="list-group list-group-flush">
                                @foreach($summary['tasks'] as $task)
                                    <li class="list-group-item">{{ $task->id }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

<h1 style="color: #007bff; font-size: 36px;">Create Task</h1>

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf

    <label for="title" style="display: block; margin-bottom: 10px; font-size: 18px; font-weight: bold;">Title:</label>
    <input type="text" id="title" name="title" style="display: block; width: 100%; padding: 10px; margin-bottom: 20px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">

    <label for="frequency_type" style="display: block; margin-bottom: 10px; font-size: 18px; font-weight: bold;">Frequency Type:</label>
    <select id="frequency_type" name="frequency_type" style="display: block; width: 100%; padding: 10px; margin-bottom: 20px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
        <option value="daily">Daily</option>
        <option value="weekly">Weekly</option>
        <option value="monthly">Monthly</option>
    </select>

    <label for="time" style="display: block; margin-bottom: 10px; font-size: 18px; font-weight: bold;">Time:</label>
    <input type="text" id="time" name="time" style="display: block; width: 100%; padding: 10px; margin-bottom: 20px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">

    <button type="submit" style="background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 16px; font-weight: bold; border-radius: 5px; border: none; cursor: pointer;">Create Task</button>
</form>

<h2 style="color: #333; font-size: 24px; font-weight: bold;">Actions</h2>

<form action="{{ route('actions.store') }}" method="POST">
    @csrf

    <input type="hidden" name="task_id" value="{{ $task->id ?? '' }}">

    <div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">{{ $task->name }}</h3>
    </div>
    <div class="card-body">
        <p class="card-text">Total Time: {{ $task->total_time }} minutes</p>
        <form method="POST" action="{{ route('actions.store', $task) }}">
            @csrf
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="reading">Reading</option>
                    <option value="action">Action</option>
                </select>
            </div>
            <div class="form-group">
                <label for="time">Time (minutes)</label>
                <input type="number" class="form-control" id="time" name="time" required>
            </div>
            <div class="form-group" id="result-group" style="display: none;">
                <label for="result">Result</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="result" id="passed" value="passed">
                    <label class="form-check-label" for="passed">
                        Passed
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="result" id="failed" value="failed">
                    <label class="form-check-label" for="failed">
                        Failed
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Action</button>
        </form>
    </div>
</div>



    </body>


<script>
    let time = 0;

    $('#add-action').on('click', () => {
      $('#actions').append(
        <div>
            <select name="type">
                <option value="reading">Reading</option>
                <option value="action">Action</option>
            </select>
            <input type="text" name="reading" style="display: none;">
            <div style="display: none;">
                <label><input type="radio" name="result" value="passed">Passed</label>
                <label><input type="radio" name="result" value="failed">Failed</label>
            </div>
            <input type="text" name="time" value="${time}" readonly>
        </div>
      );
      time += 5; // Add 5 minutes
    });

    $('#actions').on('change', 'select[name="type"]', (e) => {
      if ($(e.target).val() === 'reading') {
        $(e.target).next('input').show();
        $(e.target).next().next('div').hide();
      } else {
        $(e.target).next('input').hide();
        $(e.target).next().next('div').show();
      }
    });
    </script>
    </html>
