<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>

    {{-- Style --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="wrapper">
        {{-- sidebar --}}
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="/">Management</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="/" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Employee
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            {{-- navbar --}}
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            {{-- content --}}
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Employees Management</h4>
                    </div>

                    <div class="mb-3 mt2 d-flex justify-content-between">
                        <button data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</button>
                        <form action="/" method="get">
                            <input type="text" id="search" name="search" placeholder="Search..."
                                autocomplete="off" class="justify-content-end">
                            <button type="submit">Search</button>
                        </form>
                    </div>

                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Employees Table
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="employeeTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col"><a href="?sort_by=name">Name</a></th>
                                            <th scope="col"><a href="?sort_by=email">Email</a></th>
                                            <th scope="col"><a href="?sort_by=phone">Phone</a></th>
                                            <th scope="col"><a href="?sort_by=hire_date">Hire Date</a></th>
                                            <th scope="col"><a href="?sort_by=position">Position</a></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td scope='row'>{{ $loop->iteration }}</td>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->phone }}</td>
                                                <td>{{ $employee->hire_date }}</td>
                                                <td>{{ $employee->position }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Employee Modal -->
                <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/" method="POST" id="employeeForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" autofocus value="{{ old('name') }}">
                                        <div class="invalid-feedback">
                                            The name field is required.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}">
                                        <div class="invalid-feedback">
                                            The email field is required.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="number"
                                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            name="phone" value="{{ old('phone') }}">
                                        <div class="invalid-feedback">
                                            The phone field is required.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hireDate" class="form-label">Hire Date</label>
                                        <input type="text"
                                            class="form-control @error('hire_date') is-invalid @enderror"
                                            id="hireDate" name="hire_date" value="{{ old('hire_date') }}"
                                            autocomplete="off">
                                        <div class="invalid-feedback">
                                            The hire date field is required.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Position</label>
                                        <select name="position" id="position" class="form-control">
                                            <option></option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->position }}">{{ $employee->position }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            The position field is required.
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-between">
                                        <button type="submit" class="btn border-success bg-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>Rafli fach</strong>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
